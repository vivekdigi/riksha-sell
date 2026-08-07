<?php
/**
 * The front page template file
 */

get_header(); ?>

<!-- 1. Banner Slider Section -->
<?php if ( get_theme_mod( 'show_hero_slider', 1 ) ) : ?>
<section class="hero-slider">
    <?php
    $slider_query = new WP_Query( array(
        'post_type'      => 'riksha',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
    ) );

    if ( $slider_query->have_posts() ) :
    ?>
    <div id="rikshawaleCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php 
            $slide_index = 0;
            while ( $slider_query->have_posts() ) : $slider_query->the_post();
            ?>
                <button type="button" data-bs-target="#rikshawaleCarousel" data-bs-slide-to="<?php echo $slide_index; ?>" class="<?php echo $slide_index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $slide_index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $slide_index + 1; ?>"></button>
            <?php 
                $slide_index++;
            endwhile; 
            $slider_query->rewind_posts(); 
            ?>
        </div>
        <div class="carousel-inner">
            <?php 
            $slide_index = 0;
            while ( $slider_query->have_posts() ) : $slider_query->the_post(); 
                $thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id( get_the_ID() ), 'full' );
                if ( ! $thumbnail_url ) {
                    $thumbnail_url = 'https://images.unsplash.com/photo-1566838234674-d4508496bf28?auto=format&fit=crop&w=1920&q=95';
                }
            ?>
                <div class="carousel-item <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" class="d-block w-100" alt="<?php the_title_attribute(); ?>">
                </div>
            <?php 
                $slide_index++;
            endwhile; 
            wp_reset_postdata();
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#rikshawaleCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#rikshawaleCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php else : ?>
    <!-- Fallback Slider if no posts exist -->
    <div id="rikshawaleCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1566838234674-d4508496bf28?auto=format&fit=crop&w=1920&q=95" class="d-block w-100" alt="Rikshawale Welcome">
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
<?php endif; ?>



