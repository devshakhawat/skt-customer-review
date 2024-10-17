<div class="admin-notification-container gstm-hide">

    <div class="gstm-admin-notification">
        <div class="gstm-admin-label gstm-msg-label">
            <b><?php esc_html_e( 'Admin Notification: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-switch">
            <input type="checkbox" name="admin_toggle" <?php checked( $admin_toggle, 'on' ); ?> id="admin_toggle">
            <label class="slider" for="admin_toggle">
        </div>
    </div>

    <div class="gstm-notification-to">
        <div class="gstm-admin-label gstm-msg-label">
            <b><label for="notification_to"><?php esc_html_e( 'To: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <input type="text" name="notification_to" id="notification_to" value="<?php echo esc_attr($notification_to); ?>">
        </div>
    </div>

    <div class="gstm-notification-from">
        <div class="gstm-msg-label">
            <b><label for="notification_from"><?php esc_html_e( 'From: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <input type="text" name="notification_from" id="notification_from" value="<?php echo esc_attr($notification_from); ?>">
        </div>
    </div>

    <div class="gstm-notification-subject">
        <div class="gstm-msg-label">
            <b><label for="notification_subject"><?php esc_html_e( 'Subject: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <input type="text" name="notification_subject" id="notification_subject" value="<?php echo esc_attr($notification_subject); ?>">
        </div>
    </div>

    <div class="gstm-notification-message">
        <div class="gstm-msg-label">
            <b><label for="notification_message"><?php esc_html_e( 'Message Body: ', 'gs-testimonial' ); ?></b></label>
        </div>
        <div class="gstm-text-field">
            <?php wp_editor( $gstm_admin_notification, 'gstm_admin_notification', [] ); ?>
        </div>
    </div>

</div>
