@extends('components.frontend.master')
@php
    $active = 'requirement';
    @endphp
@section('title', 'Home')
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
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active"><a href="#">Buyer Requirement</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Buyer Requirement</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START SIGNUP AREA
    =================================-->
    <section class="section--padding2 bgcolor">

        <div class="shortcode_wrapper">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="shortcode_module_title">
                            <div class="dashboard__title">
                                <h3>Product View 1</h3>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                @if ($requirement->count() > 0 )
                    {{-- expr --}}
                
                    @foreach ($requirement as $req)

                    <!-- start .col-md-4 -->
                    <div class="col-md-4 col-sm-6">
                        <!-- start .single-product -->
                        <div class="product product--card">
                            <div class="product-desc">
                                <a href="{{ route('requirement.show', [$req->code]) }}" class="product_title"><h4>{{ $req->name }}</h4></a>
                                <ul class="titlebtm">
                                    <li>
                                        <img class="auth-img" src="{{ asset('images/auth.jpg') }}" alt="author image">
                                        <p><a href="#">{{ $req->user->name }}</a></p>
                                    </li>

                                    <li class="">
                                            <a href="{{ route('categories.requirement', [$req->category->slug]) }}">{{ $req->category->name }}</a>
                                            <span class="lnr lnr-chevron-right"></span><a href="{{ route('categories.sub-categories.requirement', [$req->category->slug, $req->sub_category->slug]) }}">{{ $req->sub_category->name }}</a>
                                        </li>

                                </ul>
                                <p> <span class="lnr lnr-cart">{{ $req->quantity.' '.$req->unit->name }} Required</p>

                                <p>{{ $req->description }}</p>
                            </div><!-- end /.product-desc -->

                            <div class="product-purchase text-center">
                                <div class="price_love">
                                    <a href="{{ route('requirement.show', [$req->code]) }}" class="btn btn--round btn-primary btn-sm">Detail</a>
                                </div>
                                <a href="" class="btn btn--round btn-warning btn-sm">Contact</a>
                                {{-- <div class="sell"><p><span class="lnr lnr-cart"></span><span>16</span></p></div> --}}
                            </div><!-- end /.product-purchase -->
                        </div><!-- end /.single-product -->
                    </div><!-- end /.col-md-4 -->
                    
                    @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                No requirement found!
                            </div>
                        </div>
                    @endif
                </div><!-- end .row -->
            </div><!-- end /.container -->
        </div>
    </section>
    <!--================================
            END SIGNUP AREA
    =================================-->
@endsection