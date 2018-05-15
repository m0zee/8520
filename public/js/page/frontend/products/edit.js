var _validator;

$(function() {
    var base_url = $('#base_url').val();
    
    // $('#category').on('change', function() {
    //     get_sub_category( $(this) );
    // });

    $('.file-upload').on('change', function() {
        var file_name = $(this).val().split('\\').pop();
        file_name = ( file_name != '' ) ? file_name : 'No file selected' ;
        $('.selected_img_name').text(file_name);
    });

    $( '#thumbnail' ).imageReader({
        destination: '#product_img'
    });

    // function get_sub_category($this) {
    //     var category_id = $this.val();

    //     $.ajax({
    //         url: base_url + '/get_sub_category',
    //         type: 'POST',
    //         dataType: 'JSON',
    //         data: {category_id: category_id},
    //         success:function (response){
    //             var rows = makeRows(response);
    //             $('#sub_category').html(rows);
    //         }
    //     });
    // }

    // function makeRows(response) {
    //     var row = '<option value="0"> Please Select </options>';
    //     $.each(response, function(index, val) {
    //         row += '<option value="'+val.id+'">' + val.name + '</options>';
    //     });
    //     return row;
    // }



    _validator = $( '#product_form' ).validate({
        errorClass:     'help-block',
        errorElement:   'span',
        rules: {
            category_id: {
                required: true,
            },
            sub_category: {
                required: true,
                pattern: /^[1-9]+[0-9]*$/
            },
            brand_name: {
                required: true
            },
            name: {
                required: true
            },
            country_id: {
                required: true
            },
            unit_id: {
                required: true
            },
            max_supply: {
                required: true,
                pattern: /^[1-9]+[0-9]*$/
            },
            currency_id: {
                required: true
            },
            price: {
                required: true,
                pattern: /^[1-9]+[0-9]*$/
            },
            description: {
                required: true,
            }
        },
        messages: {
            category_id:        "Please select Category",
            sub_category:       "Please select Sub Category",
            brand_name:         "Please enter Brand Name",
            name:               "Please enter Product Name",
            country_id:         "Please select Made In",
            unit_id:            "Please select Max Supply Unit",
            max_supply: {
                required:   "Please enter Max Supplies Quantity",
                pattern:    "Please enter only digits"
            },
            currency_id:    "Please select Currency",
            price: {
                required:   "Please enter Amount",
                pattern:    "Please enter only digits"
            },
            description: {
                required:   "Please enter Description"
            }
        },
        errorPlacement: function( error, element ) {
            var id      = element.attr( 'id' ),
                _array  = [ 'category_id', 'sub_category_id', 'country_id', 'unit_id', 'currency_id','trumbowyg-demo' ];

            if( $.inArray( id, _array ) !== -1 ) {
                element.parent().parent().append( error );
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

});

//configuration
var max_file_size           = 2048576; //allowed file size. (1 MB = 1048576)
var allowed_file_types      = ['image/png', 'image/jpeg', 'image/pjpeg']; //allowed file types
var result_output           = '#output'; //ID of an element for response output
var my_form_id              = '#product_form'; //ID of an element for response output
var progress_bar_id         = '#progress-wrp'; //ID of an element for response output
var total_files_allowed     = 1; //Number files allowed to upload



//on form submit
$( my_form_id ).on( "submit", function( event ) { 
    
    event.preventDefault();

    if( ! _validator.form() ) {
        return false;
    }

    var proceed = true; //set proceed flag
    var error = []; //errors
    var total_files_size = 0;
    
    //reset progressbar
    $(progress_bar_id).removeClass('hidden');
    $(progress_bar_id +" .progress-bar").css("width", "0%");
    $("#progress-status").text("0%");
    
    if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
        error.push("Your browser does not support new File API! Please upgrade."); //push error text
    }
    else {
        var total_selected_files = this.elements['__files[]'].files.length; //number of files
        
        //check if file is available
        if(total_selected_files > total_files_allowed){
            error.push( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
            proceed = false; //set proceed flag to false
        }
        //iterate files in file input field
        $( this.elements['__files[]'].files ).each( function( i, ifile ) {
            if( ifile.value !== "" ) { //continue only if file(s) are selected
                if( allowed_file_types.indexOf(ifile.type) === -1 ) { //check unsupported file
                    error.push( "<b>"+ ifile.name + "</b> is unsupported file type!"); //push error text
                    proceed = false; //set proceed flag to false
                }

                total_files_size = total_files_size + ifile.size; //add file size to total size
            }
        });
             
        //if total file size is greater than max file size
        if(total_files_size > max_file_size){ 
            error.push( "You have "+total_selected_files+" file(s) with total size "+total_files_size+", Allowed size is " + max_file_size +", Try smaller file!"); //push error text
            proceed = false; //set proceed flag to false
        }

        var submit_btn  = $(this).find("input[type=submit]"); //form submit button

        //if everything looks good, proceed with jQuery Ajax
        if( proceed ) {
            //submit_btn.val("Please Wait...").prop( "disabled", true); //disable submit button
            var form_data = new FormData(this); //Creates new FormData object
            var post_url = $(this).attr("action"); //get action URL of form
            
            //jQuery Ajax to Post form data
            $.ajax({
                url : post_url,
                type: "POST",
                dataType: 'JSON',
                data : form_data,
                contentType: false,
                cache: false,
                processData:false,
                xhr: function() {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if( xhr.upload ) {
                        xhr.upload.addEventListener('progress', function( event ) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
                        $("#progress-status").text(percent +"%");
                    }, true );
                }
                return xhr;
            },
            mimeType: "multipart/form-data"
            })
            .done(function(res) { //
                if (res.hasOwnProperty('success') ) 
                {
                    window.location.href =  $('#base_url').val() + "/my-account/products"  ;
                }
                else if(res.errors != '')
                {
                    showErrors( res.errors );
                }
            });
        }
    }

    $(result_output).html(""); //reset output 
    $( error ).each( function( i ) { //output any error to output element
        $(result_output).append('<div class="error">'+error[i]+"</div>");
    });
});

function showErrors( errors ) {
    var _li = '',
        errorMessageContainer = $( '#errorMessageContainer' );

    $.each( errors, function( i, val ) {
        _li += '<li>' + val[0] + '</li>';
    });
    var errorTemplate = '<div class="alert alert-danger text-center">' +
                            '<strong>Errors</strong>' +
                            '<ul>' + _li + '</ul>' +
                        '</div>';

    errorMessageContainer.children().remove().end().append( errorTemplate );
};