@extends('components.backend.master')
@php
    $active = 'products';
@endphp

@section('title', 'Products')

@section( 'css' )
    <link rel="stylesheet" href="{{ url( 'js/vendor/fancybox/jquery.fancybox-1.3.4.css' ) }}">
@endsection

@section('content')
<!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                            <li class="active"><a href="#">Show</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{ $product->count() > 0 ? $product->name : 'Product Not Available' }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
        @include('components.backend.menu')
    <!--================================
        END BREADCRUMB AREA
    =================================-->
    
    @if ($product->count() > 0)
        
    
    <!--============================================
        START SINGLE PRODUCT DESCRIPTION AREA
    ==============================================-->
    <section class="single-product-desc">
        @if ($product->status_id != 2)
            <div class="alert alert-info text-center">
                <strong>This Product status is {{ $product->status->name }} </strong>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="zoom-indicator">
                        <span class="fa fa-search-plus fa-3x"></span>  {{-- title="Hover over the image to see the large image or click the image to show in popup" --}}
                    </div>
                    <div class="item-preview">
                        <div class="item__preview-slider" style="width:99.9%">
                            {{-- <div class="prev-slide"><img src="images/p1.jpg" alt="Keep calm this isn't the end of the world, the preview is just missing."></div> --}}
                            <div class="prev-slide"><img id="img_01" src="{{ asset('storage/product/'.$product->img) }}"  data-zoom-image="{{ asset('storage/product/'.$product->img) }}" alt="1 Keep calm this isn't the end of the world, the preview is just missing."></div>
                            @if ($product->gallery->count() > 0)
                                @foreach ($product->gallery as $gallery)
                                    <div class="prev-slide"><img src="{{ asset('storage/product/gallery/'.$gallery->img) }}" alt="1 Keep calm this isn't the end of the world, the preview is just missing."></div>
                                @endforeach
                            @endif

                        </div><!-- end /.item--preview-slider -->

                        <div class="item__preview-thumb">
                            <div class="prev-thumb">
                                <div class="thumb-slider" id="thumb-slider">

                                    <a class="item-thumb" data-image="{{ asset('storage/product/'.$product->img) }}" data-zoom-image="{{ asset('storage/product/'.$product->img) }}">
                                        <img src="{{ asset('storage/product/80x80_'.$product->img) }}" alt="This is the thumbnail of the item">
                                    </a>
                                    @foreach ($product->gallery as $gallery)
                                    <a class="item-thumb" data-image="{{ asset('storage/product/gallery/'.$gallery->img) }}" data-zoom-image="{{ asset('storage/product/gallery/'.$gallery->img) }}">
                                        <img src="{{ asset('storage/product/gallery/80x80_'.$gallery->img) }}" alt="This is the thumbnail of the item">
                                    </a>

                                    @endforeach

                                   {{--  <div class="item-thumb"><img src="{{ asset('storage/product/80x80_'.$product->img) }}" alt="This is the thumbnail of the item"></div>
                                    @foreach ($product->gallery as $gallery)
                                    <div class="item-thumb"><img src="{{ asset('storage/product/gallery/80x80_'.$gallery->img) }}" alt="This is the thumbnail of the item"></div>

                                    @endforeach --}}
                                    {{-- <div class="item-thumb"><img src="images/thumb2.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb3.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb4.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb5.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb1.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb2.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb3.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb4.jpg" alt="This is the thumbnail of the item"></div>
                                    <div class="item-thumb"><img src="images/thumb5.jpg" alt="This is the thumbnail of the item"></div> --}}
                                </div><!-- end /.thumb-slider -->

                                {{-- <div class="prev-nav thumb-nav">
                                    <span class="lnr nav-left lnr-arrow-left"></span>
                                    <span class="lnr nav-right lnr-arrow-right"></span>
                                </div> --}}<!-- end /.prev-nav -->
                            </div>
                        </div><!-- end /.item__preview-thumb-->


                    </div><!-- end /.item-preview-->

                    

                    <div class="item-info">
                        <div class="item-navigation">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active">
                                    <a href="#product-details" aria-controls="product-details" role="tab" data-toggle="tab">Item Details</a>
                                </li>
                            </ul>
                        </div><!-- end /.item-navigation -->

                        <div class="tab-content">
                            <div class="fade in tab-pane product-tab active" id="product-details">
                                <div class="tab-content-wrapper">
                                    {!! $product->description !!}
                                </div>
                            </div><!-- end /.tab-content -->
                        </div><!-- end /.tab-content -->
                    </div><!-- end /.item-info -->
                </div><!-- end /.col-md-8 -->



                <div class="col-md-4">
                    <aside class="sidebar sidebar--single-product">
                        <div class="sidebar-card card-pricing">
                            <div class="price"><h1><sup>{{ $product->currency->name }}</sup> {{ number_format( $product->price ) }} / <sup>{{ $product->unit->name }}</sup></h1></div>
                        </div><!-- end /.sidebar--card -->

                        <div class="sidebar-card card--product-infos">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <ul class="infos">
                                <li><p class="data-label">Code</p><p class="info">{{ $product->code }} </p></li>
                                <li><p class="data-label">Units</p><p class="info">{{ $product->unit->name }}</p></li>
                                <li><p class="data-label">Max Quantity</p><p class="info">{{ $product->max_supply }}</p></li>
                                <li><p class="data-label">Brand</p><p class="info">{{ $product->brand_name }}</p></li>
                                <li><p class="data-label">Made In</p><p class="info">{{ $product->country->name }}</p></li>
                            </ul>
                        </div><!-- end /.aside -->

                        <div class="author-card sidebar-card ">
                            <div class="card-title">
                                <h4>Vendor Information</h4>
                            </div>

                            <div class="author-infos">
                                    <a href="{{ url( 'profile/' . $product->user->code ) }}">
                                        <div class="author_avatar">
                                            <img src="{{ asset( 'storage/profile_img/' . $product->user->detail->profile_img ) }}" alt="Presenting the broken author avatar :D">
                                        </div>
                                    </a>

                                    <div class="author">
                                        <a href="{{ url( 'profile/' . $product->user->code ) }}"><h4>{{ $product->user->detail->company_name }}</h4></a>
                                        <p>Signed Up: {{ $product->user->updated_at->format( 'd M, Y' ) }}</p>

                                        <div class="message-form mycontact-info">
                                            <p><span class="lnr lnr-envelope "></span> {{ $product->user->email }}</p>
                                                                         
                                            <p><span class="lnr lnr-phone"></span> {{ $product->user->detail->phone_number }}</p>
                                            
                                            <p><span class="lnr lnr-smartphone"></span> {{ $product->user->detail->mobile_number }}</p>
                                            
                                            <p><span class="lnr lnr-map-marker"></span> {{ $product->user->detail->address }}</p>
                                        </div>
                                    </div><!-- end /.author -->


                                    <div class="author-btn">
                                        <a href="{{ route( 'vendors.product.index', $product->user->code ) }}" class="btn btn--sm btn--round">Product</a>
                                        {{-- <button class="btn btn--sm btn--round" id="btn_report">Report</button> --}}
                                    </div><!-- end /.author-btn -->
                                </div><!-- end /.author-infos -->


                        </div><!-- end /.author-card -->
                    </aside><!-- end /.aside -->
                </div><!-- end /.col-md-4 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->

   
    @else:
        

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger text-center">
                        No Product Found!
                    </div>
                </div>
            </div>
       
    @endif

