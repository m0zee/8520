@extends('components.frontend.master')
@php
    $active = 'requirement';
@endphp

@section('title', 'Category')
@section('content')
<!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li><a href="{{ route('admin.categories.index') }}">Category</a></li>
                            <li><a href="{{ route('admin.categories.create') }}">Create</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Category Create</h1>
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


                <form action="{{ route('buyer.requirements.update', [$requirement->code]) }}" method="POST" class="setting_form">
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
                                                <div class="form-group">
                                                    <label for="name">Requirement</label>
                                                    <input type="text" name="name" value="{{ $requirement->name }}" id="name" class="text_field" placeholder="Requirement subject">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">unit</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select('unit_id', $units, $requirement->unit_id, ['placeholder' => 'Select Unit', 'id' => 'unit'] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                    {{-- <input type="text" name="name" id="name" class="text_field" placeholder="unit"> --}}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text" name="quantity" id="quantity" value="{{ $requirement->quantity }}" class="text_field" placeholder="ex: 500">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="form-gorup text_field" placeholder="Type requirement description here...">{{ $requirement->description }}</textarea>
                                                </div>
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