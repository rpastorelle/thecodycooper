( function( $ ){
	/* Masonry */
	/* Since wp_localize_script passes the data as text, convert it to boolean for later use */
	if ( masonry_setting.isRTL == 'true' ) {
		masonry_setting.isRTL = true;
	} else {
		masonry_setting.isRTL = false;
	}

	var $container = $( '.hfeed-more');
	var width = $container.width();

	$container.imagesLoaded( function() {
		$container.masonry( {
			itemSelector: '.hentry',
			columnWidth: width * 0.4787234042553191,
			gutterWidth: width * 0.0425531914893617,
			isResizable: true,
			isRTL: masonry_setting.isRTL
		} );
	} );
} )( jQuery );