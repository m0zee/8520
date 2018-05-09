@extends( 'components.frontend.master' )
@php
    $active = 'requirement';
    @endphp
@section( 'title', 'Buyer Requirements' )
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
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('requirement') }}">Requirement</a></li>
                            <li class="active"><a href="#">Show</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{ $requirement->count() > 0 ? $requirement->name : 'Requirement Not Available' }}</h1>
                </div><!-- end /.col-md-12 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section> --}}
    <!--================================
        END BREADCRUMB AREA
    =================================-->


    <!--============================================
        START SINGLE PRODUCT DESCRIPTION AREA
    ==============================================-->
    <section class="single-product-desc">
        <div class="container">
            <div class="row">

                @if( $errors->any() )
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
                            Message could not be sent. There is an error. Please see the form below.
                        </div>
                    </div>
                @endif
                
                <div class="col-md-8">

                    <div class="item-info">

                        <div class="item-navigation">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active">
                                    <a href="#product-details" aria-controls="product-details" role="tab" data-toggle="tab">
                                        <b>{{ $requirement->name }}</b>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- end /.item-navigation -->

                        <ul class="tab-content-wrapper">
                            <li>Unit: {{ $requirement->unit->name }}</li>
                            <li>Quantity: {{ $requirement->quantity }}</li>
                        </ul>
                            
                        <div class="fade in tab-pane product-tab active" id="product-details">
                            <div class="tab-content-wrapper">
                                <h3>Description</h3><br>
                                {{ $requirement->description }}
                            </div>
                        </div><!-- end /.tab-content -->
                       
                    </div><!-- end /.item-info -->

                    <hr>

                    {{ Form::open( [ 'route' => 'messages.store', 'id' => 'message-form' ]) }}

                        <div class="form-group {{ $errors->has( 'message' ) ? 'has-error' : '' }}">
                            {{ Form::label( 'message', 'Your Message' ) }}
                            @if( $errors->has( 'message' ) )
                                <span class="help-block">{{ $errors->first( 'message' ) }}</span>
                            @endif
                            {{
                                Form::textarea( 'message', old( 'message' ), [
                                    'id'            => 'message', 
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Please type your message here...',  
                                    'rows'          => 3,
                                    'style'         => 'resize: none;' 
                                ])
                            }}
                        </div>
                       <div class="text-center">
                           <button class="btn btn--round btn-primary btn-sm">Send</button>
                       </div>

                       {{ Form::hidden( 'requirement_id', $requirement->id ) }}
                       {{ Form::hidden( 'user_id', $requirement->user_id ) }}
                       {{ Form::hidden( 'quantity', $requirement->quantity ) }}

                    {{ Form::close() }}

                </div><!-- end /.col-md-8 -->

                <div class="col-md-4">
                    
                    <aside class="sidebar sidebar--single-product">
                       
                        <div class="sidebar-card card--product-infos">
                            <div class="card-title">
                                <h4>Product Information</h4>
                            </div>

                            <ul class="infos">
                                <li><p class="data-label">Code:</p><p class="info">{{ $requirement->code }} </p></li>
                                <li><p class="data-label">Units</p><p class="info">{{ $requirement->unit->name }}</p></li>
                                <li><p class="data-label">Quantity</p><p class="info">{{ $requirement->quantity }}</p></li>
                                {{-- <li class="text-center">
                                    <a href="" class="btn btn--round btn-warning btn-sm">
                                    Contact
                                </a></li> --}}
                            </ul>

                        </div><!-- end /.aside -->

                        {{-- <div class="author-card sidebar-card ">
                            <div class="card-title">
                                <h4>Contact</h4>
                            </div>

                        </div> --}}<!-- end /.author-card -->
                    </aside><!-- end /.aside -->
                    
                </div><!-- end /.col-md-4 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>
    <!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->

    <!--============================================
        START MORE PRODUCT ARE
    ==============================================-->
    <section class="more_product_area section--padding">
        <div class="container">
            <div class="row">
                <!-- start col-md-12 -->


                <div class="col-md-12">
                    <div class="section-title">
                        <h1>Related <span class="highlighted">Requirement</span></h1>
                    </div>
                </div><!-- end /.col-md-12 -->

                @if( $related_requirement->count() > 0 )
                
                    @foreach( $related_requirement as $req )

                        <div class="col-md-4 col-sm-6">
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
                        </div>
                    
                    @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                No requirement found!
                            </div>
                        </div>
                    @endif


                </div><!-- end /.container -->
            </div><!-- end /.container -->
    </section>
    <!--============================================
        END MORE PRODUCT AREA
    ==============================================-->


@endsection