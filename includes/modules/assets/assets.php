<?php

namespace Services_Carousel\Modules;

use Services_Carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Assets class.
 *
 * @since 1.0.0
 */
final class Assets {
    use Singleton;

    /**
     * Adds hooks.
     *
     * @since 1.0.0
     */
    protected function add_hooks() {
        add_action( 'init', [ $this, 'register_assets' ] );
    }

    /**
     * ...
     *
     * @since 1.0.0
     */
    protected function get_assets() {
        $assets = [
            'styles' => [],
            'scripts' => [],
        ];

        return $assets;
    }

    /**
     * Registers assets.
     *
     * @since 1.0.0
     */
    public function register_assets() {
        $assets = $this->get_assets();

        // Registers styles.
        if ( ! empty( $assets['styles'] ) ) {
            foreach ( $assets['styles'] as $handle => $style ) {
                wp_register_style(
                    $handle,
                    $style['src'],
                    $style['deps'] ?? [],
                    $style['version'] ?? false,
                    $style['media'] ?? 'all'
                );
            }
        }

        // Registers scripts.
        if ( ! empty( $assets['scripts'] ) ) {
            foreach ( $assets['scripts'] as $handle => $script ) {
                wp_register_script(
                    $handle,
                    $script['src'],
                    $script['deps'] ?? [],
                    $script['version'] ?? false,
                    $script['in_footer'] ?? true
                );
            }
        }

        wp_localize_script( 'jquery-core', 'servicesCarouselData', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'services_carousel_nonce' ),
        ] );
    }

}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Assets::get_instance();
