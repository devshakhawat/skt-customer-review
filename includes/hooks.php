<?php // phpcs:ignore
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;


class Hooks {
	
	use Helpers;
	public function __construct() {

		add_action( 'wp_ajax_get_review_settings', array( $this, 'handle_get_review_settings' ) );
	}

	public function handle_get_review_settings() {

		check_admin_referer( 'skt_plugin_nonce' );

		if( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'status' => 'error' ) );
		}

		$form_data = shortcode_atts( $this->get_defaults(), $_POST );
		$form_data = $this->validate_form_data( $form_data );
		
		$is_updated = $this->update_settings( $form_data );		

		pretty_log( $is_updated );

		if( ! $is_updated ) {
			wp_send_json_error( array( 'status' => 'error' ) );
		}

		wp_send_json_success( array( 'status' => 'Successfully Saved' ) );
	}
}
