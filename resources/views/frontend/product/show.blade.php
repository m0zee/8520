@extends( 'components.frontend.master' )


@section( 'title', 'Products' )
@section( 'content' )
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
                            <li><a href="{{ route('products') }}">Products</a></li>
                            <li><a href="{{ route('categories.products', [$product->category->slug]) }}">{{$product->category->name}}</a></li>
                            <li><a href="{{ route('categories.sub-categories.products', [$product->category->slug, $product->sub_category->slug]) }}">{{$product->sub_category->name}}</a></li>
                            <li class="active"><a href="#">{{ strtoupper($product->name) }}</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{ $product->count() > 0 ? $product->name : 'Product Not Available' }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    <!--================================
        END BREADCRUMB AREA
    =================================-->
    
    @if ($product != NULL && $product->count() > 0)
        
    
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
                            <div class="prev-slide">
                                <img id="main_img" src="{{ asset( 'storage/product/' . $product->img ) }}"  
                                    data-zoom-image="{{ asset( 'storage/product/' . $product->img ) }}" 
                                    alt="Keep calm this isn't the end of the world, the preview is just missing.">
                            </div>
                            @if( $product->gallery->count() > 0 )
                                @foreach( $product->gallery as $gallery )
                                    <div class="prev-slide">
                                        <img src="{{ asset( 'storage/product/gallery/' . $gallery->img ) }}" alt="Keep calm this isn't the end of the world, the preview is just missing.">
                                    </div>
                                @endforeach
                            @endif

                        </div><!-- end /.item--preview-slider -->

                        <div class="item__preview-thumb">
                            <div class="prev-thumb">
                                <div class="thumb-slider" id="thumb-slider">

                                    <a class="item-thumb" data-image="{{ asset( 'storage/product/' . $product->img ) }}" 
                                        data-zoom-image="{{ asset( 'storage/product/' . $product->img ) }}">
                                        <img src="{{ asset( 'storage/product/80x80_' . $product->img ) }}" alt="This is the thumbnail of the item">
                                    </a>

                                    @foreach($product->gallery as $gallery)
                                        <a class="item-thumb" data-image="{{ asset( 'storage/product/gallery/' . $gallery->img ) }}" 
                                            data-zoom-image="{{ asset( 'storage/product/gallery/' . $gallery->img ) }}">
                                            <img src="{{ asset( 'storage/product/gallery/80x80_' . $gallery->img ) }}" alt="This is the thumbnail of the item">
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
                                    <img src="{{ asset( 'storage/profile_img/' . $product->user->detail->profile_img ) }}" alt="Presenting the broken author avatar :D">
                                </div>

                                <div class="author">
                                    <h4>{{ $product->user->detail->company_name }}</h4>
                                    <p>Signed Up: {{ $product->user->created_at }}</p>
                                </div><!-- end /.author -->


                                <div class="author-btn">
                                    <a href="{{ url( 'profile/' . $product->user->code ) }}" class="btn btn--sm btn--round">View Profile</a>
                                    <button class="btn btn--sm btn--round" id="btn_report">Report</button>
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
                            <img src="{{ asset( 'images/p4.jpg' ) }}" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div><!-- end /.prod_btn -->
                        </div><!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title"><h4>Mccarther Coffee Shop</h4></a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="{{ asset( 'images/auth3.jpg' ) }}" alt="author image">
                                    <p><a href="#">AazzTech</a></p>
                                </li>
                                <li class="product_cat">
                                    <a href="#"><img src="{{ asset( 'images/cathtm.png' ) }}" alt="category image">Plugin</a>
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
                            <img src="{{ asset( 'images/p2.jpg' ) }}" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div><!-- end /.prod_btn -->
                        </div><!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title"><h4>Mccarther Coffee Shop</h4></a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="{{ asset( 'images/auth2.jpg' ) }}" alt="author image">
                                    <p><a href="#">AazzTech</a></p>
                                </li>
                                <li class="product_cat">
                                    <a href="#"><img src="{{ asset( 'images/catword.png' ) }}" alt="category image">wordpress</a>
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
                            <img src="{{ asset( 'images/p6.jpg' ) }}" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div><!-- end /.prod_btn -->
                        </div><!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="#" class="product_title"><h4>The of the century</h4></a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="{{ asset( 'images/auth.jpg' ) }}" alt="author image">
                                    <p><a href="#">AazzTech</a></p>
                                </li>
                                <li class="product_cat">
                                    <a href="#"><img src="{{ asset( 'images/catph.png' ) }}" alt="Category Image">PSD</a>
                                </li>
                            </ul>

                            <p>
                                Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis, leo quam aliquet congue.
                            </p>
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

    <div class="modal fade reportModal" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="reportModal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <h4>Report this product</h4>
                </div><!-- end /.modal-header -->

                <div class="modal-body">

                    <div class="row">
                        {{ Form::open( [ 'url' => '#', 'id' => 'myForm' ] ) }}
                            <div class="col-md-12">
                                <div class="information_module">
                                            
                                    <div class="form-group has-error">
                                        {{ Form::label( 'message', 'Message' ) }}
                                        {{
                                            Form::textarea( 'message', '', [ 
                                                'placeholder'   => 'Please enter your message here ...', 
                                                'id'            => 'message',
                                                'class'         => 'text_field',
                                                'rows'          => 3,
                                                'style'         => 'resize: none;'
                                            ])
                                        }}
                                        <span class="help-block"></span>
                                    </div>

                                </div>
                            </div>

                            {{ Form::hidden( 'product_id', $product->id, [ 'id' => 'product_id' ] ) }}

                            <div class="col-md-12">
                                <div class="dashboard_setting_btn">
                                    <button type="submit" id="btn_send" class="btn btn--round btn--md">Send</button>
                                </div>
                            </div><!-- end /.col-md-12 -->
                        {{ Form::close() }}
                    </div>

                </div><!-- end /.modal-body -->
            </div>
        </div>
    </div>

@endsection

@section( 'js' )
    <script src="{{ asset( 'js/vendor/jquery.elevatezoom.min.js' ) }}"></script>
    <script src="{{ asset( 'js/vendor/jquery-validation/jquery.validate.min.js' ) }}"></script>
    <script src="{{ asset( 'js/page/home/show.js' ) }}"></script>
@endsection