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
	_url 					= $.product.baseUrl + '/buyer/shortlist' + ( ( $.product.isShortlisted ) ? '/' + $.product.productId : '' ),
	_type					= $.product.isShortlisted ? 'DELETE' : 'POST';
	
	$.ajax({
		url: 		_url,
		type: 		_type,
		dataType: 	'JSON',
		data: {
			product_id: $.product.productId
		},
		success: function( res ) { 
			if( res.status === 'success' ) {
				$.product.el.data( 'shortlisted', ( $.product.isShortlisted ) ? 0 : 1 );
				$.product.el.children( 'span' ).toggleClass( 'fa-heart-o fa-heart' );

				$.pakMaterial.notify( 'success', '<strong>' + res.message + '</strong>' );

				$.product.resetProductObject();
			}
		},
		error: function( err ) {
			$.pakMaterial.notify( 'danger', '<strong>' + err.responseJSON.message + '</strong>' );
		}
	});
};

$.product.resetProductObject = function() {
	$.product.el 			= undefined;
	$.product.productId 	= undefined;
	$.product.isShortlisted	= undefined;
}