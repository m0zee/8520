@extends( 'components.frontend.master' )

@section( 'title', 'Login' )

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
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="#">Favorites</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Your Favourites</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
        START AUTHOR AREA
    =================================-->
        @include( 'components.frontend.vendor_menu' )
    <section class="author-profile-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <aside class="sidebar sidebar_author">
                        <div class="author-card sidebar-card">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    <img src="{{ asset('storage/profile_img/'.$user->detail->profile_img) }}" alt="Presenting the broken author avatar :D">
                                </div>

                                <div class="author">
                                    <h4>{{ $user->detail->company_name }}</h4>
                                    <p>Signed Up: 08 April 2016</p>
                                </div><!-- end /.author -->

                                <div class="social social--color--filled">
                                    <ul>
                                        <li><a href="//{{ $user->detail->facebook }}" target="_blank"><span class="fa fa-facebook"></span></a></li>
                                        <li><a href="//{{ $user->detail->twitter }}" target="_blank"><span class="fa fa-twitter"></span></a></li>
                                        <li><a href="//{{ $user->detail->linked_in }}" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                                        <li><a href="//{{ $user->detail->google_plus }}" target="_blank"><span class="fa fa-google-plus"></span></a></li>
                                    </ul>
                                </div><!-- end /.social -->

                                <div class="author-btn">
                                    <a href="#" class="btn btn--md btn--round">Follow</a>
                                </div><!-- end /.author-btn -->
                            </div><!-- end /.author-infos -->


                        </div><!-- end /.author-card -->

                        <div class="sidebar-card author-menu">
                            <ul>
                                <li><a href="#" class="active">Profile</a></li>
                                <li><a href="author-items.html">Author Items</a></li>
                                <li><a href="{{ route( 'vendors.reviews.index', [ 'vendor_code' => $user->code ] ) }}">Customer Reviews</a></li>
                                <li><a href="author-followers.html">Followers (67)</a></li>
                                <li><a href="author-following.html">Following (39)</a></li>
                            </ul>
                        </div><!-- end /.author-menu -->

                        <div class="sidebar-card freelance-status">
                            <div class="custom-radio">
                                <input type="radio" id="opt1" class="" name="filter_opt" checked>
                                <label for="opt1"><span class="circle"></span>Available for Freelance work</label>
                            </div>
                        </div><!-- end /.author-card -->

                        <div class="sidebar-card message-card">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <div class="message-form">
                                <form action="#">
                                    <div class="form-group">
                                        <textarea name="message" class="text_field" id="author-message" placeholder="Your message..."></textarea>
                                    </div>

                                    <div class="msg_submit">
                                        <button type="submit" class="btn btn--md btn--round">send message</button>
                                    </div>
                                </form>
                               <p> Please <a href="#">sign in</a> to contact this author.</p>
                            </div><!-- end /.message-form -->
                        </div><!-- end /.freelance-status -->
                    </aside>
                </div><!-- end /.sidebar -->

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                           <div class="author-info mcolorbg4">
                               <p>Total Items</p>
                               <h3>4,369</h3>
                           </div>
                        </div><!-- end /.col-md-4 -->

                        <div class="col-md-4 col-sm-4">
                            <div class="author-info pcolorbg">
                                <p>Total sales</p>
                                <h3>36,957</h3>
                            </div>
                        </div><!-- end /.col-md-4 -->

                        <div class="col-md-4 col-sm-4">
                            <div class="author-info scolorbg">
                                <p>Total Items</p>
                                <div class="rating product--rating">
                                    <ul>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star-half-o"></span></li>
                                    </ul>
                                    <span class="rating__count">(26)</span>
                                </div>
                            </div>
                        </div><!-- end /.col-md-4 -->

                        <div class="col-md-12 col-sm-12">
                            <div class="author_module">
                                <img src="{{asset('storage/cover_img/'.$user->detail->cover_img)}}" alt="author image">
                            </div>

                            <div class="author_module about_author">
                                <h2>About <span>{{ $user->detail->company_name }}</span></h2>
                                <p>
                                    {{$user->detail->description}}
                                </p>
                            </div>
                        </div>
                    </div><!-- end /.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-title-area">
                                <div class="product__title">
                                    <h2>Newest Products</h2>
                                </div>

                                <a href="#" class="btn btn--sm">See all Items</a>
                            </div><!-- end /.product-title-area -->
                        </div><!-- end /.col-md-12 -->

                        <!-- start .col-md-4 -->
                        <div class="col-md-6 col-sm-6">
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
                                    <a href="#" class="product_title"><h4>Yannan Na nakka muka</h4></a>
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
                        <div class="col-md-6 col-sm-6">
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
                        <div class="col-md-6 col-sm-6">
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
                        <div class="col-md-6 col-sm-6">
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
                    </div><!-- end /.row -->
                </div><!-- end /.col-md-8 -->

            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END AUTHOR AREA
    =================================-->

@endsection

@section( 'js' )
@endsection