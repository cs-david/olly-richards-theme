<?php
/**
 * OllyRichards.co Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OllyRichards.co_Theme
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
function olly_richards_theme_setup() {

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'olly-richards-theme' ),
			'footer-menu' => esc_html__( 'Footer', 'olly-richards-theme' )
		)
	);

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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'olly_richards_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function olly_richards_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'olly_richards_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'olly_richards_theme_content_width', 0 );

/**
 * Add custom post types
 */

function olly_richards_theme_custom_post_types() {
	// Register a custom post type for "My courses"
	register_post_type( 'my-courses',
		array(
			'labels' => array(
				'name' => __( 'My Courses' ),
				'singular_name' => __( 'Course' )
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon' => 'dashicons-welcome-learn-more',
		)
	);
	// Register a custom post type for "Testimonials"
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon' => 'dashicons-visibility',
		)
	);

	// Register a custom post type for "My Events"
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'My Events' ),
				'singular_name' => __( 'Event' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon' => 'dashicons-calendar',
		)
	);

	// Register a custom post type for "My Media"
	register_post_type( 'media',
		array(
			'labels' => array(
				'name' => __( 'My Media' ),
				'singular_name' => __( 'Media' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon' => 'dashicons-controls-play',
		)
	);
}
add_action( 'init', 'olly_richards_theme_custom_post_types' );

/**
 * Enqueue scripts and styles.
 */
function olly_richards_theme_scripts() {
	wp_enqueue_style( 'olly-richards-theme-style-base', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'olly-richards-theme-style-base', 'rtl', 'replace' );
	wp_enqueue_style( 'olly-richards-theme-style', get_template_directory_uri() . '/css/or-style.css', array(), _S_VERSION );

	wp_enqueue_script( 'olly-richards-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'olly_richards_theme_scripts' );

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

