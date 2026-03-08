<?php
/**
 * Plugin Name: ThemesFlat
 * Description: The theme's components
 * Author:      ThemesFlat
 * Version:     1.0.0
 */

define( 'THEMESFLAT_VERSION', '1.0.0' );
define( 'THEMESFLAT_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEMESFLAT_URL', plugin_dir_url( __FILE__ ) );
define( 'THEMESFLAT_ICON', plugin_dir_url( __FILE__ ).'assets/img/logo.png' );

$theme = wp_get_theme();
if ( 'janelas' == $theme->name || 'janelas' == $theme->parent_theme ) {
    require_once THEMESFLAT_PATH . '/poststype/init-posts-type.php';
    require_once THEMESFLAT_PATH . '/includes/options.php';
    require_once THEMESFLAT_PATH . '/includes/metabox-options.php';
    require THEMESFLAT_PATH . "widgets/themesflat_recent_post.php";
    require THEMESFLAT_PATH . "widgets/themesflat_latest_news.php";    
    require THEMESFLAT_PATH . "widgets/themesflat_categories.php";
    require THEMESFLAT_PATH . "widgets/themesflat_socials.php";

    require THEMESFLAT_PATH . "widgets/themesflat_services_categories.php"; 
}

function themesflat_shortcode_register_assets() {
	wp_enqueue_style( 'iziModal', plugins_url('assets/css/iziModal.css', __FILE__), array(), true );
	wp_enqueue_style( 'tf-main-post-type', plugins_url('assets/css/tf-main-post-type.css', __FILE__), array(), true );

	wp_enqueue_script( 'iziModal', plugins_url('assets/js/iziModal.js', __FILE__), array(), '1.0', true );
	wp_enqueue_script( 'tf-main-post-type', plugins_url('assets/js/tf-main-post-type.js', __FILE__), array(), '1.0', true );
    wp_enqueue_script( 'jquery-isotope' );
    wp_enqueue_script( 'imagesloaded-pkgd' );

    if( is_rtl() ){
        wp_style_add_data( 'tf-main-post-type', 'rtl', 'replace' );
    }
}
add_action( 'wp_enqueue_scripts', 'themesflat_shortcode_register_assets', 999999 );

function themesflat_admin_script_meta_box() {
    $screen = get_current_screen(); 
    wp_enqueue_script( 'themesflat-meta-box', plugins_url('assets/js/meta-boxes.js', __FILE__), array(), true );
    
}
add_action( 'admin_enqueue_scripts', 'themesflat_admin_script_meta_box' );

// Add image sizes post type
add_action( 'after_setup_theme', 'add_image_sizes' );
function add_image_sizes() {
    add_image_size( 'themesflat-project-grid', 1000, 973, true );
    add_image_size( 'themesflat-project-single', 1170, 628, true );
    add_image_size( 'themesflat-service-grid', 1000, 648, true );
    add_image_size( 'themesflat-service-single', 1170, 760, true );
}

function themesflat_mime_types_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'themesflat_mime_types_svg');
add_filter('mime_types', 'themesflat_mime_types_svg');