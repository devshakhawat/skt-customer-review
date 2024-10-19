<?php // phpcs:ignore
namespace CUSREVIEW;

// if direct access than exit the fi le.
defined( 'ABSPATH' ) || exit;

/**
 * Class Admin_Menu
 *
 * Handles the admin menu for the SKT Customer Review plugin.
 */
class Admin_Menu {

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
			'Video Reviews',
			'Video Reviews',
			'manage_options',
			'skt-video-reviews',
			array( $this, 'get_menu_page_data' ),
			'dashicons-format-video',
			50
		);
	}

	/**
	 * Outputs the content for the Video Reviews admin page.
	 */
	public function get_menu_page_data() {

		ob_start();
		?>
		<div class="wrap">
				<h1><?php esc_html_e( 'Settings', 'sktplugin' ); ?></h1>
				<h2><?php esc_html_e( 'Settings for Customer Reviews', 'sktplugin' ); ?></h2>
				<p><?php esc_html_e( 'Here you can view and manage video reviews.', 'sktplugin' ); ?></p>

				<form action="" method="post">

					<table class="form-table">	

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="ivole_enable_for_role">
									<?php esc_html_e( 'Show Button to All Products', 'sktplugin' ); ?>									
								</label>
							</th>
							<td class="forminp forminp-select">
								<input type="checkbox" name="enable_video_btn" id="enable_video_btn">
							</td>
						</tr>

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="woocommerce_price_num_decimals"><?php esc_html_e( 'Video Duration', 'sktplugin' ); ?></label>
							</th>
							<td class="forminp forminp-number">
								<input name="woocommerce_price_num_decimals" id="woocommerce_price_num_decimals" type="number" style="width:50px;" value="2" class="" placeholder="" min="0" step="1"> 						
							</td>
						</tr>

					</table>

					<input type="submit" name="submit" id="submit" class="button button-primary" value="Submit">
				
				</form>

		<div>

		<?php

		echo ob_get_clean(); // phpcs:ignore
	}
}
