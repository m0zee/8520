@extends( 'components.frontend.master' )
@php
    $active = 'requirement';
    @endphp
@section( 'title', 'Buyer Requirements' )
@section( 'content' )

    <section class="single-product-desc">
        <div class="container">
            <div class="row">

                @if( $errors->any() )
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
                            <strong>Message could not be sent. There is an error. Please see the form below.</strong>
                        </div>
                    </div>
                @endif
                
                <div class="col-md-8">


                    <div class="item-preview">
                        <div class="item__preview-slider" style="width:99.9%">
                            <div class="prev-slide">
                                <img id="main_img" src="{{ asset( 'storage/requirement/' . $requirement->img ) }}"  
                                    data-zoom-image="{{ asset( 'storage/requirement/' . $requirement->img ) }}" 
                                    alt="Keep calm this isn't the end of the world, the preview is just missing.">
                            </div>

                        </div>


                    </div>

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
                            
                        <div class="fade in tab-pane product-tab active" id="product-details">
                            <div class="tab-content-wrapper">
                                <h3>Description</h3><br>
                                {!! nl2br( $requirement->description ) !!}
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
                                <li><p class="data-label">Quantity</p><p class="info">{{ $requirement->quantity . ' ' . $requirement->unit->name }}</p></li>
                            </ul>

                        </div><!-- end /.aside -->
                    </aside><!-- end /.aside -->
                    
                </div><!-- end /.col-md-4 -->
            </div><!-- end /.row -->
        </div><!-- end /.container -->
    </section>

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
                                <div class="product__thumbnail">
                                    @if( file_exists( $req->path . '/' . $req->img ) )
                                        <img class="auth-img" src="{{ asset( 'storage/requirement/361x230_' . $req->img ) }}" alt="author image">
                                    @else
                                        <img src="images/p1.jpg" alt="Product Image">
                                    @endif
                                    
                                </div>
                                <div class="product-desc">
                                    <a href="{{ route('requirement.show', [$req->code]) }}" class="product_title"><h4>{{ $req->name }}</h4></a>
                                    <ul class="titlebtm">

                                        <li class="">
                                                <span class="fa fa-folder iconcolor"></span>
                                                <a href="{{ route('categories.requirement', [$req->category->slug]) }}">{{ $req->category->name }}</a>
                                                <span class="lnr lnr-chevron-right"></span>
                                                <span class="fa fa-folder iconcolor"></span>
                                                <a href="{{ route('categories.sub-categories.requirement', [$req->category->slug, $req->sub_category->slug]) }}">{{ $req->sub_category->name }}</a>
                                            </li>

                                    </ul>
                                    <p> <span class="lnr lnr-cart">{{ $req->quantity.' '.$req->unit->name }} Required</p>

                                    <p>{{ $req->description }}</p>
                                </div><!-- end /.product-desc -->

                                <div class="product-purchase text-center">
                                    <div class="price_love">
                                        <a href="{{ route('requirement.show', [$req->code]) }}" class="btn btn--round btn-primary btn-sm">Detail</a>
                                    </div>
                                    <a href="{{ route( 'requirement.show', [ $req->code ] ) . '#message-form' }}" class="btn btn--round btn-warning btn-sm">Contact</a>
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

@endsection