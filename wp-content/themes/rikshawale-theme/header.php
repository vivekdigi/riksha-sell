<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ?: 'Find the best new & used passenger and cargo e-rickshaws, auto rickshaws, verified deals, specifications and price quotes.' ); ?>">
    
    <!-- Preconnect to CDN & Font origins to reduce latency -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <?php 
    // Preload LCP hero image on front page for fastest paint
    if ( is_front_page() ) {
        $lcp_hero_banner = 'https://rikshadealer.questdigiflex.in/wp-content/uploads/2026/08/ebd8348b-742b-4c06-b9dd-f22b8099b61e.png';
        $hero_posts = get_posts( array( 'post_type' => 'riksha', 'posts_per_page' => 1, 'post_status' => 'publish' ) );
        if ( ! empty( $hero_posts ) && has_post_thumbnail( $hero_posts[0]->ID ) ) {
            $lcp_hero_banner = wp_get_attachment_image_url( get_post_thumbnail_id( $hero_posts[0]->ID ), 'full' ) ?: $lcp_hero_banner;
        }
        if ( $lcp_hero_banner ) {
            echo '<link rel="preload" as="image" href="' . esc_url( $lcp_hero_banner ) . '" fetchpriority="high">' . "\n";
        }
    }
    ?>

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
        /* Parent menu items relative positioning (except Mega Menu) */
        .navbar-nav li:not(.mega-places-menu-item),
        .navbar-nav .menu-item-has-children,
        .navbar-nav .page_item_has_children,
        .navbar-nav .dropdown:not(.mega-places-menu-item) {
            position: relative !important;
        }

        .navbar-nav li.mega-places-menu-item {
            position: static !important;
        }

        /* 1. HIDE ALL SUBMENUS & CHILDREN BY DEFAULT */
        .navbar-nav ul.sub-menu,
        .navbar-nav ul.children,
        .navbar-nav .dropdown-menu {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            z-index: 9999 !important;
            margin-top: 0 !important;
            background: #ffffff !important;
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12) !important;
            padding: 8px 0 !important;
            list-style: none !important;
            min-width: 200px !important;
            transition: opacity 0.2s ease, transform 0.2s ease !important;
        }

        /* Full Width Mega Dropdown Panel Fix */
        .navbar-nav .mega-dropdown-panel {
            width: 100% !important;
            min-width: 100% !important;
            left: 0 !important;
            right: 0 !important;
            padding: 24px !important;
            border-radius: 0 0 16px 16px !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
        }

        /* Submenu items formatting */
        .navbar-nav ul.sub-menu li,
        .navbar-nav ul.children li {
            display: block !important;
            width: 100% !important;
            margin: 0 !important;
        }

        .navbar-nav ul.sub-menu li a,
        .navbar-nav ul.children li a,
        .navbar-nav .dropdown-menu a {
            display: block !important;
            padding: 8px 16px !important;
            color: #334155 !important;
            font-size: 0.88rem !important;
            font-weight: 500 !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            transition: all 0.2s ease !important;
        }

        .navbar-nav .mega-dropdown-panel a {
            white-space: normal !important;
        }

        .navbar-nav ul.sub-menu li a:hover,
        .navbar-nav ul.children li a:hover,
        .navbar-nav .dropdown-menu a:hover {
            background-color: #f8fafc !important;
            color: var(--primary-color, #db2d2e) !important;
            padding-left: 20px !important;
        }

        /* 2. SHOW SUBMENUS ONLY ON HOVER (DESKTOP) - EXCLUDING PLACES MEGA MENU */
        @media (min-width: 992px) {
            .navbar-nav li:not(.mega-places-menu-item):hover > ul.sub-menu,
            .navbar-nav li:not(.mega-places-menu-item):hover > ul.children,
            .navbar-nav li:not(.mega-places-menu-item):hover > .dropdown-menu:not(.mega-dropdown-panel),
            .navbar-nav .menu-item-has-children:not(.mega-places-menu-item):hover > .sub-menu,
            .navbar-nav .page_item_has_children:not(.mega-places-menu-item):hover > ul.children,
            .navbar-nav .dropdown:not(.mega-places-menu-item):hover > .dropdown-menu:not(.mega-dropdown-panel) {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
                animation: fadeInSubmenu 0.2s ease-in-out !important;
            }
        }

        /* Places Mega Menu: Show on Click Only */
        .navbar-nav .mega-places-menu-item .mega-dropdown-panel.show,
        .navbar-nav .mega-places-menu-item.show .mega-dropdown-panel {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            animation: fadeInSubmenu 0.2s ease-in-out !important;
        }

        /* Places Mega Menu Close Button */
        .places-close-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            max-width: 32px !important;
            padding: 0 !important;
            margin: 0 !important;
            border-radius: 50% !important;
            background-color: #f1f5f9 !important;
            color: #64748b !important;
            border: 1px solid #cbd5e1 !important;
            font-size: 14px !important;
            line-height: 1 !important;
            cursor: pointer !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
            transition: all 0.2s ease !important;
            transform: none !important;
        }
        .places-close-btn:hover {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
            border-color: #fca5a5 !important;
            padding: 0 !important;
            transform: scale(1.08) !important;
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.2) !important;
        }
        .places-close-btn:active {
            transform: scale(0.95) !important;
            padding: 0 !important;
        }
        .places-close-btn i {
            display: inline-block !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .navbar-nav .mega-dropdown-panel .btn-outline-danger:hover {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        @keyframes fadeInSubmenu {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
    function saveUserSelectedPlace(placeName) {
        document.cookie = "user_selected_place=" + encodeURIComponent(placeName) + "; path=/; max-age=" + (365*24*60*60);
        var lbl = document.getElementById('currentPlacesLabel');
        if (lbl) {
            lbl.textContent = placeName;
        }
        var formData = new FormData();
        formData.append('action', 'rikshawale_save_user_place');
        formData.append('place', placeName);
        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Desktop Hover for standard dropdowns (excluding Places)
        if (window.innerWidth >= 992) {
            document.querySelectorAll('.navbar-nav .dropdown:not(.mega-places-menu-item), .navbar-nav .menu-item-has-children:not(.mega-places-menu-item)').forEach(function(everydropdown) {
                everydropdown.addEventListener('mouseenter', function() {
                    let el_link = this.querySelector('a[data-bs-toggle="dropdown"], a.dropdown-toggle');
                    let el_menu = this.querySelector('.dropdown-menu, .sub-menu');
                    if (el_menu) {
                        el_menu.classList.add('show');
                    }
                    if (el_link) {
                        el_link.setAttribute('aria-expanded', 'true');
                    }
                });
                everydropdown.addEventListener('mouseleave', function() {
                    let el_link = this.querySelector('a[data-bs-toggle="dropdown"], a.dropdown-toggle');
                    let el_menu = this.querySelector('.dropdown-menu, .sub-menu');
                    if (el_menu) {
                        el_menu.classList.remove('show');
                    }
                    if (el_link) {
                        el_link.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        }

        // Places Mega Menu Click Toggle & Close Handlers
        var placesToggle = document.getElementById('placesNavMegaDropdown');
        var placesItem = document.querySelector('.mega-places-menu-item');
        var placesPanel = placesItem ? placesItem.querySelector('.mega-dropdown-panel') : null;

        function openPlacesMenu() {
            if (placesPanel) placesPanel.classList.add('show');
            if (placesItem) placesItem.classList.add('show');
            if (placesToggle) {
                placesToggle.setAttribute('aria-expanded', 'true');
                placesToggle.classList.add('show');
            }
        }

        function closePlacesMenu() {
            if (placesPanel) placesPanel.classList.remove('show');
            if (placesItem) placesItem.classList.remove('show');
            if (placesToggle) {
                placesToggle.setAttribute('aria-expanded', 'false');
                placesToggle.classList.remove('show');
            }
        }

        if (placesToggle) {
            placesToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var isOpen = placesPanel && placesPanel.classList.contains('show');
                if (isOpen) {
                    closePlacesMenu();
                } else {
                    openPlacesMenu();
                }
            });
        }

        // Global click listener: Close button or Outside click
        document.addEventListener('click', function(e) {
            if (e.target.closest('#closePlacesMegaDropdown')) {
                e.preventDefault();
                e.stopPropagation();
                closePlacesMenu();
                return;
            }
            if (placesItem && !placesItem.contains(e.target)) {
                closePlacesMenu();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePlacesMenu();
            }
        });
    });
    </script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <!-- Top Marquee Ticker -->
    <div class="header-marquee-ticker text-white overflow-hidden d-flex align-items-center" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 50%, #0f172a 100%) !important; box-shadow: 0 2px 10px rgba(14, 165, 233, 0.25), inset 0 1px 2px rgba(255, 255, 255, 0.2); border-bottom: 1px solid rgba(255, 255, 255, 0.15); font-size: 0.82rem; font-weight: 500; padding: 9px 0; min-height: 36px;">
        <marquee behavior="scroll" direction="left" scrollamount="6" onmouseover="this.stop();" onmouseout="this.start();" style="line-height: 1; display: flex; align-items: center;">
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

    <?php
    $current_uid      = get_current_user_id();
    $user_alt_phone   = '';
    $user_city        = '';
    $user_booked_cars = array();

    if ( $current_uid ) {
        $user_alt_phone = get_user_meta( $current_uid, 'alternate_phone', true ) ?: get_user_meta( $current_uid, 'alt_phone', true );
        $user_city      = get_user_meta( $current_uid, 'city', true ) ?: get_user_meta( $current_uid, 'user_place', true );
        if ( empty( $user_city ) && ! empty( $_COOKIE['user_selected_place'] ) ) {
            $user_city = sanitize_text_field( wp_unslash( $_COOKIE['user_selected_place'] ) );
        }

        // Fetch bookings for this user to get alternate phone, city, and booked car IDs
        $user_bookings = get_posts( array(
            'post_type'      => 'riksha_booking',
            'post_status'    => 'any',
            'posts_per_page' => 100,
            'meta_key'       => '_booking_user_id',
            'meta_value'     => $current_uid,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( ! empty( $user_bookings ) ) {
            foreach ( $user_bookings as $ub ) {
                if ( empty( $user_alt_phone ) ) {
                    $saved_alt = get_post_meta( $ub->ID, '_booking_alt_phone', true );
                    if ( ! empty( $saved_alt ) ) {
                        $user_alt_phone = $saved_alt;
                    }
                }
                if ( empty( $user_city ) ) {
                    $saved_c = get_post_meta( $ub->ID, '_booking_city', true );
                    if ( ! empty( $saved_c ) ) {
                        $user_city = $saved_c;
                    }
                }
                $c_id     = get_post_meta( $ub->ID, '_booking_car_id', true );
                $c_status = get_post_meta( $ub->ID, '_booking_status', true );
                if ( $c_id && ! isset( $user_booked_cars[ $c_id ] ) ) {
                    $user_booked_cars[ $c_id ] = array(
                        'booking_id' => $ub->ID,
                        'status'     => $c_status,
                        'is_paid'    => ( stripos( (string)$c_status, 'paid' ) !== false ),
                    );
                }
            }
        }
    }
    ?>
    <script>
    var rikshawale_ajax = {
        url: "<?php echo esc_url( admin_url('admin-ajax.php') ); ?>",
        auth_nonce: "<?php echo wp_create_nonce('rikshawale_auth_nonce'); ?>",
        booking_nonce: "<?php echo wp_create_nonce('rikshawale_booking_nonce'); ?>",
        is_logged_in: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>,
        user_name: "<?php echo is_user_logged_in() ? esc_js( wp_get_current_user()->display_name ?: wp_get_current_user()->user_login ) : ''; ?>",
        user_email: "<?php echo is_user_logged_in() ? esc_js( wp_get_current_user()->user_email ) : ''; ?>",
        user_phone: "<?php echo is_user_logged_in() ? esc_js( get_user_meta( get_current_user_id(), 'phone_number', true ) ) : ''; ?>",
        user_alt_phone: "<?php echo esc_js( $user_alt_phone ); ?>",
        user_city: "<?php echo esc_js( $user_city ); ?>",
        user_booked_cars: <?php echo json_encode( $user_booked_cars ); ?>
    };
    </script>
</header>
