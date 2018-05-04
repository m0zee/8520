@extends( 'components.frontend.master' )
@php
    $active = 'product'; 
@endphp
@section( 'title', 'Products' )

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
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Add Your Product</h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end /.col-md-12 -->
                </div><!-- end /.row -->

                <div class="row">
                    <div class="col-md-12 col-sm-7">

                        <div id="errorMessageContainer"></div>

                        <form action="{{ route('my-account.product.store') }}" method="post" enctype="multipart/form-data" id="product_form">
                            <div class="upload_modules">
                                <div class="modules__title">
                                    <h3>Product Name & Description</h3>
                                </div><!-- end /.module_title -->

                                <div class="modules__content">

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="category">Category</label>
                                                <div class="select-wrap select-wrap2">
                                                    {{ Form::select( 'category_id', $categories, null, [ 'placeholder' => 'Please Select', 'id' => 'category_id' ] ) }}
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="sub_category_id">Sub Category</label>
                                                <div class="select-wrap select-wrap2">
                                                    <select name="sub_category_id" id="sub_category_id">
                                                        <option value>Please Select</option>
                                                    </select>
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="brand_name">Brand Name <span>(Max 100char)</span></label>
                                                <input type="text" id="brand_name" name="brand_name" class="text_field" placeholder="Brand Name">
                                            </div>
                                       </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="name">Product Name <span>(Max 100char)</span></label>
                                                <input type="text" id="name" class="text_field" name="name" placeholder="Product Name">
                                            </div>
                                       </div>

                                    </div>

                                    
                                    <div class="form-group">
                                        <div class="form-group has-error">
                                            <label for="country_id">Made in</label>
                                            <div class="select-wrap select-wrap2">
                                                {{ Form::select( 'country_id', $countries, null, [ 'placeholder' => 'Please Select', 'id' => 'country_id' ] ) }}
                                                <span class="lnr lnr-chevron-down"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="unit_id">Max Supplies</label>
                                                <div class="select-wrap select-wrap2">
                                                    {{ Form::select( 'unit_id', $units, null, [ 'placeholder' => 'Select Unit', 'id' => 'unit_id' ] ) }}
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="max_supply">&nbsp;</label>
                                                <input type="text" name="max_supply" id="max_supply" class="text_field" placeholder="Enter quantity">
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="currency_id">Amount</label>
                                                <div class="select-wrap select-wrap2">
                                                    {{ Form::select( 'currency_id', $currencies, null, [ 'placeholder' => 'Select Currency', 'id' => 'currency_id' ] ) }}
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-error">
                                                <label for="price">&nbsp;</label>
                                                <input type="text" name="price" id="price" class="text_field" placeholder="Enter amount">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group no-margin has-error">
                                        <p class="label">Product Description</p>
                                        <textarea name="description" class="form-control" id="trumbowyg-demo" cols="30" rows="10"></textarea>
                                    </div>
                                </div><!-- end /.modules__content -->
                            </div><!-- end /.upload_modules -->

                            <div class="upload_modules module--upload">
                                <div class="modules__title">
                                    <h3>Upload Files</h3>
                                </div><!-- end /.module_title -->

                                <div class="modules__content">
                                    <div class="form-group">
                                        <div class="upload_wrapper">
                                            <p>Product Image <span>(JPEG or PNG 750x430px)</span></p>

                                            <div class="custom_upload">
                                                <label for="thumbnail">
                                                    <input type="file" name="__files[]" id="thumbnail" class="files file-upload">
                                                    <span class="btn btn--round btn--sm">Choose File</span>
                                                </label>
                                            </div><!-- end /.custom_upload -->

                                            <div class="progress_wrapper">
                                                <div class="labels clearfix">
                                                    <p class="selected_img_name">No file selected</p>
                                                    <span data-width="89" id="progress-status">0%</span>
                                                </div>
                                                <div class="progress hidden" id="progress-wrp">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                                        <span class="sr-only status">70% Complete</span>
                                                    </div>
                                                </div>
                                            </div><!-- end /.progress_wrapper -->

                                        </div><!-- end /.upload_wrapper -->
                                        
                                        <div id="output"></div>

                                        <hr>

                                        <div id="product_img" class="col-md-2 col-md-offset-5"></div>
                                        <div class="clearfix"></div>
                                    </div><!-- end /.form-group -->


                                </div><!-- end /.upload_modules -->
                            </div><!-- end /.upload_modules -->


                            <!-- submit button -->
                            <button type="submit" class="btn btn--round btn--fullwidth btn--lg">Submit Your Item for Review</button>
                        </form>
                        {{ Form::hidden( 'redirectionUrl', route( 'my-account.product' ), [ 'id' => 'redirectionUrl' ] ) }}
                    </div><!-- end /.col-md-8 -->

                  {{--   <div class="col-md-4 col-sm-5">
                        <aside class="sidebar upload_sidebar">
                            <div class="sidebar-card">
                                <div class="card-title">
                                    <h3>Quick Upload  Rules</h3>
                                </div>

                                <div class="card_content">
                                    <div class="card_info">
                                        <h4>Image Upload</h4>
                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent there pharetra, justo ut sceleris que the mattis interdum.</p>
                                    </div>

                                    <div class="card_info">
                                        <h4>File Upload</h4>
                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent there pharetra, justo ut sceleris que the mattis interdum.</p>
                                    </div>

                                    <div class="card_info">
                                        <h4>Vector Upload</h4>
                                        <p>Nunc placerat mi id nisi interdum mollis. Praesent there pharetra, justo ut sceleris que the mattis interdum.</p>
                                    </div>
                                </div>
                            </div><!-- end /.sidebar-card -->

                            <div class="sidebar-card">
                                <div class="card-title">
                                    <h3>Trouble Uploading?</h3>
                                </div>

                                <div class="card_content">
                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut sceler isque the mattis, leo quam aliquet congue.</p>
                                    <ul>
                                        <li>Consectetur elit, sed do eiusmod the
                                            labore et dolore magna.</li>
                                        <li>Consectetur elit, sed do eiusmod the
                                            labore et dolore magna.</li>
                                        <li>Consectetur elit, sed do eiusmod the
                                            labore et dolore magna.</li>
                                        <li>Consectetur elit, sed do eiusmod the</li>
                                    </ul>
                                </div>
                            </div><!-- end /.sidebar-card -->

                            <div class="sidebar-card">
                                <div class="card-title">
                                    <h3>More Upload Info</h3>
                                </div>

                                <div class="card_content">
                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut sceler isque the mattis, leo quam aliquet congue.</p>
                                    <ul>
                                        <li>Consectetur elit, sed do eiusmod the
                                            labore et dolore magna.</li>
                                        <li>Consectetur elit, sed do eiusmod the
                                            labore et dolore magna.</li>
                                        <li>Consectetur elit, sed do eiusmod the
                                            labore et dolore magna.</li>
                                        <li>Consectetur elit, sed do eiusmod the</li>
                                    </ul>
                                </div>
                            </div><!-- end /.sidebar-card -->
                        </aside><!-- end /.sidebar -->
                    </div> --}}<!-- end /.col-md-4 -->
                </div><!-- end /.row -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

@endsection

@section( 'js' )
    <script src="{{ asset( 'js/vendor/jquery.imagereader-1.0.0.min.js' ) }}"></script>
    <script src="{{ asset( 'js/vendor/jquery-validation/jquery.validate.min.js' ) }}"></script>
    <script src="{{ asset( 'js/page/frontend/products/create.js' ) }}"></script>
@endsection