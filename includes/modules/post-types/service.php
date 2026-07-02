<?php

namespace Services_carousel\Modules\Post_Types;

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
        add_action( 'init', [ $this, 'register_post_type' ] );
    }

    /**
     * Registers the Service post type.
     *
     * @since 1.0.0
     */
    public function register_post_type(): void {
        register_post_type(
            'svcl_service',
            [
                'labels' => [
                    'name'                     => esc_html__( 'Services', 'services-carousel' ),
                    'singular_name'            => esc_html__( 'Service', 'services-carousel' ),
                    'add_new'                  => esc_html__( 'Add New', 'services-carousel' ),
                    'add_new_item'             => esc_html__( 'Add New Service', 'services-carousel' ),
                    'edit_item'                => esc_html__( 'Edit Service', 'services-carousel' ),
                    'new_item'                 => esc_html__( 'New Service', 'services-carousel' ),
                    'view_item'                => esc_html__( 'View Service', 'services-carousel' ),
                    'view_items'               => esc_html__( 'View Services', 'services-carousel' ),
                    'search_items'             => esc_html__( 'Search Services', 'services-carousel' ),
                    'not_found'                => esc_html__( 'No portals found.', 'services-carousel' ),
                    'not_found_in_trash'       => esc_html__( 'No portals found in Trash.', 'services-carousel' ),
                    'parent_item_colon'        => esc_html__( 'Parent Service:', 'services-carousel' ),
                    'all_items'                => esc_html__( 'All Services', 'services-carousel' ),
                    'archives'                 => esc_html__( 'Service Archives', 'services-carousel' ),
                    'attributes'               => esc_html__( 'Service Attributes', 'services-carousel' ),
                    'insert_into_item'         => esc_html__( 'Insert into portal', 'services-carousel' ),
                    'uploaded_to_this_item'    => esc_html__( 'Uploaded to this portal', 'services-carousel' ),
                    'featured_image'           => esc_html__( 'Featured Image', 'services-carousel' ),
                    'set_featured_image'       => esc_html__( 'Set featured image', 'services-carousel' ),
                    'remove_featured_image'    => esc_html__( 'Remove featured image', 'services-carousel' ),
                    'use_featured_image'       => esc_html__( 'Use as featured image', 'services-carousel' ),
                    'menu_name'                => esc_html__( 'Services', 'services-carousel' ),
                    'filter_items_list'        => esc_html__( 'Filter portals list', 'services-carousel' ),
                    'items_list_navigation'    => esc_html__( 'Services list navigation', 'services-carousel' ),
                    'items_list'               => esc_html__( 'Services list', 'services-carousel' ),
                    'item_published'           => esc_html__( 'Service published.', 'services-carousel' ),
                    'item_published_privately' => esc_html__( 'Service published privately.', 'services-carousel' ),
                    'item_reverted_to_draft'   => esc_html__( 'Service reverted to draft.', 'services-carousel' ),
                    'item_scheduled'           => esc_html__( 'Service scheduled.', 'services-carousel' ),
                    'item_updated'             => esc_html__( 'Service updated.', 'services-carousel' ),
                    'item_link'                => esc_html__( 'Service Link', 'services-carousel' ),
                    'item_link_description'    => esc_html__( 'A link to a portal.', 'services-carousel' ),
                    'published'                => esc_html__( 'Service published.', 'services-carousel' ),
                ],
                'public'       => true,
                'show_ui'      => true,
                'show_in_menu' => true,
                'show_in_rest' => true,
                'hierarchical' => false,
                'rewrite'      => [ 'slug' => 'services' ],
                'supports'     => [
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                ],
            ]
        );
    }
}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Service::get_instance();
