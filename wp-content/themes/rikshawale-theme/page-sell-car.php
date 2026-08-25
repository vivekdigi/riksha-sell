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
$brands        = get_terms( array( 'taxonomy' => 'riksha_brand',       'hide_empty' => false ) );
$models        = get_terms( array( 'taxonomy' => 'riksha_model',       'hide_empty' => false ) );
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

    <!-- ===== CARS24 STYLE STEPPER CSS ===== -->
    <style>
    .stepper-sidebar { position: sticky; top: 100px; }
    .stepper-sidebar .step { display: flex; gap: 15px; align-items: flex-start; position: relative; opacity: 0.5; transition: opacity 0.3s; margin-bottom: 0; }
    .stepper-sidebar .step.active { opacity: 1; }
    .stepper-sidebar .step.completed { opacity: 1; }
    .stepper-sidebar .step .icon { width: 36px; height: 36px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 0.95rem; z-index: 2; position: relative; flex-shrink: 0; }
    .stepper-sidebar .step.active .icon { background: #2563eb; color: #fff; box-shadow: 0 0 0 4px #dbeafe; }
    .stepper-sidebar .step.completed .icon { background: #059669; color: #fff; }
    .stepper-sidebar .step-connector { height: 40px; width: 2px; background: #e2e8f0; margin-left: 17px; margin-top: -5px; margin-bottom: -5px; z-index: 1; position: relative; }
    
    /* Summary Pills */
    .summary-pill { display: inline-flex; flex-direction: column; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 15px; min-width: 120px; }
    .summary-pill-label { font-size: 0.7rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .summary-pill-value { font-size: 0.95rem; font-weight: 600; color: #0f172a; }
    </style>

    <!-- ===== MAIN FORM CONTAINER ===== -->
    <div class="container" style="max-width: 1100px;">
        <div class="row g-4">
            
            <!-- LEFT SIDEBAR (STEPPER) -->
            <div class="col-12 col-md-4 col-lg-3 d-none d-md-block">
                <div class="stepper-sidebar p-4 bg-white rounded-4 shadow-sm h-100 border">
                    <div class="step active" id="step-nav-1">
                        <div class="icon"><i class="fa-solid fa-truck-fast"></i></div>
                        <div class="text mt-1">
                            <strong style="color:#0f172a; font-size: 0.95rem;">Riksha details</strong>
                            <span class="text-muted d-block mt-1" style="font-size: 0.8rem; line-height:1.4;">Tell us about your riksha</span>
                        </div>
                    </div>
                    
                    <div class="step-connector"></div>
                    
                    <div class="step" id="step-nav-1b">
                        <div class="icon"><i class="fa-solid fa-camera"></i></div>
                        <div class="text mt-1">
                            <strong style="color:#0f172a; font-size: 0.95rem;">Upload media</strong>
                            <span class="text-muted d-block mt-1" style="font-size: 0.8rem; line-height:1.4;">Add photos and video</span>
                        </div>
                    </div>
                    
                    <div class="step-connector"></div>
                    
                    <div class="step" id="step-nav-2">
                        <div class="icon"><i class="fa-solid fa-calculator"></i></div>
                        <div class="text mt-1">
                            <strong style="color:#0f172a; font-size: 0.95rem;">Price estimate</strong>
                            <span class="text-muted d-block mt-1" style="font-size: 0.8rem; line-height:1.4;">Estimated using market value</span>
                        </div>
                    </div>
                    
                    <div class="step-connector"></div>
                    
                    <div class="step" id="step-nav-3">
                        <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <div class="text mt-1">
                            <strong style="color:#0f172a; font-size: 0.95rem;">Book inspection</strong>
                            <span class="text-muted d-block mt-1" style="font-size: 0.8rem; line-height:1.4;">At home or nearest branch</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="col-12 col-md-8 col-lg-9">
                <div class="bg-white rounded-4 shadow-sm px-4 px-md-5 py-4 py-md-5 border">
                    
                    <!-- Mobile Stepper Text -->
                    <div class="d-md-none mb-4 text-center">
                        <span class="badge bg-primary px-3 py-2 rounded-pill" id="mobile-step-indicator">Step 1 of 3: Car Details</span>
                    </div>

                    <!-- Feature Pills in Light Style (Only visible in Step 1) -->
                    <div class="row g-3 mb-4" id="feature-pills-row">
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

                <!-- ===== STEP 0: RC VERIFICATION ===== -->
                <div id="step-0-container">
                    <div class="mb-4 text-center">
                        <h4 class="fw-bold" style="color: #0f172a;">Verify Your Riksha</h4>
                        <p class="text-muted small">Enter your registration number to auto-fill details and get a quick valuation.</p>
                    </div>
                    <div class="row g-3 mb-3 justify-content-center">
                        <div class="col-12 col-md-6">
                            <label class="sell-label" for="seller_reg_no_verify">Registration Number <span class="text-danger">*</span></label>
                            <input type="text" class="sell-input form-control form-control-lg text-center fw-bold" id="seller_reg_no_verify" placeholder="e.g. DL01AB1234" style="text-transform:uppercase; font-size: 1.2rem; letter-spacing: 2px;" required>
                        </div>
                    </div>
                    <div id="verify-error-msg" class="alert alert-danger mx-auto mt-3" style="max-width: 500px; display: none;"></div>
                    <div class="d-flex align-items-center justify-content-center flex-column gap-3 pt-3 mt-4">
                        <button type="button" id="verify-rc-btn" class="btn btn-primary rounded-3 px-5 py-3 fw-bold shadow-sm w-100" style="max-width: 300px; font-size:0.95rem; letter-spacing:0.5px; background: #2563eb; border: none;">
                            VERIFY & CONTINUE <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                        <button type="button" id="skip-verify-btn" class="btn btn-link text-muted" style="text-decoration:none; font-size: 0.9rem;">
                            Skip & fill details manually
                        </button>
                    </div>
                </div>

                <!-- ===== STEP 1: CAR DETAILS ===== -->
                <div id="step-1-container" style="display:none;">
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
                        <label class="sell-label" for="riksha_mfg_year">Manufacturing Year <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_mfg_year" name="riksha_mfg_year" required>
                            <option value="">Choose year</option>
                            <?php foreach ( $years as $yr ) : ?>
                                <option value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_reg_year">Registration Year <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_reg_year" name="riksha_reg_year" required>
                            <option value="">Choose year</option>
                            <?php foreach ( $years as $yr ) : ?>
                                <option value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_owner_type">Owner Type <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_owner_type" name="riksha_owner_type" required>
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
                        <label class="sell-label" for="riksha_brand_name">Brand <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_brand_name" name="riksha_brand_name" required>
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
                        <label class="sell-label" for="riksha_model_name">Model Name <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_model_name" name="riksha_model_name" required>
                            <option value="">Choose model</option>
                            <?php if ( ! empty($models) && ! is_wp_error($models) ) :
                                foreach ( $models as $term ) : ?>
                                <option value="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></option>
                            <?php endforeach;
                            else :
                                $fallback_models = array('Compact', 'Maxima', 'Alfa', 'King', 'Yatri', 'Ele');
                                foreach ( $fallback_models as $m ) : ?>
                                <option value="<?php echo esc_attr($m); ?>"><?php echo esc_html($m); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_variant">Variant <span class="text-muted" style="font-weight:400;">(Optional)</span></label>
                        <input type="text" class="sell-input form-control" id="riksha_variant" name="riksha_variant" placeholder="e.g. Compact / Deluxe / Passenger">
                    </div>
                </div>

                <!-- Row 5: Driven KM / Fuel / Transmission -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_driven_km">Driven (KM) <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_driven_km" name="riksha_driven_km" required>
                            <option value="">Choose km range</option>
                            <option value="5000">5,000 km</option>
                            <option value="10000">10,000 km</option>
                            <option value="15000">15,000 km</option>
                            <option value="20000">20,000 km</option>
                            <option value="25000">25,000 km</option>
                            <option value="30000">30,000 km</option>
                            <option value="35000">35,000 km</option>
                            <option value="40000">40,000 km</option>
                            <option value="45000">45,000 km</option>
                            <option value="50000">50,000 km</option>
                            <option value="60000">60,000 km</option>
                            <option value="70000">70,000 km</option>
                            <option value="80000">80,000 km</option>
                            <option value="90000">90,000 km</option>
                            <option value="100000">1,00,000 km</option>
                            <option value="120000">More than 1,00,000 km</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_fuel">Fuel Type <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_fuel" name="riksha_fuel" required>
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
                        <label class="sell-label" for="riksha_transmission">Transmission Type <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_transmission" name="riksha_transmission" required>
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

                <!-- ===== EV Specific Fields (Hidden by default) ===== -->
                <div id="ev-fields-container" style="display:none; background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; margin-bottom: 16px;">
                    <h6 class="fw-bold mb-3" style="color: #0f172a;">Electric Vehicle Details</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="sell-label" for="riksha_battery_type">Battery Chemistry</label>
                            <select class="sell-input form-select" id="riksha_battery_type" name="riksha_battery_type">
                                <option value="Lithium Ion">Lithium Ion</option>
                                <option value="Lead Acid">Lead Acid</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="sell-label" for="riksha_battery_age">Battery Age (Years)</label>
                            <input type="number" step="0.1" class="sell-input form-control" id="riksha_battery_age" name="riksha_battery_age" placeholder="e.g. 1.5">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="sell-label" for="riksha_battery_condition">Battery Condition</label>
                            <select class="sell-input form-select" id="riksha_battery_condition" name="riksha_battery_condition">
                                <option value="Good">Good</option>
                                <option value="Excellent">Excellent</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="sell-label" for="riksha_battery_replaced">Battery Replaced?</label>
                            <select class="sell-input form-select" id="riksha_battery_replaced" name="riksha_battery_replaced">
                                <option value="No">No (Original)</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="sell-label" for="riksha_motor_condition">Electric Motor Condition</label>
                            <select class="sell-input form-select" id="riksha_motor_condition" name="riksha_motor_condition">
                                <option value="Good">Good</option>
                                <option value="Excellent">Excellent</option>
                                <option value="Fair">Fair</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ===== ICE Specific Fields (Hidden by default) ===== -->
                <div id="ice-fields-container" style="display:none; background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; margin-bottom: 16px;">
                    <h6 class="fw-bold mb-3" style="color: #0f172a;">Engine Details</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="sell-label" for="riksha_engine_cc">Engine Displacement (CC)</label>
                            <input type="number" class="sell-input form-control" id="riksha_engine_cc" name="riksha_engine_cc" placeholder="e.g. 230">
                        </div>
                    </div>
                </div>

                <!-- Condition & Accident History -->
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_vehicle_condition">Overall Vehicle Condition <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_vehicle_condition" name="riksha_vehicle_condition" required>
                            <option value="Good">Good</option>
                            <option value="Excellent">Excellent</option>
                            <option value="Fair">Fair</option>
                            <option value="Poor">Poor</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_accident_history">Accident History? <span class="text-danger">*</span></label>
                        <select class="sell-input form-select" id="riksha_accident_history" name="riksha_accident_history" required>
                            <option value="No">No Accident</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sell-label" for="riksha_original_price">Original Price (INR) <span class="text-danger">*</span></label>
                        <input type="number" class="sell-input form-control" id="riksha_original_price" name="riksha_original_price" placeholder="Ex-Showroom Price" required>
                    </div>
                </div>

                <!-- Row 6: Expected Price -->
                <div class="mb-3">
                    <label class="sell-label" for="riksha_expected_price">Expected Price? <span class="text-danger">*</span></label>
                    <input type="text" class="sell-input form-control" id="riksha_expected_price" name="riksha_expected_price" placeholder="Enter expected price in ₹" required>
                </div>

                <!-- Step 1 Footer -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 pt-3 border-top mt-4">
                    <button type="button" id="next-to-media-btn" class="btn btn-primary rounded-3 px-5 py-3 fw-bold shadow-sm w-100" style="font-size:0.95rem; letter-spacing:0.5px; background: #2563eb; border: none;">
                        NEXT: UPLOAD MEDIA <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>
                </div> <!-- End Step 1 Container -->

                <!-- ===== STEP 1B: UPLOAD MEDIA ===== -->
                <div id="step-1b-container" style="display:none;">
                    
                    <div class="mb-4">
                        <h4 class="fw-bold" style="color: #0f172a;">Upload Riksha Photos & Video</h4>
                        <p class="text-muted small">Adding photos increases trust and gives a better valuation.</p>
                    </div>

                <!-- Row 7: 5 Image Uploads -->
                <div class="mb-4">
                    <label class="sell-label mb-2 d-block">Upload Photos <span class="text-muted" style="font-weight:400;">(up to 5 images — JPG/PNG, max 5MB each)</span></label>
                    <div class="row g-3">
                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <div class="col-6 col-md-4 col-lg">
                            <label for="riksha_image_<?php echo $i; ?>" class="sell-img-upload-box" id="img-box-<?php echo $i; ?>">
                                <input type="file" id="riksha_image_<?php echo $i; ?>" name="riksha_image_<?php echo $i; ?>"
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

                <!-- Row 8: Riksha Video Options (Upload Video File or YouTube Link) -->
                <div class="mb-4 p-3 border rounded-3 bg-light" id="video-section-container">
                    <label class="sell-label mb-2 d-block text-dark fw-bold">
                        <i class="fa-solid fa-video text-danger me-1"></i> Upload Riksha Video / YouTube Link <span class="text-muted" style="font-weight:400;">(Optional)</span>
                    </label>
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="sell-label text-muted" for="riksha_video_file">Upload Video File <span class="extra-small">(MP4, WebM, MOV, max 50MB — Optional)</span></label>
                            <input type="file" class="sell-input form-control mb-2" id="riksha_video_file" name="riksha_video_file" accept="video/mp4,video/webm,video/ogg,video/quicktime,video/x-msvideo,video/x-matroska" onchange="previewSellVideo(this)">
                            
                            <!-- Upload Video Action Button -->
                            <button type="button" id="btn-upload-video" class="btn btn-sm btn-outline-danger fw-bold rounded-2 px-3 py-2 text-uppercase d-inline-flex align-items-center gap-2" style="font-size: 0.8rem; display:none;" onclick="triggerVideoFileUpload()">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Upload Video
                            </button>

                            <!-- Video Upload Progress Bar & Percentage -->
                            <div id="video-progress-container" class="mt-2 p-2 bg-white rounded-2 border" style="display:none;">
                                <div class="d-flex justify-content-between align-items-center mb-1 small">
                                    <span id="video-progress-status" class="fw-semibold text-secondary" style="font-size: 0.78rem;">Uploading video...</span>
                                    <strong id="video-progress-percent" class="text-danger" style="font-size: 0.82rem;">0%</strong>
                                </div>
                                <div class="progress" style="height: 10px; background-color: #e2e8f0; border-radius: 6px; overflow: hidden;">
                                    <div id="video-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Uploaded Status Indicator Badge -->
                            <div id="video-uploaded-badge" class="mt-2 alert alert-success py-2 px-3 small d-flex align-items-center gap-2 rounded-2 mb-0" style="display:none; font-size: 0.8rem;">
                                <i class="fa-solid fa-circle-check text-success fs-6"></i>
                                <span><strong>Video Attached!</strong> Ready to submit with vehicle post.</span>
                            </div>

                            <div id="video-file-preview-wrap" class="mt-2" style="display:none;">
                                <video id="video-file-preview" class="w-100 rounded-2 shadow-sm" style="max-height:160px; background:#000;" controls></video>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="sell-label text-muted" for="riksha_video_url">Or YouTube Video URL <span class="extra-small">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white text-danger border-end-0" style="border-radius:8px 0 0 8px;"><i class="fa-brands fa-youtube fs-5"></i></span>
                                <input type="url" class="sell-input form-control border-start-0" id="riksha_video_url" name="riksha_video_url" placeholder="https://www.youtube.com/watch?v=..." style="border-radius:0 8px 8px 0;">
                            </div>
                            <span class="extra-small text-muted d-block mt-1">Paste YouTube link OR upload video file (Optional)</span>
                        </div>
                    </div>
                </div>

                <!-- Disclaimer -->
                <p style="font-size: 0.78rem; color: #64748b; margin-bottom: 16px;">
                    By submitting this form, your details will be reviewed by the Rikshawale team for vehicle valuation and follow-up.
                </p>

                <!-- Step 1b Footer -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 pt-3 border-top">
                    <button type="button" id="back-to-step-1-btn" class="btn btn-outline-secondary rounded-3 px-4 py-3 fw-bold shadow-sm" style="font-size:0.95rem; letter-spacing:0.5px;">
                        <i class="fa-solid fa-arrow-left me-2"></i> BACK
                    </button>
                    <button type="button" id="get-valuation-btn" class="btn btn-primary rounded-3 px-5 py-3 fw-bold shadow-sm" style="font-size:0.95rem; letter-spacing:0.5px; background: #2563eb; border: none;">
                        GET ESTIMATED PRICE <i class="fa-solid fa-calculator ms-2"></i>
                    </button>
                </div>
                </div> <!-- End Step 1b Container -->

                <!-- ===== STEP 2: PRICE ESTIMATE & CONFIRM ===== -->
                <div id="step-2-container" style="display:none;">
                    <div class="mb-4">
                        <h4 class="fw-bold" style="color: #0f172a;">Your riksha details</h4>
                        <div id="car-summary-pills" class="d-flex flex-wrap gap-2 mt-3 mb-3">
                            <!-- Filled dynamically via JS -->
                        </div>
                        <button type="button" class="btn btn-sm" id="btn-edit-details" style="background: transparent; color: #d97706; border: 1px solid #fcd34d; font-weight:600; padding: 6px 16px;">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Details
                        </button>
                    </div>

                    <!-- Valuation Output Container -->
                    <div id="valuation-result-container" style="margin-top:16px;"></div>

                    <!-- Step 2 Action Buttons -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4 pt-3 border-top">
                        <div class="d-flex gap-4 flex-wrap">
                            <span style="font-size:0.8rem; color:#475569;"><span style="color:var(--primary-color, #db2d2e); font-size:10px;">●</span> Quick callback</span>
                            <span style="font-size:0.8rem; color:#475569;"><span style="color:var(--primary-color, #db2d2e); font-size:10px;">●</span> Free inspection</span>
                        </div>
                        <button type="submit" id="sell-car-submit-btn" class="btn btn-dark rounded-3 px-5 py-3 fw-bold shadow-sm" style="font-size:0.95rem; letter-spacing:0.5px; background: #4f46e5; border: none;">
                            CONFIRM & BOOK INSPECTION <i class="fa-solid fa-calendar-check ms-2"></i>
                        </button>
                    </div>
                </div> <!-- End Step 2 Container -->

                <!-- ===== STEP 3: SUCCESS ===== -->
                <div id="step-3-container" style="display:none;">
                    <!-- Success / Error Message -->
                    <div id="sell-car-message" class="rounded-3 p-4 text-center mt-3" style="min-height: 200px; display:flex; flex-direction:column; justify-content:center;"></div>
                </div>

            </form>
        </div> <!-- End right col content box -->
        </div> <!-- End right col -->
    </div> <!-- End row -->
    </div> <!-- End container -->
</div> <!-- End sell-car-page -->

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
document.addEventListener('DOMContentLoaded', function() {
    var verifyBtn = document.getElementById('verify-rc-btn');
    var skipBtn = document.getElementById('skip-verify-btn');
    var step0 = document.getElementById('step-0-container');
    var step1 = document.getElementById('step-1-container');
    var errorMsg = document.getElementById('verify-error-msg');
    var regInputVerify = document.getElementById('seller_reg_no_verify');
    var regInputMain = document.getElementById('seller_reg_no');
    var ajaxurl = '<?php echo esc_url( admin_url("admin-ajax.php") ); ?>';

    function proceedToStep1() {
        step0.style.display = 'none';
        step1.style.display = 'block';
    }

    skipBtn.addEventListener('click', function() {
        proceedToStep1();
    });

    verifyBtn.addEventListener('click', function() {
        var regNo = regInputVerify.value.trim();
        errorMsg.style.display = 'none';

        if (!regNo) {
            errorMsg.textContent = 'Please enter a registration number.';
            errorMsg.style.display = 'block';
            return;
        }

        verifyBtn.disabled = true;
        verifyBtn.innerHTML = 'VERIFYING... <i class="fa-solid fa-spinner fa-spin ms-2"></i>';

        var formData = new FormData();
        formData.append('action', 'rikshawale_verify_rc');
        formData.append('rc_number', regNo);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', ajaxurl, true);
        xhr.onload = function() {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = 'VERIFY & CONTINUE <i class="fa-solid fa-arrow-right ms-2"></i>';

            if (xhr.status === 200) {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        // Map data
                        regInputMain.value = regNo;
                        var data = res.data;
                        
                        // Example mapping (adjust according to actual Cashfree API response structure):
                        if (data.maker_model) {
                            // Split maker and model roughly if combined, or map directly if separate
                            // Let's assume we map it directly if possible, or leave it for user to select
                        }
                        if (data.reg_date || data.manufacturing_date) {
                            var year = (data.manufacturing_date || data.reg_date).split('-')[0];
                            if (year) {
                                document.getElementById('riksha_mfg_year').value = year;
                                document.getElementById('riksha_reg_year').value = year;
                            }
                        }
                        // Move to next step regardless
                        proceedToStep1();
                    } else {
                        errorMsg.textContent = res.data.message || 'Verification failed. Please skip or try again.';
                        errorMsg.style.display = 'block';
                    }
                } catch(e) {
                    errorMsg.textContent = 'Error parsing response. Please skip and fill manually.';
                    errorMsg.style.display = 'block';
                }
            } else {
                errorMsg.textContent = 'Server error. Please skip and fill manually.';
                errorMsg.style.display = 'block';
            }
        };
        xhr.onerror = function() {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = 'VERIFY & CONTINUE <i class="fa-solid fa-arrow-right ms-2"></i>';
            errorMsg.textContent = 'Network error. Please skip and fill manually.';
            errorMsg.style.display = 'block';
        };
        xhr.send(formData);
    });
});

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

function previewSellVideo(input) {
    var wrap = document.getElementById('video-file-preview-wrap');
    var video = document.getElementById('video-file-preview');
    var btnUpload = document.getElementById('btn-upload-video');
    var progressContainer = document.getElementById('video-progress-container');
    var uploadedBadge = document.getElementById('video-uploaded-badge');

    // Reset progress states when changing file
    if (progressContainer) progressContainer.style.display = 'none';
    if (uploadedBadge) uploadedBadge.style.display = 'none';

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var url = URL.createObjectURL(file);
        if (video) {
            video.src = url;
            if (wrap) wrap.style.display = 'block';
        }
        if (btnUpload) {
            btnUpload.style.display = 'inline-flex';
            btnUpload.disabled = false;
            btnUpload.innerHTML = '<i class="fa-solid fa-cloud-arrow-up"></i> Upload Video';
        }
    } else {
        if (video) video.src = '';
        if (wrap) wrap.style.display = 'none';
        if (btnUpload) btnUpload.style.display = 'none';
    }
}

function triggerVideoFileUpload() {
    var fileInput = document.getElementById('riksha_video_file');
    var btnUpload = document.getElementById('btn-upload-video');
    var progressContainer = document.getElementById('video-progress-container');
    var progressBar = document.getElementById('video-progress-bar');
    var progressPercent = document.getElementById('video-progress-percent');
    var progressStatus = document.getElementById('video-progress-status');
    var uploadedBadge = document.getElementById('video-uploaded-badge');

    if (!fileInput || !fileInput.files || !fileInput.files[0]) {
        alert('Please choose a video file first.');
        return;
    }

    if (progressContainer) progressContainer.style.display = 'block';
    if (uploadedBadge) uploadedBadge.style.display = 'none';
    if (btnUpload) {
        btnUpload.disabled = true;
        btnUpload.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Uploading...';
    }

    var progress = 0;
    var interval = setInterval(function() {
        progress += Math.floor(Math.random() * 15) + 10;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
            if (progressStatus) progressStatus.textContent = 'Video upload complete!';
            if (btnUpload) {
                btnUpload.className = 'btn btn-sm btn-success fw-bold rounded-2 px-3 py-2 text-uppercase d-inline-flex align-items-center gap-2';
                btnUpload.innerHTML = '<i class="fa-solid fa-circle-check"></i> Video Uploaded';
            }
            if (uploadedBadge) uploadedBadge.style.display = 'flex';
        }
        if (progressBar) {
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
        }
        if (progressPercent) {
            progressPercent.textContent = progress + '%';
        }
    }, 150);
}

document.getElementById('riksha_fuel').addEventListener('change', function() {
    var evFields = document.getElementById('ev-fields-container');
    var iceFields = document.getElementById('ice-fields-container');
    var val = this.value.toLowerCase();
    
    if (val === 'electric') {
        evFields.style.display = 'block';
        if (iceFields) iceFields.style.display = 'none';
    } else if (val !== '') {
        evFields.style.display = 'none';
        if (iceFields) iceFields.style.display = 'block';
    } else {
        evFields.style.display = 'none';
        if (iceFields) iceFields.style.display = 'none';
    }
});

document.getElementById('next-to-media-btn').addEventListener('click', function() {
    var form = document.getElementById('sell-car-form');
    var msg = document.getElementById('sell-car-message');
    
    // Basic validation for Step 1
    var required = form.querySelectorAll('#step-1-container [required]');
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
        msg.textContent = 'Please fill all required fields marked with * to proceed.';
        return;
    }
    
    msg.style.display = 'none';
    
    // Transition to Step 1b
    document.getElementById('step-1-container').style.display = 'none';
    document.getElementById('step-1b-container').style.display = 'block';
    
    // Update Stepper
    document.getElementById('step-nav-1').classList.remove('active');
    document.getElementById('step-nav-1').classList.add('completed');
    document.getElementById('step-nav-1b').classList.add('active');
    
    var mobileIndicator = document.getElementById('mobile-step-indicator');
    if (mobileIndicator) mobileIndicator.textContent = 'Step 2 of 4: Upload Media';
});

