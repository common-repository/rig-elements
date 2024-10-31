<?php

		namespace RigElements;

		use RigElements\PageSettings\Page_Settings;

		class Plugin {

			private static $_instance = null;


			public static function instance() {
				if ( is_null( self::$_instance ) ) {
					self::$_instance = new self();
				}
				return self::$_instance;
			}
			

			// Load Styles And Scripts

			public function rig_elements_widget_styles() {
				wp_register_style( 'core_css', plugins_url( 'assets/css/core.css', __FILE__ ) );
				wp_register_style( 'rig-app', plugins_url( 'assets/css/app.css', __FILE__ ) );
			}

			public function rig_elements_widget_scripts() {
				wp_register_script( 'rig-main', plugins_url( '/assets/js/main.js', __FILE__ ), [ 'jquery' ], false, true );
				wp_register_script( 'rig-elements', plugins_url( '/assets/js/app.js', __FILE__ ), ['elementor-frontend'], false, true );
				wp_register_script( 'rig-lottie', plugins_url( '/assets/js/lottie.js', __FILE__ ), ['elementor-frontend'], false, true );
				wp_register_script( 'rig-carousel', plugins_url( '/assets/js/carousel.js', __FILE__ ), ['elementor-frontend'], false, true );

				wp_register_script( 'rig-ajax', plugins_url( '/assets/js/ajax.js', __FILE__ ), ['jquery'], false, true );
				wp_localize_script( 'rig-ajax', 'rig_ajaxdata', array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                ));
			}

			public function rig_elements_preview_scripts() {
				wp_register_script( 'rig-elements-preview', plugins_url( '/assets/js/app.js', __FILE__ ),['elementor-editor'], false, true);
				wp_enqueue_script( 'rig-elements-preview' );
				wp_register_script( 'rig-carousel', plugins_url( '/assets/js/carousel.js', __FILE__ ) );
				wp_enqueue_script( 'rig-carousel' );
			}


			// Load Admin Styls
			public function rig_elements_editor_styles() {
				// Register the icons styles.
				wp_register_style( 'rig_icons', plugins_url( '/assets/css/rig-fonts.css', __FILE__ ) );
				wp_enqueue_style( 'rig_icons' );
			}


			public function editor_scripts_as_a_module( $tag, $handle ) {
				if ( 'rig-elements-editor' === $handle ) {
					$tag = str_replace( '<script', '<script type="module"', $tag );
				}

				return $tag;
			}


			// Include/Require Widgets

			private function rig_elements_include_widgets() {
				
				// Final For Release
				require_once( __DIR__ . '/widgets/card/rig-card.php' );
				require_once( __DIR__ . '/widgets/logo-showcase/rig-logo-showcase.php' );
				require_once( __DIR__ . '/widgets/rig-advance-post.php' );
				require_once( __DIR__ . '/widgets/woocommerce/advance-products/rig-advance-products.php' );
				require_once( __DIR__ . '/widgets/price-table/rig-price-table.php' );
				require_once( __DIR__ . '/widgets/waze-map/rig-waze-map.php' );
				require_once( __DIR__ . '/widgets/lead-capture/rig-lead-capture.php' );

				// Not Finalize

				// Header & Footer Elements
				require_once( __DIR__ . '/widgets/theme-elements/site-logo/rig-site-logo.php' );
				require_once( __DIR__ . '/widgets/theme-elements/search/rig-search.php' );

				// Single Post & Page Elements
				require_once( __DIR__ . '/widgets/theme-elements/post-title/rig-post-title.php' );
				require_once( __DIR__ . '/widgets/theme-elements/post-content/rig-post-content.php' );
				require_once( __DIR__ . '/widgets/theme-elements/post-feature-image/rig-post-feature-image.php' );

				
				// Single Product Elements
				require_once( __DIR__ . '/widgets/theme-elements/woocommerce/product-title/controller.php' );
				require_once( __DIR__ . '/widgets/theme-elements/woocommerce/product-archive-title/controller.php' );
				require_once( __DIR__ . '/widgets/theme-elements/woocommerce/product-description/controller.php' );
				require_once( __DIR__ . '/widgets/theme-elements/woocommerce/product-image/controller.php' );
				
				// require_once( __DIR__ . '/widgets/theme-elements/woocommerce/product-price/rig-product-price.php' );
				require_once( __DIR__ . '/widgets/theme-elements/woocommerce/add-to-cart/rig-add-to-cart.php' );
				
				require_once( __DIR__ . '/widgets/lottie-animation/rig-lottie-animation.php' );
				require_once( __DIR__ . '/widgets/twitter-embed/rig-twitter-embed.php' );
				
				require_once( __DIR__ . '/widgets/imgur-embed/rig-imgur-embed.php' );
				require_once( __DIR__ . '/widgets/woocommerce/rig-woocommerce-cart.php' );
				require_once( __DIR__ . '/widgets/woocommerce/rig-woocommerce-checkout.php' );

			}


			// Register Widgets

			public function rig_elements_register_widgets() {
				$this->rig_elements_include_widgets();
				
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Card() );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Logo_Showcase() );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Price_Table() );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Advance_Post() );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Lottie_Animation() );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Twitter_Embed() );

				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Imgur_Embed() );
				
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_waze_map() );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Lead_Capture() );
				// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Site_Logo() );
				// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Post_Content() );
				// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Post_Title() );
				// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Post_Feature_Image() );
				// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Search() );

				// Check if WooCommerce is active

				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Advance_Products() );
					\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_WooCommerce_Cart() );
					\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_WooCommerce_Checkout() );

					// Single Product Page Elements
					
					// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Product_Title() );
					// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Product_Archive_Title() );
					// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Product_Description() );
					// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Product_Image() );
					
					// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Product_Price() );
					// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Rig_Add_To_Cart() );
				}
				
			}


			public function rig_elements_widget_category($elements_manager) {
				$elements_manager->add_category(
					'rig_elements_widgets',
					[
						'title' => __( 'Rig Elements', 'rig-elements' ),
						'icon' => 'fa fa-plug',
					]
				);
			
			}


			public function rig_elements_header_footer_widgets($elements_manager) {
				$elements_manager->add_category(
					'rig_elements_header_footer_widgets',
					[
						'title' => __( 'Rig Elements - Header & Footer', 'rig-elements' ),
						'icon' => 'fa fa-plug',
					]
				);
			
			}


			public function rig_elements_single_widgets($elements_manager) {
				$elements_manager->add_category(
					'rig_elements_single_widgets',
					[
						'title' => __( 'Rig Elements - Single', 'rig-elements' ),
						'icon' => 'fa fa-plug',
					]
				);
			
			}


			public function rig_elements_woocommerce_widgets($elements_manager) {
				$elements_manager->add_category(
					'rig_elements_woocommerce_widgets',
					[
						'title' => __( 'Rig Elements - WooCommerce', 'rig-elements' ),
						'icon' => 'fa fa-plug',
					]
				);
			
			}

			public function rig_elements_admin_scripts(){
				wp_register_script( 'rig-elements-preview', plugins_url( '/assets/js/app.js', __FILE__ ));
				wp_enqueue_script( 'rig-elements-preview' );
			}


			public function __construct() {
				add_action( 'elementor/elements/categories_registered', [ $this, 'rig_elements_widget_category' ], );
				// add_action( 'elementor/elements/categories_registered', [ $this, 'rig_elements_header_footer_widgets' ], );
				// add_action( 'elementor/elements/categories_registered', [ $this, 'rig_elements_single_widgets' ], );
				// add_action( 'elementor/elements/categories_registered', [ $this, 'rig_elements_woocommerce_widgets' ], );
				add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'rig_elements_widget_styles' ] );
				add_action( 'elementor/frontend/after_register_scripts', [ $this, 'rig_elements_widget_scripts' ] );
				add_action( 'elementor/widgets/widgets_registered', [ $this, 'rig_elements_register_widgets' ] );
				add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'rig_elements_editor_styles' ] );
				add_action( 'elementor/preview/after_enqueue_scripts', [ $this, 'rig_elements_preview_scripts' ] );
				// add_action( 'elementor/preview/enqueue_scripts', [ $this, 'rig_elements_editor_scripts' ] );
				add_action( 'elementor/init', [ $this, 'rig_elements_admin_scripts' ] );
			}
		}


		Plugin::instance();
