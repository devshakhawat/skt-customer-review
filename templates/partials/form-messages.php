<?php   namespace CUSREVIEW; ?>

<div class="form-msg-container form-messages gstm-hide">
			
    <div class="switcher-wrapper">
        <div class="req-notice gstm-msg-label">
            <b><?php esc_html_e( 'Required Notice: ', 'gs-testimonial' ); ?></b>
        </div>

        <div class="gstm-switch">
            <input type="checkbox" name="toggle_switch" <?php checked( $toggle_switch, 'on' ); ?> id="toggle-switch">
            <label class="slider" for="toggle-switch"></label>
        </div>
    </div>

    <div class="input-label">
        <div class="notice-label gstm-msg-label"><b><label><?php esc_html_e( 'Notice Label:', 'gs-testimonial' ); ?></label></b></div>
        <div><input type="text" name="notice_label" value="<?php echo esc_attr( $notice_label ?? '' ); ?>"></div>
    </div>

    <div class="switcher-wrapper">
        <div class="req-notice gstm-msg-label">
            <b><?php esc_html_e( 'Ajax Submission: ', 'gs-testimonial' ); ?></b>
        </div>
        <div class="gstm-switch">
            <input type="checkbox" name="ajax_toggle" <?php checked( $ajax_toggle, 'on' ); ?> id="ajax-toggle">
            <label class="slider" for="ajax-toggle"></label>
        </div>
    </div>

    <div class="gstm-redirect">
        <div class="label gstm-msg-label">
            <b><?php esc_html_e( 'Redirect: ', 'gs-testimonial' ); ?></b>
        </div>

        <select name="redirect_option" class="redirect_option">
            <option value="same-page" <?php selected( $redirect_option, 'same-page' ); ?>><?php esc_html_e( 'Same Page', 'gs-testimonial' ); ?></option>
            <option value="new-page" <?php selected( $redirect_option, 'new-page' ); ?>><?php esc_html_e( 'New Page', 'gs-testimonial' ); ?></option>
            <option value="custom-url" <?php selected( $redirect_option, 'custom-url' ); ?>><?php esc_html_e( 'Custom URL', 'gs-testimonial' ); ?></option>
        </select>
    </div>

    <div class="success-message">
        <div class="sm-label gstm-msg-label"><b><label><?php esc_html_e( 'Success Message:', 'gs-testimonial' ); ?></label></b></div>
        <div><input type="text" name="sm_label" value="<?php echo esc_attr( $sm_label ?? '' ); ?>"></div>
    </div>
    
    <div class="gstm-error-message">
        <div class="em-label gstm-msg-label"><b><label><?php esc_html_e( 'Error Message:', 'gs-testimonial' ); ?></label></b></div>
        <div><input type="text" name="em_label" value="<?php echo esc_attr( $em_label ?? '' ); ?>"></div>
    </div>

    <div class="gstm-pages">
        <div class="gstm-msg-label"><b><label for=""><?php esc_html_e( 'Select Page:', 'gs-testimonial' ); ?></label></b></div>
        <select name="gstm_pages">
            <option value=""><?php esc_html_e( 'Select Page', 'gs-testimonial' ); ?></option>
            <?php
            $pages = get_pages();
            foreach ( $pages as $page ) {
                echo '<option value="' . $page->ID . '" ' . selected( $gstm_pages, $page->ID, false ) . '>' . $page->post_title . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="gstm-redirect-url">
        <div class="gstm-msg-label"><b><label for=""><?php esc_html_e( 'Custom URL:', 'gs-testimonial' ); ?></label></b></div>
        <div><input type="text" name="gstm_custom_url" value="<?php echo esc_attr( $gstm_custom_url ?? '' ); ?>"></div>
    </div>

    <div class="form-submission">
        <div class="gstm-msg-label"><b><label for=""><?php esc_html_e( 'Message Position:', 'gs-testimonial' ); ?></label></b></div>
        <div class="tabs">
            <label class="tab">
                <input type="radio" name="tab_input" class="tab-input" <?php checked( $tab_input, 'gstm_top' ); ?> value="gstm_top">
                <div class="tab-box"><b><?php esc_html_e( 'Top', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="tab">
                <input type="radio" name="tab_input" class="tab-input" <?php checked( $tab_input, 'gstm_bottom' ); ?> value="gstm_bottom">
                <div class="tab-box"><b><?php esc_html_e( 'Bottom', 'gs-testimonial' ); ?></b></div>
            </label>
        </div>
    </div>

    <div class="display-mode">
        <div class="gstm-msg-label"><b><label for=""><?php esc_html_e( 'Display Mode:', 'gs-testimonial' ); ?></label></b></div>
        <div class="tabs">
            <label class="tab">
                <input type="radio" name="display_mode" class="gstm-display" <?php checked( $display_mode, 'on_page' ); ?> value="on_page">
                <div class="tab-box"><b><?php esc_html_e( 'On Page', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="tab">
                <input type="radio" name="display_mode" class="gstm-display" <?php checked( $display_mode, 'popup' ); ?> value="popup">
                <div class="tab-box"><b><?php esc_html_e( 'PopUp', 'gs-testimonial' ); ?></b></div>
            </label>
        </div>
    </div>

    <div class="popup-btn">
        <div class="gstm-msg-label">
            <b><label for=""><?php esc_html_e( 'Button Style:', 'gs-testimonial' ); ?></label></b>
        </div>
        <div class="tabs">
            <label class="tab">
                <input type="radio" name="popup_btn" class="gstm-display" <?php checked( $popup_btn, 'gstm_btn' ); ?> value="gstm_btn">
                <div class="tab-box"><b><?php esc_html_e( 'Button', 'gs-testimonial' ); ?></b></div>
            </label>

            <label class="tab">
                <input type="radio" name="popup_btn" class="gstm-display" <?php checked( $popup_btn, 'gstm_text_link' ); ?> value="gstm_text_link">
                <div class="tab-box"><b><?php esc_html_e( 'Text Link', 'gs-testimonial' ); ?></b></div>
            </label>
        </div>
    </div>

    <div class="gstm-btn-label">
        <div class="btn-label gstm-msg-label"><b><label><?php esc_html_e( 'Button Label:', 'gs-testimonial' ); ?></label></b></div>
        <div><input type="text" name="btn_label" value="<?php echo esc_attr( $btn_label ?? '' ); ?>"></div>
    </div>

</div>
