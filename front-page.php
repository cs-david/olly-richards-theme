<?php
/**
 * The template for displaying the front pahe
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OllyRichards.co_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

		<?php the_content(); ?>

		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
