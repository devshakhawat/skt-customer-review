<?php // phpcs:ignore
namespace SKTPREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Class Reminders_List
 * 
 * Handles display of scheduled email reminders
 */
class Reminders_List {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_submenu' ), 20 );
		add_action( 'admin_init', array( $this, 'handle_actions' ) );
	}

	/**
	 * Add submenu for reminders
	 */
	public function add_submenu() {
		add_submenu_page(
			'skt-product-reviews',
			__( 'Email Reminders', 'product-reviews' ),
			__( 'Email Reminders', 'product-reviews' ),
			'manage_options',
			'skt-product-reviews-reminders',
			array( $this, 'display_reminders_page' )
		);
		
		add_submenu_page(
			'skt-product-reviews',
			__( 'Reminder Diagnostics', 'product-reviews' ),
			__( 'Diagnostics', 'product-reviews' ),
			'manage_options',
			'skt-product-reviews-diagnostics',
			array( $this, 'display_diagnostics_page' )
		);
	}

	/**
	 * Handle reminder actions
	 */
	public function handle_actions() {
		if ( isset( $_GET['action'] ) && isset( $_GET['order_id'] ) ) {
			$order_id = intval( $_GET['order_id'] );
			
			if ( $_GET['action'] === 'cancel' && wp_verify_nonce( $_GET['_wpnonce'], 'cancel_reminder_' . $order_id ) ) {
				$this->cancel_reminder( $order_id );
				wp_redirect( admin_url( 'admin.php?page=skt-product-reviews-reminders&cancelled=1' ) );
				exit;
			}
			
			if ( $_GET['action'] === 'test_reminder' && wp_verify_nonce( $_GET['_wpnonce'], 'test_reminder_' . $order_id ) ) {
				$this->test_reminder( $order_id );
				wp_redirect( admin_url( 'admin.php?page=skt-product-reviews-reminders&tested=1' ) );
				exit;
			}
			
			if ( $_GET['action'] === 'schedule_test' && wp_verify_nonce( $_GET['_wpnonce'], 'schedule_test_' . $order_id ) ) {
				$this->schedule_test_reminder( $order_id );
				wp_redirect( admin_url( 'admin.php?page=skt-product-reviews-diagnostics&scheduled=1' ) );
				exit;
			}
		}
	}

	/**
	 * Display reminders page
	 */
	public function display_reminders_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Email Reminders', 'product-reviews' ); ?></h1>
			<p><?php esc_html_e( 'View and manage scheduled email reminders for product reviews.', 'product-reviews' ); ?></p>
			
			<?php if ( isset( $_GET['cancelled'] ) ) : ?>
				<div class="notice notice-success is-dismissible">
					<p><?php esc_html_e( 'Reminder cancelled successfully.', 'product-reviews' ); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if ( isset( $_GET['tested'] ) ) : ?>
				<div class="notice notice-success is-dismissible">
					<p><?php esc_html_e( 'Test reminder sent successfully.', 'product-reviews' ); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if ( isset( $_GET['scheduled'] ) ) : ?>
				<div class="notice notice-success is-dismissible">
					<p><?php esc_html_e( 'Test reminder scheduled successfully.', 'product-reviews' ); ?></p>
				</div>
			<?php endif; ?>
			
			<?php $this->display_debug_info(); ?>
			<?php $this->display_reminders_table(); ?>
		</div>
		<?php
	}

	/**
	 * Display reminders table
	 */
	private function display_reminders_table() {
		$reminders = $this->get_scheduled_reminders();
		?>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Order ID', 'product-reviews' ); ?></th>
					<th><?php esc_html_e( 'Customer', 'product-reviews' ); ?></th>
					<th><?php esc_html_e( 'Email', 'product-reviews' ); ?></th>
					<th><?php esc_html_e( 'Scheduled Time', 'product-reviews' ); ?></th>
					<th><?php esc_html_e( 'Status', 'product-reviews' ); ?></th>
					<th><?php esc_html_e( 'Actions', 'product-reviews' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( empty( $reminders ) ) : ?>
					<tr>
						<td colspan="6" style="text-align: center; padding: 20px;">
							<?php esc_html_e( 'No scheduled reminders found.', 'product-reviews' ); ?>
						</td>
					</tr>
				<?php else : ?>
					<?php foreach ( $reminders as $reminder ) : ?>
						<tr>
							<td>
								<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $reminder['order_id'] . '&action=edit' ) ); ?>">
									#<?php echo esc_html( $reminder['order_number'] ); ?>
								</a>
							</td>
							<td><?php echo esc_html( $reminder['customer_name'] ); ?></td>
							<td><?php echo esc_html( $reminder['customer_email'] ); ?></td>
							<td>
								<?php 
								echo esc_html( 
									date_i18n( 
										get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), 
										$reminder['scheduled_time'] 
									) 
								); 
								?>
							</td>
							<td>
								<?php
								$status_colors = array(
									'scheduled' => '#0073aa',
									'sent' => '#00a32a',
									'cancelled' => '#d63638',
									'failed' => '#d63638'
								);
								$status_color = isset( $status_colors[ $reminder['status'] ] ) ? $status_colors[ $reminder['status'] ] : '#666';
								$status_text = ucfirst( $reminder['status'] );
								
								if ( $reminder['status'] === 'scheduled' && $reminder['scheduled_time'] < time() ) {
									$status_text = __( 'Overdue', 'product-reviews' );
									$status_color = '#d63638';
								}
								?>
								<span style="color: <?php echo esc_attr( $status_color ); ?>;">
									<?php echo esc_html( $status_text ); ?>
								</span>
								<?php if ( $reminder['sent_at'] ) : ?>
									<br><small><?php echo esc_html( date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $reminder['sent_at'] ) ) ); ?></small>
								<?php endif; ?>
							</td>
							<td>
								<?php if ( $reminder['status'] === 'scheduled' ) : ?>
									<a href="<?php echo esc_url( wp_nonce_url( 
										admin_url( 'admin.php?page=skt-product-reviews-reminders&action=cancel&order_id=' . $reminder['order_id'] ),
										'cancel_reminder_' . $reminder['order_id']
									) ); ?>" 
									   class="button button-small"
									   onclick="return confirm('<?php esc_attr_e( 'Are you sure you want to cancel this reminder?', 'product-reviews' ); ?>')">
										<?php esc_html_e( 'Cancel', 'product-reviews' ); ?>
									</a>
									<a href="<?php echo esc_url( wp_nonce_url( 
										admin_url( 'admin.php?page=skt-product-reviews-reminders&action=test_reminder&order_id=' . $reminder['order_id'] ),
										'test_reminder_' . $reminder['order_id']
									) ); ?>" 
									   class="button button-small button-secondary"
									   style="margin-left: 5px;">
										<?php esc_html_e( 'Test Send', 'product-reviews' ); ?>
									</a>
								<?php elseif ( $reminder['status'] === 'sent' ) : ?>
									<span style="color: #00a32a;">✓ <?php esc_html_e( 'Sent', 'product-reviews' ); ?></span>
								<?php elseif ( $reminder['status'] === 'cancelled' ) : ?>
									<span style="color: #d63638;">✗ <?php esc_html_e( 'Cancelled', 'product-reviews' ); ?></span>
								<?php elseif ( $reminder['status'] === 'failed' ) : ?>
									<span style="color: #d63638;">⚠ <?php esc_html_e( 'Failed', 'product-reviews' ); ?></span>
									<a href="<?php echo esc_url( wp_nonce_url( 
										admin_url( 'admin.php?page=skt-product-reviews-reminders&action=test_reminder&order_id=' . $reminder['order_id'] ),
										'test_reminder_' . $reminder['order_id']
									) ); ?>" 
									   class="button button-small button-secondary"
									   style="margin-left: 5px;">
										<?php esc_html_e( 'Retry', 'product-reviews' ); ?>
									</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Get scheduled reminders
	 * 
	 * @return array
	 */
	private function get_scheduled_reminders() {
		$reminders_data = Database::get_reminders( array(
			'status' => '', // Get all statuses
			'limit' => 100,
			'orderby' => 'scheduled_time',
			'order' => 'ASC'
		) );
		
		$reminders = array();
		if ( $reminders_data ) {
			foreach ( $reminders_data as $reminder ) {
				$order = wc_get_order( $reminder->order_id );
				if ( $order ) {
					$reminders[] = array(
						'id' => $reminder->id,
						'order_id' => $reminder->order_id,
						'order_number' => $order->get_order_number(),
						'customer_name' => $reminder->customer_name,
						'customer_email' => $reminder->customer_email,
						'scheduled_time' => strtotime( $reminder->scheduled_time ),
						'status' => $reminder->status,
						'sent_at' => $reminder->sent_at,
						'created_at' => $reminder->created_at
					);
				}
			}
		}
		
		return $reminders;
	}

	/**
	 * Cancel a reminder
	 * 
	 * @param int $order_id Order ID
	 */
	private function cancel_reminder( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		// Cancel the scheduled event
		wp_clear_scheduled_hook( 'sktpr_send_review_reminder', array( $order_id ) );
		
		// Update reminder status in database
		Database::update_reminder_by_order( $order_id, array(
			'status' => 'cancelled'
		) );
		
		$order->add_order_note( __( 'SKTPR: Review reminder cancelled manually from admin.', 'product-reviews' ) );
	}

	/**
	 * Test sending a reminder immediately
	 * 
	 * @param int $order_id Order ID
	 */
	private function test_reminder( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		// Create email reminders instance and send immediately
		$email_reminders = new Email_Reminders();
		$email_reminders->send_review_reminder( $order_id );
		
		$order->add_order_note( __( 'SKTPR: Test review reminder sent manually from admin.', 'product-reviews' ) );
	}

	/**
	 * Schedule a test reminder for an order
	 * 
	 * @param int $order_id Order ID
	 */
	private function schedule_test_reminder( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		// Create email reminders instance and schedule
		$email_reminders = new Email_Reminders();
		$email_reminders->schedule_reminder( $order_id );
		
		$order->add_order_note( __( 'SKTPR: Test review reminder scheduled manually from diagnostics.', 'product-reviews' ) );
	}

	/**
	 * Check if database table exists
	 * 
	 * @return bool
	 */
	private function check_database_table() {
		global $wpdb;
		
		$table_name = Database::get_table_name();
		$table_exists = $wpdb->get_var( $wpdb->prepare( 
			"SHOW TABLES LIKE %s", 
			$table_name 
		) );
		
		return $table_exists === $table_name;
	}

	/**
	 * Get database version info
	 * 
	 * @return string
	 */
	private function get_database_version_info() {
		$db_version = get_option( 'sktpr_db_version', 'Not Set' );
		$table_exists = $this->check_database_table();
		
		if ( $table_exists && $db_version !== 'Not Set' ) {
			return "✅ v{$db_version}";
		} elseif ( $table_exists ) {
			return "⚠️ Table exists but version not set";
		} else {
			return "❌ Table missing";
		}
	}

	/**
	 * Display debug information
	 */
	private function display_debug_info() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$email_reminders = new Email_Reminders();
		$settings = $email_reminders->get_email_settings();
		
		?>
		<div class="notice notice-info" style="margin-bottom: 20px;">
			<h3><?php esc_html_e( 'Debug Information', 'product-reviews' ); ?></h3>
			<p><strong><?php esc_html_e( 'Email Reminders Enabled:', 'product-reviews' ); ?></strong> 
				<?php echo $settings['enable_email_reminders'] ? __( 'Yes', 'product-reviews' ) : __( 'No', 'product-reviews' ); ?>
			</p>
			<p><strong><?php esc_html_e( 'Trigger Order Status:', 'product-reviews' ); ?></strong> 
				<?php echo esc_html( $settings['trigger_order_status'] ); ?>
			</p>
			<p><strong><?php esc_html_e( 'Email Delay:', 'product-reviews' ); ?></strong> 
				<?php echo esc_html( $settings['email_delay_days'] ); ?> <?php esc_html_e( 'days', 'product-reviews' ); ?>
			</p>
			<p><strong><?php esc_html_e( 'WordPress Cron Status:', 'product-reviews' ); ?></strong> 
				<?php echo defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ? __( 'Disabled', 'product-reviews' ) : __( 'Enabled', 'product-reviews' ); ?>
			</p>
			<p><strong><?php esc_html_e( 'Scheduled Cron Events:', 'product-reviews' ); ?></strong> 
				<?php echo esc_html( $this->count_scheduled_events() ); ?>
			</p>
			<?php if ( isset( $_GET['debug'] ) && $_GET['debug'] === '1' ) : ?>
				<div style="background: #f9f9f9; padding: 10px; margin-top: 10px; font-family: monospace; font-size: 12px;">
					<strong><?php esc_html_e( 'All Scheduled Events:', 'product-reviews' ); ?></strong><br>
					<?php $this->display_all_scheduled_events(); ?>
				</div>
			<?php else : ?>
				<p><a href="<?php echo esc_url( add_query_arg( 'debug', '1' ) ); ?>" class="button button-small">
					<?php esc_html_e( 'Show All Scheduled Events', 'product-reviews' ); ?>
				</a></p>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Count scheduled reminder events
	 * 
	 * @return int
	 */
	private function count_scheduled_events() {
		$stats = Database::get_stats();
		return $stats['scheduled'];
	}

	/**
	 * Display all scheduled events for debugging
	 */
	private function display_all_scheduled_events() {
		$crons = _get_cron_array();
		
		if ( ! $crons ) {
			echo esc_html__( 'No scheduled events found.', 'product-reviews' );
			return;
		}
		
		foreach ( $crons as $timestamp => $cron ) {
			if ( isset( $cron['sktpr_send_review_reminder'] ) ) {
				foreach ( $cron['sktpr_send_review_reminder'] as $event ) {
					$order_id = isset( $event['args'][0] ) ? $event['args'][0] : 'Unknown';
					$scheduled_time = date_i18n( 'Y-m-d H:i:s', $timestamp );
					echo sprintf( 
						'Order ID: %s - Scheduled: %s<br>', 
						esc_html( $order_id ), 
						esc_html( $scheduled_time ) 
					);
				}
			}
		}
	}

	/**
	 * Display diagnostics page
	 */
	public function display_diagnostics_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Email Reminder Diagnostics', 'product-reviews' ); ?></h1>
			<p><?php esc_html_e( 'Use this page to diagnose issues with the email reminder system.', 'product-reviews' ); ?></p>
			
			<?php if ( isset( $_GET['scheduled'] ) ) : ?>
				<div class="notice notice-success is-dismissible">
					<p><?php esc_html_e( 'Test reminder scheduled successfully.', 'product-reviews' ); ?></p>
				</div>
			<?php endif; ?>
			
			<?php $this->display_system_status(); ?>
			<?php $this->display_recent_orders(); ?>
		</div>
		<?php
	}

	/**
	 * Display system status
	 */
	private function display_system_status() {
		$email_reminders = new Email_Reminders();
		$settings = $email_reminders->get_email_settings();
		$stats = Database::get_stats();
		
		?>
		<div class="postbox" style="margin-top: 20px;">
			<h2 class="hndle"><?php esc_html_e( 'System Status', 'product-reviews' ); ?></h2>
			<div class="inside">
				<table class="widefat">
					<tr>
						<td><strong><?php esc_html_e( 'Email Reminders Enabled', 'product-reviews' ); ?></strong></td>
						<td><?php echo $settings['enable_email_reminders'] ? '✅ ' . __( 'Yes', 'product-reviews' ) : '❌ ' . __( 'No', 'product-reviews' ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Trigger Order Status', 'product-reviews' ); ?></strong></td>
						<td><?php echo esc_html( $settings['trigger_order_status'] ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Email Delay Days', 'product-reviews' ); ?></strong></td>
						<td><?php echo esc_html( $settings['email_delay_days'] ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'WordPress Cron', 'product-reviews' ); ?></strong></td>
						<td><?php echo defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ? '❌ ' . __( 'Disabled', 'product-reviews' ) : '✅ ' . __( 'Enabled', 'product-reviews' ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'WooCommerce Active', 'product-reviews' ); ?></strong></td>
						<td><?php echo class_exists( 'WooCommerce' ) ? '✅ ' . __( 'Yes', 'product-reviews' ) : '❌ ' . __( 'No', 'product-reviews' ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'From Email Valid', 'product-reviews' ); ?></strong></td>
						<td><?php echo is_email( $settings['from_email'] ) ? '✅ ' . esc_html( $settings['from_email'] ) : '❌ ' . __( 'Invalid', 'product-reviews' ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Database Table', 'product-reviews' ); ?></strong></td>
						<td><?php echo $this->get_database_version_info(); ?></td>
					</tr>
				</table>
				
				<h3><?php esc_html_e( 'Reminder Statistics', 'product-reviews' ); ?></h3>
				<table class="widefat">
					<tr>
						<td><strong><?php esc_html_e( 'Total Reminders', 'product-reviews' ); ?></strong></td>
						<td><?php echo esc_html( $stats['total'] ); ?></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Scheduled', 'product-reviews' ); ?></strong></td>
						<td><span style="color: #0073aa;"><?php echo esc_html( $stats['scheduled'] ); ?></span></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Sent', 'product-reviews' ); ?></strong></td>
						<td><span style="color: #00a32a;"><?php echo esc_html( $stats['sent'] ); ?></span></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Cancelled', 'product-reviews' ); ?></strong></td>
						<td><span style="color: #d63638;"><?php echo esc_html( $stats['cancelled'] ); ?></span></td>
					</tr>
					<tr>
						<td><strong><?php esc_html_e( 'Failed', 'product-reviews' ); ?></strong></td>
						<td><span style="color: #d63638;"><?php echo esc_html( $stats['failed'] ); ?></span></td>
					</tr>
				</table>
			</div>
		</div>
		<?php
	}

	/**
	 * Display recent orders for testing
	 */
	private function display_recent_orders() {
		$orders = wc_get_orders( array(
			'limit' => 10,
			'status' => array( 'completed', 'processing' ),
			'orderby' => 'date',
			'order' => 'DESC'
		) );
		
		?>
		<div class="postbox" style="margin-top: 20px;">
			<h2 class="hndle"><?php esc_html_e( 'Recent Orders (for testing)', 'product-reviews' ); ?></h2>
			<div class="inside">
				<?php if ( empty( $orders ) ) : ?>
					<p><?php esc_html_e( 'No recent orders found.', 'product-reviews' ); ?></p>
				<?php else : ?>
					<table class="widefat">
						<thead>
							<tr>
								<th><?php esc_html_e( 'Order', 'product-reviews' ); ?></th>
								<th><?php esc_html_e( 'Status', 'product-reviews' ); ?></th>
								<th><?php esc_html_e( 'Customer', 'product-reviews' ); ?></th>
								<th><?php esc_html_e( 'Date', 'product-reviews' ); ?></th>
								<th><?php esc_html_e( 'Reminder Status', 'product-reviews' ); ?></th>
								<th><?php esc_html_e( 'Actions', 'product-reviews' ); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $orders as $order ) : ?>
								<?php
								$reminder = Database::get_reminder_by_order( $order->get_id() );
								?>
								<tr>
									<td>
										<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $order->get_id() . '&action=edit' ) ); ?>">
											#<?php echo esc_html( $order->get_order_number() ); ?>
										</a>
									</td>
									<td><?php echo esc_html( $order->get_status() ); ?></td>
									<td><?php echo esc_html( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() ); ?></td>
									<td><?php echo esc_html( $order->get_date_created()->date_i18n( get_option( 'date_format' ) ) ); ?></td>
									<td>
										<?php if ( $reminder ) : ?>
											<?php if ( $reminder->status === 'sent' ) : ?>
												<span style="color: green;">✅ <?php esc_html_e( 'Sent', 'product-reviews' ); ?></span>
											<?php elseif ( $reminder->status === 'scheduled' ) : ?>
												<span style="color: orange;">⏰ <?php esc_html_e( 'Scheduled', 'product-reviews' ); ?></span>
											<?php elseif ( $reminder->status === 'cancelled' ) : ?>
												<span style="color: #d63638;">✗ <?php esc_html_e( 'Cancelled', 'product-reviews' ); ?></span>
											<?php elseif ( $reminder->status === 'failed' ) : ?>
												<span style="color: #d63638;">⚠ <?php esc_html_e( 'Failed', 'product-reviews' ); ?></span>
											<?php endif; ?>
										<?php else : ?>
											<span style="color: #666;">➖ <?php esc_html_e( 'None', 'product-reviews' ); ?></span>
										<?php endif; ?>
									</td>
									<td>
										<?php if ( ! $reminder || $reminder->status === 'failed' ) : ?>
											<a href="<?php echo esc_url( wp_nonce_url( 
												admin_url( 'admin.php?page=skt-product-reviews-diagnostics&action=schedule_test&order_id=' . $order->get_id() ),
												'schedule_test_' . $order->get_id()
											) ); ?>" class="button button-small">
												<?php esc_html_e( 'Schedule Test', 'product-reviews' ); ?>
											</a>
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}