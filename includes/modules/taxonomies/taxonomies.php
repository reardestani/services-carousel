<?php

namespace Services_Carousel\Modules\Taxonomies;

use Services_Carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Loads and initializes all taxonomies classes.
 *
 * @since 1.0.0
 */
final class Taxonomies {
    use Singleton;

    /**
     * Initializes the class.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        $this->load_dependencies();
    }

    /**
     * Loads dependent taxonomy classes.
     *
     * @since 1.0.0
     */
    private function load_dependencies(): void {
        $dependencies = [
            'service.php',
        ];

        foreach ( $dependencies as $dependency ) {
            require_once __DIR__ . '/' . $dependency;
        }
    }
}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Taxonomies::get_instance();
