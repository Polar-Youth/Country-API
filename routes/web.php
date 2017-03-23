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

// Home Routes.
Route::get('/', 'HomeController@frontend')->name('home.frontend');
Route::get('/home', 'HomeController@backend')->name('home.backend');

// Country routes
Route::get('/countries', 'CountryController@index')->name('country');
Route::get('/countries/delete/{countryId}', 'CountryController@delete')->name('country.delete');
Route::get('/countries/{countryId}', 'CountryController@show')->name('country.show');
Route::post('/country/{countryId}', 'CountryController@update')->name('country.update');
Route::post('/countries/store', 'CountryController@store')->name('country.store');
Route::post('/countries/insert', 'CountryController@store')->name('country.insert');

// News routes
Route::get('/news', 'BlogController@index')->name('news');
Route::get('/news/{articleId}', 'BlogController@show')->name('news.show');
Route::post('/news', 'BlogController@store')->name('news.store');
Route::post('/news/{articleId}', 'BlogController@update')->name('news.update');
Route::get('news/delete/{articleId}', 'BlogController@destroy')->name('news.delete');

// Support routes.
Route::get('/support', 'SupportController@index')->name('support.index');
Route::get('/support/group/{selector}', 'SupportController@group')->name('support.group');
Route::get('/support/new', 'SupportController@create')->name('support.create');
Route::get('/support/search', 'SupportController@search')->name('support.search');
Route::post('/support', 'SupportController@store')->name('support.store');

// Category routes.
Route::get('/category/{tagId}', 'CategoryController@show')->name('category.show');