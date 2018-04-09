@extends( 'components.frontend.master' )

@section( 'title', 'Reviews' )

@section( 'content' )
<?php
// echo '<pre>FILE: ' . __FILE__ . '<br>LINE: ' . __LINE__ . '<br>';
// print_r( $reviews );
// echo '</pre>'; die;
?>
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
    <section class="author-profile-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <aside class="sidebar sidebar_author">
                        <div class="author-card sidebar-card">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    <img src="images/author-avatar.jpg" alt="Presenting the broken author avatar :D">
                                </div>

                                <div class="author">
                                    <h4>AazzTech</h4>
                                    <p>Signed Up: 08 April 2016</p>
                                </div><!-- end /.author -->

                                <div class="social social--color--filled">
                                    <ul>
                                        <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                        <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                                    </ul>
                                </div><!-- end /.social -->

                                <div class="author-btn">
                                    <a href="#" class="btn btn--md btn--round">Follow</a>
                                </div><!-- end /.author-btn -->
                            </div><!-- end /.author-infos -->
                        </div><!-- end /.author-card -->

                        <div class="sidebar-card author-menu">
                            <ul>
                                <li><a href="author.html">Profile</a></li>
                                <li><a href="author-items.html">Author Items</a></li>
                                <li><a class="active" href="author-reviews.html">Customer Reviews</a></li>
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
                                <div class="rating">
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
                    </div><!-- end /.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-title-area">
                                <div class="product__title">
                                    <h2><span class="bold">{{ $reviews->count() }}</span> Customer Reviews</h2>
                                </div>
                            </div><!-- end /.product-title-area -->
                            
                            <div class="thread thread_review thread_review2">
                                @if( $reviews )
                                    <ul class="media-list thread-list">
                                        @foreach( $reviews as $review )
                                            <li class="single-thread">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/m1.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="media-heading">
                                                                    <a href="author.html"><h4>Themexylum</h4></a>
                                                                    <a href="#" class="rev_item">Mini - Responsive Bootstrap Dashboard</a>
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
                                                                <span class="review_tag">support</span>
                                                            </div>

                                                            <div class="pull-right rev_time">9 Hours Ago</div>
                                                        </div>
                                                        <p>{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                        {{-- <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m4.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Codepoet_Biplob</h4></a>
                                                                <a href="#" class="rev_item">Beidea - One Page Parallax</a>
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
                                                            <span class="review_tag">code quality</span>
                                                        </div>

                                                        <div class="pull-right rev_time">3 Hours Ago</div>
                                                    </div>
                                                    <p>Awesome theme. All in one Business Website Solutions.</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m5.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>PaglaGhora</h4></a>
                                                                <a href="#" class="rev_item">Carlos - Creative Agency Template</a>
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
                                                            <span class="review_tag">design quality</span>
                                                        </div>

                                                        <div class="pull-right rev_time">4 Days Ago</div>
                                                    </div>
                                                    <p>Best theme ever....</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m6.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Hearingorg</h4></a>
                                                                <a href="#" class="rev_item">Appspress - applanding page</a>
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
                                                            <span class="review_tag">support</span>
                                                        </div>

                                                        <div class="pull-right rev_time">4 Days Ago</div>
                                                    </div>
                                                    <p>Very helpful support - above and beyond is my experience and I have purchased this theme many times for my clients.</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m7.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>ecom1206</h4></a>
                                                                <a href="#" class="rev_item">Rida-Onepage vcard portfolio theme</a>
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
                                                            <span class="review_tag">code quality</span>
                                                        </div>

                                                        <div class="pull-right rev_time">42 minutes ago</div>
                                                    </div>
                                                    <p>Awesome theme. All in one Business Website Solutions.</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m8.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Mr.Mango</h4></a>
                                                                <a href="#" class="rev_item">Tamabill - Multi-Purpose HTML Template</a>
                                                            </div>
                                                            <div class="rating product--rating">
                                                                <ul>
                                                                    <li><span class="fa fa-star"></span></li>
                                                                    <li><span class="fa fa-star"></span></li>
                                                                    <li><span class="fa fa-star-o" aria-hidden="true"></span></li>
                                                                    <li><span class="fa fa-star-o" aria-hidden="true"></span></li>
                                                                    <li><span class="fa fa-star-o" aria-hidden="true"></span></li>
                                                                </ul>
                                                            </div>
                                                            <span class="review_tag">design quality</span>
                                                        </div>

                                                        <div class="pull-right rev_time">1 years ago</div>
                                                    </div>
                                                    <p>Retina logo won't work retina logo won't work</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m6.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Hearingorg</h4></a>
                                                                <a href="#" class="rev_item">Khadim - Extension Bundle</a>
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
                                                            <span class="review_tag">support</span>
                                                        </div>

                                                        <div class="pull-right rev_time">27 Days Ago</div>
                                                    </div>
                                                    <p>Very helpful support - above and beyond is my experience and I have purchased this theme many times for my clients.</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m9.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Tueld</h4></a>
                                                                <a href="#" class="rev_item">Elpis - A Simple Design For Bloggers</a>
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
                                                            <span class="review_tag">code quality</span>
                                                        </div>

                                                        <div class="pull-right rev_time">3 months</div>
                                                    </div>
                                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut sceleris que the mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. </p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m3.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Living Potato</h4></a>
                                                                <span>3 months ago</span>
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
                                                            <span class="review_tag">customization</span>
                                                        </div>

                                                        <div class="pull-right rev_time">2456454 years ago</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="single-thread">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="images/m6.png" alt="Commentator Avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <div class="media-heading">
                                                                <a href="author.html"><h4>Visual-Eggs</h4></a>
                                                                <a href="#" class="rev_item">Dhalua - WordPress Theme for Personal Blog</a>
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
                                                            <span class="review_tag">support</span>
                                                        </div>

                                                        <div class="pull-right rev_time">39 second ago</div>
                                                    </div>
                                                    <p>This is the finest art in the history of whateverland. Pastor: No it's a witchcraft.</p>
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul><!-- end /.media-list -->

                                    <div class="pagination-area pagination-area2">
                                        <nav class="navigation pagination " role="navigation">
                                            <div class="nav-links">
                                                <a class="page-numbers current" href="#">1</a>
                                                <a class="page-numbers" href="#">2</a>
                                                <a class="page-numbers" href="#">3</a>
                                                <a class="next page-numbers" href="#"><span class="lnr lnr-arrow-right"></span></a>
                                            </div>
                                        </nav>
                                    </div><!-- end /.comment pagination area -->
                                @else
                                    <div class="alert alert-danger text">No review found!</div>
                                @endif
                            </div><!-- end /.comments -->
                        </div><!-- end /.col-md-12 -->
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