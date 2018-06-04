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
			                                            <td class="text-center">
                                                            <a
                                                                href="{{ route( 'products.show', [ $item->category->slug, $item->sub_category->slug, $item->code, $item->slug ] ) }}"
                                                                class="tip" title="Click to see the detail">
                                                                {{ $item->name }}
                                                            </a>
                                                        </td>
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
@if (! Auth::check() )
    <section class="call-to-action bgimage">
        <div class="bg_image_holder">
            <img src="images/calltobg.jpg" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-wrap">
                        <h1 class="text--white">Ready to Join Our PakMaterial!</h1>
                        <h4 class="text--white">Over 25,000 Vendors and Buyers trust the PakMaterial.</h4>
                        <a href="{{ route('register') }}" class="btn btn--lg btn--round btn--white callto-action-btn">Join Us Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
    <!--================================
        END CALL TO ACTION AREA
    =================================-->

@endsection

@section( 'js' )
{{-- <script src="{{ url( 'js/page/frontend/product/index.js' ) }}"></script> --}}
@stop