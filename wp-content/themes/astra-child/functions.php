<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
// define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.'.time() );

/**
 * Enqueue styles
 */

function mytheme_enqueue_google_fonts() {
    // Preconnect to Google Fonts for faster loading
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	if( is_user_logged_in() ) {
		echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded",function(){var t=document.querySelector("#sa-login-button");if(t){var e=t.querySelector(".elementor-button-text");e&&(e.textContent="Dashboard")}});</script>';
	}
}
add_action('wp_head', 'mytheme_enqueue_google_fonts');

function child_enqueue_styles() {
    if( !is_user_logged_in() ) {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Julius+Sans+One&display=swap', array(), null);
    }
    else {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Julius+Sans+One&display=swap', array(), null);
    }
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'fancybox', get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css', array(), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	wp_enqueue_style( 'media-query', get_stylesheet_directory_uri() . '/css/media.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
		
    wp_enqueue_script('jQuery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jQuery'), '3.7.1', true);
	wp_enqueue_script('isotope', 'https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );
	wp_enqueue_script('isotope-masonry', 'https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );
	wp_enqueue_script('imagesloaded', 'https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );
	wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.min.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true );
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
	
	if( ( is_archive() && is_post_type_archive('obituary') ) || is_page('gallery') ) {
        wp_enqueue_style( 'archive-obituary', get_stylesheet_directory_uri() . '/css/archive-obituary.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
        wp_enqueue_script('obituary-related', get_stylesheet_directory_uri() . '/js/obituary-related.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
        wp_localize_script('obituary-related', 'obituary_related', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sg_ancestry_obituary_related_nonce'),
        ));
    }
	if( is_archive() && is_post_type_archive('obituary') ) {
        wp_enqueue_script('archive-obituary', get_stylesheet_directory_uri() . '/js/archive-obituary.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
        wp_localize_script('archive-obituary', 'obituary', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sg_ancestry_obituary_nonce'),
        ));
	}
    if( is_page('gallery') ) {
        wp_enqueue_script('page-gallery', get_stylesheet_directory_uri() . '/js/page-gallery.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
        wp_localize_script('page-gallery', 'gallery', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sg_ancestry_gallery_nonce'),
        ));
    }

    if( is_page_template('page-login.php') ) {
        wp_enqueue_style( 'admin-login', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-login.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
        wp_enqueue_script('admin-login', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-login.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
        wp_localize_script('admin-login', 'admin_login', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('admin_login_nonce'),
        ));
    }

    if( is_user_logged_in() ) {
        wp_enqueue_style('sa-intl', 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.min.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
        wp_enqueue_script('sa-intl', 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
    }

	if( is_page_template('page-login.php') || is_page_template('page-dashboard.php') || is_page_template('page-user-management.php') || 
        is_page_template('page-user-management-create.php') || is_page_template('page-undertaker-management.php') || 
        is_page_template('page-undertaker-management-create.php') || is_page_template('page-admin-obituary.php') || is_page_template('page-profile.php') || 
        is_page_template('page-settings.php') ) {
            
        wp_enqueue_style( 'admin-global', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-global.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
        wp_enqueue_script('admin-global', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-global.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
        wp_localize_script('admin-global', 'admin_global', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('admin_global_nonce'),
        ));
        if( is_page_template('page-dashboard.php') ) {
            wp_enqueue_style( 'admin-dashboard', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-dashboard.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
            wp_enqueue_script('admin-dashboard', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-dashboard.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-dashboard', 'admin_dashboard', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_dashboard_nonce'),
            ));
        }
        if( is_page_template('page-user-management.php') ) {
            // wp_enqueue_style( 'admin-user-management', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-user-management.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
            wp_enqueue_script('admin-user-management', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-user-management.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-user-management', 'admin_user_management', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_user_management_nonce'),
            ));
        }
        if( is_page_template('page-undertaker-management-create.php') ) {
            wp_enqueue_script('admin-undertaker-management-create', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-undertaker-management-create.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-undertaker-management-create', 'admin_undertaker_management_create', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_undertaker_management_create_nonce'),
            ));
        }
        if( is_page_template('page-user-management-create.php') ) {
            // wp_enqueue_style( 'admin-user-management-create', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-user-management-create.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
            wp_enqueue_script('admin-user-management-create', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-user-management-create.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-user-management-create', 'admin_user_management_create', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_user_management_create_nonce'),
            ));
        }
        if( is_page_template('page-admin-obituary.php') ) {
            wp_enqueue_style( 'admin-obituary', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-obituary.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
            wp_enqueue_script('admin-obituary', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-obituary.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-obituary', 'admin_obituary', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_obituary_nonce'),
            ));
        }
        if( is_page_template('page-profile.php') ) {
            wp_enqueue_style( 'admin-profile', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-profile.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
            wp_enqueue_script('admin-profile', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-profile.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-profile', 'admin_profile', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_profile_nonce'),
            ));
        }
        if( is_page_template('page-settings.php') ) {
            wp_enqueue_style( 'admin-settings', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-settings.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
            wp_enqueue_script('admin-settings', get_stylesheet_directory_uri() . '/template-parts/admin/js/admin-settings.js', array('jQuery'), CHILD_THEME_ASTRA_CHILD_VERSION, true);
            wp_localize_script('admin-settings', 'admin_settings', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('admin_settings_nonce'),
            ));
        }
    }

    add_filter('script_loader_tag', function ($tag, $handle) {
        if ('jquery' === $handle) {
            return str_replace(' src=', ' integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" src=', $tag);
        }
        return $tag;
    }, 10, 2);

    if( is_user_logged_in() ) {
        wp_enqueue_style('admin-global-media', get_stylesheet_directory_uri() . '/template-parts/admin/css/admin-global-media.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

add_filter('show_admin_bar', function($show) {
    if (current_user_can('administrator')) {
        return true;
    }
    return false;
});

function add_dashboard_body_class($classes) {
    if( is_page_template('page-dashboard.php') || is_page_template('page-user-management.php') || is_page_template('page-user-management-create.php') || is_page_template('page-undertaker-management-create.php') || is_page_template('page-obituary.php') || is_page_template('page-profile.php') || is_page_template('page-settings.php') ) {
        $classes[] = 'page-site-admin';
    }
    return $classes;
}
add_filter('body_class', 'add_dashboard_body_class');

function sg_ancestry_template_redirection() {
	if( is_user_logged_in() && ( is_page_template('page-login.php') || is_page_template('page-dashboard.php') ) ) {
        $user = wp_get_current_user();
        $user_roles = $user->roles;
        $user_role = $user_roles[0];
        if( $user_role == 'subscriber' ) {
		    wp_redirect( home_url('/view-obituary') );
        }
        else if( $user_role == 'contributor' ) {
		    wp_redirect( home_url('/profile') );
        }
        else {
		    wp_redirect( home_url('/undertaker-management') );
        }
	}
}
add_action('template_redirect', 'sg_ancestry_template_redirection');

function custom_rename_roles() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) ) {
        $wp_roles = new WP_Roles();
    }

    $wp_roles->roles['subscriber']['name'] = 'User';
    $wp_roles->role_names['subscriber'] = 'User';

    $wp_roles->roles['contributor']['name'] = 'Undertaker';
    $wp_roles->role_names['contributor'] = 'Undertaker';

    $wp_roles->roles['editor']['name'] = 'Site Admin';
    $wp_roles->role_names['editor'] = 'Site Admin';
}
add_action( 'init', 'custom_rename_roles' );

