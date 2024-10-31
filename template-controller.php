<?php

namespace RigElements;

if ( ! class_exists( 'Rig_Templates_Controller' ) ) {

    class Rig_Templates_Controller {

        private static $_instance = null;

			public static function instance() {
				if ( is_null( self::$_instance ) ) {
					self::$_instance = new self();
				}
				return self::$_instance;
			}

        
        
        public function __construct() {
            // require_once plugin_dir_path( __FILE__ ).'/admin/lib/csf/codestar-framework.php';
            // require_once('rig-metabox.php');

            add_action( 'init', array($this,'rig_elements_templates_post_type_init'));
            add_action( 'wp_enqueue_scripts',array($this,'rig_elements_load_assets'));
            add_filter( 'use_block_editor_for_post_type', array($this,'rig_templates_disable_gutenburg'), 10, 2 );
            add_action( 'get_header', array($this,'rig_elements_load_header'));
            add_action( 'get_footer', array($this,'rig_elements_load_footer'));
            add_filter( 'single_template',array($this,'rig_elements_load_single_post'));
            add_filter( 'page_template',array($this,'rig_elements_load_single_page'));
            add_filter( 'search_template',array($this,'rig_elements_load_search_page'));

            // Check if WooCommerce Installed
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            add_filter( 'template_include', array($this,'rig_elements_woocommerce_shop_page_template'), 99 );
            add_filter( 'template_include', array($this,'rig_elements_woocommerce_single_product_template'), 99 );
            add_filter( 'template_include', array($this,'rig_elements_woocommerce_archive_template'), 99 );
            }
        }


        public function rig_elements_load_assets() {
            if ( class_exists( '\Elementor\Plugin' ) ) {
                $elementor = \Elementor\Plugin::instance();
                $elementor->frontend->enqueue_styles();
            }
        }

        public function rig_elements_templates_post_type_init() {
        
            $labels = [
                "name" => __( "Rig Templates", "rig-elements" ),
                "singular_name" => __( "Rig Template", "rig-elements" ),
                "menu_name" => __( "Rig Templates", "rig-elements" ),
                "all_items" => __( "All Templates", "rig-elements" ),
                "add_new" => __( "Add new", "rig-elements" ),
                "add_new_item" => __( "Add new Rig Template", "rig-elements" ),
                "edit_item" => __( "Edit Rig Template", "rig-elements" ),
                "new_item" => __( "New Rig Template", "rig-elements" ),
                "view_item" => __( "View Rig Template", "rig-elements" ),
                "view_items" => __( "View Rig Templates", "rig-elements" ),
                "search_items" => __( "Search Rig Templates", "rig-elements" ),
                "not_found" => __( "No Rig Templates found", "rig-elements" ),
                "not_found_in_trash" => __( "No Rig Templates found in trash", "rig-elements" ),
                "parent" => __( "Parent Rig Template:", "rig-elements" ),
                "featured_image" => __( "Featured image for this Rig Template", "rig-elements" ),
                "set_featured_image" => __( "Set featured image for this Rig Template", "rig-elements" ),
                "remove_featured_image" => __( "Remove featured image for this Rig Template", "rig-elements" ),
                "use_featured_image" => __( "Use as featured image for this Rig Template", "rig-elements" ),
                "archives" => __( "Rig Template archives", "rig-elements" ),
                "insert_into_item" => __( "Insert into Rig Template", "rig-elements" ),
                "uploaded_to_this_item" => __( "Upload to this Rig Template", "rig-elements" ),
                "filter_items_list" => __( "Filter Rig Templates list", "rig-elements" ),
                "items_list_navigation" => __( "Rig Templates list navigation", "rig-elements" ),
                "items_list" => __( "Rig Templates list", "rig-elements" ),
                "attributes" => __( "Rig Templates attributes", "rig-elements" ),
                "name_admin_bar" => __( "Rig Template", "rig-elements" ),
                "item_published" => __( "Rig Template published", "rig-elements" ),
                "item_published_privately" => __( "Rig Template published privately.", "rig-elements" ),
                "item_reverted_to_draft" => __( "Rig Template reverted to draft.", "rig-elements" ),
                "item_scheduled" => __( "Rig Template scheduled", "rig-elements" ),
                "item_updated" => __( "Rig Template updated.", "rig-elements" ),
                "parent_item_colon" => __( "Parent Rig Template:", "rig-elements" ),
            ];
        
            $args = [
                "label" => __( "Rig Templates", "rig-elements" ),
                "labels" => $labels,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "has_archive" => false,
                "show_in_menu" => false,
                "show_in_nav_menus" => false,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "rewrite" => false,
                "query_var" => false,
                "supports" => [ "title", "elementor" ],
                "show_in_graphql" => false,
                // "menu_position" => 2,
            ];
        
            register_post_type( "rig-template", $args );
        }


        public function rig_templates_disable_gutenburg( $current_status, $post_type ) {

            $disabled_post_types = array( 'rig_templates');
        
            if ( in_array( $post_type, $disabled_post_types, true ) ) {
                $current_status = false;
            }
        
            return $current_status;
        }


        public function rig_elements_template_query() {
            $loop = new \WP_Query( array(
                'post_type' => 'rig-template',
            ));

                return $loop;
        }


	    public function rig_elements_load_header() {
            $loop = $this->rig_elements_template_query();
            while ( $loop->have_posts() ) : $loop->the_post();

            $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
            
			if ($template_type == 'header') {
				require plugin_dir_path( __FILE__ ) . 'templates/rig-header.php';
				$templates   = [];
			    $templates[] = 'header.php';
			    // Avoid running wp_head hooks again.
                remove_all_actions( 'wp_head' );
                ob_start();
                locate_template( $templates, true );
                ob_get_clean();
			}
            endwhile;
            wp_reset_query();
	    }


        public function rig_elements_load_footer() {
            $loop = $this->rig_elements_template_query();
            while ( $loop->have_posts() ) : $loop->the_post();

            $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);

			if ($template_type == 'footer') {
				require plugin_dir_path( __FILE__ ) . 'templates/rig-footer.php';
                $templates   = [];
                $templates[] = 'footer.php';
                // Avoid running wp_head hooks again.
                remove_all_actions( 'wp_footer' );
                ob_start();
                locate_template( $templates, true );
                ob_get_clean();
			}
            endwhile;
            wp_reset_query();
    }



        public function rig_elements_load_single_post($single_template) {
            global $post;
             if ( 'post' === $post->post_type ) {
                $loop = $this->rig_elements_template_query();
                
                 while ( $loop->have_posts() ) : $loop->the_post();
                
                 $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
         
                 if ($template_type == 'post') {
                     $single_template = plugin_dir_path( __FILE__ ) . "templates/single.php";
                     $templates   = [];
			        $templates[] = 'single.php';
                    // Avoid running wp_head hooks again.
                    // remove_all_actions( 'wp_head' );
                    ob_start();
                    locate_template( $templates, true );
                    ob_get_clean();
                 }

                 endwhile;
                 wp_reset_query();
             }
         
             return $single_template;
         
         }


        public function rig_elements_load_single_page($page_template) {
            global $post;
            if ( 'page' === $post->post_type ) {
                $loop = $this->rig_elements_template_query();
        
                while ( $loop->have_posts() ) : $loop->the_post();
                $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
        
                if ($template_type == 'page') {
                    $page_template = plugin_dir_path( __FILE__ ) . "templates/page.php";
                    $templates   = [];
			        $templates[] = 'page.php';
                    // Avoid running wp_head hooks again.
                    // remove_all_actions( 'wp_head' );
                    ob_start();
                    locate_template( $templates, true );
                    ob_get_clean();
                }
                // var_dump($template_type);
                endwhile;
                wp_reset_query();
            }
        
            return $page_template;
        }



        public function rig_elements_load_search_page($search_template) {
                $loop = $this->rig_elements_template_query();
        
                while ( $loop->have_posts() ) : $loop->the_post();
                $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
                
                if ($template_type == 'search') {
                    $search_template = plugin_dir_path( __FILE__ ) . "templates/search.php";
                    $templates   = [];
			        $templates[] = 'search.php';
                    ob_start();
                    locate_template( $templates, true );
                    ob_get_clean();
                }
                endwhile;
                wp_reset_query();
        
            return $search_template;
        }


        public function rig_elements_woocommerce_shop_page_template($template) {
            if ( is_shop() ) {

                $loop = $this->rig_elements_template_query();
        
                while ( $loop->have_posts() ) : $loop->the_post();
                $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
        
                if ($template_type == 'woo_shop') {
                    $shop_page_template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/shop.php';
                    // $templates   = [];
			        // $templates[] = 'woocommerce.php';
                    // Avoid running wp_head hooks again.
                    ob_start();
                    // locate_template( $templates, true );
                    ob_get_clean();
                }
        
                endwhile;
                wp_reset_query();
        
                if ( '' != $shop_page_template ) {
                    return $shop_page_template ;
                    }
            }
            return $template;
        }


        public function rig_elements_woocommerce_single_product_template($template) {
            if ( is_product() ) {

                $loop = $this->rig_elements_template_query();
        
                while ( $loop->have_posts() ) : $loop->the_post();
                $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
        
                if ($template_type == 'woo_single_product') {
                    $single_product_template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/single-product.php';
                    $templates   = [];
			        $templates[] = 'single-product.php';
                    // Avoid running wp_head hooks again.
                    // remove_all_actions( 'wp_head' );
                    ob_start();
                    locate_template( $templates, true );
                    ob_get_clean();
                }
        
                endwhile;
                wp_reset_query();
        
                if ( '' != $single_product_template ) {
                    return $single_product_template ;
                    }
            }
            return $template;
        }


        // public function rig_elements_woocommerce_archive_template( $template, $template_name, $template_path ) {
        //     $basename = basename( $template );
        //     if( $basename == 'archive-product.php' ) {
        //         $loop = $this->rig_elements_template_query();
        
        //         while ( $loop->have_posts() ) : $loop->the_post();
        //         $meta = get_post_meta( get_the_ID(), 'rig_template_meta', true );
        //         $template_type =  $meta['rig-elements-template-type'];
        
        //         if ($template_type == 'woo_product_archive') {
        //             $template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/archive-product.php';
        //             $templates   = [];
		// 	        $templates[] = 'archive-product.php';
        //             // Avoid running wp_head hooks again.
        //             // remove_all_actions( 'wp_head' );
        //             ob_start();
        //             locate_template( $templates, true );
        //             ob_get_clean();
        //         }

        //         endwhile;
        //         wp_reset_query();
        //     }
        
        //     return $template;
           
        // }



        public function rig_elements_woocommerce_archive_template($template) {
            if ( is_product_category() OR is_product_tag() ) {

                $loop = $this->rig_elements_template_query();
        
                while ( $loop->have_posts() ) : $loop->the_post();
                $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);
        
                if ($template_type == 'woo_product_archive') {
                    $product_archive_template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/archive-product.php';
                    // $templates   = [];
			        // $templates[] = 'woocommerce.php';
                    // Avoid running wp_head hooks again.
                    ob_start();
                    // locate_template( $templates, true );
                    ob_get_clean();
                }
        
                endwhile;
                wp_reset_query();
        
                if ( '' != $product_archive_template ) {
                    return $product_archive_template ;
                    }
            }
            return $template;
        }



    }

}


Rig_Templates_Controller::instance();