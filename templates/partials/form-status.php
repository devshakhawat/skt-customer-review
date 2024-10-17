<?php   namespace CUSREVIEW; ?>

<div class="form-status gstm-hide">

    <div class="gstm-status">
        <div class="gstm-status-label gstm-msg-label">
            <b><?php esc_html_e( 'Testimonial Status: ', 'gs-testimonial' ); ?></b>
        </div>

        <select name="gstm_status_options">
            <option value="pending" <?php selected( $gstm_status_options, 'pending' ); ?>><?php esc_html_e( 'Pending Review', 'gs-testimonial' ); ?></option>
            <option value="private" <?php selected( $gstm_status_options, 'private' ); ?>><?php esc_html_e( 'Private', 'gs-testimonial' ); ?></option>
            <option value="draft" <?php selected( $gstm_status_options, 'draft' ); ?>><?php esc_html_e( 'Draft', 'gs-testimonial' ); ?></option>
            <option value="publish" <?php selected( $gstm_status_options, 'publish' ); ?>><?php esc_html_e( 'Auto Publish', 'gs-testimonial' ); ?></option>
        </select>
    </div>

    <div class="status-tabs">
        <div class="admin-notification"><?php esc_html_e( 'Admin Notification', 'gs-testimonial' ); ?></div>
        <div class="awaiting-notification"><?php esc_html_e( 'Awaiting Notification', 'gs-testimonial' ); ?></div>
        <div class="approval-notification"><?php esc_html_e( 'Approval Notification', 'gs-testimonial' ); ?></div>
    </div>

    <?php
        $approved_notification  = '<h2 style="text-align: center; font-size: 24px;">Congrats, Your Testimonial Approved!</h2>';
        $approved_notification .= 'Hi {name}, <br> Congratulations! We are delighted to inform you that your testimonial has been approved. We appreciate your input and value your loyalty. You can now view it on the website. <br> Thank you!.</p>';
    
        $notification  = '<h2 style="text-align: center; font-size: 24px;">Your Testimonial!</h2>';
        $notification  .= 'Hi {name}, <br> Congratulations! We are delighted to inform you that your testimonial has been approved. We appreciate your input and value your loyalty. You can now view it on the website. <br> Thank you!.</p>';

        $gstm_admin_notification    = $gstm_admin_notification ? $gstm_admin_notification : $notification;
        $gstm_awaiting_notification = $gstm_awaiting_notification ? $gstm_awaiting_notification : $notification;
        $gstm_approval_notification = $gstm_approval_notification ? $gstm_approval_notification : $approved_notification;
    ?>

    <div class="status-tab-contents">
        <?php include_once SKT_PLUGIN_DIR . 'templates/partials/status/admin-notification.php'; ?>
        <?php include_once SKT_PLUGIN_DIR . 'templates/partials/status/awaiting-notification.php'; ?>
        <?php include_once SKT_PLUGIN_DIR . 'templates/partials/status/approval-notification.php'; ?>
    </div>

</div>
