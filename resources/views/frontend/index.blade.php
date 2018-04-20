@extends('components.frontend.master')

@section( 'title', 'Home' )
@section( 'content' )

<!--================================
    START HERO AREA
=================================-->
<section class="hero-area bgimage">
    <div class="bg_image_holder">
        <img src="images/hero_area_bg1.jpg" alt="background-image">
    </div>
    <!-- start hero-content -->
    <div class="hero-content content_above">
        <!-- start .contact_wrapper -->
        <div class="content-wrapper">
            <!-- start .container -->
            <div class="container">
                <!-- start row -->
                <!-- <div class="row">
                    
                    <div class="col-md-12">
                        <div class="hero__content__title">
                            <h1>
                                <span class="light">Create Your Own</span>
                                <span class="bold">Digital Product Marketplace</span>
                            </h1>
                            <p class="tagline">MartPlace is the most powerful, & customizable template for Easy Digital Downloads Products</p>
                        </div>

                        
                        <div class="hero__btn-area">
                            <a href="all-products.html" class="btn btn--round btn--lg">View All Products</a>
                            <a href="all-products.html" class="btn btn--round btn--lg">Popular Products</a>
                        </div>
                    </div>
                </div> --><!-- end /.row -->
            </div><!-- end /.container -->
        </div><!-- end .contact_wrapper -->
    </div><!-- end hero-content -->

    <!--start search-area -->
    <div class="search-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .container -->
            <div class="row">
                <!-- start .col-sm-12 -->
                <div class="col-sm-12">
                    <!-- start .search_box -->
                    <div class="search_box">
                        <form action="#">
                            <input type="text" class="text_field" placeholder="Search your products...">
                            <div class="search__select select-wrap">
                                <select name="category" class="select--field" id="blah">
                                    <option value="">All Categories</option>
                                    <option value="">List of Categories</option>
                                    
                                </select>
                                <span class="lnr lnr-chevron-down"></span>
                            </div>
                            <button type="submit" class="search-btn btn--lg">Search Now</button>
                        </form>
                    </div><!-- end ./search_box -->
                </div><!-- end /.col-sm-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </div><!--start /.search-area -->
</section>
<!--================================
    END HERO AREA
=================================-->


  


<!--================================
    START PRODUCTS AREA