function add_user_role_to_body_class($classes) {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        if (!empty($user->roles)) {
            $classes[] = 'login-as-' . esc_attr($user->roles[0]);
        }
    }
    return $classes;
}
add_filter('body_class', 'add_user_role_to_body_class');

function obituary_date_of_birth_to_death($birthdate, $deathdate) {
    date_default_timezone_set('Asia/Singapore');
    $timestamp_birth = strtotime($birthdate);
    $timestamp_death = strtotime($deathdate);
	
	$new_birthdate = date('M j, Y', $timestamp_birth);
	$new_deathdate = date('M j, Y', $timestamp_death);
	return $new_birthdate . ' - ' .$new_deathdate;
}

function formatDateTime($datetime) {
    // Set the timezone to Asia/Singapore
    date_default_timezone_set('Asia/Singapore');
    
    // Convert the input datetime string to a timestamp
    $timestamp = strtotime($datetime);
    
    // English formatted outputs
    $english_date = date('d M Y (l)', $timestamp);
    $english_day = date('l', $timestamp);
    $english_time = date('g:ia', $timestamp);
    
    // Chinese formatted outputs
    $chinese_date = date('Y年n月j日', $timestamp);
    $chinese_weekdays = [
        'Sunday' => '星期日',
        'Monday' => '星期一',
        'Tuesday' => '星期二',
        'Wednesday' => '星期三',
        'Thursday' => '星期四',
        'Friday' => '星期五',
        'Saturday' => '星期六'
    ];
    $chinese_day = '（' . $chinese_weekdays[date('l', $timestamp)] . '）';
    
    // Convert time to Chinese format
    $hour = date('G', $timestamp);
    $minute = date('i', $timestamp);
    
    if ($hour < 12) {
        $chinese_period = '上午';
    } elseif ($hour < 18) {
        $chinese_period = '下午';
    } else {
        $chinese_period = '晚上';
    }
    
    $chinese_time = $chinese_period . date('g點i分', $timestamp);
    
    return [
        'english_date' => $english_date,
        'english_day' => $english_day,
        'english_time' => $english_time,
        'chinese_date' => $chinese_date,
        'chinese_day' => $chinese_day,
        'chinese_time' => $chinese_time
    ];
}

function obituary_time_diff($datetime) {
	$timezone = new DateTimeZone('Asia/Singapore');
    $date = new DateTime($datetime, new DateTimeZone('UTC'));
    $date->setTimezone($timezone);

    $now = new DateTime('now', $timezone);

    $interval = $now->diff($date);

    if ($interval->y) {
        $time_diff = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
    } elseif ($interval->m) {
        $time_diff = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
    } elseif ($interval->d) {
        $time_diff = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
    } elseif ($interval->h) {
        $time_diff = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
    } elseif ($interval->i) {
        $time_diff = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
    } else {
        $time_diff = $interval->s . ' second' . ($interval->s > 1 ? 's' : '');
    }
	
	return $time_diff;
}

function password_encryption($data) {
    $secret_key = AUTH_KEY;
    $secret_iv = SECURE_AUTH_SALT;

    // Generate a key and IV from the salts
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    // Encrypt data
    $output = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($output);
}

function password_decryption($encrypted_data) {
    $secret_key = AUTH_KEY;
    $secret_iv = SECURE_AUTH_SALT;

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    // Decrypt data
    $output = openssl_decrypt(base64_decode($encrypted_data), 'AES-256-CBC', $key, 0, $iv);
    return $output;
}

function check_encrypted_password($entry, $record_password) {
    $decrypted = password_decryption($record_password);
    if($entry===$decrypted) {
        return true;
    }
}

