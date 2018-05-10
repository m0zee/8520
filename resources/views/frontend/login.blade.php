@extends('components.frontend.master')

@section('title', 'Login')
@section('content')

{{-- <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '164484080926748',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    	FB.login(function(response) {
	    	FB.api('/me', function(response) {
	      console.log('Successful login for: ' + response.name);
	      document.getElementById('status').innerHTML =
	        'Thanks for logging in, ' + response.name + '!';
	    }, {scope: 'email,user_likes'});      
    });
  }
</script> --}}
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
                    @if (session('error'))
                        {{-- expr --}}
                    <div class="alert alert-danger text-center">
                       {{ session('error') }}
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
                                <div class="form-group">
                                    <label for="user_name">Email</label>
                                    <input id="user_name" type="text" name="email" class="text_field" placeholder="Enter your Email...">
                                </div>

                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input id="pass" type="password" name="password" class="text_field" placeholder="Enter your password...">
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
                                            <li>
                                                <a href="#"><span class="fa fa-linkedin"></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
    
                                <div class="login_assist">
                                    <p class="recover">Lost your <a href="pass-recovery.html">username</a> or <a href="pass-recovery.html">password</a>?</p>
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
