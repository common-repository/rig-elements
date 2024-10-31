<?php
    
    // namespace RigElements;
    
    if ( ! class_exists( 'Rig_Admin' ) ) {

     class Rig_Admin {

        private static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

        public function __construct() {
            add_action('admin_enqueue_scripts', [ $this, 'rig_template_admin_scripts' ]);
            add_action('add_meta_boxes', [ $this, 'rig_template_meta_box' ]);
            add_action('save_post', [ $this, 'rig_template_save_meta' ]);
            add_action( 'admin_menu', array( $this, 'rig_elements_admin_options' ) );
            add_action( 'wp_ajax_rig_importer', array( $this, 'rig_elements_template_import' ) );

        }

        public function rig_template_admin_scripts() {
            $current_screen = get_current_screen(); 

            $screen_1 = 'rig-elements_page_rig-elements-template-library';
            $screen_2 = 'rig-elements_page_rig-elements-leads';
            

            if ($screen_1 == $current_screen->base OR $screen_2 == $current_screen->base) {
                wp_enqueue_style( 'rig_admin', plugins_url( '/assets/admin/css/admin.css', __FILE__ ) );
                wp_enqueue_script( 'rig_admin', plugins_url( '/assets/admin/js/admin.js', __FILE__ ), array('jquery'), '1.0', true );
                wp_localize_script( 'rig_admin', 'api_settings', array(
                    // 'root' => esc_url_raw( rest_url() ),
                    // 'nonce' => wp_create_nonce('wp_rest'),
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                ));
            }
        
        }

        public function rig_template_meta_box(){
            add_meta_box(
                'rig_display_condition',
                'Display Condtion',
                array($this,'rig_display_condition_callback'),
                'rig-template'
            );
        }

        public function rig_display_condition_callback($post) {
            $data = get_post_meta($post->ID, 'rig_template_type', true);
            $template_options = array(
                ''  => __('-- Select Template Type --'),
                'header'  => __('Header'),
			    'footer'  => __('Footer'),
			    'post'  => __('Single Post'),
			    'page'  => __('Single Page'),
			    'search'  => __('Search'),
                '404'  => __('404 Page'),
			    'woo_shop'  => __('WooCommerce Shop Page'),
			    'woo_single_product'  => __('WooCommerce Single Product'),
			    'woo_product_archive'  => __('WooCommerce Product Archive'),
			    'woo_product_tag'  => __('WooCommerce Product Tag'),
            );
            
            ?>
            <label for="template_type">Template Type</label>
            <select name="rig_template_select" id="rig_template_select">
            <?php 
            foreach($template_options as $key => $value) {
                $selected = '';
                if ($data == $key) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo esc_html($key); ?>" <?php echo esc_html($selected); ?>><?php echo esc_html($value); ?></option>
                <?php
              }
            ?>
            </select>
            <?php
        }

        public function rig_template_save_meta($post_id){
            $template_data = sanitize_text_field($_POST["rig_template_select"]) ?? null;
            if ($template_data == '') {
                return $post_id;
            }
        
            update_post_meta($post_id,'rig_template_type',$template_data);
        }


        public function rig_elements_admin_options() {
            $page_title = 'Rig Elements';
            $menu_title = 'Rig Elements';
            $capability = 'manage_options';
            $slug = 'rig-elements';
            $icon_url = plugins_url( '/assets/rig-elements.svg', __FILE__ );

            add_menu_page($page_title,$menu_title,$capability,$slug,'',$icon_url,2);

                // Add Rig Templates

                // add_submenu_page(
                //     $slug,
                //     'Theme Builder',
                //     'Theme Builder',
                //     $capability,
                //     'edit.php?post_type=rig-template'
                // );


                // Add Template Library Submenu

                // add_submenu_page(
                //     $slug,
                //     'Template Library',
                //     'Template Library',
                //     $capability,
                //     $slug.'-template-library',
                //     array($this, 'rig_elements_template_library'),
                // );

                // Add Leads Submenu
                add_submenu_page(
                    $slug,
                    'Leads',
                    'Leads',
                    $capability,
                    $slug.'-leads',
                    array($this, 'rig_elements_leads'),
                );
            
            // Remove Parent Slug
            remove_submenu_page($slug,$slug); 
        }

        public function rig_elements_template_library() {
            ?>
            <div id="app"></div>
            <?php

        }

        public function rig_elements_template_import() {
            $url = sanitize_text_field($_POST['demourl']);
            $res = wp_remote_get($url);

            \Elementor\Plugin::$instance->templates_manager->import_template([
                'fileData' => base64_encode(wp_remote_retrieve_body($res)),
                'fileName' => basename($url)
            ]);
        }


        public function rig_elements_leads() {
            ?>
            <div id="leads"></div>
            <?php

        }

    }
}

    Rig_Admin::instance();