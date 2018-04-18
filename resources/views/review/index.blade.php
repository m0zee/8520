@extends( 'components.frontend.master' )

@section( 'title', 'Reviews' )

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
    <section class="author-profile-area">
        <div class="container">

            @if( session( 'success' ) || session( 'error' ) )
                <div class="row">
                    <div class="col-md-12">
                        @if( session( 'success' ) )
                            <div class="alert alert-success text-center">
                                <strong>{{ session( 'success' ) }}</strong>
                            </div>
                        @elseif( session( 'error' ) )
                            <div class="alert alert-danger text-center">
                                <strong>{{ session( 'error' ) }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            @endif;

            @if( $errors->any() )
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
                            <strong>You have errors in the review form. Please resolve them</strong>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <aside class="sidebar sidebar_author">
                        <div class="author-card sidebar-card">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    <img src="{{ url( 'images/author-avatar.jpg' ) }}" alt="Presenting the broken author avatar :D">
                                </div>

                                <div class="author">
                                    <h4>{{ $vendor->detail->company_name }}</h4>
                                </div><!-- end /.author -->
                                
                            <span class="{{ ( $vendor->verified == 1 ) ? 'fa fa-check-circle fa-lg' : 'fa fa-exclamation-triangle fa-lg'}}" style="{{ ( $vendor->verified == 1 ) ? 'color:lightgreen;' : 'color: orange;' }}">
                                         
                            </span> {{ $vendor->email }}
                                

                                <div class="social social--color--filled">
                                    <ul>
                                        <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                        <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                                    </ul>
                                </div><!-- end /.social -->

                                <div class="author-btn">
                                    <a href="#" class="btn btn--md btn--round">Follow</a>
                                </div>
                            </div><!-- end /.author-infos -->
                        </div><!-- end /.author-card -->

                        <div class="sidebar-card author-menu">
                            <ul>
                                <li><a href="author.html">Profile</a></li>
                                {{-- <li><a href="author-items.html">Author Items</a></li> --}}
                                <li><a class="active" href="{{ route( 'vendors.reviews.index', $vendor->code ) }}">Customer Reviews</a></li>
                                {{-- <li><a href="author-followers.html">Followers (67)</a></li>
                                <li><a href="author-following.html">Following (39)</a></li> --}}
                            </ul>
                        </div><!-- end /.author-menu -->

                        <div class="sidebar-card freelance-status">
                            <div class="custom-radio">
                                <input type="radio" id="opt1" class="" name="filter_opt" {{ ($vendor->verified == 1) ? 'checked' : '' }} >
                                <label for="opt1"><span class="circle"></span>{{ $vendor->email }}</label>
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
                                @if( $reviews->count() )
                                    <ul class="media-list thread-list">
                                        @foreach( $reviews as $review )
                                            <li class="single-thread">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="{{ url( 'images/m1.png' ) }}" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="media-heading">
                                                                    <a href="author.html"><h4>{{ $review->user->name }}</h4></a>
                                                                </div>
                                                                <div class="rating product--rating">
                                                                    <ul>
                                                                        @for( $i = 1; $i <= $review->ratings; $i++ )
                                                                            <li><span class="fa fa-star"></span></li>
                                                                        @endfor

                                                                         @for( $i = 5; $i > $review->ratings; $i-- )
                                                                            <li><span class="fa fa-star-o"></span></li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="pull-right rev_time">{{ $review->created_at->diffForHumans() }}</div>
                                                        </div>
                                                        <p>{!! nl2br( $review->review ) !!}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul><!-- end /.media-list -->

                                    {{ $reviews->links( 'vendor.pagination.pak-material' ) }}
                                    
                                @else
                                    <div class="alert alert-danger text-center">No review found!</div>
                                @endif

                                <div class="comment-form-area">
                                    <h4>Write a review</h4>

                                    {{ Form::open( [ 'route' => [ 'vendors.reviews.store', $vendor->code ], 'class' => 'comment-reply-form' ] ) }}

                                        <div class="form-group {{ $errors->has( 'selected_ratings' ) ? 'has-error' : '' }}">
                                            {{ Form::select( 'ratings', [ 
                                                '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5' 
                                                ], '', [ 'id' => 'ratings', 'class' => 'form-control' ] ) }}
                                                {{ Form::hidden( 'selected_ratings', old( 'selected_ratings' ), [ 'id' => 'selected_ratings' ] ) }}
                                                @if( $errors->has( 'selected_ratings' ) )
                                                    <span class="help-block">{{ $errors->first( 'selected_ratings' ) }}</span>
                                                @endif
                                        </div>

                                        <div class="media comment-form">
                                            
                                            <div class="media-body">
                                                <div class="form-group {{ $errors->has( 'review' ) ? 'has-error' : '' }}">
                                                    {{ Form::textarea( 'review', old( 'review' ), [ 'placeholder' => 'Write your review here...' ] ) }}
                                                    @if( $errors->has( 'review' ) )
                                                        <span class="help-block">{{ $errors->first( 'review' ) }}</span>
                                                    @endif
                                                </div>
                                                
                                                <button class="btn btn--sm btn--round" type="submit">Post Comment</button>
                                            </div>

                                        </div><!-- comment reply -->

                                    {{ Form::close() }}
                                </div><!-- end /.comment-form-area -->




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

    {{-- {{ Form::hidden( 'rating_url', route( 'vendors.ratings.store', Request::segment( 2 ) ), [ 'id' => 'rating_url' ] ) }} --}}

@endsection

@section( 'js' )
    <script src="{{ asset( 'js/vendor/jquery-bar-rating/jquery.barrating.min.js' ) }}"></script>
    <script src="{{ asset( 'js/page/vendors/reviews/index.js' ) }}"></script>
@endsection