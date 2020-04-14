<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');


//routes for admin
Route::get('admin/home', 'AdminController@index')->name('admin.home');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('Admin.show');
Route::POST('slogin', 'Admin\LoginController@login')->name('admin.login');

//done
Route::POST('admin-password/email', 'Admin\ResetPasswordController@sendRequestLinkEmail')->name('admin.password.email');


Route::get('admin-register', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.register');
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
//next
Route::POST('admin-password/reset', 'Admin\ResetPasswordController@reset')->name('admin.password.update');

Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');


//api calls for appointment
Route::post('api/appointment', 'AppointmentController@store');
Route::get('api/appointment', 'AppointmentController@index');
Route::delete('api/appointment/{id}', 'AppointmentController@destroy');
Route::put('api/appointment/{id}', 'AppointmentController@update');



Route::get('/{any}', 'HomeController@index')->where('path', ' ([A-z\d-\/_.]+)?');



