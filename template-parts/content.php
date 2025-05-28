<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OllyRichards.co_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php olly_richards_theme_posted_on(); ?> · <?php olly_richards_theme_entry_footer(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php if ( 'testimonials' === get_post_type() ) :
			?>
			<span class="author-website"><?php echo get_field('testi_website-company'); ?></span>
			<svg viewBox="0 0 72 73"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#quote-symbol"></use></svg>		
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php 
	
	if (get_field('testi_video') || get_field('media_link')) {
		if(get_field('testi_video')) {echo get_field('testi_video');}
		if(get_field('media_link')) {echo get_field('media_link');}
	} else {
		olly_richards_theme_post_thumbnail();
	} ?>

	<div class="entry-content">

		<?php 
		
		if (get_field('testi_quote')) {
			echo '<blockquote>' . get_field('testi_quote'). '</blockquote>';
		} ?>

		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
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

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'olly-richards-theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
