<?php

namespace Services_Carousel;

defined( 'ABSPATH' ) || exit;

// Loads traits first.
require_once __DIR__ . '/traits/trait-singleton.php';

use Services_Carousel\Traits\Singleton;

/**
 * Core plugin loader.
 *
 * @since 1.0.0
 */
final class Plugin {
    use Singleton;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        $this->define_constants();
        $this->add_hooks();
    }

    /**
     * Defines constants.
     *
     * @since 1.0.0
     */
    private function define_constants() {
        define( 'SVCL_NAME', 'Services Carousel' );
        define( 'SVCL_SLUG', 'services-carousel' );
        define( 'SVCL_VERSION', '1.0.0' );

        define( 'SVCL_PATH', wp_normalize_path( trailingslashit( plugin_dir_path( __DIR__ ) ) ) );
        define( 'SVCL_INCLUDES_PATH', SVCL_PATH . 'includes/' );
        define( 'SVCL_CORE_PATH', SVCL_PATH . 'includes/core/' );
        define( 'SVCL_ASSETS_PATH', SVCL_PATH . 'assets/' );

        define( 'SVCL_URL', wp_normalize_path( trailingslashit( plugin_dir_url( __DIR__ ) ) ) );
        define( 'SVCL_INCLUDES_URL', SVCL_URL . 'includes/' );
        define( 'SVCL_ASSETS_URL', SVCL_URL . 'assets/' );
        define( 'SVCL_CSS_URL', SVCL_ASSETS_URL . 'dist/css/' );
        define( 'SVCL_JS_URL', SVCL_ASSETS_URL . 'dist/js/' );
        define( 'SVCL_IMAGES_URL', SVCL_ASSETS_URL . 'images/' );
    }

    /**
     * Adds hooks.
     *
     * @since 1.0.0
     */
    private function add_hooks() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        add_action( 'services_carousel/init', [ $this, 'load_textdomain' ] );
        add_action( 'services_carousel/init', [ $this, 'load_modules' ] );
    }


    /**
     * Initializes plugin.
     *
     * @since 1.0.0
     */
    public function init() {
        do_action( 'services_carousel/init' );
    }

    /**
     * Loads textdomain.
     *
     * @since 1.0.0
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'services-carousel', false, SVCL_PATH . '/languages' );
    }

    /**
     * Loads modules.
     *
     * @since 1.0.0
     */
    public function load_modules() {
        $modules = [
            'assets/assets.php',
            'ajax/ajax.php',
            'post-types/post-types.php',
        ];

        foreach ( $modules as $module ) {
            require_once __DIR__ . '/modules/' . $module;
        }

        do_action( 'services_carousel/modules_loaded' );
    }
}
