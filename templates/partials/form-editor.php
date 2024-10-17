<?php   namespace CUSREVIEW; ?>

<div class="gsp-testimonial-form form-editor gstm-hide">

    <div class="gstm_video_url">
        
        <div class="icons-with-title">
            <i class="fas fa-grip-vertical"></i>
            <h4 class="gstm-content"><?php echo esc_html( 'Video URL', 'gs-testimonial' ); ?></h4>
            <i class="fas fa-chevron-down"></i>
        </div>

        <div class="gstm_video_wrapper">

            <div class="gstm_tabs">
                <div class="gstm_tab">
                    <input type="radio" id="record_video" name="record_video" class="tab-input" <?php checked( $record_video, 'video_record' ); ?> value="video_record">
                    <label class="tab-area" for="record_video"><b><?php esc_html_e( 'Record Video', 'gs-testimonial' ); ?></b></label>
                </div>

                <div class="gstm_tab">
                    <input type="radio" name="record_video" id="video_by_url" class="tab-input" <?php checked( $record_video, 'video_by_url' ); ?> value="video_by_url">
                    <label class="tab-area" for="video_by_url"><b><?php esc_html_e( 'Video By URL', 'gs-testimonial' ); ?></b></label>
                </div>
            </div>         

            <div class="video_tabs">
                <div class="gstm_type_one">
                    <div class="gstm-video-review">
                        <label for="gstm_name"><?php esc_html_e( 'Label: ', 'gs-testimonial' ); ?></label>
                        <input id="gstm_name" name="gstm_video_review" value="<?php esc_attr_e( $gstm_video_review ?? '' ); ?>" type="text">
                    </div>
                    <div class="gstm-video-button">
                        <label for="gstm_name"><?php esc_html_e( 'Record Button Text: ', 'gs-testimonial' ); ?></label>
                        <input id="gstm_name" name="gstm_button_review" value="<?php esc_attr_e( $gstm_button_review ?? '' ); ?>" type="text">
                    </div>
                    <div class="gstm-video-duration">
                        <label for="gstm_name"><?php esc_html_e( 'Maximum Recording Time: ', 'gs-testimonial' ); ?></label>
                        <input id="gstm_name" name="gstm_max_record_time" value="<?php esc_attr_e( $gstm_max_record_time ?? '' ); ?>" type="number">
                    </div>
                    <div class="gstm-checkbox">
                        <label for="gstm_checkbox"><?php esc_html_e( 'Required: ', 'gs-testimonial' ); ?></label>
                        <input id="gstm_checkbox" name="gstm_video_record_time" <?php checked( $gstm_video_record_time, 'on' ); ?> type="checkbox">
                    </div>
                </div>
                
                <div class="gstm_type_two">
                    <div class="name_fields">
                        <div class="gstm-label">
                            <label for="gstm_name"><?php esc_html_e( 'Label: ', 'gs-testimonial' ); ?></label>
                            <input id="gstm_name" name="gstm_video_url_label" value="<?php esc_attr_e( $gstm_video_url_label ?? '' ); ?>" type="text">
                        </div>

                        <div class="gstm-placeholder-label">
                            <label for="gstm_placeholder"><?php esc_html_e( 'Placeholder: ', 'gs-testimonial' ); ?></label>
                            <input id="gstm_placeholder" name="gstm_video_url_placeholder" value="<?php esc_attr_e( $gstm_video_url_placeholder ?? '' ); ?>" type="text">
                        </div>

                        <div class="gstm-before">
                            <label for="gstm_before"><?php esc_html_e( 'Before: ', 'gs-testimonial' ); ?></label>
                            <input id="gstm_before" name="gstm_video_url_before" value="<?php esc_attr_e( $gstm_video_url_before ?? '' ); ?>" type="text">
                        </div>

                        <div class="gstm-after">
                            <label for="gstm_after"><?php esc_html_e( 'After: ', 'gs-testimonial' ); ?></label>
                            <input id="gstm_after" name="gstm_video_url_after" value="<?php esc_attr_e( $gstm_video_url_after ?? '' ); ?>" type="text">
                        </div>

                        <div class="gstm-checkbox">
                            <label for="gstm_video_url_checkbox"><?php esc_html_e( 'Required: ', 'gs-testimonial' ); ?></label>
                            <input id="gstm_video_url_checkbox" name="gstm_video_url_checkbox" <?php checked( $gstm_video_url_checkbox, 'on' ); ?> type="checkbox">
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>

    </div>
    
</div>
