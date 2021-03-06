
<div class="dashboard_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ul class="nav navbar-nav admin-menu">
                    <li class="{{ ( $active == 'dashboard' ) ? 'active' : '' }}">
                        <a href="{{ route( 'buyer.dashboard' ) }}">
                            <span class="lnr lnr-home"></span> Dashboard
                        </a>
                    </li>
                    <li class="{{ ( $active == 'reviews' ) ? 'active' : '' }}">
                        <a href="{{ route( 'buyer.reviews' ) }}">
                            <span class="lnr lnr-list"></span> Reviews
                        </a>
                    </li>
                    <li class="{{ ( $active == 'shortlist' ) ? 'active' : '' }}">
                        <a href="{{ route( 'buyer.shortlist.index' ) }}">
                            <span class="lnr lnr-cart"></span> Shortlist
                        </a>
                    </li>
                     <li class="{{ ( $active == 'messages') ? 'active' : ''  }}">
                        <a href="{{ route( 'messages.index' ) }}">
                            <span class="lnr lnr-envelope"></span> Messages <span id="messageCountBadge" class="badge"></span>
                        </a>
                    </li>
                    <li class="{{ ( $active == 'requirement') ? 'active' : ''  }}">
                        <a href="{{ route('buyer.requirements') }}">
                            <span class="lnr lnr-briefcase"></span> Buying Requirement
                        </a>
                    </li>

                </ul><!-- end /.dashboard_menu -->
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</div><!-- end /.dashboard_menu_area -->