   $.product = $.product || {
	baseUrl: 		undefined,
	// el: 			undefined,
	productId: 		undefined,
	isShortlisted:	undefined
};

$(function() {
	$.product.baseUrl 			= $( '#base_url' ).val();
	$.product.btnAddToShortlist	= $( '.add-shortlist' );
	$.product.btnAddToCompare	= $( '.add-compare' );

	// EVENT BINDINGS
	$.product.btnAddToShortlist.on( 'click', function( e ) {
		$.product.shortlist( $( this ) );
	});

	$.product.btnAddToCompare.on( 'click', function( e ) {
		$.product.addToCompareList( $( this ) );
	});
});





$.product.shortlist = function( _el ) {
	$.product.productId 	= _el.data( 'product-id' ),
	$.product.isShortlisted	= _el.data( 'shortlisted' ),
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
				_el.data( 'shortlisted', ( $.product.isShortlisted ) ? 0 : 1 );
				_el.children( 'span' ).toggleClass( 'fa-heart-o fa-heart' );

				$.pakMaterial.notify( 'success', '<strong>' + res.message + '</strong>' );

				$.product.resetProductObject();
			}
		},
		error: function( err ) {
			$.pakMaterial.notify( 'danger', '<strong>' + err.responseJSON.message + '</strong>' );
			$.product.resetProductObject();
		}
	});
};

$.product.resetProductObject = function() {
	// _el 			= undefined;
	$.product.productId 	= undefined;
	$.product.isShortlisted	= undefined;
}

$.product.addToCompareList = function( _el ) {
	$.product.productId 	= _el.data( 'product-id' ),

	$.ajax({
		url: 		$.product.baseUrl + '/comparison',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			product_id: $.product.productId
		},
		success: function( res ) { 
			if( res.status === 'success' ) {
				$.pakMaterial.notify( 'success', '<strong>' + res.message + '</strong>' );

				_el.trigger( 'product-count-changed', { 'productCount': res.productCount } );

				$.product.resetProductObject();
			}
		},
		error: function( err ) {
			$.pakMaterial.notify( 'danger', '<strong>' + err.responseJSON.message + '</strong>' );
			$.product.resetProductObject();
		}
	});

	$.product.resetProductObject();
}