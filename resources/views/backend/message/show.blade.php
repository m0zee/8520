@extends( 'components.backend.master' )
@php
    $active = 'message';
@endphp

@section( 'title', 'Category' )
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
                            <li><a href="{{ route( 'admin.messages.index' ) }}">Conversations</a></li>
                            <li class="active"><a href="#">Messages</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Messages</h1>
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
    <section class="message_area">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="chat_area cardify">
                        @if( isset( $conversation ) && $conversation !== null )
                        <div class="chat_area--title">
                            <h3>
                                Message between 
                                <a href="{{ url( 'profile/' . $conversation->detail[0]->sender->code ) }}">
                                    <span class="name">{{ $conversation->detail[0]->sender->name }}</span>
                                </a>
                                and 
                                <a href="{{ url( 'profile/' . $conversation->detail[0]->receiver->code ) }}">
                                    <span class="name">{{ $conversation->detail[0]->receiver->name }}</span>
                                </a>
                            </h3>
                        </div>

                        <div class="chat_area--conversation">
                            @foreach( $conversation->detail as $message )
                                <div class="conversation">
                                    <div class="head">
                                        <div class="chat_avatar">
                                            @if( $message->sender->detail == null )
                                                <img src="{{ asset( 'images/notification_head5.png' ) }}" alt="Notification avatar">
                                            @else
                                                <img src="{{ asset( 'storage/profile_img/' . $message->sender->detail->profile_img ) }}" alt="Notification avatar">
                                            @endif
                                        </div>

                                        <div class="name_time">
                                            <div>
                                                <h4>{{ $message->sender->name }}</h4>
                                                <p>{{ $message->created_at->format( 'd-m-Y h:i A' ) }}</p>
                                            </div>
                                            <span class="email">{{ $message->sender->email }}</span>
                                        </div>
                                    </div>

                                    <div class="body">
                                        <p>{!! nl2br( $message->message ) !!}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        @else
                            <div class="alert alert-danger text-center">
                                No message found
                            </div>
                        @endif

                    </div><!-- end /.chat_area -->
                </div><!-- end /.col-md-7 -->
            </div><!-- end /.row -->
        </div>
    </section>
    <!--================================
            END SIGNUP AREA
    =================================-->

@endsection