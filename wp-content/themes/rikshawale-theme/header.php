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
            background: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06) !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding-top: 8px !important;
            padding-bottom: 8px !important;
            transition: all 0.3s ease;
        }
        .header-custom .navbar-brand {
            color: #0f172a !important;
        }
        .navbar-custom .navbar-nav a,
        .header-custom .nav-link {
            color: #1e293b !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 4px 10px !important;
            text-transform: none;
            position: relative;
            font-family: var(--font-heading);
            display: inline-block;
            transition: all 0.3s ease;
        }
        .navbar-custom .navbar-nav a:hover,
        .header-custom .nav-link:hover,
        .navbar-custom .navbar-nav .active > a,
        .navbar-custom .navbar-nav a.active,
        .navbar-custom .navbar-nav li.current-menu-item > a {
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
            bottom: -2px;
            left: 10px;
            right: 10px;
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
        .mega-city-link {
            transition: all 0.2s ease;
            color: #334155 !important;
        }
        .mega-city-link:hover {
            background-color: #f8fafc;
            color: var(--primary-color, #db2d2e) !important;
            padding-left: 10px !important;
        }
        .mega-city-link:hover .arrow-icon {
            color: var(--primary-color, #db2d2e) !important;
            transform: translate(2px, -2px);
            display: inline-block;
        }
        @media (min-width: 992px) {
            .mega-places-menu-item:hover .mega-dropdown-panel {
                display: block;
                animation: fadeIn 0.2s ease-in-out;
            }
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <!-- Top Marquee Ticker -->
    <div class="header-marquee-ticker text-white overflow-hidden" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 50%, #0f172a 100%) !important; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.35), inset 0 1px 2px rgba(255, 255, 255, 0.2), inset 0 -3px 8px rgba(0, 0, 0, 0.4); border-bottom: 1px solid rgba(255, 255, 255, 0.15); font-size: 0.82rem; font-weight: 500; padding: 15px 0;">
        <marquee behavior="scroll" direction="left" scrollamount="6" onmouseover="this.stop();" onmouseout="this.start();" style="line-height: 1.15;">
            <span class="me-3">✅ Certified Vehicles</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">🔍 40-Point Inspection</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">🛡️ 30-Day Warranty</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">💳 Financing & RC Transfer</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">✅ Certified Vehicles</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">🔍 40-Point Inspection</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">🛡️ 30-Day Warranty</span>
            <span class="me-3 opacity-50">|</span>
            <span class="me-3">💳 Financing & RC Transfer</span>
        </marquee>
    </div>



    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom header-custom shadow-sm py-1 position-relative">
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
                <div class="d-flex align-items-center gap-2 ms-lg-3 my-2 my-lg-0">

                    <?php if ( is_user_logged_in() ) : 
                        $current_u = wp_get_current_user();
                    ?>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-dark dropdown-toggle rounded-pill px-3 fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-circle me-1 text-primary"></i> <?php echo esc_html( $current_u->display_name ?: $current_u->user_login ); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3 border-0">
                                <li><button class="dropdown-item py-2" type="button" data-bs-toggle="modal" data-bs-target="#myBookingsModal" onclick="fetchUserBookings()"><i class="fa-solid fa-calendar-check me-2 text-primary"></i> My Bookings</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#authModal">
                            <i class="fa-solid fa-user-lock me-1"></i> Login / Register
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <script>
    var rikshawale_ajax = {
        url: "<?php echo esc_url( admin_url('admin-ajax.php') ); ?>",
        auth_nonce: "<?php echo wp_create_nonce('rikshawale_auth_nonce'); ?>",
        booking_nonce: "<?php echo wp_create_nonce('rikshawale_booking_nonce'); ?>",
        is_logged_in: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>,
        user_name: "<?php echo is_user_logged_in() ? esc_js( wp_get_current_user()->display_name ) : ''; ?>",
        user_email: "<?php echo is_user_logged_in() ? esc_js( wp_get_current_user()->user_email ) : ''; ?>",
        user_phone: "<?php echo is_user_logged_in() ? esc_js( get_user_meta( get_current_user_id(), 'phone_number', true ) ) : ''; ?>"
    };
    </script>
</header>
