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
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts' ) );
		add_action( 'admin_footer', array( $this, 'skt_plugin_wc_tooltips' ) );
	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook The current admin page.
	 */
	public function admin_enqueue_scripts( $hook ) {

		if ( 'toplevel_page_skt-video-reviews' !== $hook ) {
			return;
		}

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'woocommerce_admin_styles' );
			wp_enqueue_script( 'woocommerce_admin' );
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'admin', SKT_PLUGIN_URI . 'assets/admin/css/admin.min.css', array(), SKT_VERSION );
		wp_enqueue_script( 'admin', SKT_PLUGIN_URI . 'assets/admin/js/admin.min.js', array( 'wp-color-picker' ), SKT_VERSION, true );
	
		wp_localize_script(
			'admin',
			'skt_plugin',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'skt_plugin_nonce' ),
			)
		);
	}

	/**
	 * Enqueue public-facing scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function public_enqueue_scripts() {

		wp_enqueue_media();
		wp_enqueue_style( 'font-awesome', SKT_PLUGIN_URI . 'assets/libs/font-awesome/css/font-awesome.min.css', array(), SKT_VERSION );
		wp_enqueue_style( 'public', SKT_PLUGIN_URI . 'assets/public/css/public.min.css', array(), SKT_VERSION );
		wp_enqueue_script( 'public', SKT_PLUGIN_URI . 'assets/public/js/public.min.js', array( 'jquery' ), SKT_VERSION, true );
	}

	/**
	 * Enqueue WooCommerce tooltips script.
	 *
	 * @since 1.0.0
	 */
	public function skt_plugin_wc_tooltips() {
		if ( class_exists( 'WooCommerce' ) ) {
			wc_enqueue_js(
				"
				jQuery(document).ready(function($) {
					$('.woocommerce-help-tip').tipTip({
						'attribute': 'data-tip',
						'fadeIn': 50,
						'fadeOut': 50,
						'delay': 200
					});
				});
			"
			);
		}
	}
}
