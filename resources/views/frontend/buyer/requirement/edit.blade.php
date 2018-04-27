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
                            <li class="active"><a href="#">Edit</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Edit Your Buying Requirement</h1>
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


                <form action="{{ route( 'buyer.requirements.update', [ $requirement->code ] ) }}" method="POST" class="setting_form" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="information_module">
                                <a class="toggle_title">
                                    <h4>Edit Requirement</h4>
                                </a>

                                <div class="information__set toggle_module">
                                    <div class="information_wrapper form--fields">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-error">
                                                    <label for="name">Requirement</label>
                                                    <input type="text" name="name" value="{{ old( 'name', $requirement->name ) }}" id="name" class="text_field" placeholder="Requirement subject">
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
                                                        {{ Form::select( 'category_id', $categories, old( 'category_id', $requirement->category_id ), 
                                                            [ 'placeholder' => 'Please Select', 'id' => 'category' ]
                                                        ) }}
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
                                                        {{ Form::select( 'sub_category_id', [], old( 'sub_category_id', $requirement->sub_category_id ), 
                                                            [ 'placeholder' => 'Please Select', 'id' => 'sub_category' ]
                                                        ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    <input type="hidden" id="sub_category_id" value="{{ old( 'sub_category_id', $requirement->sub_category_id ) }}">
                                                    @if( $errors->has( 'category_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'category_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group has-error">
                                                    <label for="country">Country <sup>*</sup></label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select('country_id', $country,  old( 'country_id', $requirement->country_id ), 
                                                            [ 'placeholder' => 'Please Select', 'id' => 'country' ]
                                                        ) }}
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
                                                        <input type="hidden" id="hidden_state_id" value="{{ old('state_id', $requirement->state_id ) }}">
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
                                                        <input type="hidden" id="hidden_city_id" value="{{ old( 'city_id', $requirement->city_id ) }}">
                                                    </div>
                                                    @if( $errors->has( 'city_id' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'city_id' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-error">
                                                    <label for="name">unit</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select( 'unit_id', $units, old( 'unit_id', $requirement->unit_id ), 
                                                            [ 'placeholder' => 'Please select', 'id' => 'unit' ]
                                                        ) }}
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
                                                    <input type="text" name="quantity" id="quantity" value="{{ old( 'quantity', $requirement->quantity ) }}" class="text_field" placeholder="ex: 500">

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
                                                    <textarea name="description" id="description" cols="30" rows="10" class="form-gorup text_field" placeholder="Type requirement description here...">{{ old( 'description', $requirement->description ) }}</textarea>

                                                    @if( $errors->has( 'description' ) )
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first( 'description' ) }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>





                                            <div class="col-md-6 information_wrapper">
                                                <div class="profile_image_area">

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
                                                <div class="alert alert-info text-center">
                                                    Followin is the current image. If you do not want to change the image, please do not select any image.
                                                </div>
                                                <img src="{{ ( $requirement->img != null ) ? asset( 'storage/requirement/' . $requirement->img ) : '' }}" id="old-img" >
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

@section('js')
<script src="{{ asset('js/page/get_sub_category_by_category.js') }}"></script>
<script src="{{ url( 'js/page/get_state_and_city_dropdown.js' ) }}"></script>
<script src="{{ url( 'js/vendor/jquery.imagereader-1.0.0.min.js' ) }}"></script>

<script>
    $.requirement = $.requirement || {};

    $(function() {
        $.requirement.dropdownCategory      = $( '#category' );
        $.requirement.dropdownSubCategory   = $( '#sub_category' );

        $.requirement.baseUrl               = $( '#base_url' ).val();



        $.requirement.dropdownCategory.on( 'change', function() {
            $.requirement.getSubCategories( $( this ).val() );
        });

        // $.requirement.getSubCategories( $.requirement.dropdownCategory.val() );

        $( '.file-upload' ).on( 'change', function() {
            var file_name = $( this ).val().split( '\\' ).pop();
            file_name = ( file_name != '' ) ? file_name : 'No file selected' ;
            $( '.selected_img_name' ).text( file_name );
        });

        

        $( '#img' ).change( function() {
            $( '#old-img' ).css( 'display', 'none' );
        });

        $( '#img' ).imageReader({
            destination: '#new-img'
        });
    });

    $.requirement.getSubCategories = function( categoryId ) {
        if( categoryId != undefined && categoryId != 0 ) {
            $.ajax({
                url:        $.requirement.baseUrl + '/get_sub_category',
                type:       'POST',
                dataType:   'JSON',
                data: { category_id: categoryId },
                success: function( res ){
                    var _options = $.requirement.makeOptions( res );
                     $.requirement.dropdownSubCategory.html( _options );
                }
            });
        }
    };

    $.requirement.makeOptions = function( data ) {
        var row = '<option value="0"> Please Select </options>';

        $.each( data, function( index, val ) {
            row += '<option value="' + val.id + '">' + val.name + '</options>';
        });

        return row;
    };
</script>

<script src="{{ asset('js/page/get_sub_category_by_category.js') }}"></script>

@endsection