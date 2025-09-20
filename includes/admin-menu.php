<?php // phpcs:ignore
namespace SKTPREVIEW;

// if direct access than exit the fi le.
defined( 'ABSPATH' ) || exit;

/**
 * Class Admin_Menu
 *
 * Handles the admin menu for the SKT Customer Review plugin.
 */
class Admin_Menu {

	use Helpers;

	/**
	 * Admin_Menu constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
	}

	/**
	 * Adds the admin menu for the SKT Customer Review plugin.
	 */
	public function add_admin_menu() {

		add_menu_page(
			'Product Reviews',
			'Product Reviews',
			'manage_options',
			'skt-product-reviews',
			'',
			SKTPR_PLUGIN_URI . 'assets/img/icon.png',
			50
		);

		add_submenu_page(
			'skt-product-reviews',
			__( 'Review Settings', 'product-reviews' ),
			__( 'Review Settings', 'product-reviews' ),
			'manage_options',
			'skt-product-reviews',
			array( $this, 'get_menu_page_data' ),
			10
		);
	}

	/**
	 * Outputs the content for the Video Reviews admin page.
	 */
	public function get_menu_page_data() {

		$settings = $this->get_settings();
		$email_settings = new Email_Settings();
		include_once Template_Loader::locate_template( 'admin-settings.php' );
	}
}
