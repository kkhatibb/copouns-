<?php

use Illuminate\Http\Request;

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

Route::group(['prefix'=>'auth','namespace'=>'Auth'], function () {

    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
    Route::post('login-by-apple', 'AppleLoginController@loginByApple');

    Route::post('logout', 'LoginController@logout')->middleware('auth:api');
    Route::post('fcmToken', 'LoginController@fcmToken')->middleware('auth:api');

    Route::post('forgotPassword', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('social-login', 'LoginController@socialLogin');
});
Route::post('auth/updateProfile', 'UserController@updateProfile')->middleware('auth:api');


/*
 * General Requests
 */

Route::get('shops' , 'ShopController@index');
Route::get('catagories' , 'CatagoryController@index');
Route::get('settings' , 'SettingsController@index');

Route::post('complaint' , 'ComplaintController@store');
Route::post('suggestion' , 'SuggestionController@store');

Route::group(['prefix' => 'coupons'], function () {
    Route::get('/', 'CouponController@index');
    Route::get('/usefull', 'CouponController@getUsefullCoupons')->middleware('auth:api');
    Route::post('/isUsefull', 'CouponController@isUsefull');
    Route::post('/fav', 'CouponController@fav')->middleware('auth:api');
    Route::get('/fav', 'CouponController@getAllFav')->middleware('auth:api');
});
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'BlogController@index');
    Route::get('{id}/show', 'BlogController@show');
});
