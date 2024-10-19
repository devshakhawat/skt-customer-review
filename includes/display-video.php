<?php // phpcs:ignore
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Class Display_Video
 *
 * Handles the display of video in WooCommerce reviews.
 */
class Display_Video {

	/**
	 * Display_Video constructor.
	 */
	public function __construct() {
		add_action( 'woocommerce_review_comment_text', array( $this, 'display_video' ) );
	}

	/**
	 * Displays the video in WooCommerce reviews.
	 *
	 * @param object $comments The comment object.
	 */
	public function display_video( $comments ) {

		$comment_id = $comments->comment_ID;
		$video_url  = get_comment_meta( $comment_id, 'uploaded_video_url', true );
		if ( $video_url ) {
			printf(
				'<video width="320" height="240" controls>
                <source src="%s" type="video/mp4">
                Your browser does not support the video tag.
            </video>',
				esc_url( $video_url )
			);
		}
	}
}
