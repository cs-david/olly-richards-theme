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

    <?php olly_richards_theme_post_thumbnail(); ?>
	
    <header class="entry-header">
		<?php
		if ( get_post_type() === 'media' ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta screen-reader-text">
				<?php
				olly_richards_theme_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			if ( get_post_type() === 'testimonials' ) {
				echo get_field('testi_website-company');
			} else {
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
			}

		?>
	</div><!-- .entry-content -->

		<?php  if ( get_post_type() === 'testimonials' || get_post_type() === 'media' ) { ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="overlay-link" aria-label="Read More"></a>
	<?php } else { ?>
    
		<hr>

		<a class="read-more-btn" href="<?php the_permalink(); ?>">Read More</a>
		<footer class="entry-footer screen-reader-text">
			<?php olly_richards_theme_entry_footer(); ?>
		</footer><!-- .entry-footer --> 
	<?php }  ?>
</article><!-- #post-<?php the_ID(); ?> -->
