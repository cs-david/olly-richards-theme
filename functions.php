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
	define( '_S_VERSION', '1.1.7' );
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
	// Register custom taxonomy for My Courses
	register_taxonomy(
		'my_course_category',
		'my-courses',
		array(
			'label' => __( 'Course Categories' ),
			'hierarchical' => false,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' => 'course-category' ),
			'show_in_rest' => true,
		)
	);

	// Register the custom post type for "My courses"
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
			'taxonomies' => array( 'my_course_category' ),
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
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon' => 'dashicons-visibility',
		)
	);

	// Register a custom post type for "My Events"
	register_post_type( 'events',
		array(
			'labels' => array(
				'name' => __( 'My Events' ),
				'singular_name' => __( 'Event' )
			),
			'public' => true,
			'has_archive' => true,
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
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'menu_icon' => 'dashicons-controls-play',
		)
	);
}
add_action( 'init', 'olly_richards_theme_custom_post_types' );

add_action('template_redirect', function () {
    if (is_singular('testimonials')) {
        wp_redirect(home_url('/testimonials'), 301);
        exit;
    }
});

/**
 * Enqueue scripts and styles.
 */
function olly_richards_theme_scripts() {
	wp_enqueue_style( 'olly-richards-theme-style-base', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'olly-richards-theme-style-base', 'rtl', 'replace' );
	wp_enqueue_style( 'olly-richards-theme-style', get_template_directory_uri() . '/css/or-style.css', array(), _S_VERSION );

	wp_enqueue_script( 'olly-richards-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array('owl-carousel'), _S_VERSION );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), _S_VERSION, true );

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

function my_frontpage_body_class( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'frontpage';
    }
    return $classes;
}
add_filter( 'body_class', 'my_frontpage_body_class' );

function allow_svg_uploads( $mime_types ) {
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter( 'upload_mimes', 'allow_svg_uploads' );

function olly_insights_carousel_function() {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 6,
		'orderby' => 'asc',
	);

	$query = new WP_Query( $args );
	$output = '';

	if ( $query->have_posts() ) {
		ob_start();
		?>
		<div class="insights-container">
		<div class="owl-carousel insights-carousel articles-container">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php olly_richards_theme_post_thumbnail(); ?>
						
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
							the_excerpt(
								sprintf(
									wp_kses(
										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'olly-richards-theme' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								)
							);
							?>
						</div><!-- .entry-content -->

						<hr>
						<footer class="entry-footer">
							<?php olly_richards_theme_entry_footer(); ?><?php olly_richards_theme_posted_on(); ?>
						</footer><!-- .entry-footer -->
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="overlay-link" aria-label="Read More"></a>
					</article><!-- #post-<?php the_ID(); ?> -->
			<?php endwhile; ?>
		</div>
		<div class="wrap-all-articles">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="read-all-btn">Read All Articles</a>
		</div>
		</div>

		<script>
			jQuery(document).ready(function($) {
				let $carousel = $('.owl-carousel');

				function initializeCarousel() {
					let viewPort = $(window).width();
					let wrapWidth = $('.wrap').width();
					let differenceWidth = (viewPort - wrapWidth) / 2;
					let marginWidth = 0;
					if (differenceWidth > 64) {
						marginWidth = differenceWidth;
					} else {
						if (viewPort > 728) {
							marginWidth = 32;
						} else {
							marginWidth = 24;
						}
						
					}
		

					$carousel.owlCarousel({
						stagePadding: marginWidth,
						loop: false,
						margin: 32,
						nav: true,
						dots: false,
						navText: [
							'<span class="screen-reader-text">Previous Article</span><svg viewBox="0 0 16 13"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#icon-arrow-left"></use></svg>',
							'<span class="screen-reader-text">Next Article</span><svg viewBox="0 0 16 13"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#icon-arrow-right"></use></svg>'
						],
						responsive: {
							0: {
								items: 1
							},
							600: {
								items: 2
							},
							1000: {
								items: 3
							}
						}
					});
				}

				// Initial setup
				initializeCarousel();

				// Debounced resize handler
				let resizeTimer;
				$(window).on('resize', function() {
					clearTimeout(resizeTimer);
					resizeTimer = setTimeout(function() {
						// Only re-init the insights carousel, not all carousels
						let $insightsCarousel = $('.insights-carousel');
						$insightsCarousel.trigger('destroy.owl.carousel');
						$insightsCarousel.each(function() {
							$(this).find('.owl-stage-outer').children().unwrap();
						});
						initializeCarousel();
					}, 250);
				});
			});
		</script>
		<?php
		wp_reset_postdata();
		return ob_get_clean();
	} else {
		return '<p>No articles found.</p>';
	}
}

add_shortcode('olly_insights_carousel', 'olly_insights_carousel_function' );

function olly_testimonial_carousel_function($atts) {
	// Accept multiple IDs as a comma-separated list
	$atts = shortcode_atts([
		'ids' => '',
	], $atts, 'olly_testimonial_carousel');

	$ids = array_filter(array_map('intval', explode(',', $atts['ids'])));

	if (empty($ids)) {
		return '<p>No testimonials selected.</p>';
	}

	$args = array(
		'post_type' => 'testimonials',
		'post__in' => $ids,
		'orderby' => 'post__in',
		'posts_per_page' => count($ids),
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		ob_start();
		?>
		<div class="testimonials-container">
			<div class="owl-carousel testimonials-carousel">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="single-testimonial" data-dot='<button role="button" class="dot-thumb" aria-label="switch testimonial" style="background-image:url(<?php echo esc_url(get_field("testi_headshot")); ?>)"></button>'>
						<div>
							<svg viewBox="0 0 72 73"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#quote-symbol"></use></svg>
							<blockquote><?php echo esc_html(get_field('testi_quote')); ?></blockquote>
							<span class="testimonial-author-website">
								<?php echo esc_html(get_the_title()); ?>
								<?php $company = get_field('testi_website-company'); if ($company) echo ' · ' . esc_html($company); ?>
							</span>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<script>
			jQuery(document).ready(function($) {
				let $testimonialCarousel = $('.testimonials-carousel');
				function initializeTestimonialCarousel() {
					$testimonialCarousel.owlCarousel({
						loop: true,
						items: 1,
						dots: true,
						dotsData: true,
						autoplay: true,
						autoplayTimeout: 3000
					});
				}
				initializeTestimonialCarousel();
			});
		</script>
		<?php
		wp_reset_postdata();
		return ob_get_clean();
	} else {
		return '<p>No testimonials found.</p>';
	}
}

add_shortcode('olly_testimonial_carousel', 'olly_testimonial_carousel_function' );


function olly_single_testimonial_function($atts) {
	// Extract attributes and set default
	$atts = shortcode_atts([
		'id' => '',
	], $atts, 'olly_single_testimonial');

	// Make sure ID is provided and valid
	$post_id = intval($atts['id']);
	if (!$post_id) return 'Invalid testimonial ID.';

	// Get the testimonial post
	$testimonial = get_post($post_id);

	// Check if post exists and is of the correct post type
	if (!$testimonial || $testimonial->post_type !== 'testimonials') {
		return 'Testimonial not found.';
	}

	// Optionally fetch custom fields, featured image, etc.
	$output = '<div class="single-testimonial">';
	$output .= '<img src="' . get_field('testi_headshot', $post_id) . '" alt="Headshot">';
	$output .= '<div><blockquote>' . get_field('testi_quote', $post_id ) . '</blockquote><span class="testimonial-author-website">' . esc_html(get_the_title($testimonial)) . ' · ' . get_field('testi_website-company', $post_id ) .'</span></div>';
	$output .= '<svg viewBox="0 0 72 73"><use xlink:href="' . get_template_directory_uri() .'/img/svg/icon-sprite.svg?v=' . time() .'#quote-symbol"></use></svg>';
	$output .= '</div>';

	return $output;
}
add_shortcode('olly_single_testimonial', 'olly_single_testimonial_function');

function custom_comment_form_placeholders($fields) {
    $fields['author'] = '<div class="commenter-data"><p class="comment-form-author">' .
        '<input id="author" name="author" type="text" placeholder="Name"' . 
        (is_user_logged_in() ? '' : ' required="required"') . 
        ' /></p>';

    $fields['email'] = '<p class="comment-form-email">' .
        '<input id="email" name="email" type="email" placeholder="Email"' .
        (is_user_logged_in() ? '' : ' required="required"') .
        ' /></p></div>';

	unset($fields['url']); 

    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_placeholders');

function custom_comment_textarea_placeholder($args) {
    $args['comment_field'] = '<p class="comment-form-comment">' .
        '<textarea id="comment" name="comment" rows="5" placeholder="Leave your comment" required="required"></textarea></p>';
    return $args;
}
add_filter('comment_form_defaults', 'custom_comment_textarea_placeholder');

function custom_comment_form_reorder($defaults) {
    // Store the consent checkbox field
    $cookies = isset($defaults['comment_notes_after']) ? $defaults['comment_notes_after'] : '';

    // Remove it from its default position
    $defaults['comment_notes_after'] = '';

    // Move it to below the submit button
    add_filter('comment_form', function($post_id) use ($cookies) {
        echo $cookies;
    });

    return $defaults;
}
add_filter('comment_form_defaults', 'custom_comment_form_reorder');
