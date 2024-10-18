<?php
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

return array(
	'Hooks'        => 'includes/hooks.php',
	'Shortcode'    => 'includes/shortcode.php',
	'Scripts'      => 'includes/scripts.php',
	'Ajax'         => 'includes/ajax.php',
	'Video_Btn'    => 'includes/video-btn.php',
	'Generate_CSS' => 'includes/generate-css.php',
	'Admin_Menu'   => 'includes/admin-menu.php',
);
