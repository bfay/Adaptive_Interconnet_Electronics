<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fibonacci
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site transparent-header">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'fibonacci' ); ?></a>

	<header id="masthead" class="navbar navbar-static-top swatch-black navbar-sticky" role="banner">
		<div class="container">
                <div class="navbar-header">
<!--
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
-->
                    <a href="index.php" class="navbar-brand">
                        <img src="/uploads/aie-logo-420x100-transparent-white-letter-raised-with-stroke.png" alt="AIE">
                    </a>
                </div>

		<nav id="site-navigation" class="nav navbar-nav navbar-right" role="navigation">
			<button class="menu-toggle"><?php _e( 'Primary Menu', 'fibonacci' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
           </div> <!-- container-->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
