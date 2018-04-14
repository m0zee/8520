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
                            <li><a href="dashboard.html">Dashboard</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Buyer's Dashboard</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    @include( 'components.frontend.buyer_menu' )

    <section class="dashboard-area">
        

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
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
    </div>

@endsection
