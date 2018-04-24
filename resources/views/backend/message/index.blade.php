@extends( 'components.backend.master' )
@php
    $active = 'message';
@endphp

@section( 'title', 'Messages' )
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
                            <li class="active"><a href="#">Conversations</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Conversations</h1>
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
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Conversations</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if( isset( $messages ) && $messages != NULL )
                                                @foreach( $messages as $message )
                                                    <tr class="text-success">
                                                        <td>
                                                            <a href="{{ url( 'profile/' . $message->sender->code ) }}">
                                                                {{ $message->sender->name }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url( 'profile/' . $message->receiver->code ) }}">
                                                                {{ $message->receiver->name }}
                                                            </a>
                                                        </td>
                                                        <td class="action">
                                                            @if( ! $message->seen_by_admin )
                                                                <span class="fa fa-circle text-danger"></span> 
                                                            @else
                                                             &nbsp;&nbsp;
                                                            @endif
                                                            <a href="{{ route( 'admin.messages.show', [ $message->id ] ) }}">view</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @if( $messages->hasPages() )
                                                    <tr>
                                                        <td colspan="3" class="text-center">
                                                            {{ $messages->links( 'vendor.pagination.pak-material' ) }}
                                                        </td>
                                                    </tr>
                                                @endif
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