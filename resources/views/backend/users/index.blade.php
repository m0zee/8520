@extends('components.backend.master')

@section('title', 'Login')
@section('content')
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
                    <h1 class="page-title">Table</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
        @include('components.backend.menu')
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
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Withdrawal History</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>

                                        <tbody>
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
                                        </tr>
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