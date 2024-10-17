<?php
namespace CUSREVIEW;

// if direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Handles plugin shortcode.
 *
 * @since 1.0.0
 */
class Scripts {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'public_enqueue_scripts' ] );
    }

    /**
     * Enqueue scripts
     *
     * @since 1.0.0
     */
    public function enqueue_scripts() {

    }

    public function public_enqueue_scripts() {


    }

}
