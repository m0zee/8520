@extends('components.frontend.master')

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
                            <li><a href="{{ url( '' ) }}">Home</a></li>
                            <li class="active"><a href="#">Login</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Login</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START LOGIN AREA
    =================================-->
    <section class="login_area section--padding2">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    @if( session( 'error' ) )
                        {{-- expr --}}
                        <div class="alert alert-danger text-center">
                           {{ session( 'error' ) }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>Login to Pakmaterial</h3>
                                <p>Great to have you back !</p>
                            </div><!-- end .login_header -->

                            <div class="login--form">
                                <div class="form-group{{ $errors->has( 'email' ) ? ' has-error' : '' }}">
                                    <label for="user_name">Email</label>
                                    <input id="user_name" type="text" name="email" class="text_field" placeholder="Enter your Email...">

                                    @if( $errors->has( 'email' ) )
                                        <span class="help-block">
                                            <strong>{{ $errors->first( 'email' ) }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has( 'password' ) ? ' has-error' : '' }}">
                                    <label for="pass">Password</label>
                                    <input id="pass" type="password" name="password" class="text_field" placeholder="Enter your password...">

                                    @if( $errors->has( 'password' ) )
                                        <span class="help-block">
                                            <strong>{{ $errors->first( 'password' ) }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="ch2">
                                        <label for="ch2"><span class="shadow_checkbox"></span><span class="label_text">Remember me</span></label>
                                    </div>
                                </div>

                                <button class="btn btn--md btn--round" type="submit">Login Now</button>

                                <hr>
                                <div class="modules__content text-center">
                                    <div class="social social--color--filled">
                                        <ul>
                                            {{-- <div class="fb-login-button"></div> --}}
                                            <li>
                                                <a href="{{ route( 'fb.login' )}}"><span class="fa fa-facebook"></span></a>
                                            </li>
                                            {{-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                            </fb:login-button> --}}
                                            <li>
                                                <a href="{{ route( 'google.login' ) }}"><span class="fa fa-google-plus"></span></a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
    
                                <div class="login_assist">
                                    <p class="recover">Lost your <a href="{{ route('password.request') }}">username</a> or <a href="{{ route('password.request') }}">password</a>?</p>
                                    <p class="signup">Don't have an <a href="{{ url('/register') }}">account</a>?</p>
                                </div>
                            </div><!-- end .login form -->
                        </div><!-- end .cardify -->
                    </form>
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section>
    <!--================================
            END LOGIN AREA
    =================================-->

@endsection
