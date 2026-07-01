<?php

namespace Services_Carousel\Modules\Post_Types;

use Services_Carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Loads and initializes all post type classes.
 *
 * @since 1.0.0
 */
final class Post_Types {
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
     * Loads dependent post type classes.
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
Post_Types::get_instance();