<!-- 2. Floating Search Widget -->
<?php if ( get_theme_mod( 'show_search_filter', 0 ) ) : ?>
<div class="floating-search-container">
    <div class="container">
        <div class="floating-search-card">
            <h4><i class="fa fa-search text-primary me-2"></i> Find Your Dream Riksha</h4>
            <form action="<?php echo esc_url( get_post_type_archive_link( 'riksha' ) ); ?>" method="get">
                <div class="row g-3">
                    <!-- Brand (Taxonomy) -->
                    <div class="col-md-4">
                        <select name="riksha_brand" class="form-select">
                            <option value=""><?php _e( 'All Brands / Makes', 'rikshawale-theme' ); ?></option>
                            <?php 
                            $brands = get_terms( array( 'taxonomy' => 'riksha_brand', 'hide_empty' => false ) );
                            if ( ! is_wp_error( $brands ) && ! empty( $brands ) ) {
                                foreach ( $brands as $brand ) {
                                    echo '<option value="' . esc_attr( $brand->slug ) . '">' . esc_html( $brand->name ) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Fuel Type -->
                    <div class="col-md-4">
                        <select name="riksha_fuel" class="form-select">
                            <option value=""><?php _e( 'All Power/Fuel Types', 'rikshawale-theme' ); ?></option>
                            <option value="Electric"><?php _e( 'Electric', 'rikshawale-theme' ); ?></option>
                            <option value="CNG"><?php _e( 'CNG', 'rikshawale-theme' ); ?></option>
                            <option value="LPG"><?php _e( 'LPG', 'rikshawale-theme' ); ?></option>
                            <option value="Petrol"><?php _e( 'Petrol', 'rikshawale-theme' ); ?></option>
                            <option value="Diesel"><?php _e( 'Diesel', 'rikshawale-theme' ); ?></option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-search-submit"><i class="fa fa-sliders me-2"></i> Search Inventory</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Page Editor Content (If added by user or Elementor) -->
<div class="homepage-page-content">
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
endif;
?>
</div>

<!-- 5a. Welcome & About Us Section -->
<section class="welcome-section py-5 my-4">
    <div class="container">
        <div class="row g-4 align-items-center mb-5">
            <!-- Left Column: Dynamic Image Carousel -->
            <div class="col-lg-6 reveal">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg border">
                    <?php 
                    $slide_1 = get_theme_mod( 'welcome_image_1' ) ?: ( get_theme_mod( 'welcome_image' ) ?: content_url( '/uploads/2026/08/ChatGPT-Image-Aug-5-2026-06_58_49-PM.png' ) );
                    $slide_2 = get_theme_mod( 'welcome_image_2' ) ?: content_url( '/uploads/2026/08/ChatGPT-Image-Aug-5-2026-07_29_34-PM.png' );
                    $slide_3 = get_theme_mod( 'welcome_image_3' ) ?: content_url( '/uploads/2026/08/ChatGPT-Image-Aug-5-2026-04_17_52-PM.png' );
                    $slides  = array_filter( array( $slide_1, $slide_2, $slide_3 ) );
                    ?>
                    <div id="aboutUsCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
                        <?php if ( count( $slides ) > 1 ) : ?>
                        <div class="carousel-indicators mb-2">
                            <?php foreach ( array_values( $slides ) as $idx => $s_url ) : ?>
                            <button type="button" data-bs-target="#aboutUsCarousel" data-bs-slide-to="<?php echo $idx; ?>" class="<?php echo $idx === 0 ? 'active' : ''; ?>" aria-current="<?php echo $idx === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $idx + 1; ?>"></button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <div class="carousel-inner rounded-4">
                            <?php foreach ( array_values( $slides ) as $idx => $s_url ) : ?>
                            <div class="carousel-item <?php echo $idx === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo esc_url( $s_url ); ?>" alt="About Rikshawale Banner <?php echo $idx + 1; ?>" class="w-100 h-auto rounded-4 d-block shadow-sm" style="object-fit: cover; max-height: 480px;">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: About Us Text -->
            <div class="col-lg-6 reveal">
                <div class="ps-lg-4 text-start">
                    <span class="text-uppercase fw-bold text-muted d-block mb-2" style="font-size: 0.85rem; letter-spacing: 2px;"><?php echo esc_html( get_theme_mod( 'welcome_subtitle', "BUILDING INDIA'S LARGEST TRUSTED MARKETPLACE" ) ); ?></span>
                    <h2 class="display-6 fw-bold mb-3 text-dark" style="text-transform: uppercase; font-family: var(--font-heading); font-weight: 800;"><?php echo esc_html( get_theme_mod( 'welcome_title', 'ABOUT US' ) ); ?></h2>
                    <div class="gradient-divider ms-0 mb-4" style="margin-left: 0 !important; background: linear-gradient(90deg, #0ea5e9, #ff6b35);"></div>
                    <p class="lead text-muted mb-4" style="font-size: 0.98rem; line-height: 1.8;">
                        <?php echo nl2br( esc_html( get_theme_mod( 'welcome_description', "Rikshawale.com is a technology-driven marketplace for certified pre-owned three-wheelers, connecting buyers and sellers through a trusted, transparent, and hassle-free platform. Every vehicle undergoes a standardized inspection and quality check, with access to refurbishment, financing assistance, warranty support, and seamless ownership transfer. Our mission is to organize and modernize India's highly fragmented used commercial vehicle market, making every transaction simple, secure, and reliable." ) ) ); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- 4 Icon Box Grid -->
        <div class="row g-4 justify-content-center mt-4">
            <!-- Box 1 -->
            <div class="col-lg-3 col-sm-6 text-center reveal reveal-delay-1">
                <div class="feature-circle-box mx-auto mb-3">
                    <i class="<?php echo esc_attr( get_theme_mod( 'welcome_feature1_icon', 'fa-solid fa-car-side' ) ); ?>"></i>
                </div>
                <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.9rem; letter-spacing: 1px;"><?php echo esc_html( get_theme_mod( 'welcome_feature1_title', 'ALL RIKSHAS' ) ); ?></h6>
                <div class="mx-auto rounded mb-3" style="width: 20px; height: 2px; background-color: var(--primary-color);"></div>
                <p class="small text-muted px-3"><?php echo esc_html( get_theme_mod( 'welcome_feature1_desc', 'Every riksha undergoes a rigorous 40-point inspection and quality certification before listing.' ) ); ?></p>
            </div>
            <!-- Box 2 -->
            <div class="col-lg-3 col-sm-6 text-center reveal reveal-delay-2">
                <div class="feature-circle-box mx-auto mb-3">
                    <i class="<?php echo esc_attr( get_theme_mod( 'welcome_feature2_icon', 'fa-solid fa-headset' ) ); ?>"></i>
                </div>
                <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.9rem; letter-spacing: 1px;"><?php echo esc_html( get_theme_mod( 'welcome_feature2_title', 'FREE SUPPORT' ) ); ?></h6>
                <div class="mx-auto rounded mb-3" style="width: 20px; height: 2px; background-color: var(--primary-color);"></div>
                <p class="small text-muted px-3"><?php echo esc_html( get_theme_mod( 'welcome_feature2_desc', 'Our team is available 7 days a week to assist with financing, RC transfer, and after-sale support.' ) ); ?></p>
            </div>
            <!-- Box 3 -->
            <div class="col-lg-3 col-sm-6 text-center reveal reveal-delay-3">
                <div class="feature-circle-box mx-auto mb-3">
                    <i class="<?php echo esc_attr( get_theme_mod( 'welcome_feature3_icon', 'fa-solid fa-hotel' ) ); ?>"></i>
                </div>
                <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.9rem; letter-spacing: 1px;"><?php echo esc_html( get_theme_mod( 'welcome_feature3_title', 'CERTIFIED' ) ); ?></h6>
                <div class="mx-auto rounded mb-3" style="width: 20px; height: 2px; background-color: var(--primary-color);"></div>
                <p class="small text-muted px-3"><?php echo esc_html( get_theme_mod( 'welcome_feature3_desc', 'Buy with confidence — every riksha comes with transparent pricing and a verified ownership history.' ) ); ?></p>
            </div>
            <!-- Box 4 -->
            <div class="col-lg-3 col-sm-6 text-center reveal reveal-delay-4">
                <div class="feature-circle-box mx-auto mb-3">
                    <i class="<?php echo esc_attr( get_theme_mod( 'welcome_feature4_icon', 'fa-solid fa-wallet' ) ); ?>"></i>
                </div>
                <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.9rem; letter-spacing: 1px;"><?php echo esc_html( get_theme_mod( 'welcome_feature4_title', 'EASY FINANCE' ) ); ?></h6>
                <div class="mx-auto rounded mb-3" style="width: 20px; height: 2px; background-color: var(--primary-color);"></div>
                <p class="small text-muted px-3"><?php echo esc_html( get_theme_mod( 'welcome_feature4_desc', 'Low EMI options with instant loan approvals and flexible repayment plans for every budget.' ) ); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- === 1. Inventory Section === -->
<section class="inventory-scroll-section py-3 my-1">
    <div class="container">
        <div class="text-center mb-3">
            <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 2px;"><?php echo esc_html( get_theme_mod('inventory_subtitle', 'Welcome to Rikshawale') ); ?></span>
            <h2 class="fw-bold mt-1 mb-2 text-uppercase" style="font-family: var(--font-heading);"><?php echo esc_html( get_theme_mod('inventory_title', 'Riksha Inventory') ); ?></h2>
            <p class="text-muted small mx-auto" style="max-width: 650px;"><?php echo esc_html( get_theme_mod('inventory_description', 'Certified pre-owned rikshas with 40-point inspection, transparent pricing, easy financing, and 30-day warranty.') ); ?></p>
            <div class="gradient-divider mt-2"></div>
        </div>
        
        <div class="car-slider-wrapper">
            <button type="button" class="car-slider-arrow car-slider-prev" onclick="scrollCarSlider(this, -1)" aria-label="Previous">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="car-slider-track">
                <?php
                $inv_query = new WP_Query( array(
                    'post_type'      => 'inventory',
                    'posts_per_page' => 15,
                    'post_status'    => 'publish',
                ) );
                if ( $inv_query->have_posts() ) :
                    while ( $inv_query->have_posts() ) : $inv_query->the_post();
                        $p_price = get_post_meta( get_the_ID(), '_car_price', true ) ?: get_post_meta( get_the_ID(), '_riksha_price', true );
                        $p_year  = get_post_meta( get_the_ID(), '_car_year', true ) ?: get_post_meta( get_the_ID(), '_riksha_year', true );
                        $p_fuel  = get_post_meta( get_the_ID(), '_car_fuel', true ) ?: get_post_meta( get_the_ID(), '_riksha_fuel', true );
                        $p_trans = get_post_meta( get_the_ID(), '_car_transmission', true ) ?: 'Automatic';
                        $p_state = get_post_meta( get_the_ID(), '_car_exterior', true ) ?: 'DL';
                        $p_badge = get_post_meta( get_the_ID(), '_car_badge', true ) ?: ( has_excerpt() ? get_the_excerpt() : '' );
                        $thumb   = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80';
                ?>
                <div class="car-slider-item">
                    <div class="car-card-exact">
                        <?php if ( $p_badge ) : ?>
                            <span class="car-card-badge"><?php echo esc_html($p_badge); ?></span>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="car-card-img-link">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                        </a>
                        <div class="car-card-content">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="car-card-name text-truncate mb-0 me-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h6>
                                <button class="car-card-bookmark-btn" aria-label="Bookmark">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
                            </div>
                            <div class="car-card-tags mb-2">
                                <span class="car-tag-pill"><?php echo esc_html($p_fuel ?: 'Diesel'); ?></span>
                                <span class="car-tag-pill"><?php echo esc_html($p_trans); ?></span>
                                <span class="car-tag-pill"><?php echo esc_html($p_state); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="car-card-price-main"><?php echo esc_html($p_price ?: '₹10.75 Lakh'); ?></span>
                                <span class="car-card-emi text-muted"><?php echo esc_html($p_year ? 'Year: ' . $p_year : 'EMI available'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <button type="button" class="car-slider-arrow car-slider-next" onclick="scrollCarSlider(this, 1)" aria-label="Next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- === Key Challenges / Services Section (Dynamic CPT: riksha_service) === -->
<?php
$srv_query = new WP_Query( array(
    'post_type'      => 'riksha_service',
    'posts_per_page' => 12,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );
if ( $srv_query->have_posts() ) :
?>
<section class="services-challenges-section py-3 my-1">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="fw-bold text-dark text-uppercase fs-4 mb-2" style="font-family: var(--font-heading); letter-spacing: 0.5px;">
                <?php echo esc_html( get_theme_mod('services_section_title', "Key Challenges in India's Pre-Owned Three-Wheeler Market") ); ?>
            </h2>
            <div class="gradient-divider mx-auto" style="width: 50px; height: 3px; background: var(--primary-color, #db2d2e);"></div>
        </div>

        <div class="row g-3 mb-3">
            <?php
            $default_icon_set = array('🔍', '🤝', '💳', '📄', '🛡️', '📉', '⚡', '🛠️', '🚚', '📊');
            $s_index = 0;
            while ( $srv_query->have_posts() ) : $srv_query->the_post();
                $s_icon_meta = trim( get_post_meta( get_the_ID(), '_service_icon', true ) );
                
                if ( ! empty( $s_icon_meta ) && $s_icon_meta !== '🔍' ) {
                    $s_icon = $s_icon_meta;
                } else {
                    $t_lower = strtolower( get_the_title() );
                    if ( strpos( $t_lower, 'quality' ) !== false || strpos( $t_lower, 'unverified' ) !== false || strpos( $t_lower, 'inspect' ) !== false || strpos( $t_lower, 'health' ) !== false ) {
                        $s_icon = '🔍';
                    } elseif ( strpos( $t_lower, 'market' ) !== false || strpos( $t_lower, 'fragment' ) !== false || strpos( $t_lower, 'unorgan' ) !== false || strpos( $t_lower, 'broker' ) !== false || strpos( $t_lower, 'dealer' ) !== false ) {
                        $s_icon = '🤝';
                    } elseif ( strpos( $t_lower, 'financ' ) !== false || strpos( $t_lower, 'loan' ) !== false || strpos( $t_lower, 'bank' ) !== false || strpos( $t_lower, 'credit' ) !== false || strpos( $t_lower, 'access' ) !== false ) {
                        $s_icon = '💳';
                    } elseif ( strpos( $t_lower, 'transfer' ) !== false || strpos( $t_lower, 'rto' ) !== false || strpos( $t_lower, 'ownership' ) !== false || strpos( $t_lower, 'doc' ) !== false || strpos( $t_lower, 'complex' ) !== false ) {
                        $s_icon = '📄';
                    } elseif ( strpos( $t_lower, 'warrant' ) !== false || strpos( $t_lower, 'assuran' ) !== false || strpos( $t_lower, 'guarantee' ) !== false || strpos( $t_lower, 'safety' ) !== false || strpos( $t_lower, 'risk' ) !== false ) {
                        $s_icon = '🛡️';
                    } elseif ( strpos( $t_lower, 'price' ) !== false || strpos( $t_lower, 'pricing' ) !== false || strpos( $t_lower, 'cost' ) !== false || strpos( $t_lower, 'rate' ) !== false || strpos( $t_lower, 'valu' ) !== false || strpos( $t_lower, 'lack' ) !== false ) {
                        $s_icon = '📉';
                    } else {
                        $s_icon = $default_icon_set[ $s_index % count($default_icon_set) ];
                    }
                }
                $s_index++;
            ?>
            <div class="col-md-4">
                <div class="card h-100 p-3 challenge-card-gradient">
                    <div class="card-body p-1">
                        <h6 class="fw-bold mb-2 d-flex align-items-center">
                            <span class="challenge-icon-box fs-5">
                                <?php if ( strpos($s_icon, 'fa-') !== false ) : ?>
                                    <i class="<?php echo esc_attr($s_icon); ?>"></i>
                                <?php else : ?>
                                    <?php echo esc_html($s_icon); ?>
                                <?php endif; ?>
                            </span>
                            <span><?php the_title(); ?></span>
                        </h6>
                        <p class="small mb-0 lh-base">
                            <?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>

        <!-- Key Investor Insight Highlight Box -->
        <div class="p-4 text-start insight-card-gradient">
            <h6 class="fw-bold mb-2 fs-6 text-uppercase" style="letter-spacing: 1px;">
                💡 <?php echo esc_html( get_theme_mod('services_insight_title', 'Key Investor Insight') ); ?>
            </h6>
            <p class="small mb-0 lh-base" style="font-size: 0.92rem;">
                <?php echo esc_html( get_theme_mod('services_insight_text', "India's pre-owned three-wheeler market remains highly fragmented, creating a significant opportunity for a trusted, technology-enabled platform that standardizes sourcing, inspection, financing, and ownership transfer.") ); ?>
            </p>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- === 3. 4-Video Autoplay Grid === -->
<?php
$has_any_video = false;
for ( $v = 1; $v <= 4; $v++ ) {
    if ( get_theme_mod("video_{$v}_url", '') ) { $has_any_video = true; break; }
}
?>
<?php if ( $has_any_video ) : ?>
<section class="video-section py-3 my-1">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold reveal"><?php echo esc_html( get_theme_mod('video_section_title', 'Watch Us In Action') ); ?></h2>
            <p class="text-muted reveal reveal-delay-1"><?php echo esc_html( get_theme_mod('video_section_subtitle', 'Explore our latest arrivals and customer stories') ); ?></p>
            <div class="gradient-divider"></div>
        </div>
        <div class="row g-3">
            <?php for ( $v = 1; $v <= 4; $v++ ) :
                $video_url   = get_theme_mod("video_{$v}_url", '');
                $video_thumb = get_theme_mod("video_{$v}_thumb", '');
                if ( ! $video_url ) continue;

                // Detect if it's a YouTube/Vimeo embed
                $is_youtube = ( strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false );
                $is_vimeo   = strpos($video_url, 'vimeo.com') !== false;

                // Build YouTube embed URL
                if ( $is_youtube ) {
                    preg_match('/(?:v=|youtu\.be\/|embed\/)([a-zA-Z0-9_-]{11})/', $video_url, $yt_matches);
                    $yt_id = $yt_matches[1] ?? '';
                    $embed_url = "https://www.youtube.com/embed/{$yt_id}?autoplay=1&mute=1&loop=1&playlist={$yt_id}&controls=1&rel=0";
                }
                // Build Vimeo embed URL
                if ( $is_vimeo ) {
                    preg_match('/vimeo\.com\/(\d+)/', $video_url, $vi_matches);
                    $vi_id = $vi_matches[1] ?? '';
                    $embed_url = "https://player.vimeo.com/video/{$vi_id}?autoplay=1&muted=1&loop=1";
                }
            ?>
            <div class="col-md-3 col-sm-6 reveal reveal-delay-<?php echo $v; ?>">
                <div class="video-grid-item">
                    <?php if ( $is_youtube || $is_vimeo ) : ?>
                        <iframe src="<?php echo esc_url($embed_url); ?>" title="Video <?php echo $v; ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                    <?php else : ?>
                        <video
                            autoplay muted loop playsinline
                            <?php if ( $video_thumb ) echo 'poster="' . esc_url($video_thumb) . '"'; ?>
                            preload="metadata">
                            <source src="<?php echo esc_url($video_url); ?>" type="video/<?php echo pathinfo(parse_url($video_url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'mp4'; ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>
                    <?php if ( $video_thumb && !$is_youtube && !$is_vimeo ) : ?>
                        <div class="video-play-btn"><i class="fa-solid fa-play"></i></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- === 4. New Arrivals Section === -->
<section class="new-arrivals-scroll-section py-3 my-1">
    <div class="container">
        <div class="text-center mb-3">
            <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 2px;"><?php echo esc_html( get_theme_mod('new_arrivals_subtitle', 'Explore') ); ?></span>
            <h2 class="fw-bold mt-1 mb-2 text-uppercase" style="font-family: var(--font-heading);"><?php echo esc_html( get_theme_mod('new_arrivals_title', 'New Arrivals') ); ?></h2>
            <div class="gradient-divider mt-2"></div>
        </div>
        
        <div class="car-slider-wrapper">
            <button type="button" class="car-slider-arrow car-slider-prev" onclick="scrollCarSlider(this, -1)" aria-label="Previous">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="car-slider-track">
                <?php
                $new_query = new WP_Query( array(
                    'post_type'      => 'inventory',
                    'posts_per_page' => 15,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                ) );
                if ( $new_query->have_posts() ) :
                    while ( $new_query->have_posts() ) : $new_query->the_post();
                        $p_price = get_post_meta( get_the_ID(), '_car_price', true ) ?: get_post_meta( get_the_ID(), '_riksha_price', true );
                        $p_year  = get_post_meta( get_the_ID(), '_car_year', true ) ?: get_post_meta( get_the_ID(), '_riksha_year', true );
                        $p_fuel  = get_post_meta( get_the_ID(), '_car_fuel', true ) ?: get_post_meta( get_the_ID(), '_riksha_fuel', true );
                        $p_trans = get_post_meta( get_the_ID(), '_car_transmission', true ) ?: 'Automatic';
                        $p_state = get_post_meta( get_the_ID(), '_car_exterior', true ) ?: 'DL';
                        $p_badge = get_post_meta( get_the_ID(), '_car_badge', true ) ?: 'LIMITED OFFER';
                        $thumb   = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80';
                ?>
                <div class="car-slider-item">
                    <div class="car-card-exact">
                        <span class="car-card-badge"><?php echo esc_html($p_badge); ?></span>
                        <a href="<?php the_permalink(); ?>" class="car-card-img-link">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                        </a>
                        <div class="car-card-content">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="car-card-name text-truncate mb-0 me-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h6>
                                <button class="car-card-bookmark-btn" aria-label="Bookmark">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
                            </div>
                            <div class="car-card-tags mb-2">
                                <span class="car-tag-pill"><?php echo esc_html($p_fuel ?: 'Petrol'); ?></span>
                                <span class="car-tag-pill"><?php echo esc_html($p_trans); ?></span>
                                <span class="car-tag-pill"><?php echo esc_html($p_state); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="car-card-price-main"><?php echo esc_html($p_price ?: '₹13.75 Lakh'); ?></span>
                                <span class="car-card-emi text-muted"><?php echo esc_html($p_year ? 'Year: ' . $p_year : 'EMI available'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <button type="button" class="car-slider-arrow car-slider-next" onclick="scrollCarSlider(this, 1)" aria-label="Next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- 5b. Contact Split-Car Banner Section -->
<section class="contact-split-banner py-3 my-1 overflow-hidden">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Left Side Image -->
            <div class="col-md-3 text-center d-none d-md-block">
                <?php 
                $left_img = get_theme_mod( 'contact_banner_left_img', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80' );
                if ( $left_img ) :
                ?>
                    <img src="<?php echo esc_url( $left_img ); ?>" class="img-fluid split-car-left" alt="Left Vehicle">
                <?php endif; ?>
            </div>
            <!-- Center Content -->
            <div class="col-md-6 text-center py-3">
                <div class="contact-avatar-container mb-2">
                    <?php 
                    $avatar_img = get_theme_mod( 'contact_banner_avatar', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&h=150&q=80' );
                    if ( $avatar_img ) :
                    ?>
                        <img src="<?php echo esc_url( $avatar_img ); ?>" class="rounded-circle shadow-sm" alt="Contact Support" style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #f8f9fa;">
                    <?php endif; ?>
                </div>
                <h5 class="text-muted fw-semibold mb-2" style="font-size: 1rem; letter-spacing: 0.5px;"><?php echo esc_html( get_theme_mod( 'contact_banner_subtitle', 'Have any question ?' ) ); ?></h5>
                <h2 class="fw-bold display-6 text-danger" style="color: var(--primary-color) !important; font-family: var(--font-heading); font-weight: 800;"><?php echo esc_html( get_theme_mod( 'topbar_phone', '+1 234 567 8900' ) ); ?></h2>
            </div>
            <!-- Right Side Image -->
            <div class="col-md-3 text-center d-none d-md-block">
                <?php 
                $right_img = get_theme_mod( 'contact_banner_right_img', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80' );
                if ( $right_img ) :
                ?>
                    <img src="<?php echo esc_url( $right_img ); ?>" class="img-fluid split-car-right" alt="Right Vehicle">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- === 5c. Our Team Section (2 per row slider CPT: riksha_team) === -->
<?php
$team_query = new WP_Query( array(
    'post_type'      => 'riksha_team',
    'posts_per_page' => 10,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );
if ( $team_query->have_posts() ) :
?>
<section class="our-team-section py-3 my-1 position-relative">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="fw-bold uppercase reveal"><?php echo esc_html( get_theme_mod( 'team_section_title', 'Meet Our Team' ) ); ?></h2>
            <p class="text-muted reveal reveal-delay-1 mb-2"><?php echo esc_html( get_theme_mod( 'team_section_subtitle', 'The passionate professionals driving Rikshawale forward' ) ); ?></p>
            <div class="gradient-divider mx-auto" style="width: 50px; height: 3px; background: var(--primary-color, #db2d2e);"></div>
        </div>

        <div class="team-slider-wrapper position-relative px-4">
            <button type="button" class="team-slider-arrow team-slider-prev" onclick="scrollTeamSlider(-1)" aria-label="Previous">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="team-slider-track" id="teamSliderTrack">
                <?php
                while ( $team_query->have_posts() ) : $team_query->the_post();
                    $t_role  = get_post_meta( get_the_ID(), '_team_designation', true ) ?: ( get_the_excerpt() ?: 'Team Specialist' );
                    $t_photo = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80';
                ?>
                <div class="team-slider-item">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 p-3">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5 text-center p-2">
                                <img src="<?php echo esc_url($t_photo); ?>" class="img-fluid rounded-4 object-fit-cover w-100" style="height: 180px;" alt="<?php the_title_attribute(); ?>">
                            </div>
                            <div class="col-md-7 p-3">
                                <h5 class="fw-bold text-dark mb-1"><?php the_title(); ?></h5>
                                <span class="badge mb-2 px-3 py-2 text-wrap" style="background-color: rgba(219, 45, 46, 0.1); color: var(--primary-color, #db2d2e); font-size: 0.82rem; border: 1px solid rgba(219, 45, 46, 0.2);"><?php echo esc_html($t_role); ?></span>
                                <p class="text-secondary small mb-0 lh-base">
                                    <?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <button type="button" class="team-slider-arrow team-slider-next" onclick="scrollTeamSlider(1)" aria-label="Next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 6. Why Choose Us Section -->
<?php if ( get_theme_mod( 'show_why_choose_us', 1 ) ) : ?>
<section class="why-choose-us py-3 my-1">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="fw-bold uppercase reveal"><?php echo esc_html( get_theme_mod( 'why_choose_title', 'Why Choose Rikshawale' ) ); ?></h2>
            <p class="text-muted reveal reveal-delay-1 mb-2"><?php echo esc_html( get_theme_mod( 'why_choose_subtitle', 'We provide unmatched commercial transport solutions' ) ); ?></p>
            <div class="gradient-divider"></div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="icon-box-card">
                    <div class="icon-wrapper">
                        <i class="<?php echo esc_attr( get_theme_mod( 'why_choose_box1_icon', 'fa-solid fa-shield-halved' ) ); ?>"></i>
                    </div>
                    <h4><?php echo esc_html( get_theme_mod( 'why_choose_box1_title', 'Verified Inventory' ) ); ?></h4>
                    <p><?php echo esc_html( get_theme_mod( 'why_choose_box1_desc', 'Every auto or e-rickshaw listed on our platform undergoes extensive quality assessments and certification checks.' ) ); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box-card">
                    <div class="icon-wrapper">
                        <i class="<?php echo esc_attr( get_theme_mod( 'why_choose_box2_icon', 'fa-solid fa-indian-rupee-sign' ) ); ?>"></i>
                    </div>
                    <h4><?php echo esc_html( get_theme_mod( 'why_choose_box2_title', 'Flexible Finance' ) ); ?></h4>
                    <p><?php echo esc_html( get_theme_mod( 'why_choose_box2_desc', 'Get instant commercial approvals, affordable EMI interest options, and flexible auto lease programs customized for you.' ) ); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box-card">
                    <div class="icon-wrapper">
                        <i class="<?php echo esc_attr( get_theme_mod( 'why_choose_box3_icon', 'fa-solid fa-screwdriver-wrench' ) ); ?>"></i>
                    </div>
                    <h4><?php echo esc_html( get_theme_mod( 'why_choose_box3_title', '24/7 Roadside Support' ) ); ?></h4>
                    <p><?php echo esc_html( get_theme_mod( 'why_choose_box3_desc', 'We keep your business moving with dedicated call assistance, roadside towing, and certified mechanics nearby.' ) ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 8. Testimonials Section -->
<?php if ( get_theme_mod( 'show_testimonials', 1 ) ) : 
$testimonial_query = new WP_Query( array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 10,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
if ( $testimonial_query->have_posts() ) :
?>
<section class="testimonials py-3 my-1">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="fw-bold uppercase"><?php echo esc_html( get_theme_mod( 'testimonials_title', 'Customer Testimonials' ) ); ?></h2>
            <p class="text-muted mb-2"><?php echo esc_html( get_theme_mod( 'testimonials_subtitle', 'What our fleet managers and drivers say about us' ) ); ?></p>
            <div class="mx-auto rounded" style="width: 50px; height: 3px; background-color: var(--primary-color);"></div>
        </div>
        
        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-inner">
                <?php 
                $slide_index = 0;
                $count = 0;
                while ( $testimonial_query->have_posts() ) : $testimonial_query->the_post();
                    if ( $count % 2 === 0 ) {
                        $active_class = ( $slide_index === 0 ) ? 'active' : '';
                        echo '<div class="carousel-item ' . $active_class . '"><div class="row g-3">';
                    }
                    ?>
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="testimonial-img">
                                    <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="testimonial-card-body">
                                <p class="mb-2">"<?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>"</p>
                                <div class="testimonial-author text-primary">— <?php the_title(); ?><?php if ( has_excerpt() ) { echo ', ' . esc_html( get_the_excerpt() ); } ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                    if ( $count % 2 === 0 || $count === $testimonial_query->post_count ) {
                        echo '</div></div>';
                        $slide_index++;
                    }
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            
            <!-- Indicators / Controls -->
            <?php if ( $testimonial_query->post_count > 2 ) : ?>
                <div class="carousel-indicators-custom text-center mt-3">
                    <?php 
                    $num_slides = ceil( $testimonial_query->post_count / 2 );
                    for ( $i = 0; $i < $num_slides; $i++ ) {
                        $active_class = ( $i === 0 ) ? 'active' : '';
                        echo '<button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="' . $i . '" class="btn-indicator ' . $active_class . '" aria-label="Slide ' . ($i + 1) . '"></button>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; endif; ?>

<!-- === SECTION D: FAQ Accordion === -->
<?php
$faq_query = new WP_Query( array(
    'post_type'      => 'riksha_faq',
    'posts_per_page' => 20,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );
if ( $faq_query->have_posts() ) :
?>
<section class="faq-section py-3 my-1">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="fw-bold reveal"><?php echo esc_html( get_theme_mod('faq_section_title', 'Frequently Asked Questions') ); ?></h2>
            <div class="gradient-divider mt-2"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <?php $faq_i = 0; while ( $faq_query->have_posts() ) : $faq_query->the_post(); $faq_i++; ?>
                    <div class="accordion-item faq-item reveal reveal-delay-1">
                        <h2 class="accordion-header" id="faqHead<?php echo $faq_i; ?>">
                            <button class="accordion-button <?php echo $faq_i > 1 ? 'collapsed' : ''; ?> faq-btn" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqBody<?php echo $faq_i; ?>"
                                aria-expanded="<?php echo $faq_i === 1 ? 'true' : 'false'; ?>"
                                aria-controls="faqBody<?php echo $faq_i; ?>">
                                <?php the_title(); ?>
                            </button>
                        </h2>
                        <div id="faqBody<?php echo $faq_i; ?>" class="accordion-collapse collapse <?php echo $faq_i === 1 ? 'show' : ''; ?>"
                            aria-labelledby="faqHead<?php echo $faq_i; ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body faq-body">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Cursor Glow Element -->
<div id="cursor-glow"></div>
<!-- Page Loader Bar -->
<div id="page-loader-bar"></div>

<script>
(function() {
    // ---- Page Loader Bar ----
    var loaderBar = document.getElementById('page-loader-bar');
    if (loaderBar) {
        loaderBar.style.width = '30%';
        window.addEventListener('load', function() {
            loaderBar.style.width = '100%';
            setTimeout(function() { loaderBar.style.opacity = '0'; }, 400);
        });
    }

    // ---- Scroll Reveal (IntersectionObserver) ----
    var revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        var revealObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
        revealEls.forEach(function(el) { revealObserver.observe(el); });
    } else {
        // Fallback: show all immediately
        revealEls.forEach(function(el) { el.classList.add('is-visible'); });
    }

    // ---- Sticky header scroll class ----
    var header = document.querySelector('.site-header, header.header-custom, nav.navbar-custom');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 60) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        }, { passive: true });
    }

    // ---- Cursor Glow Trail ----
    var glow = document.getElementById('cursor-glow');
    if (glow && window.matchMedia('(pointer: fine)').matches) {
        document.addEventListener('mousemove', function(e) {
            glow.style.left = e.clientX + 'px';
            glow.style.top  = e.clientY + 'px';
        }, { passive: true });
    }

    // ---- Smooth anchor scrolling ----
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ---- AJAX Contact Form ----
    var contactForm = document.getElementById('rikshawale-contact-form');
    var formResponse = document.getElementById('git-form-response');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var submitBtn = contactForm.querySelector('[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Sending...';
            formResponse.innerHTML = '';
            formResponse.style.color = '';

            var formData = new FormData(contactForm);
            formData.append('action', 'rikshawale_contact');

            fetch('<?php echo esc_url( admin_url('admin-ajax.php') ); ?>', {
                method: 'POST',
                body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.success) {
                    formResponse.style.color = 'green';
                    formResponse.innerHTML = '<i class="fa-solid fa-circle-check me-1"></i>' + data.data.message;
                    contactForm.reset();
                } else {
                    formResponse.style.color = 'var(--primary-color)';
                    formResponse.innerHTML = '<i class="fa-solid fa-circle-exclamation me-1"></i>' + (data.data ? data.data.message : 'An error occurred.');
                }
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i>Send Message';
            })
            .catch(function() {
                formResponse.style.color = 'var(--primary-color)';
                formResponse.innerHTML = 'Network error. Please try again.';
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i>Send Message';
            });
        });
    }
})();

function scrollCarSlider(btn, direction) {
    var wrapper = btn.closest('.car-slider-wrapper');
    if (!wrapper) return;
    var track = wrapper.querySelector('.car-slider-track');
    if (!track) return;
    var scrollAmount = track.clientWidth * 0.8;
    track.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}

function scrollTeamSlider(direction) {
    var track = document.getElementById('teamSliderTrack');
    if (!track) return;
    var scrollAmount = track.clientWidth * 0.8;
    track.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}
</script>

<?php get_footer(); ?>