function shortcode_obituary_slider() {
    ob_start();
	$obituary_url = get_post_type_archive_link('obituary');
    // Query obituaries
    $query = new WP_Query([
        'post_type'      => 'obituary',
        'posts_per_page' => 10,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ]);
	
	echo '<div class="obituary-slider-container">';
    if ($query->have_posts()) {
        echo '<div class="obituary-slider swiper" id="obituary-slider">';
			echo '<div class="swiper-wrapper">';
				while ($query->have_posts()) {
					$query->the_post();
					$obituary_id = get_the_ID();
					$obituary_title = get_the_title();
					$basic_info = get_field('basic_information', $obituary_id);
					$birthdate = $basic_info['date_of_birth'];
					$deathdate = $basic_info['date_of_death'];
					$obituary_date = obituary_date_of_birth_to_death($birthdate, $deathdate);
        			$post_slug = get_post_field('post_name', $obituary_id);
					$permalink = add_query_arg('people', $post_slug, $obituary_url);
					echo '<div class="obituary-slide swiper-slide">';
						echo '<a href="'.$permalink.'" class="obituary-slide-inner">';
							echo '<div class="obituary-thumbnail">';
							if( has_post_thumbnail() ) {
								echo '<img src="'.get_the_post_thumbnail_url().'" class="img-fluid w-100"/>';
							}
							echo '</div>';
							echo '<div class="obituary-content">';
								echo '<div class="obituary-name">'.$obituary_title.'</div>';
								echo '<div class="obituary-dates">'.$obituary_date.'</div>';
							echo '</div>';
						echo '</a>';
					echo '</div>';
				}
        	echo '</div>';
        echo '</div>';
    }
	echo '</div>';
	
	wp_reset_postdata();
	
	return ob_get_clean();
}
add_shortcode('shortcode_obituary_slider', 'shortcode_obituary_slider');

