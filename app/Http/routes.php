<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/test', function(){
        return view('fbSchedule');
    });

    Route::get('/fb-login', 'FacebookController@getLogin');
    Route::get('/fb-login-callback', 'FacebookController@getCallback');
    Route::get('/fb/disconnect', 'FacebookController@disconnect');

    Route::get('twitter', 'TwitterController@index');
    Route::get('twitter/callback', 'TwitterController@callback');
    Route::get('twitter/tweet', 'TwitterController@postTweet');
    Route::get('twitter/disconnect', 'TwitterController@disconnect');

    Route::resource('/campaigns', 'CampaignsController');
    Route::get('/campaigns/schedule/{id}', 'CampaignsController@getSchedule');
    Route::auth();

    Route::get('/', 'HomeController@index');
    Route::get('/pages/{type}/{campaign_id}/{url}', 'PagesController@showPage');
    Route::get('/pages', 'PagesController@index');
    
    Route::get('/home', 'HomeController@index');
    Route::get('/installation', 'HomeController@installation');

    Route::get('/hello-bar-manage', 'HelloBarController@index');
    Route::get('/hello-bar-create', 'HelloBarController@create');
    Route::post('/hello-bar-create', 'HelloBarController@store');
    Route::get('/hello-bar-edit/{id}', 'HelloBarController@show');
    Route::post('/hello-bar-update/{id}', 'HelloBarController@update');
    Route::post('/hello-bar-delete/{id}', 'HelloBarController@delete');

    Route::get('/traffic-manage', 'TrafficGenerationController@index');
    Route::get('/traffic-create', 'TrafficGenerationController@create');
    Route::post('/traffic-create', 'TrafficGenerationController@store');
    Route::get('/traffic-edit/{id}', 'TrafficGenerationController@show');
    Route::post('/traffic-update/{id}', 'TrafficGenerationController@update');
    Route::post('/traffic-delete/{id}', 'TrafficGenerationController@delete');

    Route::get('/hello-bar-preview', 'HelloBarController@helloBarPreview');
    Route::get('/hello-bar-preview/{token}', 'HelloBarController@helloBarEmbed');

    Route::get('/traffic-preview', 'TrafficGenerationController@trafficPreview');
    Route::get('/traffic-preview/{token}', 'TrafficGenerationController@trafficEmbed');

    Route::get('/hello-bar-add-click/{token}', 'HelloBarController@addClick');

    Route::get('/traffic-add-click/{token}', 'TrafficGenerationController@addClick');

    Route::get('/settings', 'SettingsController@index');
    Route::post('settings/get-response-api-connect', 'SettingsController@getResponseApiConnect');
    Route::post('settings/connect-aweber-api', 'SettingsController@connectAweberApi');
    Route::get('settings/connect-aweber-api-callback', 'SettingsController@connectAweberApiCallback');
    Route::get('settings/get-response-api-list', 'SettingsController@getResponseList');
    Route::get('settings/get-aweber-api-list', 'SettingsController@aweberList');
    Route::get('settings/get-mail-chimp-api-list', 'SettingsController@mailChimpList');
    Route::get('settings/connect-mail-chimp-api', 'SettingsController@connectMailChimpApi');
    Route::delete('settings/email-api-disconnect/{id}', 'SettingsController@emailApiDisconnect');
    Route::post('settings/create-subscriber/{user_id}/{email_provider}/{email_provider_value}', 'SettingsController@createSubscriber');    
    Route::resource('/bookmarklet', 'BookmarkletController');
});
