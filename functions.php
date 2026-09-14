<?php
/**
 * freemantech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package freemantech
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function freemantech_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on freemantech, use a find and replace
		* to change 'freemantech' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'freemantech', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Nav menu locations are registered in inc/helpers.php.

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'freemantech_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'freemantech_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function freemantech_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'freemantech_content_width', 640 );
}
add_action( 'after_setup_theme', 'freemantech_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function freemantech_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'freemantech' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'freemantech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'freemantech_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function freemantech_scripts() {
	wp_enqueue_style( 'freemantech-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'freemantech-style', 'rtl', 'replace' );

	// Design tokens and base layer. Loaded first so later sheets can override.
	wp_enqueue_style( 'freemantech-base', get_template_directory_uri() . '/assets/css/ft-base.css', array(), _S_VERSION );
	wp_enqueue_style( 'freemantech-layout', get_template_directory_uri() . '/assets/css/ft-layout.css', array( 'freemantech-base' ), _S_VERSION );
	wp_enqueue_style( 'freemantech-components', get_template_directory_uri() . '/assets/css/ft-components.css', array( 'freemantech-base' ), _S_VERSION );
	wp_enqueue_style( 'freemantech-article', get_template_directory_uri() . '/assets/css/ft-article.css', array( 'freemantech-base' ), _S_VERSION );
	wp_enqueue_style( 'freemantech-archive', get_template_directory_uri() . '/assets/css/ft-archive.css', array( 'freemantech-base' ), _S_VERSION );
	wp_enqueue_style( 'freemantech-page', get_template_directory_uri() . '/assets/css/ft-page.css', array( 'freemantech-base' ), _S_VERSION );

	wp_enqueue_script( 'freemantech-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'freemantech-mobile-nav', get_template_directory_uri() . '/js/mobile-nav.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'freemantech-carousel', get_template_directory_uri() . '/js/ft-carousel.js', array( 'swiper-js' ), _S_VERSION, true );
	wp_enqueue_script( 'freemantech-back-to-top', get_template_directory_uri() . '/js/ft-back-to-top.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'freemantech_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Template helpers for the native templates (replaces Elementor Theme Builder).
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Resource filter functionality.
 */
require_once get_template_directory() . '/inc/resource-filter.php';

/**
 * Testimonial Carousel.
 */
 require_once get_template_directory() . '/inc/testimonial-carousel.php';
 /**
 * Distributors Grid.
 */
require_once get_template_directory() . '/inc/distributors-grid.php';

require_once get_template_directory() . '/inc/software-repeater-table.php';


/**
 * Load CSS.
 */
function ft_enqueue_styles() {
    wp_enqueue_style(
        'ft-style', // Handle (unique name)
        get_stylesheet_directory_uri() . '/assets/css/ft-style.css',
        [],          
        '1.0',      
        'all'        
    );
}
add_action('wp_enqueue_scripts', 'ft_enqueue_styles');



/**
 * Include product specs shortcode
 */

require_once get_stylesheet_directory() . '/inc/specs-shortcode.php';

add_action('wp_enqueue_scripts', function () {

    wp_enqueue_style(
        'mp-product-specs',
        get_stylesheet_directory_uri() . '/assets/css/specs.css',
        [],
        '1.0'
    );

    wp_enqueue_script(
        'mp-product-specs',
        get_stylesheet_directory_uri() . '/js/specs.js',
        [],
        '1.0',
        true
    );

});

/**
 * Allow SVG uploads for admins only.
 */
add_filter('upload_mimes', function ($mimes) {
  if (current_user_can('manage_options')) {
    $mimes['svg'] = 'image/svg+xml';
  }
  return $mimes;
});

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype($filename, $mimes);

  if ($filetype['ext'] === 'svg') {
    $data['ext']  = 'svg';
    $data['type'] = 'image/svg+xml';
  }

  return $data;
}, 10, 4);
