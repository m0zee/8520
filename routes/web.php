<?php
use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get( 'recover-password', function () {
    return view( 'frontend.recover_password' );
});

Route::get( 'contact', function() {
	return view( 'frontend.contact' )->with( 'blue_menu', true );
})->name( 'contact' );


Route::get( 'buyer-requirement', 				'BuyerRequirementController@index' )->name( 'requirement' );
Route::get( 'buyer-requirement/{code}/show',	'BuyerRequirementController@show' )->name( 'requirement.show' );

Route::get( 'categories/{category_slug}/requirement', 'BuyerRequirementController@get_by_category' )->name( 'categories.requirement' );
Route::get( 'categories/{category_slug}/sub-categories/{sub_category_slug}/requirement', 'BuyerRequirementController@get_by_sub_category' )->name( 'categories.sub-categories.requirement' );



Route::get( 'products', 'ProductController@index' )->name( 'products' );
Route::get( 'products/{id}/get', 'ProductController@get' )->name( 'products.get' );

Route::get( 'categories/{category_slug}/products', 'ProductController@get_by_category' )->name( 'categories.products' );
Route::get( 'categories/{category_slug}/sub-categories/{sub_category_slug}/products', 'ProductController@get_by_sub_category' )->name( 'categories.sub-categories.products' );
Route::get( 'categories/{category_slug}/sub-categories/{sub_category_slug}/products/{code}/{slug}', 'ProductController@show' )->name( 'products.show' );

Route::resource( 'comparison', 'ComparisonController', [ 'only' => [ 'index', 'store', 'destroy' ] ] );

Route::get( 'users/{email}/get', function( $email ) {
	$user = \App\User::where( 'email', $email )->first();

	$response = [];
	if( $user )
	{
		$response = [ 'status' => 'success', 'user' => $user ];
	}
	else
	{
		$response = [ 'status' => 'fail' ];	
	}

	return response( $response, 200 );
});

Auth::routes();

Route::get( 'admin/login', function() {
	return view( 'backend.login' );
});

Route::group( [ 'middleware' => 'CheckAdminLogin' ], function() {
	
	Route::get( 'admin/dashboard', 'Backend\DashboardController@index' )->name( 'admin.dashboard' );
	
	Route::get( 'admin/users/{type}', 				'Backend\UserController@index' )->name( 'admin.userlist' );
	Route::put( 'admin/users/{user_id}/approve', 	'Backend\UserController@approve' )->name( 'admin.user.approve' );
	Route::put( 'admin/users/{user_id}/status', 	'Backend\UserController@statusUpdate' )->name( 'admin.user.status' );

	Route::resource( 'admin/categories', 'Backend\CategoryController', [
		'names' => [
	        'index'		=> 'admin.categories.index',
	        'store' 	=> 'admin.categories.store',
	        'create' 	=> 'admin.categories.create',
	        'destroy' 	=> 'admin.categories.destroy',
	        'update' 	=> 'admin.categories.update',
	        'show' 		=> 'admin.categories.show',
	        'edit' 		=> 'admin.categories.edit',
	    ]
	]);

	Route::resource( 'admin/categories/{category_id}/subcategories', 'Backend\SubCategoryController', [
		'names' => [
			'index' 	=> 'admin.subcategories.index',
	        'store'		=> 'admin.subcategories.store',
	        'create'	=> 'admin.subcategories.create',
	        'destroy' 	=> 'admin.subcategories.destroy',
	        'update' 	=> 'admin.subcategories.update',
	        'show' 		=> 'admin.subcategories.show',
	        'edit' 		=> 'admin.subcategories.edit',
	    ]
	]);

	Route::resource( 'admin/reviews', 'Backend\ReviewsController', [
		'only' => [ 'index' ],
		'names' => [
			'index' => 'admin.reviews.index'
		]
	]);

	Route::get( 'admin/reviews/{review_id}/approve', 'Backend\ReviewsController@approve' )->name( 'admin.reviews.approve' );
	Route::get( 'admin/reviews/{review_id}/reject', 'Backend\ReviewsController@reject' )->name( 'admin.reviews.reject' );

	Route::resource( 'admin/products', 'Backend\ProductController', [
		'names' => [
	        'index'		=> 'admin.products.index',
	        'store' 	=> 'admin.products.store',
	        'create' 	=> 'admin.products.create',
	        'destroy' 	=> 'admin.products.destroy',
	        'update' 	=> 'admin.products.update',
	        'show' 		=> 'admin.products.show',
	        'edit' 		=> 'admin.products.edit',
	    ]
	]);

	Route::put( 'admin/products/{id}/status/{status}', 'Backend\ProductController@status' )->name( 'admin.products.status' );

	Route::get( 'admin/requirements', 				'Backend\RequirementController@index')->name( 'admin.requirements.index' );
	Route::put( 'admin/requirements/{id}/status',	'Backend\RequirementController@status')->name( 'admin.requirements.status' );
	Route::get( 'admin/requirements/{id}/show', 	'Backend\RequirementController@show')->name( 'admin.requirements.show' );
});


