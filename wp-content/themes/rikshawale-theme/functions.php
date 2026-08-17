<?php
/**
 * Rikshawale Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Require One-Click Demo Importer
require_once get_template_directory() . '/inc/demo-importer.php';

function rikshawale_theme_setup() {
	// Add support for Featured Images (Post Thumbnails)
	add_theme_support( 'post-thumbnails' );
	
	// Add support for Title Tag dynamically
	add_theme_support( 'title-tag' );

	// Add support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 250,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Register Navigation Menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Header Menu', 'rikshawale-theme' ),
		'footer'  => esc_html__( 'Footer Menu', 'rikshawale-theme' ),
	) );
}
add_action( 'after_setup_theme', 'rikshawale_theme_setup' );

/**
 * Enqueue scripts and styles (Bootstrap 5 & Custom Styles)
 */
function rikshawale_theme_scripts() {
	// Load Bootstrap 5 CSS
	wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2' );
	
	// Load main style.css
	wp_enqueue_style( 'rikshawale-theme-style', get_stylesheet_uri(), array( 'bootstrap-css' ), '1.0.0' );

	// Load Google Fonts (Montserrat & Roboto)
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap', array(), null );

	// Load FontAwesome 6 Icons
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

	// Load Bootstrap 5 JS Bundle (with Popper)
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true );
}
add_action( 'wp_enqueue_scripts', 'rikshawale_theme_scripts' );

/**
 * Register Custom Post Type: Riksha
 */
