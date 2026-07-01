<?php

namespace Services_Carousel\Modules\Meta_Boxes;

use Services_Carousel\Traits\Singleton;
use WP_Post;

defined( 'ABSPATH' ) || exit;

/**
 * Adds meta box for Service post type.
 *
 * @since 1.0.0
 */
class Service {
    use Singleton;

    /**
     * Adds hooks.
     *
     * @since 1.0.0
     */
    protected function add_hooks(): void {
        add_action( 'add_meta_boxes', [ $this, 'register_meta_box' ] );
        add_action( 'save_post', [ $this, 'save_meta' ], 10, 2 );
    }

    /**
     * Registers meta box.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_meta_box(): void {
        add_meta_box(
            'svcl_service_settings',
            esc_html__( 'Service Settings', 'services-carousel' ),
            [ $this, 'render_meta_box' ],
            'svcl_service',
            'side',
            'default'
        );
    }

    /**
     * Renders meta box.
     *
     * @param WP_Post $post Post object.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function render_meta_box( WP_Post $post ): void {
        wp_nonce_field( 'svcl_save_service_meta', 'svcl_service_nonce' );

        $price = get_post_meta( $post->ID, '_svcl_service_price', true );
        $price = ! empty( $price ) ? (int) $price : '';

        echo '<p><label for="svcl_service_price">' . esc_html__( 'Price', 'services-carousel' ) . '</label></p>';

        printf(
            '<input type="number" id="svcl_service_price" name="svcl_service_price" class="widefat" value="%s">',
            esc_html( $price )
        );
    }

    /**
     * Saves meta.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function save_meta( int $post_id, WP_Post $post ): void {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( $post->post_type !== 'svcl_service' ) {
            return;
        }

        if (
            empty( $_POST['svcl_service_nonce'] )
            || ! wp_verify_nonce( wp_unslash( $_POST['svcl_service_nonce'] ), 'svcl_save_service_meta' )
        ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $price = isset( $_POST['svcl_service_price'] ) ? absint( $_POST['svcl_service_price'] ) : 0;

        if ( $price > 0 ) {
            update_post_meta( $post_id, '_svcl_service_price', $price );
        } else {
            delete_post_meta( $post_id, '_svcl_service_price' );
        }
    }
}

/**
 * Initializes the module.
 *
 * @since 1.0.0
 */
Service::get_instance();
