$.reviews = $.reviews || {};
$(function() {
	$.reviews.ratings 			= $( '#ratings' );
	$.reviews.ratingUrl 		= $( '#rating_url' ).val();
	$.reviews.selectedRatings	= $( '#selected_ratings' );

	$.reviews.ratings.barrating( 'show', {
    	theme: 'fontawesome-stars',
    	allowEmpty: true,
    	initialRating: '0',
    	emptyValue: '0',
    	onSelect: function( value, text, event ) {
    		if( typeof( event ) !== 'undefined' ) {
    			$.reviews.selectedRatings.val( value );
    			// rating was selected by a user
		      	// console.log(event.target);
		    }
		    else {
		    	// rating was selected programmatically
		    	// by calling `set` method
		    }
		}
	});

	$.reviews.setRatingValue();
});

$.reviews.setRatingValue = function() {
	var _selectedValue = $.reviews.selectedRatings.val();

	_selectedValue = parseInt( _selectedValue );

	if( _selectedValue !== NaN && _selectedValue > 0 ) {
		$.reviews.ratings.barrating( 'set', _selectedValue );
	}
}