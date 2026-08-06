<?php
/**
 * The template for displaying Riksha archives
 */

get_header(); ?>

<div class="container py-5 my-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-4 text-dark">Riksha Archives</h1>
        <p class="text-muted lead">Explore all the available riksha configurations and ride categories.</p>
        <div class="bg-warning mx-auto rounded" style="width: 80px; height: 4px;"></div>
    </div>

    <div class="row g-4">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            if ( ! $thumbnail_url ) {
                $thumbnail_url = 'https://images.unsplash.com/photo-1566838234674-d4508496bf28?auto=format&fit=crop&w=600&q=80';
            }
            $terms = get_the_terms( get_the_ID(), 'riksha_type' );
            $term_name = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'Riksha';
        ?>
            <div class="col-md-4">
                <div class="card riksha-card h-100">
                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" class="card-img-top" style="height: 220px; object-fit: cover;" alt="<?php the_title_attribute(); ?>">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-2">
                            <span class="badge badge-riksha rounded-pill px-3 py-2 text-uppercase"><?php echo esc_html( $term_name ); ?></span>
                        </div>
                        <h4 class="card-title fw-bold text-dark mb-2"><?php the_title(); ?></h4>
                        <p class="card-text text-muted mb-4 small"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark mt-auto w-100 fw-bold">Explore Rides</a>
                    </div>
                </div>
            </div>
        <?php endwhile; else : ?>
            <div class="col-12 text-center py-5">
                <div class="alert alert-info">No Rikshas found.</div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        <?php
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '&laquo; Previous', 'rikshawale-theme' ),
            'next_text' => __( 'Next &raquo;', 'rikshawale-theme' ),
            'class'     => 'pagination justify-content-center',
        ) );
        ?>
    </div>
</div>

<?php get_footer(); ?>
