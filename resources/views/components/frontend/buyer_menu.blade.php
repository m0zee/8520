
<div class="dashboard_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="dashboard_menu">
                    <li class="{{ ($buyer_active == 'dashboard') ? 'active' : ''  }}">
                        <a href="{{ url('dashboard') }}">
                            <span class="lnr lnr-home"></span>Dashboard
                        </a>
                    </li>
                    <li class="{{ ($buyer_active == 'buyerProfile') ? 'active' : ''  }}">
                        <a href="dashboard-purchase.html">
                            <span class="lnr lnr-cart"></span>Profile
                        </a>
                    </li>
                    <li class="{{ ($buyer_active == 'reviews') ? 'active' : ''  }}">
                        <a href="#">
                            <span class="lnr lnr-cog"></span>Reviews
                        </a>
                    </li>
                    <li class="{{ ($buyer_active == 'shortlist') ? 'active' : ''  }}">
                        <a href="dashboard-purchase.html">
                            <span class="lnr lnr-cart"></span>Shortlist
                        </a>
                    </li>
                    <li class="{{ ($buyer_active == 'messages') ? 'active' : ''  }}">
                        <a href="dashboard-withdrawal.html">
                            <span class="lnr lnr-briefcase"></span>Messages
                        </a>
                    </li>
                    <li class="{{ ($buyer_active == 'addrequirement') ? 'active' : ''  }}">
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