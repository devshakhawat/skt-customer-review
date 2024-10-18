<?php
namespace CUSREVIEW;

// if direct access than exit the fi le.
defined( 'ABSPATH' ) || exit;

class Admin_Menu {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
	}

	public function add_admin_menu() {

		add_menu_page(
			'Video Reviews',           // Page title
			'Video Reviews',              // Menu title
			'manage_options',           // Capability required to view this menu
			'skt-video-reviews',      // Menu slug
			array( $this, 'get_menu_page_data' ),      // Callback function to display the page content
			'dashicons-format-video',  // Icon for the menu (optional)
			50                           // Position in the menu (optional)
		);
	}

	public function get_menu_page_data() {

		echo '<div class="wrap">
			<h1>Video Reviews</h1>
			<p>Here you can view and manage video reviews.</p>';
	}
}
