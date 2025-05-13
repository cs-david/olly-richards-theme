<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OllyRichards.co_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-top">
			<div class="wrap">
				<div class="footer-text">
					<svg class="footer-logo" aria-label="Olly Richards logo" viewBox="0 0 290 65"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/olly-richards-logo.svg?v=<?php echo time(); ?>#olly-richards-symbol-text"></use></svg>
					<p><?php echo get_bloginfo( 'description', 'display' ); ?></p>
					<div class="social-media-links">
						<a href="https://www.instagram.com/ollyrichardsco/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><svg viewBox="0 0 24 24"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#icon-instagram"></use></svg></a>
						<a href="https://www.facebook.com/ollyrichardsco/" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg viewBox="0 0 24 24"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#icon-facebook"></use></svg></a>
						<a href="https://www.youtube.com/@ollyrichardsco" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><svg viewBox="0 0 24 24"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#icon-youtube"></use></svg></a>
					</div>
				</div>
				<div class="footer-menu">
					<div class="footer-menu-quicklinks">
						<h2>Quicklinks</h2>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'menu_id'        => 'footer-menu',
							)
						);
						?>
					</div>
					<div class="footer-menu-courses">
						<h2>Courses</h2>
						<?php 
						$args = array(
							'post_type'      => 'my-courses',
							'posts_per_page' => -1,
							'orderby'        => 'title',
							'order'          => 'ASC',
						);

						$courses_query = new WP_Query($args);

						if ($courses_query->have_posts()) {
							echo '<ul>';
							while ($courses_query->have_posts()) {
								$courses_query->the_post();
								echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
							}
							echo '</ul>';
						} else {
							echo '<p>No courses found.</p>';
						}

						wp_reset_postdata();
						?>
					</div>
				</div>
			</div><!-- .wrap -->
			<svg class="or-footer" viewBox="0 0 362 29"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/olly-richards-logo.svg?v=<?php echo time(); ?>#olly-richards-text"></use></svg>		
		</div>
		<div class="footer-bottom">
			<div class="wrap">
				<p>&copy; <?php echo date('Y'); ?> Olly Richards. All rights reserved.</p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
