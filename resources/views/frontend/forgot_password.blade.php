@extends('components.frontend.master')
@php
    $active = '';
    @endphp
@section('title', 'Forgot Password')

@section('content')


<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="{{ url('') }}">Home</a></li>
                        <li class="active"><a href="#">Recover-Password</a></li>
                    </ul>
                </div>
                <h1 class="page-title">Recover password</h1>
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</section>

<section class="pass_recover_area section--padding2">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
            	@if (session('status'))
	                <div class="alert alert-success">
	                    {{ session('status') }}
	                </div>
	            @endif
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="cardify recover_pass">
                        <div class="login--header">
                            <p>Please enter the email address for your account. A verification
                                link will be sent to you. Once you have received the
                                verification link, you will be able to choose a new password
                                for your account.</p>
                        </div><!-- end .login_header -->

                        <div class="login--form">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email_ad">Email Address</label>
                                <input id="email_ad" type="email" class="form-control text_field" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
							
                            <button class="btn btn--md btn--round register_btn" type="submit">Send Password Reset Link</button>
                        </div><!-- end .login--form -->
                    </div><!-- end .cardify -->
                </form>
            </div><!-- end .col-md-6 -->
        </div><!-- end .row -->
    </div><!-- end .container -->
</section>
@endsection