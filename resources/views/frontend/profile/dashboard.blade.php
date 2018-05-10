@extends( 'components.frontend.master' )

@section( 'title', 'Dashboard' )

@php
    $active = 'product'; 
@endphp

@section( 'content' )

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li class="active"><a href="#">Dashboard</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Dashboard</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>


    <section class="dashboard-area">

        @include( 'components.frontend.vendor_menu' )

        <div class="dashboard_contents">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <h4>Products</h4>
                        <hr>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="author-info author-info--dashboard mcolorbg2">
                            <p>Pending Approval</p>
                            <h3>{{ number_format( $pendingProducts ) }}</h3>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="author-info author-info--dashboard mcolorbg1">
                            <p>Approved</p>
                            <h3>{{ number_format( $approvedProducts ) }}</h3>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="author-info author-info--dashboard mcolorbg4">
                            <p>Rejected</p>
                            <h3>{{ number_format( $rejectedProducts ) }}</h3>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-xs-12">
                        <h4>Buying Requirements</h4>
                        <hr>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="author-info author-info--dashboard mcolorbg2">
                            <p>Pending</p>
                            <h3>{{ number_format( $pendingRequirements ) }}</h3>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="author-info author-info--dashboard mcolorbg1">
                            <p>Approved</p>
                            <h3>{{ number_format( $approvedRequirements ) }}</h3>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="author-info author-info--dashboard mcolorbg4">
                            <p>Rejected</p>
                            <h3>{{ number_format( $rejectedRequirements ) }}</h3>
                        </div>
                    </div>
                </div> --}}

            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->

    </section>
    
@endsection