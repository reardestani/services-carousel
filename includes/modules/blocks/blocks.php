<?php

namespace Services_Carousel\Modules\Blocks;

use Services_Carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Loads and initializes all blocks.
 *
 * @since 1.0.0
 */
final class Blocks {
    use Singleton;

    /**
     * Adds hooks.
     *
     * @since 1.0.0
     */
    public function add_hooks() {
        add_action( 'init', [ $this, 'register_blocks' ] );
    }

    /**
     * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
     * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
     * through the block editor in the corresponding context.
     *
     * @since 1.0.0
     */
    public function register_blocks() {
        wp_register_block_types_from_metadata_collection(
            __DIR__ . '/dist',
            __DIR__ . '/dist/blocks-manifest.php'
        );
    }
}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Blocks::get_instance();
