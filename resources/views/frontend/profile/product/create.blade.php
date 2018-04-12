@extends( 'components.frontend.master' )

@section( 'title', 'Product' )

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
                    <div class="col-md-8 col-sm-7">
                        <form action="{{ route('my-account.product.store') }}" method="post" enctype="multipart/form-data" id="product_form">
                            <div class="upload_modules">
                                <div class="modules__title">
                                    <h3>Product Name & Description</h3>
                                </div><!-- end /.module_title -->

                                <div class="modules__content">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="category">Category</label>
                                                <div class="select-wrap select-wrap2">
                                                    {{ Form::select('category_id', $categories, NULL, ['placeholder' => 'Please Select', 'id' => 'category'] ) }}
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="category">Sub Category</label>
                                                <div class="select-wrap select-wrap2">
                                                    <select name="sub_category_id" id="sub_category">
                                                        <option value="0">Please Select</option>
                                                    </select>
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <div class="row">
                                           <div class="col-md-6">
                                                <label for="brand_name">Brand Name <span>(Max 100 characters)</span></label>
                                               <input type="text" id="brand_name" name="brand_name" class="text_field" placeholder="Enter your brand name here...">
                                           </div>
                                           <div class="col-md-6">
                                               <label for="product_name">Product Name <span>(Max 100 characters)</span></label>
                                        <input type="text" id="product_name" class="text_field" name="name" placeholder="Enter your product name here...">
                                           </div>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Made in</label>
                                        <div class="select-wrap select-wrap2">
                                            {{ Form::select('country_id', $countries, NULL, ['placeholder' => 'Please Select', 'id' => 'country'] ) }}
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            
                                                <div class="col-md-3">
                                                    <label for="category">Max Supplies</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select('unit_id', $units, NULL, ['placeholder' => 'Select Unit', 'id' => 'unit'] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="category">&nbsp;</label>
                                                    <input type="text" name="max_supply" class="text_field" placeholder="Enter quantity">
                                                </div>

                                            
                                                <div class="col-md-3">
                                                    <label for="category">Amount</label>
                                                    <div class="select-wrap select-wrap2">
                                                        {{ Form::select('currency_id', $currencies, NULL, ['placeholder' => 'Select Currency', 'id' => 'country'] ) }}
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="category">&nbsp;</label>
                                                    <input type="text" name="price" class="text_field" placeholder="Enter amount">
                                                </div>
                                            

                                        </div>
                                    </div>


                                    <div class="form-group no-margin">
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
                                            <p>Product Image <span>(JPEG or PNG 100x100px)</span></p>

                                            <div class="custom_upload">
                                                <label for="thumbnail">
                                                    <input type="file" name="__files[]" id="thumbnail" class="files">
                                                    <span class="btn btn--round btn--sm">Choose File</span>
                                                </label>
                                            </div><!-- end /.custom_upload -->

                                            <div class="progress_wrapper">
                                                <div class="labels clearfix">
                                                    <p>Thumbnail.jpg</p>
                                                    <span data-width="89" id="progress-status">0%</span>
                                                </div>
                                                <div class="progress" id="progress-wrp">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                                        <span class="sr-only status">70% Complete</span>
                                                    </div>
                                                </div>
                                            </div><!-- end /.progress_wrapper -->

                                            <span class="lnr upload_cross lnr-cross"></span>
                                        </div><!-- end /.upload_wrapper -->
                                        <div id="output"><!-- error or success results --></div>
                                    </div><!-- end /.form-group -->


                                </div><!-- end /.upload_modules -->
                            </div><!-- end /.upload_modules -->


                            <!-- submit button -->
                            <button type="submit" class="btn btn--round btn--fullwidth btn--lg">Submit Your Item for Review</button>
                        </form>
                    </div><!-- end /.col-md-8 -->

                    <div class="col-md-4 col-sm-5">
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
                    </div><!-- end /.col-md-4 -->
                </div><!-- end /.row -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

@endsection

@section('js')
<script>
    $(document).ready(function() {
        var base_url = $('#base_url').val();
        $('#category').on('change', function() {
            $this = $(this);
            get_sub_category($this);
        });

        function get_sub_category($this) {
            var category_id = $this.val();

            $.ajax({
                url: base_url + '/get_sub_category',
                type: 'POST',
                dataType: 'JSON',
                data: {category_id: category_id},
                success:function (response){
                    var rows = makeRows(response);
                    $('#sub_category').html(rows);
                }
            });
            
        }

        function makeRows(response) {
            var row = '<option value="0"> Please Select </options>';
            $.each(response, function(index, val) {
                row +=  '<option value="'+val.id+'"> '+val.name+' </options>';
            });
            return row;
        }




    });

        //configuration
        var max_file_size           = 2048576; //allowed file size. (1 MB = 1048576)
        var allowed_file_types      = ['image/png', 'image/jpeg', 'image/pjpeg']; //allowed file types
        var result_output           = '#output'; //ID of an element for response output
        var my_form_id              = '#product_form'; //ID of an element for response output
        var progress_bar_id         = '#progress-wrp'; //ID of an element for response output
        var total_files_allowed     = 1; //Number files allowed to upload



        //on form submit
        $(my_form_id).on( "submit", function(event) { 
            event.preventDefault();
            var proceed = true; //set proceed flag
            var error = []; //errors
            var total_files_size = 0;
            
            //reset progressbar
            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $("#progress-status").text("0%");
            
            if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
                error.push("Your browser does not support new File API! Please upgrade."); //push error text
        }else{
                var total_selected_files = this.elements['__files[]'].files.length; //number of files
                
                //limit number of files allowed
                if(total_selected_files > total_files_allowed){
                    error.push( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
                    proceed = false; //set proceed flag to false
                }
                 //iterate files in file input field
                 $(this.elements['__files[]'].files).each(function(i, ifile){
                    if(ifile.value !== ""){ //continue only if file(s) are selected
                        if(allowed_file_types.indexOf(ifile.type) === -1){ //check unsupported file
                            error.push( "<b>"+ ifile.name + "</b> is unsupported file type!"); //push error text
                            proceed = false; //set proceed flag to false
                        }

                        total_files_size = total_files_size + ifile.size; //add file size to total size
                    }
                });
                 
                //if total file size is greater than max file size
                if(total_files_size > max_file_size){ 
                    error.push( "You have "+total_selected_files+" file(s) with total size "+total_files_size+", Allowed size is " + max_file_size +", Try smaller file!"); //push error text
                    proceed = false; //set proceed flag to false
                }
                
                var submit_btn  = $(this).find("input[type=submit]"); //form submit button  
                
                //if everything looks good, proceed with jQuery Ajax
                if(proceed){
                    //submit_btn.val("Please Wait...").prop( "disabled", true); //disable submit button
                    var form_data = new FormData(this); //Creates new FormData object
                    var post_url = $(this).attr("action"); //get action URL of form
                    
                    //jQuery Ajax to Post form data
                    $.ajax({
                        url : post_url,
                        type: "POST",
                        dataType: 'JSON',
                        data : form_data,
                        contentType: false,
                        cache: false,
                        processData:false,
                        xhr: function(){
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
                                    $("#progress-status").text(percent +"%");
                                }, true);
                            }
                            return xhr;
                        },
                        mimeType:"multipart/form-data"
                    }).done(function(res){ //
                        if (res.hasOwnProperty('success') ) 
                        {
                            window.location.href = "{{ route('my-account.product') }}"  ;
                        }
                        else if(res.errors != '')
                        {
                            console.log(res.errors);
                        }
                        // $(my_form_id)[0].reset(); //reset form
                        // $(result_output).html(res); //output response from server
                        // submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
                    });

        }
        }

            $(result_output).html(""); //reset output 
            $(error).each(function(i){ //output any error to output element
                $(result_output).append('<div class="error">'+error[i]+"</div>");
            });
            
        });
</script>
@endsection