   $.product = $.product || {
	baseUrl: 		undefined,
	productId: 		undefined,
	userId: 		undefined,
	isShortlisted:	undefined,
	validator: 		undefined
};

$(function() {
	$.pakMaterial.numberOnlyFields();
	
	$.product.validator = $( '#myForm' ).validate({
 		errorClass: 'invalid',
 		ignore: ':hidden',
		rules: {
			email: {
				required: true,
				email: true,
				pattern: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			},
			loginPassword: {
				required: true,
				minlength: 3
			},
			name: {
				required: true
			},
			userTypeId: {
				required: true
			},
			registerPassword: {
				required: true,
				minlength: 3
			},
			conpassword: {
				required: true,
				minlength: 3,
				equalTo: '#registerPassword'
			},
			quantity: {
				required: true,
				pattern: /[0-9]*\d/
			},
			message: {
				required: true
			}
		},
		messages: {
			email: 			"Please enter a valid email address",
			loginPassword: {
				required: 	"Please enter password",
				minlength: 	"Your password must be at least 3 characters long"
			},
			name: {
				required: 	"Please enter your name"
			},
			userTypeId: {
				required: 	"Please selet account type"
			},
			registerPassword: {
				required: 	"Please enter password",
				minlength: 	"Your password must be at least 3 characters long"
			},
			conpassword: {
				required: 	"Please enter confirm password",
				minlength: 	"Your password must be at least 3 characters long",
				equalTo: 	"Confirm password does not match password"
			},
			quantity: {
				required: 	"Please enter quantity",
				pattern: 	"Please enter only digits"
			},
			message: {
				required: 	"Please enter message"
			}
		},
		errorElement: "span",
		errorPlacement: function( error, element ) {
			error.addClass( 'help-block' );

			if( element.attr( 'type' ) === 'radio' ) {
				element.parent().parent( '.radio' ).append( error );
			}
			else {
				error.insertAfter( element );
			}
		},
		highlight: function( element, errorClass, validClass ) {
			var elem = $( element );
			
			if( elem.attr( 'type' ) === 'radio' ) {
				elem.parent().parent( '.radio' ).addClass( 'has-error' ).removeClass( 'has-success' );
			}
			else {
				elem.parent( '[class^="col"]' ).addClass( 'has-error' ).removeClass( 'has-success' );
			}
		},
		unhighlight: function(element, errorClass, validClass) {
			var elem = $( element );

			if( elem.attr( 'type' ) === 'radio' ) {
				elem.parent().parent( '.radio' ).addClass( 'has-success' ).removeClass( 'has-error' );
			}
			else {
				elem.parent( '[class^="col"]' ).addClass( 'has-success' ).removeClass( 'has-error' );
			}
		}
	});











	$.product.baseUrl 						= $( '#base_url' ).val();
	$.product.btnAddToShortlist				= $( '.add-shortlist' );
	$.product.btnAddToCompare				= $( '.add-compare' );
	$.product.productContainer				= $( '#product-container' );
	$.product.modal							= $( '#myModal' );

	$.product.loadingModal					= $( '#loadingModal' );
	
	$.product.modal.inputEmail				= $.product.modal.find( '#email' );
	$.product.modal.inputLoginPassword		= $.product.modal.find( '#loginPassword' );
	$.product.modal.inputRegisterPassword	= $.product.modal.find( '#registerPassword' );
	$.product.modal.inputConfirmPassword	= $.product.modal.find( '#conpassword' );
	$.product.modal.inputName				= $.product.modal.find( '#name' );
	$.product.modal.radioBuyer				= $.product.modal.find( '#buyer' );
	$.product.modal.radioVendor				= $.product.modal.find( '#vendor' );
	$.product.modal.loginFields				= $.product.modal.find( '.loginFields' );
	$.product.modal.registerFields 			= $.product.modal.find( '.registerFields' );
	$.product.modal.inputQuantity 			= $.product.modal.find( '#quantity' );
	$.product.modal.inputMessage 			= $.product.modal.find( '#message' );

	$.product.modal.errors 					= 0;
	$.product.modal.btnSend					= $.product.modal.find( '#btn-send' );
	$.product.isUserExists					= $( '#isUserExists' );
	$.product.isUserLoggedin				= $( '#isUserLoggedin' );

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

	$.product.modal.inputEmail.on( 'blur', function( e ) {
		e.preventDefault();
		
		var $this = $( this ),
			_val  = $this.val();

		if( $.pakMaterial.validateEmail( _val ) ) {
			$.product.checkUser( $this );			
		}
	});

	$.product.modal.btnSend.on( 'click', function( e ) {
		e.preventDefault();

		if( $.product.validator.form() ) {
			$.product.sendMessage();
		}
	});

	$.product.modal.on( 'hidden.bs.modal', function() {
	    $ ( this ).find( 'form' )[0].reset();
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
		beforeSend : function( e ) {
			$.product.loadingModal.modal( 'show', {
				backdrop: 'static',
				keyboard: false
			});
		},
		success: function( res ) { 
			if( res.status === 'success' ) {
				var _product = res.product;

				$.product.userId = _product.user_id;
				$.product.modal.find( '#unit' ).html( _product.unit );
				$.product.modal.find( '#message' ).val( 'Hi! I would like to know about your product ' + _product.name );

				$.product.modal.modal( 'show', {
					backdrop: 'static',
					keyboard: false
				});
			}
		},
		error: function( err ) {
			console.log( err );
		},
		complete: function( jqXHR, _data ) {
			$.product.loadingModal.modal( 'hide' );
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
					$.product.modal.inputLoginPassword.focus();
					if( $.product.modal.registerFields.is( ':visible' ) ) {
						$.product.modal.registerFields.addClass( 'hidden' );
					}
				}
				else if( res.status === 'fail' ) {
					$.product.isUserExists.val( '0' );
					$.product.modal.registerFields.removeClass( 'hidden' );
					$.product.modal.inputName.focus();
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





$.product.sendMessage = function() {
	if( $.product.isUserLoggedin.val() == '1' ) {
		$.product.send();
	}
	else {
		var _needToRegister 	= parseInt( $.product.isUserExists.val() ) == 0 ;

		if( _needToRegister ) {
			$.product.register();
		}
		else {
			$.product.login();
		}
	}
};

$.product.register = function() {
	$.ajax({
		url: 		$.product.baseUrl + '/register',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			'email':					$.product.modal.inputEmail.val(),
			'password': 				$.product.modal.inputRegisterPassword.val(),
			'password_confirmation':	$.product.modal.inputConfirmPassword.val(),
			'password_confirmation':	$.product.modal.inputConfirmPassword.val(),
			'name': 					$.product.modal.inputName.val(),
			'user_type_id': 			$.product.modal.radioBuyer.is( ':checked' ) ? $.product.modal.radioBuyer.val() : $.product.modal.radioVendor.val()	
		},
		beforeSend : function( e ) {
			$.product.loadingModal.modal( 'show', {
				backdrop: 'static',
				keyboard: false
			});
		},
		success: function( res ) {
			$.product.login( { 'password': $.product.modal.inputRegisterPassword.val() } );
		},
		error: function( err ) {
			console.log( err );
		},
		complete: function( jqXHR, _data ) {
			$.product.loadingModal.modal( 'hide' );
		}
	});
};

$.product.login = function( credentials ) {
	$.ajax({
		url: 		$.product.baseUrl + '/login',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			'email':	$.product.modal.inputEmail.val(),
			'password':	( credentials === undefined ) ? $.product.modal.inputLoginPassword.val() : credentials.password
		},
		beforeSend : function( e ) {
			$.product.loadingModal.modal( 'show', {
				backdrop: 'static',
				keyboard: false
			});
		},
		success: function( res ) {
// 			$.product.isUserLoggedin.val( '1' );
			$.product.send();
		},
		error: function( err ) {
			if( err.hasOwnProperty( 'responseJSON' ) ) {
				var _errors = err.responseJSON;
				
				if( _errors.hasOwnProperty( 'email' ) ) {
					$.pakMaterial.notify( 'danger', _errors.email );
				}
			}
		},
		complete: function( jqXHR, _data ) {
			$.product.loadingModal.modal( 'hide' );
		}
	});
};

$.product.send = function() {
	$.ajax({
		url: 		$.product.baseUrl + '/messages',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			'product_id':	$.product.productId,
			'quantity': 	$.product.modal.inputQuantity.val(),
			'message': 		$.product.modal.inputMessage.val(),
			'user_id': 		$.product.userId
		},
		success: function( res ) {
			if( res.hasOwnProperty( 'status' ) && res.status == 'OK' ) {

				$.product.modal.modal( 'hide' );

				$.pakMaterial.notify( 'success', '<strong>' + res.message + '</strong>' );

				if( $.product.isUserLoggedin.val() != '1' ) {
					setTimeout( function() {
						window.location = window.location.href;
					}, 4000 );
				}
			}
		},
		error: function( err ) {
			alert( err );
		}
	});
}