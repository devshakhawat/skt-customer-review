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

		// add_submenu_page(
		// 	'skt-video-reviews',
		// 	'Settings',
		// 	'Settings',
		// 	'manage_options',
		// 	'submitted-video-reviews',
		// 	[ $this, 'render_reviews_list_table' ],
		// 	70
		// );
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

				<form action="" id="skt_plugin_settings" method="post">
					<table class="form-table">	
						<tr class="">
							<th scope="row" class="titledesc">
								<label for="enable_video_btn">
									<?php esc_html_e( 'Video Record Button:', 'sktplugin' ); ?>									
								</label>
							</th>
							<td class="skt_video_btn">
								<input type="checkbox" name="enable_video_btn" id="enable_video_btn" value="true">
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
							</td>
						</tr>

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="show_file_uploader">
									<?php esc_html_e( 'File Uploader:', 'sktplugin' ); ?>									
								</label>
							</th>
							<td class="skt_video_btn">
								<input type="checkbox" name="show_file_uploader" id="show_file_uploader" value="true">
								<?php echo wp_kses_post( wc_help_tip( 'Show File Uploader to all products', false ) ); ?>
							</td>
						</tr>

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="required_video">
									<?php esc_html_e( 'Required Video Recorder:', 'sktplugin' ); ?>									
								</label>
							</th>
							<td class="forminp forminp-select">
								<input type="checkbox" name="required_video" id="required_video" value="true">
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
							</td>
						</tr>

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="required_file_uploader">
									<?php esc_html_e( 'Required File Uploader:', 'sktplugin' ); ?>									
								</label>
							</th>
							<td class="forminp forminp-select">
								<input type="checkbox" name="required_file_uploader" id="required_file_uploader" value="true">
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
							</td>
						</tr>

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="required_text_comment">
									<?php esc_html_e( 'Required Text Comment:', 'sktplugin' ); ?>									
								</label>
							</th>
							<td class="forminp forminp-select">
								<input type="checkbox" name="required_text_comment" id="required_text_comment" value="true">
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
							</td>
						</tr>

						<tr class="">
							<th scope="row" class="titledesc">
								<label for="video_duration"><?php esc_html_e( 'Video Duration:', 'sktplugin' ); ?></label>
							</th>
							<td class="forminp forminp-number">
								<input name="video_duration" id="video_duration" type="number" style="width:50px;" value="2" placeholder="" min="0" max="2" step="1"> 			
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>			
							</td>
						</tr>
						<tr>
							<th scope="row" class="titledesc">
								<label for="review_btn_color"><?php esc_html_e( 'Button Color:', 'sktplugin' ); ?></label>
							</th>
							<td class="forminp forminp-select">
								<input type="text" name="review_btn_color" id="review_btn_color" value="#005BDF1F" />
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
							</td>
						</tr>
						<tr>
							<th scope="row" class="titledesc">
								<label for="review_btn_text"><?php esc_html_e( 'Button Text:', 'sktplugin' ); ?></label>
							</th>
							<td class="forminp forminp-select">
								<input type="text" name="review_btn_text" id="review_btn_text" value="<?php esc_attr_e( 'Record Video', 'sktplugin' ); ?>" />
								<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
							</td>
						</tr>

					</table>

					<input type="submit" name="submit" id="skt_plugin_submit" class="button button-primary" value="Submit">
				
				</form>

		<div>

		<?php

		echo ob_get_clean(); // phpcs:ignore
	}

	// public function get_submenu_page_data() {
		
	// } 
}
