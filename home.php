<?php
/**
 * The template for displaying the Insights (Blog posts)
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
                            $page_id = get_page_by_path('insights')->ID;
                            ?>
                            <h1 class="page-title"><?php echo esc_html( get_the_title($page_id) ); ?></h1>
                            <h2><?php echo get_field('ar_subtitle', $page_id); ?></h2>
                            <div class="archive-description">
                                <p><?php echo get_field('ar_description', $page_id); ?></p>
                            </div>
						</div>
						<div class="ahc-right">
							<?php
							$pattern_post_id = 182;

							$pattern_post = get_post( $pattern_post_id );

							if ( $pattern_post && $pattern_post->post_type === 'wp_block' ) {
								echo do_blocks( $pattern_post->post_content );
							}
							?>
						</div>
				</div>
			</header><!-- .page-header -->
            <div class="wrap filter-container">
                <?php echo do_shortcode('[searchandfilter field="1"]'); ?>
                <?php echo do_shortcode('[searchandfilter field="2"]'); ?>
            </div>
            <div class="wrap query-container">
			<?php
            echo "<div class='articles-container sf-articles'>";
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-loop' );

			endwhile;

            echo "</div>";

			echo do_shortcode('[searchandfilter field="3"]');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
        </div>
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

<?php
get_footer();
