<?php // phpcs:ignore
namespace SKTPREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;


/**
 * Class Hooks
 *
 * Handles AJAX requests for review settings.
 */
class Hooks {

	use Helpers;

	/**
	 * Constructor for the Hooks class.
	 */
	public function __construct() {
		add_filter( 'plugin_action_links_' . plugin_basename( SKTPR_PLUGIN_FILE ), array( $this, 'add_settings_link' ) );
		add_action( 'wp_ajax_get_review_settings', array( $this, 'handle_get_review_settings' ) );
	}

	/**
	 * Handles the AJAX request to get review settings.
	 */
	public function handle_get_review_settings() {

		check_admin_referer( 'sktpr_plugin_nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'status' => 'error' ) );
		}

		$data = array(
			'enable_video_btn'     => isset( $_POST['enable_video_btn'] ) ? sanitize_text_field( wp_unslash( $_POST['enable_video_btn'] ) ) : '',
			'show_file_uploader'   => isset( $_POST['show_file_uploader'] ) ? sanitize_text_field( wp_unslash( $_POST['show_file_uploader'] ) ) : '',
			'video_duration'       => isset( $_POST['video_duration'] ) ? absint( wp_unslash( $_POST['video_duration'] ) ) : 2,
			'review_btn_color'     => isset( $_POST['review_btn_color'] ) ? sanitize_text_field( wp_unslash( $_POST['review_btn_color'] ) ) : '',
			'review_btn_txt_color' => isset( $_POST['review_btn_txt_color'] ) ? sanitize_text_field( wp_unslash( $_POST['review_btn_txt_color'] ) ) : '',
			'review_btn_text'      => isset( $_POST['review_btn_text'] ) ? sanitize_text_field( wp_unslash( $_POST['review_btn_text'] ) ) : '',
		);

		$form_data = shortcode_atts( $this->get_defaults(), $data );
		$form_data = $this->validate_form_data( $form_data );

		$is_updated = $this->update_settings( $form_data );

		if ( ! $is_updated ) {
			wp_send_json_error( array( 'status' => 'Something Went Wrong!' ) );
		}

		wp_send_json_success( array( 'status' => 'Successfully Saved' ) );
	}

	/**
	 * Adds a settings link to the plugin action links.
	 *
	 * @param array $links An array of plugin action links.
	 * @return array Modified array of plugin action links.
	 */
	public function add_settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=skt-product-reviews">Settings</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}
}
