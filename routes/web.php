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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('users', 'UserController');
Route::resource('players', 'PlayerController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/medical', 'MedicalController@index')->name('medical.index');
Route::get('/medical/{user}', 'MedicalController@show')->name('medical.show');
Route::get('/medical/search/{param}', 'MedicalController@search')->name('medical.search');

//Route::resource('medical/reports', 'MedicalReportController');
Route::get('/medical/reports/create/{user}', 'MedicalReportController@create')->name('reports.create');
Route::post('/medical/reports/store', 'MedicalReportController@store')->name('reports.store');
Route::get('/medical/reports/edit/{report}', 'MedicalReportController@edit')->name('reports.edit');
Route::put('/medical/reports/update/{report}', 'MedicalReportController@update')->name('reports.update');
Route::get('/medical/reports/show/{report}', 'MedicalReportController@show')->name('reports.show');

Route::get('/medical/record/create/{user}', 'MedicalRecordController@create')->name('record.create');

Route::resource('rookies','RookieController')->parameter('rookies', 'rookie');
//Route::post('/rookies/user', 'RookieController@storeWithUser')->name('rookies.store.user');

Route::resource('positions','PositionController');
Route::resource('seasons','SeasonController');
Route::resource('events/category','EventCategoryController');