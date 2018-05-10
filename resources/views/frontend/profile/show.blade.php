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
    @if( Auth::check() )
        @include( 'components.frontend.vendor_menu' )
    @endif

    <section class="author-profile-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <aside class="sidebar sidebar_author">
                        <div class="author-card sidebar-card">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    @if( $user->detail->profile_img )
                                        <img src="{{ asset( 'storage/profile_img/' . $user->detail->profile_img ) }}" alt="">
                                    @else
                                        <div class="alert alert-danger text-center">No imge found</div>
                                    @endif
                                </div>

                                <div class="author">
                                    <h4>{{ $user->detail->company_name }}</h4>
                                    
                                </div><!-- end /.author -->

                                {{-- <span class="{{ ( $user->verified == 1 ) ? 'fa fa-check-circle fa-lg' : 'fa fa-exclamation-triangle fa-lg'}}" style="{{ ( $user->verified == 1 ) ? 'color:lightgreen;' : 'color: orange;' }}">
                                </span> {{ $user->email }}
 --}}

                               {{--  <div class="author-btn">
                                    <a href="#" class="btn btn--md btn--round">Contact</a>
                                </div> --}}<!-- end /.author-btn -->
                            </div><!-- end /.author-infos -->


                        </div><!-- end /.author-card -->

                        <div class="sidebar-card author-menu">
                            <ul>
                                <li><a href="{{ route( 'profile.show', [ $user->code ] )}}" class="active">Profile</a></li>
                                
                                <li><a href="{{ route( 'vendors.reviews.index', [ 'vendor_code' => $user->code ] ) }}">Customer Reviews</a></li>
                                
                            </ul>
                        </div><!-- end /.author-menu -->

                        <div class="sidebar-card message-card">
                            <div class="card-title">
                                <h4>Contact Information</h4>
                            </div>
                            
                            <div class="message-form mycontact-info">
        
                               
                             <p><span class="lnr lnr-envelope "></span> {{$user->email}} </p>
                             
                            <p><span class="lnr lnr-phone"></span> {{$user->detail->phone_number}}</p>

                            <p><span class="lnr lnr-smartphone"></span> {{$user->detail->mobile_number}}</p>

                            <p><span class="lnr lnr-map-marker"></span> {{$user->detail->address}}</p>

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

                        {{-- <div class="col-md-6 col-sm-6">
                            <div class="author-info pcolorbg">
                                <p>Total sales</p>
                                <h3>36,957</h3>
                            </div>
                        </div> --}}<!-- end /.col-md-4 -->

                        <div class="col-md-6 col-sm-6">
                            <div class="author-info scolorbg">
                                <p>Total Rating</p>
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
                                @if( $user->detail->cover_img )
                                    <img src="{{ asset( 'storage/cover_img/' . $user->detail->cover_img ) }}" alt="author image">
                                @else
                                    <div class="alert alert-danger text-center">No image found!</div>
                                @endif
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
                                    <h2>{{ $user->detail->company_name }} Products</h2>
                                </div>

                                {{-- <a href="#" class="btn btn--sm">See all Items</a> --}}
                            </div><!-- end /.product-title-area -->
                        </div><!-- end /.col-md-12 -->
                    <!-- start col-md-9 -->
                   
                        <div class="col-md-12">
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
                                                        <a href="{{ route( 'profile.show', [ $product->user->code ] ) }}" class="transparent btn--sm btn--round btn-contact">Contact</a>
                                                    </div><!-- end /.prod_btn -->
                                                </div><!-- end /.product__thumbnail -->

                                                <div class="product-desc">
                                                    <a href="{{ route('products.show', [$product->sub_category->category->slug, $product->sub_category->slug, $product->code, $product->slug ]) }}" class="product_title"><h4>{{ (strlen($product->name) > 23) ? substr($product->name,0,23).'...' :$product->name  }}</h4></a>

                                                    
                                                    <ul class="titlebtm">
                                                        <li>
                                                            @if( $product->user->detail->profile_img && file_exists( $product->user->detail->profile_path . '/' . $product->user->detail->profile_img ) )
                                                                <img class="auth-img" src="{{ asset( 'storage/profile_img/30x30_' . $product->user->detail->profile_img ) }}" alt="author image">
                                                            @else
                                                                <img class="auth-img" src="{{ asset( 'images/auth.jpg' ) }}" alt="author image">
                                                            @endif
                                                            <p><a href="{{ route('profile.show', [$product->user->code]) }}">{{ $product->user->detail->company_name }}</a></p>
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <span class="fa fa-folder iconcolor"></span>
                                                            <a href="{{ route('categories.products', [$product->sub_category->category->slug]) }}">
                                                                {{ $product->sub_category->category->name }}
                                                            </a>
                                                            {{-- <span class="lnr lnr-chevron-right"></span><a href="{{ route('categories.sub-categories.products', [$product->sub_category->category->slug, $product->sub_category->slug]) }}">{{ $product->sub_category->name }}</a> --}}
                                                        </li>

                                                        <li>
                                                           <span class="fa fa-money iconcolor"></span><strong> {{ $product->price }} {{ $product->currency->name }} - {{ $product->unit->name }}</strong>
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
                             @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger text-center">
                                            No Product Found!
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div><!-- end /.col-md-9 -->
               
                      
                    </div><!-- end /.row -->
                </div><!-- end /.col-md-8 -->

            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END AUTHOR AREA
    =================================-->
    <!-- Modal -->
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
<script src="{{ asset( 'js/vendor/jquery-validation/jquery.validate.min.js' ) }}"></script>
<script src="{{ asset( 'js/vendor/jquery-validation/additional-methods.min.js' ) }}"></script>
<script src="{{ asset( 'js/page/frontend/product/index.js' ) }}"></script>
@stop