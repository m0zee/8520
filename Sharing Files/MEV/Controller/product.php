<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Product extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		if( (int)$this->member_model->get_user_data( 'member_type_id' ) != 2 )
		{
			redirect( 'member/login?r=' . $this->uri->uri_string() );
		}

		$this->data['active_nav'] = 'my_account';

		$this->load->model( 'main_category_model' );
		// $this->load->model( 'sub_category_model' );
		$this->load->model( 'country_model' );
		$this->load->model( 'unit_model' );
		$this->load->model( 'duration_unit_model' );
		$this->load->model( 'supplier/product_model' );
		$this->load->model( 'supplier/product_additional_info_model' );
		$this->load->model( 'supplier/product_other_info_model' );
		$this->load->model( 'supplier/product_main_img_model' );
		$this->load->model( 'supplier/product_additional_img_model' );

		$this->load->library( 'form_validation' );

		$this->data['mem_nav_active']	= 'product_listing';
	}





	public function index()
	{
		if( $this->is_subuser )
		{
			if( ! $this->member_model->can( 'see_product_listing', $this->permissions ) )
			{
				$this->session->set_flashdata( 'err', 'You are not authorized for this action.' );
				redirect( 'mem/dashboard' );
			}
		}

		$this->data['js']['handlebars']		= 'plugins/handlebars-v4.0.11.js';
		$this->data['js']['add_product']	= 'assets/js/pages/mem/product/listing.js';

		$this->load->view( 'mem/product/index', $this->data );
	}

	public function get_products()
	{
		if( $this->input->is_ajax_request() )
		{
			$per_page = 10;

			$pagination	= my_pagination
			(
				base_url( 'mem/product/get_products/' ), // url
				$this->product_model->get_product_count( $this->owner_id ), // total_rows
				$per_page, // per_page
				4, // uri_segment
				5  // num_links
			);

			$offset = $this->uri->segment( 4 );

			if ( (int)$offset == FALSE || (int)$offset < 0 ) $offset = 0;

			$products	= $this->product_model->get_all_products_for_backend( $this->owner_id, $per_page, $offset );

			$this->output->set_content_type( 'application/json' );
        	$this->output->set_status_header( 200 );
        	$response = [
        		'status' => 'success',
        		'data' => [ 
        			'products' => $products, 
        			'pagination' => $pagination 
        		]
        	];

        	return $this->output->set_output( json_encode( $response ) );
		}
	}

	public function product_search()
	{
		if( $this->input->is_ajax_request() )
		{
			$query = $this->input->post( 'query' );

			$products	= $this->product_model->search_products_for_backend( $this->owner_id, $query );

			$this->output->set_content_type( 'application/json' );
        	$this->output->set_status_header( 200 );
        	$response = [
        		'status' => 'success',
        		'data' => [ 
        			'products' => $products
        		]
        	];

        	return $this->output->set_output( json_encode( $response ) );
		}
	}





	public function add()
	{
		if( $this->is_subuser )
		{
			if( ! $this->member_model->can( 'add_new_product', $this->permissions ) )
			{
				$this->session->set_flashdata( 'err', 'You are not authorized for this action.' );

				redirect( 'mem/dashboard' );
			}
		}





		if( $_POST )
		{
			$rules = $this->product_model->_add_edit_product_rules;

			$this->form_validation->set_rules( $rules );
			$this->form_validation->set_error_delimiters( '', '' );

			if( $this->form_validation->run() == TRUE )
			{
				$product_id = $this->input->post( 'product_id' );

				if( $product_id > 0 )
				{
					$product = $this->product_model->get_product_for_backend( $this->owner_id, $product_id );
					
					if( count( $product ) > 0 )
					{
						$this->save_product( $product->id );
						// $this->data['tbl'] = $this->get_other_info_table_values( $product->id );
						// $this->save_product_attributes( $this->data['tbl'] );
						$this->add_product_other_info( $product->id );

						$this->session->set_flashdata( 'msg', 'The product has been added successfully.' );

						redirect( 'mem/product/' );
					}
				}
			}
		}

		$this->data['main_cat']		= $this->main_category_model->get_main_category_for_dropdown( FALSE, TRUE );
		// $this->data['tbl'] 			= $this->get_other_info_table_values( 'replace_it_with_product_id' );

		$this->data['product']		= $this->product_model->init( $this->member_id );





		$this->data['css']['profile_css']		= 'unify/css/pages/profile.css';
		$this->data['js']['dropzone_js']		= 'assets/js/dropzone/dropzone.min.js';
		$this->data['js']['add_product']		= 'assets/js/pages/mem/product/add_product.js';

		$this->data['js']['validation_core']	= 'assets/js/jquery_validation/jquery.validate.min.js';
		$this->data['js']['page_validation']	= 'assets/js/jquery_validation/page/backend/product/create_edit.js';

		$this->load->view( 'mem/product/add', $this->data );
	}





	public function edit( $product_id = NULL )
	{
		if( $this->is_subuser )
		{
			if( ! $this->member_model->can( 'edit_product', $this->permissions ) )
			{
				$this->session->set_flashdata( 'err', 'You are not authorized for this action.' );
				redirect( 'mem/dashboard' );
			}
		}





		if( $product_id != NULL && (int)$product_id > 0 )
		{
			if( $_POST )
			{
				$rules = $this->product_model->_add_edit_product_rules;

				$this->form_validation->set_rules( $rules );
				$this->form_validation->set_error_delimiters( '', '' );

				if( $this->form_validation->run() == TRUE)
				{
					$product = $this->product_model->get_product_for_backend( $this->owner_id, $product_id );
					
					if( count( $product ) > 0 )
					{
						$updated = $this->update_product( $product_id );
						// $this->data['tbl'] = $this->get_other_info_table_values( $product_id );
						// $this->save_product_attributes( $this->data['tbl'], TRUE, $product_id );
						$this->add_product_other_info( $product_id, TRUE );

						$this->session->set_flashdata( 'msg', 'The product has been updated successfully.' );

						redirect( 'mem/product/' );
					}
				}
			}

			$this->data['main_cat']				= $this->main_category_model->get_main_category_for_dropdown( FALSE, TRUE ); // REVERSE: FALSE, FIRST ARRAY KEY IS NULL: TRUE
			$this->data['product']				= $this->product_model->get_product_for_backend( $this->owner_id, $product_id, TRUE );
			// $this->data['tbl']					= $this->product_additional_info_model->get( $product_id );
			$this->data['other_info']			= $this->product_other_info_model->get( $product_id );



			

			$this->data['css']['profile_css']		= 'unify/css/pages/profile.css';
			$this->data['js']['dropzone_js']		= 'assets/js/dropzone/dropzone.min.js';
			$this->data['js']['eidt_product']		= 'assets/js/pages/mem/product/edit_product.js';

			$this->data['js']['validation_core']	= 'assets/js/jquery_validation/jquery.validate.min.js';
			$this->data['js']['page_validation']	= 'assets/js/jquery_validation/page/backend/product/create_edit.js';

			$this->load->view( 'mem/product/edit', $this->data );
		}
		else
		{
			echo '<pre>'; print_r( "Invalid product id" ); echo '</pre>'; die();
		}
	}





	public function image_upload()
	{
		$product_id = $this->input->post( 'product_id' );

		if( $product_id !== NULL && (int)$product_id > 0 )
		{
			$this->load->library( 'upload', $this->get_upload_config( 'file' ) );

			if ( ! $this->upload->do_upload( 'file' ) )
			{
				echo json_encode( [ 'err' => TRUE , 'message' => $this->upload->display_errors( '', '' ) ] ); die;
			}
			else
			{
				$upload_info = $this->upload->data();
				/*
					Resizing the original Image
				*/
				$this->load->library( 'image_lib' );
				$this->image_lib->initialize( $this->get_image_lib_resize_config( $upload_info['full_path'] ) );
				$this->image_lib->resize();
				$this->image_lib->clear();
				/*
					Creating Thumbnail
				*/
				$this->image_lib->initialize( $this->get_image_lib_thumb_config( $upload_info['full_path'], $upload_info['file_path'] ) );
				$this->image_lib->resize();
				$this->image_lib->clear();

				// Save the data in db
				$img_info = [
					'path'			=> $upload_info['file_path'],
					'name'			=> $upload_info['raw_name'],
					'ext'			=> $upload_info['file_ext'],
					'product_id'	=> $product_id
				];

				$inserted_id = $this->add_image_info( $upload_info, $product_id );

				if( (int)$inserted_id > 0 )
				{
					$data = [
						'img_id'		=> $inserted_id,
						'product_id'	=> $product_id,
						'thumb_path'	=> base_url( 'assets/images/member/supplier/products/thumbs/' . $upload_info['raw_name'] . '_thumb' . $upload_info['file_ext'] )
					];

					echo json_encode( [ 'success' => TRUE, 'data' => $data ] ); die;
					
				}
				else
				{
					echo json_encode( [ 'err' => TRUE, 'message' => 'Image could not be saved. Please try again.' ] ); die;
					
				}
			}
		}
		else
		{
			echo json_encode( [ 'err' => true, 'message' => 'Invalid product_id' ] ); die;
		}
	}





	public function delete_image()
	{
		$img_id 	= $this->input->post( 'img_id' );
		$product_id = $this->input->post( 'product_id' );

		if( $img_id !== NULL && (int)$img_id > 0  )
		{
			$img = $this->product_main_img_model->get_for_backend( $this->owner_id, $product_id, $img_id );

			if( count( $img ) > 0 )
			{
				$img_path	= $img->path . $img->name . $img->ext;
				$thumb_path	= $img->path . 'thumbs/' . $img->name . '_thumb' . $img->ext;

				if( file_exists( $img_path ) )
				{
					if( $this->product_main_img_model->delete( $img_id, $product_id ) )
					{
						unlink( $img_path );
						unlink( $thumb_path );

						echo json_encode( [ 'success' => true, 'message' => 'Image has been successfully deleted.' ] ); die;
					}

					echo json_encode( [ 'err' => true, 'message' => 'Image could not be deleted. Please try again' ] ); die;
				}

				echo json_encode( [ 'err' => true, 'message' => 'Image could not be found in the file system.' ] ); die;
			}

			echo json_encode( [ 'err' => true, 'message' => 'Image could not be found in the database.' ] ); die;
		}

		echo json_encode( [ 'err' => true, 'message' => 'Invalid image id' ] ); die;
	}





	public function add_bulk( $is_ajax = NULL )
	{
		
		$this->data['categories'] 	= $this->main_category_model->get_main_category_for_dropdown( TRUE );
		$this->data['countries'] 	= $this->country_model->get_countries_for_dropdown( TRUE );
		$this->data['units'] 		= $this->unit_model->get_units_for_dropdown( TRUE );
		$this->data['time_spans']	= $this->duration_unit_model->get_duration_unit_for_dropdown( TRUE );





		if( $this->input->is_ajax_request() || $is_ajax == 'is-ajax' )
		{
			$this->load->library( 'upload', $this->get_product_upload_config( 'file' ) );
			if( isset( $_FILES['file']['name'] ) && $_FILES['file']['name'] && is_uploaded_file( $_FILES['file']['tmp_name'] ) )
			{
				if ( ! $this->upload->do_upload( 'file' ) )
				{
					$upload_errors = $this->upload->display_errors( '', '' );
					echo json_encode( [ 'err' => $upload_errors ] ); die;
				}
				else
				{
					$upload_info = $this->upload->data();

					$this->load->library( 'excel' );

					$obj_excel = PHPExcel_IOFactory::load( $upload_info['full_path'] );

					$sheetObj 	= $obj_excel->getActiveSheet();
					$startFrom 	= 7; //default value is 1
					$limit 		= 106; //default value is null ]
					$excel_data = [];
					$this->data['excel_validation_errors'] = [];
					$this->data['product'] = [];
					foreach( $sheetObj->getRowIterator( $startFrom, $limit ) as $row )
					{
						foreach( $row->getCellIterator() as $cell )
				    	{
				    		$excel_data[$cell->getRow()][$cell->getColumn()] = $cell->getValue();
				    	}

				    	$row_index 						= $cell->getRow();
				    	$category_column 				= $excel_data[ $row_index ]['A'];
				    	$product_name_column			= $excel_data[ $row_index ]['B'];
				    	$manufacturer_column			= $excel_data[ $row_index ]['D'];
				    	$brand_column					= $excel_data[ $row_index ]['E'];
				    	$grade_column					= $excel_data[ $row_index ]['F'];
				    	$size_column					= $excel_data[ $row_index ]['G'];
				    	$part_num_column				= $excel_data[ $row_index ]['H'];
				    	$model_column					= $excel_data[ $row_index ]['I'];
				    	$origin_column					= $excel_data[ $row_index ]['J'];

				    	$description_column				= $excel_data[ $row_index ]['C'];
				    	$min_order_column				= $excel_data[ $row_index ]['K'];
				    	$min_order_unit_column			= $excel_data[ $row_index ]['L'];
				    	$max_supply_column				= $excel_data[ $row_index ]['M'];
				    	$max_supply_unit_column			= $excel_data[ $row_index ]['N'];
				    	$supply_time_column				= $excel_data[ $row_index ]['O'];
				    	$supply_time_unit_column		= $excel_data[ $row_index ]['P'];
				    	$packaging_details_column		= $excel_data[ $row_index ]['Q'];

				    	if( $this->is_data_available( $category_column, $product_name_column ) )
				    	{
				    		if
					    	(
					    		$this->validate_category( $category_column, $row_index ) 
					    		&& $this->validate_product_name( $product_name_column, $row_index )
					    	)
					    	{
					    		$this->clean_the_data( $row_index, 'manufacturer',	'D', 'manufacturer',			$manufacturer_column );
					    		$this->clean_the_data( $row_index, 'brand', 		'E', 'brand', 					$brand_column );
					    		$this->clean_the_data( $row_index, 'grade', 		'F', 'grade', 					$grade_column );
					    		$this->clean_the_data( $row_index, 'size', 			'G', 'size', 					$size_column );
					    		$this->clean_the_data( $row_index, 'part_num', 		'H', 'part number', 			$part_num_column );
					    		$this->clean_the_data( $row_index, 'model', 		'I', 'model', 					$model_column );
					    		$this->validate_origin( $row_index, $origin_column );

					    		$this->clean_the_data( $row_index, 'description', 	'C',  'Product Description',	 $description_column );
					    		$this->validate_empty_or_digit( $row_index, 'min_order_qty', 'K', 'Min Order Qty',  $min_order_column );
					    		$this->validate_unit( $row_index, 'min_order_unit', 'L', 'Min Order Qty Unit',  $min_order_unit_column );
					    		$this->validate_empty_or_digit( $row_index, 'max_supply', 'M', 'Max Supply Qty',  $max_supply_column );
					    		$this->validate_unit( $row_index, 'max_supply_unit', 'N', 'Max Supply Qty Unit',  $max_supply_unit_column );
					    		$this->validate_empty_or_digit( $row_index, 'supply_duration', 'O', 'Supply Lead Time',  $supply_time_column );
					    		$this->validate_duration_unit( $row_index, $supply_time_unit_column );
					    		$this->clean_the_data( $row_index, 'packaging_details', 'Q', 'Packaging Details', $packaging_details_column );
					    	}
				    	}
				    	else
				    	{
				    		break;
				    	}
					}

					unlink( $upload_info['full_path'] );

					if( count( $this->data['excel_validation_errors'] ) > 0 )
					{
						echo json_encode( [ 'err' => $this->data['excel_validation_errors'], 'type' => 'excel_error' ] ); die;
					}
					else if( count( $this->data['product'] ) )
					{
						$product_other_info = [];
						foreach( $this->data['product'] as $data )
						{
							$product = [
								'main_cat_id'	=> $data['main_cat_id'],
								'name'			=> $data['name'],
								'manufacturer'	=> $data['manufacturer'],
								'brand'			=> $data['brand'],
								'grade'			=> $data['grade'],
								'size'			=> $data['size'],
								'part_num'		=> $data['part_num'],
								'model'			=> $data['model'],
								'country_id'	=> $data['country_id'],
								'priority'		=> $data['priority'],
								'featured'		=> 0,
								'member_id'		=> $this->owner_id
							];
							
							$product_id = $this->product_model->save_product( $product );

							$product_other_info[] = [
								'description'		=> $data['description'],
								'min_order_qty'		=> ( $data['min_order_qty'] != '' ) ? $data['min_order_qty'] : 0,
								'min_order_unit'	=> ( $data['min_order_unit'] != '' ) ? $data['min_order_unit'] : 0,
								'max_supply'		=> ( $data['max_supply'] != '' ) ? $data['max_supply'] : 0,
								'max_supply_unit'	=> ( $data['max_supply_unit'] != '' ) ? $data['max_supply_unit'] : 0,
								'supply_duration'	=> ( $data['supply_duration'] != '' ) ? $data['supply_duration'] : 0,
								'duration_unit_id'	=> ( $data['duration_unit_id'] != '' ) ? $data['duration_unit_id'] : 0,
								'packaging_details'	=> $data['packaging_details'],
								'product_id'		=> $product_id
							];
						}

						$this->product_other_info_model->save_batch( $product_other_info );
						echo json_encode( [ 'success' => 'Products successfully saved.' ] ); die;
					}
					else if( ! count( $this->data['excel_validation_errors'] ) && ! count( $this->data['product'] ) )
					{
						echo json_encode( [ 'err' => 'No product found in file. Please fill the file and upload again.' ] ); die;
					}
				}
			}
		}



		$this->data['css']['dz_basic_css']			= 'assets/css/dropzone/basic.min.css';
		$this->data['css']['dz_css']				= 'assets/css/dropzone/dropzone.css';
		$this->data['js']['dz_js']					= 'assets/js/dropzone/dropzone.min.js';
		$this->data['js']['add_product_in_bulk']	= 'assets/js/pages/mem/product/add_product_in_bulk.js';

		$this->load->view( 'mem/product/add_bulk', $this->data );
	}

	private function get_product_upload_config( $field_name = 'userfile' )
	{
		return [
			'upload_path'	=> './assets/member/temp_product_bulk_upload/',
			'allowed_types'	=> 'xls|xlsx',
			'file_name'		=> time() . '-mem-' . $this->owner_id . '-' . $_FILES[$field_name]['name']
		];
	}

	private function is_data_available( $category, $product_name )
	{
		return ( $category != '' && $product_name != '' ) ? TRUE : FALSE;
	}


	private function validate_category( $category, $rowIndex )
	{
		$category = $this->laundry( $category );

		if( isset( $this->data['categories'][ $category ] ) ) 
		{
			$this->data['product'][$rowIndex]['main_cat_id'] = $this->data['categories'][ $category ];
			return TRUE;
		}

		$this->data['excel_validation_errors'][] = 'A' . $rowIndex . ': Incorrect Category.';
		return FALSE;
	}

	private function validate_product_name( $product_name, $rowIndex )
	{
		$product_name = $this->laundry( $product_name );

		if( $product_name != '' ) 
		{
			$this->data['product'][$rowIndex]['name'] = $product_name;
			$this->data['product'][$rowIndex]['member_id'] = $this->owner_id;
			$this->data['product'][$rowIndex]['priority'] = 1000;	
			return TRUE;
		}

		$this->data['excel_validation_errors'][] = 'B' . $rowIndex . ': Please enter product name.';
		return FALSE;
	}

	private function clean_the_data( $rowIndex, $db_col_name, $excel_col_letter, $error_label, $input )
	{
		$input = $this->laundry( $input );

		if( $input == '' ) 
		{
			$this->data['product'][ $rowIndex ][ $db_col_name ] = $input;
			return TRUE;
		}
		else if( $input != '' )
		{
			$this->data['product'][ $rowIndex ][ $db_col_name ] = $input;
			return TRUE;
		}

		$this->data['excel_validation_errors'][] = $excel_col_letter . $rowIndex . ': Invalid ' . $error_label . ' value.';
		return FALSE;
	}

	private function validate_origin( $rowIndex, $origin )
	{
		$origin = $this->laundry( $origin );

		if( $origin == '' )
		{
			$this->data['product'][$rowIndex]['country_id'] = $origin;
			return TRUE;
		}
		elseif( isset( $this->data['countries'][ $origin ] ) ) 
		{
			$this->data['product'][$rowIndex]['country_id'] = $this->data['countries'][ $origin ];
			return TRUE;
		}

		$this->data['excel_validation_errors'][] = 'J' . $rowIndex . ': Incorrect Origin.';
		return FALSE;
	}

	private function validate_empty_or_digit( $rowIndex, $db_col_name, $excel_col_letter, $error_label, $input )
	{
		$input = $this->laundry( $input );

		if( $input == '' )
		{
			$this->data['product'][ $rowIndex ][ $db_col_name ] = $input;
			return TRUE;
		}
		else if( $input != '' )
		{
			$input = ltrim( $input, '0' );
			if( ! preg_match( '/^[1-9](\d)*$/', $input ) )
			{
				$this->data['excel_validation_errors'][] = $excel_col_letter . $rowIndex . ': Incorrect ' . $error_label . '.';
				return FALSE;
			}

			$this->data['product'][ $rowIndex ][ $db_col_name ] = $input;
		}
	}

	private function validate_unit( $rowIndex, $db_col_name, $excel_col_letter, $error_label, $input )
	{
		$input = $this->laundry( $input );

		if( $input == '' )
		{
			$this->data['product'][ $rowIndex ][ $db_col_name ] = $input;
			return TRUE;
		}
		elseif( isset( $this->data['units'][ $input ] ) ) 
		{
			$this->data['product'][ $rowIndex ][ $db_col_name ] = $this->data['units'][ $input ];
			return TRUE;
		}

		$this->data['excel_validation_errors'][] = $excel_col_letter . $rowIndex . ': Incorrect ' . $error_label . '.';
		return FALSE;
	}

	private function validate_duration_unit( $rowIndex, $duration_unit )
	{
		$duration_unit = $this->laundry( $duration_unit );

		if( $duration_unit == '' )
		{
			$this->data['product'][ $rowIndex ]['duration_unit_id'] = $duration_unit;
			return TRUE;
		}
		elseif( isset( $this->data['time_spans'][ $duration_unit ] ) ) 
		{
			$this->data['product'][ $rowIndex ]['duration_unit_id'] = $this->data['time_spans'][ $duration_unit ];
			return TRUE;
		}

		$this->data['excel_validation_errors'][] = 'P' . $rowIndex . ': Incorrect Supply Lead Time Duration.';
		return FALSE;
	}

	private function laundry( $input )
	{
		$input = strip_tags( $input ); $input = htmlentities( $input ); $input = trim( $input ); 
		return $input;
	}





	public function download_template()
	{
		$this->load->helper( 'download' );
		$file = base_url( 'assets/member/bulk_product_template.xlsx' );
		$data = file_get_contents( $file ); // Read the file's contents
		$name = 'bulk_product_template-' . time() . '.xlsx';

		force_download( $name, $data );
	}





	/*
	* The following method is being used by jquery ajax request
	* in "assets/js/pages/mem/products/add_product.js" and "assets/js/pages/mem/products/edit_product.js"
	*/
	// public function get_sub_cat()
	// {
	// 	$main_cat_id = $this->input->post( 'main_cat_id' );

	// 	if( $main_cat_id != NULL && $main_cat_id != '' && $main_cat_id > 0 )
	// 	{
	// 		$list = $this->sub_category_model->get_sub_cat_by_main_cat_id( $main_cat_id );

	// 		if( $list )
	// 		{
	// 			echo json_encode( [ "result" => $list ], JSON_FORCE_OBJECT ); die;
	// 		}
	// 	}
	// }





	public function delete( $product_id = NULL )
	{
		if( $this->is_subuser )
		{
			if( ! $this->member_model->can( 'delete_product', $this->permissions ) )
			{
				$this->session->set_flashdata( 'err', 'You are not authorized for this action.' );
				redirect( 'mem/product/' );
			}
		}

		$product = $this->product_model->get_product_for_backend( $this->owner_id, $product_id );

		if( count( $product ) > 0 )
		{
			$img 				= $this->product_main_img_model->get( $product_id );
			$additional_imgs	= $this->product_additional_img_model->get_all( $product_id );

			if( count( $img ) > 0 )
			{
				$this->remove_image( $img );
			}

			if( isset( $additional_imgs ) && count( $additional_imgs ) > 0 )
			{
				foreach( $additional_imgs as $additional_img )
				{
					$img_info = [
						'full_path' => $additional_img->path . $additional_img->name . $additional_img->ext,
						'file_path'	=> $additional_img->path,
						'raw_name'	=> $additional_img->name,
						'file_ext'	=> $additional_img->ext
					];

					$this->remove_additional_image( $img_info );
					$this->product_additional_img_model->delete( $additional_img->id, $additional_img->product_id );
				}
			}

			$this->product_model->delete( $product_id, $this->owner_id );
			$this->product_other_info_model->delete( $product_id );
			$this->product_additional_info_model->delete( $product_id );
			$this->product_main_img_model->delete( $img->id, $img->product_id );


			$this->session->set_flashdata( 'msg', 'The product has been deleted successfully.' );

			redirect( 'mem/product' );
		}

		$this->session->set_flashdata( 'error', 'The product could not be deleted.' );

		redirect( 'mem/product' );
	}





	public function gallery( $product_id = NULL )
	{
		if( $this->is_subuser )
		{
			if( ! $this->member_model->can( 'create_gallery', $this->permissions ) )
			{
				$this->session->set_flashdata( 'err', 'You are not authorized for this action.' );
				redirect( 'mem/product/' );
			}
		}







		if( $product_id != NULL && (int)$product_id > 0 )
		{
			$this->data['additional_imgs'] = $this->product_additional_img_model->get_all( $product_id );

			if( $this->input->is_ajax_request() )
			{
				if( $_FILES['file']['name'] && is_uploaded_file( $_FILES['file']['tmp_name'] ) )
				{
					$this->load->library( 'upload', $this->get_additional_image_upload_config( 'file' ) );

				    if ( ! $this->upload->do_upload( 'file' ) )
					{
						echo json_encode( [ 'err' => $this->upload->display_errors( '', '' ) ] );
					}
					else
					{
						$uploaded_data = $this->upload->data();

						$this->load->library( 'image_lib' );
						/* Resizing the image */
						$this->image_lib->initialize( $this->get_additional_img_resize_config( $uploaded_data['full_path'] ) );
						$this->image_lib->resize();
						$this->image_lib->clear();
						/* Creating thumbnail */
						$this->image_lib->initialize( $this->get_additional_img_thumb_config( $uploaded_data['full_path'], $uploaded_data['file_path'] ) );
						$this->image_lib->resize();
						$this->image_lib->clear();

						// save record in db
						$img_id = $this->add_additional_image_info( $uploaded_data, $product_id );

						if( (int)$img_id > 0 )
						{
							$img_uploaded_info = [
								'id'			=> $img_id,
								'img_path'		=> base_url( config_item( 'prod_add_img_path' ) . 'thumbs/' . $uploaded_data['raw_name'] . '_thumb' . $uploaded_data['file_ext'] ),
								'product_id'	=> $product_id
							];

							echo json_encode( [ 'success' => 'ture', 'img_data' => $img_uploaded_info ] );
						}
						else if ( $img_id == "limit exceeds" )
						{
							$this->remove_additional_image( $uploaded_data );
							echo json_encode( [ 'err' => 'Image limit exceeded. You can add maximum 6 images.<br /> Please delete images from the Saved Images panel to save new one.' ] );
						}
						else
						{
							echo json_encode( [ 'err' => 'Could not save the image. Please try again' ] );
						}
					}
				}

				die;
			}
			// else
			// {
			// 	if( isset( $_FILES['file']['name'] ) && $_FILES['file']['name'] && is_uploaded_file( $_FILES['file']['tmp_name'] ) )
			// 	{
			// 		$this->load->library( 'upload', $this->get_additional_image_upload_config( 'file' ) );

			// 	    if ( ! $this->upload->do_upload( 'file' ) )
			// 		{
			// 			$this->session->set_flashdata( 'err', $this->upload->display_errors( '', '' ) );
			// 			redirect( 'mem/product/gallery/' . $product_id );
			// 		}
			// 		else
			// 		{
			// 			$uploaded_data = $this->upload->data();

			// 			$this->load->library( 'image_lib' );
			// 			/* Resizing the image */
			// 			$this->image_lib->initialize( $this->get_additional_img_resize_config( $uploaded_data['full_path'] ) );
			// 			$this->image_lib->resize();
			// 			$this->image_lib->clear();
			// 			/* Creating thumbnail */
			// 			$this->image_lib->initialize( $this->get_additional_img_thumb_config( $uploaded_data['full_path'], $uploaded_data['file_path'] ) );
			// 			$this->image_lib->resize();
			// 			$this->image_lib->clear();

			// 			// save record in db
			// 			$img_id = $this->add_additional_image_info( $uploaded_data, $product_id );

			// 			if( (int)$img_id > 0 )
			// 			{
			// 				$this->session->set_flashdata( 'success', 'Image(s) uploaded successfully.' );
			// 				redirect( 'mem/product/gallery/' . $product_id );
			// 			}
			// 			else if ( $img_id == "limit exceeds" )
			// 			{
			// 				$this->remove_additional_image( $uploaded_data );

			// 				$this->session->set_flashdata( 'err', 'Image limit exceeded. You can add maximum 6 images.<br /> Please delete images from the Saved Images panel to save new one.' );
			// 				redirect( 'mem/product/gallery/' . $product_id );
			// 			}
			// 			else
			// 			{
			// 				$this->session->set_flashdata( 'err', 'Could not save the image. Please try again' );
			// 				redirect( 'mem/product/gallery/' . $product_id );
			// 			}
			// 		}
			// 	}
			// }

			$this->data['mem_nav_active'] 				= 'product_listing';

			$this->data['css']['dz_basic_css']			= 'assets/css/dropzone/basic.min.css';
			$this->data['css']['dz_css']				= 'assets/css/dropzone/dropzone.css';
			$this->data['css']['dz_custom_css']			= 'assets/css/dropzone/dropzone_custom.css';
			$this->data['js']['dz_js']					= 'assets/js/dropzone/dropzone.min.js';
			$this->data['js']['gallery_dz_option_js']	= 'assets/js/pages/mem/product/gallery_dropzone_options.js';
			// $this->data['js']['golbal_js']				= 'assets/js/global.js';

			$this->load->view( 'mem/product/create_gallery', $this->data );
		}
		else
		{
			echo '<pre>'; print_r( "Invalid product id" ); echo '</pre>'; die();
		}
	}





	public function deleteAdditionalImage( $img_id = NULL, $relation_name = '', $product_id = NULL )
	{
		if( $img_id != NULL && (int)$img_id > 0 && $product_id != NULL && (int)$product_id > 0 && $relation_name == 'product' )
		{
			$img = $this->product_additional_img_model->get_product_additional_img_by_id( $img_id, $product_id );

			if ( count( $img ) > 0 )
			{
				$affected_rows = $this->product_additional_img_model->delete( $img_id, $product_id );

				if( $affected_rows > 0 )
				{
					$img_info = [
						'full_path' => $img->path . $img->name . $img->ext,
						'file_path'	=> $img->path,
						'raw_name'	=> $img->name,
						'file_ext'	=> $img->ext
					];

					$this->remove_additional_image( $img_info );

					echo json_encode( [ 'success' => 'Image has been deleted.' ] ); die;
				}
				else
				{
					echo json_encode( [ 'err' => 'Image could not be deleted. Please try again.' ] ); die;
				}
			}
			else
			{
				echo json_encode( [ 'err' => 'Image not found' ] ); die;
			}
		}

		echo json_encode( [ 'err' => 'Invalid Image Id or Product Id' ] ); die;
	}





	public function preview( $product_id = NULL )
	{
		if( $this->is_subuser )
		{
			if( ! $this->member_model->can( 'preview_product', $this->permissions ) )
			{
				$this->session->set_flashdata( 'err', 'You are not authorized for this action.' );
				redirect( 'mem/dashboard' );
			}
		}





		if( $product_id != NULL && (int)$product_id > 0 )
		{
			$this->data['img'] 				= $this->product_main_img_model->get( $product_id );
			$this->data['additional_imgs']	= $this->product_additional_img_model->get_all( $product_id );
			$this->data['product']			= $this->product_model->get_product( $product_id, $this->owner_id );
			$this->data['other_info']		= $this->product_other_info_model->get( $product_id );
			// $this->data['prod_attr']		= $this->product_additional_info_model->get( $product_id );

			$this->data['mem_nav_active'] 				= 'product_listing';


			$this->data['css']['simple_lens_css']		= 'plugins/simpleLens/jquery.simpleLens.css';
			$this->data['js']['simple_lens_js']			= 'plugins/simpleLens/jquery.simpleLens.min.js';

			$this->data['css']['simple_gallery_css']	= 'plugins/simpleGallery/jquery.simpleGallery.css';
			$this->data['js']['simple_gallery_js']		= 'plugins/simpleGallery/jquery.simpleGallery.min.js';

			$this->data['js']['product_detail']			= 'assets/js/pages/front/vendor_product_detail.js';

			$this->load->view( 'mem/product/preview', $this->data );
		}
		else
		{
			echo '<pre>'; print_r( "Invalid product id" ); echo '</pre>'; die();
		}
	}





	/*=======================================================================================================
											HELPER FUNCTIONS
	=======================================================================================================*/

	/*
	*	Prepare the record for tbl_product_additional_info table and return it"
	*/
	private function get_other_info_table_values( $product_id = NULL )
	{
		// $attrib 	= $this->input->post( 'attrib' );
		// $attrib_val	= $this->input->post( 'attrib_val' );

		// $additional_info = [];

		// for ( $i = 0; $i < count( $attrib ) ; $i++ )
		// {
		// 	if( $attrib[$i] != "" && $attrib_val[$i] != "" )
		// 	{
		// 		$item = new stdClass();

		// 		$item->product_id	= $product_id;
		// 		$item->attrib		= $attrib[$i];
		// 		$item->val			= $attrib_val[$i];

		// 		$additional_info[] = $item;
		// 	}
		// }

		// return $additional_info;
	}





	/*
	*	This function is being used in the "Product_model->_add_edit_product_rules
	*/
	public function _validateDropdown( $val )
	{
		if( $val < 1 || $val == "" || $val == NULL)
		{
			$this->form_validation->set_message( '_validateDropdown', 'Please select %s.' );
			return false;
		}

		return true;
	}





	/*
	*	Saves the record in tbl_product and return INSERTED ID
	*/
	private function save_product( $product_id )
	{
		$product = [
			'main_cat_id'	=> $this->input->post( 'main_cat_id' ),
			'name'			=> $this->input->post( 'name' ),
			'manufacturer'	=> $this->input->post( 'manufacturer' ),
			// 'brand'			=> $this->input->post( 'brand' ),
			// 'grade'			=> $this->input->post( 'grade' ),
			// 'size'			=> $this->input->post( 'size' ),
			// 'part_num'		=> $this->input->post( 'part_num' ),
			// 'model'			=> $this->input->post( 'model' ),
			// 'country_id'	=> $this->input->post( 'country_id' ),
			// 'priority'		=> $this->input->post( 'priority' ) == '' ? 1000 : $this->input->post( 'priority' ),
			// 'featured'		=> 0,
			'member_id'		=> $this->owner_id
		];
		
		return $this->product_model->update( $this->owner_id, $product_id, $product );
	}





	/*
	*	Update the record in tbl_product and return Affected Rows
	*/
	private function update_product( $product_id = NULL )
	{
		if( $product_id != NULL )
		{
			$product = [
				'main_cat_id'	=> $this->input->post( 'main_cat_id' ),
				'name'			=> $this->input->post( 'name' ),
				'manufacturer'	=> $this->input->post( 'manufacturer' )
				// 'brand'			=> $this->input->post( 'brand' ),
				// 'grade'			=> $this->input->post( 'grade' ),
				// 'size'			=> $this->input->post( 'size' ),
				// 'part_num'		=> $this->input->post( 'part_num' ),
				// 'model'			=> $this->input->post( 'model' ),
				// 'country_id'	=> $this->input->post( 'country_id' ),
				// 'priority'		=> $this->input->post( 'priority' ) == '' ? 1000 : $this->input->post( 'priority' )
			];

			return $this->product_model->update( $this->owner_id, $product_id,  $product );
		}

		return false;
	}





	/*
	*	Save the records in tbl_product_additional_info
	*/
	private function save_product_attributes( $record = NULL, $deleteFirst = FALSE, $product_id = NULL )
	{
		// if( $deleteFirst === TRUE )
		// {
		// 	if( $product_id != NULL && (int)$product_id > 0 )
		// 	{
		// 		$this->product_additional_info_model->delete( $product_id );
		// 	}
		// }

		// foreach ( $record as $attributes )
		// {
		// 	$data = [
		// 		'product_id'	=> $attributes->product_id,
		// 		'attrib'		=> htmlentities( strip_tags( $attributes->attrib ) ),
		// 		'val'			=> htmlentities( strip_tags( $attributes->val ) )
		// 	];

		// 	$this->product_additional_info_model->save( $data );
		// }
	}





	/*
	*	Saves/Updates the records in tbl_product_other_info
	*/
	private function add_product_other_info( $product_id = NULL, $is_edit = false )
	{
		if( $product_id != NULL && (int)$product_id > 0 )
		{
			$data = [
				'description'		=> htmlentities( $this->input->post( 'description' ) ),
				// 'min_order_qty'		=> ( $this->input->post( 'min_order_qty' ) != '' ) ? $this->input->post( 'min_order_qty' ) : 0,
				// 'min_order_unit'	=> $this->input->post( 'min_order_unit' ),
				// 'max_supply'		=> ( $this->input->post( 'max_supply' ) != '' ) ? $this->input->post( 'max_supply' ) : 0,
				// 'max_supply_unit'	=> $this->input->post( 'max_supply_unit' ),
				// 'supply_duration'	=> $this->input->post( 'supply_duration' ),
				// 'duration_unit_id'	=> $this->input->post( 'duration_unit_id' ),
				// 'packaging_details'	=> $this->input->post( 'packaging_details' ),
				'product_id'		=> $product_id
			];

			$this->product_other_info_model->save( $data, $is_edit );
		}
	}





	/*
	*	Prepare the configuration for "upload" class and return it"
	*/
	private function get_upload_config( $field_name = 'userfile' )
	{
		return[
			'upload_path'	=> 'assets/images/member/supplier/products/',
			'allowed_types'	=> 'gif|jpg|png',
			// 'file_name'		=> time() . $_FILES[$field_name]['name'],
			'max_size' 		=> 2048,
			'encrypt_name'	=> TRUE
		];
	}





	/*
	*	Prepare the configuration for "image_lib" class for resizing the original image and return it"
	*/
	private function get_image_lib_resize_config( $source_image = NULL )
	{
		return [
			'image_library'		=> 'gd2',
			'source_image'		=> $source_image,
			'maintain_ratio'	=> true,
			'width'				=> 1024,
			'height'			=> 1768
		];
	}





	/*
	*	Prepare the configuration for "image_lib" class for creating thumbnail and return it
	*/
	private function get_image_lib_thumb_config( $source_image = NULL, $target = NULL )
	{
		return [
			'image_library'		=> 'gd2',
			'source_image'		=> $source_image,
			'create_thumb'		=> TRUE,
			'thumb_marker'		=> '_thumb',
			'new_image'			=> $target . 'thumbs/',
			'maintain_ratio'	=> TRUE,
			'width'				=> 300,
			'height'			=> 300
		];
	}





	/*
	*	Save/Update the record in tbl_product_main_img
	*/
	private function add_image_info( $upload_info, $product_id )
	{
		$img = [
			'path'			=> $upload_info['file_path'],
			'name'			=> $upload_info['raw_name'],
			'ext'			=> $upload_info['file_ext'],
			'product_id'	=> $product_id
		];

		return $this->product_main_img_model->save_product_image( $img );
	}





	/*
	*	Removes the image and its thumbnail form filesystem
	*/
	private function remove_image( $img )
	{
		$img_path 	= $img->path . $img->name . $img->ext;
		$thumb_path = $img->path . 'thumbs/' . $img->name . '_thumb' . $img->ext;

		if( file_exists( $img_path ) && is_file( $img_path ) )
		{
			unlink( $img_path );
		}

		if( file_exists( $thumb_path ) && is_file( $thumb_path ) )
		{
			unlink( $thumb_path );
		}
	}





	/*
	*	Prepare the configuration for "upload" class for product additional images and return it"
	*/
	private function get_additional_image_upload_config( $field_name = 'userfile' )
	{
		return [
			'upload_path'	=> config_item( 'prod_add_img_path' ),
			'allowed_types'	=> 'gif|jpg|png',
			'file_name'		=> time() . $_FILES[$field_name]['name'],
			'max_size' 		=> 2048,
			'encrypt_name' 	=> TRUE
		];
	}





	/*
	*	Prepare the configuration for "image_lib" class for resizing the additional image and return it"
	*/
	private function get_additional_img_resize_config( $source_image = NULL )
	{
		return [
			'image_library'		=> 'gd2',
			'source_image'		=> $source_image,
			'maintain_ratio'	=> true,
			'width'				=> 1024,
			'height'			=> 1768
		];
	}





	/*
	*	Prepare the configuration for "image_lib" class for creating additional image thumbnail and return it
	*/
	private function get_additional_img_thumb_config( $source_image = NULL, $target = NULL )
	{
		return [
			'image_library'		=> 'gd2',
			'source_image'		=> $source_image,
			'create_thumb'		=> TRUE,
			'thumb_marker'		=> '_thumb',
			'new_image'			=> $target . 'thumbs/',
			'maintain_ratio'	=> TRUE,
			'width'				=> 150,
			'height'			=> 100
		];
	}





	/*
	*	Save/Update the record in tbl_product_main_img
	*/
	private function add_additional_image_info( $upload_info, $product_id )
	{
		$img = [
			'path'			=> $upload_info['file_path'],
			'name'			=> $upload_info['raw_name'],
			'ext'			=> $upload_info['file_ext'],
			'product_id'	=> $product_id
		];

		return $this->product_additional_img_model->save( $img );
	}





	/*
	*	Removes the additional image and its thumbnail form filesystem
	*/
	private function remove_additional_image( $img )
	{
		$img_path 	= $img['full_path'];
		$thumb_path = $img['file_path'] . 'thumbs/' . $img['raw_name'] . '_thumb' . $img['file_ext'];

		if( file_exists( $img_path ) && is_file( $img_path ) )
		{
			unlink( $img_path );
		}

		if( file_exists( $thumb_path ) && is_file( $thumb_path ) )
		{
			unlink( $thumb_path );
		}
	}
}
?>