<div class="dashboard_menu_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="dashboard_menu">
                    <li class="{{ ($active == 'dashboard') ? 'active' : ''  }}"><a href="{{ route('admin.dashboard')}}"><span class="lnr lnr-home"></span>Dashboard</a></li>
                    <li class="{{ ($active == 'users') ? 'active' : ''  }}"><a href="{{ route('admin.userlist', ['pamarm1' => 'vendor']) }}"><span class="lnr lnr-users"></span>Users</a></li>
                    <li><a href="{{ route('admin.categories.index') }}"><span class="lnr lnr-dice"></span>Category</a></li>
                    
                    <li><a href="dashboard-purchase.html"><span class="lnr lnr-cart"></span>Purchase</a></li>
                    <li><a href="dashboard-add-credit.html"><span class="lnr lnr-cog"></span>Add Credits</a></li>
                    <li><a href="dashboard-statement.html"><span class="lnr lnr-chart-bars"></span>Statements</a></li>
                    <li><a href="dashboard-upload.html"><span class="lnr lnr-upload"></span>Upload Items</a></li>
                    <li><a href="dashboard-manage-item.html"><span class="lnr lnr-briefcase"></span>Manage Items</a></li>
                    
                </ul><!-- end /.dashboard_menu -->
            </div><!-- end /.col-md-12 -->
        </div><!-- end /.row -->
    </div><!-- end /.container -->
</div><!-- end /.dashboard_menu_area -->