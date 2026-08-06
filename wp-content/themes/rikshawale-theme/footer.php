<?php
/**
 * The template for displaying the footer
 */
?>
<style>
    .footer-custom {
        background-color: <?php echo esc_attr( get_theme_mod( 'footer_bg_color', '#0b0b0b' ) ); ?> !important;
        color: <?php echo esc_attr( get_theme_mod( 'footer_text_color', '#cccccc' ) ); ?> !important;
        border-top: 1px solid rgba(255,255,255,0.05);
    }
    .footer-custom h5 {
        color: #ffffff !important;
        position: relative;
        padding-bottom: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.95rem;
    }
    .footer-custom h5::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background-color: var(--primary-color);
    }
    .footer-custom a {
        color: <?php echo esc_attr( get_theme_mod( 'footer_text_color', '#cccccc' ) ); ?>;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .footer-custom a:hover {
        color: var(--primary-color) !important;
        padding-left: 3px;
    }
    .footer-custom p {
        color: <?php echo esc_attr( get_theme_mod( 'footer_text_color', '#aaaaaa' ) ); ?>;
    }
    .contact-icon-box {
        width: 24px;
        height: 24px;
        background-color: transparent !important;
        background: none !important;
        color: var(--primary-color);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        border: none !important;
        box-shadow: none !important;
    }
    .contact-icon-box:hover {
        background-color: transparent !important;
        color: var(--primary-color);
        border: none !important;
        transform: scale(1.15);
    }
    .footer-tagline-box {
        border-left: 3px solid var(--primary-color);
        background-color: rgba(255,255,255,0.03);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #ffffff;
    }
    .footer-social-icons a {
        width: 36px;
        height: 36px;
        border-radius: 4px;
        background-color: rgba(255,255,255,0.05);
        color: #ffffff !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    .footer-social-icons a:hover {
        background-color: var(--primary-color);
        padding-left: 0;
    }
    .footer-custom ul,
    .footer-custom ol {
        list-style: none !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
    }
    .footer-custom li {
        list-style: none !important;
        list-style-type: none !important;
    }
    .footer-custom .custom-logo-link img,
    .footer-custom .custom-logo {
        max-height: 35px !important;
        width: auto !important;
        object-fit: contain !important;
        display: block;
        margin-bottom: 15px;
    }
</style>

<footer class="footer-custom mt-auto">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Column 1: Brand Info & Description -->
            <div class="col-lg-3 col-md-6 mb-4">
                <?php 
                $footer_logo_url = get_theme_mod( 'footer_logo' );
                if ( $footer_logo_url ) {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
                        <img src="<?php echo esc_url( $footer_logo_url ); ?>" class="custom-logo" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    </a>
                    <?php
                } elseif ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                ?>
                    <h3 class="fw-bold text-white mb-3">🛺 <?php bloginfo( 'name' ); ?></h3>
                <?php 
                }
                ?>
                <div class="footer-tagline-box my-3 px-3 py-2">
                    <?php echo esc_html( get_theme_mod( 'footer_tagline', 'PREMIUM PRE-OWNED AUTOMOTIVE EXPERIENCE' ) ); ?>
                </div>
                <p class="small mb-4" style="line-height: 1.6;">
                    <?php echo esc_html( get_theme_mod( 'footer_description', 'Luxury, trust, and performance — handpicked pre-owned cars for buyers who expect more.' ) ); ?>
                </p>
            </div>

            <!-- Dynamic Widget Areas / Default Columns -->
            <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-widget-1' ); ?>
            <?php else : ?>
                <!-- Default Quick Links -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <h5 class="fw-bold mb-3">QUICK LINKS</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="<?php echo esc_url( home_url('/inventory/') ); ?>">Sell a Car</a></li>
                        <li class="mb-2"><a href="<?php echo esc_url( home_url('/contact/') ); ?>">Contact us</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-widget-2' ); ?>
            <?php else : ?>
                <!-- Default Brands -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <h5 class="fw-bold mb-3">BRANDS</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#">Tata</a></li>
                        <li class="mb-2"><a href="#">Mahindra</a></li>
                        <li class="mb-2"><a href="#">Hyundai</a></li>
                        <li class="mb-2"><a href="#">Audi</a></li>
                        <li class="mb-2"><a href="#">Ford</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-widget-3' ); ?>
            <?php else : ?>
                <!-- Default Policies -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <h5 class="fw-bold mb-3">POLICIES</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#">Terms & Conditions</a></li>
                        <li class="mb-2"><a href="#">Shipping policy</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Column 5: Contact Us -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3 text-white">CONTACT US</h5>
                <ul class="list-unstyled footer-contact-list">
                    <li class="d-flex align-items-center mb-3">
                        <div class="contact-icon-box me-3">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <a href="tel:<?php echo esc_attr( get_theme_mod( 'topbar_phone', '+1 234 567 8900' ) ); ?>" class="small">
                                <?php echo esc_html( get_theme_mod( 'topbar_phone', '+1 234 567 8900' ) ); ?>
                            </a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <div class="contact-icon-box me-3">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ); ?>" class="small">
                                <?php echo esc_html( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ); ?>
                            </a>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <div class="contact-icon-box me-3 mt-1">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="small lh-sm text-secondary">
                            <?php echo nl2br( esc_html( get_theme_mod( 'footer_address', "Indra Market, CB-382, Ring Rd, Block CB, Naraina Village, Naraina, New Delhi, Delhi 110028" ) ) ); ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4 border-secondary opacity-25">
        
        <!-- Bottom Bar -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <span class="small text-secondary">
                <?php echo esc_html( get_theme_mod( 'footer_copyright_text', '© ' . date('Y') . ' Rikshawale. All rights reserved.' ) ); ?>
            </span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
