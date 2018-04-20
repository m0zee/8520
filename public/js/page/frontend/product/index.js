   $.product = $.product || {
	baseUrl: 		undefined,
	// el: 			undefined,
	productId: 		undefined,
	isShortlisted:	undefined
};

$(function() {
	// $( '#myForm' ).validate( {
	// 	debug: true,
	// 	errorClass: 'invalid',
	// 	rules: {
	// 		email: {
	// 			required: true,
	// 			email: true
	// 		},
	// 		password: {
	// 			required: true,
	// 			minlength: 6,
	// 			pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/
	// 		},
	// 		// conpass: {
	// 		// 	required: true,
	// 		// 	minlength: 6,
	// 		// 	equalTo: '#password'
	// 		// },
	// 		// user_type_id: {
	// 		// 	required: true
	// 		// }
	// 	},
	// 	messages: {
	// 		email: 			"Please enter a valid email address",
	// 		password: {
	// 			required: 	"Please provide a password",
	// 			minlength: 	"Your password must be at least 6 characters long",
	// 			pattern: 	"Password should be the combination of digit, lower case, upper case letters"
	// 		},
	// 		// conpass: {
	// 		// 	required: 	"Please provide a confirm password",
	// 		// 	minlength: 	"Your password must be at least 6 characters long",
	// 		// 	equalTo: 	"Confirm password does not match password"
	// 		// },
	// 		// user_type_id: {
	// 		// 	required: 	"Please select type of account",
	// 		// }
	// 	},
	// 	errorElement: "span",
	// 	errorPlacement: function( error, element ) {
	// 		error.addClass( 'help-block' );

	// 		if( element.attr( 'type' ) === 'radio' ) {
	// 			element.parent().parent( '.radio' ).append( error );
	// 		}
	// 		else {
	// 			error.insertAfter( element );
	// 		}
	// 	},
	// 	highlight: function( element, errorClass, validClass ) {
	// 		var elem = $( element );
			
	// 		if( elem.attr( 'type' ) === 'radio' ) {
	// 			elem.parent().parent( '.radio' ).addClass( 'has-error' ).removeClass( 'has-success' );
	// 		}
	// 		else {
	// 			elem.parent( '[class^="col"]' ).addClass( 'has-error' ).removeClass( 'has-success' );
	// 		}
	// 	},
	// 	unhighlight: function(element, errorClass, validClass) {
	// 		var elem = $( element );

	// 		if( elem.attr( 'type' ) === 'radio' ) {
	// 			elem.parent().parent( '.radio' ).addClass( 'has-success' ).removeClass( 'has-error' );
	// 		}
	// 		else {
	// 			elem.parent( '[class^="col"]' ).addClass( 'has-success' ).removeClass( 'has-error' );
	// 		}
	// 	}
	// });
















	$.product.baseUrl 						= $( '#base_url' ).val();
	$.product.btnAddToShortlist				= $( '.add-shortlist' );
	$.product.btnAddToCompare				= $( '.add-compare' );
	$.product.productContainer				= $( '#product-container' );
	$.product.modal							= $( '#myModal' );
	
	$.product.modal.inputEmail				= $.product.modal.find( '#email' );
	$.product.modal.inputLoginPassword		= $.product.modal.find( '#login-password' );
	$.product.modal.inputRegisterPassword	= $.product.modal.find( '#register-password' );
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

	$.product.modal.inputEmail.on( 'blur', function() {
		var $this = $( this ),
			_val  = $this.val();
		
		$.product.resetErrors();

		if( $.pakMaterial.validateEmail( _val ) ) {
			$.product.checkUser( $this );			
		}
		else {
			$.product.showError( $this.attr( 'id' ), 'Please enter valid email address' );
		}
	});

	$.product.modal.btnSend.on( 'click', function( e ) {

		// if( $.product.modal.errors > 0 ) return false;

		$.product.sendMessage();
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





$.product.showError = function( inputId, error ) {
	if( inputId == 'password' ) {
		inputId = parseInt( $.product.isUserExists.val() === 0 ) ? 'register-password' : 'login-password';	
	}
	
	$.product.modal.find( '#' + inputId ).siblings( '.help-block' ).text( error );
	$.product.modal.errors ++;
};

$.product.resetErrors = function() {
	$.product.modal.find( '.help-block' ).text( '' );
	$.product.modal.errors = 0;
};





$.product.sendMessage = function() {
	var _needToRegister 	= parseInt( $.product.isUserExists.val() === 0 );//,
		// _url 				= $.product.baseUrl;
		// _loginPayload 		= {
		// 	'email':		$.product.modal.inputEmail.val(),
		// 	'password': 	$.product.modal.inputLoginPassword.val()
		// },
		// _registerPayload 	= {
		// 	'email':					$.product.modal.inputEmail.val(),
		// 	'password': 				$.product.modal.inputRegisterPassword.val(),
		// 	'password_confirmation':	$.product.modal.inputConfirmPassword.val(),
		// 	'password_confirmation':	$.product.modal.inputConfirmPassword.val(),
		// 	'name': 					$.product.modal.inputName.val(),
		// 	'user_type_id': 			$.product.modal.radioBuyer.is( ':checked' ) ? $.product.modal.radioBuyer.val() : $.product.modal.radioVendor.val()	
		// },
		// _enquiryPayload 	= {
		// 	'product_id': 	$.product.productId,
		// 	'qty': 			$.product.modal.inputQuantity.val(),
		// 	'message': 		$.product.modal.inputMessage.val()
		// };

	if( _needToRegister ) {
		$.ajax({
			url: 		_url + '/register',
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
			success: function( res ) {
				// body...
			},
			error: function( err ) {
				// body...
			}
		});
	}
	else {
		$.product.login();
	}
};

$.product.login = function() {
	$.ajax({
		url: 		$.product.baseUrl + '/login',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			'email':	$.product.modal.inputEmail.val(),
			'password':	$.product.modal.inputLoginPassword.val()
		},
		success: function( res ) {
			$.product.send();
		},
		error: function( err ) {
			if( err.hasOwnProperty( 'responseJSON' ) ) {
				var _errors = err.responseJSON;

				$.each( _errors, function( _field, _val ) {
					$.product.showError( _field, _val[0] );
				});
			}
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
			'qty': 			$.product.modal.inputQuantity.val(),
			'message': 		$.product.modal.inputMessage.val()
		},
		success: function( res ) {
			console.log( res );
		},
		error: function( err ) {
			alert( err );
		}
	});
}