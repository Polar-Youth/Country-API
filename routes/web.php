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
Route::get('/countries', 'CountryController@index');
Route::get('/countries/delete/{countryId}', 'CountryController@delete')->name('country.delete');
Route::get('/countries/{countryId}', 'CountryController@show')->name('country.show');
Route::post('/countries/store', 'CountryController@store')->name('country.store');