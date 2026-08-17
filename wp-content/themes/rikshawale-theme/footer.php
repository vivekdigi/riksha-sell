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
                    <?php echo esc_html( get_theme_mod( 'footer_tagline', 'INDIA\'S TRUSTED PRE-OWNED THREE-WHEELER MARKETPLACE' ) ); ?>
                </div>
                <p class="mb-0">
                    <?php echo esc_html( get_theme_mod( 'footer_description', 'Quality, trust, and transparency — handpicked pre-owned commercial rikshas & e-vehicles.' ) ); ?>
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
                        <li><a href="<?php echo esc_url( home_url('/inventory/') ); ?>">Riksha Inventory</a></li>
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
                        <li><a href="<?php echo esc_url( home_url( '/inventory/?model[]=King+Deluxe' ) ); ?>">King Deluxe</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/inventory/?model[]=Maxima+Cargo' ) ); ?>">Maxima Cargo</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/inventory/?model[]=RE' ) ); ?>">RE</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/inventory/?model[]=Treo' ) ); ?>">Treo</a></li>
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
                            <a href="tel:<?php echo esc_attr( get_theme_mod( 'topbar_phone', '+911234567890' ) ); ?>">
                                <?php echo esc_html( get_theme_mod( 'topbar_phone', '+911234567890' ) ); ?>
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
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 50%, #0f172a 100%) !important;">
                <h5 class="modal-title fw-bold text-white mb-0" id="bookingModalLabel"><i class="fa-solid fa-car-side me-2"></i> Vehicle Booking Inquiry</h5>
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
                            <label class="form-label small fw-bold">Mobile Number *</label>
                            <input type="tel" class="form-control rounded-3" name="booking_phone" id="bookingPhoneInput" required placeholder="Mobile No.">
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Alternate Number</label>
                            <input type="tel" class="form-control rounded-3" name="booking_alt_phone" id="bookingAltPhoneInput" placeholder="Alternate Mobile">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Email Address *</label>
                            <input type="email" class="form-control rounded-3" name="booking_email" id="bookingEmailInput" required placeholder="email@domain.com">
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">City / State</label>
                            <input type="text" class="form-control rounded-3" name="booking_city" placeholder="e.g. Delhi">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Preferred Visit Date</label>
                            <input type="date" class="form-control rounded-3" name="booking_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Additional Message or Inquiry</label>
                        <textarea class="form-control rounded-3" name="booking_message" rows="2" placeholder="e.g. Interested in commercial finance options..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 100%); border: none;">
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
            <div class="modal-header border-0 text-white p-4" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 50%, #0f172a 100%) !important;">
                <h5 class="modal-title fw-bold text-white mb-0" id="myBookingsModalLabel"><i class="fa-solid fa-list-check me-2"></i> My Vehicle Bookings</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="myBookingsContent">
                <div class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin fs-4"></i><br>Loading your bookings...</div>
            </div>
        </div>
    </div>
</div>

<script>
// Trigger Booking Modal
function triggerVehicleBooking(carId, carTitle, carPrice, carImg) {
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

    if (rikshawale_ajax.is_logged_in) {
        document.getElementById('bookingNameInput').value = rikshawale_ajax.user_name || '';
        document.getElementById('bookingEmailInput').value = rikshawale_ajax.user_email || '';
        document.getElementById('bookingPhoneInput').value = rikshawale_ajax.user_phone || '';
    }

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
                        if (data.data && data.data.logged_in) {
                            window.location.reload();
                        }
                    }, 2000);
                } else {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-paper-plane me-1"></i> Confirm & Submit Booking';
                }
            });
        });
    }
});
</script>

<!-- ============================================================
     FLOATING WHATSAPP CHAT WIDGET
     ============================================================ -->
