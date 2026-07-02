<?php

defined( 'ABSPATH' ) || exit;

$services_query_args = [
    'post_type' => 'svcl_service',
    'orderby'   => 'date',
    'order'     => sanitize_key( $attributes['displayOrder'] ),
];

// Sets posts per page.
if ( ! empty( $attributes['postsPerPage'] ) ) {
    $services_query_args['posts_per_page'] = (int) $attributes['postsPerPage'];
}

// Filters by services categories.
if (
    ! empty( $attributes['categories'] )
    && is_array( $attributes['categories'] )
) {
    $services_query_args['tax_query'] = [
        [
            'taxonomy' => 'svcl_service_category',
            'field'    => 'term_id',
            'terms'    => (array) $attributes['categories'],
        ],
    ];
}

// Filters by price.
if (
    ! empty( $attributes['minPrice'] )
    || ! empty( $attributes['maxPrice'] )
) {
    $services_query_args['meta_query'] = [
        [
            'key'     => '_svcl_service_price',
            'value'   => [ absint( $attributes['minPrice'] ), absint( $attributes['maxPrice'] ) ],
            'type'    => 'numeric',
            'compare' => 'BETWEEN',
        ],
    ];
}

$services_query = new WP_Query( $services_query_args );
?>

<form class="svcl-services-carousel">
    <div class="swiper svcl-swiper">
    <?php if ( $services_query->have_posts() ) : ?>
        <div class="swiper-wrapper">
            <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                <div class="swiper-slide">
                    <?php the_post_thumbnail( get_the_ID(), 'medium' ); ?>
                    <h3 class="svcl-title"><?php esc_html_e( get_the_title() ) ?></h3>
                    <p class="svcl-excerpt"><?php esc_html_e( get_the_excerpt() ) ?></p>
                    <p class="svcl-price"><?php esc_html_e( get_post_meta( get_the_ID(), '_svcl_service_price', true ) ) ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <?php else : ?>
            <?php esc_html_e( 'Sorry, no services matched your criteria.', 'services-carousel' ); ?>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>
