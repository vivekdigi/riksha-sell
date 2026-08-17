<?php
/**
 * Template Name: Contact Us
 * Template Post Type: page
 *
 * Contact Us page template for Rikshawale theme.
 * Dynamic Theme Options (Customizer) for Contact Info + AJAX Contact Form saving to CPT contact_enquiry.
 */

get_header();

// Fetch Theme Mod / Customizer values (same as topbar and footer)
$phone         = get_theme_mod( 'topbar_phone',         get_theme_mod( 'contact_phone', '' ) );
$email         = get_theme_mod( 'topbar_email',         get_theme_mod( 'contact_email', '' ) );
$address       = get_theme_mod( 'footer_address',       get_theme_mod( 'contact_address', 'Indra Market, CB-382, Ring Rd, Block CB, Naraina Village, Naraina, New Delhi, Delhi 110028' ) );
$working_hours = get_theme_mod( 'topbar_hours',          get_theme_mod( 'contact_working_hours', 'Mon-Sun: 11:00am - 7:00pm' ) );
$form_title    = get_theme_mod( 'contact_form_title',   'Get in touch' );
$intro_text    = get_theme_mod( 'contact_intro_text',    get_theme_mod( 'footer_description', ''' is a pre-owned car dealership in Delhi NCR, offering handpicked, fully inspected vehicles with warranty and complete peace of mind.' ) );
?>

<div class="contact-page-wrapper" style="font-family: var(--font-body, 'Inter', sans-serif); background: #ffffff; min-height: 80vh; padding: 60px 0;">
    <div class="container" style="max-width: 1140px;">
        <div class="row g-5 align-items-start">

            <!-- LEFT COLUMN: Contact Information Card -->
            <div class="col-lg-5 col-md-6">
                <div class="contact-info-card p-4 p-md-5 rounded-4" style="background-color: #f8f9fa; border: 1px solid #f1f3f5;">
                    <h3 class="fw-bold text-dark mb-4 pb-2" style="font-size: 1.5rem; letter-spacing: -0.5px;">Contact Information</h3>

                    <!-- Phone -->
                    <div class="contact-info-row d-flex py-3 border-bottom" style="border-color: #e9ecef !important;">
                        <div class="contact-info-label text-dark fw-bold" style="width: 120px; font-size: 0.95rem;">Phone:</div>
                        <div class="contact-info-value text-secondary" style="font-size: 0.95rem;">
                            <a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $phone) ); ?>" class="text-decoration-none text-secondary">
                                <?php echo esc_html( $phone ); ?>
                            </a>
                        </div>
                    </div>

                    <!-- E-mail -->
                    <div class="contact-info-row d-flex py-3 border-bottom" style="border-color: #e9ecef !important;">
                        <div class="contact-info-label text-dark fw-bold" style="width: 120px; font-size: 0.95rem;">E-mail:</div>
                        <div class="contact-info-value text-secondary" style="font-size: 0.95rem;">
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-decoration-none text-secondary">
                                <?php echo esc_html( $email ); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="contact-info-row d-flex py-3 border-bottom" style="border-color: #e9ecef !important;">
                        <div class="contact-info-label text-dark fw-bold" style="width: 120px; font-size: 0.95rem; flex-shrink: 0;">Address:</div>
                        <div class="contact-info-value text-secondary" style="font-size: 0.95rem; line-height: 1.6;">
                            <?php echo nl2br( esc_html( $address ) ); ?>
                        </div>
                    </div>

                    <!-- Working time -->
                    <div class="contact-info-row d-flex pt-3">
                        <div class="contact-info-label text-dark fw-bold" style="width: 120px; font-size: 0.95rem; flex-shrink: 0;">Working time:</div>
                        <div class="contact-info-value text-secondary" style="font-size: 0.95rem;">
                            <?php echo esc_html( $working_hours ); ?>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: Get In Touch Form -->
            <div class="col-lg-7 col-md-6">
                <div class="contact-form-wrapper ps-lg-4">
                    <h2 class="fw-bold text-dark mb-3" style="font-size: 2rem; letter-spacing: -0.5px;"><?php echo esc_html( $form_title ); ?></h2>
                    <p class="text-secondary mb-5" style="font-size: 0.95rem; line-height: 1.6; max-width: 580px;">
                        <?php echo esc_html( $intro_text ); ?>
                    </p>

                    <!-- Contact Form -->
                    <form id="rikshawale-contact-form" method="post" novalidate>
                        <?php wp_nonce_field( 'rikshawale_contact_nonce', 'rikshawale_contact_nonce' ); ?>

                        <!-- Name -->
                        <div class="mb-4">
                            <input type="text" name="contact_name" id="contact_name" class="contact-minimal-input w-100" placeholder="Your name*" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <input type="email" name="contact_email" id="contact_email" class="contact-minimal-input w-100" placeholder="E-mail*" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <input type="tel" name="contact_phone" id="contact_phone" class="contact-minimal-input w-100" placeholder="Phone*" required>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <textarea name="contact_message" id="contact_message" rows="3" class="contact-minimal-input w-100" placeholder="Message" required style="resize: vertical;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 pt-2">
                            <button type="submit" id="contact-submit-btn" class="btn text-white fw-bold px-4 py-3 rounded-3" style="background-color: var(--primary-color, #b91c1c); border: none; font-size: 1rem; min-width: 160px; transition: all 0.2s ease;">
                                Send Message
                            </button>
                        </div>

                        <!-- Form Feedback Message -->
                        <div id="contact-form-response" class="mt-3 p-3 rounded-3" style="display: none;"></div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Minimal Line Input Styling matching screenshot */
.contact-minimal-input {
    border: none !important;
    border-bottom: 1px solid #e2e8f0 !important;
    border-radius: 0 !important;
    padding: 12px 0 !important;
    font-size: 0.95rem !important;
    color: #1e293b !important;
    background: transparent !important;
    outline: none !important;
    transition: border-color 0.2s ease;
}

.contact-minimal-input::placeholder {
    color: #94a3b8 !important;
    font-weight: 400;
}

.contact-minimal-input:focus {
    border-bottom-color: var(--primary-color, #b91c1c) !important;
    box-shadow: none !important;
}

#contact-submit-btn:hover {
    background-color: #991b1b !important;
    transform: translateY(-1px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('rikshawale-contact-form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var btn = document.getElementById('contact-submit-btn');
        var res = document.getElementById('contact-form-response');
        var name = document.getElementById('contact_name').value.trim();
        var email = document.getElementById('contact_email').value.trim();
        var phone = document.getElementById('contact_phone').value.trim();
        var message = document.getElementById('contact_message').value.trim();

        if (!name || !email || !message) {
            res.className = 'mt-3 p-3 rounded-3 bg-danger-subtle text-danger border border-danger-subtle';
            res.innerHTML = '<strong>Validation Error:</strong> Please fill in all required fields (Name, Email, Message).';
            res.style.display = 'block';
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Sending...';
        res.style.display = 'none';

        var formData = new FormData(form);
        formData.append('action', 'rikshawale_contact');

        fetch('<?php echo esc_url( admin_url("admin-ajax.php") ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            res.style.display = 'block';
            if (data.success) {
                res.className = 'mt-3 p-3 rounded-3 bg-success-subtle text-success border border-success-subtle';
                res.innerHTML = '<strong>Success!</strong> ' + (data.data.message || 'Thank you! Your message has been sent successfully.');
                form.reset();
            } else {
                res.className = 'mt-3 p-3 rounded-3 bg-danger-subtle text-danger border border-danger-subtle';
                res.innerHTML = '<strong>Error:</strong> ' + (data.data.message || 'Something went wrong. Please try again.');
            }
        })
        .catch(function(err) {
            res.style.display = 'block';
            res.className = 'mt-3 p-3 rounded-3 bg-danger-subtle text-danger border border-danger-subtle';
            res.innerHTML = '<strong>Error:</strong> Unable to connect. Please try again later.';
        })
        .finally(function() {
            btn.disabled = false;
            btn.innerHTML = 'Send Message';
        });
    });
});
</script>

<?php get_footer(); ?>
