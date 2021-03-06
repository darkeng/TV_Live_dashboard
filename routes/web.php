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

Route::get('firstLogin', 'Web\UserController@showChangePassword')->name('user.changepasswordform');
Route::post('changepass', 'Web\UserController@changePassword')->name('user.changepassword');

Route::get('confirmemail/{token}', 'Web\UserController@confirmEmail')->name('user.confirmemail');
Route::get('download', 'IndexController@ShowDowloadForm')->name('downloadapkform');
Route::post('download', 'IndexController@DowloadAPK')->name('downloadapk');

Route::prefix('dashboard')->group(function(){
    Route::middleware(['auth', 'activated'])->group(function(){
        Route::get('/', 'Web\HomeController@index')->name('dashboard');
        Route::get('/home', 'Web\HomeController@index')->name('dashboard.home');
        
        Route::get('line/extend', 'Web\LineController@ShowExtendForm')->name('line.showextendform');
        Route::post('line/extending', 'Web\LineController@extend')->name('line.extending');
        Route::get('line/manage', 'Web\LineController@showManageLines')->name('line.manage');
        Route::get('line/create', 'Web\LineController@ShowAddForm')->name('line.showaddform');
        Route::post('line/store', 'Web\LineController@storeLine')->name('line.store');
        Route::get('line/{id}/edit', 'Web\LineController@ShowEditForm')->name('line.edit');
        Route::post('line/{id}/update', 'Web\LineController@updateLine')->name('line.update');
        Route::delete('line/{id}/delete', 'Web\LineController@deleteLine')->name('line.delete');

        Route::get('package/{id}', 'Web\LineController@getPackageInfo')->name('package.info');

        Route::put('user/{id}/resetpass', 'Web\UserController@resetPassword')->name('user.resetpass');
        Route::get('user/{id}/sendconfirm', 'Web\UserController@sendConfirmEmail')->name('user.sendconfirm');

        Route::resource('user', 'Web\UserController');

    });
});

/*Route::group(['prefix' => 'messages', 'middleware' => 'auth'], function () {
    Route::get('/', 'Web\MessagesController@index')->name('messages');
    Route::get('create', 'Web\MessagesController@create')->name('messages.create');
    Route::post('/', 'Web\MessagesController@store')->name('messages.store');
    Route::get('{id}', 'Web\MessagesController@show')->name('messages.show');
    Route::put('{id}', 'Web\MessagesController@update')->name('messages.update');
});*/