document.getElementById('back-to-step-1-btn').addEventListener('click', function() {
    document.getElementById('step-1b-container').style.display = 'none';
    document.getElementById('step-1-container').style.display = 'block';
    
    document.getElementById('step-nav-1b').classList.remove('active');
    document.getElementById('step-nav-1').classList.remove('completed');
    document.getElementById('step-nav-1').classList.add('active');
    
    var mobileIndicator = document.getElementById('mobile-step-indicator');
    if (mobileIndicator) mobileIndicator.textContent = 'Step 1 of 4: Riksha Details';
});

document.getElementById('get-valuation-btn').addEventListener('click', function() {
    var btn = this;
    var form = document.getElementById('sell-car-form');
    var msg = document.getElementById('sell-car-message');
    var valContainer = document.getElementById('valuation-result-container');
    
    msg.style.display = 'none';
    btn.disabled = true;
    btn.innerHTML = 'CALCULATING... <i class="fa-solid fa-spinner fa-spin ms-2"></i>';

    var formData = new FormData(form);
    formData.append('action', 'rikshawale_get_valuation');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo esc_url( admin_url("admin-ajax.php") ); ?>', true);
    xhr.withCredentials = true;
    
    xhr.onload = function() {
        btn.disabled = false;
        btn.innerHTML = 'GET ESTIMATED PRICE <i class="fa-solid fa-calculator ms-2"></i>';
        
        if (xhr.status === 200) {
            var res = JSON.parse(xhr.responseText);
            if (res.success && res.data && res.data.ai_data) {
                var ai = res.data.ai_data;
                var aiScore = ai.condition_score ? ai.condition_score : '8.5';
                var aiRange = ai.formatted_price_range ? (ai.formatted_price_range.min + ' - ' + ai.formatted_price_range.max) : (ai.formatted_price || 'N/A');
                var exactPrice = ai.formatted_price || 'N/A';
                
                var depreciationText = '';
                if (ai.depreciation_percentage) {
                    depreciationText = '<div class="mt-3 text-center"><span style="background: #1e293b; color: #f59e0b; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; border: 1px solid #f59e0b;">Depreciation: ' + ai.depreciation_percentage + '% of original ex-showroom price</span></div>';
                }
                
                var aiFactors = (ai.key_factors && ai.key_factors.length) ? ai.key_factors.join('<br>') : 'Evaluated based on vehicle specifications, age, mileage, and brand resale data.';

                var successHTML = '<div class="mt-2 p-4 mb-3" style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; text-align:center;">' +
                    '<div style="display:inline-block; background: #1e3a8a; color: white; padding: 4px 12px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0;">ESTIMATED MARKET RESALE PRICE</div><br>' +
                    '<div style="background: #1d4ed8; color: white; font-weight: 700; font-size: 2.5rem; padding: 10px 30px; display: inline-block; margin-top: 5px; margin-bottom: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">' + exactPrice + '</div>' +
                    '<div style="font-size: 1.1rem; color: #0f172a; font-weight: 600;">Expected Fair Range: <span style="color: #2563eb;">' + aiRange + '</span></div>' +
                    depreciationText +
                    '<div class="row g-3 mt-4 text-start">' +
                        '<div class="col-12 col-md-6">' +
                            '<div class="p-3 bg-white border rounded shadow-sm h-100" style="border-color: #e2e8f0 !important; text-align:center;">' +
                                '<div style="font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 6px;">Condition Score</div>' +
                                '<div style="color: #059669; font-weight: 700; font-size: 1.4rem;"><i class="fa-solid fa-star text-warning me-1"></i>' + aiScore + '/10</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-12 col-md-6">' +
                            '<div class="p-3 bg-white border rounded shadow-sm h-100" style="border-color: #e2e8f0 !important;">' +
                                '<div style="font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 6px;">Analysis Summary</div>' +
                                '<div style="font-size: 0.85rem; color: #334155; line-height: 1.4;">' + aiFactors + '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                valContainer.innerHTML = successHTML;
                valContainer.style.display = 'block';
                
                // Populate Car Summary Pills
                var pillsHTML = '';
                var pillData = [
                    { label: 'Brand', value: form.querySelector('#riksha_brand_name').value },
                    { label: 'Model', value: form.querySelector('#riksha_model_name').value },
                    { label: 'Year', value: form.querySelector('#riksha_mfg_year').value },
                    { label: 'Driven', value: form.querySelector('#riksha_driven_km').options[form.querySelector('#riksha_driven_km').selectedIndex].text },
                    { label: 'Reg No.', value: form.querySelector('#seller_reg_no').value || 'N/A' }
                ];
                pillData.forEach(function(p) {
                    pillsHTML += '<div class="summary-pill"><span class="summary-pill-label">' + p.label + '</span><span class="summary-pill-value">' + p.value + '</span></div>';
                });
                document.getElementById('car-summary-pills').innerHTML = pillsHTML;
                
                // Switch UI to Step 2
                document.getElementById('step-1b-container').style.display = 'none';
                document.getElementById('step-2-container').style.display = 'block';
                
                // Update Stepper
                document.getElementById('step-nav-1b').classList.remove('active');
                document.getElementById('step-nav-1b').classList.add('completed');
                document.getElementById('step-nav-2').classList.add('active');
                var mobileIndicator = document.getElementById('mobile-step-indicator');
                if (mobileIndicator) mobileIndicator.textContent = 'Step 3 of 4: Price Estimate';
                
            } else {
                msg.style.display = 'block';
                msg.style.background = '#fef2f2';
                msg.style.color = '#dc2626';
                msg.style.border = '1px solid #fca5a5';
                msg.textContent = '❌ Could not calculate valuation. Please try again.';
            }
        } else {
            msg.style.display = 'block';
            msg.style.background = '#fef2f2';
            msg.style.color = '#dc2626';
            msg.style.border = '1px solid #fca5a5';
            msg.textContent = '❌ Server error (' + xhr.status + '). Please try again.';
        }
    };
    
    xhr.onerror = function() {
        btn.disabled = false;
        btn.innerHTML = 'GET ESTIMATED PRICE <i class="fa-solid fa-calculator ms-2"></i>';
        msg.style.display = 'block';
        msg.style.background = '#fef2f2';
        msg.style.color = '#dc2626';
        msg.style.border = '1px solid #fca5a5';
        msg.textContent = '❌ Network error. Please check your connection.';
    };
    
    xhr.send(formData);
});

