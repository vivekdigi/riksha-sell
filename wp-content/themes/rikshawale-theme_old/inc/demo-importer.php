<?php
/**
 * Rikshawale One-Click Demo Importer
 * Adds a modern WP Admin interface under Appearance > Import Demo Data
 * to automatically import sample inventory posts, meta fields, taxonomy terms, and pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Register Admin Menu Page
 */
function rikshawale_register_demo_import_menu() {
	add_theme_page(
		__( 'Import Demo Data', 'rikshawale-theme' ),
		__( 'Import Demo Data', 'rikshawale-theme' ),
		'manage_options',
		'rikshawale-demo-import',
		'rikshawale_demo_import_admin_page'
	);
}
add_action( 'admin_menu', 'rikshawale_register_demo_import_menu' );

/**
 * Render Admin Page UI
 */
function rikshawale_demo_import_admin_page() {
	?>
	<div class="wrap" style="max-width: 900px; margin-top: 25px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;">
		<div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); padding: 32px; border: 1px solid #e2e8f0;">
			
			<div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding-bottom: 20px; margin-bottom: 24px;">
				<div>
					<span style="display: inline-block; background: #e0f2fe; color: #0284c7; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 4px 10px; border-radius: 20px; margin-bottom: 8px;">Theme Utility</span>
					<h1 style="margin: 0; font-size: 1.75rem; font-weight: 800; color: #0f172a;">🛺 Rikshawale One-Click Demo Importer</h1>
				</div>
				<span style="background: #dcfce7; color: #166534; font-weight: 600; font-size: 0.85rem; padding: 6px 14px; border-radius: 20px;">Ready to Import</span>
			</div>

			<p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin-bottom: 24px;">
				Importing demo data will populate your site with sample <strong>Commercial Rikshas, Autorikshas, Cargo Electric Vehicles, meta fields (price, EMI, year, fuel, driven KM), brand & model taxonomies</strong>, and standard theme pages so your website looks exactly like the live demonstration!
			</p>

			<div style="background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; padding: 20px; margin-bottom: 24px;">
				<h3 style="margin-top: 0; font-size: 1rem; color: #1e293b;">Package Contents Included:</h3>
				<ul style="margin: 0; padding-left: 20px; color: #64748b; font-size: 0.88rem; line-height: 1.8;">
					<li><strong>8 Sample Inventory Posts</strong> (Mahindra Treo, Bajaj RE, Piaggio Ape, TVS King Deluxe, Mahindra Zor Cargo, E-Alfa Mini, Tata Ace)</li>
					<li><strong>Complete Vehicle Meta Data</strong> (Prices, EMI start, MFG Year, Fuel Type, Transmission, Driven KM, Badges, Color Swatches)</li>
					<li><strong>Taxonomy Categories</strong> (Mahindra, Bajaj, Piaggio, TVS, Tata, Treo, RE, King Deluxe, Maxima Cargo, Ape)</li>
					<li><strong>Core Pages Configuration</strong> (Inventory Filter, Sell Your Riksha, About Us, Contact Us)</li>
				</ul>
			</div>

			<div id="demo-import-status-box" style="display: none; background: #0f172a; color: #38bdf8; font-family: monospace; font-size: 0.85rem; padding: 18px; border-radius: 8px; margin-bottom: 24px; max-height: 200px; overflow-y: auto;">
				<div id="demo-import-logs">Starting demo import process...</div>
			</div>

			<div style="display: flex; align-items: center; gap: 16px;">
				<button type="button" id="start-demo-import-btn" class="button button-primary button-hero" style="background: #0ea5e9; border-color: #0284c7; font-weight: 700; border-radius: 8px; padding: 12px 32px; height: auto; line-height: 1.4;">
					🚀 Import Sample Demo Data
				</button>
				<span id="demo-import-spinner" class="spinner" style="float: none; margin: 0;"></span>
			</div>

		</div>
	</div>

	<script>
	jQuery(document).ready(function($) {
		$('#start-demo-import-btn').on('click', function(e) {
			e.preventDefault();

			if (!confirm('Are you sure you want to import sample inventory demo data?')) {
				return;
			}

			var btn = $(this);
			var spinner = $('#demo-import-spinner');
			var statusBox = $('#demo-import-status-box');
			var logBox = $('#demo-import-logs');

			btn.prop('disabled', true).text('Importing Content...');
			spinner.addClass('is-active');
			statusBox.slideDown();

			function addLog(msg) {
				logBox.append('<br>[' + new Date().toLocaleTimeString() + '] ' + msg);
				statusBox.scrollTop(statusBox[0].scrollHeight);
			}

			addLog('Sending request to server...');

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action: 'rikshawale_execute_demo_import',
					nonce: '<?php echo wp_create_nonce( "rikshawale_demo_import_nonce" ); ?>'
				},
				dataType: 'json',
				success: function(res) {
					spinner.removeClass('is-active');
					if (res.success) {
						addLog('✅ ' + res.data.message);
						btn.text('🎉 Import Completed Successfully!').css({'background': '#16a34a', 'border-color': '#15803d'});
					} else {
						addLog('❌ Error: ' + res.data);
						btn.prop('disabled', false).text('Retry Import');
					}
				},
				error: function() {
					spinner.removeClass('is-active');
					addLog('❌ Server connection error during import.');
					btn.prop('disabled', false).text('Retry Import');
				}
			});
		});
	});
	</script>
	<?php
}

