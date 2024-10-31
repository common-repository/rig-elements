<?php

namespace RigElements;


    if ( ! class_exists( 'Rig_Query_Control' ) ) {

     class Rig_Query_Control {

        private static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}


        public function __construct() {
            // add_action( 'elementor/frontend/init', [ $this, 'get_product_preview_image' ], );
            // add_action( 'wp_enqueue_scripts', array($this,'rig_dynamic_assets'));
        }

        // Post Preview Query

        public function is_elementor_preview_mode(){
            return \Elementor\Plugin::$instance->preview->is_preview_mode();
        }

        public function custom_post_query_for_preview($post_type) {
            
			$post_list = array();

				$args = array(
					'post_type' => $post_type,
					'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => false
			   );

               return $args;
        }


        public function get_preview_title() {
            $post_type = "post";
            $args = self::custom_post_query_for_preview($post_type);

			foreach( get_posts( $args ) as $posts ) :
                $post_list[$posts->post_title] = $posts->post_title;
           endforeach;

           return $post_list;
	    }


        public function get_preview_content() {
            // $post_type = "page";
            $args = self::custom_post_query_for_preview($post_type);

			foreach( get_posts( $args ) as $posts ) :
                $post_list[$posts->post_content] = $posts->post_title;
           endforeach;
           
           return $post_list;
	    }


        public function get_preview_feature_image() {
            // $post_type = "page";
            $args = self::custom_post_query_for_preview($post_type);
            
			foreach( get_posts( $args ) as $posts ) :
                $post_list[get_the_post_thumbnail_url($posts->ID)] = $posts->post_title;
           endforeach;
           
        
           return $post_list;
	    }


        // public function get_preview_content() {
        //     // $loop = self::custom_post_query_for_preview($post_type);

        //     $args = array(
        //         'post_type' => 'post',
        //         'orderby' => 'name',
        //         'order' => 'ASC',
        //         'hide_empty' => false
        //    );

        //    $loop = new \WP_Query( $args );

		// 	while ( $loop->have_posts() ) : $loop->the_post();
        //         $content = get_the_content();
        //     endwhile;
        //     wp_reset_query();

        //     return $content;
	    // }



        // Product Preview Query


        public function custom_product_query_for_preview() {
            
			// $product_list = array();

				$args = array(
					'post_type' => 'product',
					// 'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => false
			   );

               $loop = new \WP_Query( $args );

               return $loop;
        }


        public function get_product_preview() {
            $loop = self::custom_product_query_for_preview();
            while ( $loop->have_posts() ) : $loop->the_post();
                 global $product;
                //  echo "<pre>";
                //  var_dump($product);
                //  echo "</pre>";
             endwhile;
             return $product;
         }
        
        public function get_product_preview_price() {
            $loop = self::custom_product_query_for_preview();
            while ( $loop->have_posts() ) : $loop->the_post();
                 global $product;
                 $product_price = $product->get_price_html();
             endwhile;
             return $product_price;
         }


        public function get_product_preview_image() {
            $loop = self::custom_product_query_for_preview();
            while ( $loop->have_posts() ) : $loop->the_post();
                 $product_image = get_the_post_thumbnail_url();
             endwhile;

             return $product_image;
         }

         public function get_product_preview_gallery() {
            $loop = self::custom_product_query_for_preview();
            while ( $loop->have_posts() ) : $loop->the_post();
                 global $product;
                 $product_image_gallery = $product->get_gallery_image_ids();
             endwhile;

             return $product_image_gallery;
         }


         public function get_product_preview_add_to_cart() {
            $loop = self::custom_product_query_for_preview();
            while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
                    $add_to_cart = $product;
             endwhile;

             return $add_to_cart;
         }



        //  Render Query


        public function get_the_title() {
            // $loop = self::custom_query();

			while ( have_posts() ) : the_post();
                $title = get_the_title();
            endwhile;
            wp_reset_query();

            return $title;
	    }


        public function get_the_content() {
            while ( have_posts() ) : the_post();
                 $content = get_the_content();
             endwhile;

             return $content;
         }


         public function get_the_feature_image() {
            while ( have_posts() ) : the_post();
                 $image = get_the_post_thumbnail_url();
             endwhile;

             return $image;
         }


         public function get_product_title() {
            $product_title ='';
            while ( have_posts() ) : the_post();
            global $product;
            if (!empty($product)){
                $product_title = $product->get_name();
            }
             endwhile;

             return $product_title;
         }

         public function get_product_description() {
            $product_description = "";

            while ( have_posts() ) : the_post();
            global $product;
            if (!empty($product)){
                $product_description = $product->get_description();
            }
             endwhile;

             return $product_description;
         }


         public function get_product_short_description() {
            while ( have_posts() ) : the_post();
            global $product;
            if (!empty($product)){
                $product_short_description = $product->get_short_description();
            }
             endwhile;

             return $product_short_description;
         }
         

         public function get_product_price() {
            $product_price = "";
            
            while ( have_posts() ) : the_post();
            global $product;
            if (!empty($product)){
                $product_price = $product->get_price_html();
            }
             endwhile;

             return $product_price;
         }


         public function get_product_image() {
            while ( have_posts() ) : the_post();
                 $product_image = get_the_post_thumbnail_url();
                //  $product_image = get_the_post_thumbnail_url($loop->ID);
             endwhile;

             return $product_image;
         }

         public function get_product_image_gallery() {
            while ( have_posts() ) : the_post();
            global $product;
            if (!empty($product)){
                $product_image_gallery = $product->get_gallery_image_ids();
            }
             endwhile;

             return $product_image_gallery;
         }


         public function get_product_add_to_cart() {
            while ( have_posts() ) : the_post();
                global $product;
             endwhile;

             return $product;
         }

        


        


        // Not Finalized


         public function get_product_attributes() {
            while ( have_posts() ) : the_post();
                global $product;
                 $attributes = $product->get_attributes();
             endwhile;

             return $attributes;
         }


         public function get_product_variations() {
            while ( have_posts() ) : the_post();
                global $product;
                 $variations = $product->get_available_variations();
             endwhile;

             return $variations;
         }


         public function get_product_childrens() {
            while ( have_posts() ) : the_post();
                global $product;
                $children = $product->get_children();
             endwhile;

             return $children;
         }


        //  public function rig_dynamic_assets() {
        //     wp_enqueue_script( 'rig-dynamic', plugins_url( 'assets/js/rig-dynamic.js', __FILE__ ), array('jquery'), '1.0', true );
        //     wp_localize_script( 'rig-dynamic', 'rig_productdata',$product_variation_ids);
        //  }



        public function get_all_nav_menus() {
            $menus = get_terms( 'nav_menu' );
            return $menus;
        }

         

     }

}

Rig_Query_Control::instance();



