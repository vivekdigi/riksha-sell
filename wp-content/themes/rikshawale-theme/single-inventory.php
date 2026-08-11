<?php
/**
 * Single Riksha Inventory Detail Template matching Elitecarz product page
 */

get_header();

while ( have_posts() ) : the_post();
    $post_id      = get_the_ID();
    $price_raw    = rikshawale_get_formatted_price( $post_id );
    $mfg_year     = get_post_meta( $post_id, '_car_mfg_year', true ) ?: ( get_post_meta( $post_id, '_car_year', true ) ?: '2018' );
    $reg_year     = get_post_meta( $post_id, '_car_reg_year', true ) ?: $mfg_year;
    $owner_type   = get_post_meta( $post_id, '_car_owner_type', true ) ?: '2nd';
    $brand_name   = get_post_meta( $post_id, '_car_brand_name', true ) ?: 'Toyota';
    $model_name   = get_post_meta( $post_id, '_car_model_name', true ) ?: get_the_title();
    $variant      = get_post_meta( $post_id, '_car_variant', true ) ?: 'G AT';
    $driven_km    = get_post_meta( $post_id, '_car_driven_km', true ) ?: ( get_post_meta( $post_id, '_car_mileage', true ) ?: '67,000 Km' );
    $fuel         = get_post_meta( $post_id, '_car_fuel', true ) ?: 'Petrol';
    $transmission = get_post_meta( $post_id, '_car_transmission', true ) ?: 'Automatic';
    $rto          = get_post_meta( $post_id, '_car_exterior', true ) ?: 'UP';
    $insurance    = 'Comprehensive';
    $color        = get_post_meta( $post_id, '_car_color', true ) ?: 'White';
    $short_desc = get_post_meta( $post_id, '_car_short_desc', true );
    if ( empty( $short_desc ) && has_excerpt( $post_id ) ) {
        $short_desc = get_the_excerpt( $post_id );
    }
    if ( empty( $short_desc ) ) {
        $post_obj = get_post( $post_id );
        if ( $post_obj && ! empty( trim( $post_obj->post_content ) ) ) {
            $clean_txt  = wp_strip_all_tags( $post_obj->post_content );
            $short_desc = wp_trim_words( $clean_txt, 20, '...' );
        }
    }

    $car_video_url  = get_post_meta( $post_id, '_car_video_url', true );
    $raw_badge      = get_post_meta( $post_id, '_car_badge', true );
    $badge_clean    = preg_replace( '/\s+/', ' ', strtolower( trim( (string) $raw_badge ) ) );
    if ( empty( $raw_badge ) || $badge_clean === 'none' || $badge_clean === 'no_badge' || $badge_clean === 'hide' || $badge_clean === 'no badge' ) {
        $car_badge      = '';
        $is_coming_soon = false;
    } else {
        $car_badge      = $raw_badge;
        $is_coming_soon = ( $badge_clean === 'coming soon' || strpos( $badge_clean, 'coming soon' ) !== false );
    }

    // Extract raw price integer for EMI calculator
    $raw_price_str = get_post_meta( $post_id, '_car_price', true ) ?: get_post_meta( $post_id, '_riksha_price', true );
    $numeric_price = preg_replace( '/[^0-9]/', '', $raw_price_str );
    $numeric_price = ( ! empty( $numeric_price ) && floatval( $numeric_price ) > 0 ) ? floatval( $numeric_price ) : 500000;

    $car_custom_rate = get_post_meta( $post_id, '_car_interest_rate', true );
    if ( strlen( trim( $car_custom_rate ) ) > 0 ) {
        $interest_rate = floatval( preg_replace( '/[^0-9.]/', '', $car_custom_rate ) );
    } else {
        $theme_rate    = get_theme_mod( 'emi_interest_rate', '11.75' );
        $interest_rate = floatval( preg_replace( '/[^0-9.]/', '', $theme_rate ) );
    }
    if ( $interest_rate <= 0 ) {
        $interest_rate = 11.75;
    }
    $default_dp_pct      = floatval( get_theme_mod( 'emi_min_downpayment_pct', '20' ) );
    if ( $default_dp_pct <= 0 || $default_dp_pct > 90 ) {
        $default_dp_pct = 20;
    }
    $default_tenure_yrs  = intval( get_theme_mod( 'emi_default_tenure', '5' ) );
    if ( $default_tenure_yrs <= 0 || $default_tenure_yrs > 8 ) {
        $default_tenure_yrs = 5;
    }
    $principal_chart_col = get_theme_mod( 'emi_principal_color', '#0ea5e9' );
    $interest_chart_col  = get_theme_mod( 'emi_interest_color', '#fce4e4' );

    $init_dp   = round( $numeric_price * ( $default_dp_pct / 100 ) );
    $init_loan = $numeric_price - $init_dp;

    // Collect 5 gallery images
    $slides = array();
    if ( has_post_thumbnail() ) {
        $slides[] = get_the_post_thumbnail_url( $post_id, 'full' );
    }
    for ( $i = 1; $i <= 5; $i++ ) {
        $g_img = get_post_meta( $post_id, "_car_gallery_image_{$i}", true );
        if ( $g_img ) {
            $slides[] = $g_img;
        }
    }
    $fallback_imgs = array(
        'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1566838234674-d4508496bf28?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=1200&q=80'
    );
    while ( count( $slides ) < 4 ) {
        $slides[] = $fallback_imgs[ count($slides) % count($fallback_imgs) ];
    }
    $slides = array_slice( $slides, 0, 5 );
