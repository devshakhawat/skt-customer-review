<?php // phpcs:ignore
namespace SKTPREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Class Video_Reviews_List
 *
 * Handles the display of video reviews in admin area.
 */
class Video_Reviews_List {

	/**
	 * Video_Reviews_List constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_submenu' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Add submenu for video reviews
	 */
	public function add_submenu() {
		add_submenu_page(
			'skt-product-reviews',
			__( 'Video Reviews', 'product-reviews' ),
			__( 'Video Reviews', 'product-reviews' ),
			'manage_options',
			'video-reviews-list',
			array( $this, 'display_video_reviews_page' )
		);
	}

	/**
	 * Enqueue admin scripts and styles
	 */
	public function enqueue_admin_scripts( $hook ) {
		if ( 'product-reviews_page_video-reviews-list' !== $hook ) {
			return;
		}

		wp_enqueue_style( 'wp-list-table' );
		wp_enqueue_style( 'woocommerce_admin_styles' );
		wp_enqueue_style( 'dashicons' );
		
		// Add custom styles for video reviews table
		wp_add_inline_style( 'wp-list-table', '
			.sktpr-video-preview video {
				border-radius: 4px;
				border: 1px solid #ddd;
			}
			.sktpr-star-rating {
				display: flex;
				align-items: center;
				gap: 2px;
			}
			.sktpr-star-rating .dashicons {
				font-size: 16px;
				width: 16px;
				height: 16px;
			}
			.sktpr-rating-text {
				margin-left: 5px;
				font-size: 12px;
				color: #666;
			}
			.sktpr-comment-text {
				max-width: 300px;
			}
			.sktpr-post-state {
				font-weight: 600;
				color: #d63638;
			}
			.wp-list-table .column-video {
				width: 120px;
			}
			.wp-list-table .column-rating {
				width: 100px;
			}
			.wp-list-table .column-date {
				width: 120px;
			}
		' );
	}

	/**
	 * Display video reviews page
	 */
	public function display_video_reviews_page() {
		$list_table = new Video_Reviews_Table();
		$list_table->prepare_items();

		?>
		<div class="wrap">
			<h1 class="wp-heading-inline"><?php esc_html_e( 'Video Reviews', 'product-reviews' ); ?></h1>
			<hr class="wp-header-end">

			<?php $list_table->views(); ?>

			<form method="get">
				<input type="hidden" name="page" value="video-reviews-list" />
				<?php $list_table->search_box( __( 'Search reviews', 'product-reviews' ), 'video-review' ); ?>
				<?php $list_table->display(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Get video reviews data
	 *
	 * @param array $args Query arguments
	 * @return array
	 */
	public static function get_video_reviews( $args = array() ) {
		global $wpdb;

		$defaults = array(
			'number' => 20,
			'offset' => 0,
			'orderby' => 'comment_date',
			'order' => 'DESC',
			'search' => '',
			'status' => 'approve',
		);

		$args = wp_parse_args( $args, $defaults );

		// Base query to get comments with video meta
		$query = "
			SELECT DISTINCT c.*, cm.meta_value as video_urls, p.post_title, p.ID as product_id
			FROM {$wpdb->comments} c
			INNER JOIN {$wpdb->commentmeta} cm ON c.comment_ID = cm.comment_id
			INNER JOIN {$wpdb->posts} p ON c.comment_post_ID = p.ID
			WHERE cm.meta_key = 'uploaded_video_url'
			AND p.post_type = 'product'
		";

		$query_args = array();

		// Handle status filtering
		if ( is_array( $args['status'] ) ) {
			$placeholders = implode( ',', array_fill( 0, count( $args['status'] ), '%s' ) );
			$query .= " AND c.comment_approved IN ($placeholders)";
			$query_args = array_merge( $query_args, $args['status'] );
		} else {
			$query .= " AND c.comment_approved = %s";
			$query_args[] = $args['status'];
		}

		// Add search functionality
		if ( ! empty( $args['search'] ) ) {
			$query .= " AND (c.comment_content LIKE %s OR c.comment_author LIKE %s OR p.post_title LIKE %s)";
			$search_term = '%' . $wpdb->esc_like( $args['search'] ) . '%';
			$query_args[] = $search_term;
			$query_args[] = $search_term;
			$query_args[] = $search_term;
		}

		// Add ordering
		$allowed_orderby = array( 'comment_date', 'comment_author', 'post_title', 'comment_ID' );
		$orderby = in_array( $args['orderby'], $allowed_orderby ) ? $args['orderby'] : 'comment_date';
		$order = strtoupper( $args['order'] ) === 'ASC' ? 'ASC' : 'DESC';
		
		if ( $orderby === 'post_title' ) {
			$query .= " ORDER BY p.post_title {$order}";
		} else {
			$query .= " ORDER BY c.{$orderby} {$order}";
		}

		// Add pagination
		if ( $args['number'] > 0 ) {
			$query .= " LIMIT %d OFFSET %d";
			$query_args[] = $args['number'];
			$query_args[] = $args['offset'];
		}

		return $wpdb->get_results( $wpdb->prepare( $query, $query_args ) );
	}

	/**
	 * Get total count of video reviews
	 *
	 * @param array $args Query arguments
	 * @return int
	 */
	public static function get_video_reviews_count( $args = array() ) {
		global $wpdb;

		$defaults = array(
			'search' => '',
			'status' => 'approve',
		);

		$args = wp_parse_args( $args, $defaults );

		$query = "
			SELECT COUNT(DISTINCT c.comment_ID)
			FROM {$wpdb->comments} c
			INNER JOIN {$wpdb->commentmeta} cm ON c.comment_ID = cm.comment_id
			INNER JOIN {$wpdb->posts} p ON c.comment_post_ID = p.ID
			WHERE cm.meta_key = 'uploaded_video_url'
			AND p.post_type = 'product'
		";

		$query_args = array();

		// Handle status filtering
		if ( is_array( $args['status'] ) ) {
			$placeholders = implode( ',', array_fill( 0, count( $args['status'] ), '%s' ) );
			$query .= " AND c.comment_approved IN ($placeholders)";
			$query_args = array_merge( $query_args, $args['status'] );
		} else {
			$query .= " AND c.comment_approved = %s";
			$query_args[] = $args['status'];
		}

		// Add search functionality
		if ( ! empty( $args['search'] ) ) {
			$query .= " AND (c.comment_content LIKE %s OR c.comment_author LIKE %s OR p.post_title LIKE %s)";
			$search_term = '%' . $wpdb->esc_like( $args['search'] ) . '%';
			$query_args[] = $search_term;
			$query_args[] = $search_term;
			$query_args[] = $search_term;
		}

		return (int) $wpdb->get_var( $wpdb->prepare( $query, $query_args ) );
	}
}