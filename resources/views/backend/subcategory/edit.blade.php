@extends('components.backend.master')
@php
    $active = 'category';
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
                            <li><a href="{{ route( 'admin.dashboard' ) }}">Dashboard</a></li>
                            <li><a href="{{ route( 'admin.categories.index' ) }}">Categories</a></li>
                            <li><a href="{{ route( 'admin.subcategories.index', [ $category->id ] ) }}">{{ $category->name }}</a></li>
                            <li  class="active"><a href="#">Edit</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Edit Sub Category</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
        @include('components.backend.menu')
    <!--================================
        END BREADCRUMB AREA
    =================================-->

     <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="dashboard-area">

        <div class="dashboard_contents">
            <div class="container">

                <form action="{{ route('admin.subcategories.update', [Request::segment(3), $sub_category->id]) }}" method="POST" class="setting_form">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="information_module">
                                <a class="toggle_title">
                                    <h4>Edit Sub Category</h4>
                                </a>

                                <div class="information__set toggle_module">
                                    <div class="information_wrapper form--fields">
                                        <div class="form-group {{ ($errors->first('name') ) ? 'has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="text_field" placeholder="Category Name" value="{{ old('name', $sub_category->name ) }}">
                                            @if ($errors->first('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                       
                                    </div><!-- end /.information_wrapper -->
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->

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