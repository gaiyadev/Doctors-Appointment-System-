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

//api calls for doctor(aadmin)
Route::post('api/doctor', 'AdminController@store');
Route::get('api/doctor', 'AdminController@index');
Route::delete('api/doctor/{id}', 'AdminController@destroy');
Route::put('api/doctor/{id}', 'AdminController@update');

//..get use email
//Route::get('api/userEmail', 'AppointmentController@getEmail');

//complain
Route::post('api/complain', 'ComplainController@store');
Route::get('api/complain', 'ComplainController@index');
Route::delete('api/complain/{id}', 'ComplainController@destroy');


//change password for user
Route::post('api/change', 'UserChangePasswordController@changePassword');
//update user4 info
Route::get('api/profile', 'UserUpdateProfileController@show');
Route::put('api/user/{id}', 'UserUpdateProfileController@updateInfo');





Route::get('/{any}', 'HomeController@index')->where('path', ' ([A-z\d-\/_.]+)?');



