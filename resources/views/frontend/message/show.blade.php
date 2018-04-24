@extends( 'components.frontend.master' )

@section( 'title', 'Messages' )

@php
    $active = 'message';
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
                            <li><a href="{{ route( 'messages.index' ) }}">Conversations</a></li>
                            {{-- <li class="active"><a href="#">Conversations</a></li> --}}
                            <li class="active"><a href="#">Messages</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Messages</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    @include( 'components.frontend.vendor_menu' )
    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="message_area">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="chat_area cardify">

                        <div class="chat_area--title">
                            <h3>
                                Message between 
                                {{-- <a href="{{ url( 'profile/' . $conversation->detail[0]->sender->code ) }}"> --}}
                                @if( $conversation->sender->id == $user_id )
                                    <span class="name">Me</span>
                                @else
                                    <span class="name">{{ $conversation->sender->name }}</span>
                                @endif
                                {{-- </a> --}}
                                and 
                                {{-- <a href="{{ url( 'profile/' . $conversation->detail[0]->receiver->code ) }}"> --}}
                                @if( $conversation->receiver->id == $user_id )
                                    <span class="name">Me</span>
                                @else
                                    <span class="name">{{ $conversation->detail[0]->receiver->name }}</span>
                                @endif
                                {{-- </a> --}}
                            </h3>
                        </div>

                        <div class="chat_area--conversation">
                            @foreach( $conversation->detail as $message )
                                <div class="conversation">
                                    <div class="head">
                                        <div class="chat_avatar">
                                            @if( $message->sender->detail == null || $message->sender->detail->profile_path == null || ! file_exists( $message->sender->detail->profile_path . '/' . $message->sender->detail->profile_img ) )
                                                <img src="{{ asset( 'images/notification_head5.png' ) }}" alt="Notification avatar">
                                            @else
                                                <img src="{{ asset( 'storage/profile_img/' . $message->sender->detail->profile_img ) }}" alt="Notification avatar">
                                            @endif
                                        </div>

                                        <div class="name_time">
                                            <div>
                                                @if( $message->sender->id == $user_id )
                                                    <h4>Me</h4>
                                                @else
                                                    <h4>{{ $message->sender->name }}</h4>
                                                @endif
                                                <p>{{ $message->created_at->format( 'd-m-Y h:i A' ) }}</p>
                                            </div>
                                            <span class="email">{{ $message->sender->email }}</span>
                                        </div>
                                    </div>

                                    <div class="body">
                                        <p>{{ $message->message }}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div><!-- end /.chat_area -->
                </div><!-- end /.col-md-7 -->
            </div><!-- end /.row -->
        </div>
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
@endsection