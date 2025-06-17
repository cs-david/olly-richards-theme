<?php
/**
 * Template part for displaying posts in a loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OllyRichards.co_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
	
	if (get_field('testi_video')) {
		echo get_field('testi_video');
	} else {
		olly_richards_theme_post_thumbnail();
	} ?>
	
    <header class="entry-header">
		<h2><?php the_title(); ?></h2>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="testi-website"><?php echo get_field('testi_website-company'); ?></div>
        <?php if (get_field('testi_quote')) {
			echo '<blockquote>' . get_field('testi_quote'). '</blockquote>';
		} ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
