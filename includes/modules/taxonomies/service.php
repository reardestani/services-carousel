<?php

namespace Services_carousel\Modules\Taxonomies;

use Services_carousel\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Registers the Service post type.
 *
 * @since 1.0.0
 */
final class Service {
    use Singleton;

    /**
     * Adds the action hook.
     *
     * @since 1.0.0
     */
    protected function add_hooks(): void {
        add_action( 'init', [ $this, 'register_taxonomies' ] );
    }

    /**
     * Registers the Service taxonomies.
     *
     * @since 1.0.0
     */
    public function register_taxonomies(): void {
        $labels = [
            'name'              => esc_html_x( 'Service Categories', 'taxonomy general name', 'services-carousel' ),
            'singular_name'     => esc_html_x( 'Service Category', 'taxonomy singular name', 'services-carousel' ),
            'search_items'      => esc_html__( 'Search Service Categories', 'services-carousel' ),
            'all_items'         => esc_html__( 'All Service Categories', 'services-carousel' ),
            'parent_item'       => esc_html__( 'Parent Service Category', 'services-carousel' ),
            'parent_item_colon' => esc_html__( 'Parent Service Category:', 'services-carousel' ),
            'edit_item'         => esc_html__( 'Edit Service Category', 'services-carousel' ),
            'update_item'       => esc_html__( 'Update Service Category', 'services-carousel' ),
            'add_new_item'      => esc_html__( 'Add New Service Category', 'services-carousel' ),
            'new_item_name'     => esc_html__( 'New Service Category Name', 'services-carousel' ),
            'menu_name'         => esc_html__( 'Service Categories', 'services-carousel' ),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'service-categories' ],
        ];

        register_taxonomy( 'svcl_service_category', [ 'svcl_service' ], $args );
    }
}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Service::get_instance();
