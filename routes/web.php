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

Auth::routes(['verify' => true]);

Route::domain(env('HOME_DOMAIN', 'urbn.link'))->group(function () {
	Route::get('/', function () {
    	return view('welcome');
	});
	Route::get('/home', 'HomeController@index')->name('home');
});

Route::domain(env('DASHBOARD_DOMAIN', 'dashboard.urbn.link'))->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/{any}', function () {
		return view('dashboard');
	})->where('any', '.*')->middleware(['auth', 'verified']);
});

Route::domain(env('API_DOMAIN', 'api.urbn.link'))->group(function () {
	Route::post('/check/name', 'LinkController@checkName');
	Route::post('/check/url', 'LinkController@checkUrl');
	Route::post('/link/create', 'LinkController@create');
	Route::post('/link/delete', 'LinkController@delete');
	Route::post('/project/invite', 'ProjectController@inviteMember');
});

Route::domain(env('DEFAULT_SHORT_DOMAIN', 'ur.bn'))->group(function () {
	Route::get('/', function () {
    	return redirect()->away(env('APP_URL', 'https://urbn.link'));
	});
});

Route::domain('{domain}')->group(function () {
	Route::get('/', function () {
    	return view('welcome');
	});
	Route::get('{name}+', 'LinkController@getStatistics');
	Route::get('{name}', 'ForwardController@forward');
});