function rikshawale_register_riksha_cpt() {
	$labels = array(
		'name'               => _x( 'Rikshas', 'post type general name', 'rikshawale-theme' ),
		'singular_name'      => _x( 'Riksha', 'post type singular name', 'rikshawale-theme' ),
		'menu_name'          => _x( 'Rikshas', 'admin menu', 'rikshawale-theme' ),
		'name_admin_bar'     => _x( 'Riksha', 'add new on admin bar', 'rikshawale-theme' ),
		'add_new'            => _x( 'Add New', 'riksha', 'rikshawale-theme' ),
		'add_new_item'       => __( 'Add New Riksha', 'rikshawale-theme' ),
		'new_item'           => __( 'New Riksha', 'rikshawale-theme' ),
		'edit_item'          => __( 'Edit Riksha', 'rikshawale-theme' ),
		'view_item'          => __( 'View Riksha', 'rikshawale-theme' ),
		'all_items'          => __( 'All Rikshas', 'rikshawale-theme' ),
		'search_items'       => __( 'Search Rikshas', 'rikshawale-theme' ),
		'parent_item_colon'  => __( 'Parent Rikshas:', 'rikshawale-theme' ),
		'not_found'          => __( 'No Rikshas found.', 'rikshawale-theme' ),
		'not_found_in_trash' => __( 'No Rikshas found in Trash.', 'rikshawale-theme' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'riksha' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'        => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-car',
		'supports'           => array( 'title', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => false, // Disables Gutenberg block editor
	);

	register_post_type( 'riksha', $args );
}
add_action( 'init', 'rikshawale_register_riksha_cpt' );

/**
 * Register Custom Post Type: Testimonial
 */
function rikshawale_register_testimonial_cpt() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'rikshawale-theme' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'rikshawale-theme' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'rikshawale-theme' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'rikshawale-theme' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'rikshawale-theme' ),
		'add_new_item'       => __( 'Add New Testimonial', 'rikshawale-theme' ),
		'new_item'           => __( 'New Testimonial', 'rikshawale-theme' ),
		'edit_item'          => __( 'Edit Testimonial', 'rikshawale-theme' ),
		'view_item'          => __( 'View Testimonial', 'rikshawale-theme' ),
		'all_items'          => __( 'All Testimonials', 'rikshawale-theme' ),
		'search_items'       => __( 'Search Testimonials', 'rikshawale-theme' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'rikshawale-theme' ),
		'not_found'          => __( 'No Testimonials found.', 'rikshawale-theme' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'rikshawale-theme' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'        => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-testimonial',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'rikshawale_register_testimonial_cpt' );

/**
 * Admin Metabox for Testimonials (Star Rating & Designation)
 */
function rikshawale_add_testimonial_metabox() {
	add_meta_box(
		'testimonial_details_mb',
		__( 'Testimonial Details & Star Rating', 'rikshawale-theme' ),
		'rikshawale_render_testimonial_metabox',
		'testimonial',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'rikshawale_add_testimonial_metabox' );

function rikshawale_render_testimonial_metabox( $post ) {
	wp_nonce_field( 'rikshawale_save_testimonial_meta', 'testimonial_meta_nonce' );
	$rating  = get_post_meta( $post->ID, '_testimonial_rating', true ) ?: '5';
	$author_designation = get_post_meta( $post->ID, '_testimonial_designation', true );
	?>
	<div style="font-size: 14px; line-height: 1.6; padding: 10px;">
		<p>
			<label for="testimonial_rating"><strong><?php _e( 'Star Rating (1 to 5):', 'rikshawale-theme' ); ?></strong></label><br>
			<select name="testimonial_rating" id="testimonial_rating" style="width: 100%; max-width: 300px; padding: 6px; margin-top: 4px;">
				<option value="5" <?php selected( $rating, '5' ); ?>>⭐⭐⭐⭐⭐ (5 Stars)</option>
				<option value="4.5" <?php selected( $rating, '4.5' ); ?>>⭐⭐⭐⭐½ (4.5 Stars)</option>
				<option value="4" <?php selected( $rating, '4' ); ?>>⭐⭐⭐⭐ (4 Stars)</option>
				<option value="3.5" <?php selected( $rating, '3.5' ); ?>>⭐⭐⭐½ (3.5 Stars)</option>
				<option value="3" <?php selected( $rating, '3' ); ?>>⭐⭐⭐ (3 Stars)</option>
				<option value="2" <?php selected( $rating, '2' ); ?>>⭐⭐ (2 Stars)</option>
				<option value="1" <?php selected( $rating, '1' ); ?>>⭐ (1 Star)</option>
			</select>
		</p>
		<p>
			<label for="testimonial_designation"><strong><?php _e( 'Author Designation / Role / Location (e.g. Commercial Fleet Owner, Delhi):', 'rikshawale-theme' ); ?></strong></label><br>
			<input type="text" name="testimonial_designation" id="testimonial_designation" value="<?php echo esc_attr( $author_designation ); ?>" style="width: 100%; max-width: 400px; padding: 6px; margin-top: 4px;" placeholder="e.g. Commercial Driver, Delhi">
		</p>
	</div>
	<?php
}

function rikshawale_save_testimonial_meta( $post_id ) {
	if ( ! isset( $_POST['testimonial_meta_nonce'] ) || ! wp_verify_nonce( $_POST['testimonial_meta_nonce'], 'rikshawale_save_testimonial_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['testimonial_rating'] ) ) {
		update_post_meta( $post_id, '_testimonial_rating', sanitize_text_field( $_POST['testimonial_rating'] ) );
	}
	if ( isset( $_POST['testimonial_designation'] ) ) {
		update_post_meta( $post_id, '_testimonial_designation', sanitize_text_field( $_POST['testimonial_designation'] ) );
	}
}
add_action( 'save_post_testimonial', 'rikshawale_save_testimonial_meta' );

/**
 * Register Custom Post Type: FAQ
 */
function rikshawale_register_faq_cpt() {
	$labels = array(
		'name'               => _x( 'FAQs', 'post type general name', 'rikshawale-theme' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name', 'rikshawale-theme' ),
		'menu_name'          => _x( 'FAQs', 'admin menu', 'rikshawale-theme' ),
		'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'rikshawale-theme' ),
		'add_new'            => _x( 'Add New', 'faq', 'rikshawale-theme' ),
		'add_new_item'       => __( 'Add New FAQ', 'rikshawale-theme' ),
		'new_item'           => __( 'New FAQ', 'rikshawale-theme' ),
		'edit_item'          => __( 'Edit FAQ', 'rikshawale-theme' ),
		'view_item'          => __( 'View FAQ', 'rikshawale-theme' ),
		'all_items'          => __( 'All FAQs', 'rikshawale-theme' ),
		'search_items'       => __( 'Search FAQs', 'rikshawale-theme' ),
		'not_found'          => __( 'No FAQs found.', 'rikshawale-theme' ),
		'not_found_in_trash' => __( 'No FAQs found in Trash.', 'rikshawale-theme' ),
	);
	$args = array(
		'labels'          => $labels,
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_position'   => 7,
		'menu_icon'       => 'dashicons-editor-help',
		'capability_type' => 'post',
		'has_archive'     => false,
		'hierarchical'    => false,
		'supports'        => array( 'title', 'editor' ),
		'show_in_rest'    => true,
	);
	register_post_type( 'riksha_faq', $args );
}
add_action( 'init', 'rikshawale_register_faq_cpt' );

/**
 * Register Custom Post Type: Contact Enquiry
 */
function rikshawale_register_contact_enquiry_cpt() {
	register_post_type( 'contact_enquiry', array(
		'labels' => array(
			'name'               => __( 'Contact Enquiries', 'rikshawale-theme' ),
			'singular_name'      => __( 'Contact Enquiry', 'rikshawale-theme' ),
			'menu_name'          => __( 'Contact Messages', 'rikshawale-theme' ),
			'all_items'          => __( 'All Messages', 'rikshawale-theme' ),
			'edit_item'          => __( 'View Message', 'rikshawale-theme' ),
			'not_found'          => __( 'No enquiries found.', 'rikshawale-theme' ),
		),
		'public'            => false,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'menu_icon'         => 'dashicons-email-alt',
		'menu_position'     => 10,
		'capability_type'   => 'post',
		'has_archive'       => false,
		'hierarchical'      => false,
		'supports'          => array( 'title' ),
		'show_in_rest'      => false,
	) );
}
add_action( 'init', 'rikshawale_register_contact_enquiry_cpt' );

/**
 * Admin Metabox for Contact Enquiry
 */
function rikshawale_add_contact_enquiry_metabox() {
	add_meta_box(
		'contact_enquiry_details',
		__( 'Message Details', 'rikshawale-theme' ),
		'rikshawale_render_contact_enquiry_metabox',
		'contact_enquiry',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'rikshawale_add_contact_enquiry_metabox' );

function rikshawale_render_contact_enquiry_metabox( $post ) {
	$name    = get_post_meta( $post->ID, '_contact_name', true );
	$email   = get_post_meta( $post->ID, '_contact_email', true );
	$phone   = get_post_meta( $post->ID, '_contact_phone', true );
	$message = get_post_meta( $post->ID, '_contact_message', true );
	?>
	<div style="font-size: 14px; line-height: 1.6; padding: 10px;">
		<p><strong>Name:</strong> <?php echo esc_html( $name ); ?></p>
		<p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
		<p><strong>Phone:</strong> <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
		<hr>
		<p><strong>Message:</strong></p>
		<div style="background: #f9f9f9; padding: 14px; border: 1px solid #e5e5e5; border-radius: 6px; white-space: pre-wrap; font-family: sans-serif; font-size: 14px;">
			<?php echo esc_html( $message ); ?>
		</div>
	</div>
	<?php
}

/**
 * AJAX Contact Form Handler (Saves to CPT contact_enquiry + Emails Admin)
 */
function rikshawale_handle_contact_form() {
	if ( isset( $_POST['nonce'] ) ) {
		check_ajax_referer( 'rikshawale_contact_nonce', 'nonce' );
	}
	$name    = sanitize_text_field( $_POST['contact_name'] ?? $_POST['name'] ?? '' );
	$email   = sanitize_email( $_POST['contact_email'] ?? $_POST['email'] ?? '' );
	$phone   = sanitize_text_field( $_POST['contact_phone'] ?? $_POST['phone'] ?? '' );
	$message = sanitize_textarea_field( $_POST['contact_message'] ?? $_POST['message'] ?? '' );

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => 'Please fill all required fields.' ) );
	}
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
	}

	// Create CPT entry in DB
	$post_title = $name . ' — ' . date('d M Y H:i');
	$post_id = wp_insert_post( array(
		'post_type'   => 'contact_enquiry',
		'post_title'  => $post_title,
		'post_status' => 'publish',
	) );

	if ( ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_contact_name', $name );
		update_post_meta( $post_id, '_contact_email', $email );
		update_post_meta( $post_id, '_contact_phone', $phone );
		update_post_meta( $post_id, '_contact_message', $message );
	}

	// Email Admin
	$to      = get_option( 'admin_email' );
	$subject = 'New Contact Enquiry from ' . $name . ' – ' . get_bloginfo( 'name' );
	$body    = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" );

	wp_mail( $to, $subject, $body, $headers );

	wp_send_json_success( array( 'message' => 'Thank you! Your message has been sent successfully.' ) );
}
add_action( 'wp_ajax_rikshawale_contact', 'rikshawale_handle_contact_form' );
add_action( 'wp_ajax_nopriv_rikshawale_contact', 'rikshawale_handle_contact_form' );

/**
 * Customizer Registration for Contact Page Info
 */
function rikshawale_contact_customizer( $wp_customize ) {
	$wp_customize->add_section( 'rikshawale_contact_info_section', array(
		'title'    => __( 'Contact Page Info', 'rikshawale-theme' ),
	) );

	// Phone
	$wp_customize->add_setting( 'contact_phone', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_phone', array(
		'label'   => __( 'Phone Number', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'text',
	) );

	// Email
	$wp_customize->add_setting( 'contact_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'contact_email', array(
		'label'   => __( 'E-mail Address', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'email',
	) );

	// Address
	$wp_customize->add_setting( 'contact_address', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'contact_address', array(
		'label'   => __( 'Address', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'textarea',
	) );

	// Working Hours
	$wp_customize->add_setting( 'contact_working_hours', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_working_hours', array(
		'label'   => __( 'Working Time', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'text',
	) );

	// Subtitle / Intro text
	$wp_customize->add_setting( 'contact_form_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_form_title', array(
		'label'   => __( 'Form Title / Heading', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'contact_intro_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'contact_intro_text', array(
		'label'   => __( 'Get In Touch Description', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'textarea',
	) );
}
add_action( 'customize_register', 'rikshawale_contact_customizer' );


/**

 * Register Custom Post Type: Inventory (Cars / Vehicles)
 */
/**
 * Register Custom Post Type: Services / Market Challenges
 */
function rikshawale_register_services_cpt() {
	$labels = array(
		'name'               => _x( 'Services', 'post type general name', 'rikshawale-theme' ),
		'singular_name'      => _x( 'Service', 'post type singular name', 'rikshawale-theme' ),
		'menu_name'          => _x( 'Services', 'admin menu', 'rikshawale-theme' ),
		'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'rikshawale-theme' ),
		'add_new'            => _x( 'Add New Service', 'service', 'rikshawale-theme' ),
		'add_new_item'       => __( 'Add New Service', 'rikshawale-theme' ),
		'new_item'           => __( 'New Service', 'rikshawale-theme' ),
		'edit_item'          => __( 'Edit Service Details', 'rikshawale-theme' ),
		'view_item'          => __( 'View Service', 'rikshawale-theme' ),
		'all_items'          => __( 'All Services', 'rikshawale-theme' ),
		'search_items'       => __( 'Search Services', 'rikshawale-theme' ),
		'not_found'          => __( 'No services found.', 'rikshawale-theme' ),
		'not_found_in_trash' => __( 'No services found in Trash.', 'rikshawale-theme' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'        => false,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-grid-view',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'riksha_service', $args );
}
add_action( 'init', 'rikshawale_register_services_cpt' );

/**
 * Register Custom Post Type: Team Members
 */
function rikshawale_register_team_cpt() {
	$labels = array(
		'name'               => _x( 'Our Team', 'post type general name', 'rikshawale-theme' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name', 'rikshawale-theme' ),
		'menu_name'          => _x( 'Our Team', 'admin menu', 'rikshawale-theme' ),
		'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'rikshawale-theme' ),
		'add_new'            => _x( 'Add Team Member', 'team', 'rikshawale-theme' ),
		'add_new_item'       => __( 'Add New Team Member', 'rikshawale-theme' ),
		'new_item'           => __( 'New Team Member', 'rikshawale-theme' ),
		'edit_item'          => __( 'Edit Team Member', 'rikshawale-theme' ),
		'view_item'          => __( 'View Team Member', 'rikshawale-theme' ),
		'all_items'          => __( 'All Team Members', 'rikshawale-theme' ),
		'search_items'       => __( 'Search Team Members', 'rikshawale-theme' ),
		'not_found'          => __( 'No team members found.', 'rikshawale-theme' ),
		'not_found_in_trash' => __( 'No team members found in Trash.', 'rikshawale-theme' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'        => false,
		'menu_position'      => 8,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'riksha_team', $args );
}
add_action( 'init', 'rikshawale_register_team_cpt' );

/**
 * Team Designation Metabox
 */
function rikshawale_add_team_metabox() {
    add_meta_box(
        'team_designation_metabox',
        __( 'Member Designation / Role', 'rikshawale-theme' ),
        'rikshawale_render_team_metabox',
        'riksha_team',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'rikshawale_add_team_metabox' );

function rikshawale_render_team_metabox($post) {
    wp_nonce_field( 'rikshawale_save_team_meta', 'rikshawale_team_nonce' );
    $role = get_post_meta( $post->ID, '_team_designation', true );
    ?>
    <p>
        <label for="team_designation"><strong>Designation / Role:</strong></label><br>
        <input type="text" id="team_designation" name="team_designation" value="<?php echo esc_attr($role); ?>" class="widefat" placeholder="e.g. Founder & CEO, Fleet Director">
    </p>
    <?php
}

function rikshawale_save_team_meta($post_id) {
    if ( ! isset( $_POST['rikshawale_team_nonce'] ) || ! wp_verify_nonce( $_POST['rikshawale_team_nonce'], 'rikshawale_save_team_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( isset( $_POST['team_designation'] ) ) {
        update_post_meta( $post_id, '_team_designation', sanitize_text_field( $_POST['team_designation'] ) );
    }
}
add_action( 'save_post', 'rikshawale_save_team_meta' );

/**
 * Service Icon Metabox
 */
function rikshawale_add_service_metabox() {
    add_meta_box(
        'service_icon_metabox',
        __( 'Service Icon / Emoji', 'rikshawale-theme' ),
        'rikshawale_render_service_metabox',
        'riksha_service',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'rikshawale_add_service_metabox' );

function rikshawale_render_service_metabox($post) {
    wp_nonce_field( 'rikshawale_save_service_meta', 'rikshawale_service_nonce' );
    $icon = get_post_meta( $post->ID, '_service_icon', true );
    ?>
    <p>
        <label for="service_icon"><strong>Icon or Emoji (leave empty for auto-icon):</strong></label><br>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat" placeholder="e.g. 🔍, 🤝, 💳, 📄, 🛡️, 📉">
    </p>
    <?php
}

function rikshawale_save_service_meta($post_id) {
    if ( ! isset( $_POST['rikshawale_service_nonce'] ) || ! wp_verify_nonce( $_POST['rikshawale_service_nonce'], 'rikshawale_save_service_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( isset( $_POST['service_icon'] ) ) {
        update_post_meta( $post_id, '_service_icon', sanitize_text_field( $_POST['service_icon'] ) );
    }
}
add_action( 'save_post', 'rikshawale_save_service_meta' );

/**
 * Register Custom Post Type: Riksha Inventory
 */
function rikshawale_register_inventory_cpt() {
	$labels = array(
		'name'               => _x( 'Riksha Inventory', 'post type general name', 'rikshawale-theme' ),
		'singular_name'      => _x( 'Riksha', 'post type singular name', 'rikshawale-theme' ),
		'menu_name'          => _x( 'Riksha Inventory', 'admin menu', 'rikshawale-theme' ),
		'name_admin_bar'     => _x( 'Riksha', 'add new on admin bar', 'rikshawale-theme' ),
		'add_new'            => _x( 'Add New Riksha', 'riksha', 'rikshawale-theme' ),
		'add_new_item'       => __( 'Add New Riksha to Inventory', 'rikshawale-theme' ),
		'new_item'           => __( 'New Riksha', 'rikshawale-theme' ),
		'edit_item'          => __( 'Edit Riksha Details', 'rikshawale-theme' ),
		'view_item'          => __( 'View Riksha', 'rikshawale-theme' ),
		'all_items'          => __( 'All Rikshas', 'rikshawale-theme' ),
		'search_items'       => __( 'Search Riksha Inventory', 'rikshawale-theme' ),
		'parent_item_colon'  => __( 'Parent Rikshas:', 'rikshawale-theme' ),
		'not_found'          => __( 'No rikshas found in inventory.', 'rikshawale-theme' ),
		'not_found_in_trash' => __( 'No rikshas found in Trash.', 'rikshawale-theme' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'inventory' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'        => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-admin-network',
		'supports'           => array( 'title', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => false,
	);

	register_post_type( 'inventory', $args );
}
add_action( 'init', 'rikshawale_register_inventory_cpt' );

/**
 * Register Custom Taxonomies for Riksha Inventory
 */
function rikshawale_register_inventory_taxonomies() {
	// Riksha Locations / Places Taxonomy
	register_taxonomy( 'riksha_location', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'              => _x( 'Locations / Places', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name'     => _x( 'Location', 'taxonomy singular name', 'rikshawale-theme' ),
			'search_items'      => __( 'Search Locations', 'rikshawale-theme' ),
			'all_items'         => __( 'All Locations', 'rikshawale-theme' ),
			'parent_item'       => __( 'Parent Location', 'rikshawale-theme' ),
			'parent_item_colon' => __( 'Parent Location:', 'rikshawale-theme' ),
			'edit_item'         => __( 'Edit Location', 'rikshawale-theme' ),
			'update_item'       => __( 'Update Location', 'rikshawale-theme' ),
			'add_new_item'      => __( 'Add New Location', 'rikshawale-theme' ),
			'new_item_name'     => __( 'New Location Name', 'rikshawale-theme' ),
			'menu_name'         => __( 'Locations / Places', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'location' ),
		'show_in_rest'      => true,
	) );

	// Riksha Models
	register_taxonomy( 'riksha_model', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Riksha Models', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Riksha Model', 'taxonomy singular name', 'rikshawale-theme' ),
			'search_items'  => __( 'Search Riksha Models', 'rikshawale-theme' ),
			'all_items'     => __( 'All Riksha Models', 'rikshawale-theme' ),
			'add_new_item'  => __( 'Add New Riksha Model', 'rikshawale-theme' ),
			'menu_name'     => __( 'Riksha Models', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'riksha-model' ),
		'show_in_rest'      => true,
	) );

	// Riksha Brands
	register_taxonomy( 'riksha_brand', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Riksha Brands', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Riksha Brand', 'taxonomy singular name', 'rikshawale-theme' ),
			'search_items'  => __( 'Search Riksha Brands', 'rikshawale-theme' ),
			'all_items'     => __( 'All Riksha Brands', 'rikshawale-theme' ),
			'add_new_item'  => __( 'Add New Riksha Brand', 'rikshawale-theme' ),
			'menu_name'     => __( 'Riksha Brands', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'riksha-brand' ),
		'show_in_rest'      => true,
	) );

	// Manufacturing Year Taxonomy
	register_taxonomy( 'riksha_mfg_year', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Manufacturing Years', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Manufacturing Year', 'taxonomy singular name', 'rikshawale-theme' ),
			'menu_name'     => __( 'Mfg Years', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );

	// Registration Year Taxonomy
	register_taxonomy( 'riksha_reg_year', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Registration Years', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Registration Year', 'taxonomy singular name', 'rikshawale-theme' ),
			'menu_name'     => __( 'Reg Years', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );

	// Owner Type Taxonomy
	register_taxonomy( 'riksha_owner_type', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Owner Types', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Owner Type', 'taxonomy singular name', 'rikshawale-theme' ),
			'menu_name'     => __( 'Owner Types', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );

	// Fuel Type Taxonomy
	register_taxonomy( 'riksha_fuel_type', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Fuel Types', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Fuel Type', 'taxonomy singular name', 'rikshawale-theme' ),
			'menu_name'     => __( 'Fuel Types', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );

	// Transmission Type Taxonomy
	register_taxonomy( 'riksha_trans_type', array( 'inventory' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Transmission Types', 'taxonomy general name', 'rikshawale-theme' ),
			'singular_name' => _x( 'Transmission Type', 'taxonomy singular name', 'rikshawale-theme' ),
			'menu_name'     => __( 'Transmission Types', 'rikshawale-theme' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );
}
add_action( 'init', 'rikshawale_register_inventory_taxonomies' );

/**
 * Seed Default Taxonomy Terms (Brands, Models, Locations, Fuel Types)
 */
function rikshawale_seed_all_taxonomy_terms() {
	// 1. Locations
	if ( taxonomy_exists( 'riksha_location' ) ) {
		$default_places = array(
			'Delhi NCR' => 'delhi-ncr', 'Mumbai' => 'mumbai', 'Patna' => 'patna',
			'Jaipur' => 'jaipur', 'Lucknow' => 'lucknow', 'Kolkata' => 'kolkata',
			'Bengaluru' => 'bengaluru', 'Ahmedabad' => 'ahmedabad', 'Pune' => 'pune', 'Indore' => 'indore'
		);
		foreach ( $default_places as $name => $slug ) {
			if ( ! term_exists( $slug, 'riksha_location' ) ) {
				wp_insert_term( $name, 'riksha_location', array( 'slug' => $slug ) );
			}
		}
	}
	// 2. Brands
	if ( taxonomy_exists( 'riksha_brand' ) ) {
		$default_brands = array( 'Mahindra', 'Bajaj', 'Piaggio', 'TVS', 'Mayuri', 'Yatri', 'Tata', 'Toyota', 'Hyundai' );
		foreach ( $default_brands as $brand_name ) {
			if ( ! term_exists( $brand_name, 'riksha_brand' ) ) {
				wp_insert_term( $brand_name, 'riksha_brand' );
			}
		}
	}
	// 3. Models
	if ( taxonomy_exists( 'riksha_model' ) ) {
		$default_models = array( 'King Deluxe', 'Maxima Cargo', 'RE', 'Treo', 'Alfa', 'Ape', 'E-Alfa Mini', 'Safari', 'Super Carry' );
		foreach ( $default_models as $model_name ) {
			if ( ! term_exists( $model_name, 'riksha_model' ) ) {
				wp_insert_term( $model_name, 'riksha_model' );
			}
		}
	}
	// 4. Fuel Types
	if ( taxonomy_exists( 'riksha_fuel_type' ) ) {
		$default_fuels = array( 'Electric', 'CNG', 'Diesel', 'Petrol', 'LPG', 'Hybrid' );
		foreach ( $default_fuels as $fuel_name ) {
			if ( ! term_exists( $fuel_name, 'riksha_fuel_type' ) ) {
				wp_insert_term( $fuel_name, 'riksha_fuel_type' );
			}
		}
	}
}
add_action( 'init', 'rikshawale_seed_all_taxonomy_terms', 20 );

/**
 * Add Riksha Inventory Details Metabox
 */
function rikshawale_add_inventory_metabox() {
    add_meta_box(
        'inventory_details_metabox',
        __( 'Riksha Specifications & 5 Gallery Images', 'rikshawale-theme' ),
        'rikshawale_render_inventory_metabox',
        'inventory',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'rikshawale_add_inventory_metabox' );

/**
 * Disable Gutenberg Block Editor for Inventory & Riksha Post Types
 */
function rikshawale_disable_gutenberg_for_inventory( $use_block_editor, $post_type ) {
    if ( in_array( $post_type, array( 'inventory', 'riksha' ), true ) ) {
        return false;
    }
    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'rikshawale_disable_gutenberg_for_inventory', 10, 2 );

/**
 * Helper to normalize Owner Type strings across submission and inventory CPTs
 */
function rikshawale_normalize_owner_type( $val ) {
    $v = strtolower( trim( (string) $val ) );
    if ( empty( $v ) ) return '';
    if ( strpos( $v, '1' ) !== false || strpos( $v, 'first' ) !== false ) {
        return '1st Owner';
    }
    if ( strpos( $v, '2' ) !== false || strpos( $v, 'second' ) !== false ) {
        return '2nd Owner';
    }
    if ( strpos( $v, '3' ) !== false || strpos( $v, 'third' ) !== false ) {
        return '3rd Owner';
    }
    if ( strpos( $v, '4' ) !== false || strpos( $v, 'fourth' ) !== false ) {
        return '4th+ Owner';
    }
    return $val;
}

/**
 * Render Riksha Inventory Details Metabox Content
 */
function rikshawale_render_inventory_metabox( $post ) {
    wp_nonce_field( 'rikshawale_save_inventory_meta', 'rikshawale_inventory_meta_nonce' );

    $short_desc      = get_post_meta( $post->ID, '_car_short_desc', true );
    $price           = get_post_meta( $post->ID, '_car_price', true );
    $currency_symbol = get_post_meta( $post->ID, '_car_currency_symbol', true ) ?: '₹';
    $custom_interest = get_post_meta( $post->ID, '_car_interest_rate', true );
    $color           = get_post_meta( $post->ID, '_car_color', true );
    $mfg_year        = get_post_meta( $post->ID, '_car_mfg_year', true ) ?: get_post_meta( $post->ID, '_car_year', true );
    $reg_year        = get_post_meta( $post->ID, '_car_reg_year', true );
    $raw_owner       = get_post_meta( $post->ID, '_car_owner_type', true ) ?: get_post_meta( $post->ID, '_riksha_owner_type', true );
    $owner_type      = rikshawale_normalize_owner_type( $raw_owner );
    $brand_name      = get_post_meta( $post->ID, '_car_brand_name', true );
    $model_name      = get_post_meta( $post->ID, '_car_model_name', true );
    $variant         = get_post_meta( $post->ID, '_car_variant', true );
    $driven_km       = get_post_meta( $post->ID, '_car_driven_km', true ) ?: get_post_meta( $post->ID, '_car_mileage', true );
    $fuel            = get_post_meta( $post->ID, '_car_fuel', true );
    $transmission    = get_post_meta( $post->ID, '_car_transmission', true );
    $badge           = get_post_meta( $post->ID, '_car_badge', true );
    $video_url       = get_post_meta( $post->ID, '_car_video_url', true );

    // 5 Gallery Images
    $img1           = get_post_meta( $post->ID, '_car_gallery_image_1', true );
    $img2           = get_post_meta( $post->ID, '_car_gallery_image_2', true );
    $img3           = get_post_meta( $post->ID, '_car_gallery_image_3', true );
    $img4           = get_post_meta( $post->ID, '_car_gallery_image_4', true );
    $img5           = get_post_meta( $post->ID, '_car_gallery_image_5', true );

    $colors_list   = array( 'White', 'Black', 'Red', 'Blue', 'Grey', 'Green', 'Yellow', 'Silver' );
    $transmissions = array( 'Automatic' => 'Automatic', 'Manual' => 'Manual' );
    $fuels         = array( 'Petrol' => 'Petrol', 'Diesel' => 'Diesel', 'Electric' => 'Electric', 'CNG' => 'CNG', 'LPG' => 'LPG', 'Hybrid' => 'Hybrid' );
    $owners        = array( '1st Owner' => '1st Owner', '2nd Owner' => '2nd Owner', '3rd Owner' => '3rd Owner', '4th+ Owner' => '4th+ Owner' );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="car_short_desc"><?php _e( 'Short Description / Subtitle', 'rikshawale-theme' ); ?></label></th>
            <td>
                <input type="text" id="car_short_desc" name="car_short_desc" value="<?php echo esc_attr( $short_desc ); ?>" class="regular-text" placeholder="e.g. 2024 Top Model | Mint Condition | Low Driven">
                <p class="description"><?php _e( 'Subtitle displayed right after title on single vehicle page. If empty, nothing is shown.', 'rikshawale-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="car_currency_symbol"><?php _e( 'Currency Symbol / Prefix', 'rikshawale-theme' ); ?></label></th>
            <td>
                <input type="text" id="car_currency_symbol" name="car_currency_symbol" value="<?php echo esc_attr( $currency_symbol ); ?>" class="regular-text" placeholder="e.g. ₹, Rs., $, € (Default: ₹)">
                <p class="description"><?php _e( 'Symbol shown before price. Defaults to ₹ (Rupees) if left empty.', 'rikshawale-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="car_price"><?php _e( 'Selling Price', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_price" name="car_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="e.g. 24,000 or ₹10.75 Lakh"></td>
        </tr>
        <tr>
            <th><label for="car_interest_rate"><?php _e( 'EMI Interest Rate (% p.a.)', 'rikshawale-theme' ); ?></label></th>
            <td>
                <input type="text" id="car_interest_rate" name="car_interest_rate" value="<?php echo esc_attr( $custom_interest ); ?>" class="regular-text" placeholder="e.g. 11.75 or 9.5 (Default: Theme Option setting)">
                <p class="description"><?php _e( 'Custom annual loan interest rate for this vehicle. If left empty, global Theme Option setting is used.', 'rikshawale-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="car_color"><?php _e( 'Exterior Color *', 'rikshawale-theme' ); ?></label></th>
            <td>
                <select id="car_color" name="car_color" class="regular-text" style="font-weight: 600;">
                    <option value=""><?php _e( 'Choose Exterior Color', 'rikshawale-theme' ); ?></option>
                    <?php foreach ( $colors_list as $c ) : ?>
                        <option value="<?php echo esc_attr( $c ); ?>" <?php selected( strtolower( (string)$color ), strtolower( $c ) ); ?>>
                            <?php echo esc_html( $c ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="description"><?php _e( 'Select vehicle exterior color matching frontend filter swatches (White, Black, Red, Blue, Grey, Green, Yellow, Silver).', 'rikshawale-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="car_badge"><?php _e( 'Ribbon Badge Tag', 'rikshawale-theme' ); ?></label></th>
            <td>
                <?php
                $badge_options = array(
                    'none'          => '🚫 No Badge (Hide)',
                    'LIMITED OFFER' => '🔥 LIMITED OFFER',
                    'COMING SOON'   => '⏳ COMING SOON',
                    'FEATURED'      => '⭐ FEATURED',
                    'POPULAR'       => '🔥 POPULAR',
                    'CERTIFIED'     => '🛡️ CERTIFIED',
                    'BEST VALUE'    => '💰 BEST VALUE',
                    'NEW ARRIVAL'   => '🆕 NEW ARRIVAL',
                    'BUDGET PICK'   => '🏷️ BUDGET PICK',
                    'HEAVY DUTY'    => '💪 HEAVY DUTY',
                    'TOP RATED'     => '🌟 TOP RATED',
                );
                $current_badge = trim( (string) $badge );
                $badge_key     = strtoupper( $current_badge );
                if ( empty( $current_badge ) || $badge_key === 'NONE' || $badge_key === 'NO_BADGE' || $badge_key === 'HIDE' || $badge_key === 'NO BADGE' ) {
                    $badge_key = 'none';
                }
                ?>
                <select id="car_badge" name="car_badge" class="regular-text" style="font-weight: 600;">
                    <?php foreach ( $badge_options as $val => $label ) : ?>
                        <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $badge_key, $val ); ?>>
                            <?php echo esc_html( $label ); ?>
                        </option>
                    <?php endforeach; ?>
                    <?php if ( ! empty( $current_badge ) && ! array_key_exists( $badge_key, $badge_options ) ) : ?>
                        <option value="<?php echo esc_attr( $current_badge ); ?>" selected>
                            <?php echo esc_html( $current_badge ); ?>
                        </option>
                    <?php endif; ?>
                </select>
                <p class="description"><?php _e( 'Select a ribbon badge for vehicle card. Choose "No Badge (Hide)" to hide badge.', 'rikshawale-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="car_video_url"><?php _e( 'Riksha Video URL / File Link', 'rikshawale-theme' ); ?></label></th>
            <td>
                <input type="text" id="car_video_url" name="car_video_url" value="<?php echo esc_attr( $video_url ); ?>" class="regular-text" placeholder="e.g. https://www.youtube.com/watch?v=... or http://localhost/.../video.mp4">
                <p class="description"><?php _e( 'YouTube video link or uploaded MP4 video URL. Displayed right after photo gallery slides on vehicle detail page.', 'rikshawale-theme' ); ?></p>
                <?php if ( ! empty( $video_url ) ) : ?>
                    <div style="margin-top:8px; max-width:400px;">
                        <?php if ( strpos( $video_url, 'youtube.com' ) !== false || strpos( $video_url, 'youtu.be' ) !== false ) :
                            preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $yt_match );
                            $yt_id = $yt_match[1] ?? '';
                        ?>
                            <iframe width="100%" height="220" src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>" frameborder="0" allowfullscreen style="border-radius:6px;"></iframe>
                        <?php else : ?>
                            <video src="<?php echo esc_url($video_url); ?>" controls style="width:100%; max-height:220px; background:#000; border-radius:6px;"></video>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="car_mfg_year"><?php _e( 'Manufacturing Year *', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_mfg_year" name="car_mfg_year" value="<?php echo esc_attr( $mfg_year ); ?>" class="regular-text" placeholder="e.g. 2022"></td>
        </tr>
        <tr>
            <th><label for="car_reg_year"><?php _e( 'Registration Year *', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_reg_year" name="car_reg_year" value="<?php echo esc_attr( $reg_year ); ?>" class="regular-text" placeholder="e.g. 2022"></td>
        </tr>
        <tr>
            <th><label for="car_owner_type"><?php _e( 'Owner Type *', 'rikshawale-theme' ); ?></label></th>
            <td>
                <select id="car_owner_type" name="car_owner_type">
                    <option value=""><?php _e( 'Choose owner type', 'rikshawale-theme' ); ?></option>
                    <?php foreach ( $owners as $k => $v ) : ?>
                        <option value="<?php echo esc_attr($k); ?>" <?php selected( strtolower(trim((string)$owner_type)), strtolower(trim((string)$k)) ); ?>><?php echo esc_html($v); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="car_brand_name"><?php _e( 'Brand *', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_brand_name" name="car_brand_name" value="<?php echo esc_attr( $brand_name ); ?>" class="regular-text" placeholder="e.g. Mahindra, Toyota, Hyundai"></td>
        </tr>
        <tr>
            <th><label for="car_model_name"><?php _e( 'Model Name *', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_model_name" name="car_model_name" value="<?php echo esc_attr( $model_name ); ?>" class="regular-text" placeholder="e.g. Treo, XUV500, Innova Crysta"></td>
        </tr>
        <tr>
            <th><label for="car_variant"><?php _e( 'Variant *', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_variant" name="car_variant" value="<?php echo esc_attr( $variant ); ?>" class="regular-text" placeholder="e.g. 2.4 VX, SX, Yaari"></td>
        </tr>
        <tr>
            <th><label for="car_driven_km"><?php _e( 'Driven (KM) *', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_driven_km" name="car_driven_km" value="<?php echo esc_attr( $driven_km ); ?>" class="regular-text" placeholder="e.g. 25,000 km"></td>
        </tr>
        <tr>
            <th><label for="car_fuel"><?php _e( 'Fuel Type *', 'rikshawale-theme' ); ?></label></th>
            <td>
                <select id="car_fuel" name="car_fuel">
                    <option value=""><?php _e( 'Choose fuel type', 'rikshawale-theme' ); ?></option>
                    <?php foreach ( $fuels as $k => $v ) : ?>
                        <option value="<?php echo esc_attr($k); ?>" <?php selected( $fuel, $k ); ?>><?php echo esc_html($v); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="car_transmission"><?php _e( 'Transmission Type *', 'rikshawale-theme' ); ?></label></th>
            <td>
                <select id="car_transmission" name="car_transmission">
                    <option value=""><?php _e( 'Choose transmission', 'rikshawale-theme' ); ?></option>
                    <?php foreach ( $transmissions as $k => $v ) : ?>
                        <option value="<?php echo esc_attr($k); ?>" <?php selected( $transmission, $k ); ?>><?php echo esc_html($v); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th colspan="2"><hr><h3 style="margin:0;"><?php _e( '5 Detail Page Slider Images', 'rikshawale-theme' ); ?></h3></th>
        </tr>
        <?php for ( $i = 1; $i <= 5; $i++ ) : 
            $val = ${"img{$i}"};
        ?>
        <tr>
            <th><label for="car_gallery_image_<?php echo $i; ?>"><?php echo "Gallery Image {$i}"; ?></label></th>
            <td>
                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                    <input type="text" id="car_gallery_image_<?php echo $i; ?>" name="car_gallery_image_<?php echo $i; ?>" value="<?php echo esc_attr( $val ); ?>" class="regular-text" placeholder="Enter image URL or click Upload">
                    <button type="button" class="button button-secondary riksha-upload-img-btn" data-target="car_gallery_image_<?php echo $i; ?>">
                        <span class="dashicons dashicons-upload" style="vertical-align: middle;"></span> Upload Image
                    </button>
                    <button type="button" class="button button-link-delete riksha-remove-img-btn" data-target="car_gallery_image_<?php echo $i; ?>" style="<?php echo $val ? '' : 'display:none;'; ?>">
                        Remove Image
                    </button>
                </div>
                <div id="preview_car_gallery_image_<?php echo $i; ?>" style="margin-top: 8px;">
                    <?php if ( $val ) : ?>
                        <img src="<?php echo esc_url($val); ?>" style="max-width: 120px; max-height: 80px; border-radius: 6px; border: 1px solid #ccc; object-fit: cover;">
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <?php endfor; ?>
    </table>

    <script>
    jQuery(document).ready(function($){
        $('.riksha-upload-img-btn').on('click', function(e){
            e.preventDefault();
            var targetId = $(this).data('target');
            var inputField = $('#' + targetId);
            var previewBox = $('#preview_' + targetId);
            var removeBtn  = $(this).siblings('.riksha-remove-img-btn');

            var frame = wp.media({
                title: 'Select or Upload Gallery Image',
                button: { text: 'Use this image' },
                multiple: false
            });

            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
                previewBox.html('<img src="' + attachment.url + '" style="max-width: 120px; max-height: 80px; border-radius: 6px; border: 1px solid #ccc; object-fit: cover;">');
                removeBtn.show();
            });

            frame.open();
        });

        $('.riksha-remove-img-btn').on('click', function(e){
            e.preventDefault();
            var targetId = $(this).data('target');
            $('#' + targetId).val('');
            $('#preview_' + targetId).html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

/**
 * Enqueue Media Uploader in Admin
 */
function rikshawale_admin_media_scripts($hook) {
    if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'rikshawale_admin_media_scripts' );

/**
 * Save Riksha Inventory Specifications Metadata
 */
function rikshawale_save_inventory_meta( $post_id ) {
    if ( ! isset( $_POST['rikshawale_inventory_meta_nonce'] ) || ! wp_verify_nonce( $_POST['rikshawale_inventory_meta_nonce'], 'rikshawale_save_inventory_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'car_short_desc',
        'car_price',
        'car_currency_symbol',
        'car_interest_rate',
        'car_color',
        'car_badge',
        'car_video_url',
        'car_mfg_year',
        'car_reg_year',
        'car_owner_type',
        'car_brand_name',
        'car_model_name',
        'car_variant',
        'car_driven_km',
        'car_fuel',
        'car_transmission',
        'car_gallery_image_1',
        'car_gallery_image_2',
        'car_gallery_image_3',
        'car_gallery_image_4',
        'car_gallery_image_5',
    );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post_inventory', 'rikshawale_save_inventory_meta' );

/**
 * Helper function to get formatted price with currency symbol
 */
function rikshawale_get_formatted_price( $post_id = 0 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $price = get_post_meta( $post_id, '_car_price', true );
    if ( empty( $price ) ) {
        $price = get_post_meta( $post_id, '_riksha_price', true );
    }
    
    $symbol = get_post_meta( $post_id, '_car_currency_symbol', true );
    if ( empty( $symbol ) ) {
        $symbol = '₹';
    }

    if ( empty( $price ) ) {
        return $symbol . ' 0';
    }

    $price = trim( $price );

    // If price already contains currency symbol or Rs / INR / $, return as is
    if ( preg_match( '/^(₹|Rs|RS|INR|\$|€|£)/u', $price ) ) {
        return $price;
    }

    return $symbol . ' ' . $price;
}
add_action( 'save_post', 'rikshawale_save_inventory_meta' );

/**
 * Register Custom Taxonomy: Riksha Type
 */
function rikshawale_register_riksha_taxonomy() {
	$labels = array(
		'name'              => _x( 'Riksha Types', 'taxonomy general name', 'rikshawale-theme' ),
		'singular_name'     => _x( 'Riksha Type', 'taxonomy singular name', 'rikshawale-theme' ),
		'search_items'      => __( 'Search Riksha Types', 'rikshawale-theme' ),
		'all_items'         => __( 'All Riksha Types', 'rikshawale-theme' ),
		'parent_item'       => __( 'Parent Riksha Type', 'rikshawale-theme' ),
		'parent_item_colon' => __( 'Parent Riksha Type:', 'rikshawale-theme' ),
		'edit_item'         => __( 'Edit Riksha Type', 'rikshawale-theme' ),
		'update_item'       => __( 'Update Riksha Type', 'rikshawale-theme' ),
		'add_new_item'      => __( 'Add New Riksha Type', 'rikshawale-theme' ),
		'new_item_name'     => __( 'New Riksha Type Name', 'rikshawale-theme' ),
		'menu_name'         => __( 'Riksha Types', 'rikshawale-theme' ),
	);

	$args = array(
		'hierarchical'      => true, // behave like categories
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'riksha-type' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'riksha_type', array( 'inventory' ), $args );
}
add_action( 'init', 'rikshawale_register_riksha_taxonomy' );

/**
 * Register Custom Taxonomy: Riksha Brand (Make)
 */
function rikshawale_register_riksha_brand_taxonomy() {
	$labels = array(
		'name'              => _x( 'Riksha Brands', 'taxonomy general name', 'rikshawale-theme' ),
		'singular_name'     => _x( 'Riksha Brand', 'taxonomy singular name', 'rikshawale-theme' ),
		'search_items'      => __( 'Search Riksha Brands', 'rikshawale-theme' ),
		'all_items'         => __( 'All Riksha Brands', 'rikshawale-theme' ),
		'parent_item'       => __( 'Parent Riksha Brand', 'rikshawale-theme' ),
		'parent_item_colon' => __( 'Parent Riksha Brand:', 'rikshawale-theme' ),
		'edit_item'         => __( 'Edit Riksha Brand', 'rikshawale-theme' ),
		'update_item'       => __( 'Update Riksha Brand', 'rikshawale-theme' ),
		'add_new_item'      => __( 'Add New Riksha Brand', 'rikshawale-theme' ),
		'new_item_name'     => __( 'New Riksha Brand Name', 'rikshawale-theme' ),
		'menu_name'         => __( 'Brands / Makes', 'rikshawale-theme' ),
	);

	$args = array(
		'hierarchical'      => true, // behave like categories
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'riksha-brand' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'riksha_brand', array( 'inventory' ), $args );
}
add_action( 'init', 'rikshawale_register_riksha_brand_taxonomy' );

/**
 * Add Riksha Specifications Metabox
 */
function rikshawale_add_riksha_metabox() {
    add_meta_box(
        'riksha_details_metabox',
        __( 'Riksha Specifications', 'rikshawale-theme' ),
        'rikshawale_render_riksha_metabox',
        'riksha',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'rikshawale_add_riksha_metabox' );

/**
 * Render Riksha Specifications Metabox Content
 */
function rikshawale_render_riksha_metabox( $post ) {
    wp_nonce_field( 'rikshawale_save_riksha_meta', 'rikshawale_riksha_meta_nonce' );

    $price = get_post_meta( $post->ID, '_riksha_price', true );
    $mileage = get_post_meta( $post->ID, '_riksha_mileage', true );
    $fuel = get_post_meta( $post->ID, '_riksha_fuel', true );
    $transmission = get_post_meta( $post->ID, '_riksha_transmission', true );
    $power = get_post_meta( $post->ID, '_riksha_power', true );
    $year = get_post_meta( $post->ID, '_riksha_year', true );

    $fuels = array(
        'Electric' => __( 'Electric', 'rikshawale-theme' ),
        'CNG'      => __( 'CNG', 'rikshawale-theme' ),
        'LPG'      => __( 'LPG', 'rikshawale-theme' ),
        'Petrol'   => __( 'Petrol', 'rikshawale-theme' ),
        'Diesel'   => __( 'Diesel', 'rikshawale-theme' )
    );

    $transmissions = array(
        'Automatic' => __( 'Automatic', 'rikshawale-theme' ),
        'Manual'    => __( 'Manual', 'rikshawale-theme' )
    );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="riksha_price"><?php _e( 'Price (e.g. ₹1,50,000 or $2,500)', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="riksha_price" name="riksha_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="riksha_mileage"><?php _e( 'Range / Mileage (e.g. 120 km or 35 km/l)', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="riksha_mileage" name="riksha_mileage" value="<?php echo esc_attr( $mileage ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="riksha_fuel"><?php _e( 'Fuel / Power Type', 'rikshawale-theme' ); ?></label></th>
            <td>
                <select id="riksha_fuel" name="riksha_fuel">
                    <option value=""><?php _e( 'Select Fuel Type', 'rikshawale-theme' ); ?></option>
                    <?php foreach ( $fuels as $key => $label ) : ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $fuel, $key ); ?>><?php echo esc_html( $label ); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="riksha_transmission"><?php _e( 'Transmission', 'rikshawale-theme' ); ?></label></th>
            <td>
                <select id="riksha_transmission" name="riksha_transmission">
                    <option value=""><?php _e( 'Select Transmission', 'rikshawale-theme' ); ?></option>
                    <?php foreach ( $transmissions as $key => $label ) : ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $transmission, $key ); ?>><?php echo esc_html( $label ); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="riksha_power"><?php _e( 'Engine / Motor Power (e.g. 2.0 kW or 230 cc)', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="riksha_power" name="riksha_power" value="<?php echo esc_attr( $power ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="riksha_year"><?php _e( 'Model Year (e.g. 2026)', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="riksha_year" name="riksha_year" value="<?php echo esc_attr( $year ); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

/**
 * Save Riksha Specifications Metabox Data
 */
function rikshawale_save_riksha_meta( $post_id ) {
    if ( ! isset( $_POST['rikshawale_riksha_meta_nonce'] ) || ! wp_verify_nonce( $_POST['rikshawale_riksha_meta_nonce'], 'rikshawale_save_riksha_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'riksha_price',
        'riksha_mileage',
        'riksha_fuel',
        'riksha_transmission',
        'riksha_power',
        'riksha_year'
    );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'rikshawale_save_riksha_meta' );

/**
 * Custom Drag and Drop Section Reorder Control for WP Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
    class Rikshawale_Section_Order_Control extends WP_Customize_Control {
        public $type = 'rikshawale_section_order';
        public $section_labels = array();

        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-sortable' );
        }

        public function render_content() {
            if ( empty( $this->section_labels ) ) {
                return;
            }

            $current_order_str = $this->value();
            if ( empty( $current_order_str ) ) {
                $current_order = array_keys( $this->section_labels );
            } else {
                $current_order = explode( ',', $current_order_str );
                foreach ( array_keys( $this->section_labels ) as $sec_key ) {
                    if ( ! in_array( $sec_key, $current_order, true ) ) {
                        $current_order[] = $sec_key;
                    }
                }
            }
            ?>
            <div class="rikshawale-section-reorder-wrap">
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>

                <ul class="rikshawale-sortable-sections-list">
                    <?php foreach ( $current_order as $sec_id ) : 
                        if ( isset( $this->section_labels[ $sec_id ] ) ) :
                    ?>
                        <li class="rikshawale-sortable-item" data-section-id="<?php echo esc_attr( $sec_id ); ?>">
                            <span class="dashicons dashicons-menu drag-handle"></span>
                            <span class="section-title"><?php echo esc_html( $this->section_labels[ $sec_id ] ); ?></span>
                        </li>
                    <?php endif; endforeach; ?>
                </ul>

                <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $current_order ) ); ?>" />
            </div>

            <style>
            .rikshawale-sortable-sections-list {
                margin: 12px 0 0 0;
                padding: 0;
                list-style: none;
            }
            .rikshawale-sortable-item {
                background: #ffffff;
                border: 1px solid #dcdcde;
                border-radius: 6px;
                padding: 10px 12px;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                cursor: grab;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                transition: all 0.2s ease;
                user-select: none;
            }
            .rikshawale-sortable-item:hover {
                border-color: #2271b1;
                box-shadow: 0 2px 6px rgba(34,113,177,0.15);
                background: #f6f7f7;
            }
            .rikshawale-sortable-item.ui-sortable-helper {
                cursor: grabbing;
                box-shadow: 0 6px 15px rgba(0,0,0,0.15);
                border-color: #2271b1;
                background: #f0f6fc;
            }
            .rikshawale-sortable-item .drag-handle {
                color: #8c8f94;
                margin-right: 10px;
                font-size: 18px;
            }
            .rikshawale-sortable-item .section-title {
                font-weight: 600;
                font-size: 13px;
                color: #1d2327;
            }
            </style>

            <script>
            jQuery(document).ready(function($) {
                $('.rikshawale-sortable-sections-list').sortable({
                    handle: '.drag-handle, .section-title',
                    placeholder: 'ui-state-highlight',
                    axis: 'y',
                    update: function(event, ui) {
                        var container = $(this).closest('.rikshawale-section-reorder-wrap');
                        var order = [];
                        container.find('.rikshawale-sortable-item').each(function() {
                            order.push($(this).data('section-id'));
                        });
                        var input = container.find('input[type="hidden"]');
                        input.val(order.join(',')).trigger('change');
                    }
                });
            });
            </script>
            <?php
        }
    }
}

/**
 * Theme Customizer settings for dynamic header and footer
 */
function rikshawale_customize_register( $wp_customize ) {

	// ------------------------------------------------------------
	// DRAG & DROP HOMEPAGE SECTION REORDER SECTION
	// ------------------------------------------------------------
	$wp_customize->add_section( 'rikshawale_section_order_section', array(
		'title'       => __( '🎯 Drag & Drop Homepage Sections', 'rikshawale-theme' ),
		'priority'    => 20,
		'description' => __( 'Drag and drop the section handles below to reorder top-to-bottom sections on your homepage in real-time!', 'rikshawale-theme' ),
	) );

	$section_labels = array(
		'hero_slider'    => __( '1. Banner Slider Section', 'rikshawale-theme' ),
		'search_filter'  => __( '2. Floating Search Widget', 'rikshawale-theme' ),
		'page_content'   => __( '3. Page Content / Elementor Block', 'rikshawale-theme' ),
		'about_us'       => __( '4. Welcome & About Us Section', 'rikshawale-theme' ),
		'inventory'      => __( '5. Riksha Inventory Slider', 'rikshawale-theme' ),
		'key_challenges' => __( '6. Key Challenges & Market Insight', 'rikshawale-theme' ),
		'video_section'  => __( '7. 4-Video Autoplay Grid', 'rikshawale-theme' ),
		'new_arrivals'   => __( '8. New Arrivals Slider', 'rikshawale-theme' ),
		'contact_banner' => __( '9. Contact Support Split Banner', 'rikshawale-theme' ),
		'our_team'       => __( '10. Meet Our Team Section', 'rikshawale-theme' ),
		'why_choose'     => __( '11. Why Choose Rikshawale', 'rikshawale-theme' ),
		'testimonials'   => __( '12. Customer Testimonials', 'rikshawale-theme' ),
		'faq'            => __( '13. FAQ Accordion Section', 'rikshawale-theme' ),
	);

	$default_order = implode( ',', array_keys( $section_labels ) );

	$wp_customize->add_setting( 'homepage_section_order', array(
		'default'           => $default_order,
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	if ( class_exists( 'Rikshawale_Section_Order_Control' ) ) {
		$wp_customize->add_control( new Rikshawale_Section_Order_Control( $wp_customize, 'homepage_section_order', array(
			'label'          => __( 'Homepage Section Layout', 'rikshawale-theme' ),
			'description'    => __( 'Drag and drop section handles up or down to change homepage section order.', 'rikshawale-theme' ),
			'section'        => 'rikshawale_section_order_section',
			'settings'       => 'homepage_section_order',
			'section_labels' => $section_labels,
		) ) );
	}

	// Add Section: Theme Styling & Colors
	$wp_customize->add_section( 'rikshawale_colors_section', array(
		'title'       => __( 'Theme Colors', 'rikshawale-theme' ),
		'priority'    => 25,
		'description' => __( 'Customize the global theme colors to match your brand style', 'rikshawale-theme' ),
	) );

	// Theme Accent Color (Default: Red #db2d2e)
	$wp_customize->add_setting( 'theme_accent_color', array(
		'default'   => '#db2d2e',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
		'label'    => __( 'Theme Accent/Primary Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_colors_section',
		'settings' => 'theme_accent_color',
	) ) );

	/* ============================================================
	   TYPOGRAPHY & UI/UX DESIGN SECTION
	   ============================================================ */
	$wp_customize->add_section( 'rikshawale_typography_section', array(
		'title'       => __( 'Typography & Layout Styling', 'rikshawale-theme' ),
		'priority'    => 28,
		'description' => __( 'Customize Font Family, Body & Heading (H1-H6) Sizes, Line Heights, Letter Spacing, and Section Padding/Margins.', 'rikshawale-theme' ),
	) );

	// Font Family Select
	$wp_customize->add_setting( 'typography_font_family', array(
		'default'           => 'Montserrat, Roboto, sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'typography_font_family', array(
		'type'     => 'select',
		'label'    => __( 'Primary Font Family', 'rikshawale-theme' ),
		'section'  => 'rikshawale_typography_section',
		'settings' => 'typography_font_family',
		'choices'  => array(
			'Montserrat, Roboto, sans-serif' => 'Montserrat & Roboto (Default)',
			'Inter, sans-serif'               => 'Inter',
			'Poppins, sans-serif'             => 'Poppins',
			'Outfit, sans-serif'              => 'Outfit',
			'Roboto, sans-serif'              => 'Roboto',
			'system-ui, -apple-system, sans-serif' => 'System Default',
		),
	) );

	// Body Font Size
	$wp_customize->add_setting( 'body_font_size', array( 'default' => '15px', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'body_font_size', array( 'type' => 'text', 'label' => __( 'Body Font Size (e.g. 15px)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );

	// Body Line Height
	$wp_customize->add_setting( 'body_line_height', array( 'default' => '1.6', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'body_line_height', array( 'type' => 'text', 'label' => __( 'Body Line Height (e.g. 1.6)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );

	// Body Letter Spacing
	$wp_customize->add_setting( 'body_letter_spacing', array( 'default' => '0px', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'body_letter_spacing', array( 'type' => 'text', 'label' => __( 'Body Letter Spacing (e.g. 0.2px)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );

	// H1 to H6 Sizes
	$headings = array(
		'h1_font_size' => array( 'H1 Font Size', '38px' ),
		'h2_font_size' => array( 'H2 Font Size', '30px' ),
		'h3_font_size' => array( 'H3 Font Size', '24px' ),
		'h4_font_size' => array( 'H4 Font Size', '20px' ),
		'h5_font_size' => array( 'H5 Font Size', '18px' ),
		'h6_font_size' => array( 'H6 Font Size', '16px' ),
	);
	foreach ( $headings as $setting_key => $info ) {
		$wp_customize->add_setting( $setting_key, array( 'default' => $info[1], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $setting_key, array( 'type' => 'text', 'label' => __( $info[0] . ' (e.g. ' . $info[1] . ')', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );
	}

	// Heading Line Height & Letter Spacing
	$wp_customize->add_setting( 'heading_line_height', array( 'default' => '1.2', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'heading_line_height', array( 'type' => 'text', 'label' => __( 'Headings Line Height (e.g. 1.25)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );

	$wp_customize->add_setting( 'heading_letter_spacing', array( 'default' => '0px', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'heading_letter_spacing', array( 'type' => 'text', 'label' => __( 'Headings Letter Spacing (e.g. 0.5px)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );

	// UI/UX Section Spacing
	$wp_customize->add_setting( 'section_padding_v', array( 'default' => '48px', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'section_padding_v', array( 'type' => 'text', 'label' => __( 'Section Vertical Padding (e.g. 48px)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );

	$wp_customize->add_setting( 'section_margin_b', array( 'default' => '32px', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'section_margin_b', array( 'type' => 'text', 'label' => __( 'Section Bottom Margin (e.g. 32px)', 'rikshawale-theme' ), 'section' => 'rikshawale_typography_section' ) );


	// Add Section: Top Bar Customization
	// WhatsApp Floating Button Section
	$wp_customize->add_section( 'rikshawale_whatsapp_section', array(
		'title'       => __( 'WhatsApp Floating Button', 'rikshawale-theme' ),
		'priority'    => 28,
		'description' => __( 'Configure the Admin WhatsApp Mobile Number and Floating Button settings for 1-click customer chats.', 'rikshawale-theme' ),
	) );

	// Enable WhatsApp Button Checkbox
	$wp_customize->add_setting( 'whatsapp_enable', array(
		'default'           => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'whatsapp_enable', array(
		'type'     => 'checkbox',
		'label'    => __( 'Enable Floating WhatsApp Button', 'rikshawale-theme' ),
		'section'  => 'rikshawale_whatsapp_section',
		'settings' => 'whatsapp_enable',
	) );

	// Admin WhatsApp Mobile Number
	$wp_customize->add_setting( 'whatsapp_number', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'whatsapp_number', array(
		'type'        => 'text',
		'label'       => __( 'Admin WhatsApp Mobile Number (With Country Code)', 'rikshawale-theme' ),
		'description' => __( 'Enter number with country code without + or spaces e.g. 919876543210 or 919123456789', 'rikshawale-theme' ),
		'section'     => 'rikshawale_whatsapp_section',
		'settings'    => 'whatsapp_number',
	) );

	// Preset Welcome Message Text
	$wp_customize->add_setting( 'whatsapp_message', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'whatsapp_message', array(
		'type'        => 'text',
		'label'       => __( 'Preset Greeting Message Text', 'rikshawale-theme' ),
		'description' => __( 'Default message populated when visitor opens WhatsApp chat.', 'rikshawale-theme' ),
		'section'     => 'rikshawale_whatsapp_section',
		'settings'    => 'whatsapp_message',
	) );

	$wp_customize->add_section( 'rikshawale_topbar_section', array(
		'title'       => __( 'Header Top Bar Settings', 'rikshawale-theme' ),
		'priority'    => 29,
		'description' => __( 'Configure the contact details and social icons in the Top Bar', 'rikshawale-theme' ),
	) );

	// Phone Number
	$wp_customize->add_setting( 'topbar_phone', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'topbar_phone', array(
		'type'     => 'text',
		'label'    => __( 'Phone Number', 'rikshawale-theme' ),
		'section'  => 'rikshawale_topbar_section',
		'settings' => 'topbar_phone',
	) );

	// Email Address
	$wp_customize->add_setting( 'topbar_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'topbar_email', array(
		'type'     => 'text',
		'label'    => __( 'Email Address', 'rikshawale-theme' ),
		'section'  => 'rikshawale_topbar_section',
		'settings' => 'topbar_email',
	) );

	// Address/Hours
	$wp_customize->add_setting( 'topbar_hours', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'topbar_hours', array(
		'type'     => 'text',
		'label'    => __( 'Opening Hours', 'rikshawale-theme' ),
		'section'  => 'rikshawale_topbar_section',
		'settings' => 'topbar_hours',
	) );

	// Facebook Link
	$wp_customize->add_setting( 'topbar_facebook', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'topbar_facebook', array(
		'type'     => 'text',
		'label'    => __( 'Facebook URL', 'rikshawale-theme' ),
		'section'  => 'rikshawale_topbar_section',
		'settings' => 'topbar_facebook',
	) );

	// Twitter/X Link
	$wp_customize->add_setting( 'topbar_twitter', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'topbar_twitter', array(
		'type'     => 'text',
		'label'    => __( 'Twitter/X URL', 'rikshawale-theme' ),
		'section'  => 'rikshawale_topbar_section',
		'settings' => 'topbar_twitter',
	) );

	// Instagram Link
	$wp_customize->add_setting( 'topbar_instagram', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'topbar_instagram', array(
		'type'     => 'text',
		'label'    => __( 'Instagram URL', 'rikshawale-theme' ),
		'section'  => 'rikshawale_topbar_section',
		'settings' => 'topbar_instagram',
	) );

	// Add Section: Header Customization
	$wp_customize->add_section( 'rikshawale_header_section', array(
		'title'       => __( 'Header Settings', 'rikshawale-theme' ),
		'priority'    => 30,
		'description' => __( 'Customize your header styles', 'rikshawale-theme' ),
	) );

	// Header BG Color
	$wp_customize->add_setting( 'header_bg_color', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
		'label'    => __( 'Header Background Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_header_section',
		'settings' => 'header_bg_color',
	) ) );

	// Header Text/Link Color
	$wp_customize->add_setting( 'header_text_color', array(
		'default'   => '#1a1a1a',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
		'label'    => __( 'Header Text Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_header_section',
		'settings' => 'header_text_color',
	) ) );

	// Add Section: Home Page Layout Options
	$wp_customize->add_section( 'rikshawale_homepage_layout_section', array(
		'title'       => __( 'Homepage Layout Sections', 'rikshawale-theme' ),
		'priority'    => 32,
		'description' => __( 'Enable or disable homepage layout sections', 'rikshawale-theme' ),
	) );

	// Section List array
	$homepage_sections = array(
		'show_hero_slider'    => __( 'Banner Slider', 'rikshawale-theme' ),
		'show_search_filter'  => __( 'Floating Search Widget (Hidden by default)', 'rikshawale-theme' ),
		'show_brands_section' => __( 'New Arrivals Carousel', 'rikshawale-theme' ),
		'show_about_section'  => __( 'Featured Fleet Carousel', 'rikshawale-theme' ),
		'show_vehicles_grid'  => __( 'Special Offers Carousel', 'rikshawale-theme' ),
		'show_why_choose_us'  => __( 'Why Choose Us Section', 'rikshawale-theme' ),
		'show_cta_banner'     => __( 'Call-to-Action Banner', 'rikshawale-theme' ),
		'show_testimonials'   => __( 'Testimonials Section', 'rikshawale-theme' ),
	);

	foreach ( $homepage_sections as $key => $label ) {
		$default_val = ( $key === 'show_search_filter' ) ? '0' : '1';
		$wp_customize->add_setting( $key, array(
			'default'           => $default_val,
			'sanitize_callback' => 'rikshawale_sanitize_checkbox',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $key, array(
			'type'     => 'checkbox',
			'label'    => $label,
			'section'  => 'rikshawale_homepage_layout_section',
			'settings' => $key,
		) );
	}

	// Add Section: Footer Customization
	$wp_customize->add_section( 'rikshawale_footer_section', array(
		'title'       => __( 'Footer Settings', 'rikshawale-theme' ),
		'priority'    => 33,
		'description' => __( 'Customize your footer content and styles', 'rikshawale-theme' ),
	) );

	// Footer BG Color
	$wp_customize->add_setting( 'footer_bg_color', array(
		'default'   => '#151515',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
		'label'    => __( 'Footer Background Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_bg_color',
	) ) );

	// Footer Text Color
	$wp_customize->add_setting( 'footer_text_color', array(
		'default'   => '#aaaaaa',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
		'label'    => __( 'Footer Text Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_text_color',
	) ) );

	// Footer Copyright Text Setting
	$wp_customize->add_setting( 'footer_copyright_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'footer_copyright_text', array(
		'type'     => 'text',
		'label'    => __( 'Copyright Text', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_copyright_text',
	) );

	// Footer Tagline Setting
	$wp_customize->add_setting( 'footer_tagline', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'footer_tagline', array(
		'type'     => 'text',
		'label'    => __( 'Footer Tagline', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_tagline',
	) );

	// Footer Description Setting
	$wp_customize->add_setting( 'footer_description', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'footer_description', array(
		'type'     => 'textarea',
		'label'    => __( 'Footer Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_description',
	) );

	// Footer Address Setting
	$wp_customize->add_setting( 'footer_address', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'footer_address', array(
		'type'     => 'textarea',
		'label'    => __( 'Footer Address', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_address',
	) );

	// Footer Logo Setting
	$wp_customize->add_setting( 'footer_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
		'label'    => __( 'Footer Logo', 'rikshawale-theme' ),
		'section'  => 'rikshawale_footer_section',
		'settings' => 'footer_logo',
	) ) );


	// Homepage Welcome Section
	$wp_customize->add_section( 'rikshawale_welcome_section', array(
		'title'    => __( 'Homepage Welcome & Features', 'rikshawale-theme' ),
		'priority' => 80,
	) );

	// Subtitle
	$wp_customize->add_setting( 'welcome_subtitle', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_subtitle', array(
		'type'     => 'text',
		'label'    => __( 'Subtitle', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_subtitle',
	) );

	// Title
	$wp_customize->add_setting( 'welcome_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_title', array(
		'type'     => 'text',
		'label'    => __( 'Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_title',
	) );

	// Description
	$wp_customize->add_setting( 'welcome_description', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_description', array(
		'type'     => 'textarea',
		'label'    => __( 'Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_description',
	) );

	// Slider Image 1
	$wp_customize->add_setting( 'welcome_image_1', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'welcome_image_1', array(
		'label'    => __( 'About Slider Image 1', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_image_1',
	) ) );

	// Slider Image 2
	$wp_customize->add_setting( 'welcome_image_2', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'welcome_image_2', array(
		'label'    => __( 'About Slider Image 2', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_image_2',
	) ) );

	// Slider Image 3
	$wp_customize->add_setting( 'welcome_image_3', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'welcome_image_3', array(
		'label'    => __( 'About Slider Image 3', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_image_3',
	) ) );

	// Feature 1 Title
	$wp_customize->add_setting( 'welcome_feature1_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature1_title', array(
		'type'     => 'text',
		'label'    => __( 'Feature 1 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature1_title',
	) );

	// Feature 1 Description
	$wp_customize->add_setting( 'welcome_feature1_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature1_desc', array(
		'type'     => 'text',
		'label'    => __( 'Feature 1 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature1_desc',
	) );

	// Feature 1 Icon
	$wp_customize->add_setting( 'welcome_feature1_icon', array(
		'default'           => 'fa-solid fa-car-side',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature1_icon', array(
		'type'     => 'text',
		'label'    => __( 'Feature 1 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature1_icon',
	) );

	// Feature 2 Title
	$wp_customize->add_setting( 'welcome_feature2_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature2_title', array(
		'type'     => 'text',
		'label'    => __( 'Feature 2 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature2_title',
	) );

	// Feature 2 Description
	$wp_customize->add_setting( 'welcome_feature2_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature2_desc', array(
		'type'     => 'text',
		'label'    => __( 'Feature 2 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature2_desc',
	) );

	// Feature 2 Icon
	$wp_customize->add_setting( 'welcome_feature2_icon', array(
		'default'           => 'fa-solid fa-headset',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature2_icon', array(
		'type'     => 'text',
		'label'    => __( 'Feature 2 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature2_icon',
	) );

	// Feature 3 Title
	$wp_customize->add_setting( 'welcome_feature3_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature3_title', array(
		'type'     => 'text',
		'label'    => __( 'Feature 3 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature3_title',
	) );

	// Feature 3 Description
	$wp_customize->add_setting( 'welcome_feature3_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature3_desc', array(
		'type'     => 'text',
		'label'    => __( 'Feature 3 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature3_desc',
	) );

	// Feature 3 Icon
	$wp_customize->add_setting( 'welcome_feature3_icon', array(
		'default'           => 'fa-solid fa-hotel',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature3_icon', array(
		'type'     => 'text',
		'label'    => __( 'Feature 3 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature3_icon',
	) );

	// Feature 4 Title
	$wp_customize->add_setting( 'welcome_feature4_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature4_title', array(
		'type'     => 'text',
		'label'    => __( 'Feature 4 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature4_title',
	) );

	// Feature 4 Description
	$wp_customize->add_setting( 'welcome_feature4_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature4_desc', array(
		'type'     => 'text',
		'label'    => __( 'Feature 4 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature4_desc',
	) );

	// Feature 4 Icon
	$wp_customize->add_setting( 'welcome_feature4_icon', array(
		'default'           => 'fa-solid fa-wallet',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'welcome_feature4_icon', array(
		'type'     => 'text',
		'label'    => __( 'Feature 4 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_welcome_section',
		'settings' => 'welcome_feature4_icon',
	) );

	// Homepage Extra Sections Section
	$wp_customize->add_section( 'rikshawale_extra_homepage_sections', array(
		'title'    => __( 'Homepage Additional Sections', 'rikshawale-theme' ),
		'priority' => 85,
	) );

	// 1. Contact Split-Banner Settings
	$wp_customize->add_setting( 'contact_banner_avatar', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'contact_banner_avatar', array(
		'label'    => __( 'Contact Banner Avatar Image', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'contact_banner_avatar',
	) ) );

	$wp_customize->add_setting( 'contact_banner_subtitle', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'contact_banner_subtitle', array(
		'type'     => 'text',
		'label'    => __( 'Contact Banner Subtitle', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'contact_banner_subtitle',
	) );

	$wp_customize->add_setting( 'contact_banner_left_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'contact_banner_left_img', array(
		'label'    => __( 'Contact Banner Left Vehicle Image', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'contact_banner_left_img',
	) ) );

	$wp_customize->add_setting( 'contact_banner_right_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'contact_banner_right_img', array(
		'label'    => __( 'Contact Banner Right Vehicle Image', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'contact_banner_right_img',
	) ) );

	// 2. Why Choose Us Settings
	$wp_customize->add_setting( 'why_choose_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_title', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_title',
	) );

	$wp_customize->add_setting( 'why_choose_subtitle', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_subtitle', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Subtitle', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_subtitle',
	) );

	// Column 1
	$wp_customize->add_setting( 'why_choose_box1_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box1_title', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 1 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box1_title',
	) );
	$wp_customize->add_setting( 'why_choose_box1_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box1_desc', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 1 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box1_desc',
	) );
	$wp_customize->add_setting( 'why_choose_box1_icon', array(
		'default'           => 'fa-solid fa-shield-halved',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box1_icon', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 1 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box1_icon',
	) );

	// Column 2
	$wp_customize->add_setting( 'why_choose_box2_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box2_title', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 2 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box2_title',
	) );
	$wp_customize->add_setting( 'why_choose_box2_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box2_desc', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 2 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box2_desc',
	) );
	$wp_customize->add_setting( 'why_choose_box2_icon', array(
		'default'           => 'fa-solid fa-indian-rupee-sign',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box2_icon', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 2 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box2_icon',
	) );

	// Column 3
	$wp_customize->add_setting( 'why_choose_box3_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box3_title', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 3 Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box3_title',
	) );
	$wp_customize->add_setting( 'why_choose_box3_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box3_desc', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 3 Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box3_desc',
	) );
	$wp_customize->add_setting( 'why_choose_box3_icon', array(
		'default'           => 'fa-solid fa-screwdriver-wrench',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'why_choose_box3_icon', array(
		'type'     => 'text',
		'label'    => __( 'Why Choose Col 3 Icon Class', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'why_choose_box3_icon',
	) );

	// 3. CTA Banner Settings
	$wp_customize->add_setting( 'cta_banner_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'cta_banner_title', array(
		'type'     => 'text',
		'label'    => __( 'CTA Banner Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'cta_banner_title',
	) );

	$wp_customize->add_setting( 'cta_banner_desc', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'cta_banner_desc', array(
		'type'     => 'text',
		'label'    => __( 'CTA Banner Description', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'cta_banner_desc',
	) );

	$wp_customize->add_setting( 'cta_banner_btn_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'cta_banner_btn_text', array(
		'type'     => 'text',
		'label'    => __( 'CTA Banner Button Text', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'cta_banner_btn_text',
	) );

	// 4. Testimonials Settings
	$wp_customize->add_setting( 'testimonials_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'testimonials_title', array(
		'type'     => 'text',
		'label'    => __( 'Testimonials Section Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'testimonials_title',
	) );

	$wp_customize->add_setting( 'testimonials_subtitle', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'testimonials_subtitle', array(
		'type'     => 'text',
		'label'    => __( 'Testimonials Section Subtitle', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'testimonials_subtitle',
	) );

	// Testimonials Rating Stars Options
	$wp_customize->add_setting( 'show_testimonial_stars', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'show_testimonial_stars', array(
		'type'     => 'checkbox',
		'label'    => __( 'Show Review Star Rating', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'show_testimonial_stars',
	) );

	$wp_customize->add_setting( 'testimonial_default_rating', array(
		'default'           => '5',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'testimonial_default_rating', array(
		'type'     => 'select',
		'label'    => __( 'Default Star Rating', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'testimonial_default_rating',
		'choices'  => array(
			'5'   => '5 Stars (⭐⭐⭐⭐⭐)',
			'4.5' => '4.5 Stars (⭐⭐⭐⭐½)',
			'4'   => '4 Stars (⭐⭐⭐⭐)',
			'3.5' => '3.5 Stars (⭐⭐⭐½)',
			'3'   => '3 Stars (⭐⭐⭐)',
		),
	) );

	$wp_customize->add_setting( 'testimonial_star_color', array(
		'default'           => '#ffc107',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'testimonial_star_color', array(
		'label'    => __( 'Review Star Rating Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'testimonial_star_color',
	) ) );

	/* =====================================================
	   EMI CALCULATOR SETTINGS
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_emi_calculator_section', array(
		'title'    => __( '🧮 EMI Calculator Settings', 'rikshawale-theme' ),
		'priority' => 32,
	) );

	// Default Annual Interest Rate (%)
	$wp_customize->add_setting( 'emi_interest_rate', array(
		'default'           => '11.75',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'emi_interest_rate', array(
		'label'       => __( 'Default Interest Rate (% per annum)', 'rikshawale-theme' ),
		'description' => __( 'Annual bank loan interest rate used for EMI calculation (e.g. 11.75)', 'rikshawale-theme' ),
		'section'     => 'rikshawale_emi_calculator_section',
		'type'        => 'text',
	) );

	// Minimum Down Payment %
	$wp_customize->add_setting( 'emi_min_downpayment_pct', array(
		'default'           => '20',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'emi_min_downpayment_pct', array(
		'label'       => __( 'Default Down Payment (%)', 'rikshawale-theme' ),
		'description' => __( 'Default down payment percentage of total price (e.g. 20%)', 'rikshawale-theme' ),
		'section'     => 'rikshawale_emi_calculator_section',
		'type'        => 'number',
	) );

	// Default Tenure (Years)
	$wp_customize->add_setting( 'emi_default_tenure', array(
		'default'           => '5',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'emi_default_tenure', array(
		'label'       => __( 'Default Loan Tenure (Years)', 'rikshawale-theme' ),
		'description' => __( 'Default loan tenure slider value in years (1 to 8 years)', 'rikshawale-theme' ),
		'section'     => 'rikshawale_emi_calculator_section',
		'type'        => 'number',
	) );

	// Principal Color (Chart)
	$wp_customize->add_setting( 'emi_principal_color', array(
		'default'           => '#0ea5e9',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'emi_principal_color', array(
		'label'    => __( 'Principal Amount Donut Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_emi_calculator_section',
		'settings' => 'emi_principal_color',
	) ) );

	// Interest Color (Chart)
	$wp_customize->add_setting( 'emi_interest_color', array(
		'default'           => '#fce4e4',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'emi_interest_color', array(
		'label'    => __( 'Total Interest Donut Color', 'rikshawale-theme' ),
		'section'  => 'rikshawale_emi_calculator_section',
		'settings' => 'emi_interest_color',
	) ) );

	/* =====================================================
	   HOMEPAGE PANEL & THEME OPTIONS
	   ===================================================== */
	$wp_customize->add_panel( 'rikshawale_homepage_panel', array(
		'title'       => __( 'Theme Options (Homepage Sections)', 'rikshawale-theme' ),
		'priority'    => 25,
		'description' => __( 'Manage homepage sections: Inventory, Promo Banners, 4 Videos, and New Arrivals', 'rikshawale-theme' ),
	) );

	/* =====================================================
	   1. INVENTORY SECTION (TOP CAROUSEL/GRID)
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_inventory_section', array(
		'title'    => __( '1. Inventory Section', 'rikshawale-theme' ),
		'panel'    => 'rikshawale_homepage_panel',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'inventory_subtitle', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'inventory_subtitle', array( 'type' => 'text', 'label' => 'Inventory Section Subtitle/Eyebrow', 'section' => 'rikshawale_inventory_section' ) );

	$wp_customize->add_setting( 'inventory_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'inventory_title', array( 'type' => 'text', 'label' => 'Inventory Section Title', 'section' => 'rikshawale_inventory_section' ) );

	$wp_customize->add_setting( 'inventory_description', array( 'default' => '', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'inventory_description', array( 'type' => 'textarea', 'label' => 'Inventory Section Description', 'section' => 'rikshawale_inventory_section' ) );

	/* =====================================================
	   2. PROMO BANNERS SECTION
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_promo_banners', array(
		'title'    => __( '2. Promo Image Banners', 'rikshawale-theme' ),
		'panel'    => 'rikshawale_homepage_panel',
		'priority' => 20,
	) );

	foreach ( array( 1, 2 ) as $b ) {
		$wp_customize->add_setting( "promo_banner{$b}_image", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "promo_banner{$b}_image", array( 'label' => "Banner {$b} Image Upload", 'section' => 'rikshawale_promo_banners' ) ) );
	}

	/* =====================================================
	   3. VIDEO SECTION (4 VIDEOS)
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_video_section', array(
		'title'    => __( '3. Video Section (4 Videos)', 'rikshawale-theme' ),
		'panel'    => 'rikshawale_homepage_panel',
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'video_section_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'video_section_title', array( 'type' => 'text', 'label' => 'Video Section Title', 'section' => 'rikshawale_video_section' ) );

	$wp_customize->add_setting( 'video_section_subtitle', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'video_section_subtitle', array( 'type' => 'text', 'label' => 'Video Section Subtitle', 'section' => 'rikshawale_video_section' ) );

	for ( $v = 1; $v <= 4; $v++ ) {
		$wp_customize->add_setting( "video_{$v}_url", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
		$wp_customize->add_control( "video_{$v}_url", array( 'type' => 'text', 'label' => "Video {$v} URL (Uploaded MP4 file link or YouTube video link)", 'section' => 'rikshawale_video_section' ) );

		$wp_customize->add_setting( "video_{$v}_thumb", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "video_{$v}_thumb", array( 'label' => "Video {$v} Poster Image (Optional)", 'section' => 'rikshawale_video_section' ) ) );
	}

	/* =====================================================
	   4. NEW ARRIVALS SECTION
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_new_arrivals_section', array(
		'title'    => __( '4. New Arrivals Section', 'rikshawale-theme' ),
		'panel'    => 'rikshawale_homepage_panel',
		'priority' => 40,
	) );
	$wp_customize->add_setting( 'new_arrivals_subtitle', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'new_arrivals_subtitle', array( 'type' => 'text', 'label' => 'New Arrivals Subtitle/Eyebrow', 'section' => 'rikshawale_new_arrivals_section' ) );

	$wp_customize->add_setting( 'new_arrivals_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'new_arrivals_title', array( 'type' => 'text', 'label' => 'New Arrivals Title', 'section' => 'rikshawale_new_arrivals_section' ) );

	/* =====================================================
	   SERVICES / MARKET CHALLENGES SECTION
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_services_section', array(
		'title'    => __( 'Services / Market Challenges Section', 'rikshawale-theme' ),
		'panel'    => 'rikshawale_homepage_panel',
		'priority' => 15,
	) );

	$wp_customize->add_setting( 'services_section_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'services_section_title', array(
		'type'     => 'text',
		'label'    => __( 'Services Section Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_services_section',
	) );

	$wp_customize->add_setting( 'services_insight_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'services_insight_title', array(
		'type'     => 'text',
		'label'    => __( 'Investor Insight Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_services_section',
	) );

	$wp_customize->add_setting( 'services_insight_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'services_insight_text', array(
		'type'     => 'textarea',
		'label'    => __( 'Investor Insight Description Text', 'rikshawale-theme' ),
		'section'  => 'rikshawale_services_section',
	) );

	/* =====================================================
	   FAQ SECTION
	   ===================================================== */
	$wp_customize->add_section( 'rikshawale_faq_section', array(
		'title'    => __( 'FAQ Section', 'rikshawale-theme' ),
		'panel'    => 'rikshawale_homepage_panel',
		'priority' => 50,
	) );
	$wp_customize->add_setting( 'faq_section_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'faq_section_title', array( 'type' => 'text', 'label' => 'FAQ Section Title', 'section' => 'rikshawale_faq_section' ) );
}
add_action( 'customize_register', 'rikshawale_customize_register' );

// Sanitize helper for Checkboxes
function rikshawale_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Filter Riksha Archive Query based on search parameters
 */
function rikshawale_filter_riksha_archive( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'riksha' ) || is_tax( array( 'riksha_brand', 'riksha_type' ) ) ) ) {
        $meta_query = array();
        $tax_query = array();

        if ( ! empty( $_GET['riksha_brand'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'riksha_brand',
                'field'    => 'slug',
                'terms'    => sanitize_text_field( $_GET['riksha_brand'] ),
            );
        }

        if ( ! empty( $_GET['riksha_fuel'] ) ) {
            $meta_query[] = array(
                'key'     => '_riksha_fuel',
                'value'   => sanitize_text_field( $_GET['riksha_fuel'] ),
                'compare' => '=',
            );
        }

        if ( ! empty( $tax_query ) ) {
            $query->set( 'tax_query', $tax_query );
        }
        if ( ! empty( $meta_query ) ) {
            $query->set( 'meta_query', $meta_query );
        }
    }
}
add_action( 'pre_get_posts', 'rikshawale_filter_riksha_archive' );

/**
 * Register Footer Widget Areas
 */
function rikshawale_footer_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 1', 'rikshawale-theme' ),
        'id'            => 'footer-widget-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer column 1.', 'rikshawale-theme' ),
        'before_widget' => '<div class="col-lg-2 col-md-4 col-sm-6 mb-4 footer-widget"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h5 class="fw-bold mb-3 text-white">',
        'after_title'   => '</h5>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 2', 'rikshawale-theme' ),
        'id'            => 'footer-widget-2',
        'description'   => esc_html__( 'Add widgets here to appear in your footer column 2.', 'rikshawale-theme' ),
        'before_widget' => '<div class="col-lg-2 col-md-4 col-sm-6 mb-4 footer-widget"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h5 class="fw-bold mb-3 text-white">',
        'after_title'   => '</h5>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 3', 'rikshawale-theme' ),
        'id'            => 'footer-widget-3',
        'description'   => esc_html__( 'Add widgets here to appear in your footer column 3.', 'rikshawale-theme' ),
        'before_widget' => '<div class="col-lg-2 col-md-4 col-sm-6 mb-4 footer-widget"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h5 class="fw-bold mb-3 text-white">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'rikshawale_footer_widgets_init' );

/* ============================================================
   SELL A CAR — Custom Post Type: car_submission
   ============================================================ */

function rikshawale_register_car_submission_cpt() {
    register_post_type( 'car_submission', array(
        'labels' => array(
            'name'               => __( 'Car Submissions', 'rikshawale-theme' ),
            'singular_name'      => __( 'Car Submission', 'rikshawale-theme' ),
            'menu_name'          => __( 'Sell Requests', 'rikshawale-theme' ),
            'add_new_item'       => __( 'Add New Submission', 'rikshawale-theme' ),
            'edit_item'          => __( 'Review Submission', 'rikshawale-theme' ),
            'all_items'          => __( 'All Submissions', 'rikshawale-theme' ),
            'not_found'          => __( 'No submissions found.', 'rikshawale-theme' ),
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'menu_icon'         => 'dashicons-car',
        'menu_position'     => 9,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'supports'          => array( 'title', 'custom-fields' ),
        'show_in_rest'      => false,
    ) );
}
add_action( 'init', 'rikshawale_register_car_submission_cpt' );

/* ============================================================
   SELL A CAR — Front-end AJAX Form Handler
   ============================================================ */

function rikshawale_handle_sell_car_submission() {
    // Verify nonce
    if ( ! isset( $_POST['rikshawale_sell_car_nonce'] ) ||
         ! wp_verify_nonce( $_POST['rikshawale_sell_car_nonce'], 'rikshawale_sell_car_action' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed. Please refresh and try again.' ) );
    }

    // Sanitize text fields
    $seller_name   = sanitize_text_field( $_POST['seller_name']   ?? '' );
    $seller_phone  = sanitize_text_field( $_POST['seller_phone']  ?? '' );
    $seller_wa     = sanitize_text_field( $_POST['seller_wa']     ?? '' );
    $seller_city   = sanitize_text_field( $_POST['seller_city']   ?? '' );
    $seller_city   = ucwords(strtolower($seller_city));
    
    $seller_reg_no = sanitize_text_field( $_POST['seller_reg_no'] ?? '' );
    $seller_state  = sanitize_text_field( $_POST['seller_state']  ?? '' );

    $mfg_year      = sanitize_text_field( $_POST['riksha_mfg_year']       ?? $_POST['car_mfg_year']       ?? '' );
    $reg_year      = sanitize_text_field( $_POST['riksha_reg_year']       ?? $_POST['car_reg_year']       ?? '' );
    $owner_type    = sanitize_text_field( $_POST['riksha_owner_type']     ?? $_POST['car_owner_type']     ?? '' );
    
    $brand_name    = sanitize_text_field( $_POST['riksha_brand_name']    ?? $_POST['car_brand_name']     ?? '' );
    $brand_name    = ucwords(strtolower($brand_name));
    
    $model_name    = sanitize_text_field( $_POST['riksha_model_name']    ?? $_POST['car_model_name']     ?? '' );
    $model_name    = ucwords(strtolower($model_name));
    
    $variant       = sanitize_text_field( $_POST['riksha_variant']       ?? $_POST['car_variant']        ?? '' );
    $variant       = ucwords(strtolower($variant));
    
    $driven_km     = sanitize_text_field( $_POST['riksha_driven_km']     ?? $_POST['car_driven_km']      ?? '' );
    $fuel          = sanitize_text_field( $_POST['riksha_fuel']          ?? $_POST['car_fuel']           ?? '' );
    $transmission  = sanitize_text_field( $_POST['riksha_transmission']  ?? $_POST['car_transmission']   ?? '' );
    $exp_price     = sanitize_text_field( $_POST['riksha_expected_price']?? $_POST['car_expected_price'] ?? '' );
    
    // EV & Condition Fields
    $battery_type        = sanitize_text_field( $_POST['riksha_battery_type'] ?? '' );
    $battery_age_years   = floatval( $_POST['riksha_battery_age'] ?? 0 );
    $battery_condition   = sanitize_text_field( $_POST['riksha_battery_condition'] ?? 'Good' );
    $battery_replaced    = sanitize_text_field( $_POST['riksha_battery_replaced'] ?? 'No' );
    $motor_condition     = sanitize_text_field( $_POST['riksha_motor_condition'] ?? 'Good' );
    $vehicle_condition   = sanitize_text_field( $_POST['riksha_vehicle_condition'] ?? 'Good' );
    $accident_history    = sanitize_text_field( $_POST['riksha_accident_history'] ?? 'No' );
    $original_price      = floatval( $_POST['riksha_original_price'] ?? 0 );

    $video_url_input = sanitize_text_field( $_POST['riksha_video_url'] ?? '' );
    $has_video_file  = ! empty( $_FILES['riksha_video_file']['name'] );

    // Required field check
    if ( empty($seller_name) || empty($seller_phone) || empty($brand_name) || empty($model_name) ) {
        wp_send_json_error( array( 'message' => 'Please fill all required fields.' ) );
    }

    // Create the submission post (pending review)
    $post_title = $brand_name . ' ' . $model_name . ' — ' . $seller_name;
    $post_id = wp_insert_post( array(
        'post_type'   => 'car_submission',
        'post_title'  => $post_title,
        'post_status' => 'pending',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Could not save submission. Please try again.' ) );
    }

    // Save all meta
    $meta = array(
        '_seller_name'         => $seller_name,
        '_seller_phone'        => $seller_phone,
        '_seller_whatsapp'     => $seller_wa,
        '_seller_city'         => $seller_city,
        '_seller_reg_no'       => $seller_reg_no,
        '_seller_state'        => $seller_state,
        '_car_mfg_year'        => $mfg_year,
        '_car_reg_year'        => $reg_year,
        '_car_owner_type'      => $owner_type,
        '_riksha_brand_name'   => $brand_name,
        '_car_brand_name'      => $brand_name,
        '_car_model_name'      => $model_name,
        '_car_variant'         => $variant,
        '_car_driven_km'       => $driven_km,
        '_car_fuel'            => $fuel,
        '_car_transmission'    => $transmission,
        '_car_expected_price'  => $exp_price,
        '_car_battery_type'    => $battery_type,
        '_car_battery_age'     => $battery_age_years,
        '_car_battery_condition'=> $battery_condition,
        '_car_battery_replaced'=> $battery_replaced,
        '_car_motor_condition' => $motor_condition,
        '_car_vehicle_condition'=> $vehicle_condition,
        '_car_accident_history'=> $accident_history,
        '_car_original_price'  => $original_price,
    );
    foreach ( $meta as $key => $val ) {
        update_post_meta( $post_id, $key, $val );
    }

    // Handle up to 5 image uploads
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
    }

    $upload_overrides = array( 'test_form' => false );
    for ( $i = 1; $i <= 5; $i++ ) {
        $file_key = ! empty( $_FILES['riksha_image_' . $i]['name'] ) ? 'riksha_image_' . $i : 'car_image_' . $i;
        if ( ! empty( $_FILES[ $file_key ]['name'] ) ) {
            $uploaded = wp_handle_upload( $_FILES[ $file_key ], $upload_overrides );
            if ( isset( $uploaded['url'] ) ) {
                // Attach to post
                $attachment_id = wp_insert_attachment( array(
                    'post_mime_type' => $uploaded['type'],
                    'post_title'     => sanitize_file_name( $_FILES[ $file_key ]['name'] ),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                ), $uploaded['file'], $post_id );
                if ( ! is_wp_error( $attachment_id ) ) {
                    $attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded['file'] );
                    wp_update_attachment_metadata( $attachment_id, $attach_data );
                    update_post_meta( $post_id, '_car_gallery_image_' . $i, $uploaded['url'] );
                    // Set first image as featured
                    if ( $i === 1 ) {
                        set_post_thumbnail( $post_id, $attachment_id );
                    }
                }
            }
        }
    }

    // Handle Video File Upload or YouTube Link
    $video_url_field = isset( $_POST['riksha_video_url'] ) ? esc_url_raw( wp_unslash( $_POST['riksha_video_url'] ) ) : '';
    $final_video_url = '';
    if ( ! empty( $_FILES['riksha_video_file']['name'] ) ) {
        $uploaded_video = wp_handle_upload( $_FILES['riksha_video_file'], $upload_overrides );
        if ( isset( $uploaded_video['url'] ) ) {
            $final_video_url = $uploaded_video['url'];
            wp_insert_attachment( array(
                'post_mime_type' => $uploaded_video['type'],
                'post_title'     => sanitize_file_name( $_FILES['riksha_video_file']['name'] ),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ), $uploaded_video['file'], $post_id );
        }
    }
    if ( empty( $final_video_url ) && ! empty( $video_url_field ) ) {
        $final_video_url = $video_url_field;
    }
    if ( ! empty( $final_video_url ) ) {
        update_post_meta( $post_id, '_car_video_url', $final_video_url );
    }

    // Send admin notification email
    // Parse driven km to integer
    $parsed_kms_driven = 10000;
    if ( strpos( $driven_km, 'Less than 10,000' ) !== false ) $parsed_kms_driven = 5000;
    elseif ( strpos( $driven_km, '10,000' ) !== false && strpos( $driven_km, '25,000' ) !== false ) $parsed_kms_driven = 17500;
    elseif ( strpos( $driven_km, '25,000' ) !== false && strpos( $driven_km, '50,000' ) !== false ) $parsed_kms_driven = 37500;
    elseif ( strpos( $driven_km, '50,000' ) !== false && strpos( $driven_km, '75,000' ) !== false ) $parsed_kms_driven = 62500;
    elseif ( strpos( $driven_km, '75,000' ) !== false && strpos( $driven_km, '1,00,000' ) !== false ) $parsed_kms_driven = 87500;
    elseif ( strpos( $driven_km, 'More than 1,00,000' ) !== false ) $parsed_kms_driven = 120000;
    else {
        $num = (int) filter_var($driven_km, FILTER_SANITIZE_NUMBER_INT);
        if ($num > 0) $parsed_kms_driven = $num;
    }

    // Parse owners to integer
    $parsed_owners = 1;
    if ( strpos( strtolower($owner_type), '1st' ) !== false ) $parsed_owners = 1;
    elseif ( strpos( strtolower($owner_type), '2nd' ) !== false ) $parsed_owners = 2;
    elseif ( strpos( strtolower($owner_type), '3rd' ) !== false ) $parsed_owners = 3;
    elseif ( strpos( strtolower($owner_type), '4th' ) !== false ) $parsed_owners = 4;
    else {
        $num = (int) filter_var($owner_type, FILTER_SANITIZE_NUMBER_INT);
        if ($num > 0) $parsed_owners = $num;
    }

    $api_payload = array(
        'brand' => $brand_name,
        'city' => $seller_city,
        'kms_driven' => $parsed_kms_driven,
        'manufacturing_year' => (int) $mfg_year,
        'model' => $model_name,
        'number_of_owners' => $parsed_owners,
        'registration_year' => (int) $reg_year,
        'variant' => $variant ? $variant : 'Passenger',
        'motor_condition' => $motor_condition,
        'vehicle_condition' => $vehicle_condition,
    );
    
    // Add EV and other detailed fields if provided
    if ( strtolower($fuel) === 'electric' ) {
        if ( !empty($battery_type) ) $api_payload['battery_type'] = $battery_type;
        if ( $battery_age_years > 0 ) $api_payload['battery_age_years'] = $battery_age_years;
        if ( !empty($battery_condition) ) $api_payload['battery_condition'] = $battery_condition;
        if ( !empty($battery_replaced) ) $api_payload['battery_replaced'] = $battery_replaced;
    }
    
    if ( $original_price > 0 ) $api_payload['original_ex_showroom_price'] = $original_price;
    if ( !empty($accident_history) ) $api_payload['accident_history'] = $accident_history;

    $api_response = wp_remote_post( 'https://ai-ev.questdigiflex.in/api/predict', array(
        'body'    => wp_json_encode( $api_payload ),
        'headers' => array( 'Content-Type' => 'application/json' ),
        'timeout' => 15,
        'sslverify' => false
    ));

    $ai_res = null;
    $api_data_for_frontend = null;

    if ( ! is_wp_error( $api_response ) ) {
        $body = wp_remote_retrieve_body( $api_response );
        $api_data = json_decode( $body, true );
        
        if ( !empty($api_data) && isset($api_data['status']) && $api_data['status'] === 'SUCCESS' ) {
            $api_data_for_frontend = $api_data;
            
            $min_price = $api_data['price_range']['min_estimated_price'];
            $max_price = $api_data['price_range']['max_estimated_price'];
            $summary = implode(" ", $api_data['key_factors']);
            
            update_post_meta( $post_id, '_car_ai_valuation_min', $min_price );
            update_post_meta( $post_id, '_car_ai_valuation_max', $max_price );
            update_post_meta( $post_id, '_car_ai_condition_score', 8.5 );
            update_post_meta( $post_id, '_car_ai_summary', $summary );
            update_post_meta( $post_id, '_car_indicative_price', $api_data['formatted_price'] );
            if ( isset($api_data['depreciation_percentage']) ) {
                update_post_meta( $post_id, '_car_ai_depreciation', $api_data['depreciation_percentage'] );
            }
            
            $ai_res = array(
                'indicative_price' => $api_data['formatted_price'],
                'condition_score'  => 8.5
            );
        }
    }

    if ( ! $ai_res ) {
        $ai_res = rikshawale_calculate_ai_valuation_internal( $brand_name, $model_name, $mfg_year, $driven_km, $fuel, $owner_type, $_FILES );
        if ( $ai_res ) {
            update_post_meta( $post_id, '_car_ai_valuation_min', $ai_res['min_price'] );
            update_post_meta( $post_id, '_car_ai_valuation_max', $ai_res['max_price'] );
            update_post_meta( $post_id, '_car_ai_condition_score', $ai_res['condition_score'] );
            update_post_meta( $post_id, '_car_ai_summary', $ai_res['summary'] );
            update_post_meta( $post_id, '_car_indicative_price', $ai_res['indicative_price'] );
            
            $debug_msg = 'API Failed. ';
            if ( is_wp_error($api_response) ) {
                $debug_msg .= 'WP Error: ' . $api_response->get_error_message();
            } else {
                $debug_msg .= 'Status Code: ' . wp_remote_retrieve_response_code($api_response) . '. Body: ' . wp_remote_retrieve_body($api_response);
            }
            
            $api_data_for_frontend = array(
                'status' => 'FALLBACK',
                'formatted_price' => $ai_res['indicative_price'],
                'formatted_price_range' => array(
                    'min' => 'Rs. ' . number_format($ai_res['min_price']),
                    'max' => 'Rs. ' . number_format($ai_res['max_price'])
                ),
                'key_factors' => array($ai_res['summary'], '<strong>DEBUG:</strong> ' . $debug_msg, 'Payload: ' . json_encode($api_payload)),
                'condition_score' => $ai_res['condition_score']
            );
        }
    }

    $admin_email = get_option( 'admin_email' );
    $subject = 'New Sell Car Request: ' . $post_title;
    $body  = "New sell car submission received!\n\n";
    $body .= "Seller: {$seller_name}\nPhone: {$seller_phone}\nWhatsApp: {$seller_wa}\nCity: {$seller_city}\nState: {$seller_state}\n\n";
    $body .= "Vehicle: {$brand_name} {$model_name} {$variant}\nMfg Year: {$mfg_year}\nReg Year: {$reg_year}\nOwner: {$owner_type}\n";
    $body .= "Driven: {$driven_km}\nFuel: {$fuel}\nTransmission: {$transmission}\nExpected Price: {$exp_price}\n\n";
    if ( $ai_res ) {
        $body .= "AI Indicative Valuation: {$ai_res['indicative_price']} (Condition Score: {$ai_res['condition_score']}/10)\n\n";
    }
    $body .= "Review in admin: " . admin_url( 'post.php?post=' . $post_id . '&action=edit' );
    wp_mail( $admin_email, $subject, $body );

    wp_send_json_success( array(
        'message' => 'Thank you! Your request has been submitted. Our team will contact you shortly.',
        'ai_data' => $api_data_for_frontend
    ) );
}
add_action( 'wp_ajax_rikshawale_sell_car',        'rikshawale_handle_sell_car_submission' );
add_action( 'wp_ajax_nopriv_rikshawale_sell_car', 'rikshawale_handle_sell_car_submission' );

function rikshawale_handle_get_valuation() {
    $brand_name    = sanitize_text_field( $_POST['riksha_brand_name'] ?? $_POST['car_brand_name'] ?? '' );
    $brand_name    = ucwords(strtolower($brand_name));
    
    $model_name    = sanitize_text_field( $_POST['riksha_model_name'] ?? $_POST['car_model_name'] ?? '' );
    $model_name    = ucwords(strtolower($model_name));
    
    $mfg_year      = sanitize_text_field( $_POST['riksha_mfg_year']   ?? $_POST['car_mfg_year']   ?? '' );
    $reg_year      = sanitize_text_field( $_POST['riksha_reg_year']   ?? $_POST['car_reg_year']   ?? '' );
    $owner_type    = sanitize_text_field( $_POST['riksha_owner_type'] ?? $_POST['car_owner_type'] ?? '' );
    $variant       = sanitize_text_field( $_POST['riksha_variant']    ?? $_POST['car_variant']    ?? '' );
    $variant       = ucwords(strtolower($variant));
    
    $driven_km     = sanitize_text_field( $_POST['riksha_driven_km']  ?? $_POST['car_driven_km']  ?? '' );
    
    $seller_city   = sanitize_text_field( $_POST['seller_city']       ?? '' );
    $seller_city   = ucwords(strtolower($seller_city));
    
    $fuel          = sanitize_text_field( $_POST['riksha_fuel']       ?? '' );
    
    // EV Specific and Condition Fields
    $battery_type        = sanitize_text_field( $_POST['riksha_battery_type'] ?? '' );
    $battery_age_years   = floatval( $_POST['riksha_battery_age'] ?? 0 );
    $battery_condition   = sanitize_text_field( $_POST['riksha_battery_condition'] ?? 'Good' );
    $battery_replaced    = sanitize_text_field( $_POST['riksha_battery_replaced'] ?? 'No' );
    $motor_condition     = sanitize_text_field( $_POST['riksha_motor_condition'] ?? 'Good' );
    $vehicle_condition   = sanitize_text_field( $_POST['riksha_vehicle_condition'] ?? 'Good' );
    $accident_history    = sanitize_text_field( $_POST['riksha_accident_history'] ?? 'No' );
    $original_price      = floatval( $_POST['riksha_original_price'] ?? 0 );
    
    // Parse driven km to integer
    $parsed_kms_driven = 10000;
    if ( strpos( $driven_km, 'Less than 10,000' ) !== false ) $parsed_kms_driven = 5000;
    elseif ( strpos( $driven_km, '10,000' ) !== false && strpos( $driven_km, '25,000' ) !== false ) $parsed_kms_driven = 17500;
    elseif ( strpos( $driven_km, '25,000' ) !== false && strpos( $driven_km, '50,000' ) !== false ) $parsed_kms_driven = 37500;
    elseif ( strpos( $driven_km, '50,000' ) !== false && strpos( $driven_km, '75,000' ) !== false ) $parsed_kms_driven = 62500;
    elseif ( strpos( $driven_km, '75,000' ) !== false && strpos( $driven_km, '1,00,000' ) !== false ) $parsed_kms_driven = 87500;
    elseif ( strpos( $driven_km, 'More than 1,00,000' ) !== false ) $parsed_kms_driven = 120000;
    else {
        $num = (int) filter_var($driven_km, FILTER_SANITIZE_NUMBER_INT);
        if ($num > 0) $parsed_kms_driven = $num;
    }

    // Parse owners to integer
    $parsed_owners = 1;
    if ( strpos( strtolower($owner_type), '1st' ) !== false ) $parsed_owners = 1;
    elseif ( strpos( strtolower($owner_type), '2nd' ) !== false ) $parsed_owners = 2;
    elseif ( strpos( strtolower($owner_type), '3rd' ) !== false ) $parsed_owners = 3;
    elseif ( strpos( strtolower($owner_type), '4th' ) !== false ) $parsed_owners = 4;
    else {
        $num = (int) filter_var($owner_type, FILTER_SANITIZE_NUMBER_INT);
        if ($num > 0) $parsed_owners = $num;
    }

    $api_payload = array(
        'brand' => $brand_name,
        'city' => $seller_city,
        'kms_driven' => $parsed_kms_driven,
        'manufacturing_year' => (int) $mfg_year,
        'model' => $model_name,
        'number_of_owners' => $parsed_owners,
        'registration_year' => (int) $reg_year,
        'variant' => $variant ? $variant : 'Passenger',
        'motor_condition' => $motor_condition,
        'vehicle_condition' => $vehicle_condition,
    );
    
    // Add EV and other detailed fields if provided
    if ( strtolower($fuel) === 'electric' ) {
        if ( !empty($battery_type) ) $api_payload['battery_type'] = $battery_type;
        if ( $battery_age_years > 0 ) $api_payload['battery_age_years'] = $battery_age_years;
        if ( !empty($battery_condition) ) $api_payload['battery_condition'] = $battery_condition;
        if ( !empty($battery_replaced) ) $api_payload['battery_replaced'] = $battery_replaced;
    }
    
    if ( $original_price > 0 ) $api_payload['original_ex_showroom_price'] = $original_price;
    if ( !empty($accident_history) ) $api_payload['accident_history'] = $accident_history;

    $api_response = wp_remote_post( 'https://ai-ev.questdigiflex.in/api/predict', array(
        'body'    => wp_json_encode( $api_payload ),
        'headers' => array( 'Content-Type' => 'application/json' ),
        'timeout' => 15,
        'sslverify' => false
    ));

    $api_data_for_frontend = null;

    if ( ! is_wp_error( $api_response ) ) {
        $body = wp_remote_retrieve_body( $api_response );
        $api_data = json_decode( $body, true );
        
        if ( !empty($api_data) && isset($api_data['status']) && $api_data['status'] === 'SUCCESS' ) {
            $api_data_for_frontend = $api_data;
            // API doesn't return a condition score, but frontend expects it
            $api_data_for_frontend['condition_score'] = 8.5;
            wp_send_json_success( array( 'ai_data' => $api_data_for_frontend ) );
        }
    }
    
    // Fallback if API fails
    $ai_res = rikshawale_calculate_ai_valuation_internal( $brand_name, $model_name, $mfg_year, $driven_km, 'Electric', $owner_type, array() );
    if ( $ai_res ) {
        $api_data_for_frontend = array(
            'status' => 'FALLBACK',
            'formatted_price' => $ai_res['indicative_price'],
            'formatted_price_range' => array(
                'min' => 'Rs. ' . number_format($ai_res['min_price']),
                'max' => 'Rs. ' . number_format($ai_res['max_price'])
            ),
            'key_factors' => array($ai_res['summary']),
            'condition_score' => $ai_res['condition_score']
        );
        wp_send_json_success( array( 'ai_data' => $api_data_for_frontend ) );
    }

    wp_send_json_error( array( 'message' => 'Could not calculate valuation.' ) );
}
add_action( 'wp_ajax_rikshawale_get_valuation',        'rikshawale_handle_get_valuation' );
add_action( 'wp_ajax_nopriv_rikshawale_get_valuation', 'rikshawale_handle_get_valuation' );

/* ============================================================
   AI VALUATION & GEMINI API INTEGRATION ENGINE
   ============================================================ */

/**
 * Register Admin Settings Page for Gemini API Key
 */
function rikshawale_ai_settings_menu() {
    add_options_page(
        'Rikshawale AI Valuation Settings',
        'Rikshawale AI Valuation',
        'manage_options',
        'rikshawale-ai-settings',
        'rikshawale_render_ai_settings_page'
    );
}
add_action( 'admin_menu', 'rikshawale_ai_settings_menu' );

function rikshawale_render_ai_settings_page() {
    if ( isset($_POST['rikshawale_save_ai_settings']) && check_admin_referer('rikshawale_ai_settings_nonce') ) {
        $api_key = sanitize_text_field($_POST['rikshawale_gemini_api_key']);
        update_option('rikshawale_gemini_api_key', $api_key);
        echo '<div class="updated"><p><strong>Google Gemini API Key saved successfully!</strong></p></div>';
    }
    $current_key = get_option('rikshawale_gemini_api_key', '');
    ?>
    <div class="wrap" style="max-width:850px; background:#fff; padding:25px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.05); margin-top:20px;">
        <h1 style="color:#1e293b; font-weight:700; margin-bottom:10px;">🤖 Rikshawale AI Valuation Settings</h1>
        <p style="color:#64748b; font-size:14px; margin-bottom:20px;">
            Configure Google Gemini AI Vision API to enable automatic Rickshaw condition score and fair valuation on your website form.
        </p>

        <form method="post" action="">
            <?php wp_nonce_field('rikshawale_ai_settings_nonce'); ?>
            <table class="form-table" style="margin-bottom:20px;">
                <tr>
                    <th scope="row" style="width:200px;">
                        <label for="rikshawale_gemini_api_key" style="font-weight:600;">Google Gemini API Key</label>
                    </th>
                    <td>
                        <input type="text" id="rikshawale_gemini_api_key" name="rikshawale_gemini_api_key" 
                               value="<?php echo esc_attr($current_key); ?>" 
                               class="regular-text" placeholder="AIzaSy..." style="width:100%; max-width:500px; padding:8px 12px; font-family:monospace;">
                        <p class="description" style="margin-top:6px;">
                            Paste your free Google Gemini API key from <a href="https://aistudio.google.com/app/apikey" target="_blank" style="color:#db2d2e; font-weight:600;">Google AI Studio</a>.
                        </p>
                    </td>
                </tr>
            </table>

            <div style="display:flex; gap:12px; align-items:center;">
                <input type="submit" name="rikshawale_save_ai_settings" class="button button-primary" value="Save API Key" style="background:#db2d2e; border-color:#db2d2e; font-weight:600; padding:6px 20px;">
                <?php if ( ! empty($current_key) ) : ?>
                    <span style="color:#16a34a; font-weight:600; font-size:13px;">✅ API Key Configured</span>
                <?php else : ?>
                    <span style="color:#dc2626; font-weight:600; font-size:13px;">⚠️ API Key Missing (Fallback engine will be used)</span>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php
}

/**
 * Core Internal Function: Calculate AI Rickshaw Valuation & Vision Analysis
 */
function rikshawale_calculate_ai_valuation_internal($brand, $model, $mfg_year, $driven_km, $fuel, $owner_type, $files = array()) {
    $brand       = sanitize_text_field( $brand );
    $model       = sanitize_text_field( $model );
    $mfg_year    = (int) ( $mfg_year ?: date('Y') );
    $driven_km   = sanitize_text_field( $driven_km );
    $fuel        = sanitize_text_field( $fuel );
    $owner_type  = sanitize_text_field( $owner_type );

    // 1. Algorithmic Base Price Valuation Engine
    $brand_base_prices = array(
        'bajaj'     => 250000,
        'mahindra'  => 270000,
        'piaggio'   => 260000,
        'atul'      => 240000,
        'tvs'       => 250000,
        'saarthi'   => 150000,
        'champion'  => 160000,
    );

    $lower_brand = strtolower( $brand );
    $base_price = 230000;
    foreach ( $brand_base_prices as $b_key => $b_price ) {
        if ( strpos( $lower_brand, $b_key ) !== false ) {
            $base_price = $b_price;
            break;
        }
    }

    // Age Depreciation
    $current_year = (int) date('Y');
    $age = max(0, $current_year - $mfg_year);
    $depreciation_rate = min(0.72, $age * 0.085);
    $depreciated_price = $base_price * ( 1 - $depreciation_rate );

    // Driven KM Modifier
    $km_modifier = 1.0;
    if ( strpos( $driven_km, 'Less than 10,000' ) !== false ) {
        $km_modifier = 1.05;
    } elseif ( strpos( $driven_km, '10,000' ) !== false ) {
        $km_modifier = 1.0;
    } elseif ( strpos( $driven_km, '25,000' ) !== false ) {
        $km_modifier = 0.92;
    } elseif ( strpos( $driven_km, '50,000' ) !== false ) {
        $km_modifier = 0.84;
    } elseif ( strpos( $driven_km, '75,000' ) !== false ) {
        $km_modifier = 0.76;
    } elseif ( strpos( $driven_km, '1,00,000' ) !== false || strpos( $driven_km, 'More than' ) !== false ) {
        $km_modifier = 0.68;
    }

    // Owner Modifier
    $owner_modifier = 1.0;
    if ( strpos( $owner_type, '1st' ) !== false )      { $owner_modifier = 1.04; }
    elseif ( strpos( $owner_type, '2nd' ) !== false ) { $owner_modifier = 0.98; }
    elseif ( strpos( $owner_type, '3rd' ) !== false ) { $owner_modifier = 0.90; }
    elseif ( strpos( $owner_type, '4th' ) !== false ) { $owner_modifier = 0.82; }

    // Fuel Modifier
    $fuel_modifier = 1.0;
    if ( strtolower($fuel) === 'cng' )           { $fuel_modifier = 1.03; }
    elseif ( strtolower($fuel) === 'electric' )  { $fuel_modifier = 0.96; }
    elseif ( strtolower($fuel) === 'diesel' )    { $fuel_modifier = 1.00; }

    $calculated_fair = $depreciated_price * $km_modifier * $owner_modifier * $fuel_modifier;

    $condition_score = 8.0;
    $ai_used = false;
    $ai_summary = "Evaluated based on vehicle specifications, age, mileage, and brand resale data.";

    // 2. Check Gemini API & Image Vision
    $api_key = get_option('rikshawale_gemini_api_key', '');
    
    $images_data = array();
    for ( $i = 1; $i <= 5; $i++ ) {
        $file_item = ! empty( $files['riksha_image_' . $i]['tmp_name'] ) ? $files['riksha_image_' . $i] : ( $files['car_image_' . $i] ?? array() );
        if ( ! empty( $file_item['tmp_name'] ) ) {
            $tmp_path = $file_item['tmp_name'];
            $mime = $file_item['type'] ?: 'image/jpeg';
            $data = @file_get_contents($tmp_path);
            if ( $data ) {
                $images_data[] = array(
                    'mime' => $mime,
                    'b64'  => base64_encode($data)
                );
            }
        }
    }

    if ( ! empty( $api_key ) && ! empty( $images_data ) ) {
        $endpoints = array(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . urlencode($api_key),
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . urlencode($api_key),
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-lite-latest:generateContent?key=' . urlencode($api_key)
        );

        $prompt_text = "You are an expert commercial Rickshaw / Auto valuation specialist in India. "
                     . "Analyze the attached Rickshaw image(s) along with these vehicle details: "
                     . "Brand: {$brand}, Model: {$model}, Mfg Year: {$mfg_year}, Driven: {$driven_km}, Fuel: {$fuel}, Owner: {$owner_type}. "
                     . "Visually inspect the exterior body condition, paint shine, dents/scratches, rust, hood cover, and tires. "
                     . "Provide a JSON response ONLY in this exact structure without markdown formatting: "
                     . '{"condition_score": 8.5, "condition_label": "Good Exterior", "multiplier": 1.02, "summary": "Clean body with minimal paint scratches, good tire tread."}';

        $parts = array( array( 'text' => $prompt_text ) );

        foreach ( $images_data as $img ) {
            $parts[] = array(
                'inline_data' => array(
                    'mime_type' => $img['mime'],
                    'data'      => $img['b64']
                )
            );
        }

        $request_body = json_encode( array(
            'contents' => array( array( 'parts' => $parts ) )
        ) );

        foreach ( $endpoints as $endpoint ) {
            $response = wp_remote_post( $endpoint, array(
                'headers' => array( 'Content-Type' => 'application/json' ),
                'body'    => $request_body,
                'timeout' => 15,
            ) );

            if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
                $res_body = json_decode( wp_remote_retrieve_body( $response ), true );
                if ( isset( $res_body['candidates'][0]['content']['parts'][0]['text'] ) ) {
                    $raw_text = $res_body['candidates'][0]['content']['parts'][0]['text'];
                    $clean_json = preg_replace('/^```(?:json)?\s*|\s*```$/i', '', trim($raw_text));
                    $ai_res = json_decode( $clean_json, true );

                    if ( $ai_res && isset($ai_res['condition_score']) ) {
                        $condition_score = (float) $ai_res['condition_score'];
                        $ai_summary = sanitize_text_field( $ai_res['summary'] ?? $ai_summary );
                        if ( isset($ai_res['multiplier']) && is_numeric($ai_res['multiplier']) ) {
                            $calculated_fair = $calculated_fair * (float) $ai_res['multiplier'];
                        }
                        $ai_used = true;
                        break; // Exit loop on successful response
                    }
                }
            }
        }
    }

    $min_price = max( 25000, round( $calculated_fair * 0.94 / 1000 ) * 1000 );
    $max_price = max( 30000, round( $calculated_fair * 1.06 / 1000 ) * 1000 );
    $indicative_price = '₹' . number_format( $min_price ) . ' – ₹' . number_format( $max_price );

    return array(
        'min_price'        => $min_price,
        'max_price'        => $max_price,
        'indicative_price' => $indicative_price,
        'condition_score'  => number_format( $condition_score, 1 ),
        'summary'          => $ai_summary,
        'ai_used'          => $ai_used,
    );
}

/**
 * AJAX Action: Calculate AI Rickshaw Valuation
 */
function rikshawale_ajax_ai_valuation_handler() {
    $res = rikshawale_calculate_ai_valuation_internal(
        $_POST['brand'] ?? '',
        $_POST['model'] ?? '',
        $_POST['mfg_year'] ?? date('Y'),
        $_POST['driven_km'] ?? '',
        $_POST['fuel'] ?? '',
        $_POST['owner_type'] ?? '',
        $_FILES
    );

    wp_send_json_success( array(
        'min_price'       => $res['min_price'],
        'max_price'       => $res['max_price'],
        'formatted_min'   => '₹' . number_format( $res['min_price'] ),
        'formatted_max'   => '₹' . number_format( $res['max_price'] ),
        'condition_score' => $res['condition_score'],
        'summary'         => $res['summary'],
        'ai_used'         => $res['ai_used'],
    ) );
}
add_action( 'wp_ajax_rikshawale_ai_valuation',        'rikshawale_ajax_ai_valuation_handler' );
add_action( 'wp_ajax_nopriv_rikshawale_ai_valuation', 'rikshawale_ajax_ai_valuation_handler' );

/* ============================================================
   SELL A CAR — Admin Review Metabox
   ============================================================ */

function rikshawale_add_car_submission_metabox() {
    add_meta_box(
        'car_submission_details',
        __( 'Submission Details & Actions', 'rikshawale-theme' ),
        'rikshawale_render_car_submission_metabox',
        'car_submission',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'rikshawale_add_car_submission_metabox' );

function rikshawale_render_car_submission_metabox( $post ) {
    $m = function( $key ) use ( $post ) {
        return esc_html( get_post_meta( $post->ID, $key, true ) );
    };
    $img_urls = array();
    for ( $i = 1; $i <= 5; $i++ ) {
        $img_urls[] = get_post_meta( $post->ID, '_car_gallery_image_' . $i, true );
    }
    ?>
    <style>
    .car-sub-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 20px; }
    .car-sub-field { background: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 6px; padding: 10px 14px; }
    .car-sub-field label { display: block; font-size: 11px; color: #888; text-transform: uppercase; margin-bottom: 3px; }
    .car-sub-field strong { font-size: 14px; color: #1a1a1a; }
    .car-sub-imgs { display: flex; gap: 12px; flex-wrap: wrap; margin: 12px 0; }
    .car-sub-imgs img { width: 130px; height: 90px; object-fit: cover; border-radius: 8px; border: 2px solid #e2e8f0; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; }
    .car-sub-imgs img:hover { transform: scale(1.05); box-shadow: 0 6px 16px rgba(0,0,0,0.2); border-color: #db2d2e; }
    #rikshawale-approve-btn { background: #16a34a; color: #fff; border: none; padding: 12px 28px; font-size: 15px; border-radius: 6px; cursor: pointer; font-weight: 600; }
    #rikshawale-approve-btn:hover { background: #15803d; }
    #rikshawale-approve-msg { margin-left: 14px; font-weight: 600; }

    .admin-lightbox-overlay { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.94); backdrop-filter: blur(8px); z-index: 999999; flex-direction: column; justify-content: space-between; align-items: center; padding: 20px; box-sizing: border-box; }
    .admin-lightbox-header { width: 100%; display: flex; justify-content: space-between; align-items: center; z-index: 1000000; }
    .admin-lightbox-counter { color: #f8fafc; font-size: 13px; font-weight: 600; background: rgba(255,255,255,0.12); padding: 6px 14px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.2); }
    .admin-lightbox-close { color: #fff; font-size: 18px; font-weight: bold; cursor: pointer; background: rgba(255,255,255,0.2); width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; line-height: 1; text-align: center; border: 1px solid rgba(255,255,255,0.3); transition: background 0.2s, transform 0.2s; box-sizing: border-box; }
    .admin-lightbox-close:hover { background: #db2d2e; border-color: #db2d2e; transform: scale(1.1); }

    .admin-lightbox-body { position: relative; display: flex; justify-content: center; align-items: center; width: 100%; height: calc(100vh - 160px); }
    .admin-lightbox-img-wrapper { display: flex; justify-content: center; align-items: center; max-width: 85vw; max-height: 72vh; }
    .admin-lightbox-overlay img#admin-lightbox-img { max-width: 85vw; max-height: 70vh; border-radius: 12px; box-shadow: 0 20px 50px rgba(0,0,0,0.8); object-fit: contain; transition: transform 0.3s ease; }
    .admin-lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.2); color: #fff; border: none; font-size: 24px; width: 50px; height: 50px; cursor: pointer; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.2s, transform 0.2s; z-index: 1000000; outline: none; }
    .admin-lightbox-nav:hover { background: #db2d2e; transform: translateY(-50%) scale(1.1); }
    .admin-lightbox-prev { left: 20px; }
    .admin-lightbox-next { right: 20px; }

    /* Bottom Thumbnail Carousel Strip */
    .admin-lightbox-thumb-strip { display: flex; gap: 10px; overflow-x: auto; max-width: 90vw; padding: 10px; background: rgba(0,0,0,0.4); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); z-index: 1000000; }
    .admin-lightbox-thumb-item { width: 70px; height: 50px; object-fit: cover; border-radius: 6px; opacity: 0.5; border: 2px solid transparent; cursor: pointer; transition: opacity 0.2s, border-color 0.2s, transform 0.2s; }
    .admin-lightbox-thumb-item:hover, .admin-lightbox-thumb-item.active { opacity: 1; border-color: #db2d2e; transform: scale(1.08); }
    </style>

    <h3 style="border-bottom:2px solid #db2d2e;padding-bottom:6px;color:#db2d2e;">🧑 Seller Information</h3>
    <div class="car-sub-grid">
        <div class="car-sub-field"><label>Name</label><strong><?php echo $m('_seller_name'); ?></strong></div>
        <div class="car-sub-field"><label>Phone</label><strong><?php echo $m('_seller_phone'); ?></strong></div>
        <div class="car-sub-field"><label>WhatsApp</label><strong><?php echo $m('_seller_whatsapp'); ?></strong></div>
        <div class="car-sub-field"><label>City</label><strong><?php echo $m('_seller_city'); ?></strong></div>
        <div class="car-sub-field"><label>State</label><strong><?php echo $m('_seller_state'); ?></strong></div>
        <div class="car-sub-field"><label>Reg Number</label><strong><?php echo $m('_seller_reg_no'); ?></strong></div>
    </div>

    <h3 style="border-bottom:2px solid #db2d2e;padding-bottom:6px;color:#db2d2e;">🚗 Vehicle Details</h3>
    <div class="car-sub-grid">
        <div class="car-sub-field"><label>Brand</label><strong><?php echo $m('_car_brand_name') ?: $m('_riksha_brand_name'); ?></strong></div>
        <div class="car-sub-field"><label>Model</label><strong><?php echo $m('_car_model_name') ?: $m('_riksha_model_name'); ?></strong></div>
        <div class="car-sub-field"><label>Variant</label><strong><?php echo $m('_car_variant') ?: $m('_riksha_variant'); ?></strong></div>
        <div class="car-sub-field"><label>Mfg Year</label><strong><?php echo $m('_car_mfg_year') ?: $m('_riksha_mfg_year'); ?></strong></div>
        <div class="car-sub-field"><label>Reg Year</label><strong><?php echo $m('_car_reg_year') ?: $m('_riksha_reg_year'); ?></strong></div>
        <div class="car-sub-field"><label>Owner Type</label><strong><?php echo $m('_car_owner_type') ?: $m('_riksha_owner_type'); ?></strong></div>
        <div class="car-sub-field"><label>Driven (KM)</label><strong><?php echo $m('_car_driven_km') ?: $m('_riksha_driven_km'); ?></strong></div>
        <div class="car-sub-field"><label>Fuel Type</label><strong><?php echo $m('_car_fuel') ?: $m('_riksha_fuel'); ?></strong></div>
        <div class="car-sub-field"><label>Transmission</label><strong><?php echo $m('_car_transmission') ?: $m('_riksha_transmission'); ?></strong></div>
        <div class="car-sub-field" style="grid-column: span 3;"><label>Expected Price</label><strong><?php echo $m('_car_expected_price') ?: $m('_riksha_expected_price'); ?></strong></div>
    </div>

    <?php
    $ai_min   = get_post_meta( $post->ID, '_car_ai_valuation_min', true );
    $ai_max   = get_post_meta( $post->ID, '_car_ai_valuation_max', true );
    $ai_score = get_post_meta( $post->ID, '_car_ai_condition_score', true );
    $ai_sum   = get_post_meta( $post->ID, '_car_ai_summary', true );
    $ai_price = get_post_meta( $post->ID, '_car_indicative_price', true );
    $ai_dep   = get_post_meta( $post->ID, '_car_ai_depreciation', true );

    if ( $ai_min || $ai_score ) : ?>
    <h3 style="border-bottom:2px solid #2563eb;padding-bottom:6px;color:#2563eb;">🤖 AI Vehicle Valuation Report</h3>
    <div class="car-sub-grid" style="background:#eff6ff; border:1px solid #bfdbfe; padding:15px; border-radius:8px;">
        <div class="car-sub-field" style="background:#1e3a8a; color:#fff; grid-column: span 3; text-align:center;">
            <label style="color:#bfdbfe;">Estimated Market Resale Price</label>
            <strong style="color:#fff; font-size:24px; display:block; margin-top:5px;"><?php echo $ai_price ? esc_html($ai_price) : 'N/A'; ?></strong>
        </div>
        <div class="car-sub-field" style="background:#fff;"><label>AI Recommended Fair Range</label><strong style="color:#2563eb; font-size:16px;"><?php echo $ai_min ? 'Rs. ' . number_format((float)$ai_min, 2) . ' – Rs. ' . number_format((float)$ai_max, 2) : 'N/A'; ?></strong></div>
        <div class="car-sub-field" style="background:#fff;"><label>AI Condition Score</label><strong style="color:#16a34a; font-size:16px;">⭐ <?php echo $ai_score ? esc_html($ai_score) . '/10' : 'N/A'; ?></strong></div>
        <?php if ($ai_dep) : ?>
        <div class="car-sub-field" style="background:#fff;"><label>Depreciation</label><strong style="color:#d97706; font-size:16px;"><?php echo esc_html($ai_dep); ?>% of original ex-showroom</strong></div>
        <?php else : ?>
        <div class="car-sub-field" style="background:#fff;"><label>Depreciation</label><strong style="color:#d97706; font-size:16px;">N/A</strong></div>
        <?php endif; ?>
        <div class="car-sub-field" style="background:#fff; grid-column: span 3;"><label>AI Analysis Summary</label><span><?php echo esc_html($ai_sum); ?></span></div>
    </div>
    <?php endif; ?>

    <?php
    $video_url_val = get_post_meta( $post->ID, '_car_video_url', true );
    if ( ! empty( $video_url_val ) ) : ?>
    <h3 style="border-bottom:2px solid #db2d2e;padding-bottom:6px;color:#db2d2e;">🎥 Uploaded Riksha Video / YouTube Link</h3>
    <div style="background:#f8fafc; border:1px solid #cbd5e1; padding:15px; border-radius:8px; margin-bottom:20px;">
        <?php if ( strpos( $video_url_val, 'youtube.com' ) !== false || strpos( $video_url_val, 'youtu.be' ) !== false ) :
            preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url_val, $yt_match );
            $yt_id = $yt_match[1] ?? '';
        ?>
            <div style="max-width:560px; aspect-ratio:16/9; margin-bottom:8px;">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>" frameborder="0" allowfullscreen style="border-radius:8px;"></iframe>
            </div>
            <p style="margin:0; font-size:12px; color:#475569;">
                <strong>YouTube Link:</strong> <a href="<?php echo esc_url($video_url_val); ?>" target="_blank" style="color:#db2d2e; font-weight:600;"><?php echo esc_html($video_url_val); ?></a>
            </p>
        <?php else : ?>
            <div style="max-width:560px; margin-bottom:8px;">
                <video src="<?php echo esc_url($video_url_val); ?>" controls style="width:100%; max-height:310px; background:#000; border-radius:8px;"></video>
            </div>
            <p style="margin:0; font-size:12px; color:#475569;">
                <strong>Direct Video URL:</strong> <a href="<?php echo esc_url($video_url_val); ?>" target="_blank" style="color:#db2d2e; font-weight:600;"><?php echo esc_html($video_url_val); ?></a>
            </p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php
    $valid_imgs = array_values( array_filter($img_urls) );
    if ( ! empty($valid_imgs) ) : ?>
    <h3 style="border-bottom:2px solid #db2d2e;padding-bottom:6px;color:#db2d2e;">📷 Uploaded Images <small style="font-size:12px; color:#64748b; font-weight:normal;">(Click any image to open full-size slider)</small></h3>
    <div class="car-sub-imgs">
        <?php foreach ( $valid_imgs as $idx => $url ) : ?>
            <a href="javascript:void(0)" onclick="openAdminLightbox(<?php echo $idx; ?>)">
                <img src="<?php echo esc_url($url); ?>" alt="Riksha Image" title="Click to view full size popup slider">
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Full-Size Lightbox Slider Modal Container with Carousel Strip -->
    <div id="admin-lightbox-modal" class="admin-lightbox-overlay" onclick="closeAdminLightbox(event)">
        <div class="admin-lightbox-header" onclick="event.stopPropagation()">
            <div class="admin-lightbox-counter" id="admin-lightbox-counter">Image 1 of 5</div>
            <span class="admin-lightbox-close" onclick="closeAdminLightbox(event)">&times;</span>
        </div>
        
        <div class="admin-lightbox-body">
            <button type="button" class="admin-lightbox-nav admin-lightbox-prev" onclick="navAdminLightbox(-1, event)">&#10094;</button>
            <div class="admin-lightbox-img-wrapper" onclick="event.stopPropagation()">
                <img id="admin-lightbox-img" src="" alt="Full View">
            </div>
            <button type="button" class="admin-lightbox-nav admin-lightbox-next" onclick="navAdminLightbox(1, event)">&#10095;</button>
        </div>

        <!-- Carousel Strip -->
        <div class="admin-lightbox-thumb-strip" onclick="event.stopPropagation()">
            <?php foreach ( $valid_imgs as $idx => $url ) : ?>
                <img src="<?php echo esc_url($url); ?>" class="admin-lightbox-thumb-item <?php echo $idx === 0 ? 'active' : ''; ?>" id="admin-thumb-<?php echo $idx; ?>" onclick="openAdminLightbox(<?php echo $idx; ?>)" alt="Thumb <?php echo $idx+1; ?>">
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    var adminGalleryUrls = <?php echo json_encode( array_values( array_filter($img_urls) ) ); ?>;
    var adminCurrentIdx = 0;

    function openAdminLightbox(idx) {
        if (!adminGalleryUrls || adminGalleryUrls.length === 0) return;
        adminCurrentIdx = idx;
        updateAdminLightbox();
        var modal = document.getElementById('admin-lightbox-modal');
        if (modal) modal.style.display = 'flex';
    }

    function updateAdminLightbox() {
        if (adminCurrentIdx < 0) adminCurrentIdx = adminGalleryUrls.length - 1;
        if (adminCurrentIdx >= adminGalleryUrls.length) adminCurrentIdx = 0;

        var img = document.getElementById('admin-lightbox-img');
        var counter = document.getElementById('admin-lightbox-counter');
        if (img) img.src = adminGalleryUrls[adminCurrentIdx];
        if (counter) counter.textContent = 'Image ' + (adminCurrentIdx + 1) + ' of ' + adminGalleryUrls.length;

        // Highlight active thumbnail in strip
        for (var i = 0; i < adminGalleryUrls.length; i++) {
            var th = document.getElementById('admin-thumb-' + i);
            if (th) {
                if (i === adminCurrentIdx) {
                    th.classList.add('active');
                    th.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                } else {
                    th.classList.remove('active');
                }
            }
        }
    }

    function navAdminLightbox(step, e) {
        if (e) e.stopPropagation();
        adminCurrentIdx += step;
        updateAdminLightbox();
    }

    function closeAdminLightbox(e) {
        var modal = document.getElementById('admin-lightbox-modal');
        if (modal) modal.style.display = 'none';
    }

    document.addEventListener('keydown', function(e) {
        var modal = document.getElementById('admin-lightbox-modal');
        if (modal && modal.style.display === 'flex') {
            if (e.key === 'ArrowRight') navAdminLightbox(1);
            if (e.key === 'ArrowLeft') navAdminLightbox(-1);
            if (e.key === 'Escape') closeAdminLightbox();
        }
    });
    </script>

    <hr>
    <p>
        <button type="button" id="rikshawale-approve-btn"
            data-post="<?php echo esc_attr($post->ID); ?>"
            data-nonce="<?php echo wp_create_nonce('rikshawale_approve_submission'); ?>">
            ✅ Approve &amp; Create Inventory Post
        </button>
        <span id="rikshawale-approve-msg"></span>
    </p>

    <script>
    document.getElementById('rikshawale-approve-btn').addEventListener('click', function() {
        var btn  = this;
        var msg  = document.getElementById('rikshawale-approve-msg');
        btn.disabled = true;
        btn.textContent = 'Creating…';
        var data = new FormData();
        data.append('action',    'rikshawale_approve_submission');
        data.append('post_id',   btn.dataset.post);
        data.append('nonce',     btn.dataset.nonce);
        fetch(ajaxurl, { method: 'POST', body: data })
            .then(r => r.json())
            .then(function(res) {
                if (res.success) {
                    msg.style.color = '#16a34a';
                    msg.textContent = '✅ Inventory post created! ID #' + res.data.inventory_id;
                    btn.textContent = 'Done!';
                } else {
                    msg.style.color = '#dc2626';
                    msg.textContent = '❌ ' + (res.data.message || 'Error');
                    btn.disabled = false;
                    btn.textContent = 'Approve & Create Inventory Post';
                }
            });
    });
    </script>
    <?php
}

/* ============================================================
   SELL A CAR — Admin Approve → Create Inventory Post
   ============================================================ */

function rikshawale_approve_car_submission_handler() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized.' ) );
    }
    if ( ! wp_verify_nonce( $_POST['nonce'] ?? '', 'rikshawale_approve_submission' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }

    $submission_id = intval( $_POST['post_id'] ?? 0 );
    if ( ! $submission_id || get_post_type( $submission_id ) !== 'car_submission' ) {
        wp_send_json_error( array( 'message' => 'Invalid submission.' ) );
    }

    $m = function( $key ) use ( $submission_id ) {
        return get_post_meta( $submission_id, $key, true );
    };

    $brand     = $m('_car_brand_name');
    $model     = $m('_car_model_name');
    $variant   = $m('_car_variant');
    $mfg_year  = $m('_car_mfg_year');

    // Create inventory post
    $inventory_id = wp_insert_post( array(
        'post_type'   => 'inventory',
        'post_title'  => trim( $brand . ' ' . $model . ' ' . $variant . ' ' . $mfg_year ),
        'post_status' => 'draft',
        'post_author' => get_current_user_id(),
    ) );

    if ( is_wp_error( $inventory_id ) ) {
        wp_send_json_error( array( 'message' => 'Could not create inventory post.' ) );
    }

    // Copy all car meta
    $meta_keys = array(
        '_car_mfg_year', '_car_reg_year', '_car_owner_type',
        '_car_brand_name', '_car_model_name', '_car_variant',
        '_car_driven_km', '_car_fuel', '_car_transmission',
        '_car_expected_price', '_car_video_url',
        '_car_gallery_image_1', '_car_gallery_image_2', '_car_gallery_image_3',
        '_car_gallery_image_4', '_car_gallery_image_5',
        '_car_ai_valuation_min', '_car_ai_valuation_max',
        '_car_ai_condition_score', '_car_ai_summary'
    );
    foreach ( $meta_keys as $key ) {
        $val = $m( $key );
        if ( $val ) {
            if ( $key === '_car_owner_type' ) {
                $val = rikshawale_normalize_owner_type( $val );
                update_post_meta( $inventory_id, '_riksha_owner_type', $val );
            }
            update_post_meta( $inventory_id, $key, $val );
            // Also set _car_price from expected price
            if ( $key === '_car_expected_price' ) {
                update_post_meta( $inventory_id, '_car_price', $val );
            }
        }
    }

    // Save formatted Indicative Price in Inventory
    $ai_min = $m('_car_ai_valuation_min');
    $ai_max = $m('_car_ai_valuation_max');
    if ( $ai_min && $ai_max ) {
        $indicative_str = '₹' . number_format((float)$ai_min) . ' – ₹' . number_format((float)$ai_max);
        update_post_meta( $inventory_id, '_car_indicative_price', $indicative_str );
    }

    // Automatically set Taxonomy terms based on provided data
    $tax_map = array(
        'riksha_brand'      => $brand,
        'riksha_model'      => $model,
        'riksha_mfg_year'   => $mfg_year,
        'riksha_reg_year'   => $m('_car_reg_year'),
        'riksha_owner_type' => $m('_car_owner_type') ? rikshawale_normalize_owner_type($m('_car_owner_type')) : '',
        'riksha_fuel_type'  => $m('_car_fuel'),
        'riksha_trans_type' => $m('_car_transmission'),
        'riksha_location'   => $m('_seller_city'),
        'riksha_type'       => $m('_car_fuel'), // Maps fuel type (e.g. Electric) to Riksha Type taxonomy as well
    );

    foreach ( $tax_map as $tax => $term_name ) {
        if ( ! empty( $term_name ) ) {
            // Check if term exists, if not it will be created by wp_set_object_terms if passing the name directly
            wp_set_object_terms( $inventory_id, trim( $term_name ), $tax, false );
        }
    }

    // Copy seller info as extra meta
    update_post_meta( $inventory_id, '_submission_seller_name',  $m('_seller_name') );
    update_post_meta( $inventory_id, '_submission_seller_phone', $m('_seller_phone') );
    update_post_meta( $inventory_id, '_submission_id',           $submission_id );

    // Set first gallery image as featured
    $thumb_url = $m('_car_gallery_image_1');
    if ( $thumb_url ) {
        $attachment_id = attachment_url_to_postid( $thumb_url );
        if ( $attachment_id ) {
            set_post_thumbnail( $inventory_id, $attachment_id );
        }
    }

    // Mark submission as published (approved)
    wp_update_post( array( 'ID' => $submission_id, 'post_status' => 'publish' ) );
    update_post_meta( $submission_id, '_approved_inventory_id', $inventory_id );

    wp_send_json_success( array(
        'inventory_id'  => $inventory_id,
        'edit_url'      => admin_url( 'post.php?post=' . $inventory_id . '&action=edit' ),
    ) );
}
add_action( 'wp_ajax_rikshawale_approve_submission', 'rikshawale_approve_car_submission_handler' );

/* ============================================================
   INVENTORY & RIKSHA POST TYPE — AI Indicative Price Metabox
   ============================================================ */

function rikshawale_add_inventory_ai_metabox() {
    $post_types = array( 'inventory', 'riksha' );
    foreach ( $post_types as $pt ) {
        add_meta_box(
            'rikshawale_inventory_ai_details',
            '🤖 AI Indicative Price & Condition Details',
            'rikshawale_render_inventory_ai_metabox',
            $pt,
            'side',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'rikshawale_add_inventory_ai_metabox' );

function rikshawale_render_inventory_ai_metabox( $post ) {
    wp_nonce_field( 'rikshawale_save_inventory_ai_nonce', 'inventory_ai_nonce' );
    $indicative = get_post_meta( $post->ID, '_car_indicative_price', true );
    $val_min    = get_post_meta( $post->ID, '_car_ai_valuation_min', true );
    $val_max    = get_post_meta( $post->ID, '_car_ai_valuation_max', true );
    $score      = get_post_meta( $post->ID, '_car_ai_condition_score', true );
    $summary    = get_post_meta( $post->ID, '_car_ai_summary', true );
    ?>
    <div style="padding: 6px 0;">
        <p style="margin-bottom: 8px;">
            <label style="font-weight:600; display:block; font-size:12px; color:#1e293b;">Indicative / Incentive Price</label>
            <input type="text" name="_car_indicative_price" value="<?php echo esc_attr($indicative); ?>" placeholder="e.g. ₹1,20,000 – ₹1,40,000" style="width:100%; padding:6px 8px; border-radius:4px; border:1px solid #cbd5e1;">
        </p>
        <div style="display:flex; gap:8px; margin-bottom:8px;">
            <div style="flex:1;">
                <label style="font-weight:600; display:block; font-size:11px; color:#64748b;">AI Min Price (₹)</label>
                <input type="text" name="_car_ai_valuation_min" value="<?php echo esc_attr($val_min); ?>" placeholder="120000" style="width:100%; padding:4px 6px;">
            </div>
            <div style="flex:1;">
                <label style="font-weight:600; display:block; font-size:11px; color:#64748b;">AI Max Price (₹)</label>
                <input type="text" name="_car_ai_valuation_max" value="<?php echo esc_attr($val_max); ?>" placeholder="140000" style="width:100%; padding:4px 6px;">
            </div>
        </div>
        <p style="margin-bottom: 8px;">
            <label style="font-weight:600; display:block; font-size:12px; color:#1e293b;">Condition Rating Score (1-10)</label>
            <input type="text" name="_car_ai_condition_score" value="<?php echo esc_attr($score); ?>" placeholder="8.5" style="width:100%; padding:6px 8px; border-radius:4px; border:1px solid #cbd5e1;">
        </p>
        <p style="margin-bottom: 0;">
            <label style="font-weight:600; display:block; font-size:12px; color:#1e293b;">AI Condition Summary</label>
            <textarea name="_car_ai_summary" rows="3" style="width:100%; padding:6px 8px; border-radius:4px; border:1px solid #cbd5e1; font-size:12px;"><?php echo esc_textarea($summary); ?></textarea>
        </p>
    </div>
    <?php
}

function rikshawale_save_inventory_ai_metabox( $post_id ) {
    if ( ! isset( $_POST['inventory_ai_nonce'] ) || ! wp_verify_nonce( $_POST['inventory_ai_nonce'], 'rikshawale_save_inventory_ai_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    $fields = array( '_car_indicative_price', '_car_ai_valuation_min', '_car_ai_valuation_max', '_car_ai_condition_score', '_car_ai_summary' );
    foreach ( $fields as $f ) {
        if ( isset( $_POST[$f] ) ) {
            update_post_meta( $post_id, $f, sanitize_text_field( $_POST[$f] ) );
        }
    }
}
add_action( 'save_post', 'rikshawale_save_inventory_ai_metabox' );

/* ============================================================
   DYNAMIC TYPOGRAPHY & STYLING CSS OUTPUT IN WP_HEAD
   ============================================================ */

function rikshawale_output_customizer_css() {
    $font_family      = get_theme_mod( 'typography_font_family', 'Montserrat, Roboto, sans-serif' );
    $body_size        = get_theme_mod( 'body_font_size', '15px' );
    $body_line_h      = get_theme_mod( 'body_line_height', '1.6' );
    $body_letter_sp   = get_theme_mod( 'body_letter_spacing', '0px' );

    $h1_size          = get_theme_mod( 'h1_font_size', '38px' );
    $h2_size          = get_theme_mod( 'h2_font_size', '30px' );
    $h3_size          = get_theme_mod( 'h3_font_size', '24px' );
    $h4_size          = get_theme_mod( 'h4_font_size', '20px' );
    $h5_size          = get_theme_mod( 'h5_font_size', '18px' );
    $h6_size          = get_theme_mod( 'h6_font_size', '16px' );
    $heading_line_h   = get_theme_mod( 'heading_line_height', '1.2' );
    $heading_letter_sp= get_theme_mod( 'heading_letter_spacing', '0px' );

    $header_bg        = get_theme_mod( 'header_bg_color', '#ffffff' );
    $header_text      = get_theme_mod( 'header_text_color', '#1a1a1a' );
    $footer_bg        = get_theme_mod( 'footer_bg_color', '#151515' );
    $footer_text      = get_theme_mod( 'footer_text_color', '#aaaaaa' );

    $sec_padding      = get_theme_mod( 'section_padding_v', '48px' );
    $sec_margin       = get_theme_mod( 'section_margin_b', '32px' );
    ?>
    <style id="rikshawale-customizer-dynamic-css">
        :root {
            --font-body: <?php echo esc_attr($font_family); ?>;
            --font-heading: <?php echo esc_attr($font_family); ?>;
        }
        body {
            font-family: var(--font-body), 'Inter', sans-serif !important;
            font-size: <?php echo esc_attr($body_size); ?> !important;
            line-height: <?php echo esc_attr($body_line_h); ?> !important;
            letter-spacing: <?php echo esc_attr($body_letter_sp); ?> !important;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: var(--font-heading), 'Inter', sans-serif !important;
            line-height: <?php echo esc_attr($heading_line_h); ?> !important;
            letter-spacing: <?php echo esc_attr($heading_letter_sp); ?> !important;
        }
        h1, .h1 { font-size: <?php echo esc_attr($h1_size); ?> !important; }
        h2, .h2 { font-size: <?php echo esc_attr($h2_size); ?> !important; }
        h3, .h3 { font-size: <?php echo esc_attr($h3_size); ?> !important; }
        h4, .h4 { font-size: <?php echo esc_attr($h4_size); ?> !important; }
        h5, .h5 { font-size: <?php echo esc_attr($h5_size); ?> !important; }
        h6, .h6 { font-size: <?php echo esc_attr($h6_size); ?> !important; }

        header, .navbar-custom, .site-header {
            background-color: <?php echo esc_attr($header_bg); ?> !important;
            color: <?php echo esc_attr($header_text); ?> !important;
        }
        footer, .footer-custom {
            background-color: <?php echo esc_attr($footer_bg); ?> !important;
            color: <?php echo esc_attr($footer_text); ?> !important;
        }

        .section-custom-space, section.py-5 {
            padding-top: <?php echo esc_attr($sec_padding); ?> !important;
            padding-bottom: <?php echo esc_attr($sec_padding); ?> !important;
            margin-bottom: <?php echo esc_attr($sec_margin); ?> !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'rikshawale_output_customizer_css', 99 );

/* ==========================================================================
   USER AUTHENTICATION & VEHICLE BOOKING INQUIRY SYSTEM
   ========================================================================== */

/**
 * Register Custom Post Type: Vehicle Booking Inquiries (riksha_booking)
 */
function rikshawale_register_booking_cpt() {
	register_post_type( 'riksha_booking', array(
		'labels' => array(
			'name'               => __( 'Vehicle Bookings', 'rikshawale-theme' ),
			'singular_name'      => __( 'Vehicle Booking', 'rikshawale-theme' ),
			'menu_name'          => __( '🛺 Vehicle Bookings', 'rikshawale-theme' ),
			'all_items'          => __( 'My Bookings / All Bookings', 'rikshawale-theme' ),
			'edit_item'          => __( 'View Booking Inquiry', 'rikshawale-theme' ),
			'not_found'          => __( 'No vehicle bookings found.', 'rikshawale-theme' ),
		),
		'public'            => false,
		'show_ui'           => true,
		'show_in_menu'      => true,
		'menu_icon'         => 'dashicons-calendar-alt',
		'menu_position'     => 7,
		'capability_type'   => 'post',
		'has_archive'       => false,
		'hierarchical'      => false,
		'supports'          => array( 'title' ),
		'show_in_rest'      => false,
	) );
}
add_action( 'init', 'rikshawale_register_booking_cpt' );

/**
 * Grant Subscribers access to view Vehicle Bookings in WP Admin
 */
function rikshawale_grant_subscriber_booking_caps( $allcaps, $caps, $args, $user ) {
	if ( is_admin() && in_array( 'subscriber', (array) $user->roles ) ) {
		$allcaps['edit_posts'] = true;
		$allcaps['read'] = true;
	}
	return $allcaps;
}
add_filter( 'user_has_cap', 'rikshawale_grant_subscriber_booking_caps', 10, 4 );

/**
 * Filter Bookings in WP Admin for Subscribers (Only show their own bookings)
 */
function rikshawale_filter_subscriber_bookings( $query ) {
	if ( is_admin() && $query->is_main_query() && $query->get( 'post_type' ) === 'riksha_booking' ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			$user = wp_get_current_user();
			$query->set( 'meta_query', array(
				'relation' => 'OR',
				array(
					'key'     => '_booking_user_id',
					'value'   => $user->ID,
					'compare' => '=',
				),
				array(
					'key'     => '_booking_email',
					'value'   => $user->user_email,
					'compare' => '=',
				),
				array(
					'key'     => '_customer_email',
					'value'   => $user->user_email,
					'compare' => '=',
				),
			) );
		}
	}
}
add_action( 'pre_get_posts', 'rikshawale_filter_subscriber_bookings' );

/**
 * Filter Bookings List Table Views for Subscribers (Hide "All", "Publish", "Trash")
 */
function rikshawale_filter_subscriber_booking_views( $views ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		unset( $views['all'] );
		unset( $views['publish'] );
		unset( $views['trash'] );
		unset( $views['mine'] );
	}
	return $views;
}
add_filter( 'views_edit-riksha_booking', 'rikshawale_filter_subscriber_booking_views' );

/**
 * Hide "Add New", WordPress update banners, Personal Options, Elementor AI, and core clutter for Subscribers
 */
function rikshawale_hide_subscriber_booking_actions() {
	if ( ! current_user_can( 'manage_options' ) ) {
		global $pagenow;
		echo '<style>
			.update-nag, .notice-warning, #wpadminbar .ab-icon, #footer-thankyou, #footer-upgrade, #screen-meta-links, #contextual-help-link-wrap, #wpfooter { display: none !important; }
		</style>';

		if ( $pagenow === 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'riksha_booking' ) {
			echo '<style>.page-title-action, .row-actions .inline, .row-actions .edit, .tablenav .actions, .bulkactions, ul.subsubsub { display: none !important; }</style>';
		}

		if ( $pagenow === 'profile.php' ) {
			echo '<style>
				body.profile-php h2,
				body.profile-php h3,
				body.profile-php .user-rich-editing-wrap,
				body.profile-php .user-syntax-highlighting-wrap,
				body.profile-php .user-admin-color-wrap,
				body.profile-php .user-comment-shortcuts-wrap,
				body.profile-php .show-admin-bar,
				body.profile-php .user-language-wrap,
				body.profile-php .user-nickname-wrap,
				body.profile-php .user-url-wrap,
				body.profile-php .user-description-wrap,
				body.profile-php .user-profile-picture,
				body.profile-php .user-sessions-wrap,
				body.profile-php .application-passwords,
				body.profile-php #elementor-ai-user-profile,
				body.profile-php .elementor-ai-user-profile,
				body.profile-php tr:has(input[name*="elementor"]),
				body.profile-php tr:has(label[for*="elementor"]),
				body.profile-php .user-admin-bar-front-wrap {
					display: none !important;
				}
				body.profile-php #your-profile {
					max-width: 650px;
					background: #ffffff;
					padding: 24px;
					border-radius: 12px;
					box-shadow: 0 2px 10px rgba(0,0,0,0.05);
					margin-top: 15px;
				}
				body.profile-php h1 {
					font-weight: 700;
					color: #0f172a;
				}
				body.profile-php table.form-table th {
					font-weight: 600;
					color: #334155;
					width: 160px;
				}
				body.profile-php input.regular-text {
					border-radius: 6px;
					padding: 6px 12px;
				}
			</style>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					document.querySelectorAll("h2, h3, tr, table").forEach(function(el) {
						if (el.innerText && el.innerText.indexOf("Elementor") !== -1) {
							el.style.display = "none";
						}
					});
				});
			</script>';
		}
	}
}
add_action( 'admin_head', 'rikshawale_hide_subscriber_booking_actions' );

/**
 * Strictly Hide ALL Menus for Subscribers Except "Vehicle Bookings" and "Profile"
 */
function rikshawale_customize_subscriber_admin_menu() {
	if ( ! current_user_can( 'manage_options' ) ) {
		global $menu, $submenu;

		// Remove "Add Post" / "Add New" submenu under Vehicle Bookings
		if ( isset( $submenu['edit.php?post_type=riksha_booking'] ) ) {
			foreach ( $submenu['edit.php?post_type=riksha_booking'] as $sub_key => $sub_item ) {
				if ( isset( $sub_item[2] ) && strpos( $sub_item[2], 'post-new.php' ) !== false ) {
					unset( $submenu['edit.php?post_type=riksha_booking'][$sub_key] );
				}
			}
		}

		// Allowed top-level menu slugs: ONLY Vehicle Bookings and Profile!
		$allowed_menu_slugs = array(
			'edit.php?post_type=riksha_booking',
			'profile.php',
		);

		if ( ! empty( $menu ) && is_array( $menu ) ) {
			foreach ( $menu as $key => $item ) {
				$menu_slug = $item[2] ?? '';
				if ( ! in_array( $menu_slug, $allowed_menu_slugs, true ) ) {
					unset( $menu[$key] );
				}
			}
		}
	}
}
add_action( 'admin_menu', 'rikshawale_customize_subscriber_admin_menu', 9999 );

/**
 * Redirect Subscriber from Any Unauthorized Admin Page to Vehicle Bookings
 */
function rikshawale_subscriber_admin_redirect() {
	if ( is_admin() && ! current_user_can( 'manage_options' ) && ! wp_doing_ajax() ) {
		global $pagenow;
		$post_type = $_GET['post_type'] ?? '';

		// Allowed pages: profile.php or edit.php?post_type=riksha_booking
		if ( $pagenow === 'profile.php' || ( $pagenow === 'edit.php' && $post_type === 'riksha_booking' ) ) {
			return;
		}

		// Allow viewing individual booking post if owned by subscriber
		if ( $pagenow === 'post.php' && isset( $_GET['post'] ) ) {
			$post_id = intval( $_GET['post'] );
			if ( get_post_type( $post_id ) === 'riksha_booking' ) {
				$user      = wp_get_current_user();
				$b_user_id = get_post_meta( $post_id, '_booking_user_id', true );
				$b_email   = get_post_meta( $post_id, '_booking_email', true ) ?: get_post_meta( $post_id, '_customer_email', true );
				if ( intval( $b_user_id ) === $user->ID || strtolower( trim( $b_email ) ) === strtolower( trim( $user->user_email ) ) || intval( get_post_field( 'post_author', $post_id ) ) === $user->ID ) {
					return; // Authorized
				}
			}
		}

		// Redirect to Vehicle Bookings
		wp_redirect( admin_url( 'edit.php?post_type=riksha_booking' ) );
		exit;
	}
}
add_action( 'admin_init', 'rikshawale_subscriber_admin_redirect' );

/**
 * Remove WordPress Logo and Links from Admin Bar
 */
function rikshawale_remove_wp_logo_admin_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' ); // Removes WP Logo (WordPress.org, Documentation, Support, Feedback)
	if ( ! current_user_can( 'manage_options' ) ) {
		$wp_admin_bar->remove_node( 'site-name' );
		$wp_admin_bar->remove_node( 'view-site' );
		$wp_admin_bar->remove_node( 'updates' );
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'new-content' );
	}
}
add_action( 'admin_bar_menu', 'rikshawale_remove_wp_logo_admin_bar', 999 );

/**
 * Hide Admin Bar on Frontend for Non-Administrators
 */
function rikshawale_hide_admin_bar_for_subscribers( $show ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}
	return $show;
}
add_filter( 'show_admin_bar', 'rikshawale_hide_admin_bar_for_subscribers' );

/**
 * Custom Admin Columns for Vehicle Bookings
 */
function rikshawale_booking_columns( $columns ) {
	$new_cols = array(
		'cb'                 => '<input type="checkbox" />',
		'title'              => __( 'Customer Name & Inquiry ID', 'rikshawale-theme' ),
		'booking_phone'      => __( 'Mobile No.', 'rikshawale-theme' ),
		'booking_alt_phone'  => __( 'Alternate No.', 'rikshawale-theme' ),
		'booking_email'      => __( 'Email', 'rikshawale-theme' ),
		'vehicle_title'      => __( 'Vehicle Booked', 'rikshawale-theme' ),
		'booking_date'       => __( 'Preferred Date', 'rikshawale-theme' ),
		'booking_status'     => __( 'Status', 'rikshawale-theme' ),
		'date'               => __( 'Submitted Date', 'rikshawale-theme' ),
	);
	return $new_cols;
}
add_filter( 'manage_riksha_booking_posts_columns', 'rikshawale_booking_columns' );

function rikshawale_booking_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'booking_phone':
			$phone = get_post_meta( $post_id, '_booking_phone', true );
			echo esc_html( $phone ?: '—' );
			break;
		case 'booking_alt_phone':
			$alt_phone = get_post_meta( $post_id, '_booking_alt_phone', true );
			echo esc_html( $alt_phone ?: '—' );
			break;
		case 'booking_email':
			$email = get_post_meta( $post_id, '_booking_email', true );
			echo esc_html( $email ?: '—' );
			break;
		case 'vehicle_title':
			$car_id    = get_post_meta( $post_id, '_booking_car_id', true );
			$car_title = get_post_meta( $post_id, '_booking_car_title', true );
			if ( $car_id && get_post( $car_id ) ) {
				echo '<a href="' . get_edit_post_link( $car_id ) . '" target="_blank"><strong>' . esc_html( get_the_title( $car_id ) ) . '</strong></a>';
			} else {
				echo esc_html( $car_title ?: 'General Inquiry' );
			}
			break;
		case 'booking_date':
			$date = get_post_meta( $post_id, '_booking_date', true );
			echo esc_html( $date ?: '—' );
			break;
		case 'booking_status':
			$status = get_post_meta( $post_id, '_booking_status', true ) ?: 'Pending';
			$badge_bg = '#f59e0b';
			if ( $status === 'Confirmed' ) $badge_bg = '#10b981';
			if ( $status === 'Completed' ) $badge_bg = '#3b82f6';
			if ( $status === 'Cancelled' ) $badge_bg = '#ef4444';
			echo '<span style="background:' . $badge_bg . '; color:#fff; padding:3px 10px; border-radius:12px; font-weight:600; font-size:11px;">' . esc_html( $status ) . '</span>';
			break;
	}
}
add_action( 'manage_riksha_booking_posts_custom_column', 'rikshawale_booking_column_content', 10, 2 );

/**
 * Admin Metabox for Booking Details
 */
function rikshawale_add_booking_metabox() {
	add_meta_box(
		'booking_details_mb',
		__( 'Vehicle Booking & Customer Details', 'rikshawale-theme' ),
		'rikshawale_render_booking_metabox',
		'riksha_booking',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'rikshawale_add_booking_metabox' );

function rikshawale_render_booking_metabox( $post ) {
	wp_nonce_field( 'rikshawale_save_booking_meta', 'booking_meta_nonce' );
	$user_id   = get_post_meta( $post->ID, '_booking_user_id', true );
	$user_obj  = $user_id ? get_userdata( $user_id ) : null;
	$phone     = get_post_meta( $post->ID, '_booking_phone', true );
	$alt_phone = get_post_meta( $post->ID, '_booking_alt_phone', true );
	$email     = get_post_meta( $post->ID, '_booking_email', true );
	$name      = get_post_meta( $post->ID, '_booking_name', true );
	$city      = get_post_meta( $post->ID, '_booking_city', true );
	$car_id    = get_post_meta( $post->ID, '_booking_car_id', true );
	$car_title = get_post_meta( $post->ID, '_booking_car_title', true );
	$b_date    = get_post_meta( $post->ID, '_booking_date', true );
	$message   = get_post_meta( $post->ID, '_booking_message', true );
	$status    = get_post_meta( $post->ID, '_booking_status', true ) ?: 'Pending';
	?>
	<div style="font-size: 14px; line-height: 1.6; padding: 10px;">
		<p><strong>Customer Account:</strong> <?php echo $user_obj ? esc_html( $user_obj->display_name . ' (' . $user_obj->user_email . ')' ) : 'Guest Submission'; ?></p>
		<p><strong>Customer Name:</strong> <?php echo esc_html( $name ); ?></p>
		<p><strong>Mobile Number:</strong> <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
		<p><strong>Alternate Number:</strong> <?php echo $alt_phone ? '<a href="tel:' . esc_attr( $alt_phone ) . '">' . esc_html( $alt_phone ) . '</a>' : 'N/A'; ?></p>
		<p><strong>Email Address:</strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
		<p><strong>City / Location:</strong> <?php echo esc_html( $city ?: 'N/A' ); ?></p>
		<hr>
		<p><strong>Vehicle Booked:</strong> <?php echo $car_id ? '<a href="' . get_permalink( $car_id ) . '" target="_blank">' . esc_html( $car_title ) . '</a>' : esc_html( $car_title ); ?></p>
		<p><strong>Preferred Booking Date:</strong> <?php echo esc_html( $b_date ?: 'N/A' ); ?></p>
		<p><strong>Customer Notes/Message:</strong></p>
		<div style="background: #f9f9f9; padding: 12px; border: 1px solid #e5e5e5; border-radius: 6px; white-space: pre-wrap;">
			<?php echo esc_html( $message ?: 'No additional notes provided.' ); ?>
		</div>
		<hr>
		<p>
			<label for="booking_status"><strong>Booking Status:</strong></label><br>
			<?php if ( current_user_can( 'manage_options' ) ) : ?>
				<select name="booking_status" id="booking_status" style="width: 250px; padding: 6px; margin-top: 5px;">
					<option value="Pending" <?php selected( $status, 'Pending' ); ?>>⏳ Pending</option>
					<option value="Confirmed" <?php selected( $status, 'Confirmed' ); ?>>✅ Confirmed</option>
					<option value="Completed" <?php selected( $status, 'Completed' ); ?>>🎉 Completed</option>
					<option value="Cancelled" <?php selected( $status, 'Cancelled' ); ?>>❌ Cancelled</option>
				</select>
			<?php else : ?>
				<?php 
				$badge_bg = '#f59e0b';
				if ( $status === 'Confirmed' ) $badge_bg = '#10b981';
				if ( $status === 'Completed' ) $badge_bg = '#3b82f6';
				if ( $status === 'Cancelled' ) $badge_bg = '#ef4444';
				?>
				<span style="background:<?php echo $badge_bg; ?>; color:#fff; padding:4px 12px; border-radius:12px; font-weight:600; font-size:12px; display:inline-block; margin-top:5px;"><?php echo esc_html($status); ?></span>
			<?php endif; ?>
		</p>
	</div>
	<?php
}

function rikshawale_save_booking_meta( $post_id ) {
	if ( ! isset( $_POST['booking_meta_nonce'] ) || ! wp_verify_nonce( $_POST['booking_meta_nonce'], 'rikshawale_save_booking_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['booking_status'] ) ) {
		update_post_meta( $post_id, '_booking_status', sanitize_text_field( $_POST['booking_status'] ) );
	}
}
add_action( 'save_post_riksha_booking', 'rikshawale_save_booking_meta' );


/* --- AJAX AUTHENTICATION & BOOKING HANDLERS --- */

// 1. AJAX Customer Login
function rikshawale_ajax_login() {
	check_ajax_referer( 'rikshawale_auth_nonce', 'nonce' );
	$username = sanitize_text_field( $_POST['username'] ?? '' );
	$password = $_POST['password'] ?? '';

	if ( empty( $username ) || empty( $password ) ) {
		wp_send_json_error( array( 'message' => 'Please enter both username/email and password.' ) );
	}

	$creds = array(
		'user_login'    => $username,
		'user_password' => $password,
		'remember'      => true,
	);

	$user = wp_signon( $creds, is_ssl() );

	if ( is_wp_error( $user ) ) {
		wp_send_json_error( array( 'message' => 'Invalid username/email or password.' ) );
	}

	wp_send_json_success( array(
		'message'   => 'Login successful! Redirecting...',
		'user_name' => $user->display_name,
	) );
}
add_action( 'wp_ajax_rikshawale_login', 'rikshawale_ajax_login' );
add_action( 'wp_ajax_nopriv_rikshawale_login', 'rikshawale_ajax_login' );

// 2. AJAX Customer Registration
function rikshawale_ajax_register() {
	check_ajax_referer( 'rikshawale_auth_nonce', 'nonce' );
	$name     = sanitize_text_field( $_POST['reg_name'] ?? '' );
	$email    = sanitize_email( $_POST['reg_email'] ?? '' );
	$phone    = sanitize_text_field( $_POST['reg_phone'] ?? '' );
	$password = $_POST['reg_password'] ?? '';

	if ( empty( $name ) || empty( $email ) || empty( $password ) ) {
		wp_send_json_error( array( 'message' => 'Please complete all required fields.' ) );
	}
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
	}
	if ( email_exists( $email ) ) {
		wp_send_json_error( array( 'message' => 'An account with this email already exists. Please log in.' ) );
	}

	$username = sanitize_user( current( explode( '@', $email ) ) );
	if ( username_exists( $username ) ) {
		$username .= rand( 100, 999 );
	}

	$user_id = wp_create_user( $username, $password, $email );
	if ( is_wp_error( $user_id ) ) {
		wp_send_json_error( array( 'message' => $user_id->get_error_message() ) );
	}

	wp_update_user( array(
		'ID'           => $user_id,
		'display_name' => $name,
		'first_name'   => $name,
	) );
	update_user_meta( $user_id, 'phone_number', $phone );

	// Auto-login registered user
	wp_set_current_user( $user_id );
	wp_set_auth_cookie( $user_id, true );

	wp_send_json_success( array(
		'message'   => 'Account created successfully! You are now logged in.',
		'user_name' => $name,
	) );
}
add_action( 'wp_ajax_rikshawale_register', 'rikshawale_ajax_register' );
add_action( 'wp_ajax_nopriv_rikshawale_register', 'rikshawale_ajax_register' );

// 3. AJAX Vehicle Booking Submission (Auto Customer Account Creation Supported!)
function rikshawale_ajax_submit_booking() {
	check_ajax_referer( 'rikshawale_booking_nonce', 'nonce' );

	$user_id   = is_user_logged_in() ? get_current_user_id() : 0;
	$car_id    = intval( $_POST['car_id'] ?? 0 );
	$car_title = sanitize_text_field( $_POST['car_title'] ?? 'Vehicle' );
	$name      = sanitize_text_field( $_POST['booking_name'] ?? '' );
	$phone     = sanitize_text_field( $_POST['booking_phone'] ?? '' );
	$alt_phone = sanitize_text_field( $_POST['booking_alt_phone'] ?? '' );
	$email     = sanitize_email( $_POST['booking_email'] ?? '' );
	$city      = sanitize_text_field( $_POST['booking_city'] ?? '' );
	$date      = sanitize_text_field( $_POST['booking_date'] ?? '' );
	$message   = sanitize_textarea_field( $_POST['booking_message'] ?? '' );

	if ( empty( $name ) || empty( $phone ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => 'Name, Mobile number, and Email address are required.' ) );
	}

	$account_created = false;
	$random_pass     = '';

	// If guest user, create new subscriber account or associate existing account automatically!
	if ( ! $user_id ) {
		$existing_user = get_user_by( 'email', $email );
		if ( $existing_user ) {
			$user_id = $existing_user->ID;
			// Auto-login existing customer
			wp_set_current_user( $user_id );
			wp_set_auth_cookie( $user_id, true );
		} else {
			// Generate username from email or name
			$base_user = sanitize_user( current( explode( '@', $email ) ) );
			if ( empty( $base_user ) || strlen( $base_user ) < 3 ) {
				$base_user = 'cust_' . preg_replace( '/[^a-z0-9]/i', '', strtolower( $name ) );
			}
			$username = $base_user;
			if ( username_exists( $username ) ) {
				$username = $base_user . rand( 100, 9999 );
			}

			// Generate random password
			$random_pass = wp_generate_password( 10, false );
			$user_id     = wp_create_user( $username, $random_pass, $email );

			if ( ! is_wp_error( $user_id ) ) {
				wp_update_user( array(
					'ID'           => $user_id,
					'display_name' => $name,
					'first_name'   => $name,
					'role'         => 'subscriber',
				) );
				update_user_meta( $user_id, 'phone_number', $phone );

				// Auto-login newly created customer
				wp_set_current_user( $user_id );
				wp_set_auth_cookie( $user_id, true );
				$account_created = true;
			} else {
				$user_id = 0;
			}
		}
	}

	$post_title = $name . ' — ' . $car_title . ' (' . date('d M Y') . ')';

	$post_id = wp_insert_post( array(
		'post_type'   => 'riksha_booking',
		'post_title'  => $post_title,
		'post_status' => 'publish',
	) );

	if ( is_wp_error( $post_id ) ) {
		wp_send_json_error( array( 'message' => 'Failed to save booking. Please try again.' ) );
	}

	update_post_meta( $post_id, '_booking_user_id', $user_id );
	update_post_meta( $post_id, '_booking_car_id', $car_id );
	update_post_meta( $post_id, '_booking_car_title', $car_title );
	update_post_meta( $post_id, '_booking_name', $name );
	update_post_meta( $post_id, '_booking_phone', $phone );
	update_post_meta( $post_id, '_booking_alt_phone', $alt_phone );
	update_post_meta( $post_id, '_booking_email', $email );
	update_post_meta( $post_id, '_booking_city', $city );
	update_post_meta( $post_id, '_booking_date', $date );
	update_post_meta( $post_id, '_booking_message', $message );
	update_post_meta( $post_id, '_booking_status', 'Pending' );

	// Email Admin Notification
	$to      = get_option( 'admin_email' );
	$subject = '🛺 New Vehicle Booking Inquiry: ' . $car_title . ' by ' . $name;
	$body    = "Vehicle: {$car_title}\nCustomer Name: {$name}\nMobile No.: {$phone}\nAlternate No.: {$alt_phone}\nEmail: {$email}\nCity: {$city}\nPreferred Date: {$date}\n\nNotes:\n{$message}";
	if ( $account_created ) {
		$body .= "\n\n--- Customer Account Created ---\nUsername/Email: {$email}\nPassword: {$random_pass}";
	}
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" );
	wp_mail( $to, $subject, $body, $headers );

	// Email Customer Confirmation & Login Credentials
	if ( $account_created ) {
		$cust_subject = '🛺 Your Booking Inquiry & Account Login Details - Rikshawale';
		$cust_body    = "Namaste {$name},\n\nThank you for booking inquiry on Rikshawale for: {$car_title}.\n\nAn account has been automatically created for you to track your booking inquiry status:\nUsername / Email: {$email}\nPassword: {$random_pass}\n\nYou can log in anytime on Rikshawale to view your bookings.\n\nBest Regards,\nRikshawale Team";
		wp_mail( $email, $cust_subject, $cust_body, array( 'Content-Type: text/plain; charset=UTF-8' ) );
	}

	$res_msg = 'Your vehicle booking inquiry has been submitted successfully!';
	if ( $account_created ) {
		$res_msg .= ' A new customer account has been created for you & you are now logged in! (Login details sent to ' . esc_html($email) . ')';
	}

	wp_send_json_success( array(
		'message'         => $res_msg,
		'account_created' => $account_created,
		'logged_in'       => true,
		'user_name'       => $name,
	) );
}
add_action( 'wp_ajax_rikshawale_submit_booking', 'rikshawale_ajax_submit_booking' );
add_action( 'wp_ajax_nopriv_rikshawale_submit_booking', 'rikshawale_ajax_submit_booking' );

// 4. AJAX Get Logged-in User Bookings
function rikshawale_ajax_get_user_bookings() {
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
	}
	$user_id = get_current_user_id();

	$query = new WP_Query( array(
		'post_type'      => 'riksha_booking',
		'posts_per_page' => 20,
		'post_status'    => 'publish',
		'meta_key'       => '_booking_user_id',
		'meta_value'     => $user_id,
	) );

	$list = array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$p_id = get_the_ID();
			$car_title = get_post_meta( $p_id, '_booking_car_title', true );
			$car_id    = get_post_meta( $p_id, '_booking_car_id', true );
			$status    = get_post_meta( $p_id, '_booking_status', true ) ?: 'Pending';
			$date      = get_post_meta( $p_id, '_booking_date', true );
			$created   = get_the_date( 'd M Y' );
			$car_img   = ( $car_id && has_post_thumbnail( $car_id ) ) ? get_the_post_thumbnail_url( $car_id, 'thumbnail' ) : '';

			$list[] = array(
				'car_title' => $car_title,
				'car_link'  => $car_id ? get_permalink( $car_id ) : '#',
				'car_img'   => $car_img,
				'status'    => $status,
				'date'      => $date,
				'created'   => $created,
			);
		}
		wp_reset_postdata();
	}

	wp_send_json_success( array( 'bookings' => $list ) );
}
add_action( 'wp_ajax_rikshawale_get_user_bookings', 'rikshawale_ajax_get_user_bookings' );

/**
 * 5. AJAX Handler for Riksha & Vehicle Inventory Left Sidebar Filtering
 */
function rikshawale_ajax_filter_inventory() {
	check_ajax_referer( 'rikshawale_filter_nonce', 'nonce' );

	$keyword       = sanitize_text_field( $_POST['keyword'] ?? '' );
	$sort_by       = sanitize_text_field( $_POST['sort_by'] ?? 'date_desc' );
	$paged         = isset( $_POST['paged'] ) ? max( 1, intval( $_POST['paged'] ) ) : 1;
	$brands        = isset( $_POST['brand'] ) ? array_map( 'sanitize_text_field', (array) $_POST['brand'] ) : array();
	$models        = isset( $_POST['model'] ) ? array_map( 'sanitize_text_field', (array) $_POST['model'] ) : array();
	$fuels         = isset( $_POST['fuel'] ) ? array_map( 'sanitize_text_field', (array) $_POST['fuel'] ) : array();
	$years         = isset( $_POST['year'] ) ? array_map( 'sanitize_text_field', (array) $_POST['year'] ) : array();
	$transmissions = isset( $_POST['transmission'] ) ? array_map( 'sanitize_text_field', (array) $_POST['transmission'] ) : array();
	$owners        = isset( $_POST['owner'] ) ? array_map( 'sanitize_text_field', (array) $_POST['owner'] ) : array();
	$colors        = isset( $_POST['color'] ) ? array_map( 'sanitize_text_field', (array) $_POST['color'] ) : array();
	$locations     = isset( $_POST['location'] ) ? array_map( 'sanitize_text_field', (array) $_POST['location'] ) : array();
	$price_ranges  = isset( $_POST['price_range'] ) ? array_map( 'sanitize_text_field', (array) $_POST['price_range'] ) : array();
	$price_min     = isset( $_POST['price_min'] ) && $_POST['price_min'] !== '' ? floatval( $_POST['price_min'] ) : 0;
	$price_max     = isset( $_POST['price_max'] ) && $_POST['price_max'] !== '' ? floatval( $_POST['price_max'] ) : 0;

	$args = array(
		'post_type'      => array( 'inventory', 'riksha' ),
		'posts_per_page' => -1, // Fetch candidates for clean numeric price filtering
		'post_status'    => 'publish',
	);

	if ( ! empty( $locations ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'riksha_location',
				'field'    => 'slug',
				'terms'    => $locations,
			),
		);
	}

	if ( ! empty( $keyword ) ) {
		$args['s'] = $keyword;
	}

	// Meta Queries for non-price attributes
	$meta_query = array( 'relation' => 'AND' );

	if ( ! empty( $brands ) ) {
		$meta_query[] = array(
			'key'     => '_car_brand_name',
			'value'   => $brands,
			'compare' => 'IN',
		);
	}

	if ( ! empty( $fuels ) ) {
		$meta_query[] = array(
			'key'     => '_car_fuel',
			'value'   => $fuels,
			'compare' => 'IN',
		);
	}

	if ( ! empty( $years ) ) {
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key'     => '_car_mfg_year',
				'value'   => $years,
				'compare' => 'IN',
			),
			array(
				'key'     => '_car_reg_year',
				'value'   => $years,
				'compare' => 'IN',
			),
		);
	}

	if ( ! empty( $transmissions ) ) {
		$meta_query[] = array(
			'key'     => '_car_transmission',
			'value'   => $transmissions,
			'compare' => 'IN',
		);
	}

	if ( ! empty( $owners ) ) {
		$meta_query[] = array(
			'key'     => '_car_owner_type',
			'value'   => $owners,
			'compare' => 'IN',
		);
	}

	if ( ! empty( $colors ) ) {
		$meta_query[] = array(
			'key'     => '_car_color',
			'value'   => $colors,
			'compare' => 'IN',
		);
	}

	if ( count( $meta_query ) > 1 ) {
		$args['meta_query'] = $meta_query;
	}

	$all_query = new WP_Query( $args );

	$matched_posts = array();

	if ( $all_query->have_posts() ) {
		while ( $all_query->have_posts() ) {
			$all_query->the_post();
			$pid = get_the_ID();

			// Strip all commas, spaces, currency symbols to get pure numeric price
			$raw_price = get_post_meta( $pid, '_car_price', true ) ?: get_post_meta( $pid, '_riksha_price', true );
			$clean_val = floatval( preg_replace( '/[^0-9.]/', '', $raw_price ) );

			// Filter by Min Price Input
			if ( $price_min > 0 && $clean_val < $price_min ) {
				continue;
			}
			// Filter by Max Price Input
			if ( $price_max > 0 && $clean_val > $price_max ) {
				continue;
			}

			// Filter by Price Range Checkboxes
			if ( ! empty( $price_ranges ) ) {
				$range_matched = false;
				foreach ( $price_ranges as $pr ) {
					$parts = explode( '-', $pr );
					if ( count( $parts ) === 2 ) {
						$r_min = floatval( $parts[0] );
						$r_max = floatval( $parts[1] );
						if ( $clean_val >= $r_min && $clean_val <= $r_max ) {
							$range_matched = true;
							break;
						}
					}
				}
				if ( ! $range_matched ) {
					continue;
				}
			}

			// Filter by Color (case-insensitive)
			if ( ! empty( $colors ) ) {
				$p_color = trim( (string) get_post_meta( $pid, '_car_color', true ) );
				$color_match = false;
				foreach ( $colors as $c ) {
					if ( strtolower( $p_color ) === strtolower( $c ) || ( ! empty( $p_color ) && strpos( strtolower( $p_color ), strtolower( $c ) ) !== false ) ) {
						$color_match = true;
						break;
					}
				}
				if ( ! $color_match ) {
					continue;
				}
			}

			// Filter by Vehicle Model (case-insensitive)
			if ( ! empty( $models ) ) {
				$p_model     = trim( (string) get_post_meta( $pid, '_car_model_name', true ) );
				$p_title     = get_the_title( $pid );
				$model_match = false;
				foreach ( $models as $m ) {
					if ( ( ! empty( $p_model ) && strpos( strtolower( $p_model ), strtolower( $m ) ) !== false ) || strpos( strtolower( $p_title ), strtolower( $m ) ) !== false ) {
						$model_match = true;
						break;
					}
				}
				if ( ! $model_match ) {
					continue;
				}
			}

			$matched_posts[] = array(
				'id'         => $pid,
				'price_num'  => $clean_val,
				'year_num'   => floatval( get_post_meta( $pid, '_car_mfg_year', true ) ),
				'driven_num' => floatval( preg_replace('/[^0-9.]/', '', get_post_meta( $pid, '_car_driven_km', true ) ) ),
				'date'       => get_the_date( 'Y-m-d H:i:s' ),
			);
		}
		wp_reset_postdata();
	}

	// Sorting
	usort( $matched_posts, function( $a, $b ) use ( $sort_by ) {
		if ( $sort_by === 'price_asc' ) {
			return $a['price_num'] <=> $b['price_num'];
		} elseif ( $sort_by === 'price_desc' ) {
			return $b['price_num'] <=> $a['price_num'];
		} elseif ( $sort_by === 'year_desc' ) {
			return $b['year_num'] <=> $a['year_num'];
		} elseif ( $sort_by === 'mileage_asc' ) {
			return $a['driven_num'] <=> $b['driven_num'];
		} else {
			return strcmp( $b['date'], $a['date'] );
		}
	} );

	$total_found = count( $matched_posts );
	$per_page    = 12;
	$max_pages   = max( 1, ceil( $total_found / $per_page ) );
	$paged_posts = array_slice( $matched_posts, ( $paged - 1 ) * $per_page, $per_page );

	ob_start();
	$tags = array();

	foreach ( $brands as $b ) $tags[] = 'Brand: ' . $b;
	foreach ( $fuels as $f ) $tags[] = 'Fuel: ' . $f;
	foreach ( $years as $y ) $tags[] = 'Year: ' . $y;
	foreach ( $transmissions as $t ) $tags[] = 'Trans: ' . $t;
	foreach ( $colors as $c ) $tags[] = 'Color: ' . $c;
	if ( $price_min || $price_max ) $tags[] = 'Price: ₹' . number_format($price_min) . ' - ₹' . number_format($price_max);

	if ( ! empty( $paged_posts ) ) {
		foreach ( $paged_posts as $item ) {
			$p_id    = $item['id'];
			$p_price = rikshawale_get_formatted_price( $p_id );
			$p_year  = get_post_meta( $p_id, '_car_mfg_year', true ) ?: ( get_post_meta( $p_id, '_car_year', true ) ?: '2022' );
			$p_fuel  = get_post_meta( $p_id, '_car_fuel', true ) ?: 'Electric';
			$p_trans = get_post_meta( $p_id, '_car_transmission', true ) ?: 'Automatic';
			$p_km    = get_post_meta( $p_id, '_car_driven_km', true ) ?: '15,000 km';
			$raw_badge   = get_post_meta( $p_id, '_car_badge', true );
			$badge_clean = preg_replace( '/\s+/', ' ', strtolower( trim( (string) $raw_badge ) ) );
			if ( empty( $raw_badge ) || $badge_clean === 'none' || $badge_clean === 'no_badge' || $badge_clean === 'hide' || $badge_clean === 'no badge' ) {
				$p_badge        = '';
				$is_coming_soon = false;
			} else {
				$p_badge        = $raw_badge;
				$is_coming_soon = ( $badge_clean === 'coming soon' || strpos( $badge_clean, 'coming soon' ) !== false );
			}
			$thumb   = get_the_post_thumbnail_url( $p_id, 'medium' ) ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=500&q=80';
			$title   = get_the_title( $p_id );

			$num_p    = $item['price_num'] > 0 ? $item['price_num'] : 500000;
			$loan_amt = $num_p * 0.80;
			$rate_m   = (11.75 / 12) / 100;
			$pow_m    = pow(1 + $rate_m, 60);
			$est_emi  = round( $loan_amt * $rate_m * $pow_m / ($pow_m - 1) );
			?>
			<div class="col-lg-4 col-md-6 inventory-card-item">
				<div class="car-card-exact card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative">
					<a href="<?php echo get_permalink($p_id); ?>" class="car-card-img-link d-block position-relative bg-light text-center" style="height: 200px; overflow: hidden;">
						<?php if ( $p_badge ) : ?>
							<span class="car-card-badge <?php echo $is_coming_soon ? 'badge-coming-soon' : ''; ?>"><?php echo esc_html($p_badge); ?></span>
						<?php endif; ?>
						<?php if ( $is_coming_soon ) : ?>
							<div class="coming-soon-img-placeholder d-flex flex-column align-items-center justify-content-center w-100 h-100 p-3 text-white position-relative">
								<div class="coming-soon-glossy-icon mb-2">
									<i class="fa-solid fa-clock-rotate-left fs-4" style="color: #60a5fa; text-shadow: 0 0 12px rgba(96, 165, 250, 0.6);"></i>
								</div>
								<span class="fw-bold text-uppercase tracking-wider small mb-1" style="color: #f8fafc; font-family: var(--font-heading, sans-serif); letter-spacing: 1px; font-size: 0.78rem;">Coming Soon</span>
								<span class="extra-small text-white-50">Arriving in Live Inventory</span>
							</div>
						<?php else : ?>
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($title); ?>" class="w-100 h-100 object-fit-cover transition-all">
						<?php endif; ?>
					</a>
					<div class="card-body p-4 d-flex flex-column justify-content-between">
						<div>
							<h6 class="fw-bold text-dark text-truncate mb-2" title="<?php echo esc_attr($title); ?>">
								<a href="<?php echo get_permalink($p_id); ?>" class="text-dark text-decoration-none"><?php echo esc_html($title); ?></a>
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
								<a href="<?php echo get_permalink($p_id); ?>" class="btn btn-outline-dark btn-sm rounded-3 flex-grow-1 fw-bold">View Details</a>
								<?php if ( $is_coming_soon ) : ?>
									<button type="button" class="btn btn-secondary btn-sm rounded-3 fw-bold px-3" disabled style="opacity: 0.65; cursor: not-allowed; background: #64748b; border: none;">
										Book
									</button>
								<?php else : ?>
									<button type="button" class="btn btn-danger btn-sm rounded-3 fw-bold px-3" onclick="triggerVehicleBooking(<?php echo $p_id; ?>, '<?php echo esc_js($title); ?>', '<?php echo esc_js($p_price); ?>', '<?php echo esc_url($thumb); ?>')" style="background: linear-gradient(135deg, #0ea5e9 0%, #1e3a8a 100%); border:none;">
										Book
									</button>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		?>
		<div class="col-12 text-center py-5">
			<div class="p-5 bg-white rounded-4 shadow-sm">
				<i class="fa-solid fa-car-side fs-1 text-muted mb-3 d-block"></i>
				<h5 class="fw-bold text-dark">No Vehicles Match Your Selected Filters</h5>
				<p class="text-muted small">Try clearing some checkboxes or resetting all filters.</p>
				<button type="button" class="btn btn-primary rounded-pill px-4" onclick="resetAllFilters()">Reset All Filters</button>
			</div>
		</div>
		<?php
	}

	$html = ob_get_clean();

	$tag_html = '';
	foreach ( $tags as $t ) {
		$tag_html .= '<span class="badge bg-primary-subtle text-primary border border-primary-subtle extra-small rounded-pill px-2 py-1 me-1 mb-1">' . esc_html($t) . '</span>';
	}

	wp_send_json_success( array(
		'html'      => $html,
		'count'     => $total_found,
		'max_pages' => $max_pages,
		'tags'      => $tag_html,
	) );
}
add_action( 'wp_ajax_rikshawale_filter_inventory', 'rikshawale_ajax_filter_inventory' );
add_action( 'wp_ajax_nopriv_rikshawale_filter_inventory', 'rikshawale_ajax_filter_inventory' );

/**
 * Append Places Mega Menu item to Primary Nav Menu (Dynamically showing logged-in user place)
 */
function rikshawale_add_places_mega_menu_to_nav( $items, $args ) {
	if ( isset( $args->theme_location ) && $args->theme_location === 'primary' ) {
		$current_place_label = 'Places';

		// 1. Check logged-in user meta
		if ( is_user_logged_in() ) {
			$user_id    = get_current_user_id();
			$user_place = get_user_meta( $user_id, 'user_place', true );
			if ( empty( $user_place ) ) {
				$user_place = get_user_meta( $user_id, 'city', true );
			}
			if ( empty( $user_place ) ) {
				$user_place = get_user_meta( $user_id, 'billing_city', true );
			}
			if ( ! empty( $user_place ) ) {
				$current_place_label = esc_html( $user_place );
			}
		}

		// 2. Check cookie if user meta is empty or not logged in
		if ( $current_place_label === 'Places' && ! empty( $_COOKIE['user_selected_place'] ) ) {
			$current_place_label = esc_html( sanitize_text_field( $_COOKIE['user_selected_place'] ) );
		}

		// 3. Check query param if currently filtering by location
		if ( ! empty( $_GET['location'] ) ) {
			$loc_slug = is_array( $_GET['location'] ) ? $_GET['location'][0] : $_GET['location'];
			$term     = get_term_by( 'slug', sanitize_text_field( $loc_slug ), 'riksha_location' );
			if ( $term && ! is_wp_error( $term ) ) {
				$current_place_label = esc_html( $term->name );
			}
		}

		$locations = get_terms( array(
			'taxonomy'   => 'riksha_location',
			'hide_empty' => false,
		) );

		$location_links_html = '';
		if ( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
			$cols = array_chunk( $locations, ceil( count( $locations ) / 3 ) );
			foreach ( $cols as $col_terms ) {
				$location_links_html .= '<div class="col-lg-4 col-md-6 col-12 mb-2">';
				$location_links_html .= '<ul class="list-unstyled mb-0 px-1">';
				foreach ( $col_terms as $term ) {
					$url          = add_query_arg( 'location[]', $term->slug, home_url( '/inventory/' ) );
					$is_active    = ( strtolower( $current_place_label ) === strtolower( $term->name ) );
					$active_class = $is_active ? 'bg-danger-subtle text-danger fw-bold' : 'text-dark fw-semibold';

					$location_links_html .= '<li class="mb-2">';
					$location_links_html .= '<a href="' . esc_url( $url ) . '" onclick="saveUserSelectedPlace(\'' . esc_js( $term->name ) . '\')" class="mega-city-link text-decoration-none ' . $active_class . ' d-flex align-items-center justify-content-between py-1 px-2 rounded-2" style="font-size: 0.9rem;">';
					$location_links_html .= '<span>Riksha in ' . esc_html( $term->name ) . ( $is_active ? ' <small class="badge bg-danger ms-1" style="font-size:0.65rem;">Active</small>' : '' ) . '</span>';
					$location_links_html .= '<span class="arrow-icon text-secondary small ms-2">↗</span>';
					$location_links_html .= '</a>';
					$location_links_html .= '</li>';
				}
				$location_links_html .= '</ul>';
				$location_links_html .= '</div>';
			}
		} else {
			$location_links_html = '<div class="col-12"><p class="text-muted small mb-0">No places added yet.</p></div>';
		}

		$mega_menu_item  = '<li class="nav-item dropdown position-static mega-places-menu-item ms-lg-2">';
		$mega_menu_item .= '<a class="nav-link dropdown-toggle fw-bold text-dark d-inline-flex align-items-center gap-1 py-2" href="#" id="placesNavMegaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.95rem;">';
		$mega_menu_item .= '<i class="fa-solid fa-location-dot text-danger"></i> <span id="currentPlacesLabel">' . $current_place_label . '</span>';
		$mega_menu_item .= '</a>';
		$mega_menu_item .= '<div class="dropdown-menu w-100 shadow-lg border-0 rounded-4 p-4 mt-1 mega-dropdown-panel" aria-labelledby="placesNavMegaDropdown" style="left: 0; right: 0; background: #ffffff; border-top: 3px solid var(--primary-color, #db2d2e) !important;">';
		$mega_menu_item .= '<div class="container" style="max-width: 1140px;">';
		$mega_menu_item .= '<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pb-3 mb-3 border-bottom">';
		$mega_menu_item .= '<div><h6 class="fw-bold text-dark mb-0 fs-6"><i class="fa-solid fa-city text-danger me-2"></i> Buy / Filter Riksha by City & Place</h6><p class="text-muted extra-small mb-0 mt-1">Select your city to view available commercial rikshas & vehicles</p></div>';
		$mega_menu_item .= '<a href="' . esc_url( home_url( '/inventory/' ) ) . '" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold extra-small text-nowrap">View All Places &rarr;</a>';
		$mega_menu_item .= '</div>';
		$mega_menu_item .= '<div class="row g-3">' . $location_links_html . '</div>';
		$mega_menu_item .= '</div>';
		$mega_menu_item .= '</div>';
		$mega_menu_item .= '</li>';

		$items .= $mega_menu_item;
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'rikshawale_add_places_mega_menu_to_nav', 10, 2 );

/**
 * AJAX Handler: Save Selected User Place
 */
function rikshawale_save_user_place_ajax() {
	$place = isset( $_POST['place'] ) ? sanitize_text_field( $_POST['place'] ) : '';
	if ( ! empty( $place ) ) {
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();
			update_user_meta( $user_id, 'user_place', $place );
			update_user_meta( $user_id, 'city', $place );
		}
		wp_send_json_success( array( 'place' => $place ) );
	}
	wp_send_json_error( array( 'message' => 'Invalid place' ) );
}
add_action( 'wp_ajax_rikshawale_save_user_place', 'rikshawale_save_user_place_ajax' );
add_action( 'wp_ajax_nopriv_rikshawale_save_user_place', 'rikshawale_save_user_place_ajax' );

/**
 * WP Profile Settings Field for Location / Place
 */
function rikshawale_show_extra_profile_fields( $user ) {
	$user_place = get_user_meta( $user->ID, 'user_place', true );
	?>
	<h3><?php _e( 'Location / Place Details', 'rikshawale-theme' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="user_place"><?php _e( 'Current Location / City', 'rikshawale-theme' ); ?></label></th>
			<td>
				<input type="text" name="user_place" id="user_place" value="<?php echo esc_attr( $user_place ); ?>" class="regular-text" placeholder="e.g. Delhi NCR, Mumbai, Patna" /><br />
				<span class="description"><?php _e( 'Your preferred location / city for commercial riksha inventory.', 'rikshawale-theme' ); ?></span>
			</td>
		</tr>
	</table>
	<?php
}
add_action( 'show_user_profile', 'rikshawale_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'rikshawale_show_extra_profile_fields' );

function rikshawale_save_extra_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
	if ( isset( $_POST['user_place'] ) ) {
		update_user_meta( $user_id, 'user_place', sanitize_text_field( $_POST['user_place'] ) );
		update_user_meta( $user_id, 'city', sanitize_text_field( $_POST['user_place'] ) );
	}
}
add_action( 'personal_options_update', 'rikshawale_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'rikshawale_save_extra_profile_fields' );

/* ============================================================
   AI SALES ASSISTANT CHATBOT AJAX HANDLER
   ============================================================ */
function rikshawale_handle_ai_chat() {
    $user_msg = isset( $_POST['message'] ) ? sanitize_text_field( wp_unslash( $_POST['message'] ) ) : '';
    if ( empty( $user_msg ) ) {
        wp_send_json_error( array( 'reply' => 'Please type a message.' ) );
    }

    // 1. Fetch published inventory items
    $query = new WP_Query( array(
        'post_type'      => array( 'inventory', 'riksha' ),
        'post_status'    => 'publish',
        'posts_per_page' => 25,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    $inventory_list = array();
    $inventory_context_text = "";

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $pid = get_the_ID();
            $title = get_the_title();
            $price = rikshawale_get_formatted_price( $pid );
            $raw_price = get_post_meta( $pid, '_car_price', true ) ?: ( get_post_meta( $pid, '_car_expected_price', true ) ?: '' );
            $num_price = preg_replace('/[^0-9]/', '', $raw_price);
            $num_price = $num_price ? floatval($num_price) : 0;
            
            $brand     = get_post_meta( $pid, '_car_brand_name', true ) ?: ( get_post_meta( $pid, '_riksha_brand_name', true ) ?: 'Riksha' );
            $model     = get_post_meta( $pid, '_car_model_name', true ) ?: 'Standard';
            $mfg_year  = get_post_meta( $pid, '_car_mfg_year', true ) ?: ( get_post_meta( $pid, '_car_year', true ) ?: '2022' );
            $fuel      = get_post_meta( $pid, '_car_fuel', true ) ?: 'CNG';
            $driven_km = get_post_meta( $pid, '_car_driven_km', true ) ?: ( get_post_meta( $pid, '_car_mileage', true ) ?: '' );
            $owner     = get_post_meta( $pid, '_car_owner_type', true ) ?: '1st Owner';
            $img_url   = get_the_post_thumbnail_url( $pid, 'medium' ) ?: ( get_post_meta( $pid, '_car_gallery_image_1', true ) ?: '' );
            $permalink = get_permalink( $pid );

            // Location taxonomy terms
            $locations = wp_get_post_terms( $pid, 'riksha_location', array( 'fields' => 'names' ) );
            $loc_str   = ( ! is_wp_error( $locations ) && ! empty( $locations ) ) ? implode( ', ', $locations ) : 'India';

            $item_data = array(
                'id'        => $pid,
                'title'     => $title,
                'brand'     => $brand,
                'model'     => $model,
                'year'      => $mfg_year,
                'fuel'      => $fuel,
                'driven'    => $driven_km,
                'owner'     => $owner,
                'location'  => $loc_str,
                'price'     => $price,
                'num_price' => $num_price,
                'image'     => $img_url,
                'link'      => $permalink,
            );

            $inventory_list[] = $item_data;
            $inventory_context_text .= "- ID: {$pid} | Title: {$title} | Brand: {$brand} | Price: {$price} (numeric ₹{$num_price}) | Fuel: {$fuel} | Year: {$mfg_year} | Location: {$loc_str} | Link: {$permalink}\n";
        }
        wp_reset_postdata();
    }

    // 2. Call Gemini API if Key Available
    $api_key = get_option( 'rikshawale_gemini_api_key', '' );
    $ai_reply = '';
    $matching_ids = array();

    if ( ! empty( $api_key ) ) {
        $endpoints = array(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . urlencode($api_key),
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . urlencode($api_key),
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-lite-latest:generateContent?key=' . urlencode($api_key),
        );

        $prompt_text = "You are Rikshawale AI Assistant, a friendly, helpful commercial Rickshaw sales expert in India.\n"
                     . "Answer in polite, concise Hindi/Hinglish (or English if requested).\n"
                     . "Here is our current LIVE Published Rickshaw Inventory:\n"
                     . $inventory_context_text . "\n"
                     . "User Query: \"{$user_msg}\"\n\n"
                     . "Task: Recommend the best matching Rickshaws from the live inventory list above.\n"
                     . "Provide a JSON response ONLY in this structure without markdown formatting:\n"
                     . '{"reply": "Polite conversation answer in Hinglish highlighting top options", "matched_ids": [123, 456]}';

        $request_body = json_encode( array(
            'contents' => array( array( 'parts' => array( array( 'text' => $prompt_text ) ) ) )
        ) );

        foreach ( $endpoints as $endpoint ) {
            $res = wp_remote_post( $endpoint, array(
                'headers' => array( 'Content-Type' => 'application/json' ),
                'body'    => $request_body,
                'timeout' => 12,
            ) );

            if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
                $body = json_decode( wp_remote_retrieve_body( $res ), true );
                if ( isset( $body['candidates'][0]['content']['parts'][0]['text'] ) ) {
                    $raw_text = $body['candidates'][0]['content']['parts'][0]['text'];
                    $clean_json = preg_replace('/^```(?:json)?\s*|\s*```$/i', '', trim($raw_text));
                    $parsed = json_decode( $clean_json, true );
                    if ( $parsed && isset( $parsed['reply'] ) ) {
                        $ai_reply = sanitize_text_field( $parsed['reply'] );
                        if ( isset( $parsed['matched_ids'] ) && is_array( $parsed['matched_ids'] ) ) {
                            $matching_ids = array_map( 'intval', $parsed['matched_ids'] );
                        }
                        break;
                    }
                }
            }
        }
    }

    // 3. Fallback PHP Logic if Gemini reply is empty or API unavailable
    if ( empty( $ai_reply ) ) {
        $low_msg = strtolower( $user_msg );
        $filtered = array();

        foreach ( $inventory_list as $item ) {
            if ( preg_match( '/\b(e-rickshaw|electric|ev)\b/i', $low_msg ) && strtolower($item['fuel']) === 'electric' ) {
                $filtered[] = $item['id'];
            } elseif ( preg_match( '/\b(cng|gas)\b/i', $low_msg ) && strtolower($item['fuel']) === 'cng' ) {
                $filtered[] = $item['id'];
            } elseif ( preg_match( '/\b(diesel|petrol)\b/i', $low_msg ) && strtolower($item['fuel']) === strtolower(preg_replace('/.*(diesel|petrol).*/i', '$1', $low_msg)) ) {
                $filtered[] = $item['id'];
            } elseif ( strpos( $low_msg, strtolower($item['brand']) ) !== false ) {
                $filtered[] = $item['id'];
            }
        }

        if ( empty( $filtered ) && ! empty( $inventory_list ) ) {
            $filtered = array_slice( array_column( $inventory_list, 'id' ), 0, 3 );
        }

        $matching_ids = array_unique( $filtered );
        $count = count( $matching_ids );
        if ( $count > 0 ) {
            $ai_reply = "Aapke liye humare paas {$count} sabse best Commercial Rickshaw options available hain! Niche dekhiye:";
        } else {
            $ai_reply = "Namaste! Aap kis budget ya brand ki Rickshaw dhoond rahe hain? Humare paas Electric, CNG aur Diesel options available hain.";
        }
    }

    // 4. Gather matched vehicle objects
    $matched_vehicles = array();
    if ( ! empty( $matching_ids ) ) {
        foreach ( $inventory_list as $item ) {
            if ( in_array( $item['id'], $matching_ids, true ) ) {
                $matched_vehicles[] = $item;
            }
        }
    }

    wp_send_json_success( array(
        'reply'    => $ai_reply,
        'vehicles' => array_slice($matched_vehicles, 0, 4),
    ) );
}
add_action( 'wp_ajax_rikshawale_ai_chat', 'rikshawale_handle_ai_chat' );
add_action( 'wp_ajax_nopriv_rikshawale_ai_chat', 'rikshawale_handle_ai_chat' );

/* ============================================================
   SELL A RIKSHA AJAX SUBMISSION HANDLER
   ============================================================ */
function rikshawale_handle_sell_car_ajax() {
    check_ajax_referer( 'rikshawale_sell_car_action', 'rikshawale_sell_car_nonce' );

    $seller_name  = isset( $_POST['seller_name'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_name'] ) ) : '';
    $seller_phone = isset( $_POST['seller_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_phone'] ) ) : '';
    $seller_wa    = isset( $_POST['seller_wa'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_wa'] ) ) : '';
    $seller_city  = isset( $_POST['seller_city'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_city'] ) ) : '';
    $seller_reg   = isset( $_POST['seller_reg_no'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_reg_no'] ) ) : '';
    $seller_state = isset( $_POST['seller_state'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_state'] ) ) : '';

    $mfg_year     = isset( $_POST['riksha_mfg_year'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_mfg_year'] ) ) : '';
    $reg_year     = isset( $_POST['riksha_reg_year'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_reg_year'] ) ) : '';
    $owner_type   = isset( $_POST['riksha_owner_type'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_owner_type'] ) ) : '';
    $brand_name   = isset( $_POST['riksha_brand_name'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_brand_name'] ) ) : '';
    $model_name   = isset( $_POST['riksha_model_name'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_model_name'] ) ) : '';
    $variant      = isset( $_POST['riksha_variant'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_variant'] ) ) : '';
    $driven_km    = isset( $_POST['riksha_driven_km'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_driven_km'] ) ) : '';
    $fuel         = isset( $_POST['riksha_fuel'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_fuel'] ) ) : '';
    $trans        = isset( $_POST['riksha_transmission'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_transmission'] ) ) : '';
    $price        = isset( $_POST['riksha_expected_price'] ) ? sanitize_text_field( wp_unslash( $_POST['riksha_expected_price'] ) ) : '';
    $youtube_url  = isset( $_POST['riksha_video_url'] ) ? esc_url_raw( wp_unslash( $_POST['riksha_video_url'] ) ) : '';

    if ( empty( $seller_name ) || empty( $seller_phone ) || empty( $brand_name ) || empty( $model_name ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    $title = sprintf( '%s %s (%s) - %s', $brand_name, $model_name, $mfg_year, $seller_name );

    $post_data = array(
        'post_title'   => $title,
        'post_status'  => 'pending', // Pending admin approval before publishing to inventory
        'post_type'    => 'inventory',
        'post_content' => sprintf( "Seller Name: %s\nMobile: %s\nWhatsApp: %s\nCity: %s, %s\nReg No: %s", $seller_name, $seller_phone, $seller_wa, $seller_city, $seller_state, $seller_reg ),
    );

    $post_id = wp_insert_post( $post_data );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Failed to save submission. Please try again.' ) );
    }

    // Save meta data
    update_post_meta( $post_id, '_car_brand_name', $brand_name );
    update_post_meta( $post_id, '_car_model_name', $model_name );
    update_post_meta( $post_id, '_car_variant', $variant );
    update_post_meta( $post_id, '_car_mfg_year', $mfg_year );
    update_post_meta( $post_id, '_car_reg_year', $reg_year );
    update_post_meta( $post_id, '_car_owner_type', $owner_type );
    update_post_meta( $post_id, '_car_driven_km', $driven_km );
    update_post_meta( $post_id, '_car_fuel', $fuel );
    update_post_meta( $post_id, '_car_transmission', $trans );
    update_post_meta( $post_id, '_car_price', $price );
    update_post_meta( $post_id, '_car_seller_name', $seller_name );
    update_post_meta( $post_id, '_car_seller_phone', $seller_phone );
    update_post_meta( $post_id, '_car_seller_wa', $seller_wa );
    update_post_meta( $post_id, '_car_seller_city', $seller_city );
    update_post_meta( $post_id, '_car_seller_state', $seller_state );

    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    // Handle 5 image uploads
    $first_img_set = false;
    for ( $i = 1; $i <= 5; $i++ ) {
        $file_key = 'riksha_image_' . $i;
        if ( ! empty( $_FILES[ $file_key ]['name'] ) ) {
            $attachment_id = media_handle_upload( $file_key, $post_id );
            if ( ! is_wp_error( $attachment_id ) ) {
                $img_url = wp_get_attachment_url( $attachment_id );
                update_post_meta( $post_id, "_car_gallery_image_{$i}", $img_url );
                if ( ! $first_img_set ) {
                    set_post_thumbnail( $post_id, $attachment_id );
                    $first_img_set = true;
                }
            }
        }
    }

    // Handle Video File Upload or YouTube Link
    $final_video_url = '';
    if ( ! empty( $_FILES['riksha_video_file']['name'] ) ) {
        $video_attachment_id = media_handle_upload( 'riksha_video_file', $post_id );
        if ( ! is_wp_error( $video_attachment_id ) ) {
            $final_video_url = wp_get_attachment_url( $video_attachment_id );
        }
    }

    if ( empty( $final_video_url ) && ! empty( $youtube_url ) ) {
        $final_video_url = $youtube_url;
    }

    if ( ! empty( $final_video_url ) ) {
        update_post_meta( $post_id, '_car_video_url', $final_video_url );
    }

    wp_send_json_success( array( 'message' => 'Thank you! Your Riksha details and video have been submitted successfully and are pending approval.' ) );
}
add_action( 'wp_ajax_rikshawale_sell_car', 'rikshawale_handle_sell_car_ajax' );
add_action( 'wp_ajax_nopriv_rikshawale_sell_car', 'rikshawale_handle_sell_car_ajax' );

