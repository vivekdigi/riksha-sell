<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * Custom About Us Page Template matching exact CarDealer Potenza reference (https://cardealer.potenzaglobalsolutions.com/elementor/about-us/)
 */

get_header();
?>

<div class="about-page-potenza" style="font-family: var(--font-body, 'Outfit', 'Inter', sans-serif); color: #323232; background: #ffffff; overflow-x: hidden;">

    <!-- ============================================================
         SECTION 1: HERO / ABOUT ELECTRIC VEHICLE
         ============================================================ -->
    <section class="py-5 my-3">
        <div class="container" style="max-width: 1200px;">
            <div class="row g-5 align-items-center">
                <!-- Left Column: Car Image -->
                <div class="col-lg-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow-lg border">
                        <img src="<?php echo esc_url( content_url( '/uploads/2026/08/541976bc-3da8-460a-9799-771d11960dd3.png' ) ); ?>" alt="About Rikshawale" class="w-100 h-auto object-fit-cover d-block" style="max-height: 480px;">
                    </div>
                </div>

                <!-- Right Column: Details & Features -->
                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-semibold text-uppercase small" style="color: var(--primary-color, #db2d2e); letter-spacing: 1.5px; font-size: 0.82rem;">BUILDING INDIA'S LARGEST TRUSTED MARKETPLACE</span>
                            <div style="width: 35px; height: 2px; background-color: var(--primary-color, #db2d2e);"></div>
                        </div>

                        <h2 class="fw-bold text-dark mb-3" style="font-size: 2.3rem; line-height: 1.2; letter-spacing: -0.5px; font-family: var(--font-heading);">
                            ABOUT US
                        </h2>

                        <p class="text-muted mb-4" style="font-size: 0.94rem; line-height: 1.8;">
                            Rikshawale.com is a technology-driven marketplace for certified pre-owned three-wheelers, connecting buyers and sellers through a trusted, transparent, and hassle-free platform. Every vehicle undergoes a standardized inspection and quality check, with access to refurbishment, financing assistance, warranty support, and seamless ownership transfer. Our mission is to organize and modernize India's highly fragmented used commercial vehicle market, making every transaction simple, secure, and reliable.
                        </p>

                        <!-- Feature Item 1 -->
                        <div class="d-flex gap-3 mb-4 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center" style="color: var(--primary-color, #db2d2e); font-size: 2rem; width: 48px; height: 48px;">
                                <i class="fa-solid fa-charging-station"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Charging Station</h5>
                                <p class="text-muted mb-0 small" style="line-height: 1.6; font-size: 0.88rem;">Suitable for any car dealer websites, business or corporate websites.</p>
                            </div>
                        </div>

                        <!-- Feature Item 2 -->
                        <div class="d-flex gap-3 mb-4 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center" style="color: var(--primary-color, #db2d2e); font-size: 2rem; width: 48px; height: 48px;">
                                <i class="fa-solid fa-car-side"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Auto Return Service</h5>
                                <p class="text-muted mb-0 small" style="line-height: 1.6; font-size: 0.88rem;">Suitable for any car dealer websites, business or corporate websites.</p>
                            </div>
                        </div>

                        <!-- Red Action Button -->
                        <div class="pt-2">
                            <a href="<?php echo esc_url( home_url('/services/') ); ?>" class="btn text-white fw-bold px-4 py-3 rounded-1 text-uppercase" style="background-color: var(--primary-color, #db2d2e); border: none; font-size: 0.82rem; letter-spacing: 1px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#111111'" onmouseout="this.style.backgroundColor='var(--primary-color, #db2d2e)'">
                                View More Our Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 2: OUR PARTNERS & SUPPORTERS BAR
         ============================================================ -->
    <section class="py-4 border-top border-bottom" style="background: #ffffff; border-color: #eee !important;">
        <div class="container" style="max-width: 1200px;">
            <div class="text-center mb-3">
                <span class="text-uppercase fw-semibold text-muted small" style="letter-spacing: 2px; font-size: 0.78rem;">Our Partners &amp; Supporters ———</span>
            </div>
            <div class="row g-4 align-items-center justify-content-between text-center opacity-75 py-2">
                <div class="col-6 col-sm-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 1.5px; font-size: 0.82rem;"><i class="fa-solid fa-shield-cat me-1 text-muted"></i> COMPANY NAME</div>
                <div class="col-6 col-sm-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 1.5px; font-size: 0.82rem;"><i class="fa-solid fa-car-rear me-1 text-muted"></i> COMPANY NAME</div>
                <div class="col-6 col-sm-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 1.5px; font-size: 0.82rem;"><i class="fa-solid fa-truck-monster me-1 text-muted"></i> COMPANY NAME</div>
                <div class="col-6 col-sm-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 1.5px; font-size: 0.82rem;"><i class="fa-solid fa-gauge-high me-1 text-muted"></i> COMPANY NAME</div>
                <div class="col-6 col-sm-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 1.5px; font-size: 0.82rem;"><i class="fa-solid fa-trophy me-1 text-muted"></i> COMPANY NAME</div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 3: WHY CHOOSE OUR CAR SERVICES (Split Dark Section)
         ============================================================ -->
    <section class="potenza-split-dark py-0 overflow-hidden" style="background: #0d121d; color: #ffffff;">
        <div class="container-fluid p-0">
            <div class="row g-0 align-items-stretch">
                <!-- Left Dark Column -->
                <div class="col-lg-6 d-flex align-items-center" style="background: #0d121d; padding: 70px 5% 70px 8%;">
                    <div style="max-width: 540px;">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-semibold text-uppercase small" style="color: var(--primary-color, #db2d2e); letter-spacing: 1px; font-size: 0.82rem;">Our Car Services</span>
                            <div style="width: 35px; height: 2px; background-color: var(--primary-color, #db2d2e);"></div>
                        </div>

                        <h2 class="fw-bold text-white mb-3" style="font-size: 2.3rem; line-height: 1.2; letter-spacing: -0.5px; font-family: var(--font-heading);">
                            Why Choose Our Car Services
                        </h2>

                        <p class="text-secondary mb-4" style="color: #94a3b8 !important; font-size: 0.92rem; line-height: 1.7;">
                            Car Dealer is the most evolving, creative, modern and multipurpose auto dealer Premium WordPress Theme. Suitable for any car dealer websites, business or corporate websites.
                        </p>

                        <!-- Circle Service 1 -->
                        <div class="d-flex gap-3 mb-4 align-items-start border-bottom border-secondary border-opacity-25 pb-4">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white shadow-sm" style="background: var(--primary-color, #db2d2e); width: 50px; height: 50px;">
                                <i class="fa-solid fa-gears fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Brake Check &amp; Services</h5>
                                <p class="mb-0 small" style="color: #94a3b8; line-height: 1.6; font-size: 0.88rem;">Suitable for any car dealer websites, business or corporate websites.</p>
                            </div>
                        </div>

                        <!-- Circle Service 2 -->
                        <div class="d-flex gap-3 mb-2 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white shadow-sm" style="background: var(--primary-color, #db2d2e); width: 50px; height: 50px;">
                                <i class="fa-solid fa-file-signature fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Online Appointment</h5>
                                <p class="mb-0 small" style="color: #94a3b8; line-height: 1.6; font-size: 0.88rem;">Suitable for any car dealer websites, business or corporate websites.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Mechanic Image Column (Full Height Split) -->
                <div class="col-lg-6 position-relative min-vh-50">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1000&q=80" alt="Car Mechanic Service" class="w-100 h-100 object-fit-cover d-block" style="min-height: 460px;">
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 4: WHAT OUR CLIENTS SAY ABOUT (Testimonials 3-Card Grid)
         ============================================================ -->
    <section class="py-5 my-4">
        <div class="container" style="max-width: 1200px;">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    <span class="fw-semibold text-uppercase small" style="color: var(--primary-color, #db2d2e); letter-spacing: 1px; font-size: 0.82rem;">Our Testimonial</span>
                    <div style="width: 35px; height: 2px; background-color: var(--primary-color, #db2d2e);"></div>
                </div>
                <h2 class="fw-bold text-dark mb-0" style="font-size: 2.3rem; letter-spacing: -0.5px; font-family: var(--font-heading);">
                    What Our Clients Say About
                </h2>
            </div>

            <!-- 3 Testimonial Cards -->
            <div class="row g-4">
                <?php
                $testimonials = array(
                    array(
                        'name'    => 'Anne Smith',
                        'role'    => 'Customer',
                        'bg_img'  => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80',
                        'avatar'  => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80',
                        'text'    => 'Success isn’t really that difficult. There is a significant portion of the population here in North America, that actually want and need Here straightforward',
                    ),
                    array(
                        'name'    => 'Felicia Queen',
                        'role'    => 'Auto Dealer',
                        'bg_img'  => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=500&q=80',
                        'avatar'  => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=150&q=80',
                        'text'    => 'Text of the print is a galley of type and bled it to a type specimen book. It has survived not only five centuries, make Lorem Ipsum is simply dummy text tell you.',
                    ),
                    array(
                        'name'    => 'Felicia Queen',
                        'role'    => 'Auto Dealer',
                        'bg_img'  => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=500&q=80',
                        'avatar'  => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80',
                        'text'    => 'Making a decision to do something — This is the first step. We all know that nothing moves until someone makes a decision. The first action is always.',
                    ),
                );

                foreach ( $testimonials as $t ) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 rounded-1 overflow-hidden shadow-sm h-100 text-center" style="background: #fdfdfd; border: 1px solid #f1f5f9 !important;">
                        <!-- Top Car Image Banner -->
                        <div style="height: 160px; overflow: hidden; position: relative;">
                            <img src="<?php echo esc_url($t['bg_img']); ?>" alt="Car" class="w-100 h-100 object-fit-cover">
                        </div>

                        <!-- Circular Avatar overlapping image -->
                        <div class="position-relative" style="margin-top: -35px; z-index: 2;">
                            <img src="<?php echo esc_url($t['avatar']); ?>" alt="<?php echo esc_attr($t['name']); ?>" class="rounded-circle border border-3 border-white shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                        </div>

                        <!-- Card Content -->
                        <div class="card-body p-4 pt-2 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem; color: var(--primary-color, #db2d2e) !important;"><?php echo esc_html($t['name']); ?></h5>
                                <span class="text-muted small d-block mb-3" style="font-size: 0.78rem;"><?php echo esc_html($t['role']); ?></span>
                                <p class="text-secondary small mb-3" style="line-height: 1.6; font-size: 0.86rem; color: #64748b !important;">
                                    <?php echo esc_html($t['text']); ?>
                                </p>
                            </div>
                            <div class="fs-4 text-muted opacity-40 mt-2">
                                <i class="fa-solid fa-quote-right" style="color: #94a3b8;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
