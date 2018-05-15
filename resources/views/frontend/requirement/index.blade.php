@extends( 'components.frontend.master' )
@php
    $active = 'requirement';
    @endphp
@section( 'title', 'Home' )

@section( 'content' )
<!--================================
        START BREADCRUMB AREA
    =================================-->
    {{-- <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route( 'home' ) }}">Home</a></li>
                            <li class="active"><a href="#">Buyer Requirement</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Buyer Requirement</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section> --}}
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START SIGNUP AREA
    =================================-->
    <section class="section--padding2 bgcolor">

        <div class="shortcode_wrapper">
            <div class="container">
                <div class="row">
                @if( $requirement->count() > 0 )
                    @foreach( $requirement as $req )

                        <div class="col-md-4 col-sm-6">
                            <div class="product product--card">

                                <div class="product__thumbnail">
                                    @if( file_exists( $req->path . '/' . $req->img ) )
                                        <img class="auth-img" src="{{ asset( 'storage/requirement/361x230_' . $req->img ) }}" alt="author image">
                                    @else
                                        <img src="images/p1.jpg" alt="Product Image">
                                    @endif
                                    
                                </div><!-- end /.product__thumbnail -->

                                        
                                <div class="product-desc">
                                    <a href="{{ route( 'requirement.show', [ $req->code ] ) }}" class="product_title">
                                        <h4>{{ $req->name }}</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        

                                        <li>
                                            <span class="fa fa-folder iconcolor"></span>
                                            <a href="{{ route( 'categories.requirement', [ $req->category->slug ] ) }}">{{ $req->category->name }}</a>
                                            <span class="lnr lnr-chevron-right"></span>
                                            <span class="fa fa-folder iconcolor"></span>
                                            <a href="{{ route( 'categories.sub-categories.requirement', [ $req->category->slug, $req->sub_category->slug ] ) }}">
                                                {{ $req->sub_category->name }}
                                            </a>
                                        </li>
                                    </ul>

                                    <p> <span class="lnr lnr-cart">{{ $req->quantity . ' ' . $req->unit->name }} Required</p>

                                    <p>{{ $req->description }}</p>
                                </div>

                                <div class="product-purchase text-center">
                                    <div class="price_love">
                                        <a href="{{ route( 'requirement.show', [ $req->code ] ) }}" class="btn btn--round btn-primary btn-sm">Detail</a>
                                    </div>
                                    <a href="{{ route( 'requirement.show', [ $req->code ] ) . '#message-form' }}" class="btn btn--round btn-warning btn-sm">Contact</a>
                                </div>
                            </div>
                        </div>

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