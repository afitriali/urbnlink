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

Route::domain(env('HOME_DOMAIN', 'urbn.link'))->group(function () {
	Auth::routes(['verify' => true]);
	Route::get('/', function () {
    	return view('welcome');
	});
});

Route::domain(env('DASHBOARD_DOMAIN', 'dashboard.urbn.link'))->group(function () {
	Auth::routes(['verify' => true]);
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/{any}', function () {
		return view('dashboard');
	})->where('any', '.*')->middleware(['auth', 'verified']);
});

Route::domain(env('API_DOMAIN', 'api.urbn.link'))->group(function () {
	Route::post('/link/check/name', 'LinkController@checkName');
	Route::post('/link/check/url', 'LinkController@checkUrl');
	Route::post('/link/create', 'LinkController@create');
});

Route::domain(env('API_DOMAIN', 'api.urbn.link'))->middleware(['auth', 'verified'])->group(function () {
	// Link
	Route::post('/links', 'LinkController@list');
	Route::post('/link/update', 'LinkController@update');
	Route::post('/link/delete', 'LinkController@delete');
	Route::post('/link/statistics', 'LinkController@getStatistics');
	// Link - AlternativeLink
	Route::post('/link/alternatives', 'LinkController@listAlternatives');
	Route::post('/link/alternative/create', 'LinkController@createAlternative');
	Route::post('/link/alternative/update', 'LinkController@updateAlternative');
	Route::post('/link/alternative/delete', 'LinkController@deleteAlternative');
	// Link - AlternativeLink - Condition
	Route::post('/link/alternative/conditions', 'LinkController@listConditions');
	Route::post('/link/alternative/condition/create', 'LinkController@createCondition');
	Route::post('/link/alternative/condition/update', 'LinkController@updateCondition');
	Route::post('/link/alternative/condition/delete', 'LinkController@deleteCondition');
	// Project
	Route::post('/projects', 'ProjectController@list');
	Route::post('/project/check/name', 'ProjectController@checkName');
	Route::post('/project/create', 'ProjectController@create');
	Route::post('/project/update', 'ProjectController@update');
	Route::post('/project/delete', 'ProjectController@delete');
	Route::post('/project/admin/change', 'ProjectController@changeAdmin');
	// Project - ProjectMember / ProjectInvitation
	Route::post('/project/members', 'ProjectController@listMembers');
	Route::post('/project/member/add', 'ProjectController@addMember');
	Route::post('/project/member/remove', 'ProjectController@removeMember');
	Route::post('/project/member/delete', 'ProjectController@deleteInvitation');
	// Domain
	Route::post('/domains', 'DomainController@list');
	Route::post('/domain/create', 'DomainController@create');
	Route::post('/domain/update', 'DomainController@update');
	Route::post('/domain/delete', 'DomainController@delete');
	// Page
	Route::post('/pages', 'PageController@list');
	Route::post('/page/create', 'PageController@create');
	Route::post('/page/update', 'PageController@update');
	Route::post('/page/delete', 'PageController@delete');
});

Route::domain('{domain}')->group(function () {
	Route::get('/', 'ForwardController@index');
	Route::get('{name}+', 'ForwardController@summary');
	Route::get('{name}', 'ForwardController@forward');
});