<?php
$wa_enable = get_theme_mod( 'whatsapp_enable', true );
$wa_number = preg_replace('/[^0-9]/', '', get_theme_mod( 'whatsapp_number', '919876543210' ) );
$wa_text   = urlencode( get_theme_mod( 'whatsapp_message', 'Hi Rikshawale, I am interested in buying/selling a commercial rickshaw.' ) );
if ( $wa_enable && ! empty( $wa_number ) ) : ?>
<a href="https://wa.me/<?php echo esc_attr($wa_number); ?>?text=<?php echo $wa_text; ?>" target="_blank" rel="noopener noreferrer" id="rikshawale-whatsapp-float" title="Chat on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>
<style>
#rikshawale-whatsapp-float {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 62px;
    height: 62px;
    background: radial-gradient(circle at 35% 25%, #4bf285 0%, #25d366 50%, #0d9447 100%);
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.45), inset 0 2px 3px rgba(255, 255, 255, 0.6), inset 0 -3px 6px rgba(0, 0, 0, 0.3);
    z-index: 99999;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
    text-decoration: none !important;
    animation: waGlossyPulse 2.5s infinite;
}
#rikshawale-whatsapp-float::before {
    content: '';
    position: absolute;
    top: 3px;
    left: 10%;
    width: 80%;
    height: 40%;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.55) 0%, rgba(255, 255, 255, 0) 100%);
    border-radius: 50% 50% 40% 40%;
    pointer-events: none;
}
#rikshawale-whatsapp-float:hover {
    transform: scale(1.15) translateY(-3px);
    box-shadow: 0 14px 35px rgba(37, 211, 102, 0.65), inset 0 3px 4px rgba(255, 255, 255, 0.8), inset 0 -3px 6px rgba(0, 0, 0, 0.3);
    color: #ffffff;
}
#rikshawale-whatsapp-float i {
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.25));
    transition: transform 0.3s ease;
}
#rikshawale-whatsapp-float:hover i {
    transform: scale(1.08);
}
@keyframes waGlossyPulse {
    0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6), 0 10px 25px rgba(37, 211, 102, 0.45), inset 0 2px 3px rgba(255, 255, 255, 0.6), inset 0 -3px 6px rgba(0, 0, 0, 0.3); }
    70% { box-shadow: 0 0 0 16px rgba(37, 211, 102, 0), 0 10px 25px rgba(37, 211, 102, 0.45), inset 0 2px 3px rgba(255, 255, 255, 0.6), inset 0 -3px 6px rgba(0, 0, 0, 0.3); }
    100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0), 0 10px 25px rgba(37, 211, 102, 0.45), inset 0 2px 3px rgba(255, 255, 255, 0.6), inset 0 -3px 6px rgba(0, 0, 0, 0.3); }
}
</style>
<?php endif; ?>

<!-- ============================================================
     FLOATING AI SALES ASSISTANT CHATBOT WIDGET
     ============================================================ -->
<div id="rikshawale-ai-chat-launcher" onclick="toggleRikshawaleAIChat()">
    <div class="ai-launcher-badge">AI Assistant</div>
    <i class="fa-solid fa-robot"></i>
</div>

<div id="rikshawale-ai-chat-window">
    <!-- Header -->
    <div class="ai-chat-header">
        <div class="d-flex align-items-center gap-2">
            <div class="ai-avatar-box"><i class="fa-solid fa-robot"></i></div>
            <div>
                <h6 class="mb-0 fw-bold text-white fs-6">Rikshawale AI Assistant</h6>
                <small class="text-emerald-400" style="color: #4ade80; font-size: 11px;"><i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i> Live Inventory Search</small>
            </div>
        </div>
        <button type="button" class="ai-close-btn" onclick="toggleRikshawaleAIChat()">&times;</button>
    </div>

    <!-- Quick Pills -->
    <div class="ai-quick-pills">
        <button type="button" onclick="sendAIChatQuick('E-Rickshaw under 1.5 Lakh')">⚡ E-Rickshaw &lt; ₹1.5L</button>
        <button type="button" onclick="sendAIChatQuick('Bajaj CNG Auto')">🛺 Bajaj CNG Auto</button>
        <button type="button" onclick="sendAIChatQuick('Lowest Price Rickshaw')">💰 Lowest Price</button>
        <button type="button" onclick="sendAIChatQuick('Mahindra Treo Auto')">⚡ Mahindra Treo</button>
    </div>

    <!-- Messages Container -->
    <div class="ai-chat-body" id="aiChatBody">
        <div class="ai-msg-bubble ai">
            <strong>Namaste! 🙏 Main Aapka Rikshawale AI Assistant Hoon.</strong><br>
            Aap kis budget, fuel type (Electric/CNG/Diesel) ya location ki commercial Rickshaw dhoond rahe hain? Niche likhein ya search karein!
        </div>
    </div>

    <!-- Typing Indicator -->
    <div class="ai-typing-indicator" id="aiTypingIndicator">
        <div class="dot"></div><div class="dot"></div><div class="dot"></div>
        <span class="ms-2 text-muted small">Searching Inventory...</span>
    </div>

    <!-- Input Box -->
    <div class="ai-chat-footer">
        <input type="text" id="aiChatInput" placeholder="Type your query (e.g. Electric auto under 2 Lakh)..." onkeydown="if(event.key==='Enter') sendAIChatMsg()">
        <button type="button" id="aiChatSendBtn" onclick="sendAIChatMsg()"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<style>
