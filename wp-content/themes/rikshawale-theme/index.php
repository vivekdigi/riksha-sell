<?php
/**
 * The main template file
 */

get_header(); ?>

<div class="container py-5 my-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5 pb-5 border-bottom'); ?>>
                    <h2 class="fw-bold mb-3"><a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a></h2>
                    
                    <div class="entry-meta text-muted small mb-3">
                        Posted on <?php the_date(); ?> by <?php the_author(); ?>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded-3')); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content lead text-muted mb-4">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark fw-bold">Read More &raquo;</a>
                </article>
            <?php endwhile; else : ?>
                <div class="alert alert-warning">No content matches your request.</div>
            <?php endif; ?>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&laquo; Previous', 'rikshawale-theme' ),
                    'next_text' => __( 'Next &raquo;', 'rikshawale-theme' ),
                ) );
                ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="p-4 bg-light rounded-3">
                <h4 class="fw-bold mb-3">Search</h4>
                <form role="search" method="get" class="search-form mb-4" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
                        <button class="btn btn-dark" type="submit">Go</button>
                    </div>
                </form>

                <h4 class="fw-bold mb-3">Categories</h4>
                <ul class="list-unstyled">
                    <?php wp_list_categories( array( 'title_li' => '' ) ); ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
