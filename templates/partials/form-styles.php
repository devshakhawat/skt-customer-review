<?php   namespace CUSREVIEW; ?>

<div class="form-styles gstm-hide">
	
	<div class="gstm-form-layout">
		<div class="gstm-layout-label gstm-msg-label">
			<b><?php esc_html_e( 'Form Layout: ', 'gs-testimonial' ); ?></b>
		</div>
		<div class="gstm-layout-tabs">
			<label class="gstm-layout-tab">
				<input type="radio" name="gstm_layout" <?php checked( $gstm_layout, 'gstm_top' ); ?> value="gstm_top">
			</label>

			<label class="gstm-layout-tab">
				<input type="radio" name="gstm_layout" <?php checked( $gstm_layout, 'gstm_bottom' ); ?> value="gstm_bottom">
			</label>
		</div>
	</div>

	<div class="gstm-form-width">
		<div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Form Width: ', 'gs-testimonial' ); ?></b>
		</div>
		
		<div class="gstm-width">
			<input type="number" name="gstm_width" id="gstm_width" value="<?php echo esc_attr( $gstm_width ); ?>">
		</div>
	</div>
	
	<div class="gstm-form-width">
		<div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Label Color: ', 'gs-testimonial' ); ?></b>
		</div>
		
		<div class="gstm-width">
			<input type="text" id="gstm_label_color" name="gstm_label_color" value="<?php echo esc_attr( $gstm_label_color ); ?>" />
		</div>
	</div>

	<div class="gstm-input-field">
		<div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Input Field: ', 'gs-testimonial' ); ?></b>
		</div>
		
        <div class="gstm-inp-wrapper">
            <div class="gstm-inp-width">
                <span><?php esc_html_e( 'Width', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_inp_width" id="gstm_inp_width" value="<?php echo esc_attr( $gstm_inp_width ); ?>">
            </div>

            <div class="gstm-inp-select">
                <span><?php esc_html_e( 'Style', 'gs-testimonial' ); ?></span><br>
                <select name="gstm_input_type" id="gstm_input_type">
                   <?php echo get_border_style_options( $gstm_input_type ); ?>
                </select>
            </div>

            <div class="gstm-inp-color">
                <span><?php esc_html_e( 'Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_input_color" name="gstm_input_color" value="<?php echo esc_attr($gstm_input_color); ?>" />
            </div>
            
            <div class="gstm-bg-color">
                <span><?php esc_html_e( 'BG Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_bg_color" name="gstm_bg_color" value="<?php echo esc_attr($gstm_bg_color); ?>" />
            </div>

            <div class="gstm-radius-width">
                <span class="gstm-radius-width"><?php esc_html_e( 'Radius', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_radius_width" id="gstm_radius_width" value="<?php echo esc_attr( $gstm_radius_width ); ?>">
            </div>
        </div>
	</div>

    <div class="gstm-btn-wrapper">
        <div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Record Button Color: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-btn-colors">
            <div class="gstm-btn-color">
                <span><?php esc_html_e( 'Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_btn_color" name="gstm_btn_color" value="<?php echo esc_attr($gstm_btn_color); ?>" />
            </div>

            <div class="gstm-btn-hover">
                <span><?php esc_html_e( 'Hover Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_btn_hover" name="gstm_btn_hover" value="<?php echo esc_attr($gstm_btn_hover); ?>" />
            </div>

            <div class="gstm-btn-bg">
                <span><?php esc_html_e( 'Background', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_btn_bg" name="gstm_btn_bg" value="<?php echo esc_attr($gstm_btn_bg); ?>" />
            </div>

            <div class="gstm-btn-bg-hover">
                <span><?php esc_html_e( 'Hover Background', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_btn_bg_hover" name="gstm_btn_bg_hover" value="<?php echo esc_attr($gstm_btn_bg_hover); ?>" />
            </div>
        </div>
    </div>

    <!-- <div class="gstm-rating">
        <div class="gstm-width-label gstm-msg-label">
			<b><?php // esc_html_e( 'Rating: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-btn-rating">
            <div class="gstm-rating-size">
                <span><?php // esc_html_e( 'Size', 'gs-testimonial' ); ?></span><br>
                <input type="number" id="gstm_rating_size" name="gstm_rating_size" value="<?php // echo esc_attr($gstm_rating_size); ?>" />
            </div>

            <div class="gstm-empty-color">
                <span><?php // esc_html_e( 'Empty Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_empty_color" name="gstm_empty_color" value="<?php // echo esc_attr($gstm_empty_color); ?>" />
            </div>

            <div class="gstm-hover-color">
                <span><?php // esc_html_e( 'Hover Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_hover_color" name="gstm_hover_color" value="<?php // echo esc_attr($gstm_hover_color); ?>" />
            </div>

            <div class="gstm-star-color">
                <span><?php // esc_html_e( 'Star Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_star_color" name="gstm_star_color" value="<?php // echo esc_attr($gstm_star_color); ?>" />
            </div>
        </div>
    </div> -->

    <div class="gstm-submit-btn">
        <div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Submit Button Color: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-submit-buttons">
            <div class="gstm-submit-button">
                <span><?php esc_html_e( 'Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_submit_button" name="gstm_submit_button" value="<?php echo esc_attr($gstm_submit_button); ?>" />
            </div>

            <div class="gstm-submit-btn-hover">
                <span><?php esc_html_e( 'Hover Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_submit_btn_hover" name="gstm_submit_btn_hover" value="<?php echo esc_attr($gstm_submit_btn_hover); ?>" />
            </div>

            <div class="gstm-submit-btn-bg">
                <span><?php esc_html_e( 'Background', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_submit_btn_bg" name="gstm_submit_btn_bg" value="<?php echo esc_attr($gstm_submit_btn_bg); ?>" />
            </div>

            <div class="gstm-submit-btn-bg-hover">
                <span><?php esc_html_e( 'Hover Background', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_submit_btn_bg_hover" name="gstm_submit_btn_bg_hover" value="<?php echo esc_attr($gstm_submit_btn_bg_hover); ?>" />
            </div>
        </div>
    </div>

    <div class="gstm-form-bg">
        <div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Form Background: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-form-background">
            <input type="text" id="gstm_form_background" name="gstm_form_background" value="<?php echo esc_attr($gstm_form_background); ?>" />
        </div>
    </div>

    <div class="gstm-form-bg">
        <div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Border: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-border">
            <div class="gstm-border-width">
                <span><?php esc_html_e( 'Width', 'gs-testimonial' ); ?></span><br>
                <input type="number" id="gstm_border_width" name="gstm_border_width" value="<?php echo esc_attr($gstm_border_width); ?>" />
            </div>

            <div class="gstm-border-select">
                <span><?php esc_html_e( 'Style', 'gs-testimonial' ); ?></span><br>
                <select name="gstm_border_type" id="gstm_border_type">                    
                   <?php echo get_border_style_options( $gstm_border_type ); ?>
                </select>
            </div>

            <div class="gstm-border-color">
                <span><?php esc_html_e( 'Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_border_color" name="gstm_border_color" value="<?php echo esc_attr($gstm_border_color); ?>" />
            </div>

            <div class="gstm-border-radius">
                <span><?php esc_html_e( 'Radius', 'gs-testimonial' ); ?></span><br>
                <input type="number" id="gstm_border_radius" name="gstm_border_radius" value="<?php echo esc_attr($gstm_border_radius); ?>" />
            </div>

        </div>

    </div>

    <div class="gstm-box-shadow">
        <div class="gstm-width-label gstm-msg-label">
			<b><?php esc_html_e( 'Box Shadow: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-box-shadow">
            <label class="box-shadow-tab">
                <input type="radio" name="box_shadow" class="box-shadow" <?php checked( $box_shadow, 'inset' ); ?> value="inset">
                <div class="gstm-shadow"><b><?php esc_html_e( 'Inset', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="box-shadow-tab">
                <input type="radio" name="box_shadow" class="box-shadow" <?php checked( $box_shadow, 'outset' ); ?> value="outset">
                <div class="gstm-shadow"><b><?php esc_html_e( 'Outset', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="box-shadow-tab">
                <input type="radio" name="box_shadow" class="box-shadow box-shadow-none" <?php checked( $box_shadow, 'none' ); ?> value="none">
                <div class="gstm-shadow"><b><?php esc_html_e( 'None', 'gs-testimonial' ); ?></b></div>
            </label>
        </div>

    </div>

    <div class="gstm_shadow_values">

        <div class="gstm-shadow-label gstm-msg-label">
            <b><?php esc_html_e( 'Box-Shadow Values: ', 'gs-testimonial' ); ?></b>
        </div>

        <div class="gstm-shadow-wrapper">

            <div class="gstm-x-offset">
                <span><?php esc_html_e( 'X offset', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_x_offset" id="gstm_x_offset" value="<?php echo esc_attr($gstm_x_offset); ?>">
            </div>

            <div class="gstm-y-offset">
                <span><?php esc_html_e( 'Y offset', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_y_offset" id="gstm_y_offset" value="<?php echo esc_attr($gstm_y_offset); ?>">
            </div>

            <div class="gstm-blur">
                <span><?php esc_html_e( 'Blur', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_shadow_blur" id="gstm_shadow_blur" value="<?php echo esc_attr($gstm_shadow_blur); ?>">
            </div>

            <div class="gstm-shadow-spread">
                <span><?php esc_html_e( 'Spread', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_shadow_spread" id="gstm_shadow_spread" value="<?php echo esc_attr($gstm_shadow_spread); ?>">
            </div>

            <div class="gstm-box-shadow-color">
                <span><?php esc_html_e( 'Color', 'gs-testimonial' ); ?></span><br>
                <input type="text" id="gstm_box_shadow_color" name="gstm_box_shadow_color" value="<?php echo esc_attr($gstm_box_shadow_color); ?>" />
            </div>

        </div>
    </div>

    <div class="gstm-form-alignment">

        <div class="gstm-alignment-label gstm-msg-label">
			<b><?php esc_html_e( 'Form Alignment: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-alignment-tabs">
            <label class="box-shadow-tab">
                <input type="radio" name="gstm_alignment" class="box-shadow" <?php checked( $gstm_alignment, 'align_left' ); ?> value="align_left">
                <div class="gstm-shadow"><b><?php esc_html_e( 'Left', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="box-shadow-tab">
                <input type="radio" name="gstm_alignment" class="box-shadow" <?php checked( $gstm_alignment, 'align_center' ); ?> value="align_center">
                <div class="gstm-shadow"><b><?php esc_html_e( 'Center', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="box-shadow-tab">
                <input type="radio" name="gstm_alignment" class="box-shadow" <?php checked( $gstm_alignment, 'align_right' ); ?> value="align_right">
                <div class="gstm-shadow"><b><?php esc_html_e( 'Right', 'gs-testimonial' ); ?></b></div>
            </label>
        </div>

    </div>

    <div class="gstm_padding">

        <div class="gstm-padding-label gstm-msg-label">
			<b><?php esc_html_e( 'Padding: ', 'gs-testimonial' ); ?></b>
		</div>

        <div class="gstm-padding-wrapper">

            <div class="gstm-padding-top">
                <span><?php esc_html_e( 'Top', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_padding_top" id="gstm_padding_top" value="<?php echo esc_attr($gstm_padding_top); ?>">
            </div>

            <div class="gstm-padding-right">
                <span><?php esc_html_e( 'Right', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_padding_right" id="gstm_padding_right" value="<?php echo esc_attr($gstm_padding_right); ?>">
            </div>

            <div class="gstm-padding-bottom">
                <span><?php esc_html_e( 'Bottom', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_padding_bottom" id="gstm_padding_bottom" value="<?php echo esc_attr($gstm_padding_bottom); ?>">
            </div>

            <div class="gstm-padding-left">
                <span><?php esc_html_e( 'Left', 'gs-testimonial' ); ?></span><br>
                <input type="number" name="gstm_padding_left" id="gstm_padding_left" value="<?php echo esc_attr($gstm_padding_left); ?>">
            </div>

        </div>
    </div>
    
</div>
