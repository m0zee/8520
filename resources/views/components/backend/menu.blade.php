<div class="dashboard_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav navbar-nav admin-menu">

                    <li class="{{ ( $active == 'dashboard' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.dashboard' )}}">
                            <span class="fa fa-tachometer"></span> Dashboard
                        </a>
                    </li>
                    <li class="{{ ( $active == 'users' ) ? 'active' : ''  }} has_dropdown">
                        <a href="#">
                            <span class="fa fa-users"></span> Users
                        </a>
                        <div class="dropdown dropdown--menu">
                            <ul>
                                <li><a href="{{ route( 'admin.userlist', [ 'vendor' ]) }}">Vendors</a></li>
                                <li><a href="{{ route( 'admin.userlist', [ 'buyer' ]) }}">Buyers</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="{{ ( $active == 'category' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.categories.index' ) }}">
                            <span class="fa fa-list"></span> Categories
                        </a>
                    </li>
                    <li class="{{ ( $active == 'product' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.products.index' ) }}">
                            <span class="fa fa-archive"></span> Products
                        </a>
                    </li>
                    <li class="{{ ( $active == 'reviews' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.reviews.index' ) }}">
                            <span class="fa fa-star"></span> Reviews
                        </a>
                    </li>
                    <li class="{{ ( $active == 'message' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.messages.index' ) }}">
                            <span class="fa fa-comments-o"></span> Messages <span id="messageCountBadge" class="badge"></span>
                        </a>
                    </li>
                    <li class="{{ ( $active == 'requirement' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.requirements.index' ) }}">
                            <span class="fa fa-info-circle"></span> Requirements
                        </a>
                    </li>
                    <li class="{{ ( $active == 'reports' ) ? 'active' : ''  }}">
                        <a href="{{ route( 'admin.reports.index' ) }}">
                            <span class="fa fa-bug"></span> Reports
                        </a>
                    </li>
                    
                </ul><!-- end /.dashboard_menu -->
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</div><!-- end /.dashboard_menu_area -->