<div class="awaiting-notification-container gstm-hide">

    <div class="gstm-awaiting-notification">
        <div class="gstm-admin-label gstm-msg-label">
            <b><?php esc_html_e( 'Awaiting Notification: ', 'gs-testimonial' ); ?></b>
        </div>

        <div class="gstm-switch">
            <input type="checkbox" name="awaiting_notification" <?php checked( $awaiting_notification, 'on' ); ?> id="awaiting_notification">
            <label class="slider" for="awaiting_notification"></label>
        </div>
    </div>

    <div class="awaiting-notification-to">
        <div class="gstm-admin-label gstm-msg-label">
            <b><label for="awaiting_notification_to"><?php esc_html_e( 'To: ', 'gs-testimonial' ); ?></b></label>
        </div>

        <div class="gstm-text-field">
            <input type="text" name="awaiting_notification_to" id="awaiting_notification_to" value="<?php echo esc_attr($awaiting_notification_to); ?>">
        </div>
    </div>

    <div class="awaiting-notification-from">
        <div class="gstm-msg-label">
            <b><label for="awaiting_notification_from"><?php esc_html_e( 'From: ', 'gs-testimonial' ); ?></b></label>
        </div>

        <div class="gstm-text-field">
            <input type="text" name="awaiting_notification_from" id="awaiting_notification_from" value="<?php echo esc_attr($awaiting_notification_from); ?>">
        </div>        
    </div>

    <div class="awaiting-notification-subject">
        <div class="gstm-msg-label">
            <b><label for="awaiting_notification_subject"><?php esc_html_e( 'Subject: ', 'gs-testimonial' ); ?></b></label>
        </div>

        <div class="gstm-text-field">
            <input type="text" name="awaiting_notification_subject" id="awaiting_notification_subject" value="<?php echo esc_attr($awaiting_notification_subject); ?>">
        </div>
    </div>

    <div class="awaiting-notification-message">
        <div class="gstm-msg-label">
            <b><label for="notification_message"><?php esc_html_e( 'Message Body: ', 'gs-testimonial' ); ?></b></label>
        </div>

        <div class="gstm-text-field">
            <?php wp_editor( $gstm_awaiting_notification, 'gstm_awaiting_notification', [] ); ?>
        </div>        
    </div>
</div>
