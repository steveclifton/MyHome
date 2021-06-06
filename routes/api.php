<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api', 'throttle:10,1')->post('/home/reading', 'Api\ApiController@handle');
Route::middleware('auth:api', 'throttle:10,1')->get('/home/current', 'Api\ApiController@getMyCurrentHomeData');


