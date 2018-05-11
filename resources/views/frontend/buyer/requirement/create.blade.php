@extends( 'components.frontend.master' )
@php
    $active = 'requirement';
@endphp

@section( 'title', 'Requirements' )
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
                            <li><a href="{{ route( 'buyer.dashboard' ) }}">Dashboard</a></li>
                            <li><a href="{{ route( 'buyer.requirements' ) }}">Buying Requirements</a></li>
                            <li class="active"><a href="#">Create</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Create Buying Requirement</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
        @include( 'components.frontend.buyer_menu' )
    <!--================================
        END BREADCRUMB AREA
    =================================-->

     <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="dashboard-area">

        <div class="dashboard_contents">
            <div class="container">


                <form action="{{ route('buyer.requirements.store') }}" method="POST" class="setting_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="information_module">
                                <a class="toggle_title">
                                    <h4>Create Requirement</h4>
                                </a>

                                <div class="information__set toggle_module">
                                    <div class="information_wrapper form--fields">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-error">
                                                    <label for="name">Requirement</label>
                                                    <input type="text" id="name" name="name" value="{{ old( 'name' ) }}" class="text_field" placeholder="Requirement subject">
                                                    @if( $errors->has( 'name' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'name' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-error">
                                                    <label for="category">Category</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select( 'category_id', $categories, old( 'category_id' ), [ 'placeholder' => 'Please Select', 'id' => 'category_id' ] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if( $errors->has( 'category_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'category_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-error">
                                                    <label for="category">Sub Category</label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="sub_category_id" id="sub_category">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    <input type="hidden" id="sub_category_id" value="{{ old('sub_category_id') }}">
                                                    @if( $errors->has( 'sub_category_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'sub_category_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-error">
                                                    <label for="country">Country <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select( 'country_id', $country,  old( 'country_id' ), [ 'placeholder' => 'Please Select', 'id' => 'country' ] ) }}
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
                                                <div class="form-group has-error">
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
                                                <div class="form-group has-error">
                                                    <label for="city">City <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="city_id" id="city" class="text_field">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                        <input type="hidden" id="hidden_city_id" value="{{ old( 'city_id' ) }}">
                                                    </div>
                                                    @if( $errors->has( 'city_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'city_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group unit-id has-error">
                                                    <label for="name">unit</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select( 'unit_id', $units, old( 'unit_id' ), [ 'placeholder' => 'Select Unit', 'id' => 'unit' ] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if( $errors->has( 'unit_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'unit_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-error">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text" id="quantity" name="quantity" value="{{ old( 'quantity' ) }}" class="text_field" placeholder="ex: 500">
                                                    @if( $errors->has( 'quantity' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'quantity' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group has-error">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="form-gorup text_field" placeholder="Type requirement description here...">{{ old( 'description' ) }}</textarea>

                                                    @if( $errors->has( 'description' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'description' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 information_wrapper">
                                                <div class="profile_image_area has-error">
                                                    

                                                    <label for="img" class="upload_btn">
                                                        <input type="file" id="img" name="img" class="hidden">
                                                        <span class="btn btn--sm btn--round" aria-hidden="true">Upload Image</span>
                                                    </label>
                                                     <div class="img_info">
                                                        <p class="bold">Image</p>
                                                        <p class="subtitle">JPG, JPEG or PNG 750x430px</p>
                                                        <p class="subtitle">Max file size 2mb</p>
                                                    </div>

                                                    @if( $errors->has( 'img' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'img' ) }}</strong>
                                                        </span>
                                                    @endif

                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="new-img" >
                                                <img src="" id="old-img" >
                                            </div>

                                        </div>
                                    </div><!-- end /.information_wrapper -->
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->

                            <div class="dashboard_setting_btn">
                                <button type="submit" class="btn btn--round btn--md">Save</button>
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

@section( 'js' )
<script src="{{ asset('js/page/get_sub_category_by_category.js') }}"></script>
<script src="{{ url( 'js/page/get_state_and_city_dropdown.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery.imagereader-1.0.0.min.js' ) }}"></script>

<script>
    $(function() {
        var base_url = $( '#base_url' ).val();

        // $( '#category' ).on( 'change', function() {
        //     $this = $(this);
        //     get_sub_category($this);
        // });

        $( '.file-upload' ).on( 'change', function() {
            var file_name = $( this ).val().split( '\\' ).pop();
            file_name = ( file_name != '' ) ? file_name : 'No file selected' ;
            $( '.selected_img_name' ).text( file_name );
        });

        // function get_sub_category($this) {
        //     var category_id = $this.val();

        //     $.ajax({
        //         url: base_url + '/get_sub_category',
        //         type: 'POST',
        //         dataType: 'JSON',
        //         data: { category_id: category_id },
        //         success:function (response){
        //             var rows = makeOptions(response);
        //             $( '#sub_category' ).html( rows );
        //         }
        //     });
        // }

        // function makeOptions( response ) {
        //     var row = '<option value="0"> Please Select </options>';
        //     $.each(response, function(index, val) {
        //         row += '<option value="'+val.id+'">' + val.name + '</options>';
        //     });
        //     return row;
        // }

        $( '#img' ).change( function() {
            $( '#old-img' ).css( 'display', 'none' );
        });

        $( '#img' ).imageReader({
            destination: '#new-img'
        });
    });
</script>

@endsection