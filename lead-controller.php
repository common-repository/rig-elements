<?php

namespace RigElements;

if ( ! class_exists( 'Rig_Leads_Controller' ) ) {

    class Rig_Leads_Controller {

        private static $_instance = null;

			public static function instance() {
				if ( is_null( self::$_instance ) ) {
					self::$_instance = new self();
				}
				return self::$_instance;
			}

        
        
        public function __construct() {
            add_action( 'rest_api_init', array($this,'rig_elements_leads_rest_api_get_init'));
            add_action( 'rest_api_init', array($this,'rig_elements_leads_rest_api_post_init'));
            add_action( 'wp_ajax_rig_leads_submit', array( $this, 'post_rig_leads' ) );
            add_action( 'wp_ajax_nopriv_rig_leads_submit', array( $this, 'post_rig_leads' ) );
        }


        public function rig_elements_leads_rest_api_get_init() {
            register_rest_route( 'rig-elements/v1', '/rig-leads', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_rig_leads'),
                ));
        }

        public function get_rig_leads() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'rig_leads';
            $result = $wpdb->get_results ( "SELECT * FROM $table_name" );
            return $result;
        }

        public function rig_elements_leads_rest_api_post_init() {
            register_rest_route( 'rig-elements/v1', '/rig-leads', array(
                'methods' => 'POST',
                'callback' => array($this, 'post_rig_leads'),
                ));
        }

        public function post_rig_leads() {
            // add data to custom wordpress table for leads
            global $wpdb;
            $table_name = $wpdb->prefix . 'rig_leads';
            $wpdb->insert( 
                $table_name, 
                array( 
                    'time' => current_time( 'mysql' ), 
                    'name' => sanitize_text_field($_POST['lead_name']),
                    'email' => sanitize_email($_POST['lead_email'])
                )
            );
            return true;
        }


    }

}


Rig_Leads_Controller::instance();