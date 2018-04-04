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

// Route::get('/', function () {
//     return view('frontend.index');
// });

// Route::get('/login', function () {
//     return view('frontend.login');
// });

// Route::get('/signup', function () {
//     return view('frontend.signup');
// });

Route::get('/recover-password', function () {
    return view('frontend.recover_password');
});

Route::get('/contact', function(){
	return view('frontend.contact')->with( 'blue_menu', true );
})->name("contact");

Route::get('/products', function(){
	return view('frontend.products')->with( 'blue_menu', true );
})->name("products");

Auth::routes();
Route::get('admin/login', function()
{
	return view('backend.login');
});

Route::group(['middleware' => 'CheckAdminLogin'], function(){
	
	Route::get('/admin/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
	
	Route::get('/admin/users/{type}', 'Backend\UserController@index')->name('admin.userlist');
	Route::put('/admin/users/{user_id}/approve/', 'Backend\UserController@approve')->name('admin.user.approve');
	// Route::get('/admin/user/vendors', 'Backend\VendorController@index')->name('admin.buyer');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');