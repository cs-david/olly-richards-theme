<?php
/**
 * The template for displaying events archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OllyRichards.co_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

    		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="wrap">
					<div class="archive-header-columns">
						<div class="ahc-left">
                            <?php 
                            $page_id = get_page_by_path('events')->ID;
                            ?>
                            <h1 class="page-title"><?php echo esc_html( get_the_title($page_id) ); ?></h1>
                            <h2><?php echo get_field('ar_subtitle', $page_id); ?></h2>
                            <div class="archive-description">
                                <p><?php echo get_field('ar_description', $page_id); ?></p>
                            </div>
						</div>
						<div class="ahc-right">
							<?php if ( has_post_thumbnail( $page_id ) ) : ?>
								<?php echo get_the_post_thumbnail( $page_id, 'full' ); ?>
							<?php else : ?>
							<?php
							$pattern_post_id = 182;

							$pattern_post = get_post( $pattern_post_id );

							if ( $pattern_post && $pattern_post->post_type === 'wp_block' ) {
								echo do_blocks( $pattern_post->post_content );
							}
							?>
							<?php endif; ?>
						</div>
				</div>
			</header><!-- .page-header -->
			<div class="events-content">
				<div class="events-container wrap">
				<div class="events-instances articles-container">
					<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php olly_richards_theme_post_thumbnail(); ?>
								<div class="event-text">
								<header class="entry-header">
									<?php the_title( '<h3 class="entry-title">', '</h2>' ); ?>
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
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-w-arrow">Learn More</a>
								</div>
							</article><!-- #post-<?php the_ID(); ?> -->
					<?php endwhile; ?>
				</div>
				</div>

				<?php else: ?>
				<div class="wrap"><div class="no-events"><p>No upcoming events. <a href="<?php esc_url( home_url( '/newsletter/' ) )?>">Subscribe to my newsletter</a> to be notified of my future events.</p></div></div>
				<?php endif; ?>
				<div class="wrap">
					<?php
					$page = get_page_by_path('events');
					if ( $page ) {
						echo apply_filters( 'the_content', $page->post_content );
					}
					?>
				</div>
				</div><!-- .events-content -->
				<div class="wrap">
					<?php
						$banner_id = 209;

						$banner_post = get_post( $banner_id );

						if ( $banner_post && $banner_post->post_type === 'wp_block' ) {
							echo do_blocks( $banner_post->post_content );
						}
					?>
				</div>

			</main><!-- #main -->

<?php get_footer();
