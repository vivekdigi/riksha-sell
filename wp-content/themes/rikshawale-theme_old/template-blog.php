<?php
/**
 * Template Name: Blog (4 Columns - 8 Posts, No Sidebar)
 * Description: Custom full-width blog page template with 4 columns per row, 8 posts per page, and numbered pagination.
 */

get_header(); 

// Handle pagination correctly for standard pages and static front page
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

$blog_query_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'paged'          => $paged,
);

$blog_query = new WP_Query( $blog_query_args );
?>

<!-- Page Title Banner -->
<div class="custom-blog-header py-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
    <div class="container text-center py-3">
        <h1 class="fw-bold text-white mb-2" style="font-size: 2.5rem; letter-spacing: -0.5px;"><?php the_title(); ?></h1>
        <p class="text-white-50 mb-0" style="font-size: 1.05rem;">Explore our latest news, articles, and rikshaw updates</p>
    </div>
</div>

<!-- Main Blog Section (No Sidebar) -->
<main id="primary" class="site-main py-5" style="background-color: #f8fafc; min-height: 70vh;">
    <div class="container-fluid px-4 px-lg-5">
        
        <?php if ( $blog_query->have_posts() ) : ?>
            
            <!-- 4 Column Grid Row -->
            <div class="row g-4">
                <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 border-0 shadow-sm custom-blog-card'); ?>>
                            
                            <!-- Featured Image -->
                            <div class="card-img-wrapper overflow-hidden position-relative" style="height: 200px; background-color: #e2e8f0;">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="d-block h-100">
                                        <?php the_post_thumbnail('medium_large', array('class' => 'card-img-top h-100 w-100 object-fit-cover blog-card-img')); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="d-flex align-items-center justify-content-center h-100 text-decoration-none text-secondary">
                                        <i class="fas fa-newspaper fa-3x opacity-50"></i>
                                    </a>
                                <?php endif; ?>

                                <!-- Category Badge -->
                                <?php 
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) : 
                                ?>
                                    <span class="position-absolute top-0 start-0 m-3 badge bg-danger text-uppercase font-sans" style="font-size: 0.75rem; letter-spacing: 0.5px; z-index: 2;">
                                        <?php echo esc_html( $categories[0]->name ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column p-4 bg-white rounded-bottom">
                                <!-- Date & Author Meta -->
                                <div class="entry-meta text-muted small mb-2 d-flex align-items-center gap-3" style="font-size: 0.82rem;">
                                    <span><i class="far fa-calendar-alt text-danger me-1"></i> <?php echo get_the_date('M j, Y'); ?></span>
                                    <span><i class="far fa-user text-danger me-1"></i> <?php the_author(); ?></span>
                                </div>

                                <!-- Post Title -->
                                <h3 class="card-title h5 fw-bold mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark blog-title-link">
                                        <?php echo wp_trim_words( get_the_title(), 10, '...' ); ?>
                                    </a>
                                </h3>

                                <!-- Excerpt -->
                                <p class="card-text text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                                    <?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?>
                                </p>

                                <!-- Read More Link -->
                                <div class="pt-3 border-top border-light mt-auto">
                                    <a href="<?php the_permalink(); ?>" class="fw-bold text-danger text-decoration-none small d-inline-flex align-items-center gap-2 read-more-btn">
                                        Read Story <i class="fas fa-arrow-right transition-icon"></i>
                                    </a>
                                </div>
                            </div>

                        </article>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Custom Pagination -->
            <?php if ( $blog_query->max_num_pages > 1 ) : ?>
                <div class="d-flex justify-content-center mt-5 pt-4">
                    <nav class="custom-blog-pagination">
                        <?php
                        echo paginate_links( array(
                            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'format'       => '?paged=%#%',
                            'current'      => max( 1, $paged ),
                            'total'        => $blog_query->max_num_pages,
                            'prev_text'    => '<i class="fas fa-chevron-left me-1"></i> Prev',
                            'next_text'    => 'Next <i class="fas fa-chevron-right ms-1"></i>',
                            'type'         => 'list',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                        ) );
                        ?>
                    </nav>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                <h3 class="fw-bold text-dark">No Blog Posts Found</h3>
                <p class="text-muted">There are no published articles to display at the moment.</p>
            </div>

        <?php endif; ?>

    </div>
</main>

<style>
/* Custom Blog Template Styling */
.custom-blog-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}
.custom-blog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1) !important;
}
.blog-card-img {
    transition: transform 0.5s ease;
}
.custom-blog-card:hover .blog-card-img {
    transform: scale(1.06);
}
.blog-title-link {
    transition: color 0.2s ease;
}
.blog-title-link:hover {
    color: var(--primary-color, #db2d2e) !important;
}
.read-more-btn .transition-icon {
    transition: transform 0.2s ease;
}
.read-more-btn:hover .transition-icon {
    transform: translateX(4px);
}

/* Pagination Styling */
.custom-blog-pagination ul {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
    align-items: center;
}
.custom-blog-pagination li a,
.custom-blog-pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 16px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #334155;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
    min-width: 42px;
}
.custom-blog-pagination li a:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
    color: #0f172a;
}
.custom-blog-pagination li span.current {
    background: var(--primary-color, #db2d2e);
    color: #ffffff;
    border-color: var(--primary-color, #db2d2e);
    box-shadow: 0 4px 10px rgba(219, 45, 46, 0.25);
}
</style>

<?php get_footer(); ?>
