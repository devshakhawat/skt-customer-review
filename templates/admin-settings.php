<?php

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

?>

<div class="skt-wrap">

	<!-- <h1><?php // esc_html_e( 'Settings', 'product-reviews' ); ?></h1> -->
	<h1><strong><?php esc_html_e( 'Settings for Customer Reviews', 'product-reviews' ); ?></strong></h1>
	<p><?php esc_html_e( 'Here you can view and manage video reviews settings.', 'product-reviews' ); ?></p>

	<form action="" id="sktpr_plugin_settings" method="post">
		<table class="form-table">	
			<tr>
				<th scope="row" class="titledesc">
					<label for="enable_video_btn">
						<?php esc_html_e( 'Video Record Button:', 'product-reviews' ); ?>									
					</label>
				</th>
				<td class="sktpr_video_btn">
					<input type="checkbox" name="enable_video_btn" id="enable_video_btn" <?php checked( $settings['enable_video_btn'], true ); ?> >
					<?php echo wp_kses_post( wc_help_tip( 'Show Record Button to all products', false ) ); ?>
					<span><?php esc_html_e( 'Show or Hide Video Record Button to all Products Page.', 'product-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="show_file_uploader">
						<?php esc_html_e( 'File Uploader:', 'product-reviews' ); ?>									
					</label>
				</th>
				<td class="sktpr_video_btn">
					<input type="checkbox" name="show_file_uploader" id="show_file_uploader" <?php checked( $settings['show_file_uploader'], true ); ?> >
					<?php echo wp_kses_post( wc_help_tip( 'Show File Uploader to all products', false ) ); ?>
					<span><?php esc_html_e( 'Show or Hide File Uploader Button to all Products Page.', 'product-reviews' ); ?></span>
				</td>
			</tr>

			<tr class="disabled">
				<th scope="row" class="titledesc">
					<label for="video_duration"><?php esc_html_e( 'Video Duration:', 'product-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-number">
					<input type="number" name="video_duration" disabled id="video_duration" placeholder="2">
					<?php echo wp_kses_post( wc_help_tip( 'Increase or Decrease Video Duration', false ) ); ?>
					<span><?php esc_html_e( 'Increase or Decrease Video Duration in ( Minutes )', 'product-reviews' ); ?></span>   
					<span class="go-pro-text"><a href="<?php echo site_url( '/wp-admin/admin.php?page=skt-product-reviews-pricing' ); ?>"><?php esc_html_e( 'Go Pro', 'product-reviews' ); ?></a></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="video_duration"><?php esc_html_e( 'Video Duration:', 'product-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-number">
					<input type="number" name="video_duration" id="video_duration" placeholder="2" step="1">
					<?php echo wp_kses_post( wc_help_tip( 'Increase or Decrease Video Duration', false ) ); ?>
					<span><?php esc_html_e( 'Increase or Decrease Video Duration in ( Minutes )', 'product-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="review_btn_color"><?php esc_html_e( 'Button Color:', 'product-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-select">
					<input type="text" name="review_btn_color" id="review_btn_color" value="<?php echo esc_attr( $settings['review_btn_color'] ); ?>" />
					<?php echo wp_kses_post( wc_help_tip( 'Add Video Record Button Color', false ) ); ?>
					<span><?php esc_html_e( 'Adjust Video Record Button Color', 'product-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="review_btn_txt_color"><?php esc_html_e( 'Button Texts Color:', 'product-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-select">
					<input type="text" name="review_btn_txt_color" id="review_btn_txt_color" value="<?php echo esc_attr( $settings['review_btn_txt_color'] ); ?>" />
					<?php echo wp_kses_post( wc_help_tip( 'Add Video Record Button Texts Color', false ) ); ?>
					<span><?php esc_html_e( 'Adjust Video Record Button Texts Color', 'product-reviews' ); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row" class="titledesc">
					<label for="review_btn_text"><?php esc_html_e( 'Button Text:', 'product-reviews' ); ?></label>
				</th>
				<td class="forminp forminp-select">
					<input type="text" name="review_btn_text" id="review_btn_text" value="<?php esc_attr_e( 'Record Video', 'product-reviews' ); ?>" />
					<?php echo wp_kses_post( wc_help_tip( 'Change Button Texts', false ) ); ?>
					<span><?php esc_html_e( 'Change Button Texts', 'product-reviews' ); ?></span>
				</td>
			</tr>

		</table>

		<input type="submit" name="submit" id="sktpr_plugin_submit" class="button button-primary" value="Submit">
	
		<span class="sktpr_submit_successful" style="display:none;">Successfully Submitted</span>
	</form>

<div>