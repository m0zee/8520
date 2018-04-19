   $.product = $.product || {
	baseUrl: 		undefined,
	// el: 			undefined,
	productId: 		undefined,
	isShortlisted:	undefined
};

$(function() {
	$.product.baseUrl 				= $( '#base_url' ).val();
	$.product.btnAddToShortlist		= $( '.add-shortlist' );
	$.product.btnAddToCompare		= $( '.add-compare' );
	$.product.productContainer		= $( '#product-container' );
	$.product.modal					= $( '#myModal' );
	$.product.modal.loginFields		= $.product.modal.find( '.loginFields' );
	$.product.modal.registerFields 	= $.product.modal.find( '.registerFields' );
	$.product.isUserLoggedin		= $( '#isUserLoggedin' );
	$.product.isUserExists			= $( '#isUserExists' );

	// EVENT BINDINGS
	$.product.btnAddToShortlist.on( 'click', function( e ) {
		$.product.shortlist( $( this ) );
	});

	$.product.btnAddToCompare.on( 'click', function( e ) {
		$.product.addToCompareList( $( this ) );
	});

	$.product.productContainer.on( 'click', '.btn-contact', function() {
		$.product.get( $( this ) );
	});

	$( '#email' ).on( 'blur', function() {
		$.product.checkUser( $( this ) );
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
};

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
};

$.product.get = function( _el ) {
	$.product.productId 	= _el.data( 'product-id' );

	$.ajax({
		url: 		$.product.baseUrl + '/products/' + $.product.productId + '/get',
		type: 		'GET',
		dataType: 	'JSON',
		success: function( res ) { 
			if( res.status === 'success' ) {
				var _product = res.product;
				$.product.modal.find( '#unit' ).html( _product.unit );
				$.product.modal.find( '#message' ).val( 'Hi! I would like to know about your product ' + _product.name );

				$.product.modal.modal( 'show' );
			}
		},
		error: function( err ) {
			console.log( err );
		}
	});
};

$.product.checkUser = function( _el ) {
	var _email = _el.val();

	if( _email != '' ) {
		$.ajax({
			url: 		$.product.baseUrl + '/users/' + _email + '/get',
			type: 		'GET',
			dataType: 	'JSON',
			success: function( res ) { 
				if( res.status === 'success' ) {
					$.product.isUserExists.val( '1' );
					$.product.modal.loginFields.removeClass( 'hidden' );
					if( $.product.modal.registerFields.is( ':visible' ) ) {
						$.product.modal.registerFields.addClass( 'hidden' );
					}
				}
				else if( res.status === 'fail' ) {
					$.product.isUserExists.val( '0' );
					$.product.modal.registerFields.removeClass( 'hidden' );
					if( $.product.modal.loginFields.is( ':visible' ) ) {
						$.product.modal.loginFields.addClass( 'hidden' );
					}
				}
			},
			error: function( err ) {
				console.log( err );
			}
		});
	}
};