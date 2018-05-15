@extends( 'components.frontend.master' )

@php  $active = 'reviews';  @endphp

@section( 'title', 'Dashboard' )

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
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li class="active"><a href="#">Dashboard</a></li>
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
	                                        <span class="lnr lnr-users"></span> My Reviews
	                                    </h3>
	                                </div>
	                                <div class="table-responsive">
	                                    <table class="table withdraw__table">
	                                        <thead>
	                                            <tr>
	                                                <th class="col-md-1">Vendor</th>
	                                                <th>Text</th>
	                                                <th>Status</th>
	                                                <th class="col-md-2">Date</th>
	                                            </tr>
	                                        </thead>

	                                        <tbody>
	                                            @if( isset( $reviews ) && $reviews != NULL && count( $reviews ) )
	                                                @foreach( $reviews as $review )
	                                                    <tr>
	                                                        <td>
	                                                        	<a href="{{ url( 'profile/' . $review->vendor->code ) }}" class="tip" title="Click to see the profile">
	                                                        		{{ $review->vendor->name }}
	                                                        	</a>
	                                                        </td>
	                                                        <td>
	                                                            Rating: 
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
	                                                            <span class="pull-right">
	                                                                <small>Submitted at: </small> 
	                                                                <small><strong>{!! nl2br( $review->created_at->format( 'd-m-Y h:i:s a' ) ) !!}</strong></small>
	                                                            </span>
	                                                            <hr>
	                                                            {!! nl2br( $review->review ) !!}
	                                                        </td>
	                                                        <td>
	                                                            @if( $review->status_id == 1 )
	                                                                <span class="label label-warning">{{ $review->status->name }}</span>
	                                                            @elseif( $review->status_id == 2 )
	                                                                <span class="label label-success">{{ $review->status->name }}</span>
	                                                            @elseif( $review->status_id == 3 )
	                                                                <span class="label label-danger">{{ $review->status->name }}</span>
	                                                            @endif
	                                                        </td>
	                                                        <td>
	                                                            @if($review->status_id != 1 )
	                                                                <small>{{ $review->updated_at->format( 'd-m-Y h:i:s a' ) }}</small>
	                                                            @endif
	                                                        </td>
	                                                    </tr>
	                                                @endforeach
	                                                @if( $reviews->hasPages() )
	                                                    <tr>
	                                                        <td colspan="5" class="text-center">{{ $reviews->links( 'vendor.pagination.pak-material' ) }}</td>
	                                                    </tr>
	                                                @endif
	                                            @else
	                                                <tr>
	                                                    <td colspan="5">
	                                                        <div class="alert alert-danger text-center">
	                                                            <strong>No review found!</strong>
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
