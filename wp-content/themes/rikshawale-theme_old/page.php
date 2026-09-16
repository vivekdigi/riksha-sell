<?php
/**
 * The template for displaying all pages
 */

get_header();

while ( have_posts() ) : the_post();
    ?>
    <!-- Page Title Header Banner -->
    <div class="page-header-banner" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: #ffffff; padding: 48px 0;">
        <div class="container">
            <h1 class="fw-black mb-0 text-white" style="font-size: 2.3rem; letter-spacing: -0.5px;"><?php the_title(); ?></h1>
        </div>
    </div>

    <!-- Main Content Wrapped in Container -->
    <main id="primary" class="site-main py-5" style="background: #f8fafc; min-height: 65vh;">
        <div class="container">
            <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 text-dark inner-page-content" style="font-family: var(--font-body, 'Inter', sans-serif); line-height: 1.8;">
                <?php the_content(); ?>
            </div>
        </div>
    </main>

    <style>
    .inner-page-content h1, 
    .inner-page-content h2, 
    .inner-page-content h3, 
    .inner-page-content h4, 
    .inner-page-content h5, 
    .inner-page-content h6 {
        color: #0f172a;
        font-weight: 700;
        margin-top: 1.8rem;
        margin-bottom: 0.8rem;
    }
    .inner-page-content h1 { font-size: 2rem; }
    .inner-page-content h2 { font-size: 1.6rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px; }
    .inner-page-content h3 { font-size: 1.3rem; }
    .inner-page-content p {
        color: #334155;
        font-size: 0.96rem;
        margin-bottom: 1.2rem;
    }
    .inner-page-content ul, .inner-page-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
        color: #334155;
    }
    .inner-page-content li {
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    .inner-page-content blockquote {
        border-left: 4px solid var(--primary-color, #db2d2e);
        padding: 12px 20px;
        background: #f8fafc;
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #475569;
        margin: 1.5rem 0;
    }
    .inner-page-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }
    </style>
    <?php
endwhile;

get_footer();
