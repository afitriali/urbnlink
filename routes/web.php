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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::domain('dashboard.'.env('DEFAULT_DOMAIN', 'urbn.link'))->group(function () {
	Route::post('/link/statistics', 'LinkController@showStatistics');
	Route::get('/{any}', function () {
		return view('dashboard');
	})->where('any', '.*')->middleware(['auth', 'verified']);
});

// Link Routes
Route::domain('api.'.env('DEFAULT_DOMAIN', 'urbn.link'))->group(function () {
	Route::post('/check/name', 'LinkController@checkName');
	Route::post('/check/url', 'LinkController@checkUrl');
	Route::post('/link/create', 'LinkController@create');
	Route::post('/link/delete', 'LinkController@delete');
	Route::post('/link/statistics', 'LinkController@showStatistics');
});

// Forward Routes
Route::domain('{domain}')->group(function () {
	Route::get('{name}', 'ForwardController@forward');
});
