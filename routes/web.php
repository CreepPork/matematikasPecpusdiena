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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::post('/', 'HomeController@store');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/{id}', 'DashboardController@show');

Route::get('/charts', 'DashboardController@charts');

Route::get('/charts/data', 'DashboardController@charts_data');

Route::get('/admin', 'AdminController@index');

Route::get('/admin/stats/delete/{id}', 'AdminController@stats_delete');