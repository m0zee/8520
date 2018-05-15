<div class="menu-area {{ isset( $blue_menu ) ? 'menu--style1' : '' }}">
    <!-- start .top-menu-area -->
    <div class="top-menu-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-md-3 col-sm-3 col-xs-7 v_middle">
                    <div class="logo">
                        <a href="{{ route( 'home' ) }}"><img src="{{ url( 'images/logo.png' ) }}" alt="logo image"></a>
                    </div>
                </div><!-- end /.col-md-3 -->

                <!-- start .col-md-5 -->
                <div class="col-md-8 col-md-offset-1 col-xs-5 col-sm-9 v_middle">
                    <!-- start .author-area -->
                    <div class="author-area">
                        <!--start .author__notification_area -->
                        @if( Auth::check() )

                            @if( Auth::user()->user_type_id == 3 ) {{-- Admin --}}
                                <div class="author-author__info inline has_dropdown">
                                    <div class="author__avatar">
                                        <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                    </div>
                                    <div class="autor__info">
                                        <p class="name">{{ Auth::user()->name }}</p>
                                        <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                    </div>

                                    <div class="dropdown dropdown--author">
                                        <ul>
                                            <li>
                                                <a href="{{ route( 'admin.dashboard' ) }}">
                                                    <span class="lnr lnr-home"></span> Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'password.change.index' ) }}">
                                                    <span class="lnr lnr-lock"></span> Change Password
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route( 'admin.userlist', [ 'vendor' ]) }}">
                                                    <span class="fa fa-users"></span> Vendors
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.userlist', [ 'buyer' ]) }}">
                                                    <span class="fa fa-users"></span> Buyers
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.categories.index' ) }}">
                                                    <span class="fa fa-list"></span> Categories
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.products.index' ) }}">
                                                    <span class="fa fa-archive"></span> Products
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route( 'admin.reviews.index' ) }}">
                                                    <span class="fa fa-star"></span> Reviews
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.messages.index' ) }}">
                                                    <span class="fa fa-comments-o"></span> Messages
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.requirements.index' ) }}">
                                                    <span class="fa fa-info-circle"></span> Requirements
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.reports.index' ) }}">
                                                    <span class="fa fa-bug"></span> Reports
                                                </a>
                                            </li>


                                            {{-- <li><a href="dashboard-setting.html"><span class="lnr lnr-cog"></span> Setting</a></li>
                                            <li><a href="cart.html"><span class="lnr lnr-cart"></span>Purchases</a></li>
                                            <li><a href="favourites.html"><span class="lnr lnr-heart"></span> Favourite</a></li>
                                            <li><a href="dashboard-add-credit.html"><span class="lnr lnr-dice"></span>Add Credits</a></li>
                                            <li><a href="dashboard-statement.html"><span class="lnr lnr-chart-bars"></span>Sale Statement</a></li>
                                            <li><a href="dashboard-upload.html"><span class="lnr lnr-upload"></span>Upload Item</a></li>
                                            <li><a href="dashboard-manage-item.html"><span class="lnr lnr-book"></span>Manage Item</a></li>
                                            <li><a href="dashboard-withdrawal.html"><span class="lnr lnr-briefcase"></span>Withdrawals</a></li> --}}
                                            <li>
                                                <a href="{{ route( 'logout' ) }}" onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                                                        <span class="lnr lnr-exit"></span> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if( Auth::user()->user_type_id == 1 ) {{-- Buyer --}}
                                <div class="author-author__info inline has_dropdown">
                                    <div class="author__avatar">
                                        <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                    </div>
                                    <div class="autor__info">
                                        <p class="name">{{ Auth::user()->name }}</p>
                                        <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                    </div>

                                    <div class="dropdown dropdown--author">
                                        <ul>
                                            <li>
                                                <a href="{{ route( 'buyer.dashboard' ) }}">
                                                    <span class="lnr lnr-home"></span> Dashboard
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route( 'password.change.index' ) }}">
                                                    <span class="lnr lnr-lock"></span> Change Password
                                                </a>
                                            </li>
                                           
                                            <li>
                                                <a href="{{ route( 'buyer.reviews' ) }}">
                                                    <span class="lnr lnr-list"></span> Reviews
                                                </a>
                                            </li>
                                            
                                             <li>
                                                <a href="{{ route( 'buyer.shortlist.index' ) }}">
                                                    <span class="lnr lnr-cart"></span> Shortlist
                                                </a>
                                            </li>
                                            
                                             <li>
                                                <a href="{{ route('buyer.requirements') }}">
                                                    <span class="lnr lnr-briefcase"></span> Buying Requirement
                                                </a>
                                            </li>
                                            
                                             <li>
                                                <a href="{{ route( 'messages.index' ) }}">
                                                    <span class="lnr lnr-envelope"></span> Messages
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route( 'logout' ) }}"
                                                 onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                                                    <span class="lnr lnr-exit"></span> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if( Auth::user()->user_type_id == 2 ) {{-- Vendor --}}
                                <div class="author-author__info inline has_dropdown">
                                    <div class="author__avatar">
                                        @if (Auth::user()->detail != NULL)
                                            <img src="{{ asset( 'storage/profile_img/50x50_' . Auth::user()->detail->profile_img ) }}" alt="user avatar">
                                            @else
                                            <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                        @endif
                                    </div>
                                    <div class="autor__info">
                                        <p class="name">{{ Auth::user()->name }}</p>
                                        <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                    </div>

                                    <div class="dropdown dropdown--author">
                                        <ul>
                                            <li>
                                                <a href="{{ route( 'vendor.dashboard' ) }}">
                                                    <span class="lnr lnr-home"></span> Dashboard
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route( 'profile.edit', [ Auth::user()->code ] ) }}">
                                                    <span class="lnr lnr-user"></span> Profile
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route( 'password.change.index' ) }}">
                                                    <span class="lnr lnr-lock"></span> Change Password
                                                </a>
                                            </li>
                                           
                                            <li>
                                                 <a href="{{ route( 'my-account.product' ) }}">
                                                    <span class="lnr lnr-cart"></span> Product
                                                </a>
                                            </li>
                                            <li class="{{ ( isset( $active ) && $active == 'messages' ) ? 'active' : ''  }}">
                                                <a href="{{ route( 'messages.index' ) }}">
                                                    <span class="lnr lnr-envelope"></span> Messages
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'logout' ) }}"
                                                 onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                                                    <span class="lnr lnr-exit"></span> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @php
                                switch ( Auth::user()->user_type_id ) {
                                    
                                    case '1':
                                        $url = route('buyer.dashboard');
                                        break;

                                    case '2':
                                        $url = route('vendor.dashboard');
                                        break;

                                    case '3':
                                        $url = route('admin.dashboard');
                                        break;

                                    default:
                                        $url = route('register');
                                        break;
                                }
                            @endphp

                            


                            <a href="{{  $url  }}" class="author-area__seller-btn inline">
                                <span class="lnr lnr-home"></span> Dashboard
                            </a>
                            
                            <a href="{{ route( 'logout' ) }}" 
                                onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();" 
                                class="author-area__seller-btn inline">
                                <span class="lnr lnr-exit"></span> logout
                            </a>
                            <form id="logout-form" action="{{ route( 'logout' ) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            
                        @else
                            <a href="{{ route( 'register' ) }}" class="author-area__seller-btn inline">Become a Vendor / Buyer</a>
                            <a href="{{ url( 'login' ) }}" class="author-area__seller-btn inline">Login</a>
                        @endif

                        <div class="author__notification_area">
                            <ul>
                                <li>
                                    <div class="icon_wrap">
                                        <a href="{{ route( 'comparison.index' )}}">
                                            <span class="fa fa-shopping-basket"></span> <span class="notification_count msg comparisonProductCountContainer" id="comparisonProductCountContainer"></span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div><!--start .author__notification_area -->
                    </div><!-- end .author-area -->
                    
                    <!-- author area restructured for mobile -->
                    <div class="mobile_content ">
                        <span class="lnr lnr-user menu_icon"></span>

                        <!-- offcanvas menu -->
                        <div class="offcanvas-menu closed ">

                            <span class="lnr lnr-cross close_menu"></span>
                            @if( Auth::check() )

                                @if( Auth::user()->user_type_id == 3 ) {{-- Admin --}}
                                    <div class="author-author__info">
                                        <div class="author__avatar v_middle"> 
                                            <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                        </div>
                                        <div class="autor__info v_middle">

                                            <p class="name">{{ Auth::user()->name }}</p>
                                            <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                        </div>
                                    </div><!--end /.author-author__info-->

                                    <div class="author__notification_area">
                                        <ul>
                                            <li>
                                                <div class="icon_wrap">
                                                    <a href="{{ route( 'comparison.index' )}}">
                                                        <span class="fa fa-shopping-basket"></span> <span class="notification_count msg comparisonProductCountContainer" id="comparisonProductCountContainer"></span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!--start .author__notification_area -->

                                    <div class="dropdown dropdown--author">
                                        <ul>
                                            <li>
                                                <a href="{{ route( 'admin.dashboard' ) }}">
                                                    <span class="lnr lnr-home"></span> Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'password.change.index' ) }}">
                                                    <span class="lnr lnr-lock"></span> Change Password
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route( 'admin.userlist', [ 'vendor' ]) }}">
                                                    <span class="fa fa-users"></span> Vendors
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.userlist', [ 'buyer' ]) }}">
                                                    <span class="fa fa-users"></span> Buyers
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.categories.index' ) }}">
                                                    <span class="fa fa-list"></span> Categories
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.products.index' ) }}">
                                                    <span class="fa fa-archive"></span> Products
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route( 'admin.reviews.index' ) }}">
                                                    <span class="fa fa-star"></span> Reviews
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.messages.index' ) }}">
                                                    <span class="fa fa-comments-o"></span> Messages
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.requirements.index' ) }}">
                                                    <span class="fa fa-info-circle"></span> Requirements
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'admin.reports.index' ) }}">
                                                    <span class="fa fa-bug"></span> Reports
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'logout' ) }}" onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                                                        <span class="lnr lnr-exit"></span> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif

                                @if( Auth::user()->user_type_id == 2 ) {{-- Vendor --}}

                                    <div class="author-author__info">
                                        <div class="author__avatar v_middle">
                                            @if (Auth::user()->detail != NULL)
                                                <img src="{{ asset( 'storage/profile_img/50x50_' . Auth::user()->detail->profile_img ) }}" alt="user avatar">
                                                @else
                                                <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                            @endif
                                        </div>
                                        <div class="autor__info v_middle">

                                            <p class="name">{{ Auth::user()->name }}</p>
                                            <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                        </div>
                                    </div><!--end /.author-author__info-->

                                    <div class="author__notification_area">
                                        <ul>
                                            <li>
                                                <div class="icon_wrap">
                                                    <a href="{{ route( 'comparison.index' )}}">
                                                        <span class="fa fa-shopping-basket"></span> <span class="notification_count msg comparisonProductCountContainer" id="comparisonProductCountContainer"></span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!--start .author__notification_area -->

                                    <div class="dropdown dropdown--author">
                                        <ul>
                                            <li>
                                                <a href="{{ route( 'vendor.dashboard' ) }}">
                                                    <span class="lnr lnr-home"></span> Dashboard
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route( 'profile.edit', [ Auth::user()->code ] ) }}">
                                                    <span class="lnr lnr-user"></span> Profile
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route( 'password.change.index' ) }}">
                                                    <span class="lnr lnr-lock"></span> Change Password
                                                </a>
                                            </li>
                                           
                                            <li>
                                                 <a href="{{ route( 'my-account.product' ) }}">
                                                    <span class="lnr lnr-cart"></span> Product
                                                </a>
                                            </li>
                                            <li class="{{ ( isset( $active ) && $active == 'messages' ) ? 'active' : ''  }}">
                                                <a href="{{ route( 'messages.index' ) }}">
                                                    <span class="lnr lnr-envelope"></span> Messages
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route( 'logout' ) }}"
                                                 onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                                                    <span class="lnr lnr-exit"></span> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                @endif

                                @if( Auth::user()->user_type_id == 1 ) {{-- Buyer --}}
                                    <div class="author-author__info">
                                        <div class="author__avatar v_middle"> 
                                            <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                        </div>
                                        <div class="autor__info v_middle">

                                            <p class="name">{{ Auth::user()->name }}</p>
                                            <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                        </div>
                                    </div><!--end /.author-author__info-->

                                    <div class="author__notification_area">
                                        <ul>
                                            <li>
                                                <div class="icon_wrap">
                                                    <a href="{{ route( 'comparison.index' )}}">
                                                        <span class="fa fa-shopping-basket"></span> <span class="notification_count msg comparisonProductCountContainer" id="comparisonProductCountContainer"></span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!--start .author__notification_area -->

                                    <div class="dropdown dropdown--author">
                                        <ul>
                                            <li>
                                                <a href="{{ route( 'buyer.dashboard' ) }}">
                                                    <span class="lnr lnr-home"></span> Dashboard
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route( 'password.change.index' ) }}">
                                                    <span class="lnr lnr-lock"></span> Change Password
                                                </a>
                                            </li>
                                           
                                            <li>
                                                <a href="{{ route( 'buyer.reviews' ) }}">
                                                    <span class="lnr lnr-list"></span> Reviews
                                                </a>
                                            </li>
                                            
                                             <li>
                                                <a href="{{ route( 'buyer.shortlist.index' ) }}">
                                                    <span class="lnr lnr-cart"></span> Shortlist
                                                </a>
                                            </li>
                                            
                                             <li>
                                                <a href="{{ route('buyer.requirements') }}">
                                                    <span class="lnr lnr-briefcase"></span> Buying Requirement
                                                </a>
                                            </li>
                                            
                                             <li>
                                                <a href="{{ route( 'messages.index' ) }}">
                                                    <span class="lnr lnr-envelope"></span> Messages
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="{{ route( 'logout' ) }}"
                                                 onclick="event.preventDefault(); document.getElementById( 'logout-form' ).submit();">
                                                    <span class="lnr lnr-exit"></span> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                
                            @else
                                <br>
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('register') }}" class="author-area__seller-btn inline">Signup</a>
                                    <a href="{{ url( 'login' ) }}" class="author-area__seller-btn inline">Login</a>
                                </div>
                            @endif
                        </div>
                    </div><!-- end /.mobile_content -->
                </div><!-- end /.col-md-5 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </div><!-- end  -->

    <!-- start .mainmenu_area -->
    <div class="mainmenu">
        <!-- start .container -->
        <div class="container">
            <!-- start .row-->
            <div class="row">
                <!-- start .col-md-12 -->
                <div class="col-md-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="lnr lnr-menu"></span>
                        </button>

                        <!-- start mainmenu__search -->
                        <div class="mainmenu__search hidden-sm hidden-md hidden-lg">
                            <form action="#">
                                <div class="searc-wrap">
                                    <input type="text" placeholder="Search product">
                                    <button type="submit" class="search-wrap__btn"><span class="lnr lnr-magnifier"></span></button>
                                </div>
                            </form>
                        </div><!-- start mainmenu__search -->
                    </div>

                    <nav class="navbar navbar-default mainmenu__menu">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('') }}">HOME</a></li>
                               {{--  <li class="has_dropdown">
                                    <a href="all-products-list.html">all product</a>
                                    <div class="dropdown dropdown--menu">
                                        <ul>
                                            <li><a href="all-products.html">Recent Items</a></li>
                                            <li><a href="all-products.html">Popular Items</a></li>
                                            <li><a href="index3.html">Free Templates</a></li>
                                            <li><a href="#">Follow Feed</a></li>
                                            <li><a href="#">Top Authors</a></li>
                                        </ul>
                                    </div>
                                </li> --}}
                                <li>
                                    <a href="{{ route( 'products' ) }}">Products</a>
                                </li>
                                <li>
                                    <a href="{{ route('requirement') }}">Buy Requirements</a>
                                </li>
                                <li><a href="{{ route( 'contact' ) }}">contact</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->

                        <!-- start mainmenu__search -->
                        <div class="mainmenu__search hidden-xs">
                            {{ Form::open( [ 'route' => 'products.search', 'method' => 'GET' ] ) }}
                                <div class="searc-wrap">
                                    {{ Form::text( 'query', old( 'query' ), [ 'class' => 'text_field', 'placeholder' => 'Search product here...' ] ) }}
                                    <button type="submit" class="search-wrap__btn"><span class="lnr lnr-magnifier"></span></button>
                                </div>
                            {{ Form::close() }}
                        </div><!-- start mainmenu__search -->
                    </nav>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row-->
        </div><!-- start .container -->
    </div><!-- end /.mainmenu-->
</div>
