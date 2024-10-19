<?php // phpcs:ignore
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Generate_CSS {

	/**
	 * Generate CSS
	 *
	 * @param string $selector The CSS selector.
	 * @param mixed  $targets The target elements.
	 * @param string $prop The CSS property.
	 * @param string $value The CSS value.
	 */
	public function generate_css( $selector, $targets, $prop, $value ) {

		$selectors = array();

		if ( gettype( $targets ) !== 'array' ) {
			$targets = array( $targets );
		}

		foreach ( $targets as $target ) {
			$selectors[] = $selector . $target;
		}

		echo wp_strip_all_tags( sprintf( '%s{%s:%s}', join( ',', $selectors ), $prop, $value ) );
	}

	/**
	 * Generate custom CSS based on settings and shortcode ID.
	 *
	 * @param array  $settings The settings array.
	 * @param string $shortcode_id The shortcode ID.
	 * @return string The generated CSS.
	 */
	public function generate_custom_css( $settings, $shortcode_id ) {

		$parent_selector = '.gstm_form_' . $shortcode_id;

		ob_start();

		if ( ! empty( $settings['gstm_width'] ) ) {
			$this->generate_css( $parent_selector, '', 'width', $settings['gstm_width'] . 'px' );
		}

		return ob_get_clean();
	}
}
