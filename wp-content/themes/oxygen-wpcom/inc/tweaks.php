<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'oxygen_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Oxygen 0.2.2
 */
function oxygen_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'oxygen_enhanced_image_navigation', 10, 2 );

/**
 * Sets the post excerpt length to 30 words.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'oxygen_excerpt_length' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'oxygen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'oxygen_wp_title', 10, 2 );
