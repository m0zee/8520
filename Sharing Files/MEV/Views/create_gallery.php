<?php echo $this->load->view( 'components/unify/header' ); ?>

    <!--=== Content Part ===-->
    <div class="container content">

        <div class="row">
            <!-- Begin Sidebar Menu -->
            <div class="col-md-3">
                <?php $this->load->view( 'components/supplier/sidebar' ); ?>
            </div>
            <!-- End Sidebar Menu -->





            <!-- Begin Content -->
            <div class="col-md-9">
                <div class="headline">
                    <h2>Create Galley</h2>

                    <a href="<?php echo base_url( 'mem/product' ); ?>" class="btn-u btn-u-default rounded-4x pull-right tip" title="Click to go back">
                        <i class="fa fa-reply-all"></i> Go Back
                    </a>
                </div>


                <?php echo form_open( '', array( 'id' => 'myDropzone', 'class' => 'dropzone' ) ); ?>

                <?php echo form_close(); ?>





                <!-- Messages -->
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <div id="message-box"></div>
                    </div>
                </div>





                <!-- Saved Images Panel -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>&nbsp;</h2>

                        <div class="panel panel-grey">

                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Saved Images <i class="fa fa-file-image-o"></i>
                                </h3>
                            </div>

                            <div class="panel-body">
                                <div class="row" id="saved_images_container">

                                    <?php if( isset( $additional_imgs ) && (int)count( $additional_imgs ) > 0 ): ?>

                                        <?php foreach( $additional_imgs as $img ): ?>

                                            <div class="col-md-2">
                                                <div class="thumbnail">
                                                    <a href="<?php echo base_url( 'mem/product/deleteAdditionalImage/' . $img->id . '/product/' . $img->product_id ); ?>"
                                                    class="btn btn-xs btn-danger rounded tip delete-image del-btn-pos-right"
                                                    role="button" data-placement="bottom" title="Click to delete this image.">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>

                                                    <img class="img-responsive" src="<?php echo base_url( config_item( 'prod_add_img_path' ) . 'thumbs/' . $img->name . '_thumb' . $img->ext ) ?>" alt="Product Image" style="height: 100px;">
                                                </div>
                                            </div>

                                        <?php endforeach; ?>

                                    <?php else: ?>
                                        <div id="no-images" class="col-md-12">
                                            <div class="alert alert-danger text-center">
                                                No images found.
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div> <!-- /panel-body -->

                        </div>

                    </div>
                </div>


            </div>
            <!-- End Content -->

        </div>

    </div>
    <!--/container-->
    <!--=== End Content Part ===-->

<?php $this->load->view( 'components/unify/footer' ); ?>