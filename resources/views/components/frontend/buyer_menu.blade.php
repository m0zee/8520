
<div class="dashboard_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ul class="nav navbar-nav admin-menu">
                    <li class="{{ ( $active == 'dashboard' ) ? 'active' : '' }}">
                        <a href="{{ route( 'buyer.dashboard' ) }}">
                            <span class="lnr lnr-home"></span>Dashboard
                        </a>
                    </li>
                    
                    <li><a href="dashboard-purchase.html"><span class="lnr lnr-cart"></span>Profile</a></li>
                    
                    <li class="{{ ( $active == 'reviews' ) ? 'active' : '' }}">
                        <a href="{{ route( 'buyer.reviews' ) }}">
                            <span class="lnr lnr-cog"></span> Reviews
                        </a>
                    </li>
                    <li class="{{ ( $active == 'shortlist' ) ? 'active' : '' }}">
                        <a href="{{ route( 'buyer.shortlist' ) }}">
                            <span class="lnr lnr-cart"></span> Shortlist
                        </a>
                    </li>
                     <li class="{{ ( $active == 'messages') ? 'active' : ''  }}">
                        <a href="dashboard-withdrawal.html">
                            <span class="lnr lnr-briefcase"></span>Messages
                        </a>
                    </li>
                    <li class="{{ ( $active == 'addrequirement') ? 'active' : ''  }}">
                        <a href="dashboard-withdrawal.html">
                            <span class="lnr lnr-briefcase"></span>Add Requirement
                        </a>
                    </li>

                </ul><!-- end /.dashboard_menu -->
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</div><!-- end /.dashboard_menu_area -->

 @if( session( 'success' ) )
    <div class="alert alert-success text-center">{{ session( 'success' ) }}</div>
@elseif( session( 'error' ) )
    <div class="alert alert-danger text-center">{{ session( 'error' ) }}</div>
@endif