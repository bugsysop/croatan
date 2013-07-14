<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Croatan
 * @since Croatan 0.1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<title><?php hybrid_document_title(); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
		<![endif]-->
	<?php wp_head(); // wp_head ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body id="top" class="<?php hybrid_body_class(); ?>">

	<!-- BEGIN #container -->
	<div id="container">

		<!-- BEGIN #site-header -->
		<header id="site-header"  role="banner">

			<hgroup id="site-branding">
				<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup><!-- #branding -->

			<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

			<?php if ( get_header_image() ) echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="">'; ?>
		
		<!-- END #site-header -->
		</header>

		<!-- BEGIN #main -->
		<section id="main" class="site-content">
