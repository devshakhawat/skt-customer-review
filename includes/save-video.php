<?php // phpcs:ignore
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Class Save_Video
 *
 * Handles the saving of video files uploaded with comments.
 */
class Save_Video {

	/**
	 * Save_Video constructor.
	 * Adds the action to save video on comment post.
	 */
	public function __construct() {
		add_action( 'comment_post', array( $this, 'save_video' ) );
	}

	/**
	 * Saves the uploaded video file associated with a comment.
	 *
	 * @param int $comment_id The ID of the comment.
	 */
	public function save_video( $comment_id ) {

		if ( isset( $_POST['my_form_nonce_name'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['my_form_nonce_name'] ) ), 'my_form_nonce_action' ) ) {
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';

			// pretty_log( $_FILES );

			if ( ! empty( $_FILES ) ) {
				foreach ( $_FILES as $file_key => $file_array ) {
					if ( UPLOAD_ERR_OK !== $file_array['error'] ) {
						continue;
					}

					$attachment_id = media_handle_upload( $file_key, $comment_id );

					if ( is_wp_error( $attachment_id ) ) {
						continue;
					}

					if ( $attachment_id > 0 ) {
						$allowed_video_types = array( 'video/mp4', 'video/webm', 'video/x-matroska' );

						if ( in_array( $file_array['type'], $allowed_video_types, true ) ) {
							$attachment_url[] = wp_get_attachment_url( $attachment_id );
						}
					}
				}
				if ( isset( $attachment_url ) && ! empty( $attachment_url ) ) {
					update_comment_meta( $comment_id, 'uploaded_video_url', $attachment_url, true );
				}
			}
		}
	}
}
