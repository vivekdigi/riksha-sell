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

<!-- =========================================================
     MODALS: USER AUTH, VEHICLE BOOKING & MY BOOKINGS
     ========================================================= -->

<!-- 1. Customer Authentication Modal (Login / Register) -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 bg-light p-4 pb-2">
                <ul class="nav nav-pills w-100 gap-2" id="authTabs" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link active w-100 fw-bold rounded-3" id="login-tab" data-bs-toggle="tab" data-bs-target="#loginTabContent" type="button" role="tab"><i class="fa-solid fa-right-to-bracket me-1"></i> Customer Login</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 fw-bold rounded-3" id="register-tab" data-bs-toggle="tab" data-bs-target="#registerTabContent" type="button" role="tab"><i class="fa-solid fa-user-plus me-1"></i> Register Account</button>
                    </li>
                </ul>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="authNotice" class="alert d-none py-2 small mb-3"></div>
                <div class="tab-content" id="authTabsContent">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="loginTabContent" role="tabpanel">
                        <form id="rikshawaleLoginForm">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Username or Email Address</label>
                                <input type="text" class="form-control rounded-3" name="username" required placeholder="Enter your email or username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" class="form-control rounded-3" name="password" required placeholder="••••••••">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold shadow-sm" style="background-color: var(--primary-color, #db2d2e); border: none;">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Log In Now
                            </button>
                        </form>
                    </div>
                    <!-- Register Tab -->
                    <div class="tab-pane fade" id="registerTabContent" role="tabpanel">
                        <form id="rikshawaleRegisterForm">
                            <div class="mb-2">
                                <label class="form-label small fw-bold">Full Name *</label>
                                <input type="text" class="form-control rounded-3" name="reg_name" required placeholder="e.g. Rahul Sharma">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold">Email Address *</label>
                                <input type="email" class="form-control rounded-3" name="reg_email" required placeholder="rahul@example.com">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold">Phone Number *</label>
                                <input type="tel" class="form-control rounded-3" name="reg_phone" required placeholder="+91 98765 43210">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Create Password *</label>
                                <input type="password" class="form-control rounded-3" name="reg_password" required minlength="6" placeholder="At least 6 characters">
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-2.5 rounded-3 fw-bold shadow-sm">
                                <i class="fa-solid fa-user-check me-1"></i> Complete Registration
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Vehicle Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 text-white p-4" style="background-color: var(--primary-color, #db2d2e) !important;">
                <h5 class="modal-title fw-bold" id="bookingModalLabel"><i class="fa-solid fa-car-side me-2"></i> Vehicle Booking Inquiry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Vehicle Card Header preview -->
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-3 border" id="bookingCarPreview">
                    <img id="bookingCarImg" src="" alt="Car" class="rounded-2 object-fit-cover" style="width: 70px; height: 50px; background:#ddd;">
                    <div>
                        <h6 class="fw-bold text-dark mb-0" id="bookingCarTitle">Vehicle Title</h6>
                        <span class="small text-danger fw-bold" id="bookingCarPrice">₹0.00</span>
                    </div>
                </div>
                <div id="bookingNotice" class="alert d-none py-2 small mb-3"></div>
                <form id="rikshawaleBookingForm">
                    <input type="hidden" name="car_id" id="bookingCarId" value="">
                    <input type="hidden" name="car_title" id="bookingCarTitleInput" value="">
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Your Name *</label>
                            <input type="text" class="form-control rounded-3" name="booking_name" id="bookingNameInput" required placeholder="Full Name">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Phone Number *</label>
                            <input type="tel" class="form-control rounded-3" name="booking_phone" id="bookingPhoneInput" required placeholder="+91 Phone">
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Email Address *</label>
                            <input type="email" class="form-control rounded-3" name="booking_email" id="bookingEmailInput" required placeholder="email@domain.com">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">City / State</label>
                            <input type="text" class="form-control rounded-3" name="booking_city" placeholder="e.g. Delhi">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Preferred Test Drive / Visit Date</label>
                        <input type="date" class="form-control rounded-3" name="booking_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Additional Message or Inquiry</label>
                        <textarea class="form-control rounded-3" name="booking_message" rows="2" placeholder="e.g. Interested in commercial finance options..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm" style="background-color: var(--primary-color, #db2d2e); border: none;">
                        <i class="fa-solid fa-paper-plane me-1"></i> Confirm & Submit Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 3. My Bookings Modal -->
<div class="modal fade" id="myBookingsModal" tabindex="-1" aria-labelledby="myBookingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 bg-dark text-white p-4">
                <h5 class="modal-title fw-bold" id="myBookingsModalLabel"><i class="fa-solid fa-list-check me-2 text-primary"></i> My Vehicle Bookings</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="myBookingsContent">
                <div class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin fs-4"></i><br>Loading your bookings...</div>
            </div>
        </div>
    </div>
</div>

<script>
// Trigger Booking Modal or Auth Modal
function triggerVehicleBooking(carId, carTitle, carPrice, carImg) {
    if (!rikshawale_ajax.is_logged_in) {
        var authNotice = document.getElementById('authNotice');
        if (authNotice) {
            authNotice.className = 'alert alert-warning py-2 small mb-3';
            authNotice.innerHTML = '<i class="fa-solid fa-lock me-1"></i> Please log in or register an account to book <strong>' + carTitle + '</strong>.';
        }
        var authModal = new bootstrap.Modal(document.getElementById('authModal'));
        authModal.show();
        return;
    }

    document.getElementById('bookingCarId').value = carId;
    document.getElementById('bookingCarTitleInput').value = carTitle;
    document.getElementById('bookingCarTitle').innerText = carTitle;
    document.getElementById('bookingCarPrice').innerText = carPrice || '';
    if (carImg) {
        document.getElementById('bookingCarImg').src = carImg;
        document.getElementById('bookingCarImg').style.display = 'block';
    } else {
        document.getElementById('bookingCarImg').style.display = 'none';
    }

    document.getElementById('bookingNameInput').value = rikshawale_ajax.user_name || '';
    document.getElementById('bookingEmailInput').value = rikshawale_ajax.user_email || '';
    document.getElementById('bookingPhoneInput').value = rikshawale_ajax.user_phone || '';

    var bookingNotice = document.getElementById('bookingNotice');
    if (bookingNotice) bookingNotice.className = 'alert d-none py-2 small mb-3';

    var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    bookingModal.show();
}

// Fetch User Bookings
function fetchUserBookings() {
    var container = document.getElementById('myBookingsContent');
    container.innerHTML = '<div class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin fs-4 mb-2"></i><br>Loading your bookings...</div>';

    var formData = new FormData();
    formData.append('action', 'rikshawale_get_user_bookings');

    fetch(rikshawale_ajax.url, { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if (data.success && data.data.bookings.length > 0) {
            var html = '<div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Vehicle</th><th>Preferred Date</th><th>Status</th><th>Submitted</th></tr></thead><tbody>';
            data.data.bookings.forEach(b => {
                var badgeClass = 'bg-warning text-dark';
                if (b.status === 'Confirmed') badgeClass = 'bg-success';
                if (b.status === 'Completed') badgeClass = 'bg-primary';
                if (b.status === 'Cancelled') badgeClass = 'bg-danger';

                html += '<tr>' +
                    '<td><div class="d-flex align-items-center gap-2">' + (b.car_img ? '<img src="' + b.car_img + '" width="45" height="35" class="rounded object-fit-cover">' : '') + '<strong><a href="' + b.car_link + '" class="text-dark text-decoration-none" target="_blank">' + b.car_title + '</a></strong></div></td>' +
                    '<td>' + (b.date || 'N/A') + '</td>' +
                    '<td><span class="badge ' + badgeClass + '">' + b.status + '</span></td>' +
                    '<td class="small text-muted">' + b.created + '</td>' +
                    '</tr>';
            });
            html += '</tbody></table></div>';
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="text-center py-4"><i class="fa-solid fa-box-open fs-2 text-muted mb-2"></i><p class="mb-0 text-muted">You have not submitted any vehicle booking inquiries yet.</p></div>';
        }
    })
    .catch(() => {
        container.innerHTML = '<div class="alert alert-danger">Error loading bookings. Please try again.</div>';
    });
}

// JS Forms Setup
document.addEventListener('DOMContentLoaded', function() {
    // Login Form
    var loginForm = document.getElementById('rikshawaleLoginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var notice = document.getElementById('authNotice');
            var btn = loginForm.querySelector('[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Signing in...';

            var fd = new FormData(loginForm);
            fd.append('action', 'rikshawale_login');
            fd.append('nonce', rikshawale_ajax.auth_nonce);

            fetch(rikshawale_ajax.url, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                notice.className = 'alert py-2 small mb-3 alert-' + (data.success ? 'success' : 'danger');
                notice.innerHTML = data.data.message;
                if (data.success) {
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-right-to-bracket me-1"></i> Log In Now';
                }
            });
        });
    }

    // Register Form
    var regForm = document.getElementById('rikshawaleRegisterForm');
    if (regForm) {
        regForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var notice = document.getElementById('authNotice');
            var btn = regForm.querySelector('[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Creating Account...';

            var fd = new FormData(regForm);
            fd.append('action', 'rikshawale_register');
            fd.append('nonce', rikshawale_ajax.auth_nonce);

            fetch(rikshawale_ajax.url, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                notice.className = 'alert py-2 small mb-3 alert-' + (data.success ? 'success' : 'danger');
                notice.innerHTML = data.data.message;
                if (data.success) {
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-user-check me-1"></i> Complete Registration';
                }
            });
        });
    }

    // Booking Form
    var bookingForm = document.getElementById('rikshawaleBookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var notice = document.getElementById('bookingNotice');
            var btn = bookingForm.querySelector('[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Submitting Booking...';

            var fd = new FormData(bookingForm);
            fd.append('action', 'rikshawale_submit_booking');
            fd.append('nonce', rikshawale_ajax.booking_nonce);

            fetch(rikshawale_ajax.url, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                notice.className = 'alert py-2 small mb-3 alert-' + (data.success ? 'success' : 'danger');
                notice.innerHTML = data.data.message;
                if (data.success) {
                    bookingForm.reset();
                    btn.innerHTML = '<i class="fa-solid fa-circle-check me-1"></i> Submitted!';
                    setTimeout(() => {
                        var modalEl = document.getElementById('bookingModal');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                    }, 2500);
                } else {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-paper-plane me-1"></i> Confirm & Submit Booking';
                }
            });
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
