  <div class="dashboard_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="dashboard_menu">

                    <li class="{{ (isset( $active ) && $active == 'dashboard') ? 'active' : ''  }}">
                        <a href="dashboard.html">
                            <span class="lnr lnr-home"></span>Dashboard
                        </a>
                    </li>
                    <li class="{{ (isset( $active ) && $active == 'vendorProfile') ? 'active' : ''  }}">
                        <a href="{{route('profile.edit' , [Auth::user()->code])}}">
                            <span class="lnr lnr-cart"></span>Company Profile
                        </a>
                    </li>
                    <li class="{{ (isset( $active ) && $active == 'product') ? 'active' : ''  }}" >
                        <a href="{{ route('my-account.product') }}">
                            <span class="lnr lnr-cog"></span>Product
                        </a>
                    </li>
                    <li class="{{ (isset( $active ) && $active == 'messages') ? 'active' : ''  }}">
                        <a href="dashboard-purchase.html">
                            <span class="lnr lnr-cart"></span>Messages

                        </a>
                    </li>
                </ul><!-- end /.dashboard_menu -->
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</div><!-- end /.dashboard_menu_area -->

 @if( session( 'success' ) )
    <div class="alert alert-success text-center">
        <strong>{{ session( 'success' ) }}</strong>
    </div>
@elseif( session( 'error' ) )
    <div class="alert alert-danger text-center">
        <strong>{{ session( 'error' ) }}</strong>
    </div>
@endif