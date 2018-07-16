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
                            <li class="active"><a href="#">Product</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Product List</h1>
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
                                <li><a  href="{{ route( 'vendors.reviews.index', $vendor->code ) }}">Customer Reviews</a></li>
                                <li><a class="active" href="{{ route( 'vendors.product.index', $vendor->code ) }}">Product</a></li>
                            </ul>
                        </div><!-- end /.author-menu -->
                        <div class="sidebar-card message-card">
                            <div class="card-title">
                                <h4>Contact Information</h4>
                            </div>
                            
                            <div class="message-form mycontact-info">
        
                            
                            @if ($vendor->email)
                                <p><span class="lnr lnr-envelope "></span> {{ $vendor->email }}</p>
                            @endif
                            
                            @if ($vendor->detail->phone_number)
                                <p><span class="lnr lnr-phone"></span> {{ $vendor->detail->phone_number }}</p>
                            @endif
                            
                            @if ($vendor->detail->mobile_number)
                                <p><span class="lnr lnr-smartphone"></span> {{ $vendor->detail->mobile_number }}</p>
                            @endif
                            
                            @if ($vendor->detail->address)
                                <p><span class="lnr lnr-map-marker"></span> {{ $vendor->detail->address }}</p>
                            @endif
                            

                            </div><!-- end /.message-form -->
                        </div><!-- end /.freelance-status -->
                    </aside>
                </div><!-- end /.sidebar -->

                <div class="col-md-8">
                    <div class="row">
                        <a href="{{ route( 'vendors.product.index', $vendor->code ) }}">
                            <div class="col-md-6 col-sm-6">
                                <div class="author-info mcolorbg4">
                                    <p>Total Products</p>
                                    <h3>{{ number_format( $productCount )}}</h3>
                                </div>
                            </div><!-- end /.col-md-4 -->
                        </a>


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
                                    <h2><span class="bold">{{ $productCount }}</span> Products</h2>
                                </div>
                            </div><!-- end /.product-title-area -->
                            
                            @if( isset( $products ) && $products->count() > 0 )
                        <div class="row" id="product-container">
                            @foreach( $products as $product )
                                <div class="col-md-6 col-sm-6">
                                    <!-- start .single-product -->
                                    <div class="product product--card product--card-small">

                                        <div class="product__thumbnail">
                                            @if( file_exists( $product->img_path . '/' . $product->img ) )
                                                <img class="auth-img" src="{{ asset( 'storage/product/361x230_' . $product->img ) }}" alt="author image">
                                            @else
                                                <img src="images/p1.jpg" alt="Product Image">
                                            @endif
                                            
                                            <div class="prod_btn">
                                                <a href="{{ route('products.show', [$product->sub_category->category->slug, $product->sub_category->slug, $product->code, $product->slug ]) }}" class="transparent btn--sm btn--round">More Info</a>
                                                <a href="{{ route( 'profile.show', [ $product->user->code ] ) }}" class="transparent btn--sm btn--round">Profile</a>
                                            </div><!-- end /.prod_btn -->
                                        </div><!-- end /.product__thumbnail -->

                                        <div class="product-desc">
                                            <a href="{{ route('products.show', [$product->sub_category->category->slug, $product->sub_category->slug, $product->code, $product->slug ]) }}" class="product_title">
                                                <h4>{{ ( strlen( $product->name ) > 34 ) ? substr( $product->name, 0, 33 ) . '...' : $product->name }}</h4>
                                            </a>

                                            
                                            <ul class="titlebtm">
                                                @if( $product->user->detail != null  )
                                                    <li>
                                                        @if( $product->user->detail->profile_img && file_exists( $product->user->detail->profile_path . '/' . $product->user->detail->profile_img ) )
                                                            <img class="auth-img" src="{{ asset( 'storage/profile_img/30x30_' . $product->user->detail->profile_img ) }}" alt="author image">
                                                        @else
                                                            <img class="auth-img" src="{{ asset( 'images/auth.jpg' ) }}" alt="author image">
                                                        @endif
                                                        <p>
                                                            @php
                                                                $company_name = ( strlen( $product->user->detail->company_name ) > 33 ) ? substr( $product->user->detail->company_name, 0, 32 ) . '...' : $product->user->detail->company_name;
                                                            @endphp
                                                            <a href="{{ route( 'profile.show', [ $product->user->code ] ) }}">
                                                                {{ $company_name }}
                                                            </a>
                                                        </p>
                                                    </li>
                                                    <br>
                                                @endif
                                                <li>
                                                    <span class="fa fa-folder iconcolor"></span>
                                                    <a href="{{ route('categories.products', [$product->sub_category->category->slug]) }}">
                                                        {{ $product->sub_category->category->name }}
                                                    </a>
                                                    {{-- <span class="lnr lnr-chevron-right"></span><a href="{{ route('categories.sub-categories.products', [$product->sub_category->category->slug, $product->sub_category->slug]) }}">{{ $product->sub_category->name }}</a> --}}
                                                </li>

                                                <li>
                                                   <span class="fa fa-money iconcolor"></span>
                                                   <strong>{{ $product->price }} {{ $product->currency->name }} - {{ $product->unit->name }}</strong>
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

                                            <button class="btn--icon my-btn btn--round btn-contact" data-product-id="{{ $product->id }}">
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
                        <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area categorised_item_pagination">
                        @if( isset( $products ) && $products->hasPages() )
                            {{ $products->links( 'vendor.pagination.pak-material' ) }}
                        @endif
                    </div>
                </div>
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
                        </div><!-- end /.col-md-12 -->
                    </div><!-- end /.row -->
                </div><!-- end /.col-md-8 -->

            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>


    @if( Auth::check() )
        <div class="modal fade not_loggedind_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="not_loggedind_modal">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                        <h4>Send Enquiry</h4>
                    </div><!-- end /.modal-header -->

                    <div class="modal-body">

                        <div class="row">
                            {{ Form::open( [ 'url' => '#', 'id' => 'myForm' ] ) }}
                            <div class="col-md-12">
                                <div class="information_module">
                                    <div class="information__set toggle_module collapse in" id="collapse2">
                                        <div class="information_wrapper form--fields">
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'quantity', 'Quantity' ) }}
                                                        {{
                                                            Form::text( 'quantity', '', [ 
                                                                'placeholder'   => 'Please enter quantity', 
                                                                'id'            => 'quantity',
                                                                'class'         => 'text_field number'
                                                            ])
                                                        }}
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'unit', 'Unit' ) }}
                                                        <div class="text_field" id="unit" style="padding: 0 20px;">asdfasd</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group has-error">
                                                {{ Form::label( 'message', 'Enquiry' ) }}
                                                {{
                                                    Form::textarea( 'message', '', [ 
                                                        'placeholder'   => 'Please enter enquiry', 
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
                                </div>

                            </div>

                            <input type="hidden" id="isUserLoggedin" value="1">

                            <div class="col-md-12">
                                <div class="dashboard_setting_btn">
                                    <button type="submit" id="btn-send" class="btn btn--round btn--md">Send</button>
                                </div>
                            </div><!-- end /.col-md-12 -->
                            {{ Form::close() }}
                        </div>

                    </div><!-- end /.modal-body -->
                </div>
            </div>
        </div>
    @else
        <div class="modal fade not_loggedind_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="not_loggedind_modal">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                        <h4>Send Enquiry</h4>
                    </div><!-- end /.modal-header -->

                    <div class="modal-body">

                        <div class="row">
                            {{ Form::open( [ 'url' => '#', 'id' => 'myForm' ] ) }}
                            <div class="col-md-12">
                                <div class="information_module">
                                    <div class="information__set toggle_module collapse in" id="collapse2">
                                        <div class="information_wrapper form--fields">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'email', 'Email Address' ) }}
                                                        {{
                                                            Form::text( 'email', null, [ 
                                                                'placeholder'   => 'Please enter your email address', 
                                                                'id'            => 'email',
                                                                'class'         => 'text_field'
                                                            ])
                                                        }}
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row loginFields hidden">
                                                <div class="col-md-12">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'password', 'Password' ) }}
                                                        {{
                                                            Form::password( 'loginPassword', [ 
                                                                'placeholder'   => 'Please enter password', 
                                                                'id'            => 'loginPassword',
                                                                'class'         => 'text_field'
                                                            ])
                                                        }}
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row registerFields hidden">
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'name', 'Name' ) }}
                                                        {{
                                                            Form::text( 'name', '', [ 
                                                                'placeholder'   => 'Please enter name', 
                                                                'id'            => 'name',
                                                                'class'         => 'text_field'
                                                            ])
                                                        }}
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="#">&nbsp;</label>
                                                        <br>
                                                        <label class="radio-inline" >
                                                            <input type="radio" id="buyer" value="1" checked name="userTypeId"> Buyer
                                                        </label>
                                                        
                                                        <label class="radio-inline">
                                                            <input type="radio" id="vendor" value="2" name="userTypeId"> Vendor
                                                        </label>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row registerFields hidden">
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'password', 'Password' ) }}
                                                        {{
                                                            Form::password( 'registerPassword', [ 
                                                                'placeholder'   => 'Please enter password', 
                                                                'id'            => 'registerPassword',
                                                                'class'         => 'text_field'
                                                            ])
                                                        }}
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'conpassword', 'Confirm Password' ) }}
                                                        {{
                                                            Form::password( 'conpassword', [ 
                                                                'placeholder'   => 'Please enter password again', 
                                                                'id'            => 'conpassword',
                                                                'class'         => 'text_field'
                                                            ])
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'quantity', 'Quantity' ) }}
                                                        {{
                                                            Form::text( 'quantity', '', [ 
                                                                'placeholder'   => 'Please enter quantity', 
                                                                'id'            => 'quantity',
                                                                'class'         => 'text_field number'
                                                            ])
                                                        }}
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group has-error">
                                                        {{ Form::label( 'unit', 'Unit' ) }}
                                                        <div class="text_field" id="unit" style="padding: 0 20px;">asdfasd</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group has-error">
                                                {{ Form::label( 'message', 'Enquiry' ) }}
                                                {{
                                                    Form::textarea( 'message', '', [ 
                                                        'placeholder'   => 'Please enter enquiry', 
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
                                </div>

                            </div>

                            <input type="hidden" id="isUserExists" value="0">
                            <input type="hidden" id="isUserLoggedin" value="0">

                            <div class="col-md-12">
                                <div class="dashboard_setting_btn">
                                    <button type="submit" id="btn-send" class="btn btn--round btn--md">Send</button>
                                </div>
                            </div><!-- end /.col-md-12 -->
                            {{ Form::close() }}
                        </div>

                    </div><!-- end /.modal-body -->
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade loading_modal" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loading_modal">
        <div class="modal-dialog modal-md text-center" role="document" style="vertical-align: middle; height: 100%; vertical-align: middle; position: absolute; top: 30%; right: 30%;">
            <span class="fa fa-spinner fa-spin" style="font-size: 300px;"></span>
            <br><br>
            <h3>LOADING...Please wait!</h3>
        </div>
    </div>

@endsection

@section( 'js' )
    <script src="{{ asset( 'js/vendor/jquery-bar-rating/jquery.barrating.min.js' ) }}"></script>
    <script src="{{ asset( 'js/vendor/jquery-validation/jquery.validate.min.js' ) }}"></script>
    <script src="{{ asset( 'js/vendor/jquery-validation/additional-methods.min.js' ) }}"></script>
    <script src="{{ asset( 'js/page/home/index.js' ) }}"></script>
    <script src="{{ asset( 'js/page/vendors/reviews/index.js' ) }}"></script>
@endsection