<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OllyRichards.co_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="wrap">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() ); ?>

			<?php if(get_post_type() !== "my-courses") : ?>

			<div class="post-cta">
				<?php
				$pattern_post_id = 1110;

				$pattern_post = get_post( $pattern_post_id );

				if ( $pattern_post && $pattern_post->post_type === 'wp_block' ) {
					echo do_blocks( $pattern_post->post_content );
				}
				?>
			</div>

			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle screen-reader-text">' . esc_html__( 'Previous:', 'olly-richards-theme' ) . '</span> <svg viewBox="0 0 16 13"><use xlink:href="'. get_template_directory_uri() .'/img/svg/icon-sprite.svg?v='. time() .'#icon-arrow-left"></use></svg> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle screen-reader-text">' . esc_html__( 'Next:', 'olly-richards-theme' ) . '</span> <span class="nav-title">%title</span><svg viewBox="0 0 16 13"><use xlink:href="'. get_template_directory_uri() .'/img/svg/icon-sprite.svg?v='. time() .'#icon-arrow-right"></use></svg>',
				)
			);

			endif; // End of the if statement for post type check.

		endwhile; // End of the loop.
		?>
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
