$.reviews = $.reviews || {};
$(function() {
	$.reviews.ratingUrl = $( '#rating_url' ).val();

    $( '#ratings' ).barrating( 'show', {
    	theme: 'fontawesome-stars',
    	onSelect: function( value, text, event ) {
    		if (typeof(event) !== 'undefined') {
    			// rating was selected by a user
		      	// console.log(event.target);
		      	$.reviews.postRatings( value );
		    }
		    else {
		    	// rating was selected programmatically
		    	// by calling `set` method
		    }
		}
	});
});

$.reviews.postRatings = function( ratings ) {
	$.ajax({
  		url: $.reviews.ratingUrl,
  		type: 'post',
      	dataType: 'JSON',
      	data: {
      		'ratings': ratings
      	},
      	success: function( res ) {
      		console.log( res );
      	},
      	error: function( err ) {
      		console.log( err );
      	}
    });
}