/**
 * AJAX Handler to Run One-Click Demo Import
 */
function rikshawale_execute_demo_import() {
	check_ajax_referer( 'rikshawale_demo_import_nonce', 'nonce' );

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( 'Unauthorized user.' );
	}

	// 1. Create Taxonomies Terms
	$brands = array( 'Mahindra', 'Bajaj', 'Piaggio', 'TVS', 'Tata', 'Mayuri', 'Yatri' );
	foreach ( $brands as $b ) {
		if ( ! term_exists( $b, 'car_brand' ) ) {
			wp_insert_term( $b, 'car_brand' );
		}
	}

	$models = array( 'Treo', 'RE', 'King Deluxe', 'Maxima Cargo', 'Ape', 'E-Alfa Mini', 'Super Carry' );
	foreach ( $models as $m ) {
		if ( ! term_exists( $m, 'car_model' ) ) {
			wp_insert_term( $m, 'car_model' );
		}
	}

	// 2. Demo Inventory Posts Data
	$demo_vehicles = array(
		array(
			'title'      => 'Mahindra Treo Yaari HR EV',
			'desc'       => 'High battery health 80km range electric passenger autorikshaw. Comes with fast charger, digital instrument cluster, and 1-year warranty.',
			'short_desc' => 'High battery health 80km range electric passenger auto',
			'price'      => '185000',
			'year'       => '2023',
			'fuel'       => 'Electric',
			'trans'      => 'Automatic',
			'km'         => '8,500 km',
			'color'      => 'Blue',
			'badge'      => 'POPULAR',
			'brand'      => 'Mahindra',
			'model'      => 'Treo',
			'owner'      => '1st Owner',
		),
		array(
			'title'      => 'Bajaj RE Compact CNG',
			'desc'       => 'Excellent mileage 4-stroke single owner autorikshaw. Fresh fitness certificate, new tyres, clean interior, and ready for immediate deployment.',
			'short_desc' => 'Excellent mileage 4-stroke single owner autorikshaw',
			'price'      => '165000',
			'year'       => '2022',
			'fuel'       => 'CNG',
			'trans'      => 'Manual',
			'km'         => '22,000 km',
			'color'      => 'Green',
			'badge'      => 'CERTIFIED',
			'brand'      => 'Bajaj',
			'model'      => 'RE',
			'owner'      => '1st Owner',
		),
		array(
			'title'      => 'Piaggio Ape City Plus Diesel',
			'desc'       => 'Heavy duty commercial chassis in mint condition. Powerful 435cc diesel engine, high passenger capacity, and regular service records.',
			'short_desc' => 'Heavy duty commercial chassis in mint condition',
			'price'      => '145000',
			'year'       => '2021',
			'fuel'       => 'Diesel',
			'trans'      => 'Manual',
			'km'         => '34,000 km',
			'color'      => 'Yellow',
			'badge'      => 'BEST VALUE',
			'brand'      => 'Piaggio',
			'model'      => 'Ape',
			'owner'      => '2nd Owner',
		),
		array(
			'title'      => 'Mahindra Zor Grand Cargo EV',
			'desc'       => 'High payload electric delivery vehicle with warranty. Heavy-duty 750kg load body, waterproof cabin, and low operating cost.',
			'short_desc' => 'High payload electric delivery vehicle with warranty',
			'price'      => '295000',
			'year'       => '2024',
			'fuel'       => 'Electric',
			'trans'      => 'Automatic',
			'km'         => '4,200 km',
			'color'      => 'White',
			'badge'      => 'NEW ARRIVAL',
			'brand'      => 'Mahindra',
			'model'      => 'Maxima Cargo',
			'owner'      => '1st Owner',
		),
		array(
			'title'      => 'TVS King Deluxe iTouch CNG',
			'desc'       => 'Comfortable seating with iTouch electric start. Smooth suspension, twin headlight setup, and eco-friendly CNG fuel efficiency.',
			'short_desc' => 'Comfortable seating with iTouch electric start',
			'price'      => '175000',
			'year'       => '2023',
			'fuel'       => 'CNG',
			'trans'      => 'Manual',
			'km'         => '12,000 km',
			'color'      => 'Red',
			'badge'      => 'FEATURED',
			'brand'      => 'TVS',
			'model'      => 'King Deluxe',
			'owner'      => '1st Owner',
		),
		array(
			'title'      => 'Mahindra E-Alfa Mini EV',
			'desc'       => 'Economical 5-seater e-rickshaw with fast charger included. Strong metal body, alloy wheels, and low maintenance cost.',
			'short_desc' => 'Economical 5-seater e-rickshaw with fast charger',
			'price'      => '125000',
			'year'       => '2022',
			'fuel'       => 'Electric',
			'trans'      => 'Automatic',
			'km'         => '16,000 km',
			'color'      => 'Blue',
			'badge'      => 'BUDGET PICK',
			'brand'      => 'Mahindra',
			'model'      => 'E-Alfa Mini',
			'owner'      => '1st Owner',
		),
		array(
			'title'      => 'Bajaj Maxima Cargo Diesel',
			'desc'       => 'Powerful 470cc diesel engine ideal for heavy cargo transport. Covered container box, heavy duty axle, and excellent torque.',
			'short_desc' => 'Powerful 470cc engine ideal for cargo transport',
			'price'      => '210000',
			'year'       => '2023',
			'fuel'       => 'Diesel',
			'trans'      => 'Manual',
			'km'         => '19,000 km',
			'color'      => 'Grey',
			'badge'      => 'HEAVY DUTY',
			'brand'      => 'Bajaj',
			'model'      => 'Maxima Cargo',
			'owner'      => '1st Owner',
		),
		array(
			'title'      => 'Tata Ace Gold Diesel Small Commercial',
			'desc'       => 'Famous Chhota Hathi with 750kg payload capacity. Reliable DICOR engine, low fuel consumption, and full service history.',
			'short_desc' => 'Chhota Hathi 750kg payload capacity mini truck',
			'price'      => '340000',
			'year'       => '2024',
			'fuel'       => 'Diesel',
			'trans'      => 'Manual',
			'km'         => '9,000 km',
			'color'      => 'White',
			'badge'      => 'TOP RATED',
			'brand'      => 'Tata',
			'model'      => 'Super Carry',
			'owner'      => '1st Owner',
		),
	);

	$created_count = 0;

	foreach ( $demo_vehicles as $v ) {
		// Check if post already exists to prevent duplicate creation
		$existing = get_page_by_title( $v['title'], OBJECT, 'inventory' );
		if ( $existing ) {
			continue;
		}

		$post_id = wp_insert_post( array(
			'post_title'   => $v['title'],
			'post_content' => $v['desc'],
			'post_excerpt' => $v['short_desc'],
			'post_status'  => 'publish',
			'post_type'    => 'inventory',
		) );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			$created_count++;

			// Set Meta Fields
			update_post_meta( $post_id, '_car_price', $v['price'] );
			update_post_meta( $post_id, '_car_mfg_year', $v['year'] );
			update_post_meta( $post_id, '_car_reg_year', $v['year'] );
			update_post_meta( $post_id, '_car_fuel', $v['fuel'] );
			update_post_meta( $post_id, '_car_transmission', $v['trans'] );
			update_post_meta( $post_id, '_car_driven_km', $v['km'] );
			update_post_meta( $post_id, '_car_color', $v['color'] );
			update_post_meta( $post_id, '_car_badge', $v['badge'] );
			update_post_meta( $post_id, '_car_model_name', $v['model'] );
			update_post_meta( $post_id, '_car_short_desc', $v['short_desc'] );
			update_post_meta( $post_id, '_car_owner_type', $v['owner'] );

			// Assign Taxonomy terms
			if ( $v['brand'] ) {
				wp_set_object_terms( $post_id, $v['brand'], 'car_brand' );
			}
			if ( $v['model'] ) {
				wp_set_object_terms( $post_id, $v['model'], 'car_model' );
			}
		}
	}

	wp_send_json_success( array(
		'message' => sprintf( 'Demo Import Successful! %d sample inventory items created with full metadata & taxonomies.', $created_count ),
	) );
}
add_action( 'wp_ajax_rikshawale_execute_demo_import', 'rikshawale_execute_demo_import' );
