<?php
/**
 * Custom User Profile Picture & Name Management
 * 
 * Provides an easy way for admins and users to:
 * 1. Directly upload or choose their profile picture from the WordPress Media Library or computer.
 * 2. Instantly preview, change, or remove their avatar without requiring Gravatar.
 * 3. Seamlessly sync First Name, Last Name, and Display Name with real-time feedback.
 * 4. Replace avatars everywhere across the WordPress admin and front-end.
 *
 * @package Rikshawale
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Helper to resolve user ID from various $id_or_email inputs in avatar hooks.
 */
function rikshawale_get_user_id_from_avatar_arg( $id_or_email ) {
	if ( is_numeric( $id_or_email ) ) {
		return (int) $id_or_email;
	}
	if ( is_object( $id_or_email ) ) {
		if ( ! empty( $id_or_email->user_id ) ) {
			return (int) $id_or_email->user_id;
		}
		if ( ! empty( $id_or_email->ID ) ) {
			return (int) $id_or_email->ID;
		}
		if ( ! empty( $id_or_email->post_author ) ) {
			return (int) $id_or_email->post_author;
		}
		if ( ! empty( $id_or_email->comment_author_email ) ) {
			$user = get_user_by( 'email', $id_or_email->comment_author_email );
			return $user ? $user->ID : 0;
		}
	}
	if ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
		$user = get_user_by( 'email', $id_or_email );
		return $user ? $user->ID : 0;
	}
	return 0;
}

/**
 * Override avatar data before Gravatar is called (WP 4.2+).
 */
function rikshawale_filter_pre_get_avatar_data( $args, $id_or_email ) {
	$user_id = rikshawale_get_user_id_from_avatar_arg( $id_or_email );
	if ( $user_id ) {
		$custom_avatar = get_user_meta( $user_id, 'rikshawale_user_avatar', true );
		if ( ! empty( $custom_avatar ) ) {
			$args['url']          = esc_url_raw( $custom_avatar );
			$args['found_avatar'] = true;
		}
	}
	return $args;
}
add_filter( 'pre_get_avatar_data', 'rikshawale_filter_pre_get_avatar_data', 10, 2 );

/**
 * Filter avatar URL for get_avatar_url().
 */
function rikshawale_filter_get_avatar_url( $url, $id_or_email, $args ) {
	$user_id = rikshawale_get_user_id_from_avatar_arg( $id_or_email );
	if ( $user_id ) {
		$custom_avatar = get_user_meta( $user_id, 'rikshawale_user_avatar', true );
		if ( ! empty( $custom_avatar ) ) {
			return esc_url_raw( $custom_avatar );
		}
	}
	return $url;
}
add_filter( 'get_avatar_url', 'rikshawale_filter_get_avatar_url', 10, 3 );

/**
 * Fallback filter for get_avatar HTML.
 */
function rikshawale_filter_get_avatar( $avatar, $id_or_email, $size, $default, $alt, $args ) {
	$user_id = rikshawale_get_user_id_from_avatar_arg( $id_or_email );
	if ( $user_id ) {
		$custom_avatar = get_user_meta( $user_id, 'rikshawale_user_avatar', true );
		if ( ! empty( $custom_avatar ) ) {
			$safe_url  = esc_url( $custom_avatar );
			$safe_alt  = esc_attr( $alt ? $alt : 'User Avatar' );
			$safe_size = absint( $size ) ?: 96;
			$class     = isset( $args['class'] ) ? ( is_array( $args['class'] ) ? implode( ' ', array_map( 'sanitize_html_class', $args['class'] ) ) : sanitize_text_field( $args['class'] ) ) : 'avatar';
			return sprintf(
				'<img alt="%s" src="%s" class="%s avatar-%d photo" height="%d" width="%d" style="object-fit: cover; border-radius: 50%%;" loading="lazy" decoding="async" />',
				$safe_alt,
				$safe_url,
				esc_attr( $class ),
				$safe_size,
				$safe_size,
				$safe_size
			);
		}
	}
	return $avatar;
}
add_filter( 'get_avatar', 'rikshawale_filter_get_avatar', 10, 6 );

/**
 * Allow file uploads on user profile editing forms.
 */
function rikshawale_profile_form_multipart() {
	echo ' enctype="multipart/form-data"';
}
add_action( 'user_edit_form_tag', 'rikshawale_profile_form_multipart' );

/**
 * Enqueue Media scripts & custom CSS/JS on profile and user-edit screens.
 */
function rikshawale_profile_avatar_scripts( $hook ) {
	if ( ! in_array( $hook, array( 'profile.php', 'user-edit.php' ), true ) ) {
		return;
	}

	wp_enqueue_media();

	// Custom inline styling for the avatar uploader and name feedback
	$custom_css = '
		.rikshawale-avatar-box {
			background: #ffffff;
			border: 1px solid #dcdcde;
			border-radius: 8px;
			padding: 16px 20px;
			max-width: 580px;
			margin-top: 10px;
			box-shadow: 0 1px 3px rgba(0,0,0,0.05);
		}
		.rikshawale-avatar-preview-wrap {
			display: flex;
			align-items: center;
			gap: 18px;
			margin-bottom: 15px;
		}
		.rikshawale-avatar-preview {
			position: relative;
			width: 96px;
			height: 96px;
			border-radius: 50%;
			overflow: hidden;
			background: #f0f0f1;
			border: 3px solid #2271b1;
			box-shadow: 0 2px 8px rgba(0,0,0,0.12);
			flex-shrink: 0;
		}
		.rikshawale-avatar-preview img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}
		.rikshawale-avatar-info h4 {
			margin: 0 0 4px 0;
			font-size: 15px;
			font-weight: 600;
			color: #1d2327;
		}
		.rikshawale-avatar-info p {
			margin: 0;
			font-size: 13px;
			color: #646970;
			line-height: 1.4;
		}
		.rikshawale-avatar-actions {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			gap: 10px;
			margin-top: 12px;
		}
		.rikshawale-avatar-actions .button {
			display: inline-flex;
			align-items: center;
			gap: 5px;
			font-weight: 500;
			padding: 4px 14px;
			height: 34px;
		}
		.rikshawale-avatar-actions .button-danger {
			color: #b32d2e;
			border-color: #b32d2e;
			background: #fff;
		}
		.rikshawale-avatar-actions .button-danger:hover {
			background: #b32d2e;
			color: #fff;
		}
		.rikshawale-file-input-wrap {
			margin-top: 10px;
			padding-top: 10px;
			border-top: 1px dashed #dcdcde;
			font-size: 13px;
			color: #50575e;
		}
		.rikshawale-file-input-wrap input[type="file"] {
			margin-top: 6px;
			font-size: 12px;
		}
		.rikshawale-name-sync-badge {
			display: inline-block;
			background: #f0f6fc;
			border: 1px solid #cce5ff;
			color: #004085;
			border-radius: 4px;
			padding: 4px 10px;
			font-size: 12px;
			margin-top: 6px;
		}
		.rikshawale-name-sync-badge strong {
			color: #2271b1;
		}
		/* Hide default avatar image and old gravatar note in favor of our rich uploader card */
		tr.user-profile-picture td > img.avatar {
			display: none !important;
		}
		.user-profile-picture .description a[href*="gravatar.com"] {
			display: none !important;
		}
	';
	wp_add_inline_style( 'common', $custom_css );

	// Custom script for media upload and dynamic display name sync (using nowdoc to prevent PHP interpolation)
	$custom_js = <<<'JS'
		jQuery(document).ready(function($) {
			// Profile Picture Uploader logic
			var mediaUploader;
			var originalAvatarUrl = $('#rikshawale_avatar_url').val();
			var defaultPlaceholder = $('.rikshawale-avatar-preview img').attr('src');

			$('#rikshawale_upload_avatar_btn').on('click', function(e) {
				e.preventDefault();

				if (mediaUploader) {
					mediaUploader.open();
					return;
				}

				mediaUploader = wp.media({
					title: 'Choose or Upload Profile Picture',
					button: { text: 'Set as Profile Picture' },
					multiple: false,
					library: { type: 'image' }
				});

				mediaUploader.on('select', function() {
					var attachment = mediaUploader.state().get('selection').first().toJSON();
					var imgUrl = attachment.url;
					if (attachment.sizes && attachment.sizes.thumbnail) {
						imgUrl = attachment.sizes.thumbnail.url;
					} else if (attachment.sizes && attachment.sizes.medium) {
						imgUrl = attachment.sizes.medium.url;
					}

					$('#rikshawale_avatar_url').val(attachment.url);
					$('#rikshawale_avatar_id').val(attachment.id);
					$('#rikshawale_avatar_removed').val('0');

					// Update previews
					$('.rikshawale-avatar-preview img').attr('src', attachment.url);
					$('.user-profile-picture td > img.avatar').attr('src', attachment.url);
					$('#wp-admin-bar-my-account .avatar').attr('src', attachment.url);

					$('#rikshawale_remove_avatar_btn').show();
					$('#rikshawale_avatar_file').val('');
				});

				mediaUploader.open();
			});

			// Direct File Upload Preview
			$('#rikshawale_avatar_file').on('change', function(e) {
				var file = this.files[0];
				if (file) {
					var reader = new FileReader();
					reader.onload = function(event) {
						$('.rikshawale-avatar-preview img').attr('src', event.target.result);
						$('.user-profile-picture td > img.avatar').attr('src', event.target.result);
						$('#rikshawale_avatar_removed').val('0');
						$('#rikshawale_remove_avatar_btn').show();
					};
					reader.readAsDataURL(file);
				}
			});

			// Remove Profile Picture
			$('#rikshawale_remove_avatar_btn').on('click', function(e) {
				e.preventDefault();
				if (!confirm('Are you sure you want to remove your custom profile picture?')) {
					return;
				}
				$('#rikshawale_avatar_url').val('');
				$('#rikshawale_avatar_id').val('');
				$('#rikshawale_avatar_removed').val('1');
				$('#rikshawale_avatar_file').val('');

				// Revert to default gravatar
				var gravatarFallback = $('#rikshawale_default_gravatar').val();
				$('.rikshawale-avatar-preview img').attr('src', gravatarFallback);
				$('.user-profile-picture td > img.avatar').attr('src', gravatarFallback);

				$(this).hide();
			});

			// Dynamic First Name & Last Name -> Display Name Sync
			function updateDisplayNameOptions() {
				var firstName = $.trim($('#first_name').val());
				var lastName  = $.trim($('#last_name').val());
				var username  = $.trim($('#user_login').val());

				var options = [];
				if (username) options.push(username);
				if (firstName) options.push(firstName);
				if (lastName) options.push(lastName);
				if (firstName && lastName) {
					options.push(firstName + ' ' + lastName);
					options.push(lastName + ' ' + firstName);
				}

				// Deduplicate
				options = options.filter(function(item, pos, self) {
					return self.indexOf(item) === pos;
				});

				var selectElem = $('#display_name');
				var hadPrevious = selectElem.val();

				selectElem.empty();
				$.each(options, function(i, val) {
					var isSelected = (val === hadPrevious);
					// If previously username or empty, and full name available, prefer full name
					if ((!hadPrevious || hadPrevious === username) && (firstName && lastName) && (val === firstName + ' ' + lastName)) {
						isSelected = true;
					}
					selectElem.append($('<option></option>').attr('value', val).text(val).prop('selected', isSelected));
				});

				// Update sync badge
				var currentDisplay = selectElem.val() || username;
				$('#rikshawale_display_name_preview').text(currentDisplay);
			}

			// Add a helpful live display name feedback badge under First & Last Name
			if ($('#last_name').length && !$('#rikshawale_name_sync_box').length) {
				var initDisplay = $('#display_name').val() || $('#user_login').val();
				var badgeHtml = '<div id="rikshawale_name_sync_box" class="rikshawale-name-sync-badge">' +
					'📌 Public Display Name: <strong id="rikshawale_display_name_preview">' + initDisplay + '</strong> (auto-updated when you save)' +
					'</div>';
				$('.user-last-name-wrap td').append(badgeHtml);
			}

			$('#first_name, #last_name').on('input keyup change', function() {
				updateDisplayNameOptions();
			});
		});
JS;
	wp_add_inline_script( 'user-profile', $custom_js );
}
add_action( 'admin_enqueue_scripts', 'rikshawale_profile_avatar_scripts' );

/**
 * Replace the standard Gravatar description with the custom avatar management UI.
 */
function rikshawale_custom_avatar_field( $description, $profile_user ) {
	$user_id = $profile_user->ID;
	$custom_avatar = get_user_meta( $user_id, 'rikshawale_user_avatar', true );
	$avatar_id     = get_user_meta( $user_id, '_rikshawale_avatar_id', true );

	// Get current avatar url (or Gravatar fallback)
	$current_avatar_url = $custom_avatar ? $custom_avatar : get_avatar_url( $user_id, array( 'size' => 192 ) );
	$default_gravatar   = get_avatar_url( $user_id, array( 'size' => 192, 'force_default' => true ) );

	ob_start();
	?>
	<div class="rikshawale-avatar-box">
		<?php wp_nonce_field( 'rikshawale_avatar_nonce_action', 'rikshawale_avatar_nonce' ); ?>
		<input type="hidden" name="rikshawale_avatar_url" id="rikshawale_avatar_url" value="<?php echo esc_attr( $custom_avatar ); ?>" />
		<input type="hidden" name="rikshawale_avatar_id" id="rikshawale_avatar_id" value="<?php echo esc_attr( $avatar_id ); ?>" />
		<input type="hidden" name="rikshawale_avatar_removed" id="rikshawale_avatar_removed" value="0" />
		<input type="hidden" id="rikshawale_default_gravatar" value="<?php echo esc_attr( $default_gravatar ); ?>" />

		<div class="rikshawale-avatar-preview-wrap">
			<div class="rikshawale-avatar-preview">
				<img src="<?php echo esc_url( $current_avatar_url ); ?>" alt="<?php echo esc_attr( $profile_user->display_name ); ?>" />
			</div>
			<div class="rikshawale-avatar-info">
				<h4><?php _e( 'Custom Profile Picture', 'rikshawale-theme' ); ?></h4>
				<p><?php _e( 'Upload an image directly or choose one from the WordPress Media Library. It will display in the top admin bar, user list, and throughout the website.', 'rikshawale-theme' ); ?></p>
			</div>
		</div>

		<div class="rikshawale-avatar-actions">
			<button type="button" class="button button-primary" id="rikshawale_upload_avatar_btn">
				<span class="dashicons dashicons-camera" style="margin-top: 4px;"></span>
				<?php _e( 'Choose / Upload Photo', 'rikshawale-theme' ); ?>
			</button>

			<button type="button" class="button button-danger" id="rikshawale_remove_avatar_btn" style="<?php echo empty( $custom_avatar ) ? 'display:none;' : ''; ?>">
				<span class="dashicons dashicons-trash" style="margin-top: 4px;"></span>
				<?php _e( 'Remove Photo', 'rikshawale-theme' ); ?>
			</button>
		</div>

		<div class="rikshawale-file-input-wrap">
			<label for="rikshawale_avatar_file">
				<strong><?php _e( 'Or select file directly from computer:', 'rikshawale-theme' ); ?></strong>
			</label><br>
			<input type="file" name="rikshawale_avatar_file" id="rikshawale_avatar_file" accept="image/png, image/jpeg, image/jpg, image/webp, image/gif" />
			<p class="description" style="margin-top: 4px;">
				<?php _e( 'Supported formats: JPG, PNG, WEBP, GIF. Max recommended size: 2MB.', 'rikshawale-theme' ); ?>
			</p>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_filter( 'user_profile_picture_description', 'rikshawale_custom_avatar_field', 10, 2 );

/**
 * Handle saving custom avatar, direct file upload, and smart First/Last/Display Name sync.
 */
function rikshawale_save_custom_avatar_and_names( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return;
	}

	// Verify nonce if present
	if ( isset( $_POST['rikshawale_avatar_nonce'] ) && ! wp_verify_nonce( $_POST['rikshawale_avatar_nonce'], 'rikshawale_avatar_nonce_action' ) ) {
		return;
	}

	// 1. Direct Computer File Upload
	if ( ! empty( $_FILES['rikshawale_avatar_file']['name'] ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$file = $_FILES['rikshawale_avatar_file'];
		$file_type = wp_check_filetype( $file['name'] );
		$allowed_types = array( 'jpg', 'jpeg', 'png', 'gif', 'webp' );

		if ( in_array( strtolower( $file_type['ext'] ), $allowed_types, true ) ) {
			// Upload via standard WordPress attachment handler
			$attachment_id = media_handle_upload( 'rikshawale_avatar_file', 0 );
			if ( ! is_wp_error( $attachment_id ) ) {
				$avatar_url = wp_get_attachment_url( $attachment_id );
				update_user_meta( $user_id, 'rikshawale_user_avatar', esc_url_raw( $avatar_url ) );
				update_user_meta( $user_id, '_rikshawale_avatar_id', $attachment_id );
			} else {
				// Fallback to direct upload handler
				$upload = wp_handle_upload( $file, array( 'test_form' => false ) );
				if ( isset( $upload['url'] ) ) {
					update_user_meta( $user_id, 'rikshawale_user_avatar', esc_url_raw( $upload['url'] ) );
				}
			}
		}
	}
	// 2. Media Library Selection
	elseif ( isset( $_POST['rikshawale_avatar_url'] ) ) {
		$avatar_url = sanitize_text_field( $_POST['rikshawale_avatar_url'] );
		$is_removed = isset( $_POST['rikshawale_avatar_removed'] ) && $_POST['rikshawale_avatar_removed'] === '1';

		if ( $is_removed || empty( $avatar_url ) ) {
			delete_user_meta( $user_id, 'rikshawale_user_avatar' );
			delete_user_meta( $user_id, '_rikshawale_avatar_id' );
		} else {
			update_user_meta( $user_id, 'rikshawale_user_avatar', esc_url_raw( $avatar_url ) );
			if ( ! empty( $_POST['rikshawale_avatar_id'] ) ) {
				update_user_meta( $user_id, '_rikshawale_avatar_id', absint( $_POST['rikshawale_avatar_id'] ) );
			}
		}
	}

	// 3. Name & Display Name Sync
	// Ensure first_name and last_name are explicitly saved in user meta
	$first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
	$last_name  = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';

	if ( isset( $_POST['first_name'] ) ) {
		update_user_meta( $user_id, 'first_name', $first_name );
	}
	if ( isset( $_POST['last_name'] ) ) {
		update_user_meta( $user_id, 'last_name', $last_name );
	}

	// If a specific display_name was submitted in POST, use that.
	// Otherwise, if current display name is default/username (e.g. 'admin'), automatically update to Full Name.
	$current_user_data = get_userdata( $user_id );
	$submitted_display = isset( $_POST['display_name'] ) ? sanitize_text_field( $_POST['display_name'] ) : '';

	$new_display_name = '';
	if ( ! empty( $submitted_display ) ) {
		$new_display_name = $submitted_display;
	} else {
		$full_name = trim( $first_name . ' ' . $last_name );
		if ( ! empty( $full_name ) && ( empty( $current_user_data->display_name ) || $current_user_data->display_name === $current_user_data->user_login ) ) {
			$new_display_name = $full_name;
		}
	}

	if ( ! empty( $new_display_name ) && $current_user_data && $current_user_data->display_name !== $new_display_name ) {
		wp_update_user( array(
			'ID'           => $user_id,
			'display_name' => $new_display_name,
		) );
	}
}
add_action( 'personal_options_update', 'rikshawale_save_custom_avatar_and_names' );
add_action( 'edit_user_profile_update', 'rikshawale_save_custom_avatar_and_names' );

/**
 * Fallback section for when "show_avatars" is disabled in Settings > Discussion.
 */
function rikshawale_extra_profile_avatar_section( $profile_user ) {
	if ( ! get_option( 'show_avatars' ) ) {
		echo '<h2>' . esc_html__( 'Profile Picture', 'rikshawale-theme' ) . '</h2>';
		echo '<table class="form-table"><tr><th><label>' . esc_html__( 'Avatar', 'rikshawale-theme' ) . '</label></th><td>';
		echo rikshawale_custom_avatar_field( '', $profile_user );
		echo '</td></tr></table>';
	}
}
add_action( 'show_user_profile', 'rikshawale_extra_profile_avatar_section' );
add_action( 'edit_user_profile', 'rikshawale_extra_profile_avatar_section' );
