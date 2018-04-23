@extends('components.backend.master')
@php
    $active = 'products';
@endphp

@section('title', 'Products')
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

                            <div class="item-action">
                                <div class="action-btns">
                                    <a href="#" class="btn btn--round btn--lg">Live Preview</a>
                                    <a href="#" class="btn btn--round btn--lg btn--icon"><span class="lnr lnr-heart"></span>Add To Favorites</a>
                                </div>
                            </div><!-- end /.item__action -->
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
                            <div class="price"><h1><sup>{{ $product->currency->name }}</sup> {{ $product->price }}</h1></div>
                        </div><!-- end /.sidebar--card -->

                        <div class="sidebar-card card--product-infos">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <ul class="infos">
                                <li><p class="data-label">Code:</p><p class="info">{{ $product->code }} </p></li>
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
                                <div class="author_avatar">
                                    <img src="{{ asset('storage/profile_img/'.$product->user->detail->profile_img) }}" alt="Presenting the broken author avatar :D">
                                </div>

                                <div class="author">
                                    <h4>{{ $product->user->detail->company_name }}</h4>
                                    <p>Signed Up: {{ $product->user->created_at }}</p>
                                </div><!-- end /.author -->

                                <!-- end /.social -->

                                <div class="author-btn">
                                    <a href="#" class="btn btn--sm btn--round">View Profile</a>
                                    <a href="#" class="btn btn--sm btn--round">Send Message</a>
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

    <!--============================================
        START MORE PRODUCT ARE
    ==============================================-->
    <section class="more_product_area section--padding">
        <div class="container">
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>More Items <span class="highlighted">by Aazztech</span></h1>
                    </div>
                </div><!-- end /.col-md-12 -->

                <!-- start .col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <img src="images/p4.jpg" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div><!-- end /.prod_btn -->
                        </div><!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title"><h4>Mccarther Coffee Shop</h4></a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="images/auth3.jpg" alt="author image">
                                    <p><a href="#">AazzTech</a></p>
                                </li>
                                <li class="product_cat">
                                    <a href="#"><img src="images/cathtm.png" alt="category image">Plugin</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque
                                the mattis, leo quam aliquet congue.</p>
                        </div><!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10</span>
                                <p><span class="lnr lnr-heart"></span> 48</p>
                            </div>

                            <div class="rating product--rating">
                                <ul>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star-half-o"></span></li>
                                </ul>
                            </div>

                            <div class="sell"><p><span class="lnr lnr-cart"></span><span>50</span></p></div>
                        </div><!-- end /.product-purchase -->
                    </div><!-- end /.single-product -->
                </div><!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <img src="images/p2.jpg" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div><!-- end /.prod_btn -->
                        </div><!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title"><h4>Mccarther Coffee Shop</h4></a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="images/auth2.jpg" alt="author image">
                                    <p><a href="#">AazzTech</a></p>
                                </li>
                                <li class="product_cat">
                                    <a href="#"><img src="images/catword.png" alt="category image">wordpress</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque
                                the mattis, leo quam aliquet congue.</p>
                        </div><!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10</span>
                                <p><span class="lnr lnr-heart"></span> 48</p>
                            </div>

                            <div class="rating product--rating">
                                <ul>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star-half-o"></span></li>
                                </ul>
                            </div>

                            <div class="sell"><p><span class="lnr lnr-cart"></span><span>50</span></p></div>
                        </div><!-- end /.product-purchase -->
                    </div><!-- end /.single-product -->
                </div><!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <img src="images/p6.jpg" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div><!-- end /.prod_btn -->
                        </div><!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title"><h4>The of the century</h4></a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="images/auth.jpg" alt="author image">
                                    <p><a href="#">AazzTech</a></p>
                                </li>
                                <li class="product_cat">
                                    <a href="#"><img src="images/catph.png" alt="Category Image">PSD</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque
                                the mattis, leo quam aliquet congue.</p>
                        </div><!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>$10</span>
                                <p><span class="lnr lnr-heart"></span> 48</p>
                            </div>

                            <div class="rating product--rating">
                                <ul>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star"></span></li>
                                    <li><span class="fa fa-star-half-o"></span></li>
                                </ul>
                            </div>

                            <div class="sell"><p><span class="lnr lnr-cart"></span><span>50</span></p></div>
                        </div><!-- end /.product-purchase -->
                    </div><!-- end /.single-product -->
                </div><!-- end /.col-md-4 -->

                </div><!-- end /.container -->
            </div><!-- end /.container -->
    </section>
    <!--============================================
        END MORE PRODUCT AREA
    ==============================================-->

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
<script>
    $("#img_01").elevateZoom({
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
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 
    
    // {gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}
</script>
@endsection