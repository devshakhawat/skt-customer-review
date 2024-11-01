<?php // phpcs:ignore
namespace CUSREVIEW;

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
        <div id="tpro_video_modal" class="tpro_video_modal">
            <div class="tpro_background"></div>
            <!-- Modal content -->
            <div class="tpro_modal-content-wrapper">
                <div class="tpro_modal-content">
                    <span class="tpro_modal_close">&times;</span>
                    <div class="tpro_modal-content-inner">
                        <h3 class="text-center"><img src="<?php echo esc_url( SKT_PLUGIN_URI . 'assets/img/video-icon.svg' ); ?>" alt="record video"><?php echo esc_html_e( 'Record Review', 'testimonial-pro' ); ?></h3>
                        <div class="tpro_preview-recording">
                            <div id="tpro_timer"><span id="tpro_timer-text" data-maxtime="<?php echo esc_attr( $recording_time ); ?>" style="display: none;">05:00</span></div>
                            <video playsinline id="tpro_preview" width="450" height="337"  autoplay="" muted="" style="display: none;"></video>
                            <video playsinline id="tpro_recording" width="450" height="337" controls style="display: none;"></video>
                            <div class="tpro_no_camera text-center" style="display: none;">
                                <div class="camera_inner">
                                    <img src="<?php echo esc_url( SKT_PLUGIN_URI . 'assets/img/video-icon.svg' ); ?>" alt="">
                                    <div><?php esc_html_e( 'No camera available', 'testimonial-pro' ); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="tpro_record_video_buttons">
                            <div id="tpro_startButton" class="tpro_video_button" style="display: none;">
                            <i class="fa fa-video-camera" aria-hidden="true"></i><span id="tpro_startButton_text">
                                    <?php esc_html_e( 'Start Recording', 'testimonial-pro' ); ?>
                                </span>
                            </div>
                            <div id="tpro_stopButton" class="tpro_video_button stop_recording_btn" style="display: none;">
                            <i class="fa fa-stop-circle" aria-hidden="true"></i>
                                <?php esc_html_e( 'Stop Recording', 'testimonial-pro' ); ?>
                            </div>
                            <a id="tpro_addButton" class="tpro_video_button add_video_btn" style="display: none;">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <?php esc_html_e( 'Add this video', 'testimonial-pro' ); ?>
                            </a>
                        </div>
                    </div>
                    <p class="tpro_modal-content-bottom text-center">
                        <?php
                            $tpro_video_duration_unit = $recording_time >= 2 ? __( 'minutes', 'testimonial-pro' ) : __( 'minute', 'testimonial-pro' );
                        ?>
                        <span><?php esc_html_e( 'Maximum recording duration', 'testimonial-pro' ) . ' ' . $recording_time . ' ' . apply_filters( 'tpro_video_duration_unit', $tpro_video_duration_unit ); ?></span>
                    </p>
                </div>
            </div>
        </div>
		<?php
		return ob_get_clean();
	}

	public function get_defaults() {

		return array(
			'enable_video_btn'       => true,
			'show_file_uploader'     => true,
			'required_video'         => true,
			'required_file_uploader' => true,
			'required_text_comment'  => true,
			'video_duration'         => 2,
			'review_btn_color'       => '#f722cc',
			'review_btn_text'        => 'Record Video',
		);
	}

	public function get_allowed_fields() {

		return array(
			'enable_video_btn'       => false,
			'show_file_uploader'     => false,
			'required_video'         => false,
			'required_file_uploader' => false,
			'required_text_comment'  => false,
			'video_duration'         => 2,
			'review_btn_color'       => '#f722cc',
			'review_btn_text'        => 'Record Video',
		);
	}

	public function validate_form_data( $form_data ) {

		$form_data['enable_video_btn']       = wp_validate_boolean( $form_data['enable_video_btn'] );
		$form_data['show_file_uploader']     = wp_validate_boolean( $form_data['show_file_uploader'] );
		$form_data['required_video']         = wp_validate_boolean( $form_data['required_video'] );
		$form_data['required_file_uploader'] = wp_validate_boolean( $form_data['required_file_uploader'] );
		$form_data['required_text_comment']  = wp_validate_boolean( $form_data['required_text_comment'] );
		$form_data['video_duration']         = filter_var( $form_data['video_duration'], FILTER_VALIDATE_INT );
		$form_data['review_btn_color']       = sanitize_text_field( $form_data['review_btn_color'] );
		$form_data['review_btn_text']        = sanitize_text_field( $form_data['review_btn_text'] );

		return $form_data;
	}

	public function update_settings( $settings ) {

		if( empty( $settings ) ) return;

		$prev_data = get_option( 'skt_review_settings' );

		if( $prev_data === $settings ) {
			return true;
		}

		$is_updated = update_option( 'skt_review_settings', $settings );

		return $is_updated;
	}

	public function get_settings() {

		$settings = get_option( 'skt_review_settings', $this->get_defaults() );

		return $settings;
	}
}