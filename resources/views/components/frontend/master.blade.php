<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PakMaterial - Where Vendor and buyer meet">
    <meta name="keywords" content="marketplace, easy digital download, digital product, digital, html5">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    

    <meta property="fb:app_id"        content="164484080926748" />
    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:image"         content={{ ( isset($product) && $product != null ) ? asset( 'storage/product/' . $product->img ) : asset( 'images/logo.png' ) }} >
    {{-- <meta property="og:type"          content="website" /> --}}
    <meta property="og:title"         content="{{ ( isset($product) && $product != null ) ? $product->name : 'Product Not Available' }}" />
    <meta property="og:description"   content="{{ ( isset($product) && $product != null ) ? strip_tags($product->description) : 'Product Not Available' }}" />


    {{-- <meta name="csrf_token" content="{{ csrf_token() }}"> --}}



    <title>Pak Material - @yield( 'title' )</title>

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url( 'css/animate.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/font-awesome.min.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/fontello.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/jquery-ui.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/lnr-icon.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/owl.carousel.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/slick.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/trumbowyg.min.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/bootstrap/bootstrap.min.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/style.css' ) }}">
    <link rel="stylesheet" href="{{ url( 'css/custom.css' ) }}">
    <!-- endinject -->

    <!-- page css -->
    @yield( 'css' )
    <!-- endpage css -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url( 'images/favicon.png' ) }}">
</head>

{{-- <body class="home1 mutlti-vendor"> --}}
<body class="@yield( 'body_class' )">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '164484080926748',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<!-- ================================
    START MENU AREA
================================= -->
@include( 'components.frontend.header' )
<!--================================
    END MENU AREA
=================================-->

<!--================================
    START CONTENT AREA
=================================-->

@yield( 'content' )


<!--================================
    END CONTENT AREA
=================================-->

<!--================================
    START FOOTER AREA
=================================-->
@include( 'components.frontend.footer' )
<!--================================
    END FOOTER AREA
=================================-->

<input type="hidden" id="base_url" value="{{ url('') }}">
{{ Form::hidden( 'comparisonProduct', session( 'productCount' ), [ 'id' => 'hiddComparisonProductCount' ] ) }}

<!--//////////////////// JS GOES HERE ////////////////-->

<!-- inject:js -->
<script src="{{ url( 'js/vendor/jquery/jquery-1.12.3.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery/uikit.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/bootstrap.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/bootstrap-notify/bootstrap-notify.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/chart.bundle.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/grid.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery-ui.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery.barrating.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery.countdown.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery.counterup.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery.easing1.3.js' ) }}"></script>
<script src="{{ url( 'js/vendor/owl.carousel.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/slick.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/tether.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/trumbowyg.min.js' ) }}"></script>
<script src="{{ url( 'js/vendor/waypoints.min.js' ) }}"></script>
<script src="{{ url( 'js/dashboard.js' ) }}"></script>
<script src="{{ url( 'js/main.js' ) }}"></script>
<script src="{{ url( 'js/map.js' ) }}"></script>
<!-- endinject -->

<!-- page js -->
@yield( 'js' )
<!-- end page js -->
</body>

</html>
