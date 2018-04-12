$.review = $.review || {
	requestedLink: undefined,
};

$(function() {
	$.review.modal 		= $( '#confirmation_modal' );
	$.review.modalTitle	= $.review.modal.find( '.modal-title' );

	$( '.actions' ).on( 'click', 'a', $.review.confirmAction );

	$.review.modal.on( 'click', '#btn_yes', function() {
		if( $.review.requestedLink !== undefined ) window.location = $.review.requestedLink;
	});

	$.review.modal.on( 'click', '#btn_no', function() {
		$.review.reset();
	});
});





$.review.confirmAction = function( e ) {
	e.preventDefault();

	var $this = $( this );
	$.review.requestedLink = $this.attr( 'href' );

	if( $this.hasClass( 'approve' ) ) {
		$.review.modalTitle.text( 'Are you sure you want to approve this review?' );
	}
	else if( $this.hasClass( 'reject' ) ) {
		$.review.modalTitle.text( 'Are you sure you want to reject this review?' );
	}

	$.review.modal.modal( 'show' );
};





$.review.reset = function() {
	$.review.requestedLink = undefined;
	$.review.modalTitle.text('___');
};