@extends('components.backend.master')
@php
    $active = 'category';
@endphp

@section( 'title', 'Categories')
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
                            <li class="active"><a href="#">Categories</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Categories</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>

    @include( 'components.backend.menu' )
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START SIGNUP AREA
    =================================-->
    <section class="section--padding2 bgcolor">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3 class="pull-left"> Category List</h3>
                                    <a href="{{ route('admin.categories.create') }}" class="pull-right btn btn--round btn-primary btn-sm"><i class="fa fa-plus"></i> Create</a>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Manage</th>
                                            <th>Option</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($categories) && $categories != NULL)
                                                @foreach ($categories as $category)
                                            
                                                
                                            
                                                    <tr>
                                                        <td>{{ $category->name }}</td>
                                                        <td><a href="{{ route('admin.subcategories.index',[ $category->id ]) }}" class="btn btn-primary btn--round btn-sm">Manage</a></td>

                                                        <td>

                                                            <a href="{{ route('admin.categories.edit',[ $category->id ]) }}" class="btn btn-info btn--round btn-sm pull-left"><i class="fa fa-pencil"></i></a>


                                                            <form action="{{ route('admin.categories.destroy', [$category->id]) }}" method="POST">
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                {{csrf_field()}}
                                                                <button class="btn btn-danger btn--round btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section>
    <!--================================
            END SIGNUP AREA
    =================================-->

@endsection