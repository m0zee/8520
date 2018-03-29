@extends('components.frontend.master')
@section('title', 'Signup')

@section('content')
<!--================================
    START HERO AREA
=================================-->

<!--================================
    START BREADCRUMB AREA
=================================-->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{ url('') }}">Home</a></li>
                        <li class="active"><a href="#">Signup</a></li>
                    </ul>
                </div>
                <h1 class="page-title">Sign up</h1>
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</section>
<!--================================
    END BREADCRUMB AREA
=================================-->

<!--================================
        START SIGNUP AREA
=================================-->
<section class="signup_area section--padding2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="cardify signup_form">
                        <div class="login--header">
                            <h3>Create Your Account</h3>
                            <p>Please fill the following fields with appropriate information
                                to register a new MartPlace account.</p>
                        </div><!-- end .login_header -->

                        <div class="login--form">

                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="urname">Your Name</label>
                                <input id="urname" type="text" class="text_field" name="name" value="{{ old('name') }}" placeholder="Enter your Name">

                                 @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email_ad">Email Address</label>
                                <input id="email_ad" type="text" name="email" class="text_field" placeholder="Enter your email address">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" class="text_field" placeholder="Enter your password...">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                
                            </div>

                            <div class="form-group">
                                <label for="con_pass">Confirm Password</label>
                                <input id="con_pass" type="password" class="text_field" name="password_confirmation" placeholder="Confirm password">
                            </div>

                            <button class="btn btn--md btn--round register_btn" type="submit">Register Now</button>

                            <div class="login_assist">
                                <p>Already have an account? <a href="{{ url( 'login' ) }}">Login</a></p>
                            </div>
                            
                        </div><!-- end .login--form -->
                    </div><!-- end .cardify -->
                </form>
            </div><!-- end .col-md-6 -->
        </div><!-- end .row -->
    </div><!-- end .container -->
</section>
<!--================================
        END SIGNUP AREA
=================================-->
@endsection