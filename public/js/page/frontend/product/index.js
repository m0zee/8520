$.product = $.product || {
	baseUrl: 		undefined,
	el: 			undefined,
	productId: 		undefined,
	isShortlisted:	undefined
};

$(function() {
	$.product.baseUrl 		= $( '#base_url' ).val();
	$.product.btnShortlist	= $( '.shortlist' );

	// EVENT BINDINGS
	$.product.btnShortlist.on( 'click', function( e ) {
		$.product.shortlist( $( this ) );
	});
});





$.product.shortlist = function( _el ) {
	$.product.el 			= _el
	$.product.productId 	= $.product.el.data( 'product-id' ),
	$.product.isShortlisted	= $.product.el.data( 'shortlisted' ),
	_url 					= $.product.baseUrl + '/products/' + ( ( $.product.isShortlisted ) ? 'unshortlist' : 'shortlist' );
	
	$.ajax({
		url: 		_url,
		type: 		'PUT',
		dataType: 	'JSON',
		data: {
			product_id: $.product.productId
		},
		success: function( res ) { 
			if( res.status === 200 ) {
				$.product.el.data( 'shortlisted', ( $.product.isShortlisted ) ? 0 : 1 );
				$.product.el.children( 'span' ).toggleClass( 'fa-heart-o fa-heart' );
				$.product.resetProductObject();
			}
		},
		error: function( err ) {
			console.log( 'error' );
		}
	});
};

$.product.resetProductObject = function() {
	$.product.el 			= undefined;
	$.product.productId 	= undefined;
	$.product.isShortlisted	= undefined;
}