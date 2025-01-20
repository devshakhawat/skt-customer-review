<?php

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

?>

<div class="wrap">

	<h1><?php esc_html_e( 'Settings', 'customer-reviews' ); ?></h1>
	<h2><?php esc_html_e( 'Settings for Customer Reviews', 'customer-reviews' ); ?></h2>
	<p><?php esc_html_e( 'Here you can view and manage video reviews.', 'customer-reviews' ); ?></p>

	<form action="" id="skt_plugin_settings" method="post">
		<table class="form-table">	
			<tr>
				<th scope="row" class="titledesc">
					<label for="enable_video_btn">
						<?php esc_html_e( 'Video Record Button:', 'customer-reviews' ); ?>									
					</label>
				</th>
				<td class="skt_video_btn">
					<input type="checkbox" name="enable_video_btn" id="enable_video_btn" <?php checked( $settings['enable_video_btn'], true ); ?> >
					<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
					<span><?php esc_html_e( 'Show or Hide Video Record Button to all Products Page.', 'customer-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="show_file_uploader">
						<?php esc_html_e( 'File Uploader:', 'customer-reviews' ); ?>									
					</label>
				</th>
				<td class="skt_video_btn">
					<input type="checkbox" name="show_file_uploader" id="show_file_uploader" <?php checked( $settings['show_file_uploader'], true ); ?> >
					<?php echo wp_kses_post( wc_help_tip( 'Show File Uploader to all products', false ) ); ?>
					<span><?php esc_html_e( 'Show or Hide File Uploader Button to all Products Page.', 'customer-reviews' ); ?></span>
				</td>
			</tr>

			<!-- <tr>
				<th scope="row" class="titledesc">
					<label for="required_video">
						<?php // esc_html_e( 'Required Video Recorder:', 'customer-reviews' ); ?>									
					</label>
				</th>
				<td class="forminp forminp-select">
					<input type="checkbox" name="required_video" id="required_video" <?php // checked( $settings['required_video'], true ); ?> >
					<?php // echo wp_kses_post( wc_help_tip( 'Make Required Field to add Review', false ) ); ?>
					<span><?php // esc_html_e( 'Required or Optional to make this field', 'customer-reviews' ); ?></span>
				</td>
			</tr> -->

			<!-- <tr>
				<th scope="row" class="titledesc">
					<label for="required_file_uploader">
						<?php // esc_html_e( 'Required File Uploader:', 'customer-reviews' ); ?>									
					</label>
				</th>
				<td class="forminp forminp-select">
					<input type="checkbox" name="required_file_uploader" id="required_file_uploader" <?php // checked( $settings['required_file_uploader'], true ); ?> >
					<?php // echo wp_kses_post( wc_help_tip( 'Make required this field', false ) ); ?>
					<span><?php // esc_html_e( 'Required or Optional File Uploader', 'customer-reviews' ); ?></span>
				</td>
			</tr> -->

			<!-- <tr>
				<th scope="row" class="titledesc">
					<label for="required_text_comment">
						<?php // esc_html_e( 'Required Text Comment:', 'customer-reviews' ); ?>									
					</label>
				</th>
				<td class="forminp forminp-select">
					<input type="checkbox" name="required_text_comment" id="required_text_comment" <?php // checked( $settings['required_text_comment'], true ); ?> >
					<?php // echo wp_kses_post( wc_help_tip( 'Make Required or Optional File Uploader', false ) ); ?>
					<span><?php // esc_html_e( 'Make Required or Optional File Uploader', 'customer-reviews' ); ?></span>
				</td>
			</tr> -->

			<tr class="disabled">
				<th scope="row" class="titledesc">
					<label for="video_duration"><?php esc_html_e( 'Video Duration:', 'customer-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-number">
					<input type="number" name="video_duration" disabled id="video_duration" style="width:50px;" value="2" placeholder="" min="0" max="2" step="1">
					<?php echo wp_kses_post( wc_help_tip( 'Increase or Decrease Video Duration', false ) ); ?>
					<span><?php esc_html_e( 'Increase or Decrease Video Duration in ( Minutes )', 'customer-reviews' ); ?></span>   
					<span class="coming-soon-text">Coming Soon...</span> <!-- Tooltip text -->
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="review_btn_color"><?php esc_html_e( 'Button Color:', 'customer-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-select">
					<input type="text" name="review_btn_color" id="review_btn_color" value="<?php echo esc_attr( $settings['review_btn_color'] ); ?>" />
					<?php echo wp_kses_post( wc_help_tip( 'Add Video Record Button Color', false ) ); ?>
					<span><?php esc_html_e( 'Adjust Video Record Button Color', 'customer-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="review_btn_txt_color"><?php esc_html_e( 'Button Texts Color:', 'customer-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-select">
					<input type="text" name="review_btn_txt_color" id="review_btn_txt_color" value="<?php echo esc_attr( $settings['review_btn_txt_color'] ); ?>" />
					<?php echo wp_kses_post( wc_help_tip( 'Add Video Record Button Texts Color', false ) ); ?>
					<span><?php esc_html_e( 'Adjust Video Record Button Texts Color', 'customer-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="review_btn_text"><?php esc_html_e( 'Button Text:', 'customer-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-select">
					<input type="text" name="review_btn_text" id="review_btn_text" value="<?php esc_attr_e( 'Record Video', 'customer-reviews' ); ?>" />
					<?php echo wp_kses_post( wc_help_tip( 'Change Button Texts', false ) ); ?>
					<span><?php esc_html_e( 'Change Button Texts', 'customer-reviews' ); ?></span>
				</td>
			</tr>

		</table>

		<input type="submit" name="submit" id="skt_plugin_submit" class="button button-primary" value="Submit">
	
		<span class="skt_submit_successful" style="display:none;">Successfully Submitted</span>
	</form>

<div>