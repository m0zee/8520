@extends('components.backend.master')
@php
    $active = 'products';
@endphp

@section('title', 'Products')
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
                            <li class="active"><a href="#">Products</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Products</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    
        @include('components.backend.menu')
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
                                    <h3 class="pull-left"> Products List</h3>
                                    {{-- <a href="{{ route('admin.products.create') }}" class="pull-right btn btn--round btn-primary btn-sm"><i class="fa fa-plus"></i> Create</a> --}}
                                    <div style="clear:both"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Vendor</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($products) && $products != NULL)
                                                @foreach ($products as $product)

                                                    <tr>
                                                        <td><a href="{{ route('admin.products.show', [$product->code]) }}">{{ $product->name }}</a></td>

                                                        <td>{{ $product->user->detail->company_name }}</td>
                                                        <td>{{ $product->category->name }}</td>
                                                        <td>{{ $product->sub_category->name }}</td>
                                                        <td>
                                                            @if( $product->status_id == 1 )
                                                                <span class="label label-warning">{{ $product->status->name }}</span>
                                                            @elseif( $product->status_id == 2 )
                                                                <span class="label label-success">{{ $product->status->name }}</span>
                                                            @elseif( $product->status_id == 3 )
                                                                <span class="label label-danger">{{ $product->status->name }}</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <form action="{{ route('admin.products.status',[ $product->id, 'approve' ]) }}" method="POST">
                                                                <input name="_method" type="hidden" value="PUT">
                                                                {{csrf_field()}}
                                                                <button class="btn btn-success  btn--round btn-sm tip" title="Click to approve this product" type="submit"><span class="fa fa-check"></span></button>
                                                            </form>


                                                            <form action="{{ route('admin.products.status',[ $product->id, 'reject' ]) }}" method="POST">
                                                                <input name="_method" type="hidden" value="PUT">
                                                                {{csrf_field()}}
                                                                <button class="btn btn-danger btn--round btn-sm tip" title="Click to reject this tip product" type="submit"><span class="fa fa-times"></span></button>
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