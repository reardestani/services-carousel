<?php

namespace Services_Carousel\Modules;

use Services_Carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Central AJAX Dispatcher.
 *
 * @since 1.0.0
 */
final class Ajax {
    use Singleton;

    /**
     * Adds AJAX hooks.
     *
     * @since 1.0.0
     */
    protected function add_hooks() {
        add_action( 'wp_ajax_services-carousel', [ $this, 'handle_request' ] );
        add_action( 'wp_ajax_nopriv_services-carousel', [ $this, 'handle_request' ] );
    }

    /**
     * Handles central AJAX requests.
     *
     * @since 1.0.0
     */
    public function handle_request() {
        check_ajax_referer( 'services_carousel_nonce' );

        $module  = sanitize_text_field( $_REQUEST['module'] ?? '' );
        $method  = sanitize_text_field( $_REQUEST['method'] ?? '' );
        $payload = $_REQUEST['payload'] ?? [];

        if ( ! $module || ! $method ) {
            wp_send_json_error( esc_html__( 'Missing module or method.', 'services-carousel' ) );
        }

        // Build class name dynamically.
        $class = '\\Services_Carousel\Modules\\' . ucfirst( $module );

        if ( ! class_exists( $class ) ) {
            wp_send_json_error(
                sprintf(
                    esc_html__( 'Unknown module: %s', 'services-carousel' ),
                    $module
                )
            );
        }

        $handler = $class::get_instance();

        if ( ! method_exists( $handler, 'handle_ajax' ) ) {
            wp_send_json_error(
                sprintf(
                    esc_html__( 'Module %s does not support AJAX.', 'services-carousel' ),
                    $module
                )
            );
        }

        $handler->handle_ajax( $method, $payload );
    }

}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Ajax::get_instance();
