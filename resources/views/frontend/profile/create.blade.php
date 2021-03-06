@extends( 'components.frontend.master' )

@section( 'title', 'Profile' )

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
                            <li><a href="{{ route( 'vendor.dashboard' )}}">Dashboard</a></li>
                            <li class="active"><a href="#">Profile / Create</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Create Profile</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
    <section class="dashboard-area">
        @include( 'components.frontend.vendor_menu' )

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="dashboard__title">
                                <h3>
                                    Create Profile
                                    <a  href="{{ route( 'profile.show', [ 'user_type_id' => Auth::user()->code ] ) }}" 
                                        class="btn btn--round btn--md pull-right">
                                        View as visitor
                                    </a>
                                </h3>
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
                                                    </div>
                                                    @if( $errors->has( 'country_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'country_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group {{ $errors->has('state_id') ? ' has-error' : '' }}">
                                                    <label for="state">State <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="state_id" id="state" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <input type="hidden" id="hidden_state_id" value="{{ old('state_id') }}">
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if( $errors->has( 'state_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'state_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                    <label for="city">City <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="city_id" id="city" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <input type="hidden" id="hidden_city_id" value="{{ old('city_id') }}">
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if( $errors->has( 'city_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'city_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group {{ $errors->has( 'address' ) ? ' has-error' : '' }}">
                                            <label for="address">Address <sup>*</sup></label>
                                            <input type="text" id="address" value="{{ old('address') }}" class="text_field" name="address" placeholder="Write your address">
                                            @if( $errors->has( 'address' ) )
                                                <span class="help-block">
                                                    <strong>{{ $errors->first( 'address' ) }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has( 'mobile_number' ) ? ' has-error' : '' }}">
                                                    <label for="mobile_number">Mobile Number <sup>*</sup></label>
                                                    <input type="text" id="mobile_number" value="{{ old('mobile_number') }}" name="mobile_number" class="text_field" placeholder="Mobile Number">
                                                    @if( $errors->has( 'mobile_number' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'mobile_number' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has( 'mobile_number' ) ? ' has-error' : '' }}">
                                                    <label for="phone_number">Phone Number <sup>*</sup></label>
                                                    <input type="text" id="phone_number" value="{{ old('phone_number') }}" name="phone_number" class="text_field" placeholder="Phone Number">
                                                    @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" value="1" id="cod" name="cod" checked>
                                                        <label for="cod">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">COD<sup>*</sup></span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" value="1" id="cash" name="cash" checked>
                                                        <label for="cash">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Cash<sup>*</sup></span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" value="1" id="cheque" name="cheque" checked>
                                                        <label for="cheque">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Cheque<sup>*</sup></span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="custom_checkbox">
                                                        <input type="checkbox" value="1" id="card" name="card" checked>
                                                        <label for="card">
                                                            <span class="shadow_checkbox"></span>
                                                            <span class="radio_title">Visa / Master Card<sup>*</sup></span>
                                                        </label>
                                                    </div>
                                                </div><!-- end /.custom-radio -->
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('description')  ? ' has-error' : ''}}">
                                            <label for="authbio">Description<sup>*</sup></label>
                                            <textarea name="description" id="authbio" class="text_field" placeholder="Short brief about yourself or your account...">{{ old('description')  }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
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
                                                <p class="bold">Profile Image<sup>*</sup></p>
                                                <p class="subtitle">JPG, JPEG or PNG 100x100 px <br>max size 2MB</p>
                                            </div>

                                            <label for="dp" class="upload_btn">
                                                <input type="file" id="dp" name="profile_img">
                                                <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                            </label>

                                            @if ($errors->has('profile_img'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('profile_img') }}</strong>
                                                </span>
                                            @endif

                                            
                                        </div>

                                        <div class="prof_img_upload">
                                            <p class="bold">Cover Image<sup>*</sup></p>

                                            <div id="new-cover">
                                                <img src="{{ url('images/authcvr.jpg')}}" alt="The great warrior of China" id="old-cover">
                                            </div>


                                            <div  class="upload_title">
                                                <p>JPG, JPEG or PNG 750x370 px <br>max size 2MB</p>
                                                <label for="cover_photo" class="upload_btn">
                                                    <input type="file" id="cover_photo" name="cover_img">
                                                    <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                                </label>
                                                @if ($errors->has('cover_photo'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cover_photo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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