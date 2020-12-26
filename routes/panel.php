<?php


Route::group(['prefix' => 'panel', 'as' => 'panel.'], function () {

    Route::post('upload', 'MediaController@upload')->name('index');
    Route::post('delete', 'MediaController@delete')->name('index');


    Route::get('/', function () {
        return redirect(route('panel.showLogin'));
    });

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('showLogin');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    /*
     * Reset Password Routes
     */

    Route::group(['prefix' => 'password/', 'namespace' => 'Auth', 'as' => 'password.'], function () {
        Route::post('email', ['as' => 'email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
        Route::get('reset/{token}', ['as' => 'reset', 'uses' => 'ResetPasswordController@showResetForm']);
        Route::post('reset', ['as' => 'update', 'uses' => 'ResetPasswordController@reset']);
    });


    Route::group(['middleware' => 'auth:admin'], function () {

//        Route::post('upload', 'ImageController@upload')->name('index');
//        Route::post('delete', 'ImageController@delete')->name('index');


        Route::get('index', 'HomeController@index')->name('index');


        Route::get('admins/', ['as' => 'admins.index' , 'uses' =>'AdminController@index']);
        Route::resource('admins', 'AdminController')->except(['show' , 'index']);
        Route::get('admins/datatable', 'AdminController@datatable');


        Route::group(['prefix' => 'profile' , 'as' =>'profile.'], function () {
            Route::get('/' , ['as' => 'show'  , 'uses' => 'AdminController@showProfile']);
            Route::post('/' , ['as' => 'update'  , 'uses' => 'AdminController@updateProfile']);
        });


        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {

            Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::get('/datatable', ['as' => 'datatable', 'uses' => 'UserController@datatable']);

            Route::group(['prefix' => 'create' ], function () {
                Route::get('/', ['as' => 'create', 'uses' => 'UserController@create']);
                Route::post('/', ['as' => 'store', 'uses' => 'UserController@store']);
            });
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
                Route::put('/', ['as' => 'update', 'uses' => 'UserController@update']);
                Route::delete('/', ['as' => 'destry', 'uses' => 'UserController@destroy']);
            });

        });


        Route::group(['prefix' => 'shops', 'as' => 'shops.'], function () {

            Route::get('/', ['as' => 'index', 'uses' => 'ShopController@index']);

            Route::group(['prefix' => 'create' ], function () {
                Route::get('/', ['as' => 'create', 'uses' => 'ShopController@create']);
                Route::post('/', ['as' => 'store', 'uses' => 'ShopController@store']);
            });
            Route::get('datatable', ['as' => 'datatable' , 'uses' =>  'ShopController@datatable']);

            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'update', 'uses' => 'ShopController@edit']);
                Route::put('/edit', ['as' => 'update', 'uses' => 'ShopController@update']);
                Route::delete('/', ['as' => 'destroy', 'uses' => 'ShopController@destroy']);
            });
        });

        Route::group(['prefix' => 'catagories', 'as' => 'catagories.'], function () {

            Route::get('/', ['as' => 'index', 'uses' => 'CatagoryController@index']);
            Route::get('/datatable', ['as' => 'datatable', 'uses' => 'CatagoryController@datatable']);

            Route::group(['prefix' => 'create' ], function () {
                Route::get('/', ['as' => 'create', 'uses' => 'CatagoryController@create']);
                Route::post('/', ['as' => 'store', 'uses' => 'CatagoryController@store']);
            });
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'edit', 'uses' => 'CatagoryController@edit']);
                Route::put('/edit', ['as' => 'update', 'uses' => 'CatagoryController@update']);
                Route::delete('/', ['as' => 'destry', 'uses' => 'CatagoryController@destroy']);
            });

        });

        Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {

            Route::get('/', ['as' => 'index', 'uses' => 'BlogController@index']);
            Route::get('/datatable', ['as' => 'datatable','uses' => 'BlogController@datatable']);

            Route::group(['prefix' => 'create'], function () {
                Route::get('/', ['as' => 'create', 'uses' => 'BlogController@create']);
                Route::post('/', ['as' => 'store', 'uses' => 'BlogController@store']);
            });
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'edit', 'uses' => 'BlogController@edit']);
                Route::put('/edit', ['as' => 'update', 'uses' => 'BlogController@update']);
                Route::delete('/', ['as' => 'destroy', 'uses' => 'BlogController@destroy']);
            });
        });


        Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {

            Route::get('/', ['as' => 'index', 'uses' => 'CouponController@index']);
            Route::get('/datatable', ['as' => 'datatable', 'uses' => 'CouponController@datatable']);

            Route::group(['prefix' => 'create' ], function () {
                Route::get('/', ['as' => 'create', 'uses' => 'CouponController@create']);
                Route::post('/', ['as' => 'store', 'uses' => 'CouponController@store']);
            });
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'edit', 'uses' => 'CouponController@edit']);
                Route::put('/edit', ['as' => 'update', 'uses' => 'CouponController@update']);
                Route::delete('/', ['as' => 'destry', 'uses' => 'CouponController@destroy']);
            });

        });


        Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {

            Route::get('/', ['as' => 'index', 'uses' => 'PageController@index']);
            Route::get('/datatable', ['as' => 'datatable','uses' => 'PageController@datatable']);

            Route::group(['prefix' => 'create'], function () {
                Route::get('/', ['as' => 'create', 'uses' => 'PageController@create']);
                Route::post('/', ['as' => 'store', 'uses' => 'PageController@store']);
            });
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', ['as' => 'edit', 'uses' => 'PageController@edit']);
                Route::put('/edit', ['as' => 'update', 'uses' => 'PageController@update']);
                Route::delete('/', ['as' => 'destry', 'uses' => 'PageController@destroy']);
            });

        });

        Route::group(['prefix' => 'complaint', 'as' => 'complaint.'], function () {
            Route::get('/' , ['as' => 'index' , 'uses' => 'ComplaintController@index']);
            Route::get('datatable' , 'ComplaintController@datatable');

            Route::group(['prefix' => '{id}'], function () {
                Route::delete('/' , 'ComplaintController@destroy');
                Route::get('show' , 'ComplaintController@show');
            });
        });

        Route::group(['prefix' => 'suggestions', 'as' => 'suggestions.'], function () {
            Route::get('/' , ['as' => 'index' , 'uses' => 'SuggestionController@index']);
            Route::get('datatable' , 'SuggestionController@datatable');

            Route::group(['prefix' => '{id}'], function () {
                Route::delete('/' , 'SuggestionController@destroy');
                Route::get('show' , 'SuggestionController@show');
            });
        });

        Route::group(['prefix' => 'replay', 'as' => 'replay.'], function () {
            Route::post('/', ['as' => 'store', 'uses' => 'ReplayController@store']);
        });

        Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
            Route::get('/' , ['as' => 'index' , 'uses' => 'ContactController@index']);
            Route::get('datatable' , 'ContactController@datatable');


            Route::group(['prefix' => '{id}'], function () {
                Route::get('/show', ['as' => 'edit', 'uses' => 'ContactController@show']);
                Route::get('/show-replay', ['as' => 'update', 'uses' => 'ContactController@showReplay']);
                Route::delete('/', ['as' => 'destroy', 'uses' => 'ContactController@destroy']);
            });

            Route::post('add-replay' , 'ContactController@replay')->name('replay');
        });


        Route::group(['as'=>'notifications.' , 'prefix'=>'notifications'], function () {
            Route::get('/create', ['as' => 'create' , 'uses'    => 'NotificationController@create']);
            Route::post('/create', ['as' => 'send' , 'uses'    => 'NotificationController@storeAndSend']);
        });


        Route::resource('settings', 'SettingsController')->except(['create', 'edit', 'show', 'destroy']);


    });


});
