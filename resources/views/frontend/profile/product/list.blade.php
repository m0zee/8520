@extends( 'components.frontend.master' )

@section( 'title', 'Product' )

@php
    $active = 'product'; 
@endphp

@section( 'body_class', 'dashboard-edit' )

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
                            <li><a href="index.html">Home</a></li>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li class="active"><a href="#">Manage Item</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Manage Item</h1>
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
                        <div class="filter-bar dashboard_title_area clearfix filter-bar2">

                            <div class="dashboard__title dashboard__title pull-left">
                                <h3>Manage Items</h3>
                            </div>

                            <div class="pull-right">
                                <div class="filter__option filter--text">
                                    <p><span>{{ $products->count() }}</span> Products</p>
                                </div>

                                {{-- <div class="filter__option filter--select">
                                    <div class="select-wrap">
                                        <select name="price">
                                            <option value="low">Price : Low to High</option>
                                            <option value="high">Price : High to low</option>
                                        </select>
                                        <span class="lnr lnr-chevron-down"></span>
                                    </div>
                                </div> --}}

                                <a href="{{ route('my-account.product.create') }}" class="btn btn-primary btn--round btn-sm">Add Product</a>
                            </div><!-- end /.pull-right -->
                        </div><!-- end /.filter-bar -->
                    </div><!-- end /.col-md-12 -->
                </div><!-- end /.row -->

                <div class="row">
                @if ($products->count() > 0)
                        
                    @foreach ($products as $product)
                        {{-- expr --}}
                    
                    <!-- start .col-md-4 -->
                    <div class="col-md-4 col-sm-6">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">

                            @if (file_exists( $product->img_path.'/'.$product->img ))
                                <img src="{{ asset('storage/product/'.$product->img) }}" alt="Product Image" width="360px" height="229px">
                            @else
                                <img src="{{ asset('images/p1.jpg') }}" alt="Product Image" width="360px" height="229px">

                            @endif

                                <div class="prod_option">
                                    <a href="#" id="drop2" class="dropdown-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="lnr lnr-cog setting-icon"></span>
                                    </a>

                                    <div class="options dropdown-menu" aria-labelledby="drop2">
                                        <ul>
                                            <li><a href="{{ route('my-account.product.edit', [$product->code]) }}"><span class="lnr lnr-pencil"></span>Edit</a></li>
                                            <li><a href="#"><span class="lnr lnr-eye"></span>Hide</a></li>
                                            <li><a href="#" class="delete"><span class="lnr lnr-trash"></span>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- end /.product__thumbnail -->

                            <div class="product-desc">
                                <a href="#" class="product_title"><h4>{{ $product->name }}</h4></a>
                                <ul class="titlebtm">
                                    <li>
                                        <p><b>Ref :</b> {{ $product->code }}</p>
                                    </li>
                                    

                                    <li class="product_cat">
                                        <b>Category:</b> 
                                        {{ $product->sub_category->category->name }}
                                        <span class="lnr lnr-chevron-right"></span>{{ $product->sub_category->name }}
                                    </li>

                                    <li class="product_cat">
                                        <b>Max Supply:</b> 
                                        {{ $product->unit->name }} : 
                                        {{ $product->max_supply }}
                                    </li>
                                </ul>
                            </div><!-- end /.product-desc -->

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>{{ $product->currency->name.' '.$product->price }}</span>
                                </div>
                                @php
                                    if($product->status_id == '1')
                                        $class = 'label-warning';

                                    elseif ($product->status_id == '2') 
                                        $class = 'label-success';

                                    else
                                        $class = 'label-danger';

                                @endphp

                                    <div class="label {{ $class }} price_love">
                                        {{ $product->status->name }}
                                    </div>
                            </div><!-- end /.product-purchase -->
                        </div><!-- end /.single-product -->
                    </div><!-- end /.col-md-4 -->

                    @endforeach

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="pagination-area">
                            <nav class="navigation pagination" role="navigation">
                                <div class="nav-links">
                                    <a class="prev page-numbers" href="#"><span class="lnr lnr-arrow-left"></span></a>
                                    <a class="page-numbers current" href="#">1</a>
                                    <a class="page-numbers" href="#">2</a>
                                    <a class="page-numbers" href="#">3</a>
                                    <a class="next page-numbers" href="#"><span class="lnr lnr-arrow-right"></span></a>
                                </div>
                            </nav>
                        </div><!-- end /.pagination-area -->
                    </div><!-- end /.col-md-12 -->
                </div><!-- end /.row -->

                @else

                    <div class="col-md-12">
                        <div class="alert alert-danger text-center"> No Product Found!</div>
                    </div>

                @endif
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

@endsection