<?php // phpcs:ignore

/**
 * Plugin Name: Review Booster
 * Description: this plugin will enhance product review experience by adding some extra features.
 * Version: 1.0
 * Author: Shakhawat
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: review-booster
 * Domain Path: /languages
 * Requires Plugins: woocommerce
 *
 * @package   Skt_Customer_Review
 */

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defining constants
 */
if ( ! defined( 'SKT_VERSION' ) ) {
	define( 'SKT_VERSION', '1.0.0' );
}
if ( ! defined( 'SKT_PLUGIN_FILE' ) ) {
	define( 'SKT_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'SKT_PLUGIN_DIR' ) ) {
	define( 'SKT_PLUGIN_DIR', trailingslashit( plugin_dir_path( SKT_PLUGIN_FILE ) ) );
}
if ( ! defined( 'SKT_PLUGIN_URI' ) ) {
	define( 'SKT_PLUGIN_URI', trailingslashit( plugins_url( '', SKT_PLUGIN_FILE ) ) );
}

/**
 * Load essential files
 */
require_once SKT_PLUGIN_DIR . 'includes/functions.php';
require_once SKT_PLUGIN_DIR . 'includes/autoloader.php';
require_once SKT_PLUGIN_DIR . 'includes/plugin.php';

if ( ! function_exists( 'rb_fs' ) ) {
	// Create a helper function for easy SDK access.
	function rb_fs() {
		global $rb_fs;

		if ( ! isset( $rb_fs ) ) {
			// Include Freemius SDK.
			require_once __DIR__ . '/freemius/start.php';

			$rb_fs = fs_dynamic_init(
				array(
					'id'             => '16965',
					'slug'           => 'review-booster',
					'type'           => 'plugin',
					'public_key'     => 'pk_84fe86484df4fc244be0610b01d03',
					'is_premium'     => false,
					'has_addons'     => false,
					'has_paid_plans' => false,
					'menu'           => array(
						'slug' => 'skt-video-reviews',
					),
				)
			);
		}

		return $rb_fs;
	}

	// Init Freemius.
	rb_fs();
	// Signal that SDK was initiated.
	do_action( 'rb_fs_loaded' );
}
