@extends( 'components.backend.master' )
@php
    $active = 'reports';
@endphp

@section( 'title', 'Reports' )
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
                            <li><a href="{{ route( 'admin.dashboard' ) }}">Dashboard</a></li>
                            <li class="active"><a href="#">Reports</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Reports</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    @include( 'components.backend.menu' )
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START SIGNUP AREA
    =================================-->
    <section class="section--padding2 bgcolor">
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
                                        <span class="lnr lnr-users"></span> Reports
                                    </h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                            <tr>
                                                <th class="col-md-2">Sender</th>
                                                <th class="col-md-2">Product</th>
                                                <th class="col-md-6">Message</th>
                                                {{-- <th>Status</th>
                                                <th class="col-md-2">Actions</th> --}}
                                                <th class="col-md-2">Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if( isset( $reports ) && $reports != NULL && count( $reports ) )
                                                @foreach( $reports as $report )
                                                    <tr>
                                                        <td>
                                                            {{-- <a href="{{ url( 'profile/' . $report->sender->code ) }}" class="tip" title="Click to see the profile"> --}}
                                                                <strong>{{ $report->sender->name }}</strong>
                                                                <br>
                                                                {{ $report->sender->email }}

                                                            {{-- </a> --}}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route( 'products.show', [ $report->product->sub_category->category->slug, $report->product->sub_category->slug, $report->product->code, $report->product->slug] ) }}" class="tip" title="Click to see the product detail">
                                                                {{ $report->product->name }}
                                                            </a>
                                                            <br>
                                                            <strong>{{ $report->product->code }}</strong>
                                                        </td>
                                                        <td>
                                                            {!! nl2br( $report->message ) !!}
                                                        </td>
                                                        <td>
                                                            {{ $report->created_at->format( 'd-m-Y h:i A' ) }}
                                                        </td>
                                                        {{-- <td class="actions">
                                                            <a  href="{{ route( 'admin.reports.approve', $report->id ) }}"
                                                                class="btn btn--icon btn-sm btn-success btn--round tip approve" title="Click to approve this report">
                                                                <span class="fa fa-check"></span>
                                                            </a>
                                                            <a  href="{{ route( 'admin.reports.reject', $report->id ) }}"
                                                                class="btn btn-danger btn-sm btn--round tip reject" title="Click to reject this report">
                                                                <span class="fa fa-times"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if( $report->created_at != $report->updated_at )
                                                                <small>{{ $report->updated_at->format( 'd-m-Y h:i:s a' ) }}</small>
                                                            @endif
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                                @if( $reports->hasPages() )
                                                    <tr>
                                                        <td colspan="5" class="text-center">{{ $reports->links( 'vendor.pagination.pak-material' ) }}</td>
                                                    </tr>
                                                @endif
                                            @else
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="alert alert-danger text-center">
                                                            <strong>No report found!</strong>
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
        </div><!-- end .container -->
    </section>
    <!--================================
            END SIGNUP AREA
    =================================-->

    <div class="modal fade rating_modal" id="confirmation_modal" tabindex="-1" role="dialog" aria-labelledby="confirmation_modal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">___</h3>
                    {{-- <p>You will not be able to recover this file!</p> --}}
                </div><!-- end /.modal-header -->

                <div class="modal-body text-center">
                    <button id="btn_yes" class="btn btn--round btn-sm btn-success">Yes</button>
                    <button id="btn_no" class="btn btn--round btn-sm btn-danger" data-dismiss="modal">No</button>
                </div><!-- end /.modal-body -->
            </div>
        </div>
    </div>
@endsection

@section( 'js' )
<script src="{{ url( 'js/page/backend/review/index.js' ) }}"></script>
@stop