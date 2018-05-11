@extends( 'components.frontend.master' )

@section( 'title', 'Products' )
@section( 'content' )

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('products') }}">Products</a>
                            </li>
                            <li>
                                <a href="{{ route('categories.products', [ $product->category->slug ] ) }}">{{ $product->category->name }}</a>
                            </li>
                            <li>
                                <a href="{{ route( 'categories.sub-categories.products', [ $product->category->slug, $product->sub_category->slug ] ) }}">
                                    {{ $product->sub_category->name }}
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">{{ strtoupper( $product->name ) }}</a>
                            </li>
                        </ul>
                    </div>

                    <h1 class="page-title">{{ $product->count() > 0 ? $product->name : 'Product Not Available' }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    @if( $product != null && $product->count() > 0 )
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

                                <div class="prev-slide"><img id="img_01" src="{{ asset( 'storage/product/' . $product->img ) }}"  
                                    data-zoom-image="{{ asset( 'storage/product/' . $product->img ) }}" 
                                    alt="Keep calm this isn't the end of the world, the preview is just missing.">
                                </div>
                                @if( $product->gallery->count() > 0 )
                                    @foreach( $product->gallery as $gallery )
                                        <div class="prev-slide"><img src="{{ asset( 'storage/product/gallery/' . $gallery->img ) }}" 
                                            alt="Keep calm this isn't the end of the world, the preview is just missing.">
                                        </div>
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
                                    </div><!-- end /.thumb-slider -->
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
                                <div class="price"><h1><sup>{{ $product->currency->name }}</sup> {{ number_format( $product->price ) }}</h1></div>
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

        <section class="more_product_area section--padding">
            <div class="container">
                <div class="row">
                    <!-- start col-md-12 -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h1>More Items <span class="highlighted">{{ $product->user->detail->company_name }}</span></h1>
                        </div>
                    </div><!-- end /.col-md-12 -->

                    @if( isset( $relativeProducts ) && $relativeProducts->count() > 0 )
                        @foreach( $relativeProducts as $relative )

                            <div class="col-md-4 col-sm-4">
                                <div class="product product--card product--card-small">

                                    <div class="product__thumbnail">
                                        @if( file_exists( $relative->img_path . '/' . $relative->img ) )
                                            <img class="auth-img" src="{{ asset( 'storage/product/361x230_' . $relative->img ) }}" alt="author image">
                                        @else
                                            <img src="images/p1.jpg" alt="Product Image">
                                        @endif
                                        
                                        <div class="prod_btn">
                                            <a href="{{ route( 'products.show', [ $relative->category->slug, $relative->sub_category->slug, $relative->code, $relative->slug ] ) }}" class="transparent btn--sm btn--round">More Info</a>
                                            <a href="{{ route( 'profile.show', [ $relative->user->code ] ) }}" class="transparent btn--sm btn--round btn-contact">Contact</a>
                                        </div><!-- end /.prod_btn -->
                                    </div><!-- end /.product__thumbnail -->

                                    <div class="product-desc">
                                        <a href="{{ route( 'products.show', [ $relative->category->slug, $relative->sub_category->slug, $relative->code, $relative->slug ] ) }}" class="product_title">
                                            <h4>{{ ( strlen( $relative->name ) > 23 ) ? substr( $relative->name, 0, 23 ) . ' ...' : $relative->name  }}</h4>
                                        </a>

                                        
                                        <ul class="titlebtm">
                                            @if( $relative->user->detail != null  )
                                                <li>
                                                    @if( $relative->user->detail->profile_img && file_exists( $relative->user->detail->profile_path . '/' . $relative->user->detail->profile_img ) )
                                                        <img class="auth-img" src="{{ asset( 'storage/profile_img/30x30_' . $relative->user->detail->profile_img ) }}" alt="author image">
                                                    @else
                                                        <img class="auth-img" src="{{ asset( 'images/auth.jpg' ) }}" alt="author image">
                                                    @endif
                                                    <p><a href="{{ route('profile.show', [$relative->user->code]) }}">{{ $relative->user->detail->company_name }}</a></p>
                                                </li>
                                                <br>
                                            @endif
                                            <li>
                                                <span class="fa fa-folder iconcolor"></span>
                                                <a href="{{ route('categories.products', [$relative->category->slug]) }}">
                                                    {{ $relative->category->name }}
                                                </a>
                                            </li>

                                            <li>
                                               <span class="fa fa-money iconcolor"></span>
                                               <strong>{{ $relative->price }} {{ $relative->currency->name }} - {{ $relative->unit->name }}</strong>
                                            </li>
                                        </ul>
                                    </div><!-- end /.product-desc -->

                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center">
                                No more items found
                            </div>
                        </div>
                    @endif

                    </div><!-- end /.container -->
                </div><!-- end /.container -->
        </section>

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

@section( 'js' )

<script src="{{ asset('js/vendor/jquery.elevatezoom.min.js') }}"></script>
<script>
    $( "#img_01" ).elevateZoom({
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
</script>
@endsection