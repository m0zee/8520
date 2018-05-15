@extends( 'components.frontend.master' )

@php  $active = 'shortlist';  @endphp

@section( 'title', 'Shortlist' )

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
                            <li><a href="{{ url( '/' ) }}">Home</a></li>
                            <li><a href="{{ route('buyer.dashboard') }}">Dashboard</a></li>
                            <li class="active"><a href="#">Short List</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Short List</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    @include( 'components.frontend.buyer_menu' )


    <section class="cart_area section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                	@if( session( 'success' ) )
                        <div class="alert alert-success text-center">
                            <strong>{{ session( 'success' ) }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="lnr lnr-cross" aria-hidden="true"></span>
                            </button>
                        </div>
                    @elseif( session( 'error' ) )
                        <div class="alert alert-danger text-center">
                            <strong>{{ session( 'error' ) }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="lnr lnr-cross" aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif

                    <div class="product_archive added_to__cart">
                        <div class="title_area">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Product Detail</h4>
                                </div>
                                <div class="col-md-5">
                                    <h4 class="add_info">Category</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Actions</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	@if( isset( $shortListedProducts ) && $shortListedProducts != NULL && count( $shortListedProducts ) )
                        		@foreach( $shortListedProducts as $product )
		                            <div class="single_product clearfix">
		                                <div class="col-md-5 col-sm-7 v_middle">
		                                    <div class="product__description">

		                                        <img src="{{ asset( 'storage/product/' . $product->img ) }}" alt="" width="150" height="120">
		                                        
		                                        <div class="short_desc">
		                                        	<a href="{{ route( 'products.show', [ $product->category->slug, $product->sub_category->slug, $product->code, $product->slug ] ) }}">
		                                        		
		                                            	<h4>{{ $product->name }}</h4>
		                                            </a>
		                                            <p>
		                                            	<a href="{{ url( 'profile/' . $product->user->code ) }}" class="tip" title="Click to see the profile">
		                                            		{{ $product->user->name }}
		                                            	</a>
		                                            </p>
		                                        </div>

		                                    </div><!-- end /.product__description -->
		                                </div><!-- end /.col-md-5 -->

		                                <div class="col-md-5 col-sm-2 v_middle">
		                                    <div class="product__additional_info">
		                                        <ul>
		                                            <li>
		                                                <a href="#">
		                                                	{{-- <img src="{{ asset( 'images/catword.png' ) }}" alt=""> --}}
		                                                	{{ $product->category->name }} 
		                                                </a>
		                                                <span class="lnr lnr-chevron-right"></span>
		                                                <a href="#">
		                                                	{{-- <img src="{{ asset( 'images/catword.png' ) }}" alt=""> --}}
	                                                		{{ $product->sub_category->name }} 
	                                                	</a>
		                                            </li>
		                                        </ul>
		                                    </div><!-- end /.product__additional_info -->
		                                </div><!-- end /.col-md-3 -->

		                                <div class="col-md-2 col-sm-3 v_middle">

	                                        <div class="item_price v_middle">
	                                            <a href="{{ route( 'products.show', [ $product->category->slug, $product->sub_category->slug, $product->code, $product->slug ] ) }}" 	class="btn btn-sm btn--round btn-info tip" title="Click to view the detail of this product">
	                                            	<span class="lnr lnr-eye"></span>
	                                            </a>
	                                        </div>
	                                        <div class="v_middle">
	                                        	{{ Form::open( [ 'route' => [ 'buyer.shortlist.destroy', $product->id ], 'method' => 'DELETE' ] ) }}
		                                            <button type="submit" 
		                                            	class="btn btn-sm btn--round btn-danger tip" title="Click to remove this product from shortlist">
		                                            	<span class="lnr lnr-trash"></span>
		                                            </button>
	                                            {{ Form::close() }}
	                                        </div>
		                                        
		                                </div><!-- end /.col-md-4 -->
		                            </div><!-- end /.single_product -->
	                            @endforeach
                            @else
                            	<div class="col-md-12">
                            		<div class="alert alert-danger text-center">
                            			<strong>No product found!</strong>
                            		</div>
                            	</div>
                                {{-- <tr>
                                    <td colspan="5">
                                        <div class="alert alert-danger text-center">
                                            <strong>No product found!</strong>
                                        </div>
                                    </td>
                                </tr> --}}
                            @endif

                            @if( $shortListedProducts->hasPages() )
                                <tr>
                                    <td colspan="5" class="text-center">{{ $shortListedProducts->links( 'vendor.pagination.pak-material' ) }}</td>
                                </tr>
                            @endif

                            {{-- <div class="single_product clearfix">
                                <div class="col-md-5 col-sm-7  v_middle">
                                    <div class="product__description">
                                        <img src="images/pur2.jpg" alt="Purchase image">
                                        <div class="short_desc">
                                            <a href="#"><h4>Visibility Manager Subscriptions</h4></a>
                                            <p>Nunc placerat mi id nisi inter
                                                dum mollis. Praesent phare...</p>
                                        </div>
                                    </div><!-- end /.product__description -->
                                </div><!-- end /.col-md-5 -->

                                <div class="col-md-3 col-sm-2 v_middle">
                                    <div class="product__additional_info">
                                        <ul>
                                            <li>
                                                <a href="#"><img src="images/catword.png" alt="">Wordpress</a>
                                            </li>
                                        </ul>
                                    </div><!-- end /.product__additional_info -->
                                </div><!-- end /.col-md-3 -->

                                <div class="col-md-4 col-sm-3 v_middle">
                                    <div class="product__price_download">
                                        <div class="item_price v_middle">
                                            <span>$59</span>
                                        </div>
                                        <div class="item_action v_middle">
                                            <a href="#" class="remove_from_cart"><span class="lnr lnr-trash"></span></a>
                                        </div><!-- end /.item_action -->
                                    </div><!-- end /.product__price_download -->
                                </div><!-- end /.col-md-4 -->
                            </div> --}}<!-- end /.single_product -->
                        </div><!-- end /.row -->

                        {{-- <div class="row">
                            <div class="col-sm-6 col-sm-offset-6">
                                <div class="cart_calculation">
                                    <div class="cart--subtotal">
                                        <p><span>Cart Subtotal</span>$120</p>
                                    </div>
                                    <div class="cart--total"><p><span>total</span>$120</p></div>

                                    <a href="checkout.html" class="btn btn--round btn--md checkout_link">Proceed To Checkout</a>
                                </div>
                            </div><!-- end .col-md-12 -->
                        </div> --}}
                    </div><!-- end /.product_archive2 -->
                </div><!-- end .col-md-12 -->
            </div><!-- end .row -->

        </div><!-- end .container -->
    </section>


    {{-- <section class="dashboard-area">
        

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
	                <div class="col-md-12">
	                    @if( session( 'success' ) )
	                        <div class="alert alert-success text-center">
	                            <strong>{{ session( 'success' ) }}</strong>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span class="lnr lnr-cross" aria-hidden="true"></span>
	                            </button>
	                        </div>
	                    @elseif( session( 'error' ) )
	                        <div class="alert alert-danger text-center">
	                            <strong>{{ session( 'error' ) }}</strong>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span class="lnr lnr-cross" aria-hidden="true"></span>
	                            </button>
	                        </div>
	                    @endif

	                    <div class="">
	                        <div class="modules__content">
	                            <div class="withdraw_module withdraw_history">
	                                <div class="withdraw_table_header">
	                                    <h3>
	                                        <span class="lnr lnr-users"></span> My Shortlisted Products
	                                    </h3>
	                                </div>
	                                <div class="table-responsive">
	                                    <table class="table withdraw__table">
	                                        <thead>
	                                            <tr>
	                                                <th class="col-md-1">Image</th>
	                                                <th>Name</th>
	                                                <th>Vendor</th>
	                                                <th class="col-md-2">Date</th>
	                                            </tr>
	                                        </thead>

	                                        <tbody>
	                                            @if( isset( $shortListedProducts ) && $shortListedProducts != NULL && count( $shortListedProducts ) )
	                                                @foreach( $shortListedProducts as $product )
	                                                    <tr>
	                                                        <td>
	                                                        	<img src="{{ asset( 'storage/product/' . $product->img ) }}" alt="">
	                                                        </td>
	                                                        <td>{{ $product->name }}</td>
	                                                        <td>
	                                                        	<a href="{{ url( 'profile/' . $product->user->code ) }}" title="Click to see the profile" class="tip">
	                                                        		{{ $product->user->name }}
	                                                        	</a>
	                                                        </td>
	                                                        <td>
	                                                            date
	                                                        </td>
	                                                    </tr>
	                                                @endforeach
	                                                @if( $shortListedProducts->hasPages() )
	                                                    <tr>
	                                                        <td colspan="5" class="text-center">{{ $shortListedProducts->links( 'vendor.pagination.pak-material' ) }}</td>
	                                                    </tr>
	                                                @endif
	                                            @else
	                                                <tr>
	                                                    <td colspan="5">
	                                                        <div class="alert alert-danger text-center">
	                                                            <strong>No product found!</strong>
	                                                        </div>
	                                                    </td>
	                                                </tr>
	                                            @endif
	                                        </tbody>
	                                    </table>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div><!-- end .col-md-6 -->
	            </div><!-- end .row -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section> --}}
    <!--================================
            END DASHBOARD AREA
    =================================-->
    </div>

@endsection
