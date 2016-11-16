<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('fels');
});

// Authentication Routes...
Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/reset', 'ResetPasswordController@reset');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');

    Route::post('register', 'RegisterController@register');

    Route::get('/redirect/{provider}', 'LoginController@redirectToProvider');
    Route::get('auth/callback/{provider}', 'LoginController@handleProviderCallback');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index');

    Route::resource('category', 'CategoriesController');

    Route::resource('word', 'WordsController');

    Route::resource('user', 'UsersController');
});

Route::group(['namespace' => 'Web', 'middleware'=> 'auth'], function() {
    Route::resource('profile', 'ProfilesController', ['except' => [
        'create', 'store', 'delete', 'index',
    ]]);
    Route::get('change-password', 'ProfilesController@editPassword');
    Route::put('change-password', 'ProfilesController@updatePassword');
    Route::resource('category', 'CategoriesController', ['only' => [
        'index', 'show',
    ]]);
    Route::get('lesson/do/{category_id}', 'LessonsController@doLesson');
    Route::resource('lesson', 'LessonsController', ['only' => [
        'index', 'show', 'store',
    ]]);
    Route::get('wordlist', 'WordsController')->name('wordlist');
    Route::post('download', 'WordsController@download')->name('download');

    Route::post('/follow/{id}', 'FollowsController@follow');
    Route::post('/unfollow/{id}', 'FollowsController@unfollow');
});
