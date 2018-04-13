$.product = $.product || {
	baseUrl: undefined
};

$(function() {
	$.product.baseUrl 		= $( '#base_url' ).val();
	$.product.btnShortlist	= $( '.shortlist' );

	// EVENT BINDINGS
	$.product.btnShortlist.on( 'click', function( e ) {
		var $this 			= $( this );

		$.product.shortlist( $this );
	});
});

$.product.shortlist = function( el ) {
	_product_id		= el.data( 'product-id' ),
	_is_shortlisted = el.data( 'shortlisted' );
	var _url = $.product.baseUrl + '/products/' + ( ( isShortListed ) ? 'unshortlist' : 'shortlist' );
	
	$.ajax({
		url: 		_url,
		type: 		'PUT',
		dataType: 	'JSON',
		data: {
			product_id: product_id
		},
		success: function( res ) {
				console.log( res );
		},
		error: function( err ) {
			console.log( err.responseText );
		}
	});
}