Route::group( [ 'middleware' => [ 'CheckLogin' ] ], function() {
	
	Route::group( [ 'middleware' => [ 'IsProfileCreated' ] ], function() {
		
		Route::group( [ 'prefix' => 'my-account' ], function() {
			Route::resource( '/', 'MyAccount\DashboardController', [ 'only' => [ 'index' ], 'names' => [ 'index' => 'vendor.dashboard' ] ] );

			Route::get( 'products',  		'MyAccount\ProductController@index' )->name( 'my-account.product' );
			Route::get( 'products/create',  'MyAccount\ProductController@create' )->name( 'my-account.product.create' );
			Route::get( 'products/{prodcut_code}/edit',  'MyAccount\ProductController@edit' )->name( 'my-account.product.edit' );
			Route::put( 'products/{prodcut_code}/edit',  'MyAccount\ProductController@update' )->name( 'my-account.product.update' );
			Route::post( 'products/create',	'MyAccount\ProductController@store' )->name( 'my-account.product.store' );
			Route::get( 'products/{code}/gallery',	'MyAccount\ProductController@gallery' )->name( 'my-account.product.gallery' );
			Route::post( 'products/{id}/gallery/destroy',	'MyAccount\ProductController@destroy' )->name( 'my-account.product.gallery.destroy' );
			Route::post( 'products/{code}/gallery',	'MyAccount\ProductController@add_gallery' )->name( 'my-account.product.add_gallery' );
		});
	});

	Route::group( [ 'prefix' => 'buyer', 'middleware' => ['IsBuyer'] ], function() {
		Route::resource( 'dashboard', 	'Buyer\DashboardController', 	[ 'only' => [ 'index' ], 'names' => [ 'index' => 'buyer.dashboard' ] ] );
		Route::resource( 'reviews', 	'Buyer\ReviewsController', 		[ 'only' => [ 'index' ], 'names' => [ 'index' => 'buyer.reviews' ] ] );
		Route::resource( 'shortlist', 	'Buyer\ShortlistController', 	[ 
			'only' => [ 'index', 'store', 'destroy' ], 
			'names' => [ 
				'index' 	=> 'buyer.shortlist.index',
				'store' 	=> 'buyer.shortlist.store',
				'destroy'	=> 'buyer.shortlist.destroy'
			] 
		]);
		
		Route::resource( 'requirements', 	'Buyer\RequirementController',
		[
			'names' => [ 
				'index' => 'buyer.requirements',
				'create' => 'buyer.requirements.create',
				'store' => 'buyer.requirements.store',
				'edit' => 'buyer.requirements.edit',
				'update' => 'buyer.requirements.update'
			] 
		]);
	});
});


Route::resource( 'profile', 'ProfileController', [
	'except' 		=> [ 'index', 'destroy' ],
	'parameters'	=> [ 'profile' => 'user' ]
]);

Route::group( [ 'prefix' => 'vendors/{vendor_code}' ], function() {
	Route::resource( 'reviews', 'ReviewsController', [ 
		'only' => [ 'index', 'store' ],
		'names' => [
			'index' => 'vendors.reviews.index',
			'store' => 'vendors.reviews.store'
		] 
	]);
});


Route::get( '/', 					'HomeController@index' )->name( 'home' );
Route::get( 'verifyemail/{token}',	'Auth\RegisterController@verify' );

Route::post( 'get_country_state', function( Request $request ) {
	return \App\Country::find( $request->country_id )->state;
});

Route::post( 'get_state_city', function( Request $request ) {
	return \App\State::find( $request->state_id )->city;
});

Route::post( 'get_sub_category', function( Request $request ) {
	return \App\SubCategory::where( 'category_id', $request->category_id )->get();
});

