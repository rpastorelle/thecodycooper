( function( $ ){

	/* Remove a class from the body tag if JavaScript is enabled */
	$( 'body' ).removeClass( 'no-js' );

	/* Cycle */
	$( '#featured-content' ).cycle( {
		slideExpr: '.featured-post',
		fx: 'fade',
		speed: 500,
		timeout: 6000,
		cleartypeNoBg: true,
		pager: '#slide-thumbs',
		slideResize: true,
		containerResize: false,
		width: '100%',
		fit: 1,
		prev: '#slider-prev',
		next: '#slider-next',
		pagerAnchorBuilder: function( idx, slide ) {
			// return selector string for existing anchor
			return '#slide-thumbs li:eq(' + idx + ') a';
    	}
	} );
} )( jQuery );