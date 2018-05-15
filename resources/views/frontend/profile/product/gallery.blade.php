@extends( 'components.frontend.master' )
@php
    $active = 'product'; 
@endphp
@section( 'title', 'Product' )

@section( 'content' )

@section('css')
<link rel="stylesheet" href="{{ asset( 'css/basic.min.css' ) }}">
<link rel="stylesheet" href="{{ asset( 'css/dropzone.css' ) }}">
<link rel="stylesheet" href="{{ asset( 'css/dropzone_custom.css' ) }}">
@endsection


    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('vendor.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('my-account.product') }}">Product</a></li>
                            <li class="active"><a href="#">Galary</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{ $product != NULL ? $product->name : 'Product Not Available' }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="dashboard-area">
        @include('components.frontend.vendor_menu')

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Manage Galary</h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end /.col-md-12 -->
                </div><!-- end /.row -->

                <div class="row">
                    <div class="col-md-8 col-sm-7">
                        <form action="{{ route('my-account.product.add_gallery', [Request::segment('3')]) }}" method="post" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <div id="message-box"></div>
                            </div>
                        </div>
                            <a href="{{ route('my-account.product') }}" class="btn btn--round btn--fullwidth btn--lg">Go back</a>
                    </div><!-- end /.col-md-8 -->

                    <div class="col-md-4 col-sm-5">
                        <aside class="sidebar upload_sidebar">
                            <div class="sidebar-card">
                                <div class="card-title">
                                    <h3>Uploaded Images</h3>
                                </div>

                                <div class="card_content" id="saved_images_container">

                                    <?php if( isset( $gallery ) && (int)count( $gallery ) > 0 ): ?>
                                        @foreach ($gallery as $img)
                                            {{-- <img src="{{ asset('storage/product/gallery/'.$img->img) }}" alt=""> --}}

                                               <div class="col-md-6 delete">
                                                    <a href="{{ route('my-account.product.gallery.destroy', [$img->id]) }}"
                                                               class="btn btn-xs btn-danger rounded tip delete-image del-btn-pos-right"
                                                               role="button" data-placement="bottom" title="Click to delete this image.">
                                                                   <span class="fa fa-trash"></span>
                                                               </a>
                                                   <img class="img-responsive" src="{{ asset('storage/product/gallery/361x230_'.$img->img) }}" alt="Product Image">
                                               </div>
                                        @endforeach
                                        <?php else: ?>
                                            <div id="no-images" class="col-md-12">
                                                <div class="alert alert-danger text-center">
                                                    No images found.
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                    
                                    
                                <div style="clear:both" class="clearboth"></div>
                                </div>
                            </div><!-- end /.sidebar-card -->
                        </aside><!-- end /.sidebar -->
                    </div><!-- end /.col-md-4 -->
                </div><!-- end /.row -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

@endsection

@section('js')
<script src="{{ asset('js/vendor/dropzone.min.js') }}"></script>

<script>
$(function () {
    $.uploadedImage         = {};
    $.uploadedImage.count   = 0;
    // $._queued = null
    // $.uploadedImage.files = [];

     

    var defaultMsgText =    '<h1>Drop file here to upload</h1> or ';
    var defaultMsgTmpl =    defaultMsgText +
                            '<h1><button class="btn btn-default btn-lg" type="button">Select Files</button></h1>' +
                            'Maximum upload file size: 2 MB.';
    var fallbackText =      '<div class="text-center">Please use the modern browser (FireFox, Chrome) for the best functionality</div>';

    Dropzone.options.myDropzone = {
        init: function() {
            this.on( 'maxfilesexceeded', function( file ) {
                showMessage( 'warning', 'You cannot add any more files. Please remove the images from Upload Panel first to upload new images.', 5000 );
            }),
            this.on( 'complete', function( file ) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    var _queued = this;
                    // Remove all files
                    _queued.removeAllFiles();
                    
                    if( $.uploadedImage.count > 0) {
                        showMessage( 'success', $.uploadedImage.count + ' image(s) uploaded successfully' );
                        $.uploadedImage.count = 0;

                    }
                }
            })
            this.on('error', function(file, response) {
                showMessage( 'danger', response, 5000 );
            });
        },
        dictDefaultMessage: defaultMsgTmpl,
        dictFallbackText: fallbackText,
        // forceFallback: true,
        // autoProcessQueue: false,
        maxFiles: 4,
        maxFilesize: 2,
        parallelUploads: 1,
        // uploadMultiple: true,
        addRemoveLinks: true,
        // previewsContainer: "#preview",
        acceptedFiles: "image/jpeg, image/png",
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

    $('.card_content').on( 'click', '.delete-image', deleteImage );
});





showMessage = function ( msgType, msg, delay ) {

    var msg_container = $( '#message-box');
    var elem = '';

    if( delay == undefined || delay == '' ) delay = 3000;

    if( msgType == undefined && msgType == '' ) msgType = "success";

    if ( msg != undefined && msg != '' ) {
        elem =  '<div class="text-center alert alert-' + msgType + '" style="display: none">' +
                    '<button type="button" class="close" data-dismiss="alert">×</button>' +
                    msg +
                '</div>';
    }

    $( elem ).appendTo( msg_container ).slideDown().delay( delay ).slideUp( 1000, function () {
        $( this ).remove();
    });
}

showInImageContainer = function ( data ) {
    var base_url        = $( "#base_url" ).val();
    var template        = '';
    var img_container   = $( "#saved_images_container" );

    if( img_container.children( '#no-images' ).length === 1 ) {
        img_container.children( '#no-images' ).slideUp( function () {
            $( this ).remove();
        });
    }

    if ( data != '' && data != undefined ) {
        // template =   '<div class="col-md-2 well well-sm" style="display: none;">' +
        //              '<div class="thumbnail">' +
        //                  '<img class="img-responsive img-thumbnail" src="' + data.img_path + '" alt="Product Image" style="height: 100px;">' +
        //                     '<p class="text-center">' +
        //                      '<a href="' + base_url + 'mem/product/deleteAdditionalImage/' + data.id + '/product/' + data.product_id + '" class="btn btn-danger btn-xs tip delete-image" role="button" data-toggle="tooltip" data-placement="bottom" title="Click to delete this image.">X</a>' +
        //                     '</p>' +
        //                  '</div>' +
        //             '</div>';

        template =  '<div class="col-md-6 delete">' +
                            '<a href="'+ data.delete_url + '" class="btn btn-xs btn-danger rounded tip delete-image del-btn-pos-right" role="button" data-placement="bottom" title="Click to delete this image.">' +
                                '<span class="fa fa-trash"></span>' +
                            '</a>' +
                            '<img class="img-responsive" src="' + data.img_path + '" alt="Product Image">' +
                        
                    '</div>';

        // $( template ).appendTo( img_container ).slideDown();
        $( template ).insertBefore( '.clearboth' ).slideDown();
    }
}





deleteImage = function ( e ) {
    e.preventDefault();
    var $this               = $( this );
    var url                 = $this.attr( 'href' );
    var parent              = $this.closest( '.col-md-6' );
    var img_container       = $( "#saved_images_container" );

    var no_image_template   =   '<div id="no-images" class="col-md-12" style="display: none;"> ' +
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
            parent.slideUp( 300, function () {
                parent.remove();
            });

        },
        success:function( res ) {

            if( res.hasOwnProperty( 'success' ) ) {

                showMessage( 'success', res.success );

                if( img_container.children().length == 1 ) {
                        $( no_image_template ).insertBefore( '.clearboth' ).slideDown();
                    }

                
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


</script>

@endsection