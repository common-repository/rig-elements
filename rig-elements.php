<?php
/**
 * Plugin Name: Rig Elements
 * Description: Rig Elements is a powerful Elementor Addons plugin that comes with 15+ Advanced Addons for Elementor Page Builder. It is a perfect choice for Elementor users who want to build professional websites without coding.
 * Plugin URI:  https://codember.com/
 * Version:     1.0
 * Author:      Codember
 * Author URI:  https://codember.com/rig-elements-for-elementor/
 * Text Domain: rig-elements
 * Requires at least: 4.9
 * Requires PHP:      7.2
 * Tested up to: 6.0.2
 * Stable tag: trunk
 * WC requires at least: 2.2
 * WC tested up to: 6.8.2

 */
		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		final class Rig_Elements {

			const VERSION = '1.0';

			const MINIMUM_ELEMENTOR_VERSION = '3.0.0';


			const MINIMUM_PHP_VERSION = '7.0';


			public function __construct() {
				// Load translation
				add_action( 'init', array( $this, 'i18n' ) );

				// Init Database Table
				add_action( 'plugins_loaded', array($this,'create_rig_leads_table'));

				// Init Plugin
				add_action( 'plugins_loaded', array( $this, 'init' ) );

			}

			public function create_rig_leads_table() {
				global $wpdb;
				$table_name = $wpdb->prefix . 'rig_leads';
				$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					name tinytext NOT NULL,
					email tinytext NOT NULL,
					UNIQUE KEY id (id)
				);";
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				dbDelta($sql);
			}


			public function i18n() {
				load_plugin_textdomain( 'rig-elements' );
			}


			public function init() {

				// Check if Elementor installed and activated
				if ( ! did_action( 'elementor/loaded' ) ) {
					add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
					return;
				}

				// Check for required Elementor version
				if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
					add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
					return;
				}

				// Check for required PHP version
				if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
					add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
					return;
				}

				// Once we get here, We have passed all validation checks so we can safely include our plugin
				require_once ('vendor/autoload.php');
				require_once( 'plugin.php' );
				
				// require_once( 'template-controller.php' );
				require_once( 'lead-controller.php' );
				// require_once( 'query-control.php' );
				require_once( 'ajax-control.php' );
				require_once( 'rig-admin.php' );
			}


			public function admin_notice_missing_main_plugin() {
				if ( isset( $_GET['activate'] ) ) {
					unset( $_GET['activate'] );
				}

				$message = sprintf(
					/* translators: 1: Plugin name 2: Elementor */
					esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rig-elements' ),
					'<strong>' . esc_html__( 'Rig Elements', 'rig-elements' ) . '</strong>',
					'<strong>' . esc_html__( 'Elementor', 'rig-elements' ) . '</strong>'
				);

				printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
			}


			public function admin_notice_minimum_elementor_version() {
				if ( isset( $_GET['activate'] ) ) {
					unset( $_GET['activate'] );
				}

				$message = sprintf(
					/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
					esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rig-elements' ),
					'<strong>' . esc_html__( 'Rig Elements', 'rig-elements' ) . '</strong>',
					'<strong>' . esc_html__( 'Elementor', 'rig-elements' ) . '</strong>',
					self::MINIMUM_ELEMENTOR_VERSION
				);

				printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
			}


			public function admin_notice_minimum_php_version() {
				if ( isset( $_GET['activate'] ) ) {
					unset( $_GET['activate'] );
				}

				$message = sprintf(
					/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
					esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rig-elements' ),
					'<strong>' . esc_html__( 'Rig Elements', 'rig-elements' ) . '</strong>',
					'<strong>' . esc_html__( 'PHP', 'rig-elements' ) . '</strong>',
					self::MINIMUM_PHP_VERSION
				);

				printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
			}
		}

		// Instantiate Rig_Elements.

		new Rig_Elements();
