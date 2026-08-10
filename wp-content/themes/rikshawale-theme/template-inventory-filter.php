<?php
/**
 * Template Name: Riksha Inventory Filter Page
 * Description: Interactive Riksha & Vehicle Inventory Filter Page with Left Sidebar Checkboxes, Price Range Sliders, Animated Loader & AJAX Filtering.
 */

get_header();

// Fetch unique meta values from published inventory posts for filter choices
$all_brands        = array( 'Mahindra', 'Bajaj', 'Piaggio', 'TVS', 'Mayuri', 'Yatri', 'Tata', 'Toyota', 'Hyundai' );
$all_models        = array( 'King Deluxe', 'Maxima Cargo', 'RE', 'Treo', 'Alfa', 'Ape', 'E-Alfa Mini', 'Safari', 'Super Carry' );
$all_fuels         = array( 'Electric', 'CNG', 'Diesel', 'Petrol', 'LPG', 'Hybrid' );
$all_transmissions = array( 'Automatic', 'Manual' );
$all_owners        = array( '1st Owner', '2nd Owner', '3rd Owner', '4th+ Owner' );
$all_years         = array( '2024', '2023', '2022', '2021', '2020', '2019', '2018' );
$all_colors        = array( 'White', 'Black', 'Red', 'Blue', 'Grey', 'Green', 'Yellow', 'Silver' );

$selected_colors    = isset( $_GET['color'] ) ? array_map( 'sanitize_text_field', (array) $_GET['color'] ) : array();
$selected_brands    = isset( $_GET['brand'] ) ? array_map( 'sanitize_text_field', (array) $_GET['brand'] ) : array();
$selected_models    = isset( $_GET['model'] ) ? array_map( 'sanitize_text_field', (array) $_GET['model'] ) : array();
$selected_fuels     = isset( $_GET['fuel'] ) ? array_map( 'sanitize_text_field', (array) $_GET['fuel'] ) : array();
$selected_locations = isset( $_GET['location'] ) ? array_map( 'sanitize_text_field', (array) $_GET['location'] ) : array();

if ( is_tax( 'riksha_location' ) ) {
    $queried_loc = get_queried_object();
    if ( $queried_loc && isset( $queried_loc->slug ) && ! in_array( $queried_loc->slug, $selected_locations, true ) ) {
        $selected_locations[] = $queried_loc->slug;
    }
}

$all_locations_terms = get_terms( array(
    'taxonomy'   => 'riksha_location',
    'hide_empty' => false,
) );
?>

<style>
.dual-range-wrapper {
    position: relative;
    width: 100%;
}
.dual-range-input {
    position: absolute;
    width: 100%;
    height: 6px;
    top: 14px;
    background: none;
    pointer-events: none;
    -webkit-appearance: none;
    appearance: none;
    margin: 0;
    z-index: 3;
}
.dual-range-input::-webkit-slider-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #0ea5e9;
    pointer-events: auto;
    -webkit-appearance: none;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.25);
    border: 2px solid #ffffff;
    transition: transform 0.15s ease;
}
.dual-range-input::-webkit-slider-thumb:hover {
    transform: scale(1.2);
    background: #1e3a8a;
}
.dual-range-input::-moz-range-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #0ea5e9;
    pointer-events: auto;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.25);
    border: 2px solid #ffffff;
}
</style>

