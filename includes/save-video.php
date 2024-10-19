<?php
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

		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';

		if ( $_FILES ) {
			foreach ( $_FILES as $file => $array ) {

				if ( UPLOAD_ERR_OK !== $_FILES[ $file ]['error'] ) {
					continue;
				}

				$attach_id = media_handle_upload( $file, $comment_id );

				if ( ! is_wp_error( $attach_id ) && $attach_id > 0 ) {
					// Set post image.
					if ( 'video/mp4' === $array['type'] || 'video/webm' === $array['type'] || 'video/x-matroska' === $array['type'] ) {

						$attachment_url = wp_get_attachment_url( $attach_id );
						update_comment_meta( $comment_id, 'uploaded_video_url', $attachment_url, true );
					}
				}
			}
		}
	}
}
