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

Route::domain(env('DASHBOARD_DOMAIN', 'api.urbn.link'))->group(function () {
	Auth::routes(['verify' => true]);
	// PROJECTS
	Route::get('/', 'ProjectController@index')->name('home');
	Route::get('/projects/create', 'ProjectController@create');
	Route::post('/projects', 'ProjectController@store');
	Route::get('/{project}/settings', 'ProjectController@settings');
	Route::put('/{project}', 'ProjectController@update');
	Route::delete('/{project}', 'ProjectController@delete');
	// LINKS
	Route::get('/{project}', 'LinkController@index');
	Route::get('/{project}/links/create', 'LinkController@create');
	Route::post('/{project}/links', 'LinkController@store');
	Route::get('/{project}/links/{domain}/{link}', 'LinkController@show');
	Route::delete('/{project}/links/{domain}/{link}', 'LinkController@delete');
	Route::get('/{project}/links/{domain}/{link}/rules', 'LinkController@rules');
	// Domain
	Route::get('/{project}/domains', 'DomainController@index');
	Route::get('/{project}/domains/add', 'DomainController@create');
	Route::post('/{project}/domains', 'DomainController@store');
	Route::get('/{project}/domains/{domain}', 'DomainController@show');
	Route::get('/{project}/domains/{domain}/edit', 'DomainController@edit');
	Route::put('/{project}/domains/{domain}', 'DomainController@update');
	Route::post('/{project}/domains/{domain_name}/default', 'DomainController@setDefaultLink');
	Route::delete('/{project}/domains/{domain}', 'DomainController@delete');
	// PAGES
	Route::get('/{project}/pages', 'PageController@index');
	Route::get('/{project}/pages/create', 'PageController@create');
	Route::post('/{project}/pages', 'PageController@store');
	Route::get('/{project}/pages/{page}', 'PageController@show');
	Route::get('/{project}/pages/{page}/edit', 'PageController@edit');
	Route::put('/{project}/pages/{page}', 'PageController@update');
	Route::delete('/{project}/pages/{page}', 'PageController@delete');

});

Route::domain(env('API_DOMAIN', 'api.urbn.link'))->group(function () {
	Route::post('/link/check/name', 'LinkController@checkName');
	Route::post('/link/check/url', 'LinkController@checkUrl');
	Route::post('/link/create', 'LinkController@store');
});

Route::domain(env('API_DOMAIN', 'api.urbn.link'))->middleware(['auth', 'verified'])->group(function () {
	// LINKS
	Route::post('/link/update', 'LinkController@update');
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
	// Project - ProjectMember / ProjectInvitation
	Route::post('/project/admin/change', 'ProjectController@changeAdmin');
	Route::post('/project/members', 'ProjectController@listMembers');
	Route::post('/project/member/add', 'ProjectController@addMember');
	Route::post('/project/member/remove', 'ProjectController@removeMember');
	Route::post('/project/member/delete', 'ProjectController@deleteInvitation');
});

Route::domain('{domain}')->group(function () {
	Route::get('/', 'ForwardController@index');
	Route::get('{name}+', 'ForwardController@preview');
	Route::get('{name}', 'ForwardController@forward');
});
