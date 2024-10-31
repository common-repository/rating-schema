<?php

if (!class_exists('WpSrpMetaData')):

    class WpSrpMetaData {

        function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
            add_action('save_post', array($this, 'save_WpSrp_schema_data'), 10, 3);
        }

        function admin_enqueue_scripts()
        {
            global $pagenow, $typenow, $WpSrpSchema;
            // validate page
            $pt = $WpSrpSchema->wpSrpPostTypes();
            if (!in_array($pagenow, array('post.php', 'post-new.php'))) return;
            if (!in_array($typenow, $pt)) return;

            // scripts
            wp_enqueue_script(array(
                'jquery',
                'wpsrp-datepicker',
                'wpsrp-select2-js',
                'wpsrp-admin-js',
            ));

            // styles
            wp_enqueue_style(array(
                'wpsrp-datepicker',
                'wpsrp-select2-css',
                'wpsrp-admin-css',
            ));

            add_action('admin_head', array($this, 'admin_head'));
        }

        function admin_head()
        {
            global $WpSrpSchema;
            $pt = $WpSrpSchema->wpSrpPostTypes();
            foreach ($pt as $postType) {
                add_meta_box(
                    'wpsrp-seo-rating-schema',
                    __('WP Rating  Scheme  by <a href="https://webnox.in/wpsrpplugins.com/">Webnox</a>', WP_SRP_SCHEMA_SLUG),
                    array($this, 'meta_box_wp_schema'),
                    $postType,
                    'normal',
                    'high'
                );
            }

        }

        function meta_box_wp_schema($post)
        {
            global $WpSrpSchema;
            wp_nonce_field($WpSrpSchema->nonceText(), '_wpsrp_nonce');
            $schemas = new WP_SRP_Schema_Model();
            $html = null;
            $html .= "<div class='schema-tips'>";
          /*  $html .= "<p><span>Tip:</span> " . __("For more detailed information on how to configure this plugin, please visit:", "wp-srp-schema-for-dynamic-url") . " <a href='https://wpsrpplugins.com/wordpress-seo-structured-data-schema-plugin/'>https://wpsrpplugins.com/wordpress-seo-structured-data-schema-plugin/</a></p>";
            $html .= "<p><span>Tip:</span> " . __("Once you save these structured data schema settings, validate this page url here:", "wp-srp-schema-for-dynamic-url") . " <a href='https://developers.google.com/structured-data/testing-tool/'>https://developers.google.com/structured-data/testing-tool/</a></p>";
           $html .= "<div class='wpsrp-get-pro'>
							<strong>" . __("Pro Version Features", "wp-srp-schema-for-dynamic-url") . "</strong>
				            <ol>
				                <li>" . __("Includes Auto-fill function <---Popular", "wp-srp-schema-for-dynamic-url") . "</li>
				                <li>" . __("Supports Custom Post Types beyond default page and posts", "wp-srp-schema-for-dynamic-url") . "</li>
				                <li>" . __("Supports WordPress Multisite", "wp-srp-schema-for-dynamic-url") . "</li>
				                <li>" . __("Supports more schema types: ( Books, Courses, Job Postings, Movies, Music, Recipe, TV Episode) ", "wp-srp-schema-for-dynamic-url") . "</li>
				            </ol>
				            <a class='button button-primary' href='https://wpsrpplugins.com/downloads/wordpress-schema-plugin/' target='_blank'>" . __("Get the Pro Version", "wp-srp-schema-for-dynamic-url") . "</a>
						</div>";
						*/
            $html .= "</div>";
            $html .= "<div class='schema-holder'>";
            $html .= '<div id="meta-tab-holder" class="rt-tab-container">';
            $htmlMenu = null;
            $htmlCont = null;
            $htmlMenu .= "<ul class='rt-tab-nav'>";
			
            $schemaFields = $schemas->schemaTypes();
            foreach ($schemaFields as $schemaID => $schema) {
                $tabId = $WpSrpSchema->WpSrpPrefix . $schemaID;
                $htmlMenu .= '<li><a href="#' . $tabId . '">' . $schema['title'] . '</a></li>';
                $htmlCont .= "<div id='{$tabId}' class='rt-tab-content'>";
                $metaData = get_post_meta($post->ID, $tabId, true);
				
                $metaData = (is_array($metaData) ? $metaData : array());
				//print_r($schema['fields']);
                foreach ($schema['fields'] as $fieldId => $data) {
                    $data['fieldId'] = $fieldId;
                    $data['id'] = $tabId . "_" . $fieldId;
                    $data['name'] = $tabId . "[{$fieldId}]";
                    $data['value'] = (!empty($metaData[$fieldId]) ? $metaData[$fieldId] : null);
                    $htmlCont .= $schemas->get_field($data);
                }
                $htmlCont .= "</div>";
            }
            $htmlMenu .= "</ul>";
            $html .= $htmlMenu . $htmlCont;
            $html .= "</div>";
            $html .= "</div>";
            echo $html;
        }

        function save_WpSrp_schema_data($post_id, $post, $update)
        {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
            global $WpSrpSchema;
            $nonce = !empty($_REQUEST['_wpsrp_nonce']) ? $_REQUEST['_wpsrp_nonce'] : null;
            if (!wp_verify_nonce($nonce, $WpSrpSchema->nonceText())) return $post_id;

            // Check permissions
            if (!empty($_GET['post_type'])) {
                if (!current_user_can('edit_' . $_GET['post_type'], $post_id)) return $post_id;
            }
            $pt = $WpSrpSchema->wpSrpPostTypes();
            if (!in_array($post->post_type, $pt)) return $post_id;

            $meta = array();
            $schemaModel = new WP_SRP_Schema_Model;
            $schemaFields = $schemaModel->schemaTypes();
            foreach ($schemaFields as $schemaID => $schema) {
                $schemaMetaId = $WpSrpSchema->WpSrpPrefix . $schemaID;
                $data = array();
                foreach ($schema['fields'] as $fieldId => $fieldData) {
                    $value = (!empty($_REQUEST[$schemaMetaId][$fieldId]) ? $_REQUEST[$schemaMetaId][$fieldId] : null);
                    $value = $WpSrpSchema->sanitize($fieldData, $value);
                    $data[$fieldId] = $value;
                }
                $meta[$schemaMetaId] = $data;
            }
            if (count($meta) > 0) {
                foreach ($meta as $mKey => $mValue) {
                    update_post_meta($post_id, $mKey, $mValue);
                }
            }
        }

    }

endif;