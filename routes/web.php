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

//normal
Route::get('/', 'HomeController@index')->name('index');

// Auth Route
Route::namespace('Auth')->group(function (){
    // Login
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');

    // Logout
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('logout', 'LoginController@logout')->name('logout');

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

// Teacher

//Admin


//Other
Route::get('/teapot', 'NoNeedToHaveController@teapot')->name('teapot');

