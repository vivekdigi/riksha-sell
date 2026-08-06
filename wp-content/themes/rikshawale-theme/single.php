<?php
/**
 * The template for displaying single blog posts
 */

get_header(); ?>

<main id="primary" class="site-main container py-5 my-4">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="display-5 fw-bold mb-4"><?php the_title(); ?></h1>
            <div class="entry-meta text-muted small mb-4">
                Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
            </div>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-4">
                    <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded-3')); ?>
                </div>
            <?php endif; ?>
            <div class="entry-content lead text-secondary mb-4">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
