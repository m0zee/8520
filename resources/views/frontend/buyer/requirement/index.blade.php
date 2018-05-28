@extends( 'components.frontend.master' )

@php  $active = 'requirement';  @endphp

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
                            <li><a href="{{ url( 'buyer/dashboard' ) }}">Home</a></li>
                            <li class="active"><a href="#">Buying Requirements</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Buying Requirements</h1>
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

	                    <div>
	                        <div class="modules__content">
	                            <div class="withdraw_module withdraw_history">
	                                <div class="withdraw_table_header">
	                                    <h3>
	                                        <span class="lnr lnr-users"></span> My Buying Requirement
	                                        <a href="{{ route( 'buyer.requirements.create' ) }}" class="btn btn-primary btn--round btn-sm pull-right">
		                                        Add
		                                    </a>
	                                    </h3>
	                                </div>
	                                <div class="table-responsive">
	                                    <table class="table withdraw__table">
	                                        <thead>
	                                            <tr>
	                                                <th class="col-md-3">Title</th>
	                                                {{-- <th class="col-md-1">Unit</th>
	                                                <th class="col-md-1">Quantity</th> --}}
	                                                <th class="col-md-5">Description</th>
	                                                <th class="col-md-1">Status</th>
	                                                <th class="col-md-2">Date</th>
	                                                <th class="col-md-1">Options</th>
	                                            </tr>
	                                        </thead>

	                                        <tbody>
	                                            @if( isset( $requirements ) && $requirements != NULL && count( $requirements ) )
	                                                @foreach( $requirements as $req )
	                                                    <tr>
	                                                        <td>{{ $req->name }}</td>
	                                                        <td>
	                                                        	<small>Quantity</small> <small class="pull-right">{{ $req->quantity }} {{ $req->unit->name }}</small>
	                                                        	<hr>
	                                                        	{!! nl2br( $req->description ) !!}
	                                                        </td>
	                                                        <td> 
	                                                            @if( $req->status_id == 1 )
	                                                                <span class="label label-warning">{{ $req->status->name }}</span>
	                                                            @elseif( $req->status_id == 2 )
	                                                                <span class="label label-success">{{ $req->status->name }}</span>
	                                                                <small>{{ $req->updated_at->format( 'd-m-Y h:i:s A' ) }}</small>
	                                                            @elseif( $req->status_id == 3 )
	                                                                <span class="label label-danger">{{ $req->status->name }}</span>
	                                                                <small>{{ $req->updated_at->format( 'd-m-Y h:i:s A' ) }}</small>
	                                                            @endif
	                                                        </td>
	                                                        <td>
	                                                        	<small>{{ $req->created_at->format( 'd-m-Y h:i:s A' ) }}</small>
	                                                        </td>
	                                                        <td>
	                                                        	<a href="{{ route( 'buyer.requirements.edit', [ $req->code ] ) }}" 
	                                                        		class="btn btn-primary btn--round btn-sm tip" 
	                                                        		title="Click to edit this requirement">
	                                                        		<i class="fa fa-pencil"></i>
	                                                        	</a>
	                                                        </td>
	                                                    </tr>
	                                                @endforeach
	                                            @else
	                                                <tr>
	                                                    <td colspan="66">
	                                                        <div class="alert alert-danger text-center">
	                                                            <strong>No requirement found!</strong>
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

@endsection