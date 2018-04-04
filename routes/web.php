<?php
use App\Http\Middleware\CheckAdminLogin;
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
Route::get('/recover-password', function () {
    return view('frontend.recover_password');
});

Route::get('/contact', function(){
	return view('frontend.contact');
})->name("contact");

Auth::routes();
Route::get('admin/login', function()
{
	return view('backend.login');
});

Route::group(['middleware' => 'CheckAdminLogin'], function(){
	
	Route::get('/admin/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
	
	Route::get('/admin/users/{type}', 'Backend\UserController@index')->name('admin.userlist');
	Route::put('/admin/users/{user_id}/approve/', 'Backend\UserController@approve')->name('admin.user.approve');
	Route::put('/admin/users/{user_id}/status/', 'Backend\UserController@statusUpdate')->name('admin.user.status');
	// Route::get('/admin/user/vendors', 'Backend\VendorController@index')->name('admin.buyer');
	Route::resource('admin/categories', 'Backend\CategoryController', [
		'names' => [
	        'index' => 'admin.categories.index',
	        'store' => 'admin.categories.store',
	        'create' => 'admin.categories.create',
	        'destroy' => 'admin.categories.destroy',
	        'update' => 'admin.categories.update',
	        'show' => 'admin.categories.show',
	        'edit' => 'admin.categories.edit',
	    ]
	]);


	Route::resource('admin/categories/{category_id}/subcategories', 'Backend\SubCategoryController', [
		'names' => [
			'index'=> 'admin.subcategories.index',
	        'store' => 'admin.subcategories.store',
	        'create' => 'admin.subcategories.create',
	        'destroy' => 'admin.subcategories.destroy',
	        'update' => 'admin.subcategories.update',
	        'show' => 'admin.subcategories.show',
	        'edit' => 'admin.subcategories.edit',
	    ]
	]);


});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');