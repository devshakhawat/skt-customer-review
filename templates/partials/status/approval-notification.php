<div class="approval-notification-container gstm-hide">

    <div class="gstm-approval-notification">
        <div class="gstm-admin-label gstm-msg-label">
            <b><?php esc_html_e( 'Approval Notification: ', 'gs-testimonial' ); ?></b>
        </div>
        <div class="gstm-switch">
            <input type="checkbox" name="approval_notification" <?php checked( $approval_notification, 'on' ); ?> id="approval_notification">
            <label class="slider" for="approval_notification"></label>
        </div>
    </div>

    <div class="approval-notification-to">
        <div class="gstm-admin-label gstm-msg-label">
            <b><label for="notification_to"><?php esc_html_e( 'To: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <input type="text" name="approval_notification_to" id="notification_to" value="<?php echo esc_attr($approval_notification_to); ?>">
        </div>        
    </div>

    <div class="approval-notification-from">
        <div class="gstm-msg-label">
            <b><label for="notification_from"><?php esc_html_e( 'From: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <input type="text" name="approval_notification_from" id="notification_from" value="<?php echo esc_attr($approval_notification_from); ?>">
        </div>        
    </div>

    <div class="approval-notification-subject">
        <div class="gstm-msg-label">
            <b><label for="notification_subject"><?php esc_html_e( 'Subject: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <input type="text" name="approval_notification_subject" id="notification_subject" value="<?php echo esc_attr($approval_notification_subject); ?>">
        </div>        
    </div>

    <div class="approval-notification-message">
        <div class="gstm-msg-label">
            <b><label for="notification_message"><?php esc_html_e( 'Message Body: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <?php wp_editor( $gstm_approval_notification, 'gstm_approval_notification', [] ); ?>
        </div>        
    </div>

</div>
