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
Route::Redirect('/', '/login', 303);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/* Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
*/
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/dashboard', 'Web\DashboardController@index')->name('dashboard');
Route::get('/pwd', 'Web\ManageLinesController@index');


Route::group(['prefix' => 'messages', 'middleware' => 'auth'], function () {
    Route::get('/', 'Web\MessagesController@index')->name('messages');
    Route::get('create', 'Web\MessagesController@create')->name('messages.create');
    Route::post('/', 'Web\MessagesController@store')->name('messages.store');
    Route::get('{id}', 'Web\MessagesController@show')->name('messages.show');
    Route::put('{id}', 'Web\MessagesController@update')->name('messages.update');
});