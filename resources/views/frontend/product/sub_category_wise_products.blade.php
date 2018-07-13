@extends('components.frontend.master')

@section('title', 'Home')
@section('content')


    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('products') }}">Products</a></li>
                            <li><a href="{{ route('categories.products', [$sub_category->category->slug]) }}">{{$sub_category->category->name}}</a></li>
                            <li><a href="{{ route('categories.sub-categories.products', [$sub_category->category->slug, $sub_category->slug]) }}">{{$sub_category->name}}</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{ $sub_category->name }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>

    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="products section--padding2">
        <!-- start container -->
        <div class="container">

            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                

                <!-- start col-md-9 -->
                <div class="col-md-12">
                    <div class="row" id="product-container">
                        @if( $products->count() > 0 )
                            @foreach( $products as $product )
                                <div class="col-md-4 col-sm-4">
                                    <!-- start .single-product -->
                                    <div class="product product--card product--card-small">

                                        <div class="product__thumbnail">
                                            @if( file_exists( $product->img_path . '/' . $product->img ) )
                                                <img class="auth-img" src="{{ asset( 'storage/product/361x230_' . $product->img ) }}" alt="author image">
                                            @else
                                                <img src="images/p1.jpg" alt="Product Image">
                                            @endif
                                            
                                            <div class="prod_btn">
                                                <a href="{{ route('products.show', [$product->category->slug, $product->sub_category->slug, $product->code, $product->slug ]) }}" class="transparent btn--sm btn--round">More Info</a>
                                                <a href="{{ route( 'profile.show', [ $product->user->code ] ) }}" class="transparent btn--sm btn--round">Profile</a>
                                            </div><!-- end /.prod_btn -->
                                        </div><!-- end /.product__thumbnail -->

                                        <div class="product-desc">
                                            <a href="{{ route('products.show', [$product->category->slug, $product->sub_category->slug, $product->code, $product->slug ]) }}" class="product_title"><h4>{{ (strlen($product->name) > 23) ? substr($product->name,0,23).'...' :$product->name  }}</h4></a>

                                            
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
                                                                $company_name = ( strlen( $product->user->detail->company_name ) > 22 ) ? substr( $product->user->detail->company_name, 0, 21 ) . '...' : $product->user->detail->company_name;
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
                                                    <a href="{{ route('categories.products', [$product->category->slug]) }}">
                                                        {{ $product->category->name }}
                                                    </a>

                                                    <span class="fa fa-chevron-right"></span>


                                                    <span class="fa fa-folder iconcolor"></span>
                                                    <a href="{{ route('categories.sub-categories.products', [$product->category->slug, $product->sub_category->slug]) }}">
                                                        {{ $product->sub_category->name }}
                                                    </a>
                                                    {{-- <span class="lnr lnr-chevron-right"></span><a href="{{ route('categories.sub-categories.products', [$product->category->slug, $product->sub_category->slug]) }}">{{ $product->sub_category->name }}</a> --}}
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
                    
                </div><!-- end /.col-md-9 -->
            </div><!-- end /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area categorised_item_pagination">
                        @if( isset( $products  ) && $products->hasPages() )
                            {{ $products->links( 'vendor.pagination.pak-material' ) }}
                        @endif
                    </div>
                </div>
            </div>
            <!-- end /.row -->
                        @else
            <div class="alert alert-danger text-center">
                No Product Found!
            </div>
                        @endif
        </div><!-- end /.container -->

    </section>
    <!--================================
        END PRODUCTS AREA
    =================================-->


    <!--================================
        START CALL TO ACTION AREA
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
    <script src="{{ asset( 'js/page/home/index.js' ) }}"></script>
@endsection