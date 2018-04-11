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
                        </div>
                    @elseif( session( 'error' ) )
                        <div class="alert alert-danger text-center">
                            <strong>{{ session( 'error' ) }}</strong>
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
                                                <th>Reviewer</th>
                                                <th>Vendor</th>
                                                <th>Text</th>
                                                <th>Approve</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if( $reviews != NULL && count( $reviews ) )
                                                @foreach( $reviews as $review )
                                                    <tr>
                                                        <td>
                                                            {{ $review->user->name . ' (' . $review->user->email . ')' }}
                                                        </td>
                                                        <td>{{ $review->vendor->name . ' (' . $review->vendor->email . ')' }}</td>
                                                        <td>
                                                            Ratings: {{ $review->ratings }} <br>
                                                            {!! nl2br( $review->review ) !!}
                                                        </td>
                                                        <td>
                                                            <a  href="{{ route( 'reviews.approve', $review->id ) }}"
                                                                class="btn btn-primary btn-sm btn--round" title="Click to approve this review">
                                                                Approve
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4">
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

@endsection