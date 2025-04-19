<?php // phpcs:ignore

/**
 * Plugin Name: Product Reviews
 * Description: this plugin will enhance product review experience by adding some extra features.
 * Version: 2.0.1
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

if ( ! function_exists( 'pr_fs' ) ) {
    // Create a helper function for easy SDK access.
    function pr_fs() {
        global $pr_fs;

        if ( ! isset( $pr_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $pr_fs = fs_dynamic_init( array(
                'id'                  => '18762',
                'slug'                => 'product-reviews',
                'type'                => 'plugin',
                'public_key'          => 'pk_adc800eab5e7d982ec39068219938',
                'is_premium'          => true,
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'trial'               => array(
                    'days'               => 4,
                    'is_require_payment' => true,
                ),
                'menu'                => array(
                    'slug'           => 'skt-product-reviews',
                ),
            ) );
        }

        return $pr_fs;
    }

    // Init Freemius.
    pr_fs();
    // Signal that SDK was initiated.
    do_action( 'pr_fs_loaded' );
}

/**
 * Defining constants
 */
if ( ! defined( 'SKTPR_VERSION' ) ) {
	define( 'SKTPR_VERSION', '2.0.1' );
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