/* Chat Launcher Floating Button (Hidden for now) */
#rikshawale-ai-chat-launcher {
    display: none !important;
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #db2d2e 0%, #b91c1c 100%);
    color: #ffffff;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(219, 45, 46, 0.45);
    z-index: 99999;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
}
#rikshawale-ai-chat-launcher:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 30px rgba(219, 45, 46, 0.6);
}
.ai-launcher-badge {
    position: absolute;
    top: -8px;
    background: #0f172a;
    color: #ffffff;
    font-size: 9px;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 10px;
    border: 1px solid #db2d2e;
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Chat Window Container */
#rikshawale-ai-chat-window {
    display: none;
    position: fixed;
    bottom: 95px;
    right: 25px;
    width: 380px;
    max-width: calc(100vw - 40px);
    height: 530px;
    max-height: calc(100vh - 120px);
    background: #0f172a;
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 16px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.6);
    z-index: 99999;
    flex-direction: column;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}
.ai-chat-header {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    padding: 14px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.ai-avatar-box {
    width: 36px;
    height: 36px;
    background: rgba(219,45,46,0.15);
    border: 1px solid #db2d2e;
    color: #db2d2e;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}
.ai-close-btn {
    background: transparent;
    border: none;
    color: #94a3b8;
    font-size: 24px;
    cursor: pointer;
    transition: color 0.2s;
}
.ai-close-btn:hover { color: #ffffff; }

/* Quick Pills */
.ai-quick-pills {
    display: flex;
    gap: 6px;
    padding: 8px 12px;
    background: #1e293b;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: none;
}
.ai-quick-pills::-webkit-scrollbar { display: none; }
.ai-quick-pills button {
    background: rgba(255,255,255,0.06);
    color: #cbd5e1;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    padding: 4px 10px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.2s;
}
.ai-quick-pills button:hover {
    background: #db2d2e;
    color: #ffffff;
    border-color: #db2d2e;
}

/* Chat Messages Stream */
.ai-chat-body {
    flex: 1;
    padding: 14px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.ai-msg-bubble {
    max-width: 85%;
    padding: 10px 14px;
    border-radius: 14px;
    font-size: 13px;
    line-height: 1.5;
    word-break: break-word;
}
.ai-msg-bubble.user {
    align-self: flex-end;
    background: linear-gradient(135deg, #db2d2e 0%, #b91c1c 100%);
    color: #ffffff;
    border-bottom-right-radius: 2px;
}
.ai-msg-bubble.ai {
    align-self: flex-start;
    background: #1e293b;
    color: #e2e8f0;
    border: 1px solid rgba(255,255,255,0.08);
    border-bottom-left-radius: 2px;
}

/* Vehicle Card inside Chat */
.ai-vehicle-card {
    background: #1e293b;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 8px;
    margin-top: 8px;
    display: flex;
    gap: 10px;
    align-items: center;
    transition: border-color 0.2s;
}
.ai-vehicle-card:hover { border-color: #db2d2e; }
.ai-vehicle-card img {
    width: 65px;
    height: 52px;
    object-fit: cover;
    border-radius: 6px;
    background: #0f172a;
}
.ai-vehicle-info { flex: 1; min-width: 0; }
.ai-vehicle-title { font-size: 12px; font-weight: 700; color: #ffffff; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.ai-vehicle-badge { display: inline-block; background: rgba(219,45,46,0.2); color: #f87171; font-size: 11px; font-weight: 700; padding: 1px 6px; border-radius: 4px; }
.ai-vehicle-specs { font-size: 10px; color: #94a3b8; margin-top: 2px; }
.ai-vehicle-link { display: inline-block; font-size: 11px; color: #38bdf8; font-weight: 600; text-decoration: none; margin-top: 3px; }
.ai-vehicle-link:hover { text-decoration: underline; color: #60a5fa; }

/* Typing Indicator */
.ai-typing-indicator {
    display: none;
    align-items: center;
    padding: 6px 14px;
}
.ai-typing-indicator .dot {
    width: 6px;
    height: 6px;
    background: #db2d2e;
    border-radius: 50%;
    margin-right: 4px;
    animation: aiBounce 1.4s infinite ease-in-out both;
}
.ai-typing-indicator .dot:nth-child(1) { animation-delay: -0.32s; }
.ai-typing-indicator .dot:nth-child(2) { animation-delay: -0.16s; }
@keyframes aiBounce {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

/* Chat Footer Input */
.ai-chat-footer {
    padding: 10px 12px;
    background: #1e293b;
    border-top: 1px solid rgba(255,255,255,0.08);
    display: flex;
    gap: 8px;
}
.ai-chat-footer input {
    flex: 1;
    background: #0f172a;
    border: 1px solid rgba(255,255,255,0.1);
    color: #ffffff;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 12px;
    outline: none;
}
.ai-chat-footer input:focus { border-color: #db2d2e; }
.ai-chat-footer button {
    background: #db2d2e;
    color: #ffffff;
    border: none;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
}
.ai-chat-footer button:hover { background: #b91c1c; }
</style>

<script>
function toggleRikshawaleAIChat() {
    var win = document.getElementById('rikshawale-ai-chat-window');
    if (win.style.display === 'flex') {
        win.style.display = 'none';
    } else {
        win.style.display = 'flex';
        document.getElementById('aiChatInput').focus();
    }
}

function sendAIChatQuick(txt) {
    document.getElementById('aiChatInput').value = txt;
    sendAIChatMsg();
}

function sendAIChatMsg() {
    var input = document.getElementById('aiChatInput');
    var msg = input.value.trim();
    if (!msg) return;

    var body = document.getElementById('aiChatBody');
    var typing = document.getElementById('aiTypingIndicator');

    // Append User Message
    var userBubble = document.createElement('div');
    userBubble.className = 'ai-msg-bubble user';
    userBubble.textContent = msg;
    body.appendChild(userBubble);

    input.value = '';
    body.scrollTop = body.scrollHeight;

    // Show Typing Indicator
    typing.style.display = 'flex';

    // AJAX Call
    var fd = new FormData();
    fd.append('action', 'rikshawale_ai_chat');
    fd.append('message', msg);

    fetch(rikshawale_ajax.url, { method: 'POST', body: fd })
    .then(r => r.json())
    .then(res => {
        typing.style.display = 'none';

        var aiBubble = document.createElement('div');
        aiBubble.className = 'ai-msg-bubble ai';

        if (res.success && res.data.reply) {
            aiBubble.innerHTML = res.data.reply;

            // Render matching vehicles if returned
            if (res.data.vehicles && res.data.vehicles.length > 0) {
                res.data.vehicles.forEach(v => {
                    var cardHtml = '<div class="ai-vehicle-card">'
                        + (v.image ? '<img src="' + v.image + '" alt="' + v.title + '">' : '')
                        + '<div class="ai-vehicle-info">'
                        + '<div class="ai-vehicle-title">' + v.title + '</div>'
                        + '<span class="ai-vehicle-badge">' + v.price + '</span>'
                        + '<div class="ai-vehicle-specs">' + v.year + ' • ' + v.fuel + (v.location ? ' • ' + v.location : '') + '</div>'
                        + '<a href="' + v.link + '" target="_blank" class="ai-vehicle-link">View Vehicle <i class="fa-solid fa-arrow-right-long ms-1"></i></a>'
                        + '</div></div>';
                    aiBubble.innerHTML += cardHtml;
                });
            }
        } else {
            aiBubble.textContent = "Apologies, could not process request right now. Please try again or check vehicle inventory.";
        }

        body.appendChild(aiBubble);
        body.scrollTop = body.scrollHeight;
    })
    .catch(err => {
        typing.style.display = 'none';
        var aiBubble = document.createElement('div');
        aiBubble.className = 'ai-msg-bubble ai';
        aiBubble.textContent = "Network error. Please try again.";
        body.appendChild(aiBubble);
        body.scrollTop = body.scrollHeight;
    });
}
</script>

<?php wp_footer(); ?>
</body>
</html>
