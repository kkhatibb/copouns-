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
Route::get('image/{folder}/{path}/{size?}', 'Controller@photo');

Route::get('lang/{lang}', 'Front\HomeController@changeLang');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('/', 'Front\HomeController@index');
    Route::get('/privacy-policy', 'Front\HomeController@privacyPolicy');
    Route::get('/contacts', 'Front\HomeController@showContacts');
    Route::post('/contacts', 'Front\HomeController@contacts');

});
