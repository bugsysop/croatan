<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Croatan
 * @subpackage Functions
 * @version    0.1.0
 * @since      0.1.0
 * @author     Aris Papathéodorou
 * @copyright  Copyright (c) 2013, Aris Papathéodorou
 * @link       http://aris.papatheodorou.net
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'croatan_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function croatan_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Load Croatan theme includes. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/functions-customize.php' );
	require_once( trailingslashit( THEME_DIR ) . 'includes/functions-media.php' );
	require_once( trailingslashit( THEME_DIR ) . 'includes/functions-shortcodes.php' );

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-scripts', array( 'comment-reply' ) );
	add_theme_support( 'hybrid-core-styles', array( 'gallery', 'parent', 'style' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-menus', array( 'primary' ) );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'about', 'footer' ) );
	
	/* Add theme support for framework extensions. */
	add_theme_support( 'get-the-image' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'cleaner-caption' );
	add_theme_support( 'loop-pagination' );

	/* Add theme support for WordPress features. */	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'video' ) );
	add_theme_support( 'custom-header', array( 'header-text' => false ) );
	add_theme_support( 'custom-background', array( 'default-color' => 'eeeeee' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 9999 ); 	// Unlimited height, soft crop
	//add_editor_style( '/assets/css/editor-style.css' );

	/* WordPress clean up */
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	
	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 600 );
	add_action( 'template_redirect', 'croatan_content_width' );
	
	/* Register additional widgets. */
	add_action( 'widgets_init', 'croatan_register_widgets' );

	/* Add additional contact methods. */
	add_filter( 'user_contactmethods', 'croatan_contact_methods' );
}

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 * @since Croatan 0.1.0
 */
function croatan_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'croatan_content_width' );


/**
 * Loads extra widget files and registers the widgets.
 * 
 * @since 0.1.0
 * @access public
 * @return void
 */
function croatan_register_widgets() {

	/* Load and register the image stream widget. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/widget-image-stream.php' );
	register_widget( 'Croatan_Widget_Image_Stream' );

	/* Load and register the most-commented posts widget. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/widget-most-commented.php' );
	register_widget( 'Croatan_Widget_Most_Commented' );

	/* Load and register the image widget. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/widget-image.php' );
	register_widget( 'Croatan_Widget_Image' );

	/* Load and register the gallery posts widget. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/widget-gallery-posts.php' );
	register_widget( 'Croatan_Widget_Gallery_Posts' );

	/* Load and register the image posts widget. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/widget-image-posts.php' );
	register_widget( 'Croatan_Widget_Image_Posts' );
	
}

/**
 * Adds new contact methods to the user profile screen for more modern social media sites.
 *
 * @since 0.1.0
 * @access public
 * @param array $meta Array of contact methods.
 * @return array $meta
 */
function croatan_contact_methods( $meta ) {

	/* Twitter contact method. */
	$meta['twitter'] = __( 'Twitter Username', 'croatan' );

	/* Google+ contact method. */
	$meta['google_plus'] = __( 'Google+ URL', 'croatan' );

	/* Facebook contact method. */
	$meta['facebook'] = __( 'Facebook URL', 'croatan' );

	/* Return the array of contact methods. */
	return $meta;
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1.0
 * @access public
 * @link http://core.trac.wordpress.org/ticket/16919
 * @return void
 */
function croatan_custom_background_callback() {

	// $background is the saved custom image or the default image.
	$background = get_background_image();

	// $color is the saved custom color or the default image.
	$color = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}

?>