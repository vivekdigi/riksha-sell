<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * Custom About Us Page Template matching exact reference screenshot.
 * Includes: Hero Section with Features, Partners Bar, Dark Why Choose Us Section, and Testimonials 3-Card Grid.
 */

get_header();
?>

<div class="about-page-wrapper" style="font-family: var(--font-body, 'Inter', sans-serif); color: #1e293b; background: #ffffff; overflow-x: hidden;">

    <!-- ============================================================
         SECTION 1: HERO / ABOUT FEATURE (Light Background)
         ============================================================ -->
    <section class="about-hero-section py-5 my-3">
        <div class="container" style="max-width: 1180px;">
            <div class="row g-5 align-items-center">
                <!-- Left Column: Portrait Vehicle Image -->
                <div class="col-lg-6">
                    <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80" alt="About Vehicle" class="w-100 h-100 object-fit-cover d-block" style="min-height: 480px; max-height: 560px;">
                    </div>
                </div>

                <!-- Right Column: Details & Features -->
                <div class="col-lg-6">
                    <div class="ps-lg-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-bold text-uppercase small" style="color: var(--primary-color, #db2d2e); letter-spacing: 1.5px; font-size: 0.8rem;">About Electric Vehicle</span>
                            <div style="width: 30px; height: 2px; background-color: var(--primary-color, #db2d2e);"></div>
                        </div>

                        <h2 class="fw-black text-dark mb-3" style="font-size: 2.2rem; line-height: 1.25; letter-spacing: -0.5px;">
                            Best Solution Provides Electric Vehicle
                        </h2>

                        <p class="text-secondary mb-4" style="font-size: 0.94rem; line-height: 1.7;">
                            Rikshawale is India’s premier certified pre-owned three-wheeler & electric vehicle marketplace. We provide everything you need to build an amazing dealership experience — transparent pricing, inspected vehicles, and complete peace of mind.
                        </p>

                        <!-- Feature Item 1 -->
                        <div class="d-flex gap-3 mb-4 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3 p-3" style="background: rgba(219, 45, 46, 0.08); width: 54px; height: 54px;">
                                <i class="fa-solid fa-charging-station fs-4" style="color: var(--primary-color, #db2d2e);"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Charging Station</h5>
                                <p class="text-muted mb-0 small" style="line-height: 1.5;">Suitable for any EV dealer, commercial fleet, business, or corporate operators.</p>
                            </div>
                        </div>

                        <!-- Feature Item 2 -->
                        <div class="d-flex gap-3 mb-4 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3 p-3" style="background: rgba(219, 45, 46, 0.08); width: 54px; height: 54px;">
                                <i class="fa-solid fa-rotate-left fs-4" style="color: var(--primary-color, #db2d2e);"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Auto Return Service</h5>
                                <p class="text-muted mb-0 small" style="line-height: 1.5;">Hassle-free 30-day buyback guarantee and transparent ownership transfer options.</p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-2">
                            <a href="<?php echo esc_url( home_url('/services/') ); ?>" class="btn text-white fw-bold px-4 py-3 rounded-2 shadow-sm text-uppercase" style="background-color: var(--primary-color, #db2d2e); border: none; font-size: 0.85rem; letter-spacing: 1px;">
                                View More Our Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 2: PARTNERS & SUPPORTERS LOGO BAR
         ============================================================ -->
    <section class="partners-section py-4 border-top border-bottom" style="background: #fafafa; border-color: #f1f5f9 !important;">
        <div class="container" style="max-width: 1180px;">
            <div class="text-center mb-4">
                <span class="text-uppercase fw-bold text-muted extra-small" style="letter-spacing: 2px; font-size: 0.75rem;">Our Partners &amp; Supporters ——</span>
            </div>
            <div class="row g-4 align-items-center justify-content-between text-center opacity-75">
                <div class="col-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 2px; font-size: 0.85rem;"><i class="fa-solid fa-car me-1"></i> MAHINDRA</div>
                <div class="col-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 2px; font-size: 0.85rem;"><i class="fa-solid fa-bolt me-1"></i> BAJAJ</div>
                <div class="col-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 2px; font-size: 0.85rem;"><i class="fa-solid fa-shield me-1"></i> PIAGGIO</div>
                <div class="col-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 2px; font-size: 0.85rem;"><i class="fa-solid fa-star me-1"></i> TVS</div>
                <div class="col-4 col-md-2 fw-bold text-secondary text-uppercase" style="letter-spacing: 2px; font-size: 0.85rem;"><i class="fa-solid fa-leaf me-1"></i> SAARTHI</div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 3: WHY CHOOSE US (Dark Background Section)
         ============================================================ -->
    <section class="about-why-choose py-5 text-white" style="background: #0f172a; padding: 70px 0;">
        <div class="container" style="max-width: 1180px;">
            <div class="row g-5 align-items-center">
                <!-- Left Column: Content & Service Icons -->
                <div class="col-lg-6">
                    <div class="pe-lg-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-bold text-uppercase small" style="color: var(--primary-color, #db2d2e); letter-spacing: 1.5px; font-size: 0.8rem;">Our Car Services</span>
                            <div style="width: 30px; height: 2px; background-color: var(--primary-color, #db2d2e);"></div>
                        </div>

                        <h2 class="fw-black text-white mb-3" style="font-size: 2.2rem; line-height: 1.25; letter-spacing: -0.5px;">
                            Why Choose Our Car Services
                        </h2>

                        <p class="text-secondary mb-4" style="color: #94a3b8 !important; font-size: 0.94rem; line-height: 1.7;">
                            Rikshawale is the most evolving, creative, modern and multipurpose automotive dealer platform. Built specially for buyers, sellers, and fleet operators who seek verified quality.
                        </p>

                        <!-- Service 1 -->
                        <div class="d-flex gap-3 mb-4 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="background: var(--primary-color, #db2d2e); width: 48px; height: 48px;">
                                <i class="fa-solid fa-wrench fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Brake Check &amp; Services</h5>
                                <p class="mb-0 small" style="color: #94a3b8; line-height: 1.5;">Rigorous 40-point inspection and complete mechanical refurbishment for total reliability.</p>
                            </div>
                        </div>

                        <!-- Service 2 -->
                        <div class="d-flex gap-3 mb-3 align-items-start">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="background: var(--primary-color, #db2d2e); width: 48px; height: 48px;">
                                <i class="fa-solid fa-calendar-check fs-5"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Online Appointment</h5>
                                <p class="mb-0 small" style="color: #94a3b8; line-height: 1.5;">Book instant test drives or doorstep vehicle evaluations with our verified team.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Mechanic / Service Landscape Image -->
                <div class="col-lg-6">
                    <div class="rounded-4 overflow-hidden shadow-lg border border-secondary border-opacity-25">
                        <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80" alt="Car Mechanic Service" class="w-100 h-100 object-fit-cover d-block" style="min-height: 400px; max-height: 480px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 4: WHAT OUR CLIENTS SAY ABOUT (Testimonials 3-Card Grid)
         ============================================================ -->
    <section class="about-testimonials py-5 my-4">
        <div class="container" style="max-width: 1180px;">
            <!-- Section Title -->
            <div class="text-center mb-5">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    <span class="fw-bold text-uppercase small" style="color: var(--primary-color, #db2d2e); letter-spacing: 1.5px; font-size: 0.8rem;">Our Testimonial</span>
                    <div style="width: 30px; height: 2px; background-color: var(--primary-color, #db2d2e);"></div>
                </div>
                <h2 class="fw-black text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -0.5px;">
                    What Our Clients Say About
                </h2>
            </div>

            <!-- 3 Testimonial Cards Grid -->
            <div class="row g-4">
                <?php
                $testimonials = array(
                    array(
                        'name'    => 'Anne Smith',
                        'role'    => 'Customer',
                        'bg_img'  => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80',
                        'avatar'  => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80',
                        'text'    => 'Success isn’t really that difficult. There is a significant portion of the population here in North America that actually want and need transparent vehicles.',
                    ),
                    array(
                        'name'    => 'Felicia Queen',
                        'role'    => 'Auto Dealer',
                        'bg_img'  => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=500&q=80',
                        'avatar'  => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=150&q=80',
                        'text'    => 'Text of the print is a galley of type and bled it to a type specimen book. It has survived not only five centuries lorem ipsum is simply dummy text.',
                    ),
                    array(
                        'name'    => 'Felicia Queen',
                        'role'    => 'Auto Dealer',
                        'bg_img'  => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=500&q=80',
                        'avatar'  => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80',
                        'text'    => 'Making a decision to do something — this is the first step. We all know that nothing moves until someone makes a decision. The first action is always key.',
                    ),
                );

                foreach ( $testimonials as $t ) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 text-center" style="background: #f8fafc;">
                        <!-- Top Vehicle Image Banner -->
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
                                <p class="text-secondary small mb-3" style="line-height: 1.6; font-size: 0.86rem;">
                                    <?php echo esc_html($t['text']); ?>
                                </p>
                            </div>
                            <div class="fs-4 text-muted opacity-50 mt-2">
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
