<?php
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

function modal_html() {
    $recording_time = 2;
    ob_start();
?>
  <div id="tpro_video_modal" class="tpro_video_modal">
	<div class="tpro_background"></div>
	<!-- Modal content -->
	<div class="tpro_modal-content-wrapper">
		<div class="tpro_modal-content">
			<span class="tpro_modal_close">&times;</span>
			<div class="tpro_modal-content-inner">
				<h3 class="text-center"><img src="<?php echo SKT_PLUGIN_URI . 'assets/img/video-icon.svg'; ?>" alt=""><?php echo apply_filters( 'tpro_upper_record_text', __( 'Record Review', 'testimonial-pro' ) ); ?></h3>
				<div class="tpro_preview-recording">
					<div id="tpro_timer"><span id="tpro_timer-text" data-maxtime=<?php echo $recording_time; ?> style="display: none;">05:00</span></div>
					<video playsinline id="tpro_preview" width="450" height="337"  autoplay="" muted="" style="display: none;"></video>
					<video playsinline id="tpro_recording" width="450" height="337" controls style="display: none;"></video>
					<div class="tpro_no_camera text-center" style="display: none;">
						<div class="camera_inner">
							<img src="<?php echo SKT_PLUGIN_URI . 'assets/img/video-icon.svg'; ?>" alt="">
							<div><?php echo apply_filters( 'tpro_no_camera_text', __( 'No camera available', 'testimonial-pro' ) ); ?></div>
						</div>
					</div>
				</div>
				<div class="tpro_record_video_buttons">
					<div id="tpro_startButton" class="tpro_video_button" style="display: none;">
					<i class="fa fa-video-camera" aria-hidden="true"></i><span id="tpro_startButton_text">
							<?php echo apply_filters( 'tpro_start_recording_btn_text', __( 'Start Recording', 'testimonial-pro' ) ); ?>
						</span>
					</div>
					<div id="tpro_stopButton" class="tpro_video_button stop_recording_btn" style="display: none;">
					<i class="fa fa-stop-circle-o" aria-hidden="true"></i>
						<?php echo apply_filters( 'tpro_stop_recording_btn_text', __( 'Stop Recording', 'testimonial-pro' ) ); ?>
					</div>
					<a id="tpro_addButton" class="tpro_video_button add_video_btn" style="display: none;">
					<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<?php echo apply_filters( 'tpro_add_video_btn_text', __( 'Add this video', 'testimonial-pro' ) ); ?>
					</a>
				</div>
			</div>
			<p class="tpro_modal-content-bottom text-center">
				<?php
					$tpro_video_duration_unit = $recording_time >= 2 ? __( 'minutes', 'testimonial-pro' ) : __( 'minute', 'testimonial-pro' );
				?>
				<span><?php echo apply_filters( 'tpro_video_duration_text', __( 'Maximum recording duration', 'testimonial-pro' ) ) . ' ' . $recording_time . ' ' . apply_filters( 'tpro_video_duration_unit', $tpro_video_duration_unit ); ?></span>
			</p>
		</div>
	</div>
</div>
<?php
    return ob_get_clean();
}