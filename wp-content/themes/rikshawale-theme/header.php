<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php wp_head(); ?>
    <style>
        /* Force FontAwesome Font Family */
        .fa, .fab, .fas, .far, .fa-solid, .fa-brands {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
        }
        /* Apply Customizer settings inline to override defaults dynamically */
        :root {
            --primary-color: <?php echo esc_attr( get_theme_mod( 'theme_accent_color', '#db2d2e' ) ); ?>;
            --primary-color-hover: <?php echo esc_attr( get_theme_mod( 'theme_accent_color', '#db2d2e' ) ); ?>dd;
            --dark-color: <?php echo esc_attr( get_theme_mod( 'footer_bg_color', '#151515' ) ); ?>;
        }
        header {
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .admin-bar header {
            top: 32px;
        }
        @media screen and (max-width: 782px) {
            .admin-bar header {
                top: 46px;
            }
        }
        .header-custom {
            background-color: #ffffff !important;
            border-bottom: 1px solid #eeeeee !important;
            padding-top: 15px !important;
            padding-bottom: 15px !important;
            transition: all 0.3s ease;
        }
        .header-custom .navbar-brand {
            color: #1a1a1a !important;
        }
        .navbar-custom .navbar-nav a,
        .header-custom .nav-link {
            color: #222222 !important;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 6px 16px !important;
            text-transform: none;
            position: relative;
            font-family: var(--font-heading);
            display: inline-block;
            transition: all 0.3s ease;
        }
        .navbar-custom .navbar-nav a:hover,
        .header-custom .nav-link:hover {
            color: var(--primary-color) !important;
        }
        .top-bar {
            background-color: #0b0b0b !important;
            border-bottom: 1px solid #1a1a1a !important;
        }
        .top-bar, .top-bar a {
            color: #dddddd !important;
        }
        .top-bar a:hover {
            color: var(--primary-color) !important;
        }
        .navbar-custom .navbar-nav a::after,
        .header-custom .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 16px;
            right: 16px;
            height: 2px;
            background-color: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .navbar-custom .navbar-nav a:hover::after,
        .header-custom .nav-link:hover::after,
        .navbar-custom .navbar-nav .active > a::after,
        .navbar-custom .navbar-nav a.active::after,
        .navbar-custom .navbar-nav li.current-menu-item > a::after {
            transform: scaleX(1);
        }
        .custom-logo-link img,
        .navbar-brand img {
            max-height: 35px;
            min-height: 35px;
            width: auto;
            object-fit: contain;
        }
        .text-primary {
            color: var(--primary-color) !important;
        }
        .btn-add-car {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            padding: 6px 16px !important;
            font-size: 0.8rem;
        }
        .btn-add-car:hover {
            background-color: transparent !important;
            color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <!-- Top Marquee Ticker -->
    <div class="header-marquee-ticker bg-dark text-white overflow-hidden" style="background-color: #111111 !important; border-bottom: 1px solid rgba(255,255,255,0.08); font-size: 0.82rem; font-weight: 500; padding: 4px 0;">
        <marquee behavior="scroll" direction="left" scrollamount="6" onmouseover="this.stop();" onmouseout="this.start();" style="line-height: 1.4;">
            <span class="me-3">✅ Certified Vehicles</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">🔍 40-Point Inspection</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">🛡️ 30-Day Warranty</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">💳 Financing & RC Transfer</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">✅ Certified Vehicles</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">🔍 40-Point Inspection</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">🛡️ 30-Day Warranty</span>
            <span class="me-3 text-muted">|</span>
            <span class="me-3">💳 Financing & RC Transfer</span>
        </marquee>
    </div>

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="top-bar-info">
                <?php if ( get_theme_mod( 'topbar_phone', '+1 234 567 8900' ) ) : ?>
                    <span class="me-3"><i class="fa-solid fa-phone text-primary"></i> <a href="tel:<?php echo esc_attr( get_theme_mod( 'topbar_phone', '+1 234 567 8900' ) ); ?>"><?php echo esc_html( get_theme_mod( 'topbar_phone', '+1 234 567 8900' ) ); ?></a></span>
                <?php endif; ?>
                <?php if ( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ) : ?>
                    <span class="me-3"><i class="fa-solid fa-envelope text-primary"></i> <a href="mailto:<?php echo esc_attr( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ); ?></a></span>
                <?php endif; ?>
                <?php if ( get_theme_mod( 'topbar_hours', 'Mon - Sat: 8:00 AM - 6:00 PM' ) ) : ?>
                    <span><i class="fa-regular fa-clock text-primary"></i> <?php echo esc_html( get_theme_mod( 'topbar_hours', 'Mon - Sat: 8:00 AM - 6:00 PM' ) ); ?></span>
                <?php endif; ?>
            </div>
            <div class="top-bar-socials">
                <?php if ( get_theme_mod( 'topbar_facebook', '#' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'topbar_facebook', '#' ) ); ?>" target="_blank" class="me-2"><i class="fa-brands fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if ( get_theme_mod( 'topbar_twitter', '#' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'topbar_twitter', '#' ) ); ?>" target="_blank" class="me-2"><i class="fa-brands fa-twitter"></i></a>
                <?php endif; ?>
                <?php if ( get_theme_mod( 'topbar_instagram', '#' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'topbar_instagram', '#' ) ); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-custom header-custom shadow-sm py-1">
        <div class="container">
            <?php 
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
            ?>
                <a class="navbar-brand d-flex align-items-center fw-bold fs-5" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <span class="me-2" style="font-size: 1.5rem; color: var(--primary-color);">🛺</span>
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php 
            }
            ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#rikshawaleNavbar" aria-controls="rikshawaleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="rikshawaleNavbar">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0 align-items-center',
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'          => 2,
                    ) );
                } else {
                    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">';
                    wp_list_pages( array(
                        'title_li' => '',
                        'container' => false,
                        'depth' => 1,
                        'link_before' => '<span class="nav-link">',
                        'link_after' => '</span>'
                    ) );
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </nav>
</header>