=================================-->
<section class="products section--padding">
    <!-- start container -->
    <div class="container">

        <!-- start .row -->
        <div class="row">
            <!-- start .col-md-4 -->
            {{-- <div class="col-md-4 col-sm-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="images/p1.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Contact</a>
                        </div><!-- end /.prod_btn -->
                    </div><!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title"><h4>MartPlace Extension Bundle</h4></a>
                        <ul class="titlebtm">
                            <li>
                                <img class="auth-img" src="images/auth.jpg" alt="author image">
                                <p><a href="#">AazzTech</a></p>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque
                            the mattis, leo quam aliquet congue.</p>
                    </div><!-- end /.product-desc -->

                    <div class="product-purchase text-center">
                        <button class="btn--icon my-btn btn--round">
                            <span class="lnr lnr-list"></span> More Info
                        </button>

                        <button class="btn--icon my-btn btn--round">
                            <span class="lnr lnr-envelope"></span> Contact
                        </button>
                    </div><!-- end /.product-purchase -->
                    
                </div><!-- end /.single-product -->
            </div> --}}<!-- end /.col-md-4 -->
             @if( isset( $products ) && $products->count() > 0 )
                        <div class="row">
                            @foreach( $products as $product )
                                <div class="col-md-4 col-sm-4">
                                    <!-- start .single-product -->
                                    <div class="product product--card product--card-small">

                                        <div class="product__thumbnail">
                                            @if( file_exists( $product->img_path . '/' . $product->img ) )
                                                <img class="auth-img" src="{{ asset( 'storage/product/' . $product->img ) }}" alt="author image">
                                            @else
                                                <img src="images/p1.jpg" alt="Product Image">
                                            @endif
                                            
                                            <div class="prod_btn">
                                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                                <a href="{{ route( 'profile.show', [ $product->user->code ] ) }}" class="transparent btn--sm btn--round">Contact</a>
                                            </div><!-- end /.prod_btn -->
                                        </div><!-- end /.product__thumbnail -->

                                        <div class="product-desc">
                                           <a href="#" class="product_title"><h4>{{ (strlen($product->name) > 28) ? substr($product->name,0,28).'...' :$product->name  }}</h4></a>
                                            <ul class="titlebtm">
                                                <li>
                                                    @if( $product->user->detail->profile_img && file_exists( $product->user->detail->profile_path . '/' . $product->user->detail->profile_img ) )
                                                        <img class="auth-img" src="{{ asset( 'storage/profile_img/' . $product->user->detail->profile_img ) }}" alt="author image">
                                                    @else
                                                        <img class="auth-img" src="{{ asset( 'images/auth.jpg' ) }}" alt="author image">
                                                    @endif
                                                    <p><a href="{{ route('profile.show', [$product->user->code]) }}">{{ $product->user->detail->company_name }}</a></p>
                                                </li>
                                                <br>
                                                <li class="">
                                                <span class="fa fa-folder iconcolor"></span>
                                                    <a href="{{ route('categories.products', [$product->sub_category->category->slug]) }}">{{ $product->sub_category->category->name }}</a>
                                                    {{-- <span class="lnr lnr-chevron-right"></span><a href="{{ route('categories.sub-categories.products', [$product->sub_category->category->slug, $product->sub_category->slug]) }}">{{ $product->sub_category->name }}</a> --}}
                                                </li>

                                                <li>
                                                   <span class="fa fa-money iconcolor"></span><strong> {{ $product->price }} {{ $product->currency->name }}</strong>
                                                </li>

                                                {{-- <li>
                                                   <span class="fa fa-barcode iconcolor"></span> </strong>{{ strtoupper($product->code) }}</strong>
                                                </li> --}}
                                            </ul>
                                        </div><!-- end /.product-desc -->

                                        <div class="product-purchase text-center">
                                            <button data-product-id="{{ $product->id }}" data-shortlisted="{{ 0 }}"
                                                 class="my-btn btn--round tip add-shortlist" title="Click to shortlist this product">
                                                <span class="fa fa-heart-o"></span>
                                            </button>

                                            <button class="btn--icon my-btn btn--round">
                                                <span class="lnr lnr-envelope"></span> Contact
                                            </button>

                                            <button data-product-id="{{ $product->id }}" 
                                                class="btn--icon my-btn btn--round tip add-compare" title="Click to add this product to comparison list">
                                                <span class="fa fa-plus"></span> 
                                            </button>
                                        </div><!-- end /.product-purchase -->
                                    </div><!-- end /.single-product -->
                                </div><!-- end /.col-md-4 -->
                            @endforeach
                        </div>
                     @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger text-center">
                                    No Product Found!
                                </div>
                            </div>
                        </div>
                    @endif
           
        </div><!-- end /.row -->

        <!-- start .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="more-product">
                    <a href="{{ route( 'products' ) }}" class="btn btn--lg btn--round">All New Products</a>
                </div>
            </div><!-- end ./col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</section>
<!--================================
    END PRODUCTS AREA
=================================-->




<section class="call-to-action bgimage">
    <div class="bg_image_holder">
        <img src="images/calltobg.jpg" alt="">
    </div>
    <div class="container content_above">
        <div class="row">
            <div class="col-md-12">
                <div class="call-to-wrap">
                    <h1 class="text--white">Ready to Join Our Marketplace!</h1>
                    <h4 class="text--white">Over 25,000 designers and developers trust the MartPlace.</h4>
                    <a href="#" class="btn btn--lg btn--round btn--white callto-action-btn">Join Us Today</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================
    END CALL TO ACTION AREA
=================================-->
@endsection