<div class="inventory-filter-page bg-light min-vh-100 py-4" style="font-family: var(--font-body, 'Inter', sans-serif);">
    <div class="container" style="max-width: 1280px;">
        
        <!-- HERO / HEADER BAR -->
        <div class="card border-0 rounded-4 shadow-sm text-white p-4 p-md-5 mb-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0ea5e9 100%);">
            <div class="position-relative z-1 max-w-700">
                <div class="d-flex align-items-center gap-2 mb-2 extra-small text-white-50 text-uppercase tracking-wider fw-bold">
                    <a href="<?php echo home_url('/'); ?>" class="text-white-50 text-decoration-none">Home</a>
                    <i class="fa-solid fa-chevron-right extra-small"></i>
                    <span class="text-white">Inventory & Filter</span>
                </div>
                <h2 class="fw-black text-white display-6 mb-2">Explore Commercial Rikshas & Vehicles</h2>
                <p class="text-white-50 mb-3 small">Filter certified pre-owned electric rikshas, autorikshas, commercial vehicles, and cars by brand, price, fuel, and specs.</p>
                
                <!-- Quick Search Input -->
                <div class="bg-white rounded-4 p-2 shadow-sm d-flex align-items-center gap-2 max-w-500">
                    <i class="fa-solid fa-magnifying-glass text-muted ms-2"></i>
                    <input type="text" id="inventoryKeywordSearch" class="form-control border-0 shadow-none ps-0" placeholder="Search by model, brand, or specs... (e.g. Treo, CNG, Bajaj)" onkeyup="onSearchKeyup(event)">
                    <button type="button" class="btn btn-primary rounded-3 px-4 fw-bold flex-shrink-0" onclick="triggerFilterAjax(1)" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 100%); border: none;">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-start position-relative">
            
            <!-- LEFT SIDEBAR FILTERS (col-lg-3 col-md-4) -->
            <div class="col-lg-3 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 90px; z-index: 10; max-height: calc(100vh - 110px); overflow-y: auto;">
                    
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                        <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-sliders text-primary me-2"></i> Filter Rikshas</h6>
                        <button type="button" class="btn btn-sm btn-link text-danger text-decoration-none extra-small fw-bold p-0" onclick="resetAllFilters()">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset All
                        </button>
                    </div>

                    <form id="rikshaFilterForm" onsubmit="event.preventDefault(); triggerFilterAjax(1);">
                        
                        <!-- 1. DUAL RANGE PRICE SLIDER & INPUTS -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-2">Price Range (₹)</h6>
                            <div class="d-flex justify-content-between extra-small fw-bold text-muted mb-1">
                                <span>Min: <strong class="text-primary" id="priceMinLabel">₹0</strong></span>
                                <span>Max: <strong class="text-primary" id="priceMaxLabel">₹2,50,00,000</strong></span>
                            </div>
                            
                            <!-- Dual Drag Thumbs Slider Track -->
                            <div class="dual-range-wrapper mb-3 position-relative" style="height: 35px; width: 100%;">
                                <div class="slider-bg-track position-absolute w-100 rounded-pill" style="height: 6px; top: 14px; background: #e2e8f0;"></div>
                                <div class="slider-active-track position-absolute rounded-pill" id="sliderActiveTrack" style="height: 6px; top: 14px; left: 0%; width: 100%; background: linear-gradient(90deg, #0ea5e9 0%, #1e3a8a 100%);"></div>
                                <input type="range" class="dual-range-input" id="priceMinSlider" min="0" max="25000000" step="50000" value="0" oninput="updateDualPriceSlider('min')" onchange="triggerFilterAjax(1)">
                                <input type="range" class="dual-range-input" id="priceMaxSlider" min="0" max="25000000" step="50000" value="25000000" oninput="updateDualPriceSlider('max')" onchange="triggerFilterAjax(1)">
                            </div>

                            <!-- Hidden Min/Max inputs submitted via AJAX -->
                            <input type="hidden" name="price_min" id="priceMinInput" value="0">
                            <input type="hidden" name="price_max" id="priceMaxInput" value="25000000">
                        </div>

                        <!-- 1.5 LOCATION / PLACE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3"><i class="fa-solid fa-location-dot text-danger me-1"></i> Location / Place</h6>
                            <div class="filter-checkbox-list max-h-180 overflow-auto pe-1">
                                <?php 
                                if ( ! empty( $all_locations_terms ) && ! is_wp_error( $all_locations_terms ) ) :
                                    foreach ( $all_locations_terms as $loc_term ) : 
                                ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="location[]" value="<?php echo esc_attr($loc_term->slug); ?>" id="loc_<?php echo esc_attr($loc_term->slug); ?>" <?php checked( in_array( $loc_term->slug, $selected_locations, true ) ); ?> onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark d-flex justify-content-between align-items-center w-100 pe-2" for="loc_<?php echo esc_attr($loc_term->slug); ?>">
                                            <span>📍 <?php echo esc_html($loc_term->name); ?></span>
                                            <span class="badge bg-light text-muted border rounded-pill font-mono extra-small"><?php echo intval($loc_term->count); ?></span>
                                        </label>
                                    </div>
                                <?php 
                                    endforeach;
                                else:
                                ?>
                                    <p class="small text-muted mb-0">No locations added yet.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 2. BRAND / MAKE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Brand / Make</h6>
                            <div class="filter-checkbox-list max-h-180 overflow-auto pe-1">
                                <?php foreach ( $all_brands as $brand ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="brand[]" value="<?php echo esc_attr($brand); ?>" id="brand_<?php echo sanitize_title($brand); ?>" <?php checked( in_array( $brand, $selected_brands, true ) ); ?> onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark" for="brand_<?php echo sanitize_title($brand); ?>">
                                            <?php echo esc_html($brand); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 2.5 VEHICLE MODEL FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Vehicle Model</h6>
                            <div class="filter-checkbox-list max-h-180 overflow-auto pe-1">
                                <?php foreach ( $all_models as $model ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="model[]" value="<?php echo esc_attr($model); ?>" id="model_<?php echo sanitize_title($model); ?>" <?php checked( in_array( $model, $selected_models, true ) ); ?> onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark" for="model_<?php echo sanitize_title($model); ?>">
                                            <?php echo esc_html($model); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 3. FUEL TYPE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Fuel Type</h6>
                            <div class="filter-checkbox-list">
                                <?php foreach ( $all_fuels as $fuel ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="fuel[]" value="<?php echo esc_attr($fuel); ?>" id="fuel_<?php echo sanitize_title($fuel); ?>" <?php checked( in_array( $fuel, $selected_fuels, true ) ); ?> onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark" for="fuel_<?php echo sanitize_title($fuel); ?>">
                                            <?php if ($fuel === 'Electric') echo '⚡ '; elseif ($fuel === 'CNG') echo '🌱 '; ?>
                                            <?php echo esc_html($fuel); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 4. MANUFACTURING YEAR FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Registration / Mfg Year</h6>
                            <div class="filter-checkbox-list max-h-160 overflow-auto pe-1">
                                <?php foreach ( $all_years as $year ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="year[]" value="<?php echo esc_attr($year); ?>" id="year_<?php echo sanitize_title($year); ?>" onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark" for="year_<?php echo sanitize_title($year); ?>">
                                            <?php echo esc_html($year); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 5. TRANSMISSION FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Transmission</h6>
                            <div class="filter-checkbox-list">
                                <?php foreach ( $all_transmissions as $trans ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="transmission[]" value="<?php echo esc_attr($trans); ?>" id="trans_<?php echo sanitize_title($trans); ?>" onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark" for="trans_<?php echo sanitize_title($trans); ?>">
                                            <?php echo esc_html($trans); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 6. OWNER TYPE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Owner Type</h6>
                            <div class="filter-checkbox-list">
                                <?php foreach ( $all_owners as $owner ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="owner[]" value="<?php echo esc_attr($owner); ?>" id="owner_<?php echo sanitize_title($owner); ?>" onchange="triggerFilterAjax(1)">
                                        <label class="form-check-label small text-dark" for="owner_<?php echo sanitize_title($owner); ?>">
                                            <?php echo esc_html($owner); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 7. COLOR ATTRIBUTE FILTER -->
                        <div class="filter-group mb-2">
                            <h6 class="fw-bold text-dark small mb-3">Exterior Color Swatches</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <?php 
                                $color_hex_map = array(
                                    'White'  => '#ffffff',
                                    'Black'  => '#18181b',
                                    'Red'    => '#ef4444',
                                    'Blue'   => '#3b82f6',
                                    'Grey'   => '#6b7280',
                                    'Green'  => '#22c55e',
                                    'Yellow' => '#eab308',
                                    'Silver' => '#cbd5e1',
                                );
                                foreach ( $all_colors as $color ) : 
                                    $hex = $color_hex_map[$color] ?? '#94a3b8';
                                    $border_cls = ($color === 'White') ? 'border border-secondary' : '';
                                ?>
                                    <div class="form-check p-0 mb-0">
                                        <input type="checkbox" class="btn-check" name="color[]" value="<?php echo esc_attr($color); ?>" id="col_<?php echo sanitize_title($color); ?>" <?php checked( in_array( $color, $selected_colors, true ) ); ?> onchange="triggerFilterAjax(1)" autocomplete="off">
                                        <label class="btn btn-outline-secondary btn-sm rounded-pill extra-small px-3 py-1 d-inline-flex align-items-center gap-2" for="col_<?php echo sanitize_title($color); ?>" style="cursor: pointer;">
                                            <span class="d-inline-block rounded-circle <?php echo $border_cls; ?>" style="width: 13px; height: 13px; background-color: <?php echo $hex; ?>;"></span>
                                            <?php echo esc_html($color); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- RIGHT MAIN INVENTORY LIST (col-lg-9 col-md-8) -->
            <div class="col-lg-9 col-md-8 position-relative">
                
                <!-- FILTER SEARCH ANIMATED LOADING SPINNER OVERLAY -->
                <div id="filterLoadingOverlay" class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-none flex-column align-items-center justify-content-center rounded-4" style="z-index: 20; backdrop-filter: blur(3px); min-height: 400px;">
                    <div class="p-4 bg-white rounded-4 shadow-lg text-center border">
                        <div class="spinner-border text-primary mb-3" role="status" style="width: 3.2rem; height: 3.2rem; border-width: 0.25em;"></div>
                        <h6 class="fw-bold text-dark mb-1">Filtering Vehicles...</h6>
                        <span class="text-muted extra-small">Searching matching rikshas</span>
                    </div>
                </div>

                <!-- TOP BAR CONTROLS -->
                <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <span class="fw-bold text-dark" id="filterResultCount">Showing all vehicles...</span>
                            <div id="activeFilterTags" class="d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <label class="small text-muted fw-bold text-nowrap mb-0">Sort By:</label>
                            <select id="filterSortBy" class="form-select form-select-sm rounded-3 shadow-none border" onchange="triggerFilterAjax(1)" style="min-width: 170px;">
                                <option value="date_desc">Newest Arrivals</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                                <option value="year_desc">Year: Newest First</option>
                                <option value="mileage_asc">Driven KM: Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- DYNAMIC AJAX INVENTORY GRID CONTAINER -->
                <div id="inventoryFilterResults" class="row g-4">
                    <!-- Default initial PHP query render (12 posts per page) -->
                    <?php
                    $initial_query = new WP_Query( array(
                        'post_type'      => 'inventory',
                        'posts_per_page' => 12,
                        'paged'          => 1,
                        'post_status'    => 'publish',
                    ) );

                    if ( $initial_query->have_posts() ) :
                        while ( $initial_query->have_posts() ) : $initial_query->the_post();
                            $p_id    = get_the_ID();
                            $p_price = rikshawale_get_formatted_price( $p_id );
                            $p_year  = get_post_meta( $p_id, '_car_mfg_year', true ) ?: ( get_post_meta( $p_id, '_car_year', true ) ?: '2022' );
                            $p_fuel  = get_post_meta( $p_id, '_car_fuel', true ) ?: 'Electric';
                            $p_trans = get_post_meta( $p_id, '_car_transmission', true ) ?: 'Automatic';
                            $p_km    = get_post_meta( $p_id, '_car_driven_km', true ) ?: '15,000 km';
                            $p_badge = get_post_meta( $p_id, '_car_badge', true ) ?: 'LIMITED OFFER';
                            $thumb   = get_the_post_thumbnail_url( $p_id, 'medium' ) ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80';
                            $title   = get_the_title();

                            $raw_p = preg_replace('/[^0-9]/', '', get_post_meta( $p_id, '_car_price', true ) );
                            $num_p = ( $raw_p && floatval($raw_p) > 0 ) ? floatval($raw_p) : 500000;
                            $loan_amt = $num_p * 0.80;
                            $rate_m   = (11.75 / 12) / 100;
                            $pow_m    = pow(1 + $rate_m, 60);
                            $est_emi  = round( $loan_amt * $rate_m * $pow_m / ($pow_m - 1) );
                    ?>
                    <div class="col-lg-4 col-md-6 inventory-card-item">
                        <div class="car-card-exact card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative">
                            <?php if ( $p_badge ) : ?>
                                <span class="car-card-badge position-absolute top-0 start-0 m-3 badge bg-danger z-2 shadow-sm rounded-pill px-3 py-2 extra-small uppercase"><?php echo esc_html($p_badge); ?></span>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="car-card-img-link d-block position-relative bg-light text-center" style="height: 200px; overflow: hidden;">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 h-100 object-fit-cover transition-all">
                            </a>
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold text-dark text-truncate mb-2" title="<?php echo esc_attr($title); ?>">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php echo esc_html($title); ?></a>
                                    </h6>
                                    <div class="d-flex flex-wrap gap-1 mb-3">
                                        <span class="badge bg-light text-secondary border extra-small"><?php echo esc_html($p_year); ?></span>
                                        <span class="badge bg-light text-secondary border extra-small"><?php echo esc_html($p_fuel); ?></span>
                                        <span class="badge bg-light text-secondary border extra-small"><?php echo esc_html($p_trans); ?></span>
                                        <span class="badge bg-light text-secondary border extra-small"><?php echo esc_html($p_km); ?></span>
                                    </div>
                                </div>
                                <div class="pt-3 border-top mt-2">
                                    <div class="d-flex align-items-baseline justify-content-between mb-2">
                                        <div>
                                            <span class="text-muted extra-small d-block">Selling Price</span>
                                            <span class="fs-5 fw-black text-dark"><?php echo esc_html($p_price); ?></span>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-muted extra-small d-block">Starting EMI</span>
                                            <span class="fw-bold text-danger small">₹<?php echo number_format($est_emi); ?>/m</span>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-flex mt-3">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark btn-sm rounded-3 flex-grow-1 fw-bold">View Details</a>
                                        <button type="button" class="btn btn-danger btn-sm rounded-3 fw-bold px-3" onclick="triggerVehicleBooking(<?php echo $p_id; ?>, '<?php echo esc_js($title); ?>', '<?php echo esc_js($p_price); ?>', '<?php echo esc_url($thumb); ?>')" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 100%); border:none;">
                                            Book
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                    <div class="col-12 text-center py-5">
                        <div class="p-5 bg-white rounded-4 shadow-sm">
                            <i class="fa-solid fa-car-side fs-1 text-muted mb-3 d-block"></i>
                            <h5 class="fw-bold text-dark">No Vehicles Found</h5>
                            <p class="text-muted small">Try adjusting your filters or search keywords.</p>
                            <button type="button" class="btn btn-primary rounded-pill px-4" onclick="resetAllFilters()">Reset All Filters</button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- AJAX LOAD MORE VEHICLES BUTTON (AFTER 12 POSTS) -->
                <div class="text-center mt-4 pt-3" id="loadMoreContainer" style="<?php echo ($initial_query->max_num_pages > 1) ? '' : 'display:none;'; ?>">
                    <button type="button" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold shadow-sm" id="btnLoadMore" onclick="loadNextPageVehicles()">
                        <span id="loadMoreText"><i class="fa-solid fa-rotate me-2"></i> Load More Vehicles</span>
                        <span id="loadMoreSpinner" class="d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Loading vehicles...
                        </span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
var currentPage = 1;
var maxPages = <?php echo intval($initial_query->max_num_pages ?: 1); ?>;
var searchTimer = null;

function updateDualPriceSlider(caller) {
    var minSlider = document.getElementById('priceMinSlider');
    var maxSlider = document.getElementById('priceMaxSlider');
    var minInput  = document.getElementById('priceMinInput');
    var maxInput  = document.getElementById('priceMaxInput');
    var activeTrk = document.getElementById('sliderActiveTrack');
    var maxValTotal = 25000000;
    var minGap = 50000;

    var minVal = parseInt(minSlider.value) || 0;
    var maxVal = parseInt(maxSlider.value) || maxValTotal;

    if (maxVal - minVal < minGap) {
        if (caller === 'min') {
            minSlider.value = maxVal - minGap;
            minVal = parseInt(minSlider.value);
        } else {
            maxSlider.value = minVal + minGap;
            maxVal = parseInt(maxSlider.value);
        }
    }

    if (minInput) minInput.value = minVal;
    if (maxInput) maxInput.value = maxVal;

    var lblMin = document.getElementById('priceMinLabel');
    var lblMax = document.getElementById('priceMaxLabel');
    if (lblMin) lblMin.innerText = '₹' + minVal.toLocaleString('en-IN');
    if (lblMax) lblMax.innerText = '₹' + maxVal.toLocaleString('en-IN');

    if (activeTrk) {
        var pctMin = (minVal / maxValTotal) * 100;
        var pctMax = (maxVal / maxValTotal) * 100;
        activeTrk.style.left = pctMin + '%';
        activeTrk.style.width = (pctMax - pctMin) + '%';
    }
}

function onManualPriceInputChange() {
    var minInput  = document.getElementById('priceMinInput');
    var maxInput  = document.getElementById('priceMaxInput');
    var minSlider = document.getElementById('priceMinSlider');
    var maxSlider = document.getElementById('priceMaxSlider');

    var minVal = parseInt(minInput.value) || 0;
    var maxVal = parseInt(maxInput.value) || 25000000;

    if (minSlider) minSlider.value = minVal;
    if (maxSlider) maxSlider.value = maxVal;

    updateDualPriceSlider();
    triggerFilterAjax(1);
}

function onPriceCheckboxChange(el) {
    if (el.checked) {
        var val = el.value;
        var parts = val.split('-');
        if (parts.length === 2) {
            var minSlider = document.getElementById('priceMinSlider');
            var maxSlider = document.getElementById('priceMaxSlider');
            if (minSlider) minSlider.value = parts[0];
            if (maxSlider) maxSlider.value = parts[1];
            updateDualPriceSlider();
        }
    }
    triggerFilterAjax(1);
}

function onSearchKeyup(e) {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(function() {
        triggerFilterAjax(1);
    }, 400);
}

function triggerFilterAjax(page) {
    if (!page) page = 1;
    currentPage = page;

    var form = jQuery('#rikshaFilterForm');
    var keyword = jQuery('#inventoryKeywordSearch').val();
    var sortBy = jQuery('#filterSortBy').val();

    var formData = form.serializeArray();
    formData.push({ name: 'action', value: 'rikshawale_filter_inventory' });
    formData.push({ name: 'keyword', value: keyword });
    formData.push({ name: 'sort_by', value: sortBy });
    formData.push({ name: 'paged', value: currentPage });
    formData.push({ name: 'nonce', value: '<?php echo wp_create_nonce("rikshawale_filter_nonce"); ?>' });

    // Show Filter Loading Spinner Overlay
    jQuery('#filterLoadingOverlay').removeClass('d-none').addClass('d-flex');

    jQuery.ajax({
        url: '<?php echo admin_url("admin-ajax.php"); ?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(res) {
            jQuery('#filterLoadingOverlay').removeClass('d-flex').addClass('d-none');
            if (res.success) {
                if (currentPage === 1) {
                    jQuery('#inventoryFilterResults').html(res.data.html);
                } else {
                    jQuery('#inventoryFilterResults').append(res.data.html);
                }
                jQuery('#filterResultCount').text('Showing ' + res.data.count + ' vehicle' + (res.data.count === 1 ? '' : 's'));
                jQuery('#activeFilterTags').html(res.data.tags);
                
                maxPages = res.data.max_pages || 1;
                if (currentPage < maxPages) {
                    jQuery('#loadMoreContainer').show();
                } else {
                    jQuery('#loadMoreContainer').hide();
                }
            }
        },
        error: function() {
            jQuery('#filterLoadingOverlay').removeClass('d-flex').addClass('d-none');
        }
    });
}

function loadNextPageVehicles() {
    if (currentPage < maxPages) {
        jQuery('#loadMoreText').addClass('d-none');
        jQuery('#loadMoreSpinner').removeClass('d-none');
        
        var nextPage = currentPage + 1;
        var form = jQuery('#rikshaFilterForm');
        var keyword = jQuery('#inventoryKeywordSearch').val();
        var sortBy = jQuery('#filterSortBy').val();

        var formData = form.serializeArray();
        formData.push({ name: 'action', value: 'rikshawale_filter_inventory' });
        formData.push({ name: 'keyword', value: keyword });
        formData.push({ name: 'sort_by', value: sortBy });
        formData.push({ name: 'paged', value: nextPage });
        formData.push({ name: 'nonce', value: '<?php echo wp_create_nonce("rikshawale_filter_nonce"); ?>' });

        jQuery.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                jQuery('#loadMoreText').removeClass('d-none');
                jQuery('#loadMoreSpinner').addClass('d-none');
                if (res.success) {
                    currentPage = nextPage;
                    jQuery('#inventoryFilterResults').append(res.data.html);
                    maxPages = res.data.max_pages || 1;
                    if (currentPage >= maxPages) {
                        jQuery('#loadMoreContainer').hide();
                    }
                }
            },
            error: function() {
                jQuery('#loadMoreText').removeClass('d-none');
                jQuery('#loadMoreSpinner').addClass('d-none');
            }
        });
    }
}

function resetAllFilters() {
    jQuery('#rikshaFilterForm')[0].reset();
    jQuery('#inventoryKeywordSearch').val('');
    jQuery('#filterSortBy').val('date_desc');
    var minSlider = document.getElementById('priceMinSlider');
    var maxSlider = document.getElementById('priceMaxSlider');
    if (minSlider) minSlider.value = 0;
    if (maxSlider) maxSlider.value = 25000000;
    updateDualPriceSlider();
    jQuery('.btn-check').prop('checked', false);
    triggerFilterAjax(1);
}

jQuery(document).ready(function($) {
    if ($('.filter-checkbox:checked, .color-swatch-checkbox:checked').length > 0 || $('#inventoryKeywordSearch').val() !== '') {
        triggerFilterAjax(1);
    }
});
</script>

<?php get_footer(); ?>
