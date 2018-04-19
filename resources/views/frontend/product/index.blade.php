@extends( 'components.frontend.master' )

@section( 'title', 'Home' )
@section( 'content' )



    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="products section--padding2">
        <!-- start container -->
        <div class="container">

            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-md-3">
                    <!-- start aside -->
                    <aside class="sidebar product--sidebar">
                        <div class="sidebar-card card--category">
                            <a class="card-title" href="#collapse1" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="collapse1">
                                <h4 >Categories <span class="lnr lnr-chevron-down"></span></h4>
                            </a>
                            <div class="collapse in collapsible-content" id="collapse1">
                                <ul class="card-content">
                                    @if( isset($categories) && $categories->count() > 0 )
                                        @foreach( $categories as $category )
                                            <li>
                                                <a href="{{ 'categories/' . $category->slug . '/products' }}">
                                                    <span class="lnr lnr-chevron-right"></span>{{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="alert alert-danger text-center">No category found!</div>
                                        </li>
                                    @endif
                                </ul>
                            </div><!-- end /.collapsible_content -->
                        </div><!-- end /.sidebar-card -->

                        <div class="sidebar-card card--filter">
                            <a class="card-title" href="#collapse2" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="collapse2">
                                <h4>Filter Products<span class="lnr lnr-chevron-down"></span></h4>
                            </a>
                            <div class="collapse in collapsible-content" id="collapse2">
                                <ul class="card-content">
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt1" class="" name="filter_opt"> 
                                            <label for="opt1">
                                                <span class="circle"></span> Trending Products
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt2" class="" name="filter_opt"> 
                                            <label for="opt2">
                                                <span class="circle"></span> Popular Products
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt3" class="" name="filter_opt"> 
                                            <label for="opt3">
                                                <span class="circle"></span> New Products
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt4" class="" name="filter_opt"> 
                                            <label for="opt4">
                                                <span class="circle"></span> Best Seller
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt5" class="" name="filter_opt"> 
                                            <label for="opt5">
                                                <span class="circle"></span> Best Rating
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt6" class="" name="filter_opt"> 
                                            <label for="opt6">
                                                <span class="circle"></span> Free Support
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-checkbox2"><input type="checkbox" id="opt7" class="" name="filter_opt"> 
                                            <label for="opt7">
                                                <span class="circle"></span> On Sale
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- end /.sidebar-card -->
                    </aside><!-- end aside -->

                </div><!-- end /.col-md-3 -->

                <!-- start col-md-9 -->
                <div class="col-md-9">
                    @if( isset( $products ) && $products->count() > 0 )
                        <div class="row" id="product-container">
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
                                                <a href="{{ route( 'profile.show', [ $product->user->code ] ) }}" class="transparent btn--sm btn--round btn-contact">Contact</a>
                                            </div><!-- end /.prod_btn -->
                                        </div><!-- end /.product__thumbnail -->

                                        <div class="product-desc">
                                            <a href="#" class="product_title"><h4>{{ $product->name }}</h4></a>
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
                                                    <a href="{{ route('categories.products', [$product->sub_category->category->slug]) }}">
                                                        {{ $product->sub_category->category->name }}
                                                    </a>
                                                    
                                                    <span class="lnr lnr-chevron-right"></span>
                                                    
                                                    <a href="{{ route('categories.sub-categories.products', [$product->sub_category->category->slug, $product->sub_category->slug]) }}">    {{ $product->sub_category->name }}
                                                    </a>
                                                </li>

                                                <li>
                                                    <strong>Price : </strong>{{ $product->currency->name }} {{ $product->price }}</a>
                                                </li>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area categorised_item_pagination">
                        @if( isset( $products ) && $products->hasPages() )
                            {{ $products->links( 'vendor.pagination.pak-material' ) }}
                        @endif
                    </div>
                </div>
            </div><!-- end /.row -->
        
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
    <!--================================
        END CALL TO ACTION AREA
    =================================-->

    <!-- Modal -->
    @if( Auth::check() )
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title">Rating this Item</h3>
                        
                        {{-- <h4>Product Enquiry Extension</h4><p>by <a href="author.html">AazzTech</a></p> --}}
                    </div><!-- end /.modal-header -->

                    <div class="modal-body">
                        <form action="#">
                            <ul>
                                <li>
                                    <p>Your Rating</p>
                                    <div class="right_content btn btn--round btn--white btn--md">
                                        <select name="rating" class="give_rating">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </li>

                                <li>
                                    <p>Rating Causes</p>
                                    <div class="right_content">
                                        <div class="select-wrap">
                                            <select name="review_reason" id="rev">
                                                <option value="design">Design Quality</option>
                                                <option value="customization">Customization</option>
                                                <option value="support">Support</option>
                                                <option value="performance">Performance</option>
                                                <option value="documentation">Well Documented</option>
                                            </select>

                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="rating_field">
                                <label for="rating_field">Comments</label>
                                <textarea name="rating_field" id="rating_field" class="text_field" placeholder="Please enter your rating reason to help the author"></textarea>
                                <p class="notice">Your review will be ​publicly visible​ and the author may reply to your comments. </p>
                            </div>
                            <button type="submit" class="btn btn--round btn--default">Submit Rating</button>
                            <button class="btn btn--round modal_close" data-dismiss="modal">Close</button>
                        </form><!-- end /.form -->
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
                                                    <div class="form-group">
                                                        {{ Form::label( 'password', 'Password' ) }}
                                                        {{
                                                            Form::password( 'password', [ 
                                                                'placeholder'   => 'Please enter password', 
                                                                'id'            => 'password',
                                                                'class'         => 'text_field',
                                                                'disabled'      => true
                                                            ])
                                                        }}
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row registerFields hidden">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label( 'name', 'Name' ) }}
                                                        {{
                                                            Form::text( 'name', '', [ 
                                                                'placeholder'   => 'Please enter name', 
                                                                'id'            => 'name',
                                                                'class'         => 'text_field',
                                                                'disabled'      => true
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
                                                            <input type="radio" id="buyer" value="1" checked name="user_type_id"> Buyer
                                                        </label>
                                                        
                                                        <label class="radio-inline">
                                                            <input type="radio" id="vendor" value="2" name="user_type_id"> Vendor
                                                        </label>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row registerFields hidden">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label( 'password', 'Password' ) }}
                                                        {{
                                                            Form::password( 'password', [ 
                                                                'placeholder'   => 'Please enter password', 
                                                                'id'            => 'password',
                                                                'class'         => 'text_field',
                                                                'disabled'      => true
                                                            ])
                                                        }}
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label( 'conpassword', 'Confirm Password' ) }}
                                                        {{
                                                            Form::password( 'conpassword', [ 
                                                                'placeholder'   => 'Please enter password again', 
                                                                'id'            => 'conpassword',
                                                                'class'         => 'text_field',
                                                                'disabled'      => true
                                                            ])
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label( 'quantity', 'Quantity' ) }}
                                                        {{
                                                            Form::text( 'quantity', '', [ 
                                                                'placeholder'   => 'Please enter quantity', 
                                                                'id'            => 'quantity',
                                                                'class'         => 'text_field'
                                                            ])
                                                        }}
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label( 'unit', 'Unit' ) }}
                                                        <div class="text_field" id="unit" style="padding: 0 20px;">asdfasd</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
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
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <input type="hidden" id="isUserLoggedin" value="0">
                            <input type="hidden" id="isUserExists" value="0">

                            <div class="col-md-12">
                                <div class="dashboard_setting_btn">
                                    <button type="submit" class="btn btn--round btn--md">Save Change</button>
                                </div>
                            </div><!-- end /.col-md-12 -->
                        </div>

                    </div><!-- end /.modal-body -->
                </div>
            </div>
        </div>
    @endif

@endsection

@section( 'js' )
<script src="{{ url( 'js/page/frontend/product/index.js' ) }}"></script>
@stop