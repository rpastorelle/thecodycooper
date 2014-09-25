<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses oxygen_header_style()
 * @uses oxygen_admin_header_style()
 * @uses oxygen_admin_header_image()
 *
 * @package Oxygen
 */
function oxygen_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'oxygen_custom_header_args', array(
		'width'						=> 940,
		'height'					=> 150,
		'flex-width'				=> true,
		'flex-height'				=> true,
		'default-image'				=> '',
		'default-text-color'		=> '222222',
		'wp-head-callback'			=> 'oxygen_header_style',
		'admin-head-callback'		=> 'oxygen_admin_header_style',
		'admin-preview-callback'	=> 'oxygen_admin_header_image'
	) ) );
}
add_action( 'after_setup_theme', 'oxygen_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress in version 3.4.
 * To provide backward compatibility with previous versions,
 * we will define our own version of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Oxygen
 */
if ( ! function_exists( 'get_custom_header' ) ) :
	function get_custom_header() {
		return ( object ) array(
			'url'			=> get_header_image(),
			'thumbnail_url'	=> get_header_image(),
			'width'			=> HEADER_IMAGE_WIDTH,
			'height'		=> HEADER_IMAGE_HEIGHT,
		);
	}
endif;

if ( ! function_exists( 'oxygen_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see oxygen_custom_header_setup().
 *
 * @since Oxygen 0.2.2
 */
function oxygen_header_style() {

	// If no custom options for text are set, let's bail
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // oxygen_header_style

if ( ! function_exists( 'oxygen_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see oxygen_custom_header_setup().
 *
 * @since Oxygen 0.2.2
 */
function oxygen_admin_header_style() {
	$options = oxygen_get_theme_options();
	$current_font = $options['font'];
	$current_font = str_replace( '_', ' ', $current_font );

?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		 border: 1px solid #fff;
	}
	#headimg h1,
	#desc {
		font-weight: normal;
	}
	#headimg h1 {
		font-family: '<?php echo $current_font; ?>', sans-serif;
		font-size: 36px;
		line-height: 1em;
		margin: 0 0 3px 0;
		text-transform: uppercase;
	}
	#headimg h1 a {
		color: #222;
		text-decoration: none;
	}
	#desc {
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 11px;
		font-weight: normal;
		line-height: 1.5em;
		margin-bottom: 20px;
		color: #bbb !important;
	}
	</style>
<?php
}
endif; // oxygen_admin_header_style

if ( ! function_exists( 'oxygen_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see oxygen_custom_header_setup().
 *
 * @since Oxygen 0.2.2
 */
function oxygen_admin_header_image() { ?>
	<div id="headimg">
		<?php
			$color = get_header_textcolor();
			$image = get_header_image();
			if ( $color && $color != 'blank' )
				$style = ' style="color:#' . $color . '"';
			else
				$style = ' style="display:none"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( ! empty( $image ) ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // oxygen_admin_header_image