<?php

namespace Services_Carousel\Modules\Meta_Boxes;

use Services_Carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Loads and initializes all meta box classes.
 *
 * @since 1.0.0
 */
final class Meta_Boxes {
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
     * Loads dependent meta box classes.
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
Meta_Boxes::get_instance();
