@extends('components.frontend.master')
@php
    $active = 'contact';
    @endphp
@section('title', 'Home')
@section('content')



    <!--================================
        START AFFILIATE AREA
    =================================-->
    <section class="contact-area section--padding">
        <div class="container">

            @if( session( 'success' ) )
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success text-center">
                            <strong>{{ session( 'success' ) }}</strong>
                        </div>
                    </div>
                </div>
            @endif

            {{-- <div class="row">

                <div class="col-md-12"> --}}

                    <div class="row">
                        <!-- start col-md-12 -->
                        {{-- <div class="col-md-12">
                            <div class="section-title">
                                <h1>How can We <span class="highlighted">Help?</span></h1>
                                <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats. Lid est laborum dolo rumes fugats untras.</p>
                            </div>
                        </div> --}}<!-- end /.col-md-12 -->
                    </div><!-- end /.row -->

                    <div class="row">
                        {{-- <div class="col-md-4">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-map-marker"></span>
                                <h4 class="tiles__title">Office Address</h4>
                                <div class="tiles__content"><p>202 New Hampshire Avenue , Northwest #100, New York-2573</p></div>
                            </div>
                        </div><!-- end /.col-md-4 -->

                        <div class="col-md-4">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-phone"></span>
                                <h4 class="tiles__title">Phone Number</h4>
                                <div class="tiles__content">
                                    <p>1-800-643-4500</p>
                                    <p>1-800-643-4500</p>
                                </div>
                            </div><!-- end /.contact_tile -->
                        </div><!-- end /.col-md-4 -->

                        <div class="col-md-4">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-inbox"></span>
                                <h4 class="tiles__title">Phone Number</h4>
                                <div class="tiles__content">
                                    <p>support@aazztech.com</p>
                                    <p>support@aazztech.com</p>
                                </div>
                            </div><!-- end /.contact_tile -->
                        </div> --}}<!-- end /.col-md-4 -->

                        <div class="col-md-12">
                            <div class="contact_form cardify">
                                <div class="contact_form__title">
                                    <h3>Contact Us</h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="contact_form--wrapper">
                                            {{ Form::open( [ 'route' => 'contact.send' ]) }}
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group has-error">
                                                            {{ Form::text( 'name', old( 'name' ), [ 'id' => 'name', 'placeholder' => 'Name' ] )}}
                                                            @if( $errors->has( 'name' ) )
                                                                <span class="help-block">{{ $errors->first( 'name' ) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group has-error">
                                                            {{ Form::email( 'email', old( 'email' ), [ 'id' => 'email', 'placeholder' => 'Email' ] )}}
                                                            @if( $errors->has( 'email' ) )
                                                                <span class="help-block">{{ $errors->first( 'email' ) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group has-error">
                                                            {{ Form::text( 'contact_number', old( 'contact_number' ), [ 'id' => 'contact_number', 'placeholder' => 'Contact Number' ] )}}
                                                            @if( $errors->has( 'contact_number' ) )
                                                                <span class="help-block">{{ $errors->first( 'contact_number' ) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group has-error">
                                                            <div class="select-wrap select-wrap2">
                                                                {{ Form::select( 'country_id', $countries,  old( 'country_id' ), [ 'placeholder' => 'Please select country', 'id' => 'country' ] ) }}
                                                                <span class="lnr lnr-chevron-down"></span>
                                                            </div>
                                                            @if( $errors->has( 'country_id' ) )
                                                                <span class="help-block">{{ $errors->first( 'country_id' ) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group has-error">
                                                            <div class="select-wrap select-wrap2">
                                                                {{ Form::select( 'state_id', [],  old( 'state_id' ), [ 'placeholder' => 'Please select country first', 'id' => 'state' ] ) }}
                                                                <span class="lnr lnr-chevron-down"></span>
                                                                <input type="hidden" id="hidden_state_id" value="{{ old('state_id') }}">
                                                            </div>
                                                            @if( $errors->has( 'state_id' ) )
                                                                <span class="help-block">{{ $errors->first( 'state_id' ) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group has-error">
                                                            <div class="select-wrap select-wrap2">
                                                                {{ Form::select( 'city_id', [],  old( 'city_id' ), [ 'placeholder' => 'Please selec', 'id' => 'city' ] ) }}
                                                                <span class="lnr lnr-chevron-down"></span>
                                                                <input type="hidden" id="hidden_city_id" value="{{ old( 'city_id' ) }}">
                                                            </div>
                                                            @if( $errors->has( 'city_id' ) )
                                                                <span class="help-block">{{ $errors->first( 'city_id' ) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group has-error">
                                                    {{ Form::textarea( 'message', old( 'message' ), [ 'placeholder' => 'Please enter your message here...', 'id' => 'message', 'style' => 'resize: none;'] ) }}
                                                    @if( $errors->has( 'message' ) )
                                                        <span class="help-block">{{ $errors->first( 'message' ) }}</span>
                                                    @endif
                                                </div>

                                                <div class="sub_btn">
                                                    <button type="submit" class="btn btn--round btn--default">Send Request</button>
                                                </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div><!-- end /.col-md-8 -->
                                </div><!-- end /.row -->

                            </div><!-- end /.contact_form -->
                        </div><!-- end /.col-md-12 -->

                    </div><!-- end /.row -->

                {{-- </div><!-- end /.col-md-12 -->

            </div><!-- end /.row --> --}}
        </div><!-- end /.container -->
    </section>

@endsection

@section( 'js' )
    <script src="{{ url( 'js/page/get_state_and_city_dropdown.js' ) }}"></script>
@endsection