$.product = $.product || {};

$(function() {
	$.product.baseUrl 		= $( '#base_url' ).val();
	$.product.mainImg 		= $( '#main_img' );
	$.product.btnReport		= $( '#btn_report' );
	$.product.reportModal 	= $( '#report_modal' );
	$.product.id 			= $.product.reportModal.find( '#product_id' ).val();
	$.product.message		= $.product.reportModal.find( '#message' );
	$.product.btnSend 		= $.product.reportModal.find( '#btn_send' );





	// =============================================
	// 				FORM VALIDATION
	// =============================================

	$.product.validator = $( '#myForm' ).validate({
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

	$.product.mainImg.elevateZoom({
        gallery:'thumb-slider',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        scrollZoom : true,
        // zoomWindowPosition
        zoomType: 'window',
        zoomWindowWidth: 400, 
        zoomWindowHeight:    400 ,
        zoomWindowOffetx :   0 ,  
        zoomWindowOffety :   0 , 
        zoomWindowPosition  :1,
        responsive:true,
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
    });





	// =============================================
	// 				EVENT BINDINGS
	// =============================================

	$.product.btnReport.on( 'click', function() {
		$.product.reportModal.modal( 'show' );
	});

	$.product.btnSend.on( 'click', function( e ) {
		e.preventDefault();

		if( $.product.validator.form() ) {
			$.product.sendReport();
		}
	});

	$.product.reportModal.on( 'hidden.bs.modal', function() {
	    $ ( this ).find( 'form' )[0].reset();
	});
});





$.product.sendReport = function() {
	$.ajax({
		url: 		$.product.baseUrl + '/reports',
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			product_id: $.product.id,
			message: 	$.product.message.val()
		},
		success: function( res ) { 
			if( res.status === 'success' ) {
				$.product.reportModal.modal( 'hide' );
				
				$.pakMaterial.notify( 'success', '<strong>' + res.message + '</strong>' );
			}
		},
		error: function( err ) {
			$.pakMaterial.notify( 'danger', '<strong>' + err.responseJSON.message + '</strong>' );
		}
	});
};