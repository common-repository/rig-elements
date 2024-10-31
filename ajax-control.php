<?php

    namespace RigElements;


    if ( ! class_exists( 'Rig_Ajax_Control' ) ) {

     class Rig_Ajax_Control {

        private static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

        public function __construct() {
            add_action('wp_ajax_product_short', [ $this, 'ajax_product_query' ]);
            add_action('wp_ajax_nopriv_product_short', [ $this, 'ajax_product_query' ]);
        }

        public function ajax_product_query() {
			// $add_to_cart_button = Rig_Advance_Products::rig_advanced_products_add_to_cart();
            // var_dump($add_to_cart_button);
            global $wp;
            global $product;

            $product_category = sanitize_text_field($_POST['rig_product_categories']);
            $product_meta_key = sanitize_text_field($_POST['rig_product_meta_key']);
            $product_search_term = sanitize_text_field($_POST['rig_product_search_term']);
            $price_range_start = sanitize_text_field(intval($_POST['price_range_start']));
            $price_range_end = sanitize_text_field(intval($_POST['price_range_end']));

            $args = array(
                'post_type'        => 'product',
                'meta_key' => $product_meta_key,
                'orderby' => 'meta_value_num',
                'product_cat' => $product_category,
                's' => $product_search_term,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key'     => '_price',
                        'value'   => array($price_range_start,$price_range_end),
                        'compare' => 'BETWEEN',
                        'type'    => 'NUMERIC',
                    ),
                ),
            );

            // if(!empty($post_per_page)) {
            //     $args['posts_per_page'] = $post_per_page;
            // }

            // if(!empty($product_category)) {
            //     $args['product_cat'] = 'hoodies';
            // }
            

                    $loop = new \WP_Query( $args );

                    while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
    
                    echo '
                        <div class="rig-woo-products">
                        <a href='.get_post_permalink($loop->ID).'>
                        <img class="rig-woo-products-img" src='.get_the_post_thumbnail_url($loop->ID).'>
                        </a>
                        <p class="rig-woo-products-name">'.esc_html($product->get_name()).'</p>
                        <p class="rig-woo-products-price">'.$product->get_price_html().'</p></div>';
    
    
                endwhile;
                wp_reset_postdata();
                
                echo "</div>";
        }
    

     }

}

Rig_Ajax_Control::instance();



