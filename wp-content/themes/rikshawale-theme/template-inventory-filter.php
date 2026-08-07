<?php
/**
 * Template Name: Riksha Inventory Filter Page
 * Description: Interactive Riksha & Vehicle Inventory Filter Page with Left Sidebar Checkboxes & AJAX Filtering.
 */

get_header();

// Fetch unique meta values from published inventory posts for filter choices
$all_brands       = array( 'Mahindra', 'Bajaj', 'Piaggio', 'TVS', 'Mayuri', 'Yatri', 'Tata', 'Toyota', 'Hyundai' );
$all_fuels        = array( 'Electric', 'CNG', 'Diesel', 'Petrol', 'LPG', 'Hybrid' );
$all_transmissions = array( 'Automatic', 'Manual' );
$all_owners       = array( '1st Owner', '2nd Owner', '3rd Owner', '4th+ Owner' );
$all_years        = array( '2024', '2023', '2022', '2021', '2020', '2019', '2018' );
$all_colors       = array( 'White', 'Black', 'Red', 'Blue', 'Grey', 'Green', 'Yellow', 'Silver' );
?>

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
                    <input type="text" id="inventoryKeywordSearch" class="form-control border-0 shadow-none ps-0" placeholder="Search by model, brand, or specs... (e.g. Treo, CNG, Bajaj)">
                    <button type="button" class="btn btn-primary rounded-3 px-4 fw-bold flex-shrink-0" onclick="triggerFilterAjax()" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 100%); border: none;">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            
            <!-- LEFT SIDEBAR FILTERS (col-lg-3 col-md-4) -->
            <div class="col-lg-3 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 90px; z-index: 10; max-height: calc(100vh - 110px); overflow-y: auto;">
                    
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                        <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-sliders text-primary me-2"></i> Filter Rikshas</h6>
                        <button type="button" class="btn btn-sm btn-link text-danger text-decoration-none extra-small fw-bold p-0" onclick="resetAllFilters()">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset All
                        </button>
                    </div>

                    <form id="rikshaFilterForm" onsubmit="event.preventDefault(); triggerFilterAjax();">
                        
                        <!-- 1. BRAND / MAKE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Brand / Make</h6>
                            <div class="filter-checkbox-list max-h-180 overflow-auto pe-1">
                                <?php foreach ( $all_brands as $brand ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="brand[]" value="<?php echo esc_attr($brand); ?>" id="brand_<?php echo sanitize_title($brand); ?>" onchange="triggerFilterAjax()">
                                        <label class="form-check-label small text-dark" for="brand_<?php echo sanitize_title($brand); ?>">
                                            <?php echo esc_html($brand); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 2. PRICE RANGE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Price Range (₹)</h6>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <input type="number" class="form-control form-control-sm rounded-2" name="price_min" id="priceMinInput" placeholder="Min ₹" onchange="triggerFilterAjax()">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control form-control-sm rounded-2" name="price_max" id="priceMaxInput" placeholder="Max ₹" onchange="triggerFilterAjax()">
                                </div>
                            </div>
                            <div class="filter-checkbox-list">
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="checkbox" name="price_range[]" value="0-100000" id="pr_1" onchange="triggerFilterAjax()">
                                    <label class="form-check-label small text-dark" for="pr_1">Under ₹1 Lakh</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="checkbox" name="price_range[]" value="100000-300000" id="pr_2" onchange="triggerFilterAjax()">
                                    <label class="form-check-label small text-dark" for="pr_2">₹1 Lakh - ₹3 Lakhs</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="checkbox" name="price_range[]" value="300000-500000" id="pr_3" onchange="triggerFilterAjax()">
                                    <label class="form-check-label small text-dark" for="pr_3">₹3 Lakhs - ₹5 Lakhs</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="checkbox" name="price_range[]" value="500000-1000000" id="pr_4" onchange="triggerFilterAjax()">
                                    <label class="form-check-label small text-dark" for="pr_4">₹5 Lakhs - ₹10 Lakhs</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="checkbox" name="price_range[]" value="1000000-99999999" id="pr_5" onchange="triggerFilterAjax()">
                                    <label class="form-check-label small text-dark" for="pr_5">Above ₹10 Lakhs</label>
                                </div>
                            </div>
                        </div>

                        <!-- 3. FUEL TYPE FILTER -->
                        <div class="filter-group mb-4 pb-3 border-bottom">
                            <h6 class="fw-bold text-dark small mb-3">Fuel Type</h6>
                            <div class="filter-checkbox-list">
                                <?php foreach ( $all_fuels as $fuel ) : ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="fuel[]" value="<?php echo esc_attr($fuel); ?>" id="fuel_<?php echo sanitize_title($fuel); ?>" onchange="triggerFilterAjax()">
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
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="year[]" value="<?php echo esc_attr($year); ?>" id="year_<?php echo sanitize_title($year); ?>" onchange="triggerFilterAjax()">
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
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="transmission[]" value="<?php echo esc_attr($trans); ?>" id="trans_<?php echo sanitize_title($trans); ?>" onchange="triggerFilterAjax()">
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
                                        <input class="form-check-input filter-checkbox" type="checkbox" name="owner[]" value="<?php echo esc_attr($owner); ?>" id="owner_<?php echo sanitize_title($owner); ?>" onchange="triggerFilterAjax()">
                                        <label class="form-check-label small text-dark" for="owner_<?php echo sanitize_title($owner); ?>">
                                            <?php echo esc_html($owner); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 7. COLOR FILTER -->
                        <div class="filter-group mb-2">
                            <h6 class="fw-bold text-dark small mb-3">Color</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ( $all_colors as $color ) : ?>
                                    <div class="form-check p-0 mb-0">
                                        <input type="checkbox" class="btn-check" name="color[]" value="<?php echo esc_attr($color); ?>" id="col_<?php echo sanitize_title($color); ?>" onchange="triggerFilterAjax()" autocomplete="off">
                                        <label class="btn btn-outline-secondary btn-sm rounded-pill extra-small px-3 py-1" for="col_<?php echo sanitize_title($color); ?>">
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
            <div class="col-lg-9 col-md-8">
                
                <!-- TOP BAR CONTROLS -->
                <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <span class="fw-bold text-dark" id="filterResultCount">Showing all vehicles...</span>
                            <div id="activeFilterTags" class="d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <label class="small text-muted fw-bold text-nowrap mb-0">Sort By:</label>
                            <select id="filterSortBy" class="form-select form-select-sm rounded-3 shadow-none border" onchange="triggerFilterAjax()" style="min-width: 170px;">
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
                    <!-- Default initial PHP query render -->
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $initial_query = new WP_Query( array(
                        'post_type'      => 'inventory',
                        'posts_per_page' => 12,
                        'paged'          => $paged,
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

                            // Estimate starting EMI
                            $raw_p = preg_replace('/[^0-9]/', '', get_post_meta( $p_id, '_car_price', true ) );
                            $num_p = ( $raw_p && floatval($raw_p) > 0 ) ? floatval($raw_p) : 500000;
                            $loan_amt = $num_p * 0.80;
                            $rate_m   = (11.75 / 12) / 100;
                            $pow_m    = pow(1 + $rate_m, 60);
                            $est_emi  = round( $loan_amt * $rate_m * $pow_m / ($pow_m - 1) );
                    ?>
                    <div class="col-lg-4 col-md-6">
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

            </div>
        </div>

    </div>
</div>

<script>
function triggerFilterAjax() {
    var form = jQuery('#rikshaFilterForm');
    var keyword = jQuery('#inventoryKeywordSearch').val();
    var sortBy = jQuery('#filterSortBy').val();

    var formData = form.serializeArray();
    formData.push({ name: 'action', value: 'rikshawale_filter_inventory' });
    formData.push({ name: 'keyword', value: keyword });
    formData.push({ name: 'sort_by', value: sortBy });
    formData.push({ name: 'nonce', value: '<?php echo wp_create_nonce("rikshawale_filter_nonce"); ?>' });

    jQuery('#inventoryFilterResults').css('opacity', '0.5');

    jQuery.ajax({
        url: '<?php echo admin_url("admin-ajax.php"); ?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(res) {
            jQuery('#inventoryFilterResults').css('opacity', '1');
            if (res.success) {
                jQuery('#inventoryFilterResults').html(res.data.html);
                jQuery('#filterResultCount').text('Showing ' + res.data.count + ' vehicle' + (res.data.count === 1 ? '' : 's'));
                jQuery('#activeFilterTags').html(res.data.tags);
            }
        },
        error: function() {
            jQuery('#inventoryFilterResults').css('opacity', '1');
        }
    });
}

function resetAllFilters() {
    jQuery('#rikshaFilterForm')[0].reset();
    jQuery('#inventoryKeywordSearch').val('');
    jQuery('#filterSortBy').val('date_desc');
    jQuery('.btn-check').prop('checked', false);
    triggerFilterAjax();
}
</script>

<?php get_footer(); ?>