@endsection

@section('js')

<script src="{{ asset('js/vendor/jquery.elevatezoom.min.js') }}"></script>
<script src="{{ asset( 'js/vendor/fancybox/jquery.fancybox-1.3.4.js' ) }}"></script>
<script>
    $.productDetail = $.productDetail || {};
    $.productDetail.mainImg = $( '#img_01' );
    $.productDetail.zoomIndicator   = $( '.zoom-indicator' );
    $( "#img_01" ).elevateZoom({
        gallery:'thumb-slider',
        cursor: 'crosshair',
        galleryActiveClass: 'active',
        responsive: true,
        // easing: true,
        // imageCrossfade: true,
        scrollZoom: true,
        // zoomLens: true,
        // lensSize: 800,
        // zoomWindowPosition
        zoomType: 'inner',
        // zoomWindowWidth: 400, 
        // zoomWindowHeight: 400,
        // zoomWindowOffetx: 0,  
        // zoomWindowOffety: 0, 
        // zoomWindowPosition: 1,
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
    }); 

    $.productDetail.mainImg.on( 'click', function( e ) {
        var ez =  $.productDetail.mainImg.data( 'elevateZoom' );
        $.fancybox( ez.getGalleryList() );

        return false;
    });
    $.productDetail.zoomIndicator.on( 'click', function( e ) {
        var ez =  $.productDetail.mainImg.data( 'elevateZoom' );
        $.fancybox( ez.getGalleryList() );

        return false;
    });
</script>
@endsection