@extends('components.frontend.master')

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
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('register') }}">Regsiter</a></li>
                            <li class="active"><a href="#">Verification</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Email Verification</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="pass_recover_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="#">
                        <div class="cardify recover_pass">
                            <div class="login--header">
                                <p>You have successfully registered. An email is sent to you for verification.</p>
                            </div><!-- end .login_header -->

                            <div class="login--form">
                                
                                <p>If you didn't receive verification email please click resend button</p>

                                <button class="btn btn--md btn--round register_btn" type="submit">Resend</button>
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form>
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->


{{-- <div class=”container”>
	<div class=”row”>
		<div class=”col-md-8 col-md-offset-2">
			<div class=”panel panel-default”>
				<div class=”panel-heading”>Registration</div>
				<div class=”panel-body”>
					You have successfully registered. An email is sent to you for verification.
				</div>
			</div>
		</div>
	</div>
</div> --}}
@endsection