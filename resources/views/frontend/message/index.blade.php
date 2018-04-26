@extends( 'components.frontend.master' )

@section( 'title', 'Messages' )

@php
    $active = 'messages';
@endphp

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
                            <li><a href="#">Dashboard</a></li>
                            {{-- <li><a href="dashboard.html">Dashboard</a></li> --}}
                            <li class="active"><a href="#">Conversations</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Conversations</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    @if( Auth::user()->user_type_id == 1 ) 
        @include( 'components.frontend.buyer_menu' )
    @else
        @include( 'components.frontend.vendor_menu' )
    @endif


     
    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Conversations</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                        <tr>
                                            <th class="col-md-3">
                                                @if( $user_type_id == 1 ) To @else From @endif
                                            </th>
                                            <th class="col-md-6">About</th>
                                            <th class="col-md-2">Date</th>
                                            <th class="col-md-1">Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if( isset( $conversations ) && count( $conversations ) > 0 )
                                                @foreach( $conversations as $conversation )
                                                    <tr>
                                                        <td>
                                                            @if( $user_type_id == 1 ) 
                                                                <strong>{{ $conversation->receiver_name }}</strong>
                                                                <br>
                                                                {{ $conversation->receiver_email }}
                                                            @else
                                                                <strong>{{ $conversation->sender_name }}</strong>
                                                                <br>
                                                                {{ $conversation->sender_email }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <strong>{{ $conversation->product_name }}</strong> ({{ $conversation->product_code }})
                                                        </td>
                                                        <td>
                                                            {{ date( 'd-m-Y h:i:s A', strtotime( $conversation->updated_at ) ) }}
                                                        </td>
                                                        <td class="action">
                                                            @if( $conversation->seen_by_user == 0 && ( $conversation->last_sender_id != $user_id ) )
                                                                <span class="fa fa-circle text-danger"></span> 
                                                            @else
                                                             &nbsp;&nbsp;
                                                            @endif
                                                            <a href="{{ route( 'messages.show', [ $conversation->id ] ) }}">view</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="alert alert-danger text-center">
                                                            <strong>No messages found!</strong>
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
            END DASHBOARD AREA
    =================================-->
@endsection