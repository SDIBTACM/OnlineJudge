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
// dev view
//Route::get('views', function() {
//    $user = App\User::first();
//    return (new App\Mails\ResetPasswordMail($user, "test-token"));
//});

// General
Route::get('/', 'HomeController@index')->name('index');

// Auth Route
Route::namespace('Auth')->group(function (){
    // Login
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');

    // Logout
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Register
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register');

    // Reset password
    Route::prefix('password/')->group(function() {
        Route::get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset', 'ResetPasswordController@reset')->name('password.update');
    });

    // verity email
    Route::prefix('email/')->group(function () {
        Route::get('verify', 'VerificationController@show')->name('verification.notice');
        Route::get('verify/{id}', 'VerificationController@verify')->name('verification.verify');
        Route::get('resend', 'VerificationController@resend')->name('verification.resend');
    });
});


// App Route
Route::namespace('App')->group(function () {
    // User Route (user info, user
    Route::namespace('User')->prefix('user')->group(function() {
        Route::get('info/{user_id?}', 'UserInfoController@show')->name('user.info');

        Route::get('password', 'ChangePasswordController@showFrom')->name('user.reset_password_from');
        Route::post('password', 'ChangePasswordController@update')->name('user.reset_password');
    });

});


// Teacher

// Admin


//Other
Route::get('/teapot', 'NoNeedToHaveController@teapot')->name('teapot');