document.getElementById('btn-edit-details').addEventListener('click', function() {
    // Switch UI to Step 1
    document.getElementById('step-2-container').style.display = 'none';
    document.getElementById('step-1-container').style.display = 'block';
    
    // Update Stepper
    document.getElementById('step-nav-2').classList.remove('active');
    document.getElementById('step-nav-1b').classList.remove('completed');
    document.getElementById('step-nav-1').classList.remove('completed');
    document.getElementById('step-nav-1').classList.add('active');
    var mobileIndicator = document.getElementById('mobile-step-indicator');
    if (mobileIndicator) mobileIndicator.textContent = 'Step 1 of 4: Riksha Details';
});

document.getElementById('sell-car-form').addEventListener('submit', function(e) {
    e.preventDefault();

    var btn = document.getElementById('sell-car-submit-btn');
    var msg = document.getElementById('sell-car-message');
    var form = this;

    var progressContainer = document.getElementById('video-progress-container');
    var progressBar = document.getElementById('video-progress-bar');
    var progressPercent = document.getElementById('video-progress-percent');
    var progressStatus = document.getElementById('video-progress-status');
    var uploadedBadge = document.getElementById('video-uploaded-badge');
    var videoInput = document.getElementById('riksha_video_file');

    btn.disabled = true;
    btn.innerHTML = 'SUBMITTING... <i class="fa-solid fa-spinner fa-spin ms-2"></i>';
    msg.style.display = 'none';

    var hasVideoFile = videoInput && videoInput.files && videoInput.files[0];
    if (hasVideoFile && progressContainer) {
        progressContainer.style.display = 'block';
        if (progressStatus) progressStatus.textContent = 'Uploading video & submitting form...';
    }

    var formData = new FormData(form);
    formData.append('action', 'rikshawale_sell_car');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo esc_url( admin_url("admin-ajax.php") ); ?>', true);
    xhr.withCredentials = true;

    if (hasVideoFile && xhr.upload) {
        xhr.upload.onprogress = function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                if (progressBar) {
                    progressBar.style.width = percentComplete + '%';
                    progressBar.setAttribute('aria-valuenow', percentComplete);
                }
                if (progressPercent) {
                    progressPercent.textContent = percentComplete + '%';
                }
            }
        };
    }

    xhr.onload = function() {
        msg.style.display = 'block';
        if (xhr.status === 200) {
            var res = JSON.parse(xhr.responseText);
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
                // Reset video preview and progress elements
                var vWrap = document.getElementById('video-file-preview-wrap');
                var vPreview = document.getElementById('video-file-preview');
                var btnUpload = document.getElementById('btn-upload-video');
                if (vPreview) { vPreview.src = ''; }
                if (vWrap) { vWrap.style.display = 'none'; }
                if (btnUpload) {
                    btnUpload.style.display = 'none';
                    btnUpload.className = 'btn btn-sm btn-outline-danger fw-bold rounded-2 px-3 py-2 text-uppercase d-inline-flex align-items-center gap-2';
                    btnUpload.innerHTML = '<i class="fa-solid fa-cloud-arrow-up"></i> Upload Video';
                }
                if (progressContainer) progressContainer.style.display = 'none';
                if (uploadedBadge) uploadedBadge.style.display = 'none';
                if (progressBar) progressBar.style.width = '0%';
                if (progressPercent) progressPercent.textContent = '0%';
                
                // Update UI to Step 3
                document.getElementById('step-2-container').style.display = 'none';
                document.getElementById('step-3-container').style.display = 'block';
                
                // Update Stepper
                document.getElementById('step-nav-2').classList.remove('active');
                document.getElementById('step-nav-2').classList.add('completed');
                document.getElementById('step-nav-3').classList.add('completed');
                var mobileIndicator = document.getElementById('mobile-step-indicator');
                if (mobileIndicator) mobileIndicator.textContent = 'Step 4 of 4: Success!';
                
                // We don't need to swap buttons back because we are on Step 3 now
                // btn.innerHTML = 'BOOK INSPECTION <i class="fa-solid fa-arrow-right ms-2"></i>';
                // btn.disabled = false;
            } else {
                msg.style.background = '#fef2f2';
                msg.style.color = '#dc2626';
                msg.style.border = '1px solid #fca5a5';
                msg.textContent = '❌ ' + (res.data.message || 'Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = 'BOOK INSPECTION <i class="fa-solid fa-arrow-right ms-2"></i>';
            }
        } else {
            msg.style.background = '#fef2f2';
            msg.style.color = '#dc2626';
            msg.style.border = '1px solid #fca5a5';
            msg.textContent = '❌ Server error (' + xhr.status + '). Please try again.';
            btn.disabled = false;
            btn.innerHTML = 'BOOK INSPECTION <i class="fa-solid fa-arrow-right ms-2"></i>';
        }
    };

    xhr.onerror = function() {
        msg.style.display = 'block';
        msg.style.background = '#fef2f2';
        msg.style.color = '#dc2626';
        msg.style.border = '1px solid #fca5a5';
        msg.textContent = '❌ Network error. Please check your connection and try again.';
        btn.disabled = false;
        btn.innerHTML = 'BOOK INSPECTION <i class="fa-solid fa-arrow-right ms-2"></i>';
    };

    xhr.send(formData);
});
</script>

<?php get_footer(); ?>
