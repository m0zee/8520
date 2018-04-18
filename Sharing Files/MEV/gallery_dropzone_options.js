$(function () {
	$.uploadedImage 		= {};
	$.uploadedImage.count 	= 0;
	// $.uploadedImage.files = [];

	var defaultMsgText =	'<h1>Drop file here to upload</h1> or ';
	var defaultMsgTmpl =	defaultMsgText +
							'<h1><button class="btn btn-default btn-lg" type="button">Select Files</button></h1>' +
							'Maximum upload file size: 2 MB.';
	var fallbackText = 		'<div class="text-center">Please use the modern browser (FireFox, Chrome) for the best functionality</div>';

	Dropzone.options.myDropzone = {
		init: function() {
			this.on( 'maxfilesexceeded', function( file ) {
				showMessage( 'warning', 'You cannot add any more files. Please remove the images from Upload Panel first to upload new images.', 5000 );
			}),
			this.on( 'complete', function( file ) {
				if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
					// var _this = this;
					// // Remove all files
					// _this.removeAllFiles();
			   		if( $.uploadedImage.count > 0) {
			   			showMessage( 'success', $.uploadedImage.count + ' image(s) uploaded successfully' );
				   		$.uploadedImage.count = 0;
			   		}
			   	}
			});
		},
		dictDefaultMessage: defaultMsgTmpl,
		dictFallbackText: fallbackText,
		// forceFallback: true,
		// autoProcessQueue: false,
		maxFiles: 6,
		maxFilesize: 2,
		// uploadMultiple: true,
		addRemoveLinks: true,
		// previewsContainer: "#preview",
		acceptedFiles: "image/jpeg, image/png, image/gif",
		success: function( file, res ) {
			res = JSON.parse( res );
			if( res.hasOwnProperty( 'success' ) ) {
				$.uploadedImage.count ++;
				// // call the message function (success)
				// showMessage( 'success', 'The image uploaded successfully');
				// // show the image in the saved images container
				showInImageContainer( res.img_data );
			}
			else if ( res.hasOwnProperty( 'err' ) ) {
				showMessage( 'danger', res.err );
			}
			else {
				showMessage( 'danger', 'An error has occurred. Please try again.' );
			}
		}
	};

	$('.panel-body').on( 'click', '.delete-image', deleteImage );
});





showMessage = function ( msgType, msg, delay ) {

	var msg_container = $( '#message-box');
	var elem = '';

	if( delay == undefined || delay == '' ) delay = 3000;

	if( msgType == undefined && msgType == '' ) msgType = "success";

	if ( msg != undefined && msg != '' ) {
		elem =	'<div class="text-center alert alert-' + msgType + '" style="display: none">' +
					'<button type="button" class="close" data-dismiss="alert">×</button>' +
					msg +
				'</div>';
	}

	$( elem ).appendTo( msg_container ).slideDown().delay( delay ).slideUp( 1000, function () {
		$( this ).remove();
	});
}

showInImageContainer = function ( data ) {
	var base_url 		= $( "#base_url" ).val();
	var template 		= '';
	var img_container 	= $( "#saved_images_container" );

	if( img_container.children( '#no-images' ).length === 1 ) {
		img_container.children( '#no-images' ).slideUp( function () {
			$( this ).remove();
		});
	}

	if ( data != '' && data != undefined ) {
		// template = 	'<div class="col-md-2 well well-sm" style="display: none;">' +
		// 				'<div class="thumbnail">' +
		// 					'<img class="img-responsive img-thumbnail" src="' + data.img_path + '" alt="Product Image" style="height: 100px;">' +
		//                     '<p class="text-center">' +
		//                     	'<a href="' + base_url + 'mem/product/deleteAdditionalImage/' + data.id + '/product/' + data.product_id + '" class="btn btn-danger btn-xs tip delete-image" role="button" data-toggle="tooltip" data-placement="bottom" title="Click to delete this image.">X</a>' +
		//                     '</p>' +
		//                	'</div>' +
		//             '</div>';

		template = 	'<div class="col-md-2">' +
                        '<div class="thumbnail">' +
                            '<a href="' + base_url + 'mem/product/deleteAdditionalImage/' + data.id + '/product/' + data.product_id + '" class="btn btn-xs btn-danger rounded tip delete-image del-btn-pos-right" role="button" data-placement="bottom" title="Click to delete this image.">' +
                                '<span class="glyphicon glyphicon-trash"></span>' +
                            '</a>' +
                            '<img class="img-responsive" src="' + data.img_path + '" alt="Product Image" style="height: 100px;">' +
                        '</div>' +
                    '</div>';

	    $( template ).appendTo( img_container ).slideDown();
	}
}





deleteImage = function ( e ) {
	e.preventDefault();
	var $this 				= $( this );
	var url 				= $this.attr( 'href' );
	var parent 				= $this.closest( '.thumbnail' );
	var img_container 		= $( "#saved_images_container" );

	var no_image_template	=	'<div id="no-images" class="col-md-12" style="display: none;"> ' +
                                    '<div class="alert alert-danger text-center">' +
                                        'No images found.' +
                                    '</div>' +
                                '</div>';


	$.ajax({
		url: url,
 		type: "POST",
 		dataType: "JSON",
 		beforeSend: function () {

 			// IMPLEMENT LOADING IMAGE

 		},
 		success:function( res ) {

 			if( res.hasOwnProperty( 'success' ) ) {

 				showMessage( 'success', res.success );

 				parent.slideUp( 300, function () {
					parent.remove();

					if( img_container.children().length == 0 ) {
						$( no_image_template ).appendTo( img_container ).slideDown();
					}
				});
 			}
 			else if ( res.hasOwnProperty( 'err' ) ) {
				showMessage( 'danger', res.err );
			}
 		},
 		error: function ( res ) {
 			alert("error");
 		}
 	});
}