<?php

if ( ! class_exists( 'WpSrpSchema' ) ) {

	class WpSrpSchema {
		public $options;
		public $WpSrpPrefix;

		function __construct() {
			$this->WpSrpPrefix = "_schema_";
			$this->options     = array(
				'main_settings'     => 'wpsrp_wp_schema_settings',
				'settings'          => 'wpsrp_wp_schema',
				'installed_version' => 'wpsrp_wp_installed_version',
				'version'           => WP_SRP_SCHEMA_VERSION,
				'1_2_fix'           => "wpsrp_wp_1_2_data_fix"
			);

			$this->incPath       = dirname( __FILE__ );
			$this->functionsPath = $this->incPath . '/functions/';
			$this->classesPath   = $this->incPath . '/classes/';
			$this->viewsPath     = $this->incPath . '/views/';
			$this->assetsUrl     = WP_SRP_SCHEMA_URL . '/assets/';
			$this->modelPath     = $this->incPath . '/models/';
            $this->metapath       =$this->incPath .'/meta/';
			$this->WpSrpLoadFunctions( $this->functionsPath );
			$this->WpSrpLoadModel( $this->modelPath );
			$this->WpSrpLoadClass( $this->classesPath );
			
           $this->WpSrpLOadMeta($this->metapath);
		}

		 function WpSrpLOadMeta($dir)
		 {
			 if ( ! file_exists( $dir ) ) {
				return;
			}
			foreach ( scandir( $dir ) as $item ) {
				if ( preg_match( "/.php$/i", $item ) ) {
					require_once( $dir . $item );
				}
			}
		 }
		function WpSrpLoadClass( $dir ) {
			if ( ! file_exists( $dir ) ) {
				return;
			}
			$classes = array();
			//echo "diur ".$dir."<br>";
			foreach ( scandir( $dir ) as $item ) {
			//	echo "*".$item."<br>";
				if ( preg_match( "/.php$/i", $item ) ) {
					require_once( $dir . $item );
					$className = str_replace( ".php", "", $item );
					$classes[] = new $className;
				}
			}

			if ( $classes ) {
				foreach ( $classes as $class ) {
					$this->objects[] = $class;
				}
			}
		}

		function WpSrpLoadModel( $dir ) {
			if ( ! file_exists( $dir ) ) {
				return;
			}
			foreach ( scandir( $dir ) as $item ) {
				if ( preg_match( "/.php$/i", $item ) ) {
					require_once( $dir . $item );
				}
			}
		}

		function WpSrpLoadFunctions( $dir ) {
			if ( ! file_exists( $dir ) ) {
				return;
			}
			foreach ( scandir( $dir ) as $item ) {
				if ( preg_match( "/.php$/i", $item ) ) {
					require_once( $dir . $item );
				}
			}
		}

		function render( $viewName, $args = array() ) {
			global $WpSrpSchema;
			$path     = str_replace( ".", "/", $viewName );
			$viewPath = $WpSrpSchema->viewsPath . $path . '.php';
			if ( ! file_exists( $viewPath ) ) {
				return;
			}

			if ( $args ) {
				extract( $args );
			}
			$pageReturn = include $viewPath;
			if ( $pageReturn AND $pageReturn <> 1 ) {
				return $pageReturn;
			}
			if ( @$html ) {
				return $html;
			}
		}

		/**
		 * Dynamicaly call any  method from models class
		 * by pluginFramework instance
		 */
		function __call( $name, $args ) {
			if ( ! is_array( $this->objects ) ) {
				return;
			}
			foreach ( $this->objects as $object ) {
				if ( method_exists( $object, $name ) ) {
					$count = count( $args );
					if ( $count == 0 ) {
						return $object->$name();
					} elseif ( $count == 1 ) {
						return $object->$name( $args[0] );
					} elseif ( $count == 2 ) {
						return $object->$name( $args[0], $args[1] );
					} elseif ( $count == 3 ) {
						return $object->$name( $args[0], $args[1], $args[2] );
					} elseif ( $count == 4 ) {
						return $object->$name( $args[0], $args[1], $args[2], $args[3] );
					} elseif ( $count == 5 ) {
						return $object->$name( $args[0], $args[1], $args[2], $args[3], $args[4] );
					} elseif ( $count == 6 ) {
						return $object->$name( $args[0], $args[1], $args[2], $args[3], $args[4], $args[5] );
					}
				}
			}
		}
	}

	global $WpSrpSchema;
	if ( ! is_object( $WpSrpSchema ) ) {
		$WpSrpSchema = new WpsrpSchema;
	}
}

