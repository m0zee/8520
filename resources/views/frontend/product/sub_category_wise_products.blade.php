@extends('components.frontend.master')

@section('title', 'Home')
@section('content')



    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="products section--padding2">
        <!-- start container -->
        <div class="container">

            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-md-3">
                    <!-- start aside -->
                    <aside class="sidebar product--sidebar">
                       {{--  <div class="sidebar-card card--category">
                            <a class="card-title" href="#collapse1" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="collapse1">
                                <h4 >Categories <span class="lnr lnr-chevron-down"></span></h4>
                            </a>
                            <div class="collapse in collapsible-content" id="collapse1">
                                <ul class="card-content">
                                    @if ($categories->sub_category->count() > 0)
                                    @foreach ($categories->sub_category as $category)
                                    
                                        <li><a href="{{ 'categories/'.$category->slug }}"><span class="lnr lnr-chevron-right"></span>{{ $category->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div><!-- end /.collapsible_content -->
                        </div><!-- end /.sidebar-card --> --}}

                        <div class="sidebar-card card--filter">
                            <a class="card-title" href="#collapse2" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="collapse2">
                                <h4>Filter Products<span class="lnr lnr-chevron-down"></span></h4>
                            </a>
                            <div class="collapse in collapsible-content" id="collapse2">
                                <ul class="card-content">
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt1" class="" name="filter_opt"> <label for="opt1"><span class="circle"></span>Trending Products</label></div></li>
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt2" class="" name="filter_opt"> <label for="opt2"><span class="circle"></span>Popular Products</label></div></li>
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt3" class="" name="filter_opt"> <label for="opt3"><span class="circle"></span>New Products</label></div></li>
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt4" class="" name="filter_opt"> <label for="opt4"><span class="circle"></span>Best Seller</label></div></li>
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt5" class="" name="filter_opt"> <label for="opt5"><span class="circle"></span>Best Rating</label></div></li>
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt6" class="" name="filter_opt"> <label for="opt6"><span class="circle"></span>Free Support</label></div></li>
                                <li><div class="custom-checkbox2"><input type="checkbox" id="opt7" class="" name="filter_opt"> <label for="opt7"><span class="circle"></span>On Sale</label></div></li>
                            </ul>
                            </div>
                        </div><!-- end /.sidebar-card -->
    
                       {{--  <div class="sidebar-card card--slider">
                                <a class="card-title" href="#collapse3" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="collapse3">
                                    <h4>Filter Products<span class="lnr lnr-chevron-down"></span></h4>
                                </a>
                                <div class="collapse in collapsible-content" id="collapse3">
                                    <div class="card-content">
                                        <div class="range-slider price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 6%; width: 54%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 6%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 60%;"></span></div>

                                        <div class="price-ranges">
                                            <span class="from rounded">$30</span>
                                            <span class="to rounded">$300</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}<!-- end /.sidebar-card -->
                        </aside><!-- end aside -->
                </div><!-- end /.col-md-3 -->

                <!-- start col-md-9 -->
                <div class="col-md-9">
                    <div class="row">
                        @if ($sub_category_products->product->count() > 0 )
                             @foreach ($sub_category_products->product as $product)
                            
                                <div class="col-md-4 col-sm-4">
                                    <!-- start .single-product -->
                                    <div class="product product--card product--card-small">

                                        <div class="product__thumbnail">
                                            @if (file_exists($product->img_path.'/'.$product->img))
                                                <img class="auth-img" src="{{ asset('storage/product/'.$product->img) }}" alt="author image">
                                            @else
                                                <img src="images/p1.jpg" alt="Product Image">
                                            @endif
                                            
                                            <div class="prod_btn">
                                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                                <a href="{{ route('profile.show', [$product->user->code]) }}" class="transparent btn--sm btn--round">Contact</a>
                                            </div><!-- end /.prod_btn -->
                                        </div><!-- end /.product__thumbnail -->

                                        <div class="product-desc">
                                            <a href="#" class="product_title"><h4>{{ $product->name }}</h4></a>
                                            <ul class="titlebtm">
                                                <li>
                                                    @if (file_exists($product->user->detail->profile_path.'/'.$product->user->detail->profile_img))
                                                        <img class="auth-img" src="{{ asset('storage/profile_img/'.$product->user->detail->profile_img) }}" alt="author image">
                                                    @else
                                                        <img class="auth-img" src="images/auth.jpg" alt="author image">
                                                    @endif
                                                    <p><a href="{{ route('profile.show', [$product->user->code]) }}">{{ $product->user->detail->company_name }}</a></p>
                                                </li>
                                                <br>
                                                <li class="">
                                                    <a href="{{ route('categories.products', [$product->sub_category->category->slug]) }}">{{ $product->sub_category->category->name }}</a>
                                                    <span class="lnr lnr-chevron-right"></span><a href="{{ route('categories.sub-categories.products', [$product->sub_category->category->slug, $product->sub_category->slug]) }}">{{ $product->sub_category->name }}</a>
                                                </li>

                                                <li>
                                                    <strong>Price : </strong>{{ $product->currency->name }} {{ $product->price }}</a>
                                                </li>
                                            </ul>

                                        </div><!-- end /.product-desc -->

                                        <div class="product-purchase text-center">
                                            <button class="btn--icon my-btn btn--round">
                                                <span class="lnr lnr-list"></span> More Info
                                            </button>

                                            <button class="btn--icon my-btn btn--round">
                                                <span class="lnr lnr-envelope"></span> Contact
                                            </button>
                                        </div><!-- end /.product-purchase -->
                                    </div><!-- end /.single-product -->
                                </div><!-- end /.col-md-4 -->
                            @endforeach

                        
                    </div>
                    
                </div><!-- end /.col-md-9 -->
            </div><!-- end /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area categorised_item_pagination">
                        <nav class="navigation pagination" role="navigation">
                            <div class="nav-links">
                                <a class="prev page-numbers" href="#"><span class="lnr lnr-arrow-left"></span></a>
                                <a class="page-numbers current" href="#">1</a>
                                <a class="page-numbers" href="#">2</a>
                                <a class="page-numbers" href="#">3</a>
                                <a class="next page-numbers" href="#"><span class="lnr lnr-arrow-right"></span></a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div><!-- end /.row -->
            @else
            <div class="alert alert-danger text-center">
                No Product Found!
            </div>
            @endif
        </div><!-- end /.container -->

    </section>
    <!--================================
        END PRODUCTS AREA
    =================================-->


    <!--================================
        START CALL TO ACTION AREA
    =================================-->
    <section class="call-to-action bgimage">
        <div class="bg_image_holder">
            <img src="images/calltobg.jpg" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-wrap">
                        <h1 class="text--white">Ready to Join Our Marketplace!</h1>
                        <h4 class="text--white">Over 25,000 designers and developers trust the MartPlace.</h4>
                        <a href="#" class="btn btn--lg btn--round btn--white callto-action-btn">Join Us Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================
        END CALL TO ACTION AREA
    =================================-->


  








<!--================================
    END CALL TO ACTION AREA
=================================-->
@endsection