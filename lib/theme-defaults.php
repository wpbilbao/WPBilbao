<?php

// Set Localization (do not remove)
load_child_theme_textdomain( 'wpbilbao', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'wpbilbao' ) );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'WordPress Bilbao', 'wpbilbao' ) );
define( 'CHILD_THEME_URL', 'https://www.wpbilbao.es' );
define( 'CHILD_THEME_VERSION', '1.0' );

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Remove Admin Bar
add_filter('show_admin_bar', '__return_false');

// Remove Edit Link
add_filter('edit_post_link', '__return_false');

// Remove Genesis in-post SEO Settings
remove_action('admin_menu', 'genesis_add_inpost_seo_box');
// Remove Genesis SEO Settings menu link
remove_theme_support('genesis-seo-settings-menu');

// Remove the site description
remove_action('genesis_site_description', 'genesis_seo_site_description');

// Remove Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('wp_head', 'wp_generator');

// Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'wpbilbao_load_scripts' );
function wpbilbao_load_scripts() {

	wp_enqueue_script( 'wpbilbao-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), CHILD_THEME_VERSION );
	wp_enqueue_script( 'wpbilbao-vendor', get_bloginfo( 'stylesheet_directory' ) . '/js/vendors.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,600', array(), CHILD_THEME_VERSION );

}

// Add new image sizes
add_image_size( 'blog', 700, 300, TRUE );

// Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 140,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

// Add support for custom background
add_theme_support( 'custom-background' );


// Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

// Remove unused sections from Genesis Customizer
add_action( 'customize_register', 'wpbilbao_customize_register', 16 );
function wpbilbao_customize_register( $wp_customize ) {

	$wp_customize->remove_control( 'genesis_image_alignment' );

}


/*==========  Navigation  ==========*/
// Reposition the secondary navigation from after header to before header
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_before_header', 'genesis_do_subnav');
// Rename menus
add_theme_support( 'genesis-menus',
	array(
		'primary' => __( 'After Header Menu', 'wpbilbao' ),
		'secondary' => __( 'Before Header Menu', 'wpbilbao' )
	)
);

// Remove default post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// Add featured image above the entry content
add_action( 'genesis_entry_content', 'wpbilbao_featured_photo', 8 );
function wpbilbao_featured_photo() {
	if ( is_page() || ! genesis_get_option( 'content_archive_thumbnail' ) )
		return;

	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => genesis_get_option( 'image_size' ) ) ) ) {
		printf( '<div class="featured-image"><img src="%s" alt="%s" class="entry-image"/></div>', $image, the_title_attribute( 'echo=0' ) );
	}
}

// Reposition the post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

// Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

// Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );






// wpbilbao Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'wpbilbao_theme_defaults' );
function wpbilbao_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 3;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_alignment']           = 'alignleft';
	$defaults['image_size']                = 'blog';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

// wpbilbao Theme Setup
add_action( 'after_switch_theme', 'wpbilbao_theme_setting_defaults' );
function wpbilbao_theme_setting_defaults() {

	if( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 3,
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 1,
			'image_alignment'           => 'alignleft',
			'image_size'                => 'blog',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

		if ( function_exists( 'GenesisResponsiveSliderInit' ) ) {

			genesis_update_settings( array(
				'location_horizontal'             => 'left',
				'location_vertical'               => 'bottom',
				'posts_num'                       => '4',
				'slideshow_arrows'                => 0,
				'slideshow_excerpt_content_limit' => '100',
				'slideshow_excerpt_content'       => 'full',
				'slideshow_excerpt_width'         => '40',
				'slideshow_height'                => '460',
				'slideshow_more_text'             => __( 'Continue Reading', 'wpbilbao' ),
				'slideshow_pager'                 => 1,
				'slideshow_title_show'            => 1,
				'slideshow_width'                 => '1060',
			), GENESIS_RESPONSIVE_SLIDER_SETTINGS_FIELD );

		}

	}

	update_option( 'posts_per_page', 3 );

}

// Set Genesis Responsive Slider defaults
add_filter( 'genesis_responsive_slider_settings_defaults', 'wpbilbao_responsive_slider_defaults' );
function wpbilbao_responsive_slider_defaults( $defaults ) {

	$args = array(
		'location_horizontal'             => 'left',
		'location_vertical'               => 'bottom',
		'posts_num'                       => '4',
		'slideshow_arrows'                => 0,
		'slideshow_excerpt_content_limit' => '100',
		'slideshow_excerpt_content'       => 'full',
		'slideshow_excerpt_width'         => '40',
		'slideshow_height'                => '460',
		'slideshow_more_text'             => __( 'Continue Reading', 'wpbilbao' ),
		'slideshow_pager'                 => 1,
		'slideshow_title_show'            => 1,
		'slideshow_width'                 => '1060',
	);

	$args = wp_parse_args( $args, $defaults );

	return $args;
}

// Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'wpbilbao_social_default_styles' );
function wpbilbao_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#ffffff',
		'background_color_hover' => '#ffffff',
		'border_radius'          => 3,
		'icon_color'             => '#222222',
		'icon_color_hover'       => '#999999',
		'size'                   => 36,
	);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}