<?php
global $WpSrpSchema;
$settings = get_option($WpSrpSchema->options['settings']);
$schemaModel = new WP_SRP_Schema_Model;
?>
<div class="wrap">
    <h2><?php _e('WP SRP Schema ', "wp-srp-rating-schema"); ?></h2>

    <div id="wpsrp-settings">
        <div id="wpsrp-options">
		<h3><?php _e(' WP SRP Schema All Post/Page  by <a href="http://webnox.in/wordpressplugins-store.com/">webnox.in/wp-plugins.com</a>', "wp-srp-rating-schema"); ?></h3>
            <form id="wpsrp-option-settings">

                
                <div class="setting-holder">
                    <table width="40%" cellpadding="10" class="form-table">
                        <tr class="default">
                            <th>Website Url <span class="required">*</span></th>
                            <td align="left" scope="row">
                                <div class="with-tooltip">
                                    <input type="text" class="regular-text" name="web_url"
                                           value="<?php echo(!empty($settings['web_url']) ? esc_attr($settings['web_url']) : get_home_url()); ?>"/>
                                    <div class="schema-tooltip-holder">
                                        <span class="schema-tooltip"></span>
                                        <div class="hidden">
                                            <p>
                                                <b>Tip:</b> <?php _e("For more detailed information on how to configure this plugin, please visit:", "wp-srp-rating-schema") ?>
                                                <a href="https://webnox.in/wordpressplugins-store.com">https://webnox.in/wordpressplugins-store.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Site Type", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <select id="site_type" name="site_type" class="select2">
                                    <option value=""><?php _e("Select one type", "wp-srp-rating-schema") ?></option>
                                    <?php
                                    $siteType = !empty($settings['site_type']) ? $settings['site_type'] : null;

                                    foreach ($schemaModel->site_type() as $key => $site) {
                                        if (is_array($site)) {
                                            $slt = ($key == $siteType ? "selected" : null);
                                            echo "<option value='$key' $slt>&nbsp;&nbsp;&nbsp;$key</option>";
                                            foreach ($site as $inKey => $inSite) {
                                                if (is_array($inSite)) {
                                                    $slt = ($inKey == $siteType ? "selected" : null);
                                                    echo "<option value='$inKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inKey</option>";
                                                    foreach ($inSite as $inInKey => $inInSite) {
                                                        if (is_array($inInSite)) {
                                                            $slt = ($inInKey == $siteType ? "selected" : null);
                                                            echo "<option value='$inInKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInKey</option>";
                                                            foreach ($inInSite as $iSite) {
                                                                $slt = ($iSite == $siteType ? "selected" : null);
                                                                echo "<option value='$iSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iSite</option>";
                                                            }
                                                        } else {
                                                            $slt = ($inInSite == $siteType ? "selected" : null);
                                                            echo "<option value='$inInSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInSite</option>";
                                                        }
                                                    }
                                                } else {
                                                    $slt = ($inSite == $siteType ? "selected" : null);
                                                    echo "<option value='$inSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inSite</option>";
                                                }
                                            }
                                        } else {
                                            $slt = ($site == $siteType ? "selected" : null);
                                            echo "<option value='$site' $slt>$site</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Organization or Business name", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="type_name"
                                       value="<?php echo(!empty($settings['type_name']) ? $settings['type_name'] : null); ?>"/>
                            </td>
                        </tr>
                        <tr class="default all-type-data">
                            <th><?php _e("Site Image", "wp-srp-rating-schema") ?> <span
                                        class="required">*</span></th>
                            <td align="left" scope="row">
                                <div class="WpSrp-image">
                                    <div class="WpSrp-image-wrapper">
                                        <?php
                                        $siteImageId = !empty($settings['site_image']) ? absint($settings['site_image']) : 0;
                                        $siteImage = $ingInfo = null;
                                        if ($siteImageId) {
                                            $siteImage = wp_get_attachment_image($siteImageId, "thumbnail");
                                            $imgData = $WpSrpSchema->imageInfo($siteImageId);
                                            $ingInfo .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
                                            $ingInfo .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
                                            $ingInfo .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
                                        }
                                        ?>
                                        <span class="WpSrpImgAdd"><span
                                                    class="dashicons dashicons-plus-alt"></span></span>
                                        <span class="WpSrpImgRemove <?php echo($siteImageId ? null : "WpSrp-hidden"); ?>"><span
                                                    class="dashicons dashicons-trash"></span></span>
                                        <div class="WpSrp-image-preview"><?php echo $siteImage; ?></div>
                                        <input type="hidden" name="site_image" value="<?php echo $siteImageId; ?>"/>
                                    </div>
                                    <div class='image-info'><?php echo $ingInfo; ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="default all-type-data">
                            <th><?php _e("Price Range", "wp-srp-rating-schema") ?> <span
                                        class="required">*</span></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="site_price_range"
                                       value="<?php echo(!empty($settings['site_price_range']) ? $settings['site_price_range'] : null); ?>"/>
                                <div class="description"><?php _e("The price range of the business, for example $$$.", "wp-srp-rating-schema") ?></div>
                            </td>
                        </tr>
                        <tr class="default all-type-data">
                            <th><?php _e("Site Telephone", "wp-srp-rating-schema") ?> <span
                                        class="required">*</span></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="site_telephone"
                                       value="<?php echo(!empty($settings['site_telephone']) ? $settings['site_telephone'] : null); ?>"/>
                                <div class="description"><?php _e("The telephone number.", "wp-srp-rating-schema") ?></div>
                            </td>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Additional Type", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <div class="with-tooltip">
                                    <textarea name="additionalType"
                                              placeholder="http://example1.com&#10;http://example2.com&#10;http://example3.com"
                                              rows="6" cols="50"
                                              class="additional-type"><?php echo(!empty($settings['additionalType']) ? esc_attr(@$settings['additionalType']) : null); ?></textarea>
                                    <p class="description"><?php _e('Add "Additional Type"', "wp-srp-rating-schema") ?></p>
                                    <div class="schema-tooltip-holder">
                                        <span class="schema-tooltip"></span>
                                        <div class="hidden">
                                            <p><b>Tip:</b> <?php _e("Product Ontology is an extension to schema using WikiPedia definitions that enables you to further define a type by adding an \"AdditionalType” attribute.Example for a Tailor (which is not available
                                                as a schema “Type”): Pick LocalBusiness as a generic Type, then add additional type as follows:", "wp-srp-rating-schema") ?>
                                                <a href="https://en.wikipedia.org/wiki/Tailor">https://en.wikipedia.org/wiki/<span>Tailor</span></a>
                                                Change to this format and enter in Additional Type field:
                                                <a href="http://www.productontology.org/id/Tailor">http://www.productontology.org/id/<span>Tailor</span></a>
                                                For more info visit:<a
                                                        href="https://wpsrpplugins.com/product-ontology-schema/">https://wpsrpplugins.com/product-ontology-schema/</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="default restaurant">
                            <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e("Restaurant Information", "wp-srp-rating-schema") ?></th>
                        </tr>
                        <tr class="default restaurant">
                            <th><?php _e("The cuisine of the restaurant.", "wp-srp-rating-schema") ?> <span
                                        class="required">*</span></th>
                            <td align="left" scope="row">
                                <textarea cols="50" rows="6"
                                          name="restaurant[servesCuisine]"><?php echo(!empty($settings['restaurant']['servesCuisine']) ? esc_attr($settings['restaurant']['servesCuisine']) : null); ?></textarea>
                            </td>
                        </tr>
                        <tr class="default business-info">
                            <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e("Others local business info", "wp-srp-rating-schema") ?></th>
                        </tr>
                        <tr class="default business-info">
                            <th><?php _e("Description", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <textarea cols="50" rows="6"
                                          name="business_info[description]"><?php echo(!empty($settings['business_info']['description']) ? esc_attr($settings['business_info']['description']) : null); ?></textarea>
                            </td>
                        </tr>
                        <tr class="default business-info">
                            <th><?php _e("Operation Hours", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <div class="with-tooltip">
                                    <textarea name="business_info[openingHours]"
                                              placeholder="Mo-Sa 11:00-14:30&#10;Mo-Th 17:00-21:30&#10;Fr-Sa 17:00-22:00"
                                              rows="4" cols="50"
                                              class="additional-type"><?php echo(!empty($settings['business_info']['openingHours']) ? esc_attr($settings['business_info']['openingHours']) : null); ?></textarea>
                                    <p class="description">- Days are specified using the following two-letter
                                        combinations: Mo,
                                        Tu, We, Th, Fr, Sa, Su.</br>
                                        - Times are specified using 24:00 time. For example, 3pm is specified as 15:00.
                                        <br>
                                        - Add Opening Hours by separate line</p>
                                    <div class="schema-tooltip-holder">
                                        <span class="schema-tooltip"></span>
                                        <div class="hidden">
                                            <p>
                                                <b>Tip:</b> Once you save these structured data schema settings,
                                                validate your
                                                home page url here:
                                                <a href="https://developers.google.com/structured-data/testing-tool/">https://developers.google.com/structured-data/testing-tool/</a>
                                            </p>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                        <tr class="default business-info">
                            <th style="font-size: 16px;"><?php _e("GeoCoordinates", "wp-srp-rating-schema") ?></th>
                        </tr>
                        <tr class="default business-info">
                            <th style="text-align: right"><?php _e("Latitude", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="business_info[latitude]"
                                       value="<?php echo(!empty($settings['business_info']['latitude']) ? esc_attr($settings['business_info']['latitude']) : null); ?>"/>
                            </td>
                        </tr>
                        <tr class="default business-info">
                            <th style="text-align: right"><?php _e("Longitude", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="business_info[longitude]"
                                       value="<?php echo(!empty($settings['business_info']['longitude']) ? esc_attr($settings['business_info']['longitude']) : null); ?>"/>
                            </td>
                        </tr>
                        <tr class="default person">
                            <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e("Person", "wp-srp-rating-schema") ?></th>
                        </tr>
                        <tr class="default person">
                            <th><?php _e("Name", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="person[name]"
                                       value="<?php echo(!empty($settings['person']['name']) ? esc_attr($settings['person']['name']) : null); ?>"/>
                            </td>
                        </tr>
                        <tr class="default person">
                            <th><?php _e("Work For", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="person[worksFor]"
                                       value="<?php echo(!empty($settings['person']['worksFor']) ? esc_attr($settings['person']['worksFor']) : null); ?>"/>

                            </td>
                        </tr>
                        <tr class="default person">
                            <th><?php _e("Job Title", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="person[jobTitle]"
                                       value="<?php echo(@$settings['person']['jobTitle'] ? @$settings['person']['jobTitle'] : null); ?>"/>

                            </td>
                        </tr>
                        <tr class="default person">
                            <th><?php _e("Image", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="person[image]"
                                       value="<?php echo(!empty($settings['person']['image']) ? esc_attr($settings['person']['image']) : null); ?>"/>
                                <p class="description"><?php _e("Add your personal photo here", "wp-srp-rating-schema") ?></p>
                            </td>
                        </tr>
                        <tr class="default person">
                            <th><?php _e("Description", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="person[description]"
                                       value="<?php echo(!empty($settings['person']['description']) ? esc_attr($settings['person']['description']) : null); ?>"/>
                            </td>
                        </tr>
                        <tr class="default person">
                            <th><?php _e("Birth date", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text wpsrp-date" name="person[birthDate]"
                                       value="<?php echo(!empty($settings['person']['birthDate']) ? esc_attr($settings['person']['birthDate']) : null); ?>"/>

                            </td>
                        </tr>
                        <tr class="default">
                            <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e("Address", "wp-srp-rating-schema") ?></th>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Address Country", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <select class="select2" name="address[country]">
                                    <option value="">Select a country</option>
                                    <?php
                                    $aCountry = !empty($settings['address']['country']) ? $settings['address']['country'] : null;
                                    foreach ($schemaModel->countryList() as $country) {
                                        $slt = ($country == $aCountry ? "selected" : null);
                                        echo "<option value='$country' $slt>$country</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Address Locality", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="address[locality]"
                                       value="<?php echo(!empty($settings['address']['locality']) ? esc_attr($settings['address']['locality']) : null); ?>"/>
                                <p class="description">City (i.e Coimbatore)</p>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Address Region", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="address[region]"
                                       value="<?php echo(!empty($settings['address']['region']) ? esc_attr($settings['address']['region']) : null); ?>"/>
                                <p class="description">State (i.e. TN,Kerala)</p>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Postal Code", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="address[postalcode]"
                                       value="<?php echo(!empty($settings['address']['postalcode']) ? esc_attr($settings['address']['postalcode']) : null); ?>"/>
                        </tr>
                        <tr class="default">
                            <th><?php _e("Street Address", "wp-srp-rating-schema") ?></th>
                            <td align="left" scope="row">
                                <input type="text" class="regular-text" name="address[street]"
                                       value="<?php echo(!empty($settings['address']['street']) ? esc_attr($settings['address']['street']) : null); ?>"/>
                        </tr>
                    </table>
                </div>
                <div id="tabs-wpsrp-container" class="rt-tab-container">
                    <ul class="rt-tab-nav">
                        <li class="current"><a
                                    href="#tab-logo-url"><?php _e("Organization Logo", "wp-srp-rating-schema") ?></a>
                        </li>
                        <li><a href="#tab-social-profile"><?php _e("Social Profile", "wp-srp-rating-schema") ?></a></li>
                        <li><a href="#tab-corporate-contract"><?php _e("Corporate Contacts", "wp-srp-rating-schema") ?></a></li>
                    </ul>
                    <div id="tab-logo-url" class="rt-tab-content">
                        <table width="100%" cellpadding="10" class="form-table">
                            <tr class="field_logo">
                                <th><?php _e("Select Organization Logo", "wp-srp-rating-schema") ?></th>
                                <td scope="row" style="position: relative">
                                    <div class="WpSrp-image">
                                        <div class="WpSrp-image-wrapper">
                                            <?php
                                            $organizationLogoId = !empty($settings['organization_logo']) ? absint($settings['organization_logo']) : null;
                                            $organizeImage = $imgInfo = null;
                                            if ($organizationLogoId) {
                                                $organizeImage = wp_get_attachment_image($organizationLogoId, "thumbnail");
                                                $imgData = $WpSrpSchema->imageInfo($organizationLogoId);
                                                $imgInfo .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
                                                $imgInfo .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
                                                $imgInfo .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
                                            }
                                            ?>
                                            <span class="WpSrpImgAdd"><span class="dashicons dashicons-plus-alt"></span></span>
                                            <span
                                                    class="WpSrpImgRemove <?php echo($organizationLogoId ? null : "WpSrp-hidden"); ?>"><span
                                                        class="dashicons dashicons-trash"></span></span>
                                            <div class="WpSrp-image-preview"><?php echo $organizeImage; ?></div>
                                            <input type="hidden" name="organization_logo"
                                                   value="<?php echo $organizationLogoId; ?>"/>
                                        </div>
                                        <div class='image-info'><?php echo $imgInfo; ?></div>
                                    </div>
                                    <div class="schema-tooltip-holder" style="left: 200px">
                                        <span class="schema-tooltip"></span>
                                        <div class="hidden">
                                            <p><b>Tip:</b> For some Rich Snippets that use the image property, no
                                                dimensions are specified, For other Rich Snippets that use the image
                                                property, Google specifies at least 160x90 pixels and at most 1920x1080
                                                pixels. For Google Search, the documentation for their Rich Snippets is
                                                at
                                                <a href="https://developers.google.com/structured-data/rich-snippets/.">https://developers.google.com/structured-data/rich-snippets/.</a>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tab-social-profile" class="rt-tab-content">
                        <table width="100%" cellpadding="10" class="form-table">
                            <tr class="field_social">
                                <th><?php _e("Company Name", "wp-srp-rating-schema") ?></th>
                                <td align="left" scope="row">
                                    <input type="text" class="regular-text" name="social_company_name"
                                           value="<?php echo(!empty($settings['social_company_name']) ? esc_attr($settings['social_company_name']) : null); ?>"/>
                                </td>
                            </tr>
                            <tr class="field_social_title">
                                <th style="font-size: 18px; padding: 10px 0;"><?php _e("Social Profiles", "wp-srp-rating-schema") ?></th>
                            </tr>
                            <tr class="social_field_link">
                                <th><?php _e("Social Profile", "wp-srp-rating-schema") ?></th>
                                <th>
                                    <div id="social-field-holder">
                                        <?php
                                        $socialP = (!empty($settings['social']) ? $settings['social'] : array());
                                        if (is_array($socialP) && !empty($socialP)) {
                                            $html = null;
                                            $i = 0;
                                            foreach ($socialP as $socialD) {
                                                $html .= "<div class='sfield'>";
                                                $html .= "<select name='social[$i][id]'>";
                                                foreach ($schemaModel->socialList() as $sId => $social) {
                                                    $slt = ($sId == $socialD['id'] ? "selected" : null);
                                                    $html .= "<option value='$sId' $slt>$social</option>";
                                                }
                                                $html .= "</select>";
                                                $html .= "<input type='text' name='social[$i][link]' value='{$socialD['link']}'>";
                                                $html .= '<span class="dashicons dashicons-trash social-remove"></span>';
                                                $html .= "</div>";
                                                $i++;
                                            }
                                            echo $html;
                                        }
                                        ?>
                                    </div>
                                    <a class="button button-primary add-new" id="social-add"><?php _e("Add Social Profile", "wp-srp-rating-schema") ?></a>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div id="tab-corporate-contract" class="rt-tab-content">
                        <table width="100%" cellpadding="10" class="form-table">
                            <tr class="field_contact">
                                <th style="font-size: 18px; padding: 10px 0;"><?php _e("Contacts", "wp-srp-rating-schema") ?></th>
                            </tr>
                            <tr class="field_contact">
                                <th>Contact Type</th>
                                <td scope="row">
                                    <select name="contact[contactType]" class="select2" style="width: 200px">
                                        <?php
                                        $contactType = !empty($settings['contact']['contactType']) ? $settings['contact']['contactType'] : null;
                                        foreach ($schemaModel->contactType() as $cType) {
                                            $slt = ($cType == $contactType ? "selected" : null);
                                            echo "<option value='$cType' $slt>$cType</option>";
                                        }

                                        ?>
                                    </select>
                                </td>

                            </tr>
                            <tr class="field_contact">
                                <th><?php _e("Contact Phone", "wp-srp-rating-schema") ?></th>
                                <td align="left" scope="row">
                                    <input type="text" class="regular-text" name="contact[telephone]"
                                           value="<?php echo(!empty($settings['contact']['telephone']) ? esc_attr($settings['contact']['telephone']) : null); ?>"/>
                                    <p class="description kco-telephone"><?php _e("Please follow the format below", "wp-srp-rating-schema") ?><span
                                                style="font-size: 11px;">+1-505-998-3793</span><span
                                                style="font-size: 11px;">+(Country Code) 425 123-4567</span><span
                                                style="font-size: 11px;">+(Country Code) 42 68 53 01</span><span
                                                style="font-size: 11px;">+44-2078225951</span><span
                                                style="font-size: 11px;">1 (855) 469-6378</span>
                                    </p>
                                </td>
                            </tr>
                            <tr class="field_contact">
                                <th><?php _e("Contact Email", "wp-srp-rating-schema") ?></th>
                                <td align="left" scope="row">
                                    <input type="text" class="regular-text" name="contact[email]"
                                           value="<?php echo(!empty($settings['contact']['email']) ? sanitize_email($settings['contact']['email']) : null); ?>"/>
                                </td>
                            </tr>
                            <tr class="field_contact">
                                <th><?php _e("Contact Option", "wp-srp-rating-schema") ?></th>
                                <td align="left" scope="row">
                                    <select name="contact[contactOption]" class="select2 withEmptyOption"
                                            style="width: 200px">
                                        <option value=""><?php _e("Select an option", "wp-srp-rating-schema") ?></option>
                                        <option value="TollFree" <?php
                                        $cPtOpt = !empty($settings['contact']['contactOption']) ? $settings['contact']['contactOption'] : null;
                                        echo($cPtOpt == "TollFree" ? "selected" : null); ?>><?php _e("TollFree", "wp-srp-rating-schema") ?>
                                        </option>
                                        <option
                                                value="HearingImpairedSupported" <?php echo($settings['contact']['contactOption'] == "HearingImpairedSupported" ? "selected" : null); ?>>
                                            <?php _e("HearingImpairedSupported", "wp-srp-rating-schema") ?>
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="field_contact">
                                <th><?php _e("Area Served", "wp-srp-rating-schema") ?></th>
                                <td align="left" scope="row">
                                    <div class="area_served_wrapper">
                                        <select id="area_served" class="select2" name="area_served[]"
                                                multiple="multiple"
                                                style="width: 50%">
                                            <?php
                                            $areaServed = !empty($settings['area_served']) ? $settings['area_served'] : array();
                                            foreach ($schemaModel->countryList() as $country) {
                                                $slt = (in_array($country, $areaServed) ? "selected" : null);
                                                echo "<option value='$country' $slt>$country</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr class="field_contact">
                                <th><?php _e("Available language", "wp-srp-rating-schema") ?></th>
                                <td scope="row" class="lang">
                                    <select class="select2" name="availableLanguage[]" style="width: 50%"
                                            multiple="multiple">
                                        <?php
                                        $lanAvailable = !empty($settings['availableLanguage']) ? $settings['availableLanguage'] : array();
                                        foreach ($schemaModel->languageList() as $language) {
                                            $slt = (in_array($language, $lanAvailable) ? "selected" : null);
                                            echo "<option value='$language' $slt>$language</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h2><?php _e("Site Name in Search Results", "wp-srp-rating-schema") ?></h2>
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="default">
                        <th><?php _e("Enable Site link Search Box", "wp-srp-rating-schema") ?></th>
                        <td align="left" scope="row">
                            <input type="checkbox"
                                   name="homeonly" <?php echo(!empty($settings['homeonly']) ? "checked" : null); ?>
                                   value="1"/>
                        </td>
                    </tr>
                    <tr class="default">
                        <th><?php _e("Site Name:", "wp-srp-rating-schema") ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="sitename"
                                   value="<?php echo(!empty($settings['sitename']) ? esc_attr($settings['sitename']) : null); ?>"/>
                        </td>
                    </tr>
                    <tr class="default">
                        <th><?php _e("Site Alternative Name:", "wp-srp-rating-schema") ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="siteaname"
                                   value="<?php echo(!empty($settings['siteaname']) ? esc_attr($settings['siteaname']) : null); ?>"/>
                        </td>
                    </tr>
                    <tr class="default">
                        <th><?php _e("Site Url:", "wp-srp-rating-schema") ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="siteurl"
                                   value="<?php echo(!empty($settings['siteurl']) ? esc_attr($settings['siteurl']) : get_home_url()); ?>"/>
                        </td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary"
                                         value="<?php _e('Save Changes', "wp-srp-rating-schema"); ?>"></p>

                <?php wp_nonce_field($WpSrpSchema->nonceText(), '_wpsrp_nonce'); ?>
            </form>
            <div id="response"></div>
        </div>
       <!-- <div class='wpsrp-get-pro'>
            <h3><?php _e("Pro Version Features", "wp-srp-rating-schema") ?></h3>
            <ol>
                <li><?php _e("Includes Auto-fill function <---Popular", "wp-srp-rating-schema") ?></li>
                <li><?php _e("Supports Custom Post Types beyond default page and posts", "wp-srp-rating-schema") ?></li>
                <li><?php _e("Supports WordPress Multisite", "wp-srp-rating-schema") ?></li>
                <li><?php _e("Supports more schema types:", "wp-srp-rating-schema") ?>
                    <ol>
                        <li><?php _e("Books", "wp-srp-rating-schema") ?></li>
                        <li><?php _e("Courses", "wp-srp-rating-schema") ?></li>
                        <li><?php _e("Job Postings", "wp-srp-rating-schema") ?></li>
                        <li><?php _e("Movies", "wp-srp-rating-schema") ?></li>
                        <li><?php _e("Music", "wp-srp-rating-schema") ?></li>
                        <li><?php _e("Recipe", "wp-srp-rating-schema") ?></li>
                        <li><?php _e("TV Episode", "wp-srp-rating-schema") ?></li>
                    </ol>
                </li>
            </ol>
            <div class="wpsrp-pro-action"><a class='button button-primary'
                                          href='https://wpsrpplugins.com/downloads/wordpress-schema-plugin/'
                                          target='_blank'><?php _e("Get the Pro Version", "wp-srp-rating-schema") ?></a>
            </div>
        </div> -->
    </div>
</div>
