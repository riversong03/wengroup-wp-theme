<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wengroup
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wengroup' ); ?></a>
	<?php if( is_front_page() ):  the_header_image_tag(); endif; ?>
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<h4 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h4>
			<?php
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'wengroup' ); ?></button>
			<div id="navbarSupportedContent">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'header-menu'
					) );
				?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div class="flex-column">
		<?php if ( is_singular() ) : ?>
		
			<?php	wengroup_post_thumbnail(); ?>
		
		<div class="post-title">
			<div class="title-container">
			<?php 
				
				  the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				  <span class="cat-links"><?php wengroup_the_category_list(); ?></span>
			</div><!--End 'title-container'-->
		</div>

		<?php endif; ?>
	</div><!--End 'flex-column page-header'-->
	<div id="content" class="site-content">
