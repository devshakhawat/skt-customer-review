<?php // phpcs:ignore
namespace SKTPREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

return array(
	'Hooks'           => 'includes/hooks.php',
	'Shortcode'       => 'includes/shortcode.php',
	'Scripts'         => 'includes/scripts.php',
	'Template_Loader' => 'includes/template-loader.php',
	'Video_Btn'       => 'includes/video-btn.php',
	'Admin_Menu'      => 'includes/admin-menu.php',
	'Save_Video'      => 'includes/save-video.php',
	'Display_Video'   => 'includes/display-video.php',
	'Helpers'         => 'includes/helpers.php',
	'Generate_CSS'    => 'includes/generate-css.php',
);
