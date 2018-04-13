@extends( 'components.backend.master' )
@php
    $active = 'reviews';
@endphp

@section( 'title', 'Reviews' )
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
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="#">Table</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Reviews</h1>
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
                                        <span class="lnr lnr-users"></span> Reviews
                                    </h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">Reviewer</th>
                                                <th class="col-md-1">Vendor</th>
                                                <th>Text</th>
                                                <th>Status</th>
                                                <th class="col-md-2">Actions</th>
                                                <th class="col-md-1">Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if( $reviews != NULL && count( $reviews ) )
                                                @foreach( $reviews as $review )
                                                    <tr>
                                                        <td>
                                                            {{ $review->user->name }}
                                                        </td>
                                                        <td>{{ $review->vendor->name }}</td>
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
                                                        <td class="actions">
                                                            <a  href="{{ route( 'reviews.approve', $review->id ) }}"
                                                                class="btn btn--icon btn-sm btn-success btn--round approve" title="Click to approve this review">
                                                                <span class="fa fa-check"></span>
                                                            </a>
                                                            <a  href="{{ route( 'reviews.reject', $review->id ) }}"
                                                                class="btn btn-danger btn-sm btn--round reject" title="Click to reject this review">
                                                                <span class="fa fa-times"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if( $review->created_at != $review->updated_at )
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