?>

<div class="inventory-elite-detail bg-light py-4" style="font-family: var(--font-body, 'Inter', sans-serif);">
    <div class="container" style="max-width: 1240px;">
        
        <!-- TOP MAIN SECTION: Gallery on Left (col-lg-7), Purchase Card on Right (col-lg-5) -->
        <div class="row g-4 align-items-start mb-4">
            
            <!-- LEFT COLUMN: Featured Image / Video + 4-Thumbnail Carousel -->
            <div class="col-lg-7">
                <!-- 1. Main Featured Image / Video Container -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                    <div class="position-relative bg-black text-center" style="height: 440px;" id="mainDetailMediaFrame">
                        <?php if ( $is_coming_soon ) : ?>
                            <div class="coming-soon-img-placeholder d-flex flex-column align-items-center justify-content-center w-100 h-100 p-4 text-white position-relative">
                                <div class="coming-soon-glossy-icon mb-3" style="width: 80px; height: 80px;">
                                    <i class="fa-solid fa-clock-rotate-left fs-1" style="color: #60a5fa; text-shadow: 0 0 16px rgba(96, 165, 250, 0.7);"></i>
                                </div>
                                <h4 class="fw-bold text-uppercase tracking-wider text-white mb-2" style="font-family: var(--font-heading, sans-serif); letter-spacing: 1.5px;">Coming Soon</h4>
                                <p class="text-white-50 small mb-0">This vehicle will be arriving live in inventory soon.</p>
                            </div>
                        <?php else : ?>
                            <img id="mainDetailImage" src="<?php echo esc_url($slides[0]); ?>" class="w-100 h-100 object-fit-cover" alt="<?php the_title_attribute(); ?>">
                            <video id="mainDetailVideo" class="w-100 h-100 object-fit-cover" style="display:none;" controls></video>
                            <iframe id="mainDetailIframe" class="w-100 h-100 border-0" style="display:none;"></iframe>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 2. Thumbnail Carousel Row with Video Thumbnail (if present) -->
                <div class="thumb-carousel-wrapper">
                    <button type="button" class="thumb-carousel-arrow thumb-carousel-prev" onclick="scrollThumbCarousel(-1)" aria-label="Previous">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="thumb-carousel-track" id="thumbCarouselTrack">
                        <?php foreach ( $slides as $idx => $slide_url ) : ?>
                            <div class="thumb-carousel-item <?php echo ( $idx === 0 ) ? 'active' : ''; ?>" onclick="changeMainImage('<?php echo esc_url($slide_url); ?>', this)">
                                <img src="<?php echo esc_url($slide_url); ?>" alt="Thumb <?php echo $idx+1; ?>">
                            </div>
                        <?php endforeach; ?>

                        <?php if ( $car_video_url ) : ?>
                            <div class="thumb-carousel-item" onclick="playBannerVideo('<?php echo esc_url($car_video_url); ?>', this)" style="position:relative; background:#000;">
                                <img src="<?php echo esc_url($slides[0]); ?>" alt="Video Thumbnail" style="opacity:0.6;">
                                <span class="position-absolute top-50 start-50 translate-middle text-white text-center">
                                    <i class="fa-solid fa-circle-play fs-4 d-block" style="color:var(--primary-color, #db2d2e);"></i>
                                    <span style="font-size:8px; font-weight:bold; letter-spacing:1px; text-transform:uppercase;">VIDEO</span>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="thumb-carousel-arrow thumb-carousel-next" onclick="scrollThumbCarousel(1)" aria-label="Next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- RIGHT COLUMN: Purchase Card sitting on top right next to Featured Image -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 90px; z-index: 10;">
                    <h4 class="fw-bold text-dark mb-1"><?php the_title(); ?></h4>
                    <?php if ( ! empty( trim( $short_desc ) ) ) : ?>
                        <p class="text-secondary small mb-2 fw-medium" style="line-height: 1.4; color: #475569;"><?php echo esc_html( $short_desc ); ?></p>
                    <?php endif; ?>
                    <p class="text-muted small mb-3"><?php echo esc_html($driven_km . ' · ' . $fuel . ' · ' . $transmission); ?></p>

                    <div class="d-flex align-items-baseline justify-content-between mb-3 border-bottom pb-3">
                        <span class="fs-2 fw-black text-dark"><?php echo esc_html($price_raw); ?></span>
                        <a href="#emi-calculator" class="text-decoration-none small text-muted text-underline">Price Breakup</a>
                    </div>

                    <div class="d-flex align-items-center justify-content-between bg-light p-2 px-3 rounded-3 mb-4 border">
                        <div>
                            <span class="extra-small text-muted d-block">Starting EMI</span>
                            <strong class="small" style="color: var(--primary-color, #db2d2e);" id="topStartingEMI">₹0 /m</strong>
                        </div>
                        <a href="#emi-calculator" class="btn btn-sm rounded-pill px-3 extra-small fw-bold" style="color: var(--primary-color, #db2d2e); border-color: var(--primary-color, #db2d2e);">Calculate your EMI</a>
                    </div>

                    <!-- Call Now & Book Now CTA Buttons -->
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="tel:<?php echo esc_attr( get_theme_mod('contact_phone', '+91 9876543210') ); ?>" class="btn text-white w-100 py-3 rounded-3 fw-bold shadow-sm d-flex flex-column align-items-center justify-content-center" style="background-color: var(--primary-color, #db2d2e); border: none;">
                                <span>Call Now</span>
                                <span class="extra-small opacity-75 fw-normal">Need more info</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <?php if ( $is_coming_soon ) : ?>
                                <button type="button" disabled class="btn btn-secondary w-100 py-3 rounded-3 fw-bold shadow-sm d-flex flex-column align-items-center justify-content-center" style="opacity: 0.65; cursor: not-allowed; background: #475569; border: none;">
                                    <span>Coming Soon</span>
                                    <span class="extra-small opacity-75 fw-normal">Booking Unavailable</span>
                                </button>
                            <?php else : ?>
                                <button type="button" onclick="triggerVehicleBooking(<?php echo $post_id; ?>, '<?php echo esc_js(get_the_title()); ?>', '<?php echo esc_js($price_raw); ?>', '<?php echo esc_url($slides[0]); ?>')" class="btn btn-dark w-100 py-3 rounded-3 fw-bold shadow-sm d-flex flex-column align-items-center justify-content-center">
                                    <span>Book Now</span>
                                    <span class="extra-small opacity-75 fw-normal">Submit Inquiry</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- DETAILS ROW: Specs, Special about riksha, EMI Calculator, Benefits -->
        <div class="row g-4">
            <div class="col-lg-7">

                <!-- 3. Riksha Detail Specification Grid Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="mb-4 pb-2 border-bottom">
                        <h5 class="fw-bold text-dark mb-1">Riksha Detail</h5>
                        <div style="width: 35px; height: 3px; background: var(--primary-color, #db2d2e); border-radius: 2px;"></div>
                    </div>
                    <div class="row g-4 text-start">
                        <div class="col-4">
                            <span class="d-block text-muted small">Make Year</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($mfg_year); ?></strong>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-muted small">Registration Year</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($reg_year); ?></strong>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-muted small">Ownership</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($owner_type); ?></strong>
                        </div>

                        <div class="col-4">
                            <span class="d-block text-muted small">Fuel</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($fuel); ?></strong>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-muted small">Driven</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($driven_km); ?></strong>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-muted small">RTO</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($rto); ?></strong>
                        </div>

                        <div class="col-4">
                            <span class="d-block text-muted small">Transmission</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($transmission); ?></strong>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-muted small">Insurance</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($insurance); ?></strong>
                        </div>
                        <div class="col-4">
                            <span class="d-block text-muted small">Color</span>
                            <strong class="text-dark fs-6"><?php echo esc_html($color); ?></strong>
                        </div>
                    </div>
                </div>

                <!-- 4. Special About This Riksha Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3">Special about this riksha</h5>
                    <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-3 border">
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background-color: var(--primary-color, #db2d2e);">
                            <i class="fa-solid fa-circle-check fs-5"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark">Well Maintained</strong>
                            <span class="text-muted small">Regularly serviced and kept in mint condition with verified history.</span>
                        </div>
                    </div>
                </div>

                <!-- 5. EMI Calculator Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" id="emi-calculator">
                    <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-calculator me-2 text-danger"></i> EMI calculator</h5>
                    <div class="row g-4 align-items-center">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Loan Amount (Max 80%)</span>
                                    <strong class="text-dark" id="loanAmountLabel">₹<?php echo number_format( $init_loan ); ?></strong>
                                </div>
                                <input type="range" class="form-range" min="<?php echo round( $numeric_price * 0.05 ); ?>" max="<?php echo round( $numeric_price * 0.95 ); ?>" step="1000" value="<?php echo $init_loan; ?>" id="loanAmountRange" oninput="onLoanAmountChange()" onchange="onLoanAmountChange()">
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Down Payment (Min 20%)</span>
                                    <strong class="text-dark" id="downPaymentLabel">₹<?php echo number_format( $init_dp ); ?></strong>
                                </div>
                                <input type="range" class="form-range" min="<?php echo round( $numeric_price * 0.05 ); ?>" max="<?php echo round( $numeric_price * 0.95 ); ?>" step="1000" value="<?php echo $init_dp; ?>" id="downPaymentRange" oninput="onDownPaymentChange()" onchange="onDownPaymentChange()">
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Loan Tenure</span>
                                    <strong class="text-dark" id="tenureVal"><?php echo $default_tenure_yrs; ?> years</strong>
                                </div>
                                <input type="range" class="form-range" min="1" max="8" step="1" value="<?php echo $default_tenure_yrs; ?>" id="tenureRange" oninput="calculateEMI()" onchange="calculateEMI()">
                            </div>

                            <div class="p-3 border rounded-3 text-start" style="background-color: rgba(219, 45, 46, 0.05); border-color: rgba(219, 45, 46, 0.2) !important;">
                                <span class="d-block text-muted small">Monthly EMI</span>
                                <span class="fs-3 fw-bold text-danger" id="calculatedEMI">₹0</span>
                            </div>
                        </div>

                        <div class="col-md-5 text-center">
                            <!-- Dynamic Semi-Circle Gauge Arch SVG -->
                            <div class="position-relative d-inline-block mb-3" style="width: 250px; height: 125px; overflow: hidden;">
                                <svg viewBox="0 0 100 55" class="w-100 h-100">
                                    <!-- Soft Pink Background Arc for Total Interest -->
                                    <path class="circle-bg" stroke="<?php echo esc_attr($interest_chart_col); ?>" stroke-width="12" fill="none" stroke-linecap="round" d="M 10 50 A 40 40 0 0 1 90 50" />
                                    <!-- Sky Blue Foreground Arc for Principal Amount (scales dynamically from left) -->
                                    <path id="emiGaugePrincipal" class="circle" stroke="<?php echo esc_attr($principal_chart_col); ?>" stroke-width="12" fill="none" stroke-linecap="round" d="M 10 50 A 40 40 0 0 1 90 50" stroke-dasharray="100 200" style="transition: stroke-dasharray 0.3s ease-in-out;" />
                                </svg>
                            </div>
                            <div class="text-start small">
                                <h6 class="fw-bold mb-2">Payment Breakdown</h6>
                                <div class="d-flex justify-content-between text-muted mb-1">
                                    <span><i class="fa-solid fa-square me-1" style="color: <?php echo esc_attr($principal_chart_col); ?>;"></i>Principal Amount</span>
                                    <strong class="text-dark" id="breakdownPrincipal">₹0</strong>
                                </div>
                                <div class="d-flex justify-content-between text-muted mb-1">
                                    <span><i class="fa-solid fa-square me-1" style="color: <?php echo esc_attr($interest_chart_col); ?>;"></i>Total Interest</span>
                                    <strong class="text-dark" id="breakdownInterest">₹0</strong>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex justify-content-between fw-bold text-dark">
                                    <span>Total Payment</span>
                                    <span id="breakdownTotal">₹0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<script>
var emiVehiclePrice = <?php echo $numeric_price; ?>;
var emiInterestRate = <?php echo $interest_rate; ?>;

function formatINR(val) {
    val = Math.round(val);
    if (isNaN(val)) return '₹0';
    return '₹' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function onLoanAmountChange() {
    var loanInput = document.getElementById('loanAmountRange');
    if (!loanInput) return;
    var loanVal = parseInt(loanInput.value) || 0;
    var dpVal = emiVehiclePrice - loanVal;
    if (dpVal < 0) dpVal = 0;
    var dpInput = document.getElementById('downPaymentRange');
    if (dpInput) dpInput.value = dpVal;
    calculateEMI();
}

function onDownPaymentChange() {
    var dpInput = document.getElementById('downPaymentRange');
    if (!dpInput) return;
    var dpVal = parseInt(dpInput.value) || 0;
    var loanVal = emiVehiclePrice - dpVal;
    if (loanVal < 0) loanVal = 0;
    var loanInput = document.getElementById('loanAmountRange');
    if (loanInput) loanInput.value = loanVal;
    calculateEMI();
}

function calculateEMI() {
    var loanInput   = document.getElementById('loanAmountRange');
    var dpInput     = document.getElementById('downPaymentRange');
    var tenureInput = document.getElementById('tenureRange');
    if (!loanInput || !dpInput || !tenureInput) return;

    var loanVal   = parseInt(loanInput.value) || 0;
    var dpVal     = parseInt(dpInput.value) || 0;
    var tenureYrs = parseInt(tenureInput.value) || 1;

    var lblLoan = document.getElementById('loanAmountLabel');
    if (lblLoan) lblLoan.innerText = formatINR(loanVal);

    var lblDP = document.getElementById('downPaymentLabel');
    if (lblDP) lblDP.innerText = formatINR(dpVal);

    var lblTenure = document.getElementById('tenureVal');
    if (lblTenure) lblTenure.innerText = tenureYrs + (tenureYrs > 1 ? ' years' : ' year');

    var months = tenureYrs * 12;
    var monthlyRate = (emiInterestRate / 12) / 100;
    
    var emi = 0;
    if (loanVal > 0 && monthlyRate > 0) {
        var pow = Math.pow(1 + monthlyRate, months);
        emi = loanVal * monthlyRate * pow / (pow - 1);
    }
    emi = Math.round(emi);

    var totalPayment = Math.round(emi * months);
    var totalInterest = totalPayment - loanVal;
    if (totalInterest < 0) totalInterest = 0;

    var emiFormatted = formatINR(emi);
    
    var calcEMIEl = document.getElementById('calculatedEMI');
    if (calcEMIEl) calcEMIEl.innerText = emiFormatted;
    
    var topEMIEl = document.getElementById('topStartingEMI');
    if (topEMIEl) topEMIEl.innerText = emiFormatted + ' /m';

    var elP = document.getElementById('breakdownPrincipal');
    if (elP) elP.innerText = formatINR(loanVal);

    var elI = document.getElementById('breakdownInterest');
    if (elI) elI.innerText = formatINR(totalInterest);

    var elT = document.getElementById('breakdownTotal');
    if (elT) elT.innerText = formatINR(totalPayment);

    // Dynamic Semi-Circle Arc Gauge Update (Total Arc Length = 125.66)
    var totalArc = 125.66;
    var principalPct = totalPayment > 0 ? (loanVal / totalPayment) : 0.85;
    var principalLen = (principalPct * totalArc).toFixed(1);

    var gaugePath = document.getElementById('emiGaugePrincipal');
    if (gaugePath) {
        gaugePath.setAttribute('stroke-dasharray', principalLen + ' 200');
    }
}

// Calculate immediately on script parse & DOM load
calculateEMI();
document.addEventListener('DOMContentLoaded', calculateEMI);
window.addEventListener('load', calculateEMI);
</script>

                <!-- 6. Benefits Card (3 Pixel-Perfect Options) -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-2">Benefits</h5>
                    <div style="width: 35px; height: 3px; background: var(--primary-color, #db2d2e); border-radius: 2px;" class="mb-4"></div>
                    <div class="row text-center g-3 align-items-center">
                        <div class="col-4 border-end">
                            <div class="mb-2">
                                <i class="fa-solid fa-file-contract fs-2" style="color: var(--primary-color, #db2d2e);"></i>
                            </div>
                            <strong class="d-block text-dark fw-bold">Transfer</strong>
                            <span class="text-muted small">Cost Included</span>
                        </div>
                        <div class="col-4 border-end">
                            <div class="mb-2">
                                <i class="fa-solid fa-shield-halved fs-2" style="color: var(--primary-color, #db2d2e);"></i>
                            </div>
                            <strong class="d-block text-dark fw-bold">Warranty</strong>
                            <span class="text-muted small">Included</span>
                        </div>
                        <div class="col-4">
                            <div class="mb-2">
                                <i class="fa-solid fa-thumbs-up fs-2" style="color: var(--primary-color, #db2d2e);"></i>
                            </div>
                            <strong class="d-block text-dark fw-bold">150+</strong>
                            <span class="text-muted small">Checkpoints</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- 7. SECTION BEFORE FOOTER 1: Related Products Carousel -->
        <div class="mt-5 pt-4 border-top">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">Related Products</h3>
                <div style="width: 40px; height: 3px; background: var(--primary-color, #db2d2e); border-radius: 2px;" class="mx-auto mt-2"></div>
            </div>
            <div class="car-slider-wrapper">
                <button type="button" class="car-slider-arrow car-slider-prev" onclick="scrollCarSlider(this, -1)">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <div class="car-slider-track">
                    <?php
                    $rel_query = new WP_Query( array(
                        'post_type'      => 'inventory',
                        'posts_per_page' => 5,
                        'post__not_in'   => array($post_id),
                        'post_status'    => 'publish',
                    ) );
                    if ( $rel_query->have_posts() ) :
                        while ( $rel_query->have_posts() ) : $rel_query->the_post();
                            $r_price = rikshawale_get_formatted_price( get_the_ID() );
                            $r_fuel  = get_post_meta( get_the_ID(), '_car_fuel', true ) ?: 'Petrol';
                            $r_trans = get_post_meta( get_the_ID(), '_car_transmission', true ) ?: 'Automatic';
                            $raw_r_badge   = get_post_meta( get_the_ID(), '_car_badge', true );
                            $r_badge_clean = preg_replace( '/\s+/', ' ', strtolower( trim( (string) $raw_r_badge ) ) );
                            if ( empty( $raw_r_badge ) || $r_badge_clean === 'none' || $r_badge_clean === 'no_badge' || $r_badge_clean === 'hide' || $r_badge_clean === 'no badge' ) {
                                $r_badge       = '';
                                $r_coming_soon = false;
                            } else {
                                $r_badge       = $raw_r_badge;
                                $r_coming_soon = ( $r_badge_clean === 'coming soon' || strpos( $r_badge_clean, 'coming soon' ) !== false );
                            }
                    ?>
                    <div class="car-slider-item">
                        <div class="car-card-exact">
                            <a href="<?php the_permalink(); ?>" class="car-card-img-link">
                                <?php if ( $r_badge ) : ?>
                                    <span class="car-card-badge <?php echo $r_coming_soon ? 'badge-coming-soon' : ''; ?>"><?php echo esc_html($r_badge); ?></span>
                                <?php endif; ?>
                                <?php if ( $r_coming_soon ) : ?>
                                    <div class="coming-soon-img-placeholder d-flex flex-column align-items-center justify-content-center w-100 h-100 p-3 text-white position-relative">
                                        <div class="coming-soon-glossy-icon mb-2">
                                            <i class="fa-solid fa-clock-rotate-left fs-4" style="color: #60a5fa; text-shadow: 0 0 12px rgba(96, 165, 250, 0.6);"></i>
                                        </div>
                                        <span class="fw-bold text-uppercase tracking-wider small mb-1" style="color: #f8fafc; font-family: var(--font-heading, sans-serif); letter-spacing: 1px; font-size: 0.78rem;">Coming Soon</span>
                                        <span class="extra-small text-white-50">Arriving Soon</span>
                                    </div>
                                <?php else : ?>
                                    <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </a>
                            <div class="car-card-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="car-card-name text-truncate mb-0 me-2">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h6>
                                    <button class="car-card-bookmark-btn" style="color: var(--primary-color, #db2d2e);"><i class="fa-regular fa-bookmark"></i></button>
                                </div>
                                <div class="car-card-tags mb-2">
                                    <span class="car-tag-pill"><?php echo esc_html($r_fuel); ?></span>
                                    <span class="car-tag-pill"><?php echo esc_html($r_trans); ?></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <span class="car-card-price-main"><?php echo esc_html($r_price); ?></span>
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
                <button type="button" class="car-slider-arrow car-slider-next" onclick="scrollCarSlider(this, 1)">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- 8. SECTION BEFORE FOOTER 2: What our customers say (Dynamic Testimonials CPT) -->
        <?php
        $testi_query = new WP_Query( array(
            'post_type'      => 'testimonial',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );
        if ( $testi_query->have_posts() ) :
        ?>
        <div class="mt-4 pt-3 border-top">
            <div class="text-center mb-3">
                <h3 class="fw-bold text-dark">What our customers say</h3>
                <div style="width: 40px; height: 3px; background: var(--primary-color, #db2d2e); border-radius: 2px;" class="mx-auto mt-1"></div>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                while ( $testi_query->have_posts() ) : $testi_query->the_post();
                    $t_img = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80';
                ?>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div style="height: 200px; overflow: hidden; background: #eee;">
                            <img src="<?php echo esc_url($t_img); ?>" class="w-100 h-100 object-fit-cover" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="card-body p-3 text-center">
                            <p class="small text-muted mb-3">"<?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>"</p>
                            <h6 class="fw-bold text-dark mb-1"><?php the_title(); ?></h6>
                            <!-- Verified Buyer Badge -->
                            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                <span class="d-flex align-items-center gap-1" style="font-size: 0.78rem; color: #16a34a; font-weight: 600;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#16a34a"/>
                                        <path d="M7 12.5L10.5 16L17 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Verified Buyer
                                </span>
                            </div>
                            <!-- 5-Star Rating -->
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <span style="background:#1e3a8a; border-radius: 4px; padding: 3px 10px; display:inline-flex; gap:3px; align-items:center;">
                                    <i class="fa-solid fa-star" style="color:#fff; font-size:11px;"></i>
                                    <i class="fa-solid fa-star" style="color:#fff; font-size:11px;"></i>
                                    <i class="fa-solid fa-star" style="color:#fff; font-size:11px;"></i>
                                    <i class="fa-solid fa-star" style="color:#fff; font-size:11px;"></i>
                                    <i class="fa-solid fa-star" style="color:#fff; font-size:11px;"></i>
                                </span>
                            </div>
                            <?php if ( has_excerpt() ) : ?>
                                <span class="extra-small text-muted"><?php echo esc_html( get_the_excerpt() ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- 9. SECTION BEFORE FOOTER 3: Frequently Asked Questions (Dynamic Riksha FAQ CPT) -->
        <?php
        $detail_faq_query = new WP_Query( array(
            'post_type'      => 'riksha_faq',
            'posts_per_page' => 10,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order date',
            'order'          => 'ASC',
        ) );
        if ( $detail_faq_query->have_posts() ) :
        ?>
        <div class="mt-4 pt-3 border-top">
            <div class="text-center mb-3">
                <h3 class="fw-bold text-dark">Frequently Asked Questions</h3>
                <div style="width: 40px; height: 3px; background: var(--primary-color, #db2d2e); border-radius: 2px;" class="mx-auto mt-1"></div>
            </div>

            <div class="accordion accordion-flush mx-auto" id="inventoryFaqAccordion" style="max-width: 800px;">
                <?php
                $f_count = 0;
                while ( $detail_faq_query->have_posts() ) : $detail_faq_query->the_post();
                    $f_count++;
                ?>
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header" id="faqHeading<?php echo $f_count; ?>">
                        <button class="accordion-button collapsed fw-semibold text-dark py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?php echo $f_count; ?>" aria-expanded="false" aria-controls="faqCollapse<?php echo $f_count; ?>">
                            <?php the_title(); ?>
                        </button>
                    </h2>
                    <div id="faqCollapse<?php echo $f_count; ?>" class="accordion-collapse collapse" aria-labelledby="faqHeading<?php echo $f_count; ?>" data-bs-parent="#inventoryFaqAccordion">
                        <div class="accordion-body text-muted small">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
function changeMainImage(url, el) {
    var img = document.getElementById('mainDetailImage');
    var vid = document.getElementById('mainDetailVideo');
    var iframe = document.getElementById('mainDetailIframe');

    if (vid) { vid.pause(); vid.style.display = 'none'; }
    if (iframe) { iframe.style.display = 'none'; }
    if (img) { img.src = url; img.style.display = 'block'; }

    document.querySelectorAll('.thumb-carousel-item').forEach(function(b) {
        b.classList.remove('active');
    });
    if (el) el.classList.add('active');
}

function playBannerVideo(url, el) {
    var img = document.getElementById('mainDetailImage');
    var vid = document.getElementById('mainDetailVideo');
    var iframe = document.getElementById('mainDetailIframe');

    if (img) img.style.display = 'none';

    if (url.indexOf('youtube.com') !== -1 || url.indexOf('youtu.be') !== -1) {
        if (vid) { vid.pause(); vid.style.display = 'none'; }
        if (iframe) {
            var ytMatch = url.match(/(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i);
            var ytId = (ytMatch && ytMatch[1]) ? ytMatch[1] : '';
            iframe.src = 'https://www.youtube.com/embed/' + ytId + '?autoplay=1&mute=0&loop=1&playlist=' + ytId;
            iframe.style.display = 'block';
        }
    } else {
        if (iframe) { iframe.src = ''; iframe.style.display = 'none'; }
        if (vid) {
            vid.src = url;
            vid.style.display = 'block';
            vid.play();
        }
    }

    document.querySelectorAll('.thumb-carousel-item').forEach(function(b) {
        b.classList.remove('active');
    });
    if (el) el.classList.add('active');
}

function scrollThumbCarousel(direction) {
    var track = document.getElementById('thumbCarouselTrack');
    if (!track) return;
    var scrollAmount = track.clientWidth * 0.75;
    track.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}

function calculateEMI() {
    var P = parseFloat(document.getElementById('loanAmountRange').value) || 624000;
    var N = (parseInt(document.getElementById('tenureRange').value) || 5) * 12;
    var R = 9.5 / 12 / 100;
    var emi = Math.round((P * R * Math.pow(1 + R, N)) / (Math.pow(1 + R, N) - 1));
    document.getElementById('calculatedEMI').innerText = '₹' + emi.toLocaleString('en-IN');
    document.getElementById('tenureVal').innerText = (N / 12) + ' years';
}
</script>

<?php endwhile;

get_footer();
