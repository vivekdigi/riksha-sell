<?php
/**
 * Template Name: Sell a Riksha
 * Template Post Type: page
 *
 * Premium "Sell Your Riksha" form page template for Rikshawale theme.
 * Submissions are stored as car_submission CPT (pending) for admin review.
 */

get_header();

// Fetch taxonomy terms for dropdowns
$brands        = get_terms( array( 'taxonomy' => 'car_brand',        'hide_empty' => false ) );
$fuel_types    = get_terms( array( 'taxonomy' => 'riksha_fuel_type', 'hide_empty' => false ) );
$trans_types   = get_terms( array( 'taxonomy' => 'riksha_trans_type','hide_empty' => false ) );
$owner_types   = get_terms( array( 'taxonomy' => 'riksha_owner_type','hide_empty' => false ) );

$current_year  = (int) date('Y');
$years         = range( $current_year, 2005 );

$states = array(
    'Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat',
    'Haryana','Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh',
    'Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Punjab',
    'Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh',
    'Uttarakhand','West Bengal','Delhi','Jammu & Kashmir','Ladakh',
);
?>

<div class="sell-car-page py-4 py-md-5" style="font-family: var(--font-body, 'Inter', sans-serif); background: #f8fafc; min-height: 100vh; padding-bottom: 60px;">

    <!-- ===== MAIN FORM CONTAINER WITH SIMPLE WHITE BACKGROUND & SHADOW ===== -->
    <div class="container" style="max-width: 960px;">
        <div class="bg-white rounded-4 shadow-sm px-4 px-md-5 py-4 py-md-5">
            
            <!-- Feature Pills in Light Style -->
            <div class="row g-3 mb-4">
                <?php
                $pills = array(
                    array( 'Fast Review',       'Quick vehicle details review' ),
                    array( 'Verified Buying',   'Instant fair valuation' ),
                    array( 'Instant Payment',   'Secure payment transfer' ),
                    array( 'Zero Hassle',       'Free doorstep inspection' ),
                );
                foreach ( $pills as $pill ) : ?>
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-light border rounded-3" style="font-size: 0.8rem;">
                        <strong class="d-block text-dark mb-1" style="font-size: 0.83rem;"><?php echo esc_html($pill[0]); ?></strong>
                        <span class="text-muted extra-small"><?php echo esc_html($pill[1]); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- ===== FORM ===== -->
            <form id="sell-car-form" method="post" enctype="multipart/form-data" novalidate>
                <?php wp_nonce_field( 'rikshawale_sell_car_action', 'rikshawale_sell_car_nonce' ); ?>

                <!-- Row 1: Name / Mobile / WhatsApp -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="sell-label" for="seller_name">Your Name <span class="text-danger">*</span></label>
                        <input type="text" class="sell-input form-control" id="seller_name" name="seller_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="sell-label" for="seller_phone">Mobile Number <span class="text-danger">*</span></label>
                        <input type="tel" class="sell-input form-control" id="seller_phone" name="seller_phone" placeholder="Enter mobile number" maxlength="10" required>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="sell-label" for="seller_wa">WhatsApp Number <span class="text-danger">*</span></label>
                        <input type="tel" class="sell-input form-control" id="seller_wa" name="seller_wa" placeholder="Enter WhatsApp number" maxlength="10" required>
                    </div>
                </div>

                <!-- Row 2: City / Reg Number / State -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="seller_city">Your City <span class="text-danger">*</span></label>
                        <input type="text" class="sell-input form-control" id="seller_city" name="seller_city" placeholder="Enter your city" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="seller_reg_no">Registration Number <span class="text-danger">*</span></label>
                        <input type="text" class="sell-input form-control" id="seller_reg_no" name="seller_reg_no" placeholder="DL01AB1234" style="text-transform:uppercase;">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="seller_state">State <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="seller_state" name="seller_state" required>
                            <option value="">Choose state</option>
                            <?php foreach ( $states as $state ) : ?>
                                <option value="<?php echo esc_attr($state); ?>"><?php echo esc_html($state); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Row 3: Mfg Year / Reg Year / Owner Type -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_mfg_year">Manufacturing Year <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_mfg_year" name="car_mfg_year" required>
                            <option value="">Choose year</option>
                            <?php foreach ( $years as $yr ) : ?>
                                <option value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_reg_year">Registration Year <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_reg_year" name="car_reg_year" required>
                            <option value="">Choose year</option>
                            <?php foreach ( $years as $yr ) : ?>
                                <option value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_owner_type">Owner Type <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_owner_type" name="car_owner_type" required>
                            <option value="">Choose owner type</option>
                            <?php if ( ! empty($owner_types) && ! is_wp_error($owner_types) ) :
                                foreach ( $owner_types as $term ) : ?>
                                <option value="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></option>
                            <?php endforeach;
                            else : ?>
                                <option value="1st Owner">1st Owner</option>
                                <option value="2nd Owner">2nd Owner</option>
                                <option value="3rd Owner">3rd Owner</option>
                                <option value="4th+ Owner">4th+ Owner</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <!-- Row 4: Brand / Model / Variant -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_brand_name">Brand <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_brand_name" name="car_brand_name" required>
                            <option value="">Choose brand</option>
                            <?php if ( ! empty($brands) && ! is_wp_error($brands) ) :
                                foreach ( $brands as $term ) : ?>
                                <option value="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></option>
                            <?php endforeach;
                            else :
                                $fallback_brands = array('Bajaj','Mahindra','Piaggio','TVS','Atul','Saarthi','Champion');
                                foreach ( $fallback_brands as $b ) : ?>
                                <option value="<?php echo esc_attr($b); ?>"><?php echo esc_html($b); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_model_name">Model Name <span class="text-danger">*</span></label>
                        <input type="text" class="sell-input form-control" id="car_model_name" name="car_model_name" placeholder="Enter model name" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_variant">Variant <span class="text-danger">*</span></label>
                        <input type="text" class="sell-input form-control" id="car_variant" name="car_variant" placeholder="Enter variant">
                    </div>
                </div>

                <!-- Row 5: Driven KM / Fuel / Transmission -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_driven_km">Driven (KM) <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_driven_km" name="car_driven_km" required>
                            <option value="">Choose km range</option>
                            <option value="Less than 10,000 km">Less than 10,000 km</option>
                            <option value="10,000 – 25,000 km">10,000 – 25,000 km</option>
                            <option value="25,000 – 50,000 km">25,000 – 50,000 km</option>
                            <option value="50,000 – 75,000 km">50,000 – 75,000 km</option>
                            <option value="75,000 – 1,00,000 km">75,000 – 1,00,000 km</option>
                            <option value="More than 1,00,000 km">More than 1,00,000 km</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_fuel">Fuel Type <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_fuel" name="car_fuel" required>
                            <option value="">Choose fuel type</option>
                            <?php if ( ! empty($fuel_types) && ! is_wp_error($fuel_types) ) :
                                foreach ( $fuel_types as $term ) : ?>
                                <option value="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></option>
                            <?php endforeach;
                            else : ?>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="CNG">CNG</option>
                                <option value="LPG">LPG</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="car_transmission">Transmission Type <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="car_transmission" name="car_transmission" required>
                            <option value="">Choose transmission</option>
                            <?php if ( ! empty($trans_types) && ! is_wp_error($trans_types) ) :
                                foreach ( $trans_types as $term ) : ?>
                                <option value="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></option>
                            <?php endforeach;
                            else : ?>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <!-- Row 6: Expected Price -->
                <div class="mb-3">
                    <label class="sell-label" for="car_expected_price">Expected Price? <span class="text-danger">*</span></label>
                    <input type="text" class="sell-input form-control" id="car_expected_price" name="car_expected_price" placeholder="Enter expected price in ₹" required>
                </div>

                <!-- Row 7: 5 Image Uploads -->
                <div class="mb-4">
                    <label class="sell-label mb-2 d-block">Upload Photos <span class="text-muted" style="font-weight:400;">(up to 5 images — JPG/PNG, max 5MB each)</span></label>
                    <div class="row g-3">
                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <div class="col-6 col-md-4 col-lg">
                            <label for="car_image_<?php echo $i; ?>" class="sell-img-upload-box" id="img-box-<?php echo $i; ?>">
                                <input type="file" id="car_image_<?php echo $i; ?>" name="car_image_<?php echo $i; ?>"
                                    accept="image/jpeg,image/png,image/webp" class="sell-img-input"
                                    onchange="previewSellImage(this, <?php echo $i; ?>)">
                                <div class="sell-img-placeholder" id="img-placeholder-<?php echo $i; ?>">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                    <span style="font-size:0.75rem; color:#bbb; margin-top:6px; display:block;">Photo <?php echo $i; ?></span>
                                </div>
                                <img id="img-preview-<?php echo $i; ?>" src="" alt="" style="display:none; width:100%; height:100%; object-fit:cover; border-radius:8px;">
                            </label>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Disclaimer -->
                <p style="font-size: 0.78rem; color: #64748b; margin-bottom: 16px;">
                    By submitting this form, your details will be reviewed by the Rikshawale team for vehicle valuation and follow-up.
                </p>

                <!-- Form Footer: bullets + submit -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 pt-3 border-top">
                    <div class="d-flex gap-4 flex-wrap">
                        <span style="font-size:0.8rem; color:#475569;"><span style="color:var(--primary-color, #db2d2e); font-size:10px;">●</span> Quick callback</span>
                        <span style="font-size:0.8rem; color:#475569;"><span style="color:var(--primary-color, #db2d2e); font-size:10px;">●</span> Verified team</span>
                        <span style="font-size:0.8rem; color:#475569;"><span style="color:var(--primary-color, #db2d2e); font-size:10px;">●</span> Free inspection</span>
                    </div>
                    <button type="submit" id="sell-car-submit-btn"
                        class="btn btn-dark rounded-3 px-5 py-3 fw-bold shadow-sm"
                        style="font-size:0.95rem; letter-spacing:0.5px; background: #0f172a; border: none;">
                        SUBMIT DETAILS <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>

                <!-- Success / Error Message -->
                <div id="sell-car-message" style="display:none; margin-top:16px;" class="rounded-3 p-3"></div>

            </form>
        </div>
    </div>
