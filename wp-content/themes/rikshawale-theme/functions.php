<?php
/**
 * Rikshawale Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

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
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true, // Enables Gutenberg editor support
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
		'priority' => 35,
	) );

	// Phone
	$wp_customize->add_setting( 'contact_phone', array(
		'default'           => '+91 97111-63000',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_phone', array(
		'label'   => __( 'Phone Number', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'text',
	) );

	// Email
	$wp_customize->add_setting( 'contact_email', array(
		'default'           => 'EliteCarzIndia@gmail.com',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'contact_email', array(
		'label'   => __( 'E-mail Address', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'email',
	) );

	// Address
	$wp_customize->add_setting( 'contact_address', array(
		'default'           => 'Indra Market, CB-382, Ring Rd, Block CB, Naraina Village, Naraina, New Delhi, Delhi 110028',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'contact_address', array(
		'label'   => __( 'Address', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'textarea',
	) );

	// Working Hours
	$wp_customize->add_setting( 'contact_working_hours', array(
		'default'           => 'Mon-Sun: 11:00am - 7:00pm',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_working_hours', array(
		'label'   => __( 'Working Time', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'text',
	) );

	// Subtitle / Intro text
	$wp_customize->add_setting( 'contact_form_title', array(
		'default'           => 'Get in touch',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_form_title', array(
		'label'   => __( 'Form Title / Heading', 'rikshawale-theme' ),
		'section' => 'rikshawale_contact_info_section',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'contact_intro_text', array(
		'default'           => 'EliteCarz is a pre-owned car dealership in Delhi NCR, offering handpicked, fully inspected vehicles with warranty and complete peace of mind.',
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
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'inventory', $args );
}
add_action( 'init', 'rikshawale_register_inventory_cpt' );

/**
 * Register Custom Taxonomies for Riksha Inventory
 */
