@extends( 'components.backend.master' )

@php  $active = 'requirement';  @endphp

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
                            <li><a href="{{ route( 'admin.dashboard' ) }}">Dashboard</a></li>
                            <li class="active"><a href="#">Requirements</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Requirements</h1>
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
    @include('components.backend.menu')

    <section class="dashboard-area">
        <div class="dashboard_contents">
            <div class="container">
                <form action="{{ route( 'admin.requirements.status', [ $requirement->id ] ) }}" method="POST">
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
                                            
                                            @if( $requirement->img != null && $requirement->img != '' )
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <img src="{{ asset( 'storage/requirement/361x230_' . $requirement->img ) }}" class="img-responsive">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                <div class="form-group {{ ( $errors->first( 'name' ) ) ? 'has-error' : '' }}">
                                                    <label for="name">Requirement</label>
                                                    <input type="text" name="name" value="{{ old( 'name', $requirement->name ) }}" id="name" class="text_field" 
                                                    placeholder="Requirement subject">
                                                    @if( $errors->has( 'name' ) )
                                                        <span class="help-block"><strong>{{ $errors->first( 'name' ) }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has( 'category_id' ) ? 'has-error' : '' }}">
                                                    <label for="category">Category</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select( 'category_id', $category, old( 'category_id', $requirement->category_id ), [ 'placeholder' => 'Please Select', 'id' => 'category_id' ] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    @if ( $errors->has( 'category_id' ) )
                                                        <span class="help-block"><strong>{{ $errors->first( 'category_id' ) }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has( 'sub_category_id' ) ? 'has-error' : '' }}">
                                                    <label for="sub_category">Sub Category</label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="sub_category_id" class="text_field" id="sub_category">
                                                            <option value="">Please Select</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                        <input type="hidden" value="{{ old( 'sub_category_id', $requirement->sub_category_id ) }}" id="sub_category_id">
                                                    </div>
                                                    
                                                    @if ( $errors->has('sub_category_id'))
                                                        <span class="help-block"><strong>{{ $errors->first( 'sub_category_id' ) }}</strong></span>
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
                                                <div class="form-group {{ $errors->has( 'unit_id' ) ? 'has-error' : '' }}">
                                                    <label for="name">unit</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select( 'unit_id', $units, old( 'unit_id', $requirement->unit_id ), [ 'placeholder' => 'Select Unit', 'id' => 'unit' ] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>

                                                    @if ( $errors->has('unit_id'))
                                                        <span class="help-block"><strong>{{ $errors->first( 'unit_id' ) }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has( 'quantity' ) ? 'has-error' : '' }}">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text" name="quantity" id="quantity" value="{{ old( 'quantity', $requirement->quantity ) }}" 
                                                    class="text_field" placeholder="ex: 500">
                                                </div>

                                                @if ( $errors->has('quantity'))
                                                    <span class="help-block"><strong>{{ $errors->first( 'quantity' ) }}</strong></span>
                                                @endif
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has( 'description' ) ? 'has-error' : ''  }}">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="form-gorup text_field" 
                                                        placeholder="Type requirement description here...">{{ old( 'description', $requirement->description ) }}</textarea>

                                                    @if( $errors->has( 'description' ) )
                                                        <span class="help-block"><strong>{{ $errors->first( 'description' ) }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- end /.information_wrapper -->
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->

                            <div class="dashboard_setting_btn">
                                <input type="submit" value="Approve" name="status" class="btn btn--round btn-success btn-sm">

                                <input type="submit" value="Reject" name="status" class="btn btn--round btn-danger btn-sm">
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
    <script src="{{ asset( 'js/page/get_sub_category_by_category.js' ) }}"></script>
    <script src="{{ url( 'js/page/get_state_and_city_dropdown.js' ) }}"></script>
@endsection