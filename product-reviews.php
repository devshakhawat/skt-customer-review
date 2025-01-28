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
 * @package   Sktpr_Customer_Review
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
if ( ! defined( 'SKTPR_VERSION' ) ) {
	define( 'SKTPR_VERSION', '1.0.0' );
}
if ( ! defined( 'SKTPR_PLUGIN_FILE' ) ) {
	define( 'SKTPR_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'SKTPR_PLUGIN_DIR' ) ) {
	define( 'SKTPR_PLUGIN_DIR', trailingslashit( plugin_dir_path( SKTPR_PLUGIN_FILE ) ) );
}
if ( ! defined( 'SKTPR_PLUGIN_URI' ) ) {
	define( 'SKTPR_PLUGIN_URI', trailingslashit( plugins_url( '', SKTPR_PLUGIN_FILE ) ) );
}

/**
 * Load essential files
 */
require_once SKTPR_PLUGIN_DIR . 'includes/functions.php';
require_once SKTPR_PLUGIN_DIR . 'includes/autoloader.php';
require_once SKTPR_PLUGIN_DIR . 'includes/plugin.php';

