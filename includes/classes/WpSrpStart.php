<?php

if (!class_exists('WpSrpStart')):

    class WpSrpStart {

        function __construct()
        {
            add_action('init', array($this, 'wpSrpScript'));
            add_action('admin_menu', array($this, 'wpSrp_Wp_Schema_menu'));
            add_action('plugins_loaded', array($this, 'wpSrp_pluginInit'));
            add_action('wp_ajax_wpSrpSchemaSettings', array($this, 'wpSrpSchemaSettings'));
            add_action('wp_ajax_wpSrpMainSettings_action', array($this, 'wpSrpMainSettings_action'));
            add_action('wp_ajax_newSocial', array($this, 'newSocial'));
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

            // for MU Site
            add_action('activated_plugin', array($this, 'update_queue'), 10, 2);
            add_action('deactivated_plugin', array($this, 'update_queue'), 10, 2);

            register_activation_hook(WP_SRP_SCHEMA_PLUGIN_ACTIVE_FILE_NAME, array($this, 'activePlugin'));
//	        register_deactivation_hook(WP_SRP_SCHEMA_PLUGIN_ACTIVE_FILE_NAME, array($this, 'uninstall'));
            // Uninstall hook

            add_filter('plugin_action_links_' . WP_SRP_SCHEMA_PLUGIN_ACTIVE_FILE_NAME,
                array($this, 'schema_marketing'));

        }

        function schema_marketing($links)
        {
            $links[] = '<a target="_blank" href="' . esc_url('http://wordpressplugins-store.com/') . '">' . __("Documentation", "wp-srp-schema-for-dynamic-url") . '</a>';
            $links[] = '<a target="_blank" href="' . esc_url('http://wordpressplugins-store.com') . '">' . __("Get Pro", "wp-srp-rating-schema") . '</a>';
            return $links;
        }


        function update_queue($plugin, $network_wide = null)
        {
            if (!$network_wide) {
                return;
            }
            list($action) = explode('_', current_filter(), 2);

            $action = str_replace('activated', 'activate', $action);
            $queue = get_site_option("network_{$action}_queue", array());

            $queue[$plugin] = (has_filter($action . '_' . $plugin) || has_filter($action . '_plugin'));
            update_site_option("network_{$action}_queue", $queue);
        }

        function admin_enqueue_scripts()
        {
            global $pagenow;
            // validate page
            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
            if ($pagenow == 'admin.php' && ($page == 'wp-srp-schema' || $page == 'wp-srp-schema-settings')) {
                // scripts
                wp_enqueue_media();
                wp_enqueue_script(array(
                    'jquery',
                    'wpsrp-datepicker',
                    'wpsrp-select2-js',
                    'wpsrp-tooltip-js',
                    'wpsrp-admin-js',
                ));

                // styles
                wp_enqueue_style(array(
                    'wpsrp-datepicker',
                    'wpsrp-select2-css',
                    'wpsrp-tooltip-css',
                    'wpsrp-admin-css',
                ));
            }
        }

        function wpSrpScript()
        {
            global $WpSrpSchema;
            // register team scripts and styles
            $scripts = array();
            $styles = array();
            if (is_admin()) {


                $scripts[] = array(
                    'handle' => 'wpsrp-select2-js',
                    'src'    => $WpSrpSchema->assetsUrl . 'js/select2.min.js',
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $scripts[] = array(
                    'handle' => 'wpsrp-tooltip-js',
                    'src'    => $WpSrpSchema->assetsUrl . 'js/jquery.qtip.js',
                    'deps'   => array('jquery'),
                    'footer' => true
                );

                $scripts[] = array(
                    'handle' => 'wpsrp-datepicker',
                    'src'    => $WpSrpSchema->assetsUrl . 'vendor/bootstrap-datepicker/bootstrap-datepicker.min.js',
                    'deps'   => array('jquery'),
                    'footer' => false
                );
                $scripts[] = array(
                    'handle' => 'wpsrp-admin-js',
                    'src'    => $WpSrpSchema->assetsUrl . 'js/admin.js',
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $styles['wpsrp-datepicker'] = $WpSrpSchema->assetsUrl . 'vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css';
                $styles['wpsrp-select2-css'] = $WpSrpSchema->assetsUrl . 'css/select2.min.css';
                $styles['wpsrp-tooltip-css'] = $WpSrpSchema->assetsUrl . 'css/jquery.qtip.css';
                $styles['wpsrp-admin-css'] = $WpSrpSchema->assetsUrl . 'css/admin.css';
            }
            foreach ($scripts as $script) {
                wp_register_script($script['handle'], $script['src'], $script['deps'], time(),
                    $script['footer']); //$WpSrpSchema->options['version']
            }
            foreach ($styles as $k => $v) {
                wp_register_style($k, $v, false, $WpSrpSchema->options['version']);
            }
        }

        function newSocial()
        {
            $schemaModel = new WP_SRP_Schema_Model;
            $id = ($_REQUEST['id'] ? $_REQUEST['id'] + 1 : 0);
            $html = null;
            $html = "<div class='sfield'>";
            $html .= "<select name='social[$id][id]'>";
            foreach ($schemaModel->socialList() as $skey => $social) {
                $html .= "<option value='$skey'>$social</option>";
            }
            $html .= "</select>";
            $html .= "<input type='text' name='social[$id][link]'>";
            $html .= '<span class="dashicons dashicons-trash social-remove"></span>';
            $html .= "</div>";


            wp_send_json(array('data' => $html));
            die();
        }

        function wpSrpSchemaSettings()
        {
			//echo "conytroller";
            global $WpSrpSchema;
            $error = true;
            $msg = null;
            if ($WpSrpSchema->verifyNonce()) {
                unset($_REQUEST['action']);
                update_option($WpSrpSchema->options['settings'], $_REQUEST);
                $error = false;
                $msg = __('Settings successfully updated', WP_SRP_SCHEMA_SLUG);
            } else {
                $msg = __('Security Error !!', WP_SRP_SCHEMA_SLUG);
            }
            $response = array(
                'error' => $error,
                'msg'   => $msg
            );
            wp_send_json($response);
            die();
        }

        function wpSrpMainSettings_action()
        {
            global $WpSrpSchema;
            $error = true;
            $msg = null;
            if ($WpSrpSchema->verifyNonce()) {
                unset($_REQUEST['action']);
                unset($_REQUEST['_wpsrp_nonce']);
                unset($_REQUEST['_wp_http_referer']);
                update_option($WpSrpSchema->options['main_settings'], $_REQUEST);
                $error = false;
                $msg = __('Settings successfully updated', WP_SRP_SCHEMA_SLUG);
            } else {
                $msg = __('Security Error !!', WP_SRP_SCHEMA_SLUG);
            }
            $response = array(
                'error' => $error,
                'msg'   => $msg
            );
            wp_send_json($response);
            die();
        }

        function wp_schema_page()
        {
            global $WpSrpSchema;
            $WpSrpSchema->render('schema-options');
        }

        function wp_schema_setting_page()
        {
            global $WpSrpSchema;
            $WpSrpSchema->render('settings');
        }

        function wpSrp_Wp_Schema_menu()
        {
			
            global $WpSrpSchema;
            add_menu_page(__('WP Star Rating ', "wp-srp-schema-for-dynamic-url"), __('WP Star Rating ', "wp-srp-schema-for-dynamic-url"), 'manage_options', 'wp-srp-schema',
			  array($this, 'wp_schema_page'),'dashicons-pressthis',100);
               // array($this, 'wp_schema_page'), $WpSrpSchema->assetsUrl . 'images/wp-srp-schema.png');
          
				
	       	
              /*   add_submenu_page('wp-srp-schema', __('WP SEO View Meta Generator', "wp-srp-schema-for-dynamic-url"), __('View all Meta', "wp-srp-schema-for-dynamic-url"), 'manage_options',
                'dynamic_url_seo_listing_page',
                array($this, 'dus_list_page'));
			   
			
		   
		      add_submenu_page('wp-srp-schema', __('WP SEO  Add Meta Content', "wp-srp-schema-for-dynamic-url"), __('Add Meta', "wp-srp-schema-for-dynamic-url"), 'manage_options',
                'dynamic_url_seo_add_new',
                array($this, 'dus_add_new_callback'));
				
				 add_submenu_page('wp-srp-schema', __('WP SEO  Meta Generator', "wp-srp-schema-for-dynamic-url"), __('Add Business/Org', "wp-srp-schema-for-dynamic-url"), 'manage_options',
                'dynamic_url_seo_schema_markup',
                array($this, 'add_martkup_meta')); */
	              add_submenu_page('wp-srp-schema', __('WP SEO Schema settings', "wp-srp-schema-for-dynamic-url"), __('Settings', "wp-srp-schema-for-dynamic-url"), 'manage_options',
                'wp-srp-schema-settings',
                array($this, 'wp_schema_setting_page'));
   		
				

        }
 
	
	
       function wpSrp_pluginInit()
        {
       //     load_plugin_textdomain(WP_SRP_SCHEMA_SLUG, false, WP_SRP_SCHEMA_LANGUAGE_PATH);
	    load_plugin_textdomain(WP_SRP_SCHEMA_SLUG, false);
            $this->updateVariableAndFixIssue();
        }

        function activePlugin()
        {
            $this->updateVariableAndFixIssue();
        }

        function updateVariableAndFixIssue()
        {
            global $WpSrpSchema;
            $WpSrpSchema->fix1_2DataMigration();
            update_option($WpSrpSchema->options['installed_version'], $WpSrpSchema->options['version']);
        }

    }
endif;