</div>

<style>
.sell-label {
    font-size: 0.84rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 5px;
    display: block;
}
.sell-input {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 0.88rem;
    padding: 10px 14px;
    color: #0f172a;
    background-color: #ffffff;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.sell-input:focus {
    border-color: var(--primary-color, #db2d2e);
    box-shadow: 0 0 0 3px rgba(219,45,46,0.15);
    outline: none;
}
.sell-img-upload-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100px;
    border: 2px dashed #cbd5e1;
    border-radius: 10px;
    cursor: pointer;
    background: #f8fafc;
    transition: border-color 0.2s, background 0.2s;
    overflow: hidden;
    position: relative;
}
.sell-img-upload-box:hover {
    border-color: var(--primary-color, #db2d2e);
    background: #fff5f5;
}
.sell-img-input {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0;
    cursor: pointer;
}
.sell-img-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    pointer-events: none;
}
</style>

<script>
function previewSellImage(input, idx) {
    var preview = document.getElementById('img-preview-' + idx);
    var placeholder = document.getElementById('img-placeholder-' + idx);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('sell-car-form').addEventListener('submit', function(e) {
    e.preventDefault();

    var btn = document.getElementById('sell-car-submit-btn');
    var msg = document.getElementById('sell-car-message');
    var form = this;

    // Basic validation
    var required = form.querySelectorAll('[required]');
    var valid = true;
    required.forEach(function(field) {
        field.style.borderColor = '';
        if (!field.value.trim()) {
            field.style.borderColor = '#db2d2e';
            valid = false;
        }
    });
    if (!valid) {
        msg.style.display = 'block';
        msg.style.background = '#fef2f2';
        msg.style.color = '#dc2626';
        msg.style.border = '1px solid #fca5a5';
        msg.textContent = 'Please fill all required fields marked with *.';
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Submitting…';

    var formData = new FormData(form);
    formData.append('action', 'rikshawale_sell_car');

    fetch('<?php echo esc_url( admin_url("admin-ajax.php") ); ?>', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
        msg.style.display = 'block';
        if (res.success) {
            msg.style.background = '#f0fdf4';
            msg.style.color = '#16a34a';
            msg.style.border = '1px solid #86efac';
            msg.innerHTML = '<strong>✅ ' + res.data.message + '</strong>';
            form.reset();
            // Reset image previews
            for (var i = 1; i <= 5; i++) {
                var prev = document.getElementById('img-preview-' + i);
                var ph = document.getElementById('img-placeholder-' + i);
                if (prev) { prev.src = ''; prev.style.display = 'none'; }
                if (ph) ph.style.display = 'flex';
            }
            btn.textContent = 'Submitted!';
        } else {
            msg.style.background = '#fef2f2';
            msg.style.color = '#dc2626';
            msg.style.border = '1px solid #fca5a5';
            msg.textContent = '❌ ' + (res.data.message || 'Something went wrong. Please try again.');
            btn.disabled = false;
            btn.textContent = 'SUBMIT DETAILS';
        }
    })
    .catch(function() {
        msg.style.display = 'block';
        msg.style.background = '#fef2f2';
        msg.style.color = '#dc2626';
        msg.style.border = '1px solid #fca5a5';
        msg.textContent = '❌ Network error. Please check your connection and try again.';
        btn.disabled = false;
        btn.textContent = 'SUBMIT DETAILS';
    });
});
</script>

<?php get_footer(); ?>
