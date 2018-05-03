@extends( 'components.backend.master' )
@php
    $active = '';
@endphp

@section( 'title', 'Change Password' )
@section( 'content' )
    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route( 'admin.dashboard' ) }}">Dashboard</a></li>
                            <li><a href="#">Change Password</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Change Password</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    @include( 'components.backend.menu' )
    
    <section class="dashboard-area">

        <div class="dashboard_contents">
            <div class="container">


                <form action="{{ route( 'password.change.store' ) }}" method="POST" class="setting_form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            
                            @if( session( 'success' ) )
                                <div class="alert alert-success text-center">
                                    <strong>{{ session( 'success' ) }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="lnr lnr-cross" aria-hidden="true"></span>
                                    </button>
                                </div>
                            @elseif( session( 'error' ) )
                                <div class="alert alert-danger text-center">
                                    <strong>{{ session( 'error' ) }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="lnr lnr-cross" aria-hidden="true"></span>
                                    </button>
                                </div>
                            @endif

                            <div class="information_module">
                                <a class="toggle_title">
                                    <h4>Change Your Password</h4>
                                </a>

                                <div class="information__set toggle_module">
                                    <div class="information_wrapper form--fields">
                                        <div class="form-group has-error">
                                            {{ Form::label( 'currentPassword', 'Current Password' ) }}
                                            {{ Form::password( 'currentPassword', [ 'id' => 'currentPassword', 'class' => 'text_field', 'placeholder' => 'Enter your current password' ] ) }}
                                            @if( $errors->has( 'currentPassword' ) )
                                                <span class="help-block">{{ $errors->first( 'currentPassword' ) }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group has-error">
                                            {{ Form::label( 'newPassword', 'New Password' ) }}
                                            {{ Form::password( 'newPassword', [ 'id' => 'newPassword', 'class' => 'text_field', 'placeholder' => 'Enter new password' ] ) }}
                                            @if( $errors->has( 'newPassword' ) )
                                                <span class="help-block">{{ $errors->first( 'newPassword' ) }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group has-error">
                                            {{ Form::label( 'confirmPassword', 'Confirm Password' ) }}
                                            {{ Form::password( 'confirmPassword', [ 'id' => 'confirmPassword', 'class' => 'text_field', 'placeholder' => 'Enter confirm password' ] ) }}
                                            @if( $errors->has( 'confirmPassword' ) )
                                                <span class="help-block">{{ $errors->first( 'confirmPassword' ) }}</span>
                                            @endif
                                        </div>
                                       
                                    </div><!-- end /.information_wrapper -->
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->

                            <div class="dashboard_setting_btn">
                                <button type="submit" class="btn btn--round btn--md">Change</button>
                            </div>
                        </div><!-- end /.col-md-12 -->
                    </div><!-- end /.row -->
                </form><!-- end /form -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>

@endsection