$.productDetail = $.productDetail || {};

$(function() {
	$.productDetail.baseUrl 		= $( '#base_url' ).val();
	$.productDetail.zoomIndicator	= $( '.zoom-indicator' );
	// $.productDetail.mainImg 		= $( '#main_img' );
	$.productDetail.btnReport		= $( '#btn_report' );
	$.productDetail.reportModal 	= $( '#report_modal' );
	$.productDetail.id 				= $.productDetail.reportModal.find( '#product_id' ).val();
	$.productDetail.message			= $.productDetail.reportModal.find( '#message' );
	$.productDetail.btnSend 		= $.productDetail.reportModal.find( '#btn_send' );





	// =============================================
	// 				FORM VALIDATION
	// =============================================

	$.productDetail.validator = $( '#reportForm' ).validate({
 		errorClass: 'invalid',
 		ignore: ':hidden',
		rules: {
			message: {
				required: true
			}
		},
		messages: {
			message: {
				required: 	"Please enter message"
			}
		},
		errorElement: "span",
		errorPlacement: function( error, element ) {
			error.addClass( 'help-block' );

			error.insertAfter( element );
		},
		// highlight: function( element, errorClass, validClass ) {
		// 	var elem = $( element );

		// 	elem.parent( '[class^="col"]' ).addClass( 'has-error' ).removeClass( 'has-success' );
		// },
		// unhighlight: function(element, errorClass, validClass) {
		// 	var elem = $( element );

		// 	elem.parent( '[class^="col"]' ).addClass( 'has-success' ).removeClass( 'has-error' );
		// }
	});





	// =============================================
	// 				PLUGINS INIT
	// =============================================



	// =============================================
	// 				EVENT BINDINGS
	// =============================================

	$.productDetail.btnReport.on( 'click', function() {
		$.productDetail.reportModal.modal( 'show' );
	});

	$.productDetail.btnSend.on( 'click', function( e ) {
		e.preventDefault();

		if( $.productDetail.validator.form() ) {
			$.productDetail.sendReport();
		}
	});

	$.productDetail.reportModal.on( 'hidden.bs.modal', function() {
	    $ ( this ).find( 'form' )[0].reset();
	});
});





$.productDetail.sendReport = function() {
	$.ajax({
		url: 		$.productDetail.baseUrl + '/reports',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			product_id: $.productDetail.id,
			message: 	$.productDetail.message.val()
		},
		success: function( res ) { 
			if( res.status === 'success' ) {
				$.productDetail.reportModal.modal( 'hide' );
				
				$.pakMaterial.notify( 'success', '<strong>' + res.message + '</strong>' );
			}
		},
		error: function( err ) {
			$.pakMaterial.notify( 'danger', '<strong>' + err.responseJSON.message + '</strong>' );
		}
	});
};