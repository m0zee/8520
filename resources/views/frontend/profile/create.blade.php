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

                <form action="{{ route('profile.store') }}" class="setting_form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">

                            <div class="information_module">
                                <a class="toggle_title" href="#collapse1" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Biling Information <span class="lnr lnr-chevron-down"></span></h4>
                                </a>

                                <div class="information__set toggle_module collapse in" id="collapse1">
                                    <div class="information_wrapper form--fields">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="full_name">Full Name <sup>*</sup></label>
                                                    <input type="text" id="full_name" class="text_field" name="name" placeholder="Full Name" value="{{ $errors->has('name') ? old('name') : $user->name  }}">

                                                     @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                                <label for="email">Company Name<sup>*</sup></label>
                                                <input type="text" id="email" class="text_field" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}">

                                                @if ($errors->has('company_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('company_name') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="email1">Email Adress <sup>*</sup></label>
                                            <input type="text" id="email1" disabled="disable" value="{{ $user->email }}" class="text_field" placeholder="Email address">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
                                                    <label for="country">Country <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select('country_id', $country, NULL, ['placeholder' => 'Please Select', 'id' => 'country'] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                        @if ($errors->has('country_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('country_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('state_id') ? ' has-error' : '' }}">
                                                    <label for="state">State <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="state_id" id="state" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                        @if ($errors->has('state_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('state_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                    <label for="city">City <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="city_id" id="city" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>

                                                        @if ($errors->has('city_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('city_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" class="text_field" name="address" placeholder="Write your address">
                                            @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile_number">Mobile Number</label>
                                                    <input type="text" id="mobile_number" name="mobile_number" class="text_field" placeholder="Mobile Number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="text" id="phone_number" name="phone_number" class="text_field" placeholder="Phone Number">
                                                </div>  
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" value="1" id="cash" name="cash" checked>
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
                                                        <input type="checkbox" value="1" id="cheque" name="cheque" checked>
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
                                                        <input type="checkbox" value="1" id="card" name="card" checked>
                                                        <label for="card">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Visa / Master Card</span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="authbio">Description</label>
                                            <textarea name="description" id="authbio" class="text_field" placeholder="Short brief about yourself or your account..."></textarea>
                                        </div>
                                    </div>
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->
                        </div><!-- end /.col-md-6 -->

                        <div class="col-md-6">
                            <div class="information_module">
                                <a class="toggle_title" href="#collapse3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Profile Image & Cover <span class="lnr lnr-chevron-down"></span></h4>
                                </a>

                                <div class="information__set profile_images toggle_module collapse in" id="collapse3">
                                    <div class="information_wrapper">
                                        <div class="profile_image_area">
                                            <div id="new-dp">
                                                
                                                <img src="{{url('images/authplc.png')}}" alt="Author profile area" id="old-dp" >
                                            </div>
                                            <div class="img_info">
                                                <p class="bold">Profile Image</p>
                                                <p class="subtitle">JPG, GIF or PNG 100x100 px</p>
                                            </div>

                                            <label for="dp" class="upload_btn">
                                                <input type="file" id="dp" name="profile_img">
                                                <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                            </label>
                                        </div>

                                        <div class="prof_img_upload">
                                            <p class="bold">Cover Image</p>

                                            <div id="new-cover">
                                                
                                                <img src="{{ url('images/cvrplc.jpg')}}" alt="The great warrior of China" id="old-cover">
                                            </div>


                                            <div  class="upload_title">
                                                <p>JPG, GIF or PNG 750x370 px</p>
                                                <label for="cover_photo" class="upload_btn">
                                                    <input type="file" id="cover_photo" name="cover_img">
                                                    <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end /.information_module -->

                            <div class="information_module">
                                <a class="toggle_title" href="#collapse5" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Social Profiles <span class="lnr lnr-chevron-down"></span></h4>
                                </a>

                                <div class="information__set social_profile toggle_module collapse in " id="collapse5">
                                    <div class="information_wrapper">
                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-facebook"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" name="facebook" placeholder="ex: www.facebook.com/aazztech">
                                            </div>
                                        </div><!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-twitter"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" name="twitter" placeholder="ex: www.twitter.com/aazztech">
                                            </div>
                                        </div><!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-google-plus"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" name="google_plus" placeholder="ex: www.google.com/aazztech">
                                            </div>
                                        </div><!-- end /.social__single -->

                                        <div class="social__single">
                                            <div class="social_icon">
                                                <span class="fa fa-linkedin"></span>
                                            </div>

                                            <div class="link_field">
                                                <input type="text" class="text_field" name="linked_in" placeholder="ex: www.linkedin.com/m0zee">
                                            </div>
                                        </div><!-- end /.social__single -->


                                    </div><!-- end /.information_wrapper -->
                                </div><!-- end /.social_profile -->
                            </div><!-- end /.information_module -->

                        </div>

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
    <script src="{{ url( 'js/vendor/jquery.imagereader-1.0.0.min.js' ) }}"></script>

    <script>
        $(document).ready(function(){
            $("#dp").change(function (){
                $('#old-dp').css('display', 'none');
             });
            $('#dp').imageReader({
              destination: '#new-dp'
            });


            $("#cover_photo").change(function (){
                $('#old-cover').css('display', 'none');
             });
            $('#cover_photo').imageReader({
              destination: '#new-cover'
            });
      });
    </script>

    @endsection