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
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="active"><a href="#">Requirement</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Requirement</h1>
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
    @include('components.backend.menu')

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
	                                        <span class="lnr lnr-users"></span> Buyer Requirement
	                                        {{-- <a href="{{ route('buyer.requirements.create') }}" class="btn btn-primary btn--round btn-sm pull-right">Add</a> --}}
	                                    </h3>
	                                </div>
	                                <div class="table-responsive">
	                                    <table class="table withdraw__table">
	                                        <thead>
	                                            <tr>
	                                                <th>Title</th>
	                                                <th class="col-md-1">Unit</th>
	                                                <th class="col-md-1">Quantity</th>
	                                                <th>Description</th>
	                                                <th>Status</th>
	                                                <th class="col-md-2">Date</th>
	                                                <th class="col-md-2">Action</th>
	                                            </tr>
	                                        </thead>

	                                        <tbody>
	                                            @if( isset( $requirements ) && $requirements != NULL && count( $requirements ) )
	                                                @foreach( $requirements as $req )
	                                                    <tr>
	                                                        <td>{{ $req->name }}</td>
	                                                        <td>{{ $req->unit->name }}</td>
	                                                        <td>{{ $req->quantity }}</td>
	                                                        <td>{!! nl2br($req->description) !!}</td>
	                                                        <td> 
	                                                            @if( $req->status_id == 1 )
	                                                                <span class="label label-warning">{{ $req->status->name }}</span>
	                                                            @elseif( $req->status_id == 2 )
	                                                                <span class="label label-success">{{ $req->status->name }}</span>
	                                                            @elseif( $req->status_id == 3 )
	                                                                <span class="label label-danger">{{ $req->status->name }}</span>
	                                                            @endif
	                                                        </td>
	                                                        <td>
	                                                        	<small>{{ $req->created_at->format( 'd-m-Y h:i:s' ) }}</small>
	                                                        </td>
	                                                        <td>
	                                                        	<form action="{{ route('admin.requirements.status', [$req->id, 'approve']) }}" method="POST">
	                                                        		<input type="hidden" name="_method" value="PUT">
	                                                        		{{ csrf_field() }}
	                                                        		<button type="submit" class="btn btn--round btn-sm btn-success">Approve</button>
	                                                        	</form>

	                                                        	<form action="{{ route('admin.requirements.status', [$req->id, 'reject']) }}" method="POST">
	                                                        		<input type="hidden" name="_method" value="PUT">
	                                                        		{{ csrf_field() }}
	                                                        		<button type="submit" class="btn btn--round btn-sm btn-danger">Reject</button>
	                                                        	</form>
	                                                        </td>
	                                                    </tr>
	                                                @endforeach
	                                                
	                                                    {{-- <tr>
	                                                        <td colspan="5" class="text-center">{{ $reviews->links( 'vendor.pagination.pak-material' ) }}</td>
	                                                    </tr> --}}
	                                                
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

@endsection