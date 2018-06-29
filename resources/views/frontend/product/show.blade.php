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
                    <h1 class="page-title">{{ ( $product != null ) ? $product->name : 'Product Not Available' }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    <!--================================
        END BREADCRUMB AREA
    =================================-->
    
    @if( $product != null )

        <section class="single-product-desc">
            {{-- @if ($product->status_id != 2)
                <div class="alert alert-info text-center">
                    <strong>This Product status is {{ $product->status->name }} </strong>
                </div>
            @endif --}}
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


                       {{--  <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div> --}}

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
                        <br>

                        <div class="text-center" id="share">
                            {{-- <div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" ></div> --}}
                            <a href="javascript:void()" onclick="facebookShare()" id="facebookShare" data-url="{{ url()->current() }}" class="btn btn-primary btn-lg"><i class="fa fa-facebook"></i> Share via Facebook</a>
                           
                           
                            <a href="whatsapp://send?text={{ url()->current() }}" data-action="share/whatsapp/share" class="btn btn-success btn-lg"><i class="fa fa-whatsapp"></i> Share via Whatsapp</a>
                        </div>
                    </div><!-- end /.col-md-8 -->



                    <div class="col-md-4">
                        <aside class="sidebar sidebar--single-product">
                            <div class="sidebar-card card-pricing">
                                <div class="price"><h1><sup>{{ $product->currency->name }}</sup> {{ number_format( $product->price ) }} / {{ $product->unit->name }}</h1></div>




                                <div class="product-purchase text-center" id="product-container">
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
                                    <hr>
                                    <button class="btn--icon my-btn btn--round tip " id="btn_report">Report this product</button>
                                </div>




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
                                    <a href="{{ url( 'profile/' . $product->user->code ) }}">
                                        <div class="author_avatar">
                                            <img src="{{ asset( 'storage/profile_img/' . $product->user->detail->profile_img ) }}" alt="Presenting the broken author avatar :D">
                                        </div>
                                    </a>

                                    <div class="author">
                                        <a href="{{ url( 'profile/' . $product->user->code ) }}"><h4>{{ $product->user->detail->company_name }}</h4></a>
                                        <p>
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
                                        </p>

                                        <div class="message-form mycontact-info">
                                            <p><span class="lnr lnr-envelope "></span> {{ $product->user->email }}</p>
                                                                         
                                            <p><span class="lnr lnr-phone"></span> {{ $product->user->detail->phone_number }}</p>
                                            
                                            <p><span class="lnr lnr-smartphone"></span> {{ $product->user->detail->mobile_number }}</p>
                                            
                                            <p><span class="lnr lnr-map-marker"></span> {{ $product->user->detail->address }}</p>
                                        </div>
                                    </div><!-- end /.author -->


                                    <div class="author-btn">
                                        <a href="{{ route( 'vendors.product.index', $product->user->code ) }}" class="btn btn--sm btn--round">More Product</a>
                                        {{-- <button class="btn btn--sm btn--round" id="btn_report">Report</button> --}}
                                    </div><!-- end /.author-btn -->
                                </div><!-- end /.author-infos -->


                            </div><!-- end /.author-card -->
                        </aside><!-- end /.aside -->
                    </div><!-- end /.col-md-4 -->
                </div><!-- end /.row -->
            </div><!-- end /.container -->
        </section>

        <section class="more_product_area section--padding">
            <div class="container">
                <div class="row">
                    <!-- start col-md-12 -->
                    <div class="col-md-12">
                        <div class="section-title">
                            {{-- {{ $product->user->detail->company_name }} --}}
                            <h1>Related <span class="highlighted">Products</span></h1>
                        </div>
                    </div><!-- end /.col-md-12 -->

                    @if( isset( $relativeProducts ) && $relativeProducts->count() > 0 )
                        @foreach( $relativeProducts as $relative )

                            <div class="col-md-4 col-sm-4">
                                <div class="product product--card product--card-small">

                                    <div class="product__thumbnail">
                                        @if( file_exists( $relative->img_path . '/' . $relative->img ) )
                                            <img class="auth-img" src="{{ asset( 'storage/product/361x230_' . $relative->img ) }}" alt="author image">
                                        @else
                                            <img src="images/p1.jpg" alt="Product Image">
                                        @endif
                                        
                                        <div class="prod_btn">
                                            <a href="{{ route( 'products.show', [ $relative->category->slug, $relative->sub_category->slug, $relative->code, $relative->slug ] ) }}" class="transparent btn--sm btn--round">More Info</a>
                                            <a href="{{ route( 'profile.show', [ $relative->user->code ] ) }}" class="transparent btn--sm btn--round">Profile</a>
                                        </div><!-- end /.prod_btn -->
                                    </div><!-- end /.product__thumbnail -->

                                    <div class="product-desc">
                                        <a href="{{ route( 'products.show', [ $relative->category->slug, $relative->sub_category->slug, $relative->code, $relative->slug ] ) }}" class="product_title">
                                            <h4>{{ ( strlen( $relative->name ) > 23 ) ? substr( $relative->name, 0, 23 ) . ' ...' : $relative->name  }}</h4>
                                        </a>

                                        
                                        <ul class="titlebtm">
                                            @if( $relative->user->detail != null  )
                                                <li>
                                                    @if( $relative->user->detail->profile_img && file_exists( $relative->user->detail->profile_path . '/' . $relative->user->detail->profile_img ) )
                                                        <img class="auth-img" src="{{ asset( 'storage/profile_img/30x30_' . $relative->user->detail->profile_img ) }}" alt="author image">
                                                    @else
                                                        <img class="auth-img" src="{{ asset( 'images/auth.jpg' ) }}" alt="author image">
                                                    @endif
                                                    <p><a href="{{ route('profile.show', [$relative->user->code]) }}">{{ $relative->user->detail->company_name }}</a></p>
                                                </li>
                                                <br>
                                            @endif
                                            <li>
                                                <span class="fa fa-folder iconcolor"></span>
                                                <a href="{{ route('categories.products', [$relative->category->slug]) }}">
                                                    {{ $relative->category->name }}
                                                </a>
                                            </li>

                                            <li>
                                               <span class="fa fa-money iconcolor"></span>
                                               <strong>{{ $relative->price }} {{ $relative->currency->name }} - {{ $relative->unit->name }}</strong>
                                            </li>
                                        </ul>
                                    </div><!-- end /.product-desc -->

                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center">
                                No more items found
                            </div>
                        </div>
                    @endif

                    </div><!-- end /.container -->
                </div><!-- end /.container -->
        </section>

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
                        {{ Form::open( [ 'url' => '#', 'id' => 'reportForm' ] ) }}
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
    <script src="{{ asset( 'js/vendor/jquery.elevatezoom.min.js' ) }}"></script>
    <script src="{{ asset( 'js/vendor/jquery-validation/jquery.validate.min.js' ) }}"></script>
    <script src="{{ asset( 'js/vendor/jquery-validation/additional-methods.min.js' ) }}"></script>
    <script src="{{ asset( 'js/page/home/show.js' ) }}"></script>
    <script src="{{ asset( 'js/page/home/index.js' ) }}"></script>
    <script>
        function facebookShare(){
            // $('#share .fb-share-button').click();
            FB.ui({
                method: 'share',
                href: $('#facebookShare').data('url'),
            }, function(response){});
        }
    </script>
@endsection