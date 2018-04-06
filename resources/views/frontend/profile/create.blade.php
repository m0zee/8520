    @extends('components.frontend.master')

    @section('title', 'Login')

    <!--================================
        START BREADCRUMB AREA
    =================================-->
    @section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li class="active"><a href="#">Settings</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Author's Settings</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="dashboard-area">
        @include('components.frontend.vendor_menu')

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="dashboard__title">
                                <h3>Create Profile</h3>
                            </div>
                        </div>
                    </div><!-- end /.col-md-12 -->
                </div><!-- end /.row -->

                <form action="#" class="setting_form">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="information_module">
                                <a class="toggle_title" href="#collapse1" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Biling Information <span class="lnr lnr-chevron-down"></span></h4>
                                </a>

                                <div class="information__set toggle_module collapse in" id="collapse1">
                                    <div class="information_wrapper form--fields">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name">Full Name <sup>*</sup></label>
                                                    <input type="text" id="full_name" class="text_field" name="name" placeholder="Full Name" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Company Name<sup>*</sup></label>
                                                <input type="text" id="email" class="text_field" name="company_name" placeholder="Company Name" >
                                            </div>
                                        </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="email1">Email Adress <sup>*</sup></label>
                                            <input type="text" id="email1" disabled="disable" value="{{ $user->email }}" class="text_field" placeholder="Email address">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country">Country <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select('country_id', $country, NULL, ['placeholder' => 'Please Select', 'id' => 'country'] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="state">State <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="state" id="state" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="city">City <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="city" id="city" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" class="text_field" name="address" placeholder="Write your address">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile_number">Mobile Number</label>
                                                    <input type="text" id="mobile_number"  class="text_field" placeholder="Mobile Number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="text" id="phone_number"  class="text_field" placeholder="Phone Number">
                                                </div>  
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" id="cash" name="cash" checked>
                                                        <label for="cash">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Cash</span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" id="cheque" name="cheque" checked>
                                                        <label for="cheque">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Cheque</span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" id="card" name="card" checked>
                                                        <label for="card">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Visa / Master Card</span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->
                        </div><!-- end /.col-md-6 -->

                        <div class="col-md-12">
                            <div class="dashboard_setting_btn">
                                <button type="submit" class="btn btn--round btn--md">Save Change</button>
                            </div>
                        </div><!-- end /.col-md-12 -->
                    </div><!-- end /.row -->
                </form><!-- end /form -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

    @endsection

    @section('js')
    <script src="{{ url( 'js/page/get_state_and_city_dropdown.js' ) }}"></script>
    @endsection