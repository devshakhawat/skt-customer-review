<?php // phpcs:ignore
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Scripts {

	/**
	 * Initialize the class
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		// wp_enqueue_style( 'woocommerce_admin_styles' );
		wp_enqueue_style( 'admin', SKT_PLUGIN_URI . 'assets/admin/css/admin.min.css', array(), SKT_VERSION );
	}

	/**
	 * Enqueue public-facing scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function public_enqueue_scripts() {

		wp_enqueue_style( 'font-awesome', SKT_PLUGIN_URI . 'assets/libs/font-awesome/css/font-awesome.min.css', array(), SKT_VERSION );
		wp_enqueue_style( 'public', SKT_PLUGIN_URI . 'assets/public/css/public.min.css', array(), SKT_VERSION );
		wp_enqueue_script( 'public', SKT_PLUGIN_URI . 'assets/public/js/public.min.js', array( 'jquery' ), SKT_VERSION, true );
	}
}
