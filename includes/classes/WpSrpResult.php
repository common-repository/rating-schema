<?php

if ( ! class_exists( 'WpSrpResult' ) ):

	class WpSrpResult {
		function __construct() {
			add_action( 'wp_footer', array( $this, 'footer' ), 1 );
			add_action( 'wpsrp_footer', array( $this, 'debug_mark' ), 2 );
			add_action( 'wpsrp_footer', array( $this, 'load_schema' ), 3 );
		}
  /*	private function is_premium(){
			return false;
		} */
		private function head_product_name() {
			
				return 'WP Star Rating Plugin';
			
		}
		public function debug_mark( $echo = true ) {
			$marker = sprintf(
				'<!-- Webnox Team Developed  a  ' . $this->head_product_name() . ' v%1$s - http://webnox.in/wordpressplugins-store.com/ -->',
				WP_SRP_SCHEMA_VERSION
			); 

			if ( $echo === false ) {
				return $marker;
			}
			else {
				echo "\n${marker}\n";
			}
		} 

		function footer(){

			global $wp_query;

			$old_wp_query = null;

			if ( ! $wp_query->is_main_query() ) {
				$old_wp_query = $wp_query;
				wp_reset_query();
			}
			wp_reset_postdata(); // TODO This is for wrong theme loop
			do_action( 'wpsrp_footer' );

			echo "\n<!-- / ", $this->head_product_name(), ". -->\n\n";

			if ( ! empty( $old_wp_query ) ) {
				$GLOBALS['wp_query'] = $old_wp_query;
				unset( $old_wp_query );
			}

			return;
		}

		function load_schema() {
			global $WpSrpSchema, $post;
			$schemaModel = new WP_SRP_Schema_Model;
			$html        = null;
			$settings    = get_option( $WpSrpSchema->options['settings'] );

			if ( is_home() || is_front_page() ) {
				$metaData = array();

				$metaData["@context"] = "http://schema.org/";
				$metaData["@type"]    = "WebSite";

				if ( ! empty( $settings['homeonly'] ) && $settings['homeonly']) {
					$author_url = ( ! empty( $settings['siteurl'] ) ? $settings['siteurl'] : get_home_url() );
					$to_remove  = array( 'http://', 'https://', 'www.' );
					foreach ( $to_remove as $item ) {
						$author_url = str_replace( $item, '', $author_url ); // to: www.example.com
					}
					$metaData["url"]           = $WpSrpSchema->sanitizeOutPut( $author_url, 'url' );
					$metaData["name"]          = ! empty( $settings['sitename'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['sitename'] ) : null;
					$metaData["alternateName"] = ! empty( $settings['siteaname'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['siteaname'] ) : null;
					$html .= $schemaModel->get_jsonEncode( $metaData );
				} else {
					$metaData["url"]             = get_home_url();
					$metaData["potentialAction"] = array(
						"@type"       => "SearchAction",
						"target"      => get_home_url() . "/?s={query}",
						"query-input" => "required name=query"
					);
					$html .= $schemaModel->get_jsonEncode( $metaData );
				}
			}
			$webMeta             = array();
			$webMeta["@context"] = "http://schema.org";
			$siteType            = ! empty( $settings['site_type'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['site_type'] ) : null;
			$webMeta["@type"]    = $siteType;
			if($siteType != "Organization"){
				if(! empty( $settings['site_image'] ) && $imgID = absint($settings['site_image'])){
					$image_url = wp_get_attachment_url( $imgID, 'full' );
					$webMeta["image"] = $WpSrpSchema->sanitizeOutPut( $image_url, 'url' );
				}else{
					$webMeta["image"] = null;
				}
				$webMeta["priceRange"] = ! empty( $settings['site_price_range'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['site_price_range'] ) : null;
				$webMeta["telephone"] = ! empty( $settings['site_telephone'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['site_telephone'] ) : null;
			}

			if ( ! empty( $settings['additionalType'] ) ) {
				$aType = explode( "\r\n", $settings['additionalType'] );
				if ( ! empty( $aType ) && is_array( $aType ) ) {
					if ( count( $aType ) == 1 ) {
						$webMeta["additionalType"] = $aType[0];
					} else if ( count( $aType ) > 1 ) {
						$webMeta["additionalType"] = $aType;
					}
				}
			}

			if ( $siteType == 'Person' ) {
				$webMeta["name"]        = ! empty( $settings['person']['name'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['person']['name'] ) : null;
				$webMeta["worksFor"]    = ! empty( $settings['person']['worksFor'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['person']['worksFor'] ) : null;
				$webMeta["jobTitle"]    = ! empty( $settings['person']['jobTitle'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['person']['jobTitle'] ) : null;
				$webMeta["image"]       = ! empty( $settings['person']['image'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['person']['image'], 'url' ) : null;
				$webMeta["description"] = ! empty( $settings['person']['description'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['person']['description'], 'textarea' ) : null;
				$webMeta["birthDate"]   = ! empty( $settings['person']['birthDate'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['person']['birthDate'] ) : null;
			} else {
				$webMeta["name"] = ! empty( $settings['type_name'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['type_name'] ) : null;
				if(! empty( $settings['organization_logo'] ) && $imgID = absint($settings['organization_logo'])){
					$image_url = wp_get_attachment_url( $imgID, 'full' );
					$webMeta["logo"] = $WpSrpSchema->sanitizeOutPut( $image_url, 'url' );
				}else{
					$webMeta["logo"] = null;
				}
			}
			if ( $siteType != "Organization" && $siteType != "Person" ) {
				$webMeta["description"] = ! empty( $settings['business_info']['description'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['business_info']['description'], 'textarea' ) : null;
				if ( ! empty( $settings['business_info']['openingHours'] ) ) {
					$aOhour = explode( "\r\n", $settings['business_info']['openingHours'] );
					if ( ! empty( $aOhour ) && is_array( $aOhour ) ) {
						if ( count( $aOhour ) == 1 ) {
							$webMeta["openingHours"] = $aOhour[0];
						} else if ( count( $aOhour ) > 1 ) {
							$webMeta["openingHours"] = $aOhour;
						}
					}
				}
				$webMeta["geo"] = array(
					"@type"     => "GeoCoordinates",
					"latitude"  => ! empty( $settings['business_info']['latitude'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['business_info']['latitude'] ) : null,
					"longitude" => ! empty( $settings['business_info']['longitude'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['business_info']['longitude'] ) : null,
				);
			}

			if(in_array($siteType, array('FoodEstablishment', 'Bakery','BarOrPub','Brewery','CafeOrCoffeeShop','FastFoodRestaurant','IceCreamShop','Restaurant','Winery'))){
				$webMeta["servesCuisine"] = !empty($settings['restaurant']['servesCuisine']) ? $WpSrpSchema->sanitizeOutPut( $settings['restaurant']['servesCuisine'], 'textarea' ) : null;
			}

			$webMeta["url"] = ! empty( $settings['web_url'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['web_url'], 'url' ) :  $WpSrpSchema->sanitizeOutPut( get_home_url(), 'url');
			if ( ! empty( $settings['social'] ) && is_array( $settings['social'] ) ) {
				$link = array();
				foreach ( $settings['social'] as $socialD ) {
					if ( $socialD['link'] ) {
						$link[] = $socialD['link'];
					}
				}
				if ( ! empty( $link ) ) {
					$webMeta["sameAs"] = $link;
				}
			}

			$webMeta["contactPoint"] = array(
				"@type"             => "ContactPoint",
				"telephone"         => ! empty( $settings['contact']['telephone'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['contact']['telephone'] ) : (! empty( $settings['site_telephone'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['site_telephone'] ) : null),
				"contactType"       => ! empty( $settings['contact']['contactType'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['contact']['contactType'] ) : '',
				"email"       => ! empty( $settings['contact']['email'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['contact']['email'] ) : '',
				"contactOption"     => ! empty( $settings['contact']['contactOption'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['contact']['contactOption'] ) : '',
				"areaServed"        => ! empty( $settings['area_served'] ) ? implode( ',',
					! empty( $settings['area_served'] ) ? $settings['area_served'] : array() ) : '',
				"availableLanguage" => ! empty( $settings['availableLanguage'] ) ? @implode( ',',
					! empty( $settings['availableLanguage'] ) ? $settings['availableLanguage'] : array() ) : null
			);
			$webMeta["address"]      = array(
				"@type"           => "PostalAddress",
				"addressCountry"  => ! empty( $settings['address']['country'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['address']['country'] ) : null,
				"addressLocality" => ! empty( $settings['address']['locality'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['address']['locality'] ) : null,
				"addressRegion"   => ! empty( $settings['address']['region'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['address']['region'] ) : null,
				"postalCode"      => ! empty( $settings['address']['postalcode'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['address']['postalcode'] ) : null,
				"streetAddress"   => ! empty( $settings['address']['street'] ) ? $WpSrpSchema->sanitizeOutPut( $settings['address']['street'] ) : null
			);

			$main_settings    = get_option( $WpSrpSchema->options['main_settings'] );
			$site_schema = !empty($main_settings['site_schema']) ? $main_settings['site_schema'] : 'home_page';
            if ($site_schema !== 'off') {
                if ($webMeta["@type"]) {
                    if ($site_schema == 'home_page') {
                        if (is_home() || is_front_page()) {
                            $html .= $schemaModel->get_jsonEncode($webMeta);
                        }
                    } elseif ($site_schema == 'all') {
                        $html .= $schemaModel->get_jsonEncode($webMeta);
                    }
                }
            }

			if ( is_single() || is_page() ) {
				foreach ( $schemaModel->schemaTypes() as $schemaID => $schema ) {
					$schemaMetaId = $WpSrpSchema->WpSrpPrefix . $schemaID;
					$metaData = get_post_meta($post->ID, $schemaMetaId, true );
					$metaData = (is_array($metaData) ? $metaData : array());
					if ( ! empty( $metaData ) && !empty( $metaData['active'] ) ) {
						$html .= $schemaModel->schemaOutput( $schemaID, $metaData );
					}
				}
			}
			echo $html;
		}
	}
endif;