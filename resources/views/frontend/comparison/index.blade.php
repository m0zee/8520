@extends( 'components.frontend.master' )

@section( 'title', 'Home' )
@section( 'content' )



    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Product Comparison</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table table-bordered">
                                        {{-- <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Vendor</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead> --}}

                                        <tbody>
                                        	@if( isset( $list ) && is_array( $list ) && count( $list ) > 0 )
                                        		<tr>
                                        			<th>Image</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">
			                                            	<img src="{{ asset( 'storage/product/' . $item->img ) }}" alt="" width="200">
			                                            </td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Product</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">{{ $item->name }}</td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Vendor</th>
                                        			@foreach( $list as $item )
			                                            <td class="bold text-center">
			                                            	<a href="{{ url( 'profile/' . $item->user->code ) }}" class="tip" title="Click to see the profile">
			                                            		{{ $item->user->name }}
			                                            	</a>
			                                            </td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Brand</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">{{ $item->brand_name }}</td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Country</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">{{ $item->country->name }}</td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Max Supply</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">{{ $item->max_supply . ' ' . $item->unit->name }}</td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Price</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">{{ $item->currency->name . ' ' . number_format( $item->price ) }}</td>
		                                        	@endforeach
                                        		</tr>
                                        		<tr>
                                        			<th>Remove</th>
                                        			@foreach( $list as $item )
			                                            <td class="text-center">
			                                            	{{ Form::open( [ 'route' => [ 'comparison.destroy', $item->id ], 'method' => 'DELETE' ] ) }}
					                                            <button type="submit" 
					                                            	class="btn btn-sm btn--round btn-danger tip" title="Click to remove this product from shortlist">
					                                            	<span class="lnr lnr-trash"></span>
					                                            </button>
				                                            {{ Form::close() }}
			                                            </td>
		                                        	@endforeach
                                        		</tr>

		                                    @else
		                                    	<tr>
		                                    		<td>
		                                    			<div class="alert alert-danger text-center">Comparison list is empty. Please add product to compare</div>
		                                    		</td>
		                                    	</tr>
		                                    @endif

                                        {{-- <tr>
                                            <td>20 May 2017</td>
                                            <td>Payoneer</td>
                                            <td class="bold">$1300.50</td>
                                            <td class="paid"><span>Paid</span></td>
                                        </tr>

                                        <tr>
                                            <td>16 Dec 2016</td>
                                            <td>Local Bank (USD) - Account ending in 5790</td>
                                            <td class="bold">$2380</td>
                                            <td class="paid"><span>Paid</span></td>
                                        </tr>

                                        <tr>
                                            <td>09 Jul 2017</td>
                                            <td>Payoneer</td>
                                            <td class="bold">$568.50</td>
                                            <td class="pending"><span>Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>20 May 2017</td>
                                            <td>Payoneer</td>
                                            <td class="bold">$1300.50</td>
                                            <td class="paid"><span>Paid</span></td>
                                        </tr>

                                        <tr>
                                            <td>16 Dec 2016</td>
                                            <td>Local Bank (USD) - Account ending in 5790</td>
                                            <td class="bold">$2380</td>
                                            <td class="paid"><span>Paid</span></td>
                                        </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
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

@endsection

@section( 'js' )
{{-- <script src="{{ url( 'js/page/frontend/product/index.js' ) }}"></script> --}}
@stop