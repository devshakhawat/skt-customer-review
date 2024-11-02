<?php // phpcs:ignore

/**
 * Plugin Name: SKT Customer Review
 * Plugin URI: test.com
 * Description: this plugin will use to show variations of products in woocommerce
 * Version: 1.0
 * Author: Shakhawat
 * Author URI: skt.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sktplugin
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
