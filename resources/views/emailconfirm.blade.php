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
                            <li class="active"><a href="#">Email Verification</a></li>
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
                   
                        <div class="cardify recover_pass">
                            <div class="login--header">
                                <p>Your Email is successfully verified. Please Login.</p>
                            </div><!-- end .login_header -->

                            <div class="login--form ">
                                

                                <a class="btn btn--md btn--round register_btn" href="{{ route('login') }}">Login</a>
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    
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
					<div class=”panel-heading”>Registration Confirmed</div>
					<div class=”panel-body”>
						Your Email is successfully verified. Click here to <a href="{{url('/login')}}">login</a>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
@endsection