<?php
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
Route::match( [ 'get', 'post'], 'products/search', 'ProductController@search' )->name( 'products.search' );
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
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::group( [ 'prefix' => 'social-auth' ], function() {
	// Google
	Route::group( [ 'prefix' => 'google' ], function() {
		Route::get( 'redirect',	'SocialAuthController@googleRedirect' )->name( 'google.login' );
		Route::get( 'handle',	'SocialAuthController@googleHandle' );
	});
	// FACEBOOK
	Route::group( [ 'prefix' => 'fb' ], function() {
		Route::get( 'redirect',	'SocialAuthController@fbRedirect' )->name( 'fb.login' );
		Route::get( 'handle',	'SocialAuthController@fbHandle' );
	});

});

Route::get( 'admin/login', function() {
	return view( 'backend.login' );
});

Route::group( [ 'middleware' => 'CheckAdminLogin', 'namespace' => 'Backend' ], function() {
	
	Route::get( 'admin/dashboard', 'DashboardController@index' )->name( 'admin.dashboard' );
	
	Route::get( 'admin/users/{type}', 				'UserController@index' )->name( 'admin.userlist' );
	Route::put( 'admin/users/{user_id}/approve', 	'UserController@approve' )->name( 'admin.user.approve' );
	Route::put( 'admin/users/{user_id}/status', 	'UserController@statusUpdate' )->name( 'admin.user.status' );
	Route::post( 'admin/users/product_limit', 	'UserController@productLimit' );
	Route::get( 'admin/users/vendor/create', 	'UserController@create' )->name( 'admin.vendor.create' );;
	Route::post( 'admin/users/vendor/create', 	'UserController@store' )->name( 'admin.vendor.store' );;

	Route::resource( 'admin/categories', 'CategoryController', [
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

	Route::resource( 'admin/categories/{category_id}/subcategories', 'SubCategoryController', [
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

	Route::resource( 'admin/products', 'ProductController', [
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

	Route::put( 'admin/products/{id}/status/{status}', 'ProductController@status' )->name( 'admin.products.status' );

	Route::resource( 'admin/reviews', 'ReviewsController', [
		'only' => [ 'index' ],
		'names' => [
			'index' => 'admin.reviews.index'
		]
	]);

	Route::get( 'admin/reviews/{review_id}/approve',	'ReviewsController@approve' )->name( 'admin.reviews.approve' );
	Route::get( 'admin/reviews/{review_id}/reject', 	'ReviewsController@reject' )->name( 'admin.reviews.reject' );

	Route::resource( 'admin/messages', 'MessagesController', [
		'only' => [ 'index', 'show' ],
		'names' => [
			'index' => 'admin.messages.index',
			'show'	=> 'admin.messages.show'
		]
	]);

	// Route::get( 'admin/requirements', 				'RequirementController@index')->name( 'admin.requirements.index' );
	Route::put( 'admin/requirements/{id}/status',	'RequirementController@status')->name( 'admin.requirements.status' );
	// Route::get( 'admin/requirements/{id}/show', 	'RequirementController@show')->name( 'admin.requirements.show' );

	Route::resource( 'admin/requirements', 'RequirementController', [ 
		'only'	=> [ 'index', 'show' ], 
		'names'	=> [ 
			'index' => 'admin.requirements.index', 
			'show' 	=> 'admin.requirements.show', 
		] 
	]);

	Route::resource( 'admin/reports', 'ReportsController', [
		'only' 	=> [ 'index', 'show' ],
		'names'	=> [ 
			'index' => 'admin.reports.index', 
			'show'	=> 'admin.reports.show'  
		],
	]);
});


Route::group( [ 'middleware' => [ 'CheckLogin' ] ], function() {

	Route::get( 'password/change', 'ChangePasswordController@index' )->name( 'password.change.index');
	Route::post( 'password/change', 'ChangePasswordController@store' )->name( 'password.change.store');;
	
	Route::resource( 'reports', 'ReportsController', [ 'only' => [ 'store' ] ] );

	Route::group( [ 'middleware' => [ 'IsProfileCreated' ] ], function() {
		
		Route::group( [ 'prefix' => 'my-account', 'namespace' => 'MyAccount' ], function() {
			Route::resource( '/', 'DashboardController', [ 
				'only' 	=> [ 'index' ],
				'names' => [ 'index' => 'vendor.dashboard' ] 
			]);

			Route::get( 'products',  						'ProductController@index' )->name( 'my-account.product' );
			
			Route::group( [ 'middleware' => [ 'IsVendorApproved' ] ], function() {
				Route::get( 'products/create',  				'ProductController@create' )->name( 'my-account.product.create' );
				Route::get( 'products/{prodcut_code}/edit',  	'ProductController@edit' )->name( 'my-account.product.edit' );
				Route::put( 'products/{prodcut_code}/edit',  	'ProductController@update' )->name( 'my-account.product.update' );
				Route::post( 'products/create',					'ProductController@store' )->name( 'my-account.product.store' );
				Route::get( 'products/{code}/gallery',			'ProductController@gallery' )->name( 'my-account.product.gallery' );
				Route::post( 'products/{id}/gallery/destroy',	'ProductController@destroy' )->name( 'my-account.product.gallery.destroy' );
				Route::get( '{code}/products',					'ProductController@show' )->name( 'my-account.product.show' );
				Route::post( 'products/{code}/gallery',			'ProductController@add_gallery' )->name( 'my-account.product.add_gallery' );
			});
		});

		Route::resource( 'messages', 'MessagesController', [
			'only' => [ 'index', 'store', 'show' ]
		]);

		Route::post( 'messages/{message}/reply', 'MessagesController@reply' )->name( 'messages.reply' );
	});

	Route::group( [ 'prefix' => 'buyer', 'middleware' => [ 'IsBuyer' ] ], function() {
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
		
		Route::resource( 'requirements', 'Buyer\RequirementController', [
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


Route::get( '/',							'HomeController@index' )->name( 'home' );

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

