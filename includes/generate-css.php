<?php
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
     */
    public function generate_css( $selector, $targets, $prop, $value ) {

        $selectors = [];

		if ( gettype($targets) !== 'array' ) $targets = [$targets];

		foreach ( $targets as $target ) $selectors[] = $selector . $target;

		echo wp_strip_all_tags( sprintf( '%s{%s:%s}', join(',', $selectors), $prop, $value ) );

    }

    public function generate_custom_css( $settings, $shortcode_id ) {

        $parent_selector =  '.gstm_form_' . $shortcode_id;

        ob_start();

        if( !empty( $settings['gstm_width'] ) ) {
            $this->generate_css( $parent_selector, '', 'width', $settings['gstm_width'].'px' );
        }
        
        if( !empty( $settings['gstm_label_color'] ) ) {
            $this->generate_css( $parent_selector, ' label', 'color', $settings['gstm_label_color'] );
        }

        if( !empty( $settings['gstm_inp_width'] ) ) {
            $this->generate_css( $parent_selector, ' input[type=text]', 'width', $settings['gstm_inp_width'].'px' );
        }
        
        if( !empty( $settings['gstm_input_type'] ) ) {
            $this->generate_css( $parent_selector, ' input[type=text]', 'border-style', $settings['gstm_input_type'] );
        }
        
        if( !empty( $settings['gstm_input_color'] ) ) {
            $this->generate_css( $parent_selector, ' input[type=text]', 'border-color', $settings['gstm_input_color'] );
        }
        
        if( !empty( $settings['gstm_bg_color'] ) ) {
            $this->generate_css( $parent_selector, ' input[type=text]', 'background', $settings['gstm_bg_color'] );
        }
        
        if( !empty( $settings['gstm_radius_width'] ) ) {
            $this->generate_css( $parent_selector, ' input[type=text]', 'border-radius', $settings['gstm_radius_width'].'px' );
        }

        if( !empty( $settings['gstm_padding_top'] ) ) {
            $this->generate_css( $parent_selector, '', 'padding-top', $settings['gstm_padding_top'].'px' );
        }
        
        if( !empty( $settings['gstm_padding_left'] ) ) {
            $this->generate_css( $parent_selector, '', 'padding-left', $settings['gstm_padding_left'].'px' );
        }
        
        if( !empty( $settings['gstm_padding_bottom'] ) ) {
            $this->generate_css( $parent_selector, '', 'padding-bottom', $settings['gstm_padding_bottom'].'px' );
        }
        
        if( !empty( $settings['gstm_padding_right'] ) ) {
            $this->generate_css( $parent_selector, '', 'padding-right', $settings['gstm_padding_right'].'px' );
        }

        if( !empty( $settings['gstm_alignment'] == 'align_center' ) ) {
            $this->generate_css( '', '.gstm_form_wrapper_div', 'display', 'flex' );
            $this->generate_css( '', '.gstm_form_wrapper_div', 'justify-content', 'center' );
        }
        
        if( !empty( $settings['gstm_alignment'] == 'align_right' ) ) {
            $this->generate_css( '', '.gstm_form_wrapper_div', 'display', 'flex' );
            $this->generate_css( '', '.gstm_form_wrapper_div', 'justify-content', 'right' );
        }
        
        if( !empty( $settings['gstm_alignment'] == 'align_left' ) ) {
            $this->generate_css( '', '.gstm_form_wrapper_div', 'display', 'flex' );
            $this->generate_css( '', '.gstm_form_wrapper_div', 'justify-content', 'left' );
        }

        if( !empty( $settings['gstm_border_width'] ) ) {
            $this->generate_css( $parent_selector, '', 'border-width', $settings['gstm_border_width'].'px' );
        }

        if( !empty( $settings['gstm_border_type'] ) ) {
            $this->generate_css( $parent_selector, '', 'border-style', $settings['gstm_border_type'] );
        }
        
        if( !empty( $settings['gstm_form_background'] ) ) {
            $this->generate_css( $parent_selector, '', 'background-color', $settings['gstm_form_background'] );
        }
        
        if( !empty( $settings['gstm_border_color'] ) ) {
            $this->generate_css( $parent_selector, '', 'border-color', $settings['gstm_border_color'] );
        }
        
        if( !empty( $settings['gstm_border_radius'] ) ) {
            $this->generate_css( $parent_selector, '', 'border-radius', $settings['gstm_border_radius'].'px' );
        }
        
        if( !empty( $settings['gstm_submit_button'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_submit', 'color', $settings['gstm_submit_button'] );
        }
        
        if( !empty( $settings['gstm_submit_btn_hover'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_submit:hover', 'color', $settings['gstm_submit_btn_hover'] );
        }
        
        if( !empty( $settings['gstm_submit_btn_bg'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_submit', 'background', $settings['gstm_submit_btn_bg'] );
        }
        
        if( !empty( $settings['gstm_submit_btn_bg_hover'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_submit:hover', 'background', $settings['gstm_submit_btn_bg_hover'] );
        }

        if( !empty( $settings['gstm_btn_color'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_video_btn', 'color', $settings['gstm_btn_color'] );
        }
        
        if( !empty( $settings['gstm_btn_hover'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_video_btn:hover', 'color', $settings['gstm_btn_hover'] );
        }
        
        if( !empty( $settings['gstm_btn_bg'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_video_btn', 'background', $settings['gstm_btn_bg'] );
        }
        
        if( !empty( $settings['gstm_btn_bg_hover'] ) ) {
            $this->generate_css( $parent_selector, ' .gstm_video_btn:hover', 'background', $settings['gstm_btn_bg_hover'] );
        }
        
        if( !empty( $settings['box_shadow'] ) && $settings['box_shadow'] !== 'none' ) {

            $box_shadow = $settings['box_shadow'] === 'inset' ? 'inset' : '';
            $shadow = [ $settings['gstm_y_offset'].'px', $settings['gstm_x_offset'].'px', $settings['gstm_shadow_blur'].'px', $settings['gstm_shadow_spread'].'px', $settings['gstm_box_shadow_color'], $box_shadow ];
            $this->generate_css( $parent_selector, ' .gstm_form_wrapper_div', 'box-shadow', implode( ' ', $shadow ) );
        }

        return ob_get_clean();
    }

}
