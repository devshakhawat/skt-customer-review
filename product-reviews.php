<?php // phpcs:ignore

/**
 * Plugin Name: Product Reviews
 * Description: this plugin will enhance product review experience by adding some extra features.
 * Version: 1.0
 * Author: Shakhawat
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: product-reviews
 * Domain Path: /languages
 * Requires Plugins: woocommerce
 *
 * @package   Skt_Customer_Review
 */

 namespace CUSREVIEW;

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