function rikshawale_register_inventory_taxonomies() {
	// Riksha Models
	register_taxonomy( 'car_model', array( 'inventory' ), array(
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
	register_taxonomy( 'car_brand', array( 'inventory' ), array(
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
 * Render Riksha Inventory Details Metabox Content
 */
function rikshawale_render_inventory_metabox( $post ) {
    wp_nonce_field( 'rikshawale_save_inventory_meta', 'rikshawale_inventory_meta_nonce' );

    $price          = get_post_meta( $post->ID, '_car_price', true );
    $mfg_year       = get_post_meta( $post->ID, '_car_mfg_year', true ) ?: get_post_meta( $post->ID, '_car_year', true );
    $reg_year       = get_post_meta( $post->ID, '_car_reg_year', true );
    $owner_type     = get_post_meta( $post->ID, '_car_owner_type', true );
    $brand_name     = get_post_meta( $post->ID, '_car_brand_name', true );
    $model_name     = get_post_meta( $post->ID, '_car_model_name', true );
    $variant        = get_post_meta( $post->ID, '_car_variant', true );
    $driven_km      = get_post_meta( $post->ID, '_car_driven_km', true ) ?: get_post_meta( $post->ID, '_car_mileage', true );
    $fuel           = get_post_meta( $post->ID, '_car_fuel', true );
    $transmission   = get_post_meta( $post->ID, '_car_transmission', true );
    $badge          = get_post_meta( $post->ID, '_car_badge', true );
    $video_url      = get_post_meta( $post->ID, '_car_video_url', true );

    // 5 Gallery Images
    $img1           = get_post_meta( $post->ID, '_car_gallery_image_1', true );
    $img2           = get_post_meta( $post->ID, '_car_gallery_image_2', true );
    $img3           = get_post_meta( $post->ID, '_car_gallery_image_3', true );
    $img4           = get_post_meta( $post->ID, '_car_gallery_image_4', true );
    $img5           = get_post_meta( $post->ID, '_car_gallery_image_5', true );

    $transmissions = array( 'Automatic' => 'Automatic', 'Manual' => 'Manual' );
    $fuels         = array( 'Petrol' => 'Petrol', 'Diesel' => 'Diesel', 'Electric' => 'Electric', 'CNG' => 'CNG', 'LPG' => 'LPG', 'Hybrid' => 'Hybrid' );
    $owners        = array( '1st Owner' => '1st Owner', '2nd Owner' => '2nd Owner', '3rd Owner' => '3rd Owner', '4th+ Owner' => '4th+ Owner' );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="car_price"><?php _e( 'Selling Price', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_price" name="car_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="e.g. ₹10.75 Lakh"></td>
        </tr>
        <tr>
            <th><label for="car_video_url"><?php _e( '🎬 Banner Video URL (Auto-Play)', 'rikshawale-theme' ); ?></label></th>
            <td>
                <input type="text" id="car_video_url" name="car_video_url" value="<?php echo esc_attr( $video_url ); ?>" class="regular-text" placeholder="Direct MP4 URL or YouTube Link (e.g. https://domain.com/video.mp4)">
                <p class="description"><?php _e( 'Enter direct MP4 video link or YouTube URL to autoplay in vehicle banner slider.', 'rikshawale-theme' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="car_badge"><?php _e( 'Ribbon Badge Tag', 'rikshawale-theme' ); ?></label></th>
            <td><input type="text" id="car_badge" name="car_badge" value="<?php echo esc_attr( $badge ); ?>" class="regular-text" placeholder="e.g. LIMITED OFFER, COMING SOON, FEATURED"></td>
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
                        <option value="<?php echo esc_attr($k); ?>" <?php selected( $owner_type, $k ); ?>><?php echo esc_html($v); ?></option>
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
        'car_price',
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

	register_taxonomy( 'riksha_type', array( 'riksha' ), $args );
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

	register_taxonomy( 'riksha_brand', array( 'riksha' ), $args );
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
 * Theme Customizer settings for dynamic header and footer
 */
function rikshawale_customize_register( $wp_customize ) {
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
	$wp_customize->add_section( 'rikshawale_topbar_section', array(
		'title'       => __( 'Header Top Bar Settings', 'rikshawale-theme' ),
		'priority'    => 29,
		'description' => __( 'Configure the contact details and social icons in the Top Bar', 'rikshawale-theme' ),
	) );

	// Phone Number
	$wp_customize->add_setting( 'topbar_phone', array(
		'default'           => '+91 98765 43210',
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
		'default'           => 'info@rikshawale.com',
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
		'default'           => 'Mon - Sat: 8:00 AM - 6:00 PM',
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
		'default'           => '#',
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
		'default'           => '#',
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
		'default'           => '#',
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
		'default'           => '© ' . date('Y') . ' Rikshawale. All rights reserved.',
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
		'default'           => 'PREMIUM PRE-OWNED AUTOMOTIVE EXPERIENCE',
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
		'default'           => 'Trusted marketplace for certified pre-owned three-wheelers — transparent pricing, easy finance & 30-day warranty.',
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
		'default'           => "Indra Market, CB-382, Ring Rd, Block CB, Naraina Village, Naraina, New Delhi, Delhi 110028",
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
		'default'           => 'BUILDING INDIA\'S LARGEST TRUSTED MARKETPLACE',
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
		'default'           => 'ABOUT US',
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
		'default'           => 'Rikshawale.com is a technology-driven marketplace for certified pre-owned three-wheelers, connecting buyers and sellers through a trusted, transparent, and hassle-free platform. Every vehicle undergoes a standardized inspection and quality check, with access to refurbishment, financing assistance, warranty support, and seamless ownership transfer. Our mission is to organize and modernize India\'s highly fragmented used commercial vehicle market, making every transaction simple, secure, and reliable.',
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
		'default'           => 'ALL RIKSHAS',
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
		'default'           => 'Every riksha undergoes a rigorous 40-point inspection and quality certification before listing.',
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
		'default'           => 'FREE SUPPORT',
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
		'default'           => 'Our team is available 7 days a week to assist with financing, RC transfer, and after-sale support.',
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
		'default'           => 'CERTIFIED',
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
		'default'           => 'Buy with confidence — every riksha comes with transparent pricing and a verified ownership history.',
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
		'default'           => 'EASY FINANCE',
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
		'default'           => 'Low EMI options with instant loan approvals and flexible repayment plans for every budget.',
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
		'default'           => 'Have any question ?',
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
		'default'           => 'Why Choose Rikshawale',
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
		'default'           => 'We provide unmatched commercial transport solutions',
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
		'default'           => 'Verified Inventory',
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
		'default'           => 'Every auto or e-rickshaw listed on our platform undergoes extensive quality assessments and certification checks.',
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
		'default'           => 'Flexible Finance',
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
		'default'           => 'Get instant commercial approvals, affordable EMI interest options, and flexible auto lease programs customized for you.',
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
		'default'           => '24/7 Roadside Support',
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
		'default'           => 'We keep your business moving with dedicated call assistance, roadside towing, and certified mechanics nearby.',
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
		'default'           => 'Looking for a custom commercial fleet?',
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
		'default'           => 'Connect with our executives to get custom branding, bulk order discount rates, and tax rebates.',
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
		'default'           => 'Contact Us Today',
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
		'default'           => 'Customer Testimonials',
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
		'default'           => 'What our fleet managers and drivers say about us',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'testimonials_subtitle', array(
		'type'     => 'text',
		'label'    => __( 'Testimonials Section Subtitle', 'rikshawale-theme' ),
		'section'  => 'rikshawale_extra_homepage_sections',
		'settings' => 'testimonials_subtitle',
	) );

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
	$wp_customize->add_setting( 'inventory_subtitle', array( 'default' => 'Browse Our Collection', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'inventory_subtitle', array( 'type' => 'text', 'label' => 'Inventory Section Subtitle/Eyebrow', 'section' => 'rikshawale_inventory_section' ) );

	$wp_customize->add_setting( 'inventory_title', array( 'default' => 'Car Inventory', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'inventory_title', array( 'type' => 'text', 'label' => 'Inventory Section Title', 'section' => 'rikshawale_inventory_section' ) );

	$wp_customize->add_setting( 'inventory_description', array( 'default' => 'Certified pre-owned rikshas with 40-point inspection, transparent pricing, easy financing, and 30-day warranty.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh' ) );
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

	$wp_customize->add_setting( 'video_section_title', array( 'default' => 'Watch Us In Action', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'video_section_title', array( 'type' => 'text', 'label' => 'Video Section Title', 'section' => 'rikshawale_video_section' ) );

	$wp_customize->add_setting( 'video_section_subtitle', array( 'default' => 'Explore our latest arrivals and customer stories', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
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
	$wp_customize->add_setting( 'new_arrivals_subtitle', array( 'default' => 'Explore', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'new_arrivals_subtitle', array( 'type' => 'text', 'label' => 'New Arrivals Subtitle/Eyebrow', 'section' => 'rikshawale_new_arrivals_section' ) );

	$wp_customize->add_setting( 'new_arrivals_title', array( 'default' => 'New Arrivals', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
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
		'default'           => "Key Challenges in India's Pre-Owned Three-Wheeler Market",
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'services_section_title', array(
		'type'     => 'text',
		'label'    => __( 'Services Section Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_services_section',
	) );

	$wp_customize->add_setting( 'services_insight_title', array(
		'default'           => 'Key Investor Insight',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'services_insight_title', array(
		'type'     => 'text',
		'label'    => __( 'Investor Insight Title', 'rikshawale-theme' ),
		'section'  => 'rikshawale_services_section',
	) );

	$wp_customize->add_setting( 'services_insight_text', array(
		'default'           => "India's pre-owned three-wheeler market remains highly fragmented, creating a significant opportunity for a trusted, technology-enabled platform that standardizes sourcing, inspection, financing, and ownership transfer.",
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
	$wp_customize->add_setting( 'faq_section_title', array( 'default' => 'Frequently Asked Questions', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
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
    $seller_reg_no = sanitize_text_field( $_POST['seller_reg_no'] ?? '' );
    $seller_state  = sanitize_text_field( $_POST['seller_state']  ?? '' );

    $mfg_year      = sanitize_text_field( $_POST['car_mfg_year']      ?? '' );
    $reg_year      = sanitize_text_field( $_POST['car_reg_year']      ?? '' );
    $owner_type    = sanitize_text_field( $_POST['car_owner_type']    ?? '' );
    $brand_name    = sanitize_text_field( $_POST['car_brand_name']    ?? '' );
    $model_name    = sanitize_text_field( $_POST['car_model_name']    ?? '' );
    $variant       = sanitize_text_field( $_POST['car_variant']       ?? '' );
    $driven_km     = sanitize_text_field( $_POST['car_driven_km']     ?? '' );
    $fuel          = sanitize_text_field( $_POST['car_fuel']          ?? '' );
    $transmission  = sanitize_text_field( $_POST['car_transmission']  ?? '' );
    $exp_price     = sanitize_text_field( $_POST['car_expected_price']?? '' );

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
        '_car_brand_name'      => $brand_name,
        '_car_model_name'      => $model_name,
        '_car_variant'         => $variant,
        '_car_driven_km'       => $driven_km,
        '_car_fuel'            => $fuel,
        '_car_transmission'    => $transmission,
        '_car_expected_price'  => $exp_price,
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
        $file_key = 'car_image_' . $i;
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

    // Send admin notification email
    $admin_email = get_option( 'admin_email' );
    $subject = 'New Sell Car Request: ' . $post_title;
    $body  = "New sell car submission received!\n\n";
    $body .= "Seller: {$seller_name}\nPhone: {$seller_phone}\nWhatsApp: {$seller_wa}\nCity: {$seller_city}\nState: {$seller_state}\n\n";
    $body .= "Vehicle: {$brand_name} {$model_name} {$variant}\nMfg Year: {$mfg_year}\nReg Year: {$reg_year}\nOwner: {$owner_type}\n";
    $body .= "Driven: {$driven_km}\nFuel: {$fuel}\nTransmission: {$transmission}\nExpected Price: {$exp_price}\n\n";
    $body .= "Review in admin: " . admin_url( 'post.php?post=' . $post_id . '&action=edit' );
    wp_mail( $admin_email, $subject, $body );

    wp_send_json_success( array(
        'message' => 'Thank you! Your request has been submitted. Our team will contact you shortly.',
    ) );
}
add_action( 'wp_ajax_rikshawale_sell_car',        'rikshawale_handle_sell_car_submission' );
add_action( 'wp_ajax_nopriv_rikshawale_sell_car', 'rikshawale_handle_sell_car_submission' );

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
    .car-sub-imgs { display: flex; gap: 10px; flex-wrap: wrap; margin: 12px 0; }
    .car-sub-imgs img { width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
    #rikshawale-approve-btn { background: #16a34a; color: #fff; border: none; padding: 12px 28px; font-size: 15px; border-radius: 6px; cursor: pointer; font-weight: 600; }
    #rikshawale-approve-btn:hover { background: #15803d; }
    #rikshawale-approve-msg { margin-left: 14px; font-weight: 600; }
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
        <div class="car-sub-field"><label>Brand</label><strong><?php echo $m('_car_brand_name'); ?></strong></div>
        <div class="car-sub-field"><label>Model</label><strong><?php echo $m('_car_model_name'); ?></strong></div>
        <div class="car-sub-field"><label>Variant</label><strong><?php echo $m('_car_variant'); ?></strong></div>
        <div class="car-sub-field"><label>Mfg Year</label><strong><?php echo $m('_car_mfg_year'); ?></strong></div>
        <div class="car-sub-field"><label>Reg Year</label><strong><?php echo $m('_car_reg_year'); ?></strong></div>
        <div class="car-sub-field"><label>Owner Type</label><strong><?php echo $m('_car_owner_type'); ?></strong></div>
        <div class="car-sub-field"><label>Driven (KM)</label><strong><?php echo $m('_car_driven_km'); ?></strong></div>
        <div class="car-sub-field"><label>Fuel Type</label><strong><?php echo $m('_car_fuel'); ?></strong></div>
        <div class="car-sub-field"><label>Transmission</label><strong><?php echo $m('_car_transmission'); ?></strong></div>
        <div class="car-sub-field" style="grid-column: span 3;"><label>Expected Price</label><strong><?php echo $m('_car_expected_price'); ?></strong></div>
    </div>

    <?php if ( array_filter($img_urls) ) : ?>
    <h3 style="border-bottom:2px solid #db2d2e;padding-bottom:6px;color:#db2d2e;">📷 Uploaded Images</h3>
    <div class="car-sub-imgs">
        <?php foreach ( $img_urls as $url ) : if ( $url ) : ?>
            <a href="<?php echo esc_url($url); ?>" target="_blank">
                <img src="<?php echo esc_url($url); ?>" alt="Car Image">
            </a>
        <?php endif; endforeach; ?>
    </div>
    <?php endif; ?>

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
        '_car_expected_price',
        '_car_gallery_image_1', '_car_gallery_image_2', '_car_gallery_image_3',
        '_car_gallery_image_4', '_car_gallery_image_5',
    );
    foreach ( $meta_keys as $key ) {
        $val = $m( $key );
        if ( $val ) {
            update_post_meta( $inventory_id, $key, $val );
            // Also set _car_price from expected price
            if ( $key === '_car_expected_price' ) {
                update_post_meta( $inventory_id, '_car_price', $val );
            }
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
