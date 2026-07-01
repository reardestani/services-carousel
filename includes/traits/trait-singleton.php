<?php

namespace Services_Carousel\Traits;

defined( 'ABSPATH' ) || exit;

/**
 * Singleton trait.
 *
 * @since 1.0.0
 */
trait Singleton {
    private static ?self $instance = null;

    /**
     * Returns the instance.
     *
     * @since 1.0.0
     *
     * @return static
     */
    public static function get_instance(): static {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Protected constructor.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        $this->load_functions();
        $this->add_hooks();
    }

    /**
     * Adds hooks.
     *
     * @since 1.0.0
     */
    protected function add_hooks(): void {}

    /**
     * Loads helper file for the module if it exists.
     *
     * @since 1.0.0
     */
    protected function load_functions(): void {
        // Get the module's directory (where the class file is located).
        $reflector = new \ReflectionClass( $this );
        $dir       = dirname( $reflector->getFileName() );

        $functions_file = $dir . '/functions.php';

        if ( file_exists( $functions_file ) ) {
            require_once $functions_file;
        }
    }
}
