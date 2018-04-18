@extends( 'components.frontend.master' )

@php  $active = 'requirement';  @endphp

@section( 'title', 'Dashboard' )

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
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="active"><a href="#">Requirement</a></li>
                        </ul>
                    </div>
                    <h1 class="page-title">Requirement</h1>
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
    @include('components.backend.menu')

    <section class="dashboard-area">

        <div class="dashboard_contents">
            <div class="container">


                {{-- <form action="{{ route('buyer.requirements.update', [$requirement->code]) }}" method="POST" class="setting_form"> --}}
                	<form action="{{ route('admin.requirements.status', [$requirement->id]) }}" method="POST">
	            		<input type="hidden" name="_method" value="PUT">
	            		{{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="information_module">
                                <a class="toggle_title">
                                    <h4>Edit Requirement</h4>
                                </a>

                                <div class="information__set toggle_module">
                                    <div class="information_wrapper form--fields">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group {{ ($errors->first('name') ) ? 'has-error' : '' }}">
                                                    <label for="name">Requirement</label>
                                                    <input type="text" name="name" value="{{ old('name', $requirement->name ) }}" id="name" class="text_field" placeholder="Requirement subject">

                                                    @if ($errors->has('name'))
		                                                <span class="help-block">
		                                                    <strong>{{ $errors->first('name') }}</strong>
		                                                </span>
		                                            @endif
                                                </div>
                                            </div>


                                           <div class="">
	                                           	 <div class="col-md-6">
	                                           	        <div class="form-group {{ $errors->has('category_id') ? 'has-error'  : ''  }}">
	                                           	        	<label for="category">Category</label>
	                                           	        	<div class="select-wrap select-wrap2">
	                                           	        	    {{ Form::select('category_id', $category, old('category_id', $requirement->category_id), ['placeholder' => 'Please Select', 'id' => 'category'] ) }}
	                                           	        	    <span class="lnr lnr-chevron-down"></span>
	                                           	        	</div>
	                                           	        	@if ( $errors->has('category_id'))
	                                           	        		<span class="help-block">
				                                                    <strong>{{ $errors->first('category_id') }}</strong>
				                                                </span>
	                                           	        	@endif
	                                           	        </div>
	                                           	</div>

	                                           	<div class="col-md-6">
	                                           	        <div class="form-group {{ $errors->has('sub_category_id') ? 'has-error'  : ''  }}">
	                                           	        	<label for="sub_category">Sub Category</label>
	                                           	        	<div class="select-wrap select-wrap2">
	                                           	        	     <select name="sub_category_id" class="text_field" id="sub_category">
			                                           	        	<option value="">Please Select</option>
			                                           	        </select>
	                                           	        	    <span class="lnr lnr-chevron-down"></span>
	                                           	        	    <input type="hidden" value="{{ old('sub_category_id', $requirement->sub_category_id) }}" id="sub_category_id">
	                                           	        	</div>
	                                           	        	@if ( $errors->has('sub_category_id'))
	                                           	        		<span class="help-block">
				                                                    <strong>{{ $errors->first('sub_category_id') }}</strong>
				                                                </span>
	                                           	        	@endif
	                                           	        </div>
	                                           	</div>
                                           </div>



                                            <div class="">
                                            	<div class="col-md-6">
                                            	       <div class="form-group {{ $errors->has('unit_id') ? 'has-error'  : ''  }}">
	                                            	       	<label for="name">unit</label>
	                                            	       	<div class="select-wrap select-wrap2">
	                                            	       	    {{ Form::select('unit_id', $units, old('unit_id', $requirement->unit_id), ['placeholder' => 'Select Unit', 'id' => 'unit'] ) }}
	                                            	       	    <span class="lnr lnr-chevron-down"></span>
	                                            	       	</div>

	                                            	       	@if ( $errors->has('unit_id'))
	                                           	        		<span class="help-block">
				                                                    <strong>{{ $errors->first('unit_id') }}</strong>
				                                                </span>
	                                           	        	@endif
                                            	       </div>
                                            	        {{-- <input type="text" name="name" id="name" class="text_field" placeholder="unit"> --}}
                                            	</div>
                                            	
                                            	<div class="col-md-6">
                                            	        <div class="form-group {{ $errors->has('quantity') ? 'has-error'  : ''  }}">
                                            	        	<label for="quantity">Quantity</label>
                                            	        	<input type="text" name="quantity" id="quantity" value="{{ old('quantity', $requirement->quantity) }}" class="text_field" placeholder="ex: 500">
                                            	        </div>

                                        	        	@if ( $errors->has('quantity'))
                                           	        		<span class="help-block">
			                                                    <strong>{{ $errors->first('quantity') }}</strong>
			                                                </span>
                                           	        	@endif
                                            	</div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('description') ? 'has-error'  : ''  }}">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="form-gorup text_field" placeholder="Type requirement description here...">{{ old('description', $requirement->description) }}</textarea>

                                                    @if ( $errors->has('description'))
                                       	        		<span class="help-block">
		                                                    <strong>{{ $errors->first('description') }}</strong>
		                                                </span>
                                       	        	@endif
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- end /.information_wrapper -->
                                </div><!-- end /.information__set -->
                            </div><!-- end /.information_module -->

                            <div class="dashboard_setting_btn">
                                

                            {{-- <form action="{{ route('admin.requirements.status', [$requirement->id, 'approve']) }}" method="POST">
	                                                        		<input type="hidden" name="_method" value="PUT">
	                                                        		{{ csrf_field() }} --}}
	                                                        		{{-- <button type="submit" class="btn btn--round btn-sm btn-success">Approve</button> --}}
	                                                        		<input type="submit" value="Approve" name="status" class="btn btn--round btn-success btn-sm">
	                                                        	{{-- </form> --}}

	                                                        	{{-- <form action="{{ route('admin.requirements.status', [$requirement->id, 'reject']) }}" method="POST">
	                                                        		<input type="hidden" name="_method" value="PUT">
	                                                        		{{ csrf_field() }} --}}
	                                                        		{{-- <button type="submit" class="btn btn--round btn-sm btn-danger">Reject</button> --}}

	                                                        		<input type="submit" value="Reject" name="status" class="btn btn--round btn-danger btn-sm">
	                                                        	{{-- </form> --}}
                            </div>

                        </div><!-- end /.col-md-12 -->
                    </div><!-- end /.row -->
                </form><!-- end /form -->
            </div><!-- end /.container -->
        </div><!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

@endsection

@section('js')
<script src="{{ asset('js/page/get_sub_category_by_category.js') }}"></script>
@endsection