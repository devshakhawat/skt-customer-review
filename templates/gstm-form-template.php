<?php
namespace CUSREVIEW;

$saved_form_data = get_form_settings( get_the_ID() );
$saved_form_data = shortcode_atts( allow_defauls(), $saved_form_data );

extract( $saved_form_data );

wp_nonce_field( 'gstm_form_meta', 'gstm_nonce_field' );
?>

<div class="gstm-form-wrapper">

	<div class="gstm-form-header">
		<div class="form-editor"><?php esc_html_e( 'Form Editor', 'gs-testimonial' ); ?></div>
		<div class="form-messages"><?php esc_html_e( 'Labels & Messages', 'gs-testimonial' ); ?></div>
		<div class="form-status"><?php esc_html_e( 'Status & Notifications', 'gs-testimonial' ); ?></div>
		<div class="form-styles"><?php esc_html_e( 'Form Styles', 'gs-testimonial' ); ?></div>
	</div>

	<div class="gstm-contents">		
		<?php require_once SKT_PLUGIN_DIR . 'templates/partials/form-editor.php'; ?>
		<?php require_once SKT_PLUGIN_DIR . 'templates/partials/form-messages.php'; ?>
		<?php require_once SKT_PLUGIN_DIR . 'templates/partials/form-status.php'; ?>
		<?php require_once SKT_PLUGIN_DIR . 'templates/partials/form-styles.php'; ?>
	</div>
	
</div>
