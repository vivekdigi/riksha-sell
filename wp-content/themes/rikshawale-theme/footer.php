<?php
/**
 * The template for displaying the footer (Modern, Compact Layout)
 */
?>
<style>
    .footer-custom {
        background-color: <?php echo esc_attr( get_theme_mod( 'footer_bg_color', '#090b0e' ) ); ?> !important;
        color: <?php echo esc_attr( get_theme_mod( 'footer_text_color', '#94a3b8' ) ); ?> !important;
        border-top: 1px solid rgba(255,255,255,0.06);
        font-family: var(--font-body, 'Inter', sans-serif);
    }
    .footer-custom h5 {
        color: #ffffff !important;
        position: relative;
        padding-bottom: 8px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-size: 0.78rem !important;
    }
    .footer-custom h5::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 22px;
        height: 2px;
        background-color: var(--primary-color, #db2d2e);
        border-radius: 1px;
    }
    .footer-custom a {
        color: <?php echo esc_attr( get_theme_mod( 'footer_text_color', '#94a3b8' ) ); ?>;
        text-decoration: none;
        font-size: 0.82rem !important;
        transition: all 0.2s ease;
    }
    .footer-custom a:hover {
        color: #ffffff !important;
        padding-left: 4px;
    }
    .footer-custom p {
        color: <?php echo esc_attr( get_theme_mod( 'footer_text_color', '#94a3b8' ) ); ?>;
        font-size: 0.8rem !important;
        line-height: 1.6;
    }
    .contact-icon-box {
        width: 20px;
        height: 20px;
        color: var(--primary-color, #db2d2e);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .footer-tagline-box {
        border-left: 2px solid var(--primary-color, #db2d2e);
        background-color: rgba(255,255,255,0.03);
        font-size: 0.68rem !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #e2e8f0;
        border-radius: 0 4px 4px 0;
    }
    .footer-custom ul,
    .footer-custom ol {
        list-style: none !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
    }
    .footer-custom li {
        list-style: none !important;
        margin-bottom: 0.45rem !important;
    }
    .footer-custom .custom-logo-link img,
    .footer-custom .custom-logo {
        max-height: 32px !important;
        width: auto !important;
        object-fit: contain !important;
        display: block;
        margin-bottom: 12px;
    }
</style>

<footer class="footer-custom mt-auto">
    <div class="container py-5">
        <div class="row g-4 justify-content-between">
            <!-- Column 1: Brand Info & Description -->
            <div class="col-lg-3 col-md-6 mb-3">
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
                    <h4 class="fw-bold text-white mb-2" style="font-size: 1.1rem;">🛺 <?php bloginfo( 'name' ); ?></h4>
                <?php 
                }
                ?>
                <div class="footer-tagline-box my-2 px-2 py-1">
                    <?php echo esc_html( get_theme_mod( 'footer_tagline', 'PREMIUM PRE-OWNED AUTOMOTIVE EXPERIENCE' ) ); ?>
                </div>
                <p class="mb-0">
                    <?php echo esc_html( get_theme_mod( 'footer_description', 'Luxury, trust, and performance — handpicked pre-owned cars for buyers who expect more.' ) ); ?>
                </p>
            </div>

            <!-- Dynamic Widget Areas / Default Columns -->
            <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-widget-1' ); ?>
            <?php else : ?>
                <!-- Default Quick Links -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <h5 class="mb-3">QUICK LINKS</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( home_url('/about-us/') ); ?>">About us</a></li>
                        <li><a href="<?php echo esc_url( home_url('/sell-a-car/') ); ?>">Sell a Car</a></li>
                        <li><a href="<?php echo esc_url( home_url('/contact-us/') ); ?>">Contact us</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-widget-2' ); ?>
            <?php else : ?>
                <!-- Default Models / Brands -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <h5 class="mb-3">MODELS</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">King Deluxe</a></li>
                        <li><a href="#">Maxima Cargo</a></li>
                        <li><a href="#">RE</a></li>
                        <li><a href="#">Treo</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
                <?php dynamic_sidebar( 'footer-widget-3' ); ?>
            <?php else : ?>
                <!-- Default Policies -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                    <h5 class="mb-3">POLICIES</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo esc_url( home_url('/privacy-policy/') ); ?>">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Shipping policy</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Column 5: Contact Us -->
            <div class="col-lg-3 col-md-6 mb-3">
                <h5 class="mb-3">CONTACT US</h5>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <div class="contact-icon-box">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <a href="tel:<?php echo esc_attr( get_theme_mod( 'topbar_phone', '+91 97111-63000' ) ); ?>">
                                <?php echo esc_html( get_theme_mod( 'topbar_phone', '+91 97111-63000' ) ); ?>
                            </a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <div class="contact-icon-box">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ); ?>">
                                <?php echo esc_html( get_theme_mod( 'topbar_email', 'info@rikshawale.com' ) ); ?>
                            </a>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-2 mb-2">
                        <div class="contact-icon-box mt-1">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div style="font-size: 0.81rem; color: #94a3b8; line-height: 1.5;">
                            <?php echo nl2br( esc_html( get_theme_mod( 'footer_address', "Indra Market, CB-382, Ring Rd, Block CB, Naraina Village, Naraina, New Delhi, Delhi 110028" ) ) ); ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-3 border-secondary opacity-25">
        
        <!-- Bottom Bar -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <span style="font-size: 0.75rem; color: #64748b;">
                <?php echo esc_html( get_theme_mod( 'footer_copyright_text', '© ' . date('Y') . ' Rikshawale. All rights reserved.' ) ); ?>
            </span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
