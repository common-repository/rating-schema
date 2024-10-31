<?php
/**
 * Plugin Name: Free Wp Google Star Rating Plugin
 * Plugin URI: https://webnox.in/wordpressplugins-store.com/
 * Description:  Best Wordpress rating schema . can get better result within two days from search engine.
 * Version: 1.0
 * Author: Webnox
 * Author URI: https://webnox.in/webnoxteam/
 *Author Email: contact@webnox.in
 * License: Webnox team approved. GPL2
 * Text Domain:  wp-srp-rating-schema
 */
if (!defined('ABSPATH')) {
    exit;
}
if (!defined('JSON_UNESCAPED_SLASHES'))
    define('JSON_UNESCAPED_SLASHES', 64);
if (!defined('JSON_PRETTY_PRINT'))
    define('JSON_PRETTY_PRINT', 128);
if (!defined('JSON_UNESCAPED_UNICODE'))
    define('JSON_UNESCAPED_UNICODE', 256);


$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
define('WP_SRP_SCHEMA_VERSION', $plugin_data['Version']);
define('WP_SRP_SCHEMA_SLUG', 'wp-srp-rating-schema');
define('WP_SRP_SCHEMA_PATH', dirname(__FILE__));
define('WP_SRP_SCHEMA_PLUGIN_ACTIVE_FILE_NAME', plugin_basename(__FILE__));
define('WP_SRP_SCHEMA_URL', plugins_url('', __FILE__));

define('WP_SRP_META_URL',plugins_url('',__FILE__) .'/includes/');

//echo "****************** ".WP_SRP_META_URL;
require('includes/main.php');

register_uninstall_hook(__FILE__, 'WP_SRP_uninstall');

function WP_SRP_uninstall()
{
    global $WpSrpSchema;
    $settings = get_option($WpSrpSchema->options['main_settings']);
    if (!empty($settings['delete-data'])) {
        $schemas = new WP_SRP_Schema_Model;
        $schemaFields = $schemas->schemaTypes();

        $args = array(
            'post_type'      => array('page', 'post'),
            'posts_per_page' => '-1'
        );
        $pages = new WP_Query ($args);
        if ($pages->have_posts()) {

            while ($pages->have_posts()) {
                $pages->the_post();
                foreach ($schemaFields as $schemaID => $schema) {
                    delete_post_meta(get_the_ID(), '_schema_' . $schemaID);
                }
            }
            wp_reset_postdata();
        }
    }

}