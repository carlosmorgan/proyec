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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
 Route::resource('user/articulo','ArticuloUserController');
 Route::resource('user/categoria','CategoriaUserController');

 Route::resource('user/compras','ComprasUserController');

 Route::resource('user/marca','MarcaUserController');

 Route::resource('user/ventas','VentaUserController');

//Route::prefix('admin')->group(function() {
    Route::get('admin/', 'AdminController@index')->name('admin.home');
    Route::get('admin/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::post('admin/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('admin/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('admin/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('admin/password/reset', 'AuthAdmin\ResetPasswordController@reset');

    Route::resource('admin/categoria','CategoriaAdminsController');
    //Route::get('admin/categoria/create','CategoriaAdminsController@create');
    Route::resource('admin/articulo','ArticuloAdminsController');
    // Route::get('admin/articulo/create','ArticuloAdminsController@create');
	Route::resource('admin/marca','MarcaAdminsController');

    Route::resource('admin/compras','IngresoAdminsController');
//   });