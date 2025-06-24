<?php
/**
 * The template for displaying testimonials archive page
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
                            $page_id = get_page_by_path('testimonials')->ID;
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

			<?php
			// Query for one featured testimonial
			$featured_args = array(
				'post_type'      => 'testimonials',
				'posts_per_page' => 1,
				'meta_query' => [
					[
						'key'     => 'testi_featured_testimonial',
						'value'   => '1',
						'compare' => 'LIKE', 
					]
				]
			);
			$featured_query = new WP_Query($featured_args);

			if ( $featured_query->have_posts() ) :
				while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
					
					<div class="wrap featured-testimonial">
						<div class="testimonial-text">
							<blockquote><?php echo get_field('testi_quote'); ?></blockquote>
							<svg viewBox="0 0 72 73"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#quote-symbol"></use></svg>		
							<span class="testimonial-author"><?php echo get_the_title(); ?></cite>
							<span class="author-website"><?php echo get_field('testi_website-company'); ?></span>
						</div>
						<div class="testimonial-media">
							<?php 
							if ( get_field('testi_video') ) {
								echo get_field('testi_video');
							} else {
								olly_richards_theme_post_thumbnail();
							} ?>
						</div>

					</div>
					<div class="wrap hr-wrap"><hr></div>


				<?php endwhile;
				wp_reset_postdata();
			endif;
			?>

            <div class="wrap">
			<?php
            echo "<div class='articles-container'>";

			/* Start the Loop */
			// Query all testimonials except the featured one
			$exclude_ids = [];
			if ( isset( $featured_query ) && $featured_query->have_posts() ) {
				foreach ( $featured_query->posts as $featured_post ) {
					$exclude_ids[] = $featured_post->ID;
				}
			}

			$all_args = array(
				'post_type'      => 'testimonials',
				'posts_per_page' => -1,
				'post__not_in'   => $exclude_ids,
			);

			$all_query = new WP_Query( $all_args );

			if ( $all_query->have_posts() ) :
				while ( $all_query->have_posts() ) :
					$all_query->the_post();
					get_template_part( 'template-parts/content-loop-testimonials' );
				endwhile;
				wp_reset_postdata();
			endif;

			echo "</div>";

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
