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
Route::get( '/recover-password', function () {
    return view( 'frontend.recover_password' );
});

Route::get( '/contact', function() {
	return view( 'frontend.contact' )->with( 'blue_menu', true );
})->name( 'contact' );


Route::get('/products', 'ProductController@index')->name('products');
Route::get('/categories/{category_slug}/products', 'ProductController@get_by_category')->name('categories.products');
Route::get('/categories/{category_slug}/sub-categories/{sub_category_slug}/products', 'ProductController@get_by_sub_category')->name('categories.sub-categories.products');


Auth::routes();

Route::get( 'admin/login', function() {
	return view( 'backend.login' );
});

Route::group( [ 'middleware' => 'CheckAdminLogin' ], function() {
	
	Route::get( '/admin/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
	
	Route::get('/admin/users/{type}', 				'Backend\UserController@index')->name('admin.userlist');
	Route::put('/admin/users/{user_id}/approve/', 	'Backend\UserController@approve')->name('admin.user.approve');
	Route::put('/admin/users/{user_id}/status/', 	'Backend\UserController@statusUpdate')->name('admin.user.status');
	// Route::get('/admin/user/vendors', 'Backend\VendorController@index')->name('admin.buyer');
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

	Route::resource( 'reviews', 'Backend\ReviewsController', [
		'only' => [ 'index' ]
	]);
	Route::get( 'reviews/{review_id}/approve', 'Backend\ReviewsController@approve' )->name( 'reviews.approve' );
	Route::get( 'reviews/{review_id}/reject', 'Backend\ReviewsController@reject' )->name( 'reviews.reject' );
});


Route::group( [ 'middleware' => 'CheckLogin' ], function() {
	Route::resource( '/profile', 'ProfileController', [
		'except' 		=> [ 'index', 'destroy' ],
		'parameters'	=> [ 'profile' => 'user' ]
	]);

	Route::group( [ 'prefix' => 'my-account' ], function() {
		Route::resource( '/', 'MyAccount\DashboardController', [ 'only' => [ 'index' ], 'names' => [ 'index' => 'vendor.dashboard' ] ] );

		Route::get( 'products',  		'MyAccount\ProductController@index' )->name( 'my-account.product' );
		Route::get( 'products/create',  'MyAccount\ProductController@create' )->name( 'my-account.product.create' );
		Route::get( 'products/{prodcut_code}/edit',  'MyAccount\ProductController@edit' )->name( 'my-account.product.edit' );
		Route::put( 'products/{prodcut_code}/edit',  'MyAccount\ProductController@update' )->name( 'my-account.product.update' );
		Route::post( 'products/create',	'MyAccount\ProductController@store' )->name( 'my-account.product.store' );

	});

	Route::group( [ 'prefix' => 'buyer' ], function() {
		Route::resource( 'dashboard', 	'Buyer\DashboardController', 	[ 'only' => [ 'index' ], 'names' => [ 'index' => 'buyer.dashboard' ] ] );
		Route::resource( 'reviews', 	'Buyer\ReviewsController', 		[ 'only' => [ 'index' ], 'names' => [ 'index' => 'buyer.reviews' ] ] );
		Route::resource( 'shortlist', 	'Buyer\ShortlistController', 	[ 'only' => [ 'index' ], 'names' => [ 'index' => 'buyer.shortlist' ] ] );
	});
});



Route::group( [ 'prefix' => 'vendors/{vendor_code}' ], function() {
	Route::resource( 'reviews', 'ReviewsController', [ 
		'only' => [ 'index', 'store' ],
		'names' => [
			'index' => 'vendors.reviews.index',
			'store' => 'vendors.reviews.store'
		] 
	]);
});


// Route::get( 'users/{$user_code}/profile', 'ProfileController@show' )->name( 'profile.show' );


Route::get( '/', 					'HomeController@index' )->name( 'home' );
Route::get( 'verifyemail/{token}',	'Auth\RegisterController@verify' );

Route::post( 'get_country_state', function( Request $request ) {
	return App\Country::find( $request->input( 'country_id' ) )->state;
});

Route::post( 'get_state_city', function( Request $request ) {
	return App\State::find( $request->input( 'state_id' ) )->city;
});

Route::post( 'get_sub_category', function( Request $request ) {
	return App\SubCategory::where( 'category_id', $request->input( 'category_id' ) )->get();
});

