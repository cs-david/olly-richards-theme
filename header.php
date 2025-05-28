<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OllyRichards.co_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'olly-richards-theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="or-logo-link" rel="home" aria-current="page" aria-label="Olly Richards Logo">
				<svg class="or-logo" viewBox="0 0 290 65"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/olly-richards-logo.svg?v=<?php echo time(); ?>#olly-richards-symbol-text"></use></svg>
			</a>
			<?php

			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$olly_richards_theme_description = get_bloginfo( 'description', 'display' );
			if ( $olly_richards_theme_description || is_customize_preview() ) :
				?>
				<p class="site-description screen-reader-text"><?php echo $olly_richards_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-label="Menu Toggle Button" aria-expanded="false"><svg viewBox="0 0 24 24"><use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg/icon-sprite.svg?v=<?php echo time(); ?>#icon-hamburger"></use></svg></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		<a href="" class="btn btn-outline btn-cta" aria-label="call to action button">Mentorship</a>
	</header><!-- #masthead -->
