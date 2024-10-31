<?php
global $WpSrpSchema;
$settings = get_option($WpSrpSchema->options['main_settings']);
?>
<div class="wrap">
    <h2><?php _e('Schema Settings', "wp-srp-schema-for-dynamic-url"); ?></h2>

    <div id="wpsrp-settings">
        <div id="wpsrp-options">
            <form id="wpsrp-main-settings">
                <table width="40%" cellpadding="10" class="form-table">
                    <tr class="default">
                        <th><?php _e("Business / Org Schema", "wp-srp-schema-for-dynamic-url") ?></th>
                        <td align="left" scope="row">
                            <?php $dd = !empty($settings['site_schema']) ? $settings['site_schema'] : 'home_page'; ?>
                            <input type="radio" <?php echo($dd == 'home_page' ? 'checked' : null); ?> name="site_schema"
                                   value="home_page" id="site_schema_home"><label for="site_schema_home"><?php _e("Home page
                                only", "wp-srp-schema-for-dynamic-url") ?></label><br>
                            <input type="radio" <?php echo($dd == 'all' ? 'checked' : null); ?> name="site_schema"
                                   value="all"
                                   id="site_schema_all"><label for="site_schema_all"><?php _e("Sitewide (Apply General Settings schema
                                sitewide)", "wp-srp-schema-for-dynamic-url") ?></label><br>
                            <input type="radio" <?php echo($dd == 'off' ? 'checked' : null); ?> name="site_schema"
                                   value="off"
                                   id="site_schema_off"><label
                                    for="site_schema_off"><?php _e("Turn off (Turn off global schema)", "wp-srp-schema-for-dynamic-url") ?></label>
                        </td>
                    </tr>
                    <tr class="default">
                        <th><?php _e("Delete all data", "wp-srp-schema-for-dynamic-url") ?></th>
                        <td align="left" scope="row">
                            <?php $dd = !empty($settings['delete-data']) ? "checked" : null; ?>
                            <input type="checkbox" <?php echo $dd; ?> name="delete-data" value="1"
                                   id="delete-data"><label
                                    for="delete-data"><?php _e("Enable", "wp-srp-schema-for-dynamic-url") ?></label>
                            <p class="description"><?php _e("This will delete all schema created and applied by this plugin when plugin is
                                deleted.", "wp-srp-schema-for-dynamic-url") ?></p>
                        </td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary"
                                         value="<?php _e('Save Changes', "wp-srp-schema-for-dynamic-url"); ?>"></p>

                <?php wp_nonce_field($WpSrpSchema->nonceText(), '_wpsrp_nonce'); ?>
            </form>
            <div id="response"></div>
        </div>
      <!--  <div class='wpsrp-get-pro'>
            <h3><?php _e("Pro Version Features", "wp-srp-schema-for-dynamic-url") ?></h3>
            <ol>
                <li><?php _e("Includes Auto-fill function <---Popular", "wp-srp-schema-for-dynamic-url") ?></li>
                <li><?php _e("Supports Custom Post Types beyond default page and posts", "wp-srp-schema-for-dynamic-url") ?></li>
                <li><?php _e("Supports WordPress Multisite", "wp-srp-schema-for-dynamic-url") ?></li>
                <li><?php _e("Supports more schema types:", "wp-srp-schema-for-dynamic-url") ?>
                    <ol>
                        <li><?php _e("Books", "wp-srp-schema-for-dynamic-url") ?></li>
                        <li><?php _e("Courses", "wp-srp-schema-for-dynamic-url") ?></li>
                        <li><?php _e("Job Postings", "wp-srp-schema-for-dynamic-url") ?></li>
                        <li><?php _e("Movies", "wp-srp-schema-for-dynamic-url") ?></li>
                        <li><?php _e("Music", "wp-srp-schema-for-dynamic-url") ?></li>
                        <li><?php _e("Recipe", "wp-srp-schema-for-dynamic-url") ?></li>
                        <li><?php _e("TV Episode", "wp-srp-schema-for-dynamic-url") ?></li>
                    </ol>
                </li>
            </ol>
            <div class="wpsrp-pro-action"><a class='button button-primary'
                                          href='https://wpsrpplugins.com/downloads/wordpress-schema-plugin/'
                                          target='_blank'><?php _e("Get the Pro Version", "wp-srp-schema-for-dynamic-url") ?></a>
            </div>
        </div>  -->
    </div>

</div>