function shortcode_singapore_ancestry_user_review() {
	ob_start();
    
    // Query obituaries
    $query = new WP_Query([
        'post_type'      => 'review',
        'posts_per_page' => 10,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ]);
	
	echo '<div class="user-review-slider-container">';
    if ($query->have_posts()) {
		echo '<button type="button" class="user-review-nav nav-prev"><span class="d-none">Prev</span><i class="fa fa-chevron-left" aria-hidden="true"></i></button>';
		echo '<button type="button" class="user-review-nav nav-next"><span class="d-none">Next</span><i class="fa fa-chevron-right" aria-hidden="true"></i></button>';
        echo '<div class="user-review-slider swiper" id="user-review-slider">';
			echo '<div class="swiper-wrapper">';
				while ($query->have_posts()) {
					$query->the_post();
					$review_id = get_the_ID();
					$review_title = get_the_title();
					$review_content = get_the_content();
    				$post_date_utc = get_the_date('Y-m-d H:i:s'); 
					$review_time_diff = obituary_time_diff($post_date_utc);
					
					echo '<div class="user-review-slide swiper-slide">';
						echo '<div class="user-review-slide-inner">';
							echo '<div class="user-review-content">';
								echo '<div class="user-reivew-text">'.$review_content.'</div>';
								echo '<div class="user-review-dates">'.$review_time_diff.' ago</div>';
							echo '</div>';
							echo '<div class="user-review-header">';
								echo '<div class="user-review-name">'.$review_title.'</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
        	echo '</div>';
        echo '</div>';
    }
	echo '</div>';
	
	wp_reset_postdata();
	
	return ob_get_clean();
}
add_shortcode('shortcode_singapore_ancestry_user_review', 'shortcode_singapore_ancestry_user_review');

function shortcode_singapore_ancestry_gallery () {
    ob_start();
    echo '<div class="grid-gallery-container">';
        echo '<div class="grid grid-gallery gallery-masonry">';
        for($i=1;$i<=10;$i++) {
            $index = str_pad($i,2,"0",STR_PAD_LEFT);
            echo '<div class="grid-item grid-item-'.$index.'" id="grid-item-'.$index.'">';
                echo '<div class="grid-item-inner">';
                    echo '<div class="grid-thumbnail"><a class="grid-link fancybox" data-fancybox="homepage-gallery-grid" href="/~tangstud/singapore-ancestry/wp-content/uploads/2025/04/img-memory-'.$index.'.jpg"><img src="/~tangstud/singapore-ancestry/wp-content/uploads/2025/04/img-memory-'.$index.'.jpg" class="img-fluid w-100"/></a></div>';
                echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        $page_gallery = get_page_by_title('Gallery');
        $page_gallery_url = get_permalink($page_gallery->ID);
        echo '<div class="btn-wrapper text-center"><a href="'.$page_gallery_url.'" class="d-inline-block mx-auto btn btn-white text-white">Check out for more</a></div>';
	echo '</div>';
	return ob_get_clean();
}
add_shortcode('shortcode_singapore_ancestry_gallery', 'shortcode_singapore_ancestry_gallery');

function shortcode_singapore_ancestry_gallery_viewer() {
    ob_start();
    
    get_template_part('template-parts/content-page-template', 'gallery');
    
    return ob_get_clean();
}
add_shortcode('shortcode_singapore_ancestry_gallery_viewer', 'shortcode_singapore_ancestry_gallery_viewer');
           
function capture_template_part( $slug, $name = null, $vars = [] ) {
    if ( $vars ) {
        foreach ( $vars as $key => $value ) {
            set_query_var( $key, $value );
        }
    }
    ob_start();
    get_template_part( $slug, $name );
    return ob_get_clean();
}

function get_obiutary_full_information() {
    if( !wp_verify_nonce($_POST['nonce'], 'sg_ancestry_obituary_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $id   = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $share_link = $_POST['share'];
    
    $post = get_post($id);
    if (!$post || $post->post_type !== 'obituary') {
        $response['status'] = 2000;
        $response['message'] = 'This is not from Obituary list!';
    }
    else {
        $obituary_slug = $post->post_name;
        if( $name === $obituary_slug ) {
            $obituary_id = $id;
            
            $response['data']['details'] = trim(capture_template_part( 'template-parts/content-section-template', 'details', [ 'obituary_id' => $id ] ));
            $response['data']['extra'] = trim(capture_template_part( 'template-parts/content-section-template', 'extra', [ 'obituary_id' => $id ] ));
            $response['data']['map'] = trim(capture_template_part( 'template-parts/content-section-template', 'map', [ 'obituary_id' => $id, 'share_link' => $share_link ] ));
        

            $response['status'] = 1000;
            $response['message'] = 'Successful';
        }
        else {
            $response['status'] = 2000;
            $response['message'] = 'The person requested is not match!';
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_get_obiutary_full_information', 'get_obiutary_full_information');
add_action('wp_ajax_nopriv_get_obiutary_full_information', 'get_obiutary_full_information');

function get_obiutary_gallery_box() {
    if( !wp_verify_nonce($_POST['nonce'], 'sg_ancestry_gallery_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $id  = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $share_link = $_POST['share'];
    
    $post = get_post($id);
    if (!$post || $post->post_type !== 'obituary') {
        $response['status'] = 2000;
        $response['message'] = 'This is not from Obituary list!';
    }
    else {
        $obituary_slug = $post->post_name;
        if( $name === $obituary_slug ) {
            $response['data']['gallery'] = trim(capture_template_part( 'template-parts/content-section-template', 'gallery', [ 'obituary_id' => $id, 'share_link' => $share_link ] ));

            $response['status'] = 1000;
            $response['message'] = 'Successful';
        }
        else {
            $response['status'] = 2000;
            $response['message'] = 'The person requested is not match!';
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_get_obiutary_gallery_box',  'get_obiutary_gallery_box');
add_action('wp_ajax_nopriv_get_obiutary_gallery_box',  'get_obiutary_gallery_box');

function obituary_retrieving_lightbox_list() {
    if( !wp_verify_nonce($_POST['nonce'], 'sg_ancestry_gallery_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
    
    $obituary_id = $_POST['obituary_id'];
    $obituary_password = $_POST['obituary_password'];
    $post = get_post($obituary_id);
    if( $post && $post->post_type === 'obituary' ) {
        $post_slug = get_post_field('post_name', $obituary_id);
        $gallery = get_field('gallery', $obituary_id);
        $private = $gallery['private']; // check private or not
        if( empty($obituary_password) ) {
            $response['status'] = 2000;
            $response['message'] = 'The gallery passcode is required!';
        }
        else {
            $password = $gallery['slideshow_password'];
            if( check_encrypted_password($obituary_password, $password) ) {
                $fancyboxes = '<div class="gallery-lightbox">';
                $slides = $gallery['slideshow'];
                foreach( $slides as $key=>$slide ) {
                    $fancyboxes .= '<a href="'.$slide['url'].'" data-fancybox="gallery-'.$post_slug.'">'.$post_slug.' - '.$key.'</a>';
                }
                $fancyboxes .= '</div>';
                $response['status'] = 1000;
                $response['message'] = 'Successful!';
                $response['data']['public'] = true;
                $response['data']['lightbox'] = $fancyboxes;
            }
            else {
                $response['status'] = 2000;
                $response['message'] = 'The gallery passcode is invalid!';
            }
        }
    }
    else {
        $response['status'] = 2000;
        $response['message'] = 'Invalid Obituary!';
    }
    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_obituary_retrieving_lightbox_list', 'obituary_retrieving_lightbox_list');
add_action('wp_ajax_nopriv_obituary_retrieving_lightbox_list', 'obituary_retrieving_lightbox_list');

function global_obituary_slider_search() {
    if( !wp_verify_nonce($_POST['nonce'], 'sg_ancestry_obituary_related_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
    if( empty($_POST['keyword']) ) {
        $response['status'] = 2000;
        $response['message'] = 'Keyword is required!';
    }
    else {
        $keyword = sanitize_text_field($_POST['keyword']);
        $args = array(
            'post_type' => 'obituary',
            'post_status' => 'publish',
            's' => $keyword
        );
        $post = new WP_Query($args);
        $html = '';
        if( $post->have_posts() ) {
            while( $post->have_posts() ) {
                $post->the_post();
                $post_id = get_the_ID();
                // set_query_var('obituary_id', $post_id);
                // $html .= get_template_part('template-parts/content-slider-template', 'obituary');
                $html .= trim(capture_template_part( 'template-parts/content-slider-template', 'obituary', [ 'obituary_id' => $post_id ] ));
            }
            wp_reset_postdata();
            
            $response['status'] = 1000;
            $response['message'] = 'Successful!';
            $response['data']['slider'] = $html;
        }
        else {
            $response['status'] = 2000;
            $response['message'] = 'There are no Obituary found with "<b>'.$keyword.'</b>"!';
        }
    }
    
    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_global_obituary_slider_search', 'global_obituary_slider_search');
add_action('wp_ajax_nopriv_global_obituary_slider_search', 'global_obituary_slider_search');

function admin_home_url( $path = '' ) {
    $dashboard_url = home_url( '/dashboard/' );

    // Optional: Add additional path like admin_home_url('settings')
    if ( $path ) {
        $dashboard_url = trailingslashit( $dashboard_url ) . ltrim( $path, '/' );
    }

    return $dashboard_url;
}

function admin_asset_directory_url() {
    return get_stylesheet_directory_uri() . '/template-parts/admin/';
}

// function admin_panel_authorization() {
//     if( !is_logged_in() && ( is_page_template('page-dashboard.php') || is_page_template('page-profile.php') || is_page_template('page-settings.php') ) ) {
//         wp_redirect( home_url('/login') );
//     }
// }

function site_admin_navigation() {
    if( is_user_logged_in() ) {
        $parent_id = wp_get_post_parent_id(get_the_ID());
        $target_templates = [
            'page-dashboard.php',
            'page-user-management.php',
            'page-undertaker-management.php',
            'page-admin-obituary.php',
            'page-profile.php',
            'page-settings.php'
        ];

        if( $parent_id ) {
            $parent_template = get_page_template_slug($parent_id);
        
            if ( in_array($parent_template, $target_templates) ) {
                get_template_part('template-parts/admin/admin-template', 'navigation');
            }
        }
        else {
            $current_template = get_page_template_slug(get_the_ID());
            if ( in_array($current_template, $target_templates) ) {
                get_template_part('template-parts/admin/admin-template', 'navigation');
            }
        }
    }
}

function admin_button_back($target) {
    echo '<button type="button" class="btn btn-return btn-inline btn-template" data-method="'.$target.'"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>';
}

function calling_template_login_redirection() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_login_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();

    $method = $_POST['method'];

    ob_start();
    if( $method == 'register' ) {
        get_template_part('template-parts/admin/admin-login-template', 'registration');
    }
    else if( $method == 'login' ) {
        get_template_part('template-parts/admin/admin-login-template', 'login');
    }
    else if( $method == 'default' ) {
        get_template_part('template-parts/admin/admin-login-template', 'default');
    }
    $html = ob_get_clean();

    if(empty($html)) {
        $response['status'] = 2000;
        $response['message'] = 'Unable to retrieve data!';
    }
    else {
        $response['status'] = 1000;
        $response['message'] = 'Successful!';
        $response['data']['html'] = $html;
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_calling_template_login_redirection', 'calling_template_login_redirection');
add_action('wp_ajax_nopriv_calling_template_login_redirection', 'calling_template_login_redirection');

function sg_ancestry_membership_registration() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_login_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();

    $reg_fullname = $_POST['reg_fullname'];
    $reg_email = $_POST['reg_email'];
    $reg_password = $_POST['reg_password'];
    if( empty($reg_fullname) ) {
        $response['status'] = 2000;
        $response['message'] = 'Fullname is required!';
    }
    else {
        if( !is_email($reg_email) ) {
            $response['status'] = 2000;
            $response['message'] = 'Email is invalid!';
        }
        else {
            if( email_exists($reg_email) ) {
                $response['status'] = 2000;
                $response['message'] = 'This email is already exist!';
            }
            else {
                if( !preg_match('/[A-Z]/', $reg_password)  || !preg_match('/[a-z]/', $reg_password) || !preg_match('/[0-9]/', $reg_password) || !preg_match('/[\W]/', $reg_password) ) {
                    $response['status'] = 2000;
                    $response['message'] = 'The password is not secure! Please use at least one Uppercase, Number and Specia Character.';
                }
                else {
                    $user_id = wp_create_user($reg_email, $reg_password, $reg_email);
                    if (is_wp_error($user_id)) {
                        $response['status'] = 2000;
                        $response['message'] = 'Something went wrong when creating the account!';
                    }
                    else {
                        wp_update_user([
                            'ID' => $user_id, 
                            'first_name' => $reg_fullname,
                            'display_name' => $reg_fullname,
                            'nickname'     => $reg_fullname,
                            'role' => 'subscriber',
                        ]);
                        $creds = [
                            'user_login'    => $reg_email,
                            'user_password' => $reg_password,
                            'remember'      => true,
                        ];
                        $user_login = wp_signon($creds, false );
                        $response['status'] = 1000;
                        $response['message'] = 'The user account created successfully!';
                        $response['redirect'] = home_url('/dashboard');
                    }
                }
            }
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_membership_registration', 'sg_ancestry_membership_registration');
add_action('wp_ajax_nopriv_sg_ancestry_membership_registration', 'sg_ancestry_membership_registration');

function sg_ancestry_admin_login() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_login_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();

    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];
    if( empty($login_username) || empty($login_password) ) {
        $response['status'] = 2000;
        $response['message'] = 'Username and password are required.';
        echo json_encode($response);
        wp_die();
    }

    $user = get_user_by('login', $login_username);
    if( !$user ) {
        $user = get_user_by('email', $login_username);
    }

    if ($user && wp_check_password($login_password, $user->user_pass, $user->ID)) {
        $creds = [
            'user_login'    => $login_username,
            'user_password' => $login_password,
            'remember'      => true
        ];
        $user_login = wp_signon($creds, false );

        if (!is_wp_error($user_login)) {
            $response['status'] = 1000;
            $response['message'] = 'Login successful.';
            $response['data']['redirect'] = home_url('/dashboard');
        }
        else {
            $response['status'] = 2000;
            $response['message'] = $user_login->get_error_message();
        }
    }
    else {
        $response['status'] = 2000;
        $response['message'] = 'Invalid username/email or password.';
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_admin_login', 'sg_ancestry_admin_login');
add_action('wp_ajax_nopriv_sg_ancestry_admin_login', 'sg_ancestry_admin_login');

function sg_ancestry_attempting_to_signout() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_global_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
	
    wp_logout();

    // Set redirect to home URL
    $response['status'] = 1000;
    $response['message'] = 'Successfully logged out..';
    $response['redirect'] = home_url();

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_attempting_to_signout', 'sg_ancestry_attempting_to_signout');
add_action('wo_ajax_nopriv_sg_ancestry_attempting_to_signout', 'sg_ancestry_attempting_to_signout');

function sg_ancestry_site_admin_update_password() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_settings_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    if(!is_user_logged_in()) {
        $response['status'] = 2000;
        $response['message'] = 'This is not an authorized user!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $repeat_password = $_POST['repeat_password'];

    if( empty($old_password) ) {
        $response['status'] = 2000;
        $response['message'] = 'The current password is required!';
        $response['error']['current'] = true;
    }
    else {
        if( empty($new_password) ) {
            $response['status'] = 2000;
            $response['message'] = 'The new password is required!';
            $response['error']['new'] = true;
        }
        else {
            if( empty($repeat_password) ) {
                $response['status'] = 2000;
                $response['message'] = 'The conform new password is required!';
                $response['error']['repeat'] = true;
            }
            else {
                if( $repeat_password === $new_password ) {
                    $current_user = wp_get_current_user();
                    if (wp_check_password($old_password, $current_user->user_pass, $current_user->ID)) {
                        wp_set_password($new_password, $current_user->ID);
                        wp_logout();
                        $response['status'] = 1000;
                        $response['message'] = 'Password update successfully! You are required to sign-in again. Logging out...';
                        $response['redirect'] = home_url();
                    }
                    else {
                        $response['status'] = 2000;
                        $response['message'] = 'Invalid current user password!';
                        $response['error']['current'] = true;
                    }
                }
                else {
                    $response['status'] = 2000;
                    $response['message'] = 'The conform new password MUST be the same as the new password!';
                    $response['error']['repeat'] = true;
                }
            }
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_site_admin_update_password', 'sg_ancestry_site_admin_update_password');
add_action('wp_ajax_nopriv_sg_ancestry_site_admin_update_password', 'sg_ancestry_site_admin_update_password');

function sg_ancestry_undertaker_sorting() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_undertaker_management_create_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    if(!is_user_logged_in()) {
        $response['status'] = 2000;
        $response['message'] = 'This is not an authorized user!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_undertaker_sorting', 'sg_ancestry_undertaker_sorting');
add_action('wp_ajax_nopriv_sg_ancestry_undertaker_sorting', 'sg_ancestry_undertaker_sorting');

function sg_ancestry_create_new_user() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_user_management_create_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();

    if( empty($_POST['user_name']) ) {
        $response['status'] = 2000;
        $response['message'] = "Error occured!";
        $response['error']['name'] = "The user's name is required!";
    }
    else {
        if( empty($_POST['user_id']) ) {
                $response['status'] = 2000;
                $response['message'] = "Error occured!";
                $response['error']['id'] = "The user's ID is required!";
        }
        else {
            if( empty($_POST['user_email']) ) {
                $response['status'] = 2000;
                $response['message'] = "Error occured!";
                $response['error']['email'] = "The user's email is required!";
            }
            else {
                if( !is_email($_POST['user_email']) ) {
                    $response['status'] = 2000;
                    $response['message'] = "Error occured!";
                    $response['error']['email'] = "The user's email is invalid!";
                }
                else {
                    if (username_exists($_POST['user_email']) || email_exists($_POST['user_email'])) {
                        $response['status'] = 2000;
                        $response['message'] = "Error occured!";
                        $response['error']['email'] = "This email already exists!";
                    }
                    else {
                        if( empty($_POST['user_mobile']) ) {
                            $response['status'] = 2000;
                            $response['message'] = "Error occured!";
                            $response['error']['phone'] = "The user's contact number is required/invalid!";
                        }
                        else {
                            if( empty($_POST['user_password']) ) {
                                $response['status'] = 2000;
                                $response['message'] = "Error occured!";
                                $response['error']['password'] = "The user's password is required!";
                            }
                            else {
                                if( $_POST['user_password'] !== $_POST['user_password_confirm'] ) {
                                    $response['status'] = 2000;
                                    $response['message'] = "Error occured!";
                                    $response['error']['password_confirm'] = "The user's confirm password is required!";
                                }
                                else {
                                    if( empty($_POST['user_status']) ) {
                                        $response['status'] = 2000;
                                        $response['message'] = "Error occured!";
                                        $response['error']['status'] = "The user's status is required!";
                                    }
                                    else {
                                        $user_id = wp_create_user($_POST['user_id'], $_POST['user_password'], $_POST['user_email']);
                                        if ( is_wp_error($user_id) ) {
                                            $response['status'] = 2000;
                                            $response['message'] = "Error occured!";
                                            $response['error']['user'] = "Something went wrong while creating the user! ".$user_id->get_error_message();
                                        }
                                        else {
                                            $user = new WP_User($user_id);
                                            $user->set_role('subscriber');

                                            wp_update_user(array(
                                                'ID'           => $user_id,
                                                'first_name'   => $_POST['user_name'],
                                                'display_name' => $_POST['user_name'],
                                                'nickname'     => $_POST['user_name']
                                            ));
                                            
                                            update_field('obituary_record', array(
                                                'status' => $_POST['user_status'],
                                                'remarks' => $_POST['user_remarks'],
                                                'contact_number' => $_POST['user_mobile'],
                                            ), 'user_' . $user_id);
                                            
                                            $response['status'] = 1000;
                                            $response['message'] = "New user is created successfully!";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_create_new_user', 'sg_ancestry_create_new_user');
add_action('wp_ajax_nopriv_sg_ancestry_create_new_user', 'sg_ancestry_create_new_user');

function sg_ancestry_create_new_undertaker() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_undertaker_management_create_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
    $company_name = $_POST['undertaker_company_name'];
    $company_id = $_POST['undertaker_company_id'];
    $company_address_1 = $_POST['undertaker_address_1'];
    $company_address_2 = $_POST['undertaker_address_2'];
    $postcode = $_POST['undertaker_postcode'];
    $city = $_POST['undertaker_city'];
    $state = $_POST['undertaker_state'];
    $country = $_POST['undertaker_country'];
    $company_mobile = $_POST['company_mobile'];
    $pic_fullname = $_POST['undertaker_fullname'];
    $pic_id = $_POST['pic_id'];
    $pic_email = $_POST['undertaker_email'];
    $pic_mobile = $_POST['pic_mobile'];
    $password = $_POST['undertaker_password'];
    $password_confirm = $_POST['undertaker_password_confirm'];
    $pic_status = !isset($_POST['undertaker_status']) ? $_POST['undertaker_status'] : 'active';
    $pic_remark = $_POST['undertaker_remarks'];

    if( empty($company_name) ) {
        $response['status'] = 2000;
        $response['message'] = 'Error occured!';
        $response['error']['company_name'] = 'The company name is required!';
    }
    else {
        if( empty($company_id) ) {
            $response['status'] = 2000;
            $response['message'] = 'Error occured!';
            $response['error']['company_id'] = 'The company ID is required!';
        }
        else {
            if( empty($company_address_1) ) {
                $response['status'] = 2000;
                $response['message'] = 'Error occured!';
                $response['error']['company_address'] = 'The company address is required!';
            }
            else {
                $company_address = $company_address_1.' '.$company_address_2;
                if( empty($postcode) ) {
                    $response['status'] = 2000;
                    $response['message'] = 'Error occured!';
                    $response['error']['company_postcode'] = 'The company postcode is required!';
                }
                else {
                    if( empty($city) ) {
                        $response['status'] = 2000;
                        $response['message'] = 'Error occured!';
                        $response['error']['company_city'] = 'The company city is required!';
                    }
                    else {
                        if( empty($state) ) {
                            $response['status'] = 2000;
                            $response['message'] = 'Error occured!';
                            $response['error']['company_state'] = 'The company state is required!';
                        }
                        else {
                            if( empty($country) ) {
                                $response['status'] = 2000;
                                $response['message'] = 'Error occured!';
                                $response['error']['company_country'] = 'The company country is required!';
                            }
                            else {
                                if( empty($company_mobile) ) {
                                    $response['status'] = 2000;
                                    $response['message'] = 'Error occured!';
                                    $response['error']['company_mobile'] = 'The company mobile is required/invalid!';
                                }
                                else {
                                    if( empty($pic_fullname) ) {
                                        $response['status'] = 2000;
                                        $response['message'] = 'Error occured!';
                                        $response['error']['pic_fullname'] = 'The PIC fullname is required!';
                                    }
                                    else {
                                        if( empty($pic_id) ) {
                                            $response['status'] = 2000;
                                            $response['message'] = 'Error occured!';
                                            $response['error']['pic_id'] = 'The PIC ID is required!';
                                        }
                                        else {
                                            if( empty($pic_email) ) {
                                                $response['status'] = 2000;
                                                $response['message'] = 'Error occured!';
                                                $response['error']['pic_email'] = 'The PIC email address is required!';
                                            }
                                            else {
                                                if( !is_email($pic_email) ) {
                                                    $response['status'] = 2000;
                                                    $response['message'] = 'Error occured!';
                                                    $response['error']['pic_email'] = 'The PIC email is invalid!';
                                                }
                                                else {
                                                    if( email_exists($pic_email) ) {
                                                        $response['status'] = 2000;
                                                        $response['message'] = 'Error occured!';
                                                        $response['error']['pic_email'] = 'The PIC email is already exists!';
                                                    }
                                                    else {
                                                        if( empty($pic_mobile) ) {
                                                            $response['status'] = 2000;
                                                            $response['message'] = 'Error occured!';
                                                            $response['error']['pic_mobile'] = 'The PIC mobile is required/invalid!';
                                                        }
                                                        else {
                                                            if( empty($password) ) {
                                                                $response['status'] = 2000;
                                                                $response['message'] = 'Error occured!';
                                                                $response['error']['pic_password'] = 'The PIC password is required!';
                                                            }
                                                            else {
                                                                if( $password_confirm !== $password ) {
                                                                    $response['status'] = 2000;
                                                                    $response['message'] = 'Error occured!';
                                                                    $response['error']['pic_password'] = 'The PIC repeat password is not mathcing the password!';
                                                                }
                                                                else {
                                                                    $user_id = wp_create_user($pic_id, $password, $pic_email);
                                                                    if ( is_wp_error($user_id) ) {
                                                                        $response['status'] = 2000;
                                                                        $response['message'] = "Error occured!";
                                                                        $response['error']['user'] = "Something went wrong while creating the user! ".$user_id->get_error_message();
                                                                    }
                                                                    else {
                                                                        $user = new WP_User($user_id);
                                                                        $user->set_role('contributor');

                                                                        wp_update_user(array(
                                                                            'ID'           => $user_id,
                                                                            'first_name'   => $pic_fullname,
                                                                            'display_name' => $pic_fullname,
                                                                            'nickname'     => $pic_fullname
                                                                        ));
                                                                        
                                                                        update_field('obituary_record', array(
                                                                            'status' => $pic_status,
                                                                            'remarks' => $pic_remark,
                                                                            'contact_number' => $pic_mobile,
                                                                        ), 'user_' . $user_id);
                                                                        
                                                                        $post_id = wp_insert_post([
                                                                            'post_title'   => sanitize_text_field($company_name),
                                                                            'post_status'  => 'publish',
                                                                            'post_type'    => 'undertaker',
                                                                        ]);
                                                                        
                                                                        if (is_wp_error($post_id)) {
                                                                            $response['status'] = 2000;
                                                                            $response['message'] = 'Error occured!';
                                                                            $response['error']['post'] = 'Something went wrong while creating new Undertaker!';
                                                                        }
                                                                        else {
                                                                            update_field('company_details', [
                                                                                'comp_id'  => $company_id,
                                                                                'address_1'  => $company_address_1,
                                                                                'address_2'  => $company_address_2,
                                                                                'postcode'  => $postcode,
                                                                                'city'  => $city,
                                                                                'state'  => $state,
                                                                                'country'  => $country,
                                                                                'contact_number'  => $company_mobile,
                                                                            ], $post_id);

                                                                            update_field('pic_details', [
                                                                                'name' => $pic_fullname,
                                                                                'email' => $pic_email,
                                                                                'contact_number' => $pic_mobile,
                                                                                'pic_id' => $pic_id
                                                                            ], $post_id);

                                                                            update_field('account_status', [
                                                                                'status'  => $pic_status,
                                                                                'remarks' => $pic_remark,
                                                                            ], $post_id);

                                                                            update_field('connection', [
                                                                                'undertaker_post_id'  => $post_id,
                                                                            ], 'user_'.$user_id);

                                                                            $response['status'] = 1000;
                                                                            $response['message'] = "New undertaker is created successfully!";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_create_new_undertaker', 'sg_ancestry_create_new_undertaker');
add_action('wp_ajax_nopriv_sg_ancestry_create_new_undertaker', 'sg_ancestry_create_new_undertaker');

function sg_ancestry_update_user_details() {
    if( !wp_verify_nonce($_POST['nonce'], 'admin_profile_nonce') ) {
        $response['status'] = 2000;
        $response['message'] = 'Nonce verification failed!';
        echo json_encode($response);
        wp_die();
    }
    $response = array();
    $current_user = wp_get_current_user();
    $current_user_id = intval($current_user->ID);
    $current_roles = $current_user->roles;
    $current_role = $current_roles[0];
    $user_id = intval($_POST['user_id']);
    $user_role = $_POST['user_role'];
    if( $user_id !== $current_user_id ) {
        $response['status'] = 2000;
        $response['message'] = 'Error Occured!';
        $response['error']['user'] = 'Unauthorized user ID access!';
    }
    else {
        if( $user_role !== $current_role ) {
            $response['status'] = 2000;
            $response['message'] = 'Error Occured!';
            $response['error']['user'] = 'Unauthorized user role access! --'.$current_role.'--'.$user_role;
        }
        else {
            if( $user_role == 'subscriber' ) {
                $user_name = $_POST['user_name'];
                $user_email = $_POST['user_email'];
                $user_mobile = str_replace([' ', '+'], '', $_POST['user_mobile']);
                $existing_name = $current_user->user_firstname;
                $existing_email = $current_user->user_email;
                $acf = get_field('obituary_record', 'user_'.$user_id);
                $existing_mobile = $acf['contact_number'];
                $change_name = false;
                $change_email = false;
                $change_mobile = false;
                if( !is_email($user_email) ) {
                    $response['status'] = 2000;
                    $response['message'] = 'Error Occured!';
                    $response['email'] = 'This email address is required/invalid!';
                    echo json_encode($response);
                    wp_die();
                }
                if( $user_name  !== $existing_name ) {
                    $change_name = true;
                }
                if( $user_email  !== $existing_email ) {
                    $change_email = true;
                }
                if( $user_mobile  !== $existing_mobile ) {
                    $change_mobile = true;
                }
                
                if( $change_name == true || $change_email == true || $change_mobile ==true ) {
                    if( $change_name == true ) {
                        update_user_meta( $user_id, 'some_meta_key', $new_ );
                        wp_update_user(array(
                            'ID'    => $user_id,
                            'first_name' => $user_name,
                            'display_name' => $user_name,
                            'nickname' => $user_name,
                        ));
                    }
                    if( $change_email == true ) {
                        wp_update_user(array(
                            'ID'    => $user_id,
                            'user_email' => $user_email,
                        ));
                    }
                    if( $change_mobile == true ) {
                        update_field('obituary_record', array(
                            'contact_number' => $user_mobile
                        ), 'user_'.$user_id);
                    }
                    $response['status'] = 1000;
                    $response['message'] = 'Update successfully!';
                }
                else {
                    $response['status'] = 3000;
                    $response['message'] = 'No changes!';
                }
            }
            else if ( $user_role == 'contributor' ) {
                
            }
            else {
                
            }
        }
    }

    echo json_encode($response);
    wp_die();
}
add_action('wp_ajax_sg_ancestry_update_user_details', 'sg_ancestry_update_user_details');
add_action('wp_ajax_nopriv_sg_ancestry_update_user_details', 'sg_ancestry_update_user_details');