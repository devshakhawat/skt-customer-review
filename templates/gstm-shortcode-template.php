<?php namespace CUSREVIEW; ?>

<div class="gstm_form_wrapper_div">

	<form action="" class="gstm_form_<?php esc_attr_e($atts['id']); ?> gstm_form_wrapper <?php if( $display_mode === 'popup' ) { echo 'mfp-hide'; } ?>" id="gstm_form_<?php esc_attr_e($atts['id']); ?>" method="post">


		<?php if ( isset( $gstm_video_url ) && $gstm_video_url === 'on' ) : ?>
			<?php if( $record_video === 'video_by_url' ):  ?>
			<div class="gstm_video_url">
				<label for="company_url"><?php echo esc_html( $gstm_video_url_label ); ?></label>
				<span class="gstm_star"><?php ( $gstm_video_url_checkbox === 'on' ) ? esc_html_e( '*' ) : ''; ?></span>
				<br>
				<span class="before_company_url"><?php echo esc_html( $gstm_video_url_before ); ?></span><br>
				<input type="text" name="gstm_video_url_info" id="video_url" placeholder="<?php echo esc_attr( $gstm_video_url_placeholder ); ?>" <?php echo required( $gstm_video_url ); ?> ><br>
				<span class="after_company_url"><?php echo esc_html( $gstm_video_url_after ); ?></span>
			</div>
			<?php else: ?>
				<div class="gstm_video_url">
					<div><label for="video_record"><?php echo esc_html( $gstm_video_review ); ?></label></div>		
					<div class="gstm_video_wrapper">
						<div id="test-popup" class="white-popup mfp-hide">
							<h3 class="gstm_video_preview"><img src="<?php echo SKT_PLUGIN_URI . 'assets/img/video-icon.svg'; ?>" alt="Record Preview"><?php esc_html_e( 'Record Preview', 'gs-testimonial' ); ?></h3>
							<video id="gstm_recording_preview" controls autoplay muted></video>
							<button id="stop-recording" style="display: none;"><?php esc_html_e( 'Stop Recording', 'gs-testimonial' ); ?></button>
							<button id="upload-video" style="display: none;"><?php esc_html_e( 'Upload Video', 'gs-testimonial' ); ?></button>
						</div>
						<input class="video_url" type="hidden" name="gstm_video_url_info" >
						<video class="video_preview" style="display: none;" controls muted></video>
						<a href="#test-popup" class="open-popup-link"> <button id="start-recording"><?php esc_html_e( 'Start Recording', 'gs-testimonial' ); ?></button></a>
						</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php

			wp_localize_script(
				'gstm-public-js',
				'gstm_form_submission',
				array(
					'id' 		  => 'gstm_form_'.$atts['id'],
					'form_id' 	  => $atts['id'],
					'ajax_url' 	  => admin_url( 'admin-ajax.php' ),
					'nonce'    	  => wp_create_nonce( 'gstm_form_submission_nonce' ),
					)
				);
		?>

		<input type="hidden" name="form_id" value="<?php echo esc_attr($atts['id']); ?>">
		<input type="submit" class="gstm_submit" value="<?php esc_attr_e( 'Submit', 'gs-testimonial' ); ?>">

		<div class="gstm_shortcode_template"></div>		

	</form>

</div>

<?php

	if( $display_mode === 'popup' && $popup_btn === 'gstm_text_link' ) { ?>
		<a href="#gstm_form_<?php esc_attr_e($atts['id']); ?>" class="gstm_popup_text"><?php echo esc_html( $btn_label ); ?></a>
	<?php
	}
	if( $display_mode === 'popup' && $popup_btn === 'gstm_btn' ) { ?>
		<a href="#gstm_form_<?php esc_attr_e($atts['id']); ?>" class="gstm_popup_text"><button><?php echo esc_html( $btn_label ); ?></button></a>
	<?php
	}

?>
