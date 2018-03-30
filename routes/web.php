<?php

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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');