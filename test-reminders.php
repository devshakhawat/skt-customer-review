<?php
/**
 * Test file for debugging email reminders
 * 
 * This file can be run via WP-CLI or included in WordPress to test the reminder system
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	// If running via WP-CLI, load WordPress
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		require_once( dirname( __FILE__ ) . '/../../../wp-load.php' );
	} else {
		exit( 'Direct access not allowed' );
	}
}

use SKTPREVIEW\Email_Reminders;
use SKTPREVIEW\Reminders_List;
use SKTPREVIEW\Database;

/**
 * Test the email reminder system
 */
function test_sktpr_reminders() {
	echo "=== SKTPR Email Reminders Test ===\n";
	
	// Check if WooCommerce is active
	if ( ! class_exists( 'WooCommerce' ) ) {
		echo "❌ WooCommerce is not active\n";
		return;
	}
	echo "✅ WooCommerce is active\n";
	
	// Check email reminders class
	if ( ! class_exists( 'SKTPREVIEW\Email_Reminders' ) ) {
		echo "❌ Email_Reminders class not found\n";
		return;
	}
	echo "✅ Email_Reminders class found\n";
	
	// Initialize email reminders
	$email_reminders = new Email_Reminders();
	$settings = $email_reminders->get_email_settings();
	
	echo "📧 Email reminders enabled: " . ( $settings['enable_email_reminders'] ? 'Yes' : 'No' ) . "\n";
	echo "📧 Trigger status: " . $settings['trigger_order_status'] . "\n";
	echo "📧 Delay days: " . $settings['email_delay_days'] . "\n";
	echo "📧 From email: " . $settings['from_email'] . "\n";
	
	// Check WordPress cron
	echo "⏰ WordPress cron: " . ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ? 'Disabled' : 'Enabled' ) . "\n";
	
	// Get recent orders
	$orders = wc_get_orders( array(
		'limit' => 5,
		'status' => array( 'completed', 'processing' ),
		'orderby' => 'date',
		'order' => 'DESC'
	) );
	
	echo "📦 Recent orders found: " . count( $orders ) . "\n";
	
	foreach ( $orders as $order ) {
		$reminder = Database::get_reminder_by_order( $order->get_id() );
		
		echo sprintf(
			"   Order #%s - Status: %s - Reminder: %s - Scheduled: %s\n",
			$order->get_order_number(),
			$order->get_status(),
			$reminder ? $reminder->status : 'None',
			$reminder ? $reminder->scheduled_time : 'None'
		);
	}
	
	// Check database statistics
	$stats = Database::get_stats();
	echo "📊 Database Statistics:\n";
	echo "   Total: " . $stats['total'] . "\n";
	echo "   Scheduled: " . $stats['scheduled'] . "\n";
	echo "   Sent: " . $stats['sent'] . "\n";
	echo "   Cancelled: " . $stats['cancelled'] . "\n";
	echo "   Failed: " . $stats['failed'] . "\n";
	
	echo "=== Test Complete ===\n";
}

// Run the test if this file is executed directly
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	test_sktpr_reminders();
} elseif ( isset( $_GET['test_reminders'] ) && current_user_can( 'manage_options' ) ) {
	header( 'Content-Type: text/plain' );
	test_sktpr_reminders();
	exit;
}