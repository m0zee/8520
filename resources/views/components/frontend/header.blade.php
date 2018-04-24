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
                            <!--start .author-author__info-->
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
                                            <a href="{{ route( 'profile.edit', [ Auth::user()->code ] ) }}">
                                                <span class="lnr lnr-user"></span> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url( 'dashboard' ) }}">
                                                <span class="lnr lnr-home"></span> Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route( 'my-account.product', [ Auth::user()->code ] ) }}">
                                                <span class="lnr lnr-book"></span> Products
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
                                            <a href="{{ url( 'dashboard' ) }}">
                                                <span class="lnr lnr-home"></span> Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route( 'profile.edit', [ Auth::user()->code ] ) }}">
                                                <span class="lnr lnr-user"></span> Profile
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
                                            <a href="#">
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
                        @if( Auth::user()->user_type_id == 2 ) {{-- Vender --}}
                            <div class="author-author__info inline has_dropdown">
                                <div class="author__avatar">
                                    <img src="{{ asset('storage/profile_img/50x50_'.Auth::user()->detail->profile_img) }}" alt="user avatar">
                                </div>
                                <div class="autor__info">
                                    <p class="name">{{ Auth::user()->name }}</p>
                                    <p class="ammount">{{ Auth::user()->user_type->name }}</p>
                                </div>

                                <div class="dropdown dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="{{ url( 'dashboard' ) }}">
                                                <span class="lnr lnr-home"></span> Dashboard
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route( 'profile.edit', [ Auth::user()->code ] ) }}">
                                                <span class="lnr lnr-user"></span> Profile
                                            </a>
                                        </li>
                                       
                                        <li>
                                             <a href="{{ route('my-account.product') }}">
                                                <span class="lnr lnr-cart"></span>Product
                                            </a>
                                        </li>
                                        <li class="{{ (isset( $active ) && $active == 'messages') ? 'active' : ''  }}">
                                            <a href="#">
                                                <span class="lnr lnr-envelope"></span>Messages

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
                            <!--end /.author-author__info-->

                            <a href="{{ route( 'register' ) }}" class="author-area__seller-btn inline">
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
                                            <span class="fa fa-shopping-basket"></span> <span class="notification_count msg" id="comparisonProductCountContainer"></span>
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
                        <div class="offcanvas-menu closed">
                            <span class="lnr lnr-cross close_menu"></span>
                            <div class="author-author__info">
                                <div class="author__avatar v_middle">
                                    <img src="{{ url( 'images/usr_avatar.png' ) }}" alt="user avatar">
                                </div>
                                <div class="autor__info v_middle">
                                    <p class="name">
                                        Jhon Doe
                                    </p>
                                    <p class="ammount">$20.45</p>
                                </div>
                            </div><!--end /.author-author__info-->

                            <div class="author__notification_area">
                                <ul>
                                    <li>
                                        <a href="notification.html">
                                            <div class="icon_wrap">
                                                <span class="lnr lnr-alarm"></span> <span class="notification_count noti">25</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="message.html">
                                            <div class="icon_wrap">
                                                <span class="lnr lnr-envelope"></span> <span class="notification_count msg">6</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="cart.html">
                                            <div class="icon_wrap">
                                                <span class="lnr lnr-cart"></span> <span class="notification_count purch">2</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div><!--start .author__notification_area -->

                            <div class="dropdown dropdown--author">
                                <ul>
                                    <li><a href="author.html"><span class="lnr lnr-user"></span>Profile</a></li>
                                    <li><a href="dashboard.html"><span class="lnr lnr-home"></span> Dashboard</a></li>
                                    <li><a href="dashboard-setting.html"><span class="lnr lnr-cog"></span> Setting</a></li>
                                    <li><a href="cart.html"><span class="lnr lnr-cart"></span>Purchases</a></li>
                                    <li><a href="favourites.html"><span class="lnr lnr-heart"></span> Favourite</a></li>
                                    <li><a href="dashboard-add-credit.html"><span class="lnr lnr-dice"></span>Add Credits</a></li>
                                    <li><a href="dashboard-statement.html"><span class="lnr lnr-chart-bars"></span>Sale Statement</a></li>
                                    <li><a href="dashboard-upload.html"><span class="lnr lnr-upload"></span>Upload Item</a></li>
                                    <li><a href="dashboard-manage-item.html"><span class="lnr lnr-book"></span>Manage Item</a></li>
                                    <li><a href="dashboard-withdrawal.html"><span class="lnr lnr-briefcase"></span>Withdrawals</a></li>
                                    <li><a href="#"><span class="lnr lnr-exit"></span>Logout</a></li>
                                </ul>
                            </div>

                            <div class="text-center"><a href="{{ route('register') }}" class="author-area__seller-btn inline">Become a Seller</a></div>
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
                                <li class="has_dropdown">
                                    <a href="{{ route( 'products' ) }}">Products</a>
                                   {{--  <div class="dropdown dropdown--menu">
                                        <ul>
                                            <li><a href="category-grid.html">Popular Items</a></li>
                                            <li><a href="category-grid.html">Admin Templates</a></li>
                                            <li><a href="category-grid.html">Blog / Magazine / News</a></li>
                                            <li><a href="category-grid.html">Creative</a></li>
                                            <li><a href="category-grid.html">Corporate Business</a></li>
                                            <li><a href="category-grid.html">Resume Portfolio</a></li>
                                            <li><a href="category-grid.html">eCommerce</a></li>
                                            <li><a href="category-grid.html">Entertainment</a></li>
                                            <li><a href="category-grid.html">Landing Pages</a></li>
                                        </ul>
                                    </div> --}}
                                </li>
                                {{-- <li class="has_megamenu">
                                    <a href="#">Vendors</a>
                                    <div class="dropdown_megamenu contained">
                                        <div class="megamnu_module">
                                            <div class="menu_items">
                                                <div class="menu_column">
                                                    <ul>
                                                        <li><a href="accordion.html">Accordion</a></li>
                                                        <li><a href="alert.html">Alert</a></li>
                                                        <li><a href="brands.html">Brands</a></li>
                                                        <li><a href="buttons.html">Buttons</a></li>
                                                        <li><a href="cards.html">Cards</a></li>
                                                        <li><a href="charts.html">Charts</a></li>
                                                        <li><a href="content-block.html">Content Block</a></li>
                                                        <li><a href="dropdowns.html">Drpdowns</a></li>
                                                        <li><a href="features.html">Features</a></li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li><a href="footer.html">Footer</a></li>
                                                        <li><a href="info-box.html">Info Box</a></li>
                                                        <li><a href="menu.html">Menu</a></li>
                                                        <li><a href="modal.html">Modal</a></li>
                                                        <li><a href="pagination.html">Pagination</a></li>
                                                        <li><a href="peoples.html">Peoples</a></li>
                                                        <li><a href="products.html">Products</a></li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li><a href="progressbar.html">Progressbar</a></li>
                                                        <li><a href="social.html">Social</a></li>
                                                        <li><a href="tab.html">Tabs</a></li>
                                                        <li><a href="table.html">Table</a></li>
                                                        <li><a href="testimonials.html">Testimonials</a></li>
                                                        <li><a href="timeline.html">Timeline</a></li>
                                                        <li><a href="typography.html">Typography</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> --}}
                                <li class="has_megamenu">
                                    <a href="{{ route('requirement') }}">Buy Requirements</a>
                                    {{-- <div class="dropdown_megamenu">
                                        <div class="megamnu_module">
                                            <div class="menu_items">
                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">Product</li>
                                                        <li><a href="all-products.html">Products Grid</a></li>
                                                        <li><a href="all-products-list.html">Products List</a></li>
                                                        <li><a href="category-grid.html">Category Grid</a></li>
                                                        <li><a href="category-list.html">Category List</a></li>
                                                        <li><a href="search-product.html">Search Product</a></li>
                                                        <li><a href="single-product.html">Single Product V1</a></li>
                                                        <li><a href="single-product-v2.html">Single Product V2</a></li>
                                                        <li><a href="single-product-v3.html">Single Product V3</a></li>
                                                        <li><a href="cart.html">Shopping Cart</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">Author</li>
                                                        <li><a href="author.html">Author Profile</a></li>
                                                        <li><a href="author-items.html">Author Items</a></li>
                                                        <li><a href="author-reviews.html">Customer Reviews</a></li>
                                                        <li><a href="author-followers.html">Followers</a></li>
                                                        <li><a href="author-following.html">Following</a></li>
                                                        <li><a href="notification.html">Notifications</a></li>
                                                        <li><a href="message.html">Message Inbox</a></li>
                                                        <li><a href="message-compose.html">Message Compose</a></li>
                                                        <li><a href="favourites.html">Favorites Items</a></li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">Dashboard</li>
                                                        <li><a href="dashboard.html">Dashboard</a></li>
                                                        <li><a href="dashboard-setting.html">Account Settings</a></li>
                                                        <li><a href="dashboard-purchase.html">Author Purchases</a></li>
                                                        <li><a href="dashboard-add-credit.html">Add Credits</a></li>
                                                        <li><a href="dashboard-statement.html">Statements</a></li>
                                                        <li><a href="invoice.html">Invoice</a></li>
                                                        <li><a href="dashboard-upload.html">Upload Item</a></li>
                                                        <li><a href="dashboard-manage-item.html">Edit Items</a></li>
                                                        <li><a href="dashboard-withdrawal.html">Withdrawals</a></li>
                                                        <li><a href="dashboard-manage-item.html">Manage Items</a></li>
                                                        <li><a href="add-payment-method.html">Add Payment Method</a></li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">Customers</li>
                                                        <li><a href="support-forum.html">Support Forum</a></li>
                                                        <li><a href="support-forum-detail.html">Forum Details</a></li>
                                                        <li><a href="login.html">Login</a></li>
                                                        <li><a href="{{ route('register') }}">Register</a></li>
                                                        <li><a href="recover-pass.html">Recovery Password</a></li>
                                                        <li><a href="customer-dashboard.html">Customer Dashboard</a></li>
                                                        <li><a href="customer-downloads.html">Customer Downloads</a></li>
                                                        <li><a href="customer-info.html">Customer Info</a></li>
                                                    </ul>

                                                    <ul>
                                                        <li class="title">Blog</li>
                                                        <li><a href="blog1.html">Blog V-1</a></li>
                                                        <li><a href="blog2.html">Blog V-2</a></li>
                                                        <li><a href="single-blog.html">Single Blog</a></li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">Other</li>
                                                        <li><a href="how-it-works.html">How It Works</a></li>
                                                        <li><a href="about.html">About Us</a></li>
                                                        <li><a href="pricing.html">Pricing Plan</a></li>
                                                        <li><a href="testimonial.html">Testimonials</a></li>
                                                        <li><a href="faq.html">FAQs</a></li>
                                                        <li><a href="affiliate.html">Affiliates</a></li>
                                                        <li><a href="term-condition.html">Terms &amp; Conditions</a></li>
                                                        <li><a href="event.html">Event</a></li>
                                                        <li><a href="event-detail.html">Event Detail</a></li>
                                                        <li><a href="404.html">404 Error page</a></li>
                                                        <li><a href="carieer.html">Job Posts</a></li>
                                                        <li><a href="job-detail.html">Job Details</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </li>
                                <li><a href="{{ route( 'contact' ) }}">contact</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->

                        <!-- start mainmenu__search -->
                        <div class="mainmenu__search hidden-xs">
                            <form action="#">
                                <div class="searc-wrap">
                                    <input type="text" placeholder="Search product here...">
                                    <button type="submit" class="search-wrap__btn"><span class="lnr lnr-magnifier"></span></button>
                                </div>
                            </form>
                        </div><!-- start mainmenu__search -->
                    </nav>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row-->
        </div><!-- start .container -->
    </div><!-- end /.mainmenu-->
</div>
