<?php
/**
 * Functions for handling media, scripts, and styles in the theme.
 *
 * @package		Croatan
 * @subpackage	Includes
 * @since 		0.1.0
 * @author		Aris Papathéodorou
 * @copyright	Copyright (c) 2013, Aris Papathéodorou
 * @link		http://aris.papatheodorou.net
 * @license		http://www.gnu.org/licenses/gpl-3.0.html
 */

/* Filter the style.css to allow for a style.min.css stylesheet. */
add_filter( 'stylesheet_uri', 'croatan_min_stylesheet_uri', 10, 2 );

/* Register and load scripts. */
add_action( 'wp_enqueue_scripts', 'croatan_enqueue_scripts' );

/* Add custom image sizes. */
add_action( 'init', 'croatan_add_image_sizes' );

/**
 * Filters the active theme's 'style.css' file and replaces it with a 'style.min.css' file if it 
 * exists.  The purpose of the 'style.min.css' file is to offer a compressed version of the theme 
 * stylesheet for faster load times.
 *
 * @since 0.1.0
 * @access public
 * @param string $stylesheet_uri The active theme's stylesheet URI.
 * @param string $stylesheet_directory_uri The active theme's directory URI.
 * @return string
 */
function croatan_min_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
		return $stylesheet_uri;

	$stylesheet = str_replace( trailingslashit( $stylesheet_dir_uri ), '', $stylesheet_uri );

	$stylesheet = str_replace( '.css', '.dev.css', $stylesheet );

	if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'style.min.css' ) )
		$stylesheet_uri = trailingslashit( $stylesheet_dir_uri ) . 'style.min.css';

	return $stylesheet_uri;
}

/**
 * Registers and loads the theme's scripts.
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
function croatan_enqueue_scripts() {

	/* Enqueue the 'flexslider' script. */
	//wp_enqueue_script( 'flexslider', trailingslashit( THEME_URI ) . 'assets/js/flexslider/flexslider.js', array( 'jquery' ), '20120713', true );

	/* Enqueue the Croatan theme script. */
	wp_enqueue_script( 'croatan-scripts', trailingslashit( THEME_URI ) . 'assets/js/croatan.js', array( 'jquery' ), '20120831', true );
}

/**
 * Adds custom image sizes for featured images. 
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
function croatan_add_image_sizes() {
	//add_image_size( 'croatan-slider', 960, 400, true );
}

/**
 * Returns a set of image attachment links based on size.
 *
 * @since 0.1.0
 * @access public
 * @return void
 * @return string Links to various image sizes for the image attachment.
 */
function croatan_get_image_size_links() {

	/* If not viewing an image attachment page, return. */
	if ( !wp_attachment_is_image( get_the_ID() ) )
		return;

	/* Set up an empty array for the links. */
	$links = array();

	/* Get the intermediate image sizes and add the full size to the array. */
	$sizes = get_intermediate_image_sizes();
	$sizes[] = 'full';

	/* Loop through each of the image sizes. */
	foreach ( $sizes as $size ) {

		/* Get the image source, width, height, and whether it's intermediate. */
		$image = wp_get_attachment_image_src( get_the_ID(), $size );

		/* Add the link to the array if there's an image and if $is_intermediate (4th array value) is true or full size. */
		if ( !empty( $image ) && ( true === $image[3] || 'full' == $size ) )
			$links[] = "<a class='image-size-link' href='" . esc_url( $image[0] ) . "'>{$image[1]} &times; {$image[2]}</a>";
	}

	/* Join the links in a string and return. */
	return join( ' <span class="sep">/</span> ', $links );
}

?>