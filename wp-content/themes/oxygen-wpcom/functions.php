<?php
/**
 * Oxygen functions and definitions
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Oxygen 0.2.2
 */
if ( ! isset( $content_width ) )
	// Default
	$content_width = 470;

function oxygen_set_content_width() {
	global $content_width;
	if ( is_page_template( 'full-width-page.php' ) || ( is_singular() && wp_attachment_is_image( get_the_ID() ) ) )
		$content_width = 940;
}
add_action( 'template_redirect', 'oxygen_set_content_width' );

if ( ! function_exists( 'oxygen_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Oxygen, use a find and replace
	 * to change 'oxygen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'oxygen', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'archive-thumbnail', 470, 140, true );
	add_image_size( 'featured-thumbnail', 750, 380, true );
	add_image_size( 'slider-nav-thumbnail', 110, 70, true );

	/**
	 * This theme uses wp_nav_menu() in three locations.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'oxygen' ),
		'secondary' => __( 'Secondary Menu', 'oxygen' ),
		'tertiary' => __( 'Tertiary Menu', 'oxygen' ),
	) );

	add_theme_support( 'custom-background', apply_filters( 'oxygen_custom_background_args', array( 'default-color' => 'ffffff' ) ) );
}
endif; // oxygen_setup
add_action( 'after_setup_theme', 'oxygen_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Oxygen 0.2.2
 */
function oxygen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'oxygen' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'oxygen' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area One', 'oxygen' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Two', 'oxygen' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Three', 'oxygen' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Four', 'oxygen' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'After Post', 'oxygen' ),
		'id'            => 'sidebar-7',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h1 class="widgettitle">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'oxygen_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since Oxygen 0.2.2
 */
// Enqueue scripts
function oxygen_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '20120426', 'screen' );
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'jquery-masonry' );
	wp_enqueue_script( 'jquery-imagesloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'oxygen-theme', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if ( is_singular() && wp_attachment_is_image( $post->ID ) )
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
}
add_action( 'wp_enqueue_scripts', 'oxygen_scripts' );

/**
 * Register Google fonts styles.
 */
function oxygen_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style(
		'font-oswald',
		"$protocol://fonts.googleapis.com/css?family=Oswald",
		array(),
		'20120821'
	);
	wp_register_style(
		'font-terminal-dosis',
		"$protocol://fonts.googleapis.com/css?family=Terminal+Dosis",
		array(),
		'20120821'
	);
	wp_register_style(
		'font-bitter',
		"$protocol://fonts.googleapis.com/css?family=Bitter",
		array(),
		'20120821'
	);
	wp_register_style(
		'font-droid-serif',
		"$protocol://fonts.googleapis.com/css?family=Droid+Serif:400,400italic",
		array(),
		'20120821'
	);
	wp_register_style(
		'font-droid-sans',
		"$protocol://fonts.googleapis.com/css?family=Droid+Sans",
		array(),
		'20120821'
	);
	wp_register_style(
		'font-abel',
		"$protocol://fonts.googleapis.com/css?family=Abel",
		array(),
		'20120821'
	);
}
add_action( 'init', 'oxygen_register_fonts' );

/**
 * Enqueue Google fonts styles.
 *
 * @since Oxygen 0.2.2
 */
function oxygen_fonts() {
	$options = oxygen_get_theme_options();
	$current_font = $options['font'];
	switch ( $current_font ) {
		case 'oswald' :
			wp_enqueue_style( 'font-oswald' );
		break;
		case 'terminal_dosis' :
			wp_enqueue_style( 'font-terminal-dosis' );
		break;
		case 'bitter' :
			wp_enqueue_style( 'font-bitter' );
		break;
		case 'droid_serif' :
			wp_enqueue_style( 'font-droid-serif' );
		break;
		case 'droid_sans' :
			wp_enqueue_style( 'font-droid-sans' );
		default :
			wp_enqueue_style( 'font-abel' );
	}

}
add_action( 'wp_enqueue_scripts', 'oxygen_fonts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display
 *
 * @since Oxygen 0.2.2
 */
function oxygen_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	$options = oxygen_get_theme_options();
	$current_font = $options['font'];
	switch ( $current_font ) {
		case 'oswald' :
			wp_enqueue_style( 'font-oswald' );
		break;
		case 'terminal_dosis' :
			wp_enqueue_style( 'font-terminal-dosis' );
		break;
		case 'bitter' :
			wp_enqueue_style( 'font-bitter' );
		break;
		case 'droid_serif' :
			wp_enqueue_style( 'font-droid-serif' );
		break;
		case 'droid_sans' :
			wp_enqueue_style( 'font-droid-sans' );
		default :
			wp_enqueue_style( 'font-abel' );
	}

}
add_action( 'admin_enqueue_scripts', 'oxygen_admin_fonts' );

/**
 * Test to see if any posts meet our conditions for featuring posts
 *
 * @since Oxygen 0.2.2
 */
function oxygen_featured_posts() {
	if ( false === ( $featured_post_ids = get_transient( 'featured_post_ids' ) ) ) {

		// Proceed only if sticky posts exist.
		$sticky = get_option( 'sticky_posts' );

		// Proceed only if sticky posts exist.
		if ( is_array( $sticky ) && ! empty ( $sticky ) ) {

			$featured_args = array(
				'post__in'            => $sticky,
				'post_status'         => 'publish',
				'no_found_rows'       => true,
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => 50,
			);

			// The Featured Posts query.
			$featured = new WP_Query( $featured_args );

			// Proceed only if published posts with thumbnails exist
			if ( $featured->have_posts() ) {
				while ( $featured->have_posts() ) {
					$featured->the_post();

					if ( get_the_post_thumbnail() ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $featured->post->ID ), 'featured-thumbnail' );

						if ( $image[1] >= 750 ) {
							$featured_post_ids[] = $featured->post->ID;
						}
					}
				}

				set_transient( 'featured_post_ids', $featured_post_ids );
			}

			wp_reset_postdata();

		}
	}

	return $featured_post_ids;
}


/**
 * Flush out the transients used in oxygen_featured_posts()
 *
 * @since Oxygen 0.2.2
 */
function oxygen_featured_post_checker_flusher() {
	// Vvwooshh!
	delete_transient( 'featured_post_ids' );
}
add_action( 'update_option_sticky_posts', 'oxygen_featured_post_checker_flusher' );
add_action( 'save_post', 'oxygen_featured_post_checker_flusher' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Oxygen 0.2.2
 */
function oxygen_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="clear-fix ' . $class . '"';
}

/**
 * Background wrapper style for front-end when a custom background image is set
 */
function oxygen_custom_background() {

	// Set the default color.
	$background_color = 'ffffff';

	// If background color is specified use that color.
	if ( '' != get_background_color() ) :
		$background_color = get_background_color();
	endif;
?>
	<style type="text/css">
		#page {
			background-color: #<?php echo $background_color; ?>
		}
	</style>
<?php
}
add_action( 'wp_head', 'oxygen_custom_background' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Remove the widont filter because of the limited space for post/page title in the design.
 */
function oxygen_wido() {
    remove_filter( 'the_title', 'widont' );
}
add_action( 'init', 'oxygen_wido' );

/**
 * Enqueue More Articles Script
 *
 * @since Oxygen 0.2.2
 */
function oxygen_more_articles_script() {
	global $post;

	if ( is_page_template( 'showcase.php' ) ) {
		wp_enqueue_script( 'jquery-more-articles', get_template_directory_uri() . '/js/more-articles.js', array( 'jquery-masonry', 'jquery-imagesloaded' ), '20121206', true );
	}
}
add_action( 'wp_enqueue_scripts', 'oxygen_more_articles_script' );

/**
 * Masonry settings
 *
 * @since Oxygen 0.2.2
 */
function oxygen_masonry_settings() {

	if ( is_page_template( 'showcase.php' ) ) {

		$is_rtl = 'false';

		if ( is_rtl() )
			$is_rtl = 'true';

		$settings = array( 'isRTL' => $is_rtl );

		wp_localize_script( 'jquery-more-articles', 'masonry_setting', $settings );
	}
}
add_action( 'wp_enqueue_scripts', 'oxygen_masonry_settings' );

/**
 * Infinite Scroll Support
 *
 * Theme Name: Oxygen
 */

/**
 * Add theme support for Infinite Scroll. The check for this is in ../../infinity.php in settings_api_init().
 */
function oxygen_infinite_scroll_init() {
	// Theme support takes one argument: the ID of the element to append new results to.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content'
	) );
}
add_action( 'init', 'oxygen_infinite_scroll_init' );

/**
 * All IS-specific style overrides for individual themes will be in a CSS file named, appropriately, using the theme slug.
 */
function oxygen_infinite_scroll_enqueue_styles() {
	wp_enqueue_style( 'infinity-oxygen', plugins_url( 'oxygen.css', __FILE__ ), array(), '20120424' );
}
add_action( 'wp_enqueue_scripts', 'oxygen_infinite_scroll_enqueue_styles', 25 );

/**
 * Do we have footer widgets or it's viewed on mobile? If so let's provide click to load method.
 */
function oxygen_has_footer_widgets( $has_widgets ) {
	if ( jetpack_is_mobile( '', true ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) || is_active_sidebar( 'sidebar-6' ) )
		$has_widgets = true;

	return $has_widgets;
}
add_filter( 'infinite_scroll_has_footer_widgets', 'oxygen_has_footer_widgets' );

// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
