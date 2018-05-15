@extends( 'components.frontend.master' )

@section( 'title', 'Reviews' )

@section( 'content' )

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li class="active"><a href="#">Reviews</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Reviews</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>



    

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
            @endif

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
                                    @if( $vendor->detail->profile_img )
                                        <img src="{{ asset( 'storage/profile_img/' . $vendor->detail->profile_img ) }}" alt="">
                                    @else
                                        <div class="alert alert-danger text-center">No imge found</div>
                                    @endif
                                </div>

                                <div class="author">
                                    <h4>{{ $vendor->detail->company_name }}</h4>
                                </div><!-- end /.author -->
                            </div><!-- end /.author-infos -->
                        </div><!-- end /.author-card -->

                        <div class="sidebar-card author-menu">
                            <ul>
                                <li><a href="{{ route( 'profile.show', [ $vendor->code ] )}}">Profile</a></li>
                                <li><a class="active" href="{{ route( 'vendors.reviews.index', $vendor->code ) }}">Customer Reviews</a></li>
                                <li><a href="{{ route( 'vendors.product.index', $vendor->code ) }}">Product</a></li>
                            </ul>
                        </div><!-- end /.author-menu -->
                        <div class="sidebar-card message-card">
                            <div class="card-title">
                                <h4>Contact Information</h4>
                            </div>
                            
                            <div class="message-form mycontact-info">
        
                               
                             <p><span class="lnr lnr-envelope "></span> {{ $vendor->email }}</p>
                             
                            <p><span class="lnr lnr-phone"></span> {{ $vendor->detail->phone_number }}</p>

                            <p><span class="lnr lnr-smartphone"></span> {{ $vendor->detail->mobile_number }}</p>

                            <p><span class="lnr lnr-map-marker"></span> {{ $vendor->detail->address }}</p>

                            </div><!-- end /.message-form -->
                        </div><!-- end /.freelance-status -->
                    </aside>
                </div><!-- end /.sidebar -->

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="author-info mcolorbg4">
                                <p>Total Products</p>
                                <h3>{{ number_format( $productCount )}}</h3>
                            </div>
                        </div><!-- end /.col-md-4 -->


                        <div class="col-md-6 col-sm-6">
                            <div class="author-info scolorbg">
                                <p>Total Rating</p>
                                <div class="rating product--rating">
                                    <ul>
                                        @for( $i = 0; $i < $avgRatings; $i ++ )
                                            <li><span class="fa fa-star"></span></li>
                                        @endfor
                                        @for( $i = 5; $i > $avgRatings; $i -- )
                                            <li><span class="fa fa-star-o"></span></li>
                                        @endfor
                                    </ul>
                                    <span class="rating__count">({{ $raters }})</span>
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
                                                    {{-- <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="{{ url( 'images/m1.png' ) }}" alt="Commentator Avatar">
                                                        </a>
                                                    </div> --}}
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

@endsection

@section( 'js' )
    <script src="{{ asset( 'js/vendor/jquery-bar-rating/jquery.barrating.min.js' ) }}"></script>
    <script src="{{ asset( 'js/page/vendors/reviews/index.js' ) }}"></script>
@endsection