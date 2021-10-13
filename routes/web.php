<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'LoginController@index')->name('login');
Route::get('/logout', 'LoginController@logout')->name('login.logout');
Route::post('/login', 'LoginController@auth')->name('login.auth');

# Collection
Route::get('/collection', 'CollectionController@index')->name('collection.idex');
Route::get('/collection/{id}', 'CollectionController@show')->name('collection.show');

# CollectionItem
Route::get ('collection-item/edit/{id}',   'CollectionItemController@edit'  )->name('collItems.edit');
Route::put ('collection-item/edit/{id}',   'CollectionItemController@update')->name('collItems.update');
