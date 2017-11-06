<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hello
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hello' ); ?></a>

	<header id="masthead" class="site-header">
		<div id="wrapper">
			<div class="site-branding">
				<a href="/"><div class="site-name">Udara Jay</div></a>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hello' ); ?></button>
				<div id="primary-menu" class="menu"><ul>
					<li><a href="/resume"><div class="icon" data-icon="+"></div>Resume</a></li>
					<li><a href="/work"><div class="icon" data-icon="&#xe05a;" style="font-size:1.3em;"></div>Portfolio</a></li>
					<li><a href="/blog">Writing</a></li>
					<li><a href="/about">About</a></li>
					</ul>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
