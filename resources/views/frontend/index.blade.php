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
            <div class="col-md-4 col-sm-6">
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
            </div><!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-md-4 col-sm-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="images/p2.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Contact</a>
                        </div><!-- end /.prod_btn -->
                    </div><!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title"><h4>Mccarther Coffee Shop</h4></a>
                        <ul class="titlebtm">
                            <li>
                                <img class="auth-img" src="images/auth2.jpg" alt="author image">
                                <p><a href="#">AazzTech</a></p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-book"></span>Plugin</a>
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
            </div><!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-md-4 col-sm-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="images/p3.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Contact</a>
                        </div><!-- end /.prod_btn -->
                    </div><!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title"><h4>Visibility Manager Subscriptions</h4></a>
                        <ul class="titlebtm">
                            <li>
                                <img class="auth-img" src="images/auth3.jpg" alt="author image">
                                <p><a href="#">AazzTech</a></p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-book"></span>Plugin</a>
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

                    {{-- <div class="product-purchase">
                        <div class="price_love">
                            <span>Free</span>
                            <p><span class="lnr lnr-heart"></span> 24</p>
                        </div>
                        <div class="rating product--rating">
                            <ul>
                                <li><span class="fa fa-star"></span></li>
                                <li><span class="fa fa-star"></span></li>
                                <li><span class="fa fa-star"></span></li>
                                <li><span class="fa fa-star"></span></li>
                                <li><span class="fa fa-star"></span></li>
                            </ul>
                        </div>
                        <div class="sell"><p><span class="lnr lnr-cart"></span><span>27</span></p></div>
                    </div> --}}<!-- end /.product-purchase -->
                </div><!-- end /.single-product -->
            </div><!-- end /.col-md-4 -->

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
                        <a href="single-product.html" class="product_title"><h4>Ajax Live Search</h4></a>
                        <ul class="titlebtm">
                            <li>
                                <img class="auth-img" src="images/auth.jpg" alt="author image">
                                <p><a href="#">AazzTech</a></p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-book"></span>Plugin</a>
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
            </div><!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-md-4 col-sm-6">
                <!-- start .single-product -->
                <div class="product product--card">

                    <div class="product__thumbnail">
                        <img src="images/p5.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                        </div><!-- end /.prod_btn -->
                    </div><!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="single-product.html" class="product_title"><h4>Mccarther Coffee Shop</h4></a>
                        <ul class="titlebtm">
                            <li>
                                <img class="auth-img" src="images/auth2.jpg" alt="author image">
                                <p><a href="#">AazzTech</a></p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-book"></span>Plugin</a>
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
                        <a href="single-product.html" class="product_title"><h4>Visibility Manager Subscriptions</h4></a>
                        <ul class="titlebtm">
                            <li>
                                <img class="auth-img" src="images/auth3.jpg" alt="author image">
                                <p><a href="#">AazzTech</a></p>
                            </li>
                            <li class="product_cat">
                                <a href="#"><span class="lnr lnr-book"></span>WordPress</a>
                            </li>
                        </ul>

                        <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque
                            the mattis, leo quam aliquet congue.</p>
                    </div><!-- end /.product-desc -->

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>Free</span>
                            <p><span class="lnr lnr-heart"></span> 24</p>
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
                        <div class="sell"><p><span class="lnr lnr-cart"></span><span>27</span></p></div>
                    </div><!-- end /.product-purchase -->
                </div><!-- end /.single-product -->
            </div><!-- end /.col-md-4 -->
        </div><!-- end /.row -->

        <!-- start .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="more-product">
                    <a href="all-products.html" class="btn btn--lg btn--round">All New Products</a>
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