<?php

use Illuminate\Support\Facades\Route;


/**
 * Non-Logged in user welcome page
 */
Route::get('/', 'HomeController@index')->name('home');


/**
 * Auth
 */
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('forgot-password', 'Auth\ForgotPasswordController@showPasswordReset');
Route::post('forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


/**
 * User Home Page
 */
Route::get('home', 'MyHomeController@index')->name('myhome');
Route::get('tokens', 'MyHomeController@getTokens')->name('tokens');


/**
 * Last resort, redirect to welcome
 */
Route::any('/{any}', function() {
    return redirect('home');
});
