<?php // phpcs:ignore
namespace SKTPREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

trait Helpers {

	/**
	 * Generates the HTML for the video modal.
	 *
	 * @return string The HTML content for the video modal.
	 */
	public function modal_html() {
		$recording_time = 2;
		ob_start();
		wp_nonce_field( 'my_form_nonce_action', 'my_form_nonce_name' );
		?>
		<div id="skt_video_modal" class="skt_video_modal">
			<div class="skt_background"></div>
			<!-- Modal content -->
			<div class="skt_modal-content-wrapper">
				<div class="skt_modal-content">
					<span class="skt_modal_close">&times;</span>
					<div class="skt_modal-content-inner">
						<h3 class="text-center"><img src="<?php echo esc_url( SKTPR_PLUGIN_URI . 'assets/img/video-icon.svg' ); ?>" alt="record video"><?php echo esc_html_e( 'Record Review', 'product-reviews' ); ?></h3>
						<div class="skt_preview-recording">
							<div id="skt_timer"><span id="skt_timer-text" data-maxtime="<?php echo esc_attr( $recording_time ); ?>" style="display: none;">05:00</span></div>
							<video playsinline id="skt_preview" width="450" height="337"  autoplay="" muted="" style="display: none;"></video>
							<video playsinline id="skt_recording" width="450" height="337" controls style="display: none;"></video>
							<div class="skt_no_camera text-center" style="display: none;">
								<div class="camera_inner">
									<img src="<?php echo esc_url( SKTPR_PLUGIN_URI . 'assets/img/video-icon.svg' ); ?>" alt="">
									<div><?php esc_html_e( 'No camera available', 'product-reviews' ); ?></div>
								</div>
							</div>
						</div>
						<div class="skt_record_video_buttons">
							<div id="skt_startButton" class="skt_video_button" style="display: none;">
							<i class="fa fa-video-camera" aria-hidden="true"></i><span id="skt_startButton_text">
									<?php esc_html_e( 'Start Recording', 'product-reviews' ); ?>
								</span>
							</div>
							<div id="skt_stopButton" class="skt_video_button stop_recording_btn" style="display: none;">
							<i class="fa fa-stop-circle" aria-hidden="true"></i>
								<?php esc_html_e( 'Stop Recording', 'product-reviews' ); ?>
							</div>
							<a id="skt_addButton" class="skt_video_button add_video_btn" style="display: none;">
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php esc_html_e( 'Add this video', 'product-reviews' ); ?>
							</a>
						</div>
					</div>
					<p class="skt_modal-content-bottom text-center">
						<?php
							$skt_video_duration_unit = $recording_time >= 2 ? __( 'minutes', 'product-reviews' ) : __( 'minute', 'product-reviews' );
						?>
						<span><?php echo esc_html__( 'Maximum recording duration', 'product-reviews' ) . ' ' . esc_html( $recording_time ) . ' ' . esc_html( apply_filters( 'skt_video_duration_unit', $skt_video_duration_unit ) ); ?></span>
					</p>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Retrieves the default settings for the review.
	 *
	 * @return array The default settings.
	 */
	public function get_defaults() {

		return array(
			'enable_video_btn'     => true,
			'show_file_uploader'   => true,
			'review_btn_color'     => '#005BDF1F',
			'review_btn_txt_color' => '#005bdf',
			'review_btn_text'      => 'Record Video',
		);
	}

	/**
	 * Validates and sanitizes the form data.
	 *
	 * @param array $form_data The form data to validate.
	 * @return array The validated and sanitized form data.
	 */
	public function validate_form_data( $form_data ) {

		$form_data['enable_video_btn']     = filter_var( $form_data['enable_video_btn'], FILTER_VALIDATE_BOOLEAN );
		$form_data['show_file_uploader']   = filter_var( $form_data['show_file_uploader'], FILTER_VALIDATE_BOOLEAN );
		$form_data['review_btn_color']     = sanitize_text_field( $form_data['review_btn_color'] );
		$form_data['review_btn_txt_color'] = sanitize_text_field( $form_data['review_btn_txt_color'] );
		$form_data['review_btn_text']      = sanitize_text_field( $form_data['review_btn_text'] );

		return $form_data;
	}

	/**
	 * Updates the review settings.
	 *
	 * @param array $settings The new settings to update.
	 * @return bool True if the settings were updated, false otherwise.
	 */
	public function update_settings( $settings ) {

		if ( empty( $settings ) ) {
			return;
		}

		$prev_data = get_option( 'skt_review_settings' );

		if ( $prev_data === $settings ) {
			return true;
		}

		$is_updated = update_option( 'skt_review_settings', $settings );

		return $is_updated;
	}

	/**
	 * Retrieves the review settings.
	 *
	 * @return array The review settings.
	 */
	public function get_settings() {

		$settings = get_option( 'skt_review_settings', $this->get_defaults() );

		return $settings;
	}
}