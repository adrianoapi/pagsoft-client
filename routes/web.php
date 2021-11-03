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
Route::get('/collection', 'CollectionController@index')->name('collection.index');
Route::get('/collection/search', 'CollectionController@search')->name('collection.search');
Route::get('/collection/{id}', 'CollectionController@show')->name('collection.show');

# CollectionItem
Route::get ('collection-item/create/{id}',  'CollectionItemController@create')->name('collectionItem.create');
Route::get ('collection-item/edit/{id}',    'CollectionItemController@edit'  )->name('collectionItem.edit');
Route::post('collection-item',              'CollectionItemController@store' )->name('collectionItem.store');
Route::put ('collection-item/{id}',         'CollectionItemController@update')->name('collectionItem.update');

Route::delete('collection-item/destroy/{id}', 'CollectionItemController@delete')->name('collectionItem.destroy');

# DashBoard
Route::get('dashboard', 'DashbaordController@index')->name('dashboard.index');
Route::get('dashboard/finance', 'DashbaordController@finance')->name('dashboard.finance');

# ledgerEntries
Route::get('ledger-entry','LedgerEntryController@index')->name('ledgerEntry.index');
Route::get('ledger-entry/create', 'LedgerEntryController@create')->name('ledgerEntry.create');
Route::get('ledger-entry/{id}', 'LedgerEntryController@show')->name('ledgerEntry.show');
Route::post('ledger-entry', 'LedgerEntryController@store')->name('ledgerEntry.store');

# LedgerItem
Route::post('ledger-item', 'LedgerItemController@store')->name('ledgerItem.store');
Route::delete('ledger-item/{id}', 'LedgerItemController@destroy')->name('ledgerItem.destroy');

# Passwords
Route::get('password', 'PasswordController@index')->name('password.index');
Route::get('passowrd/{id}', 'PasswordController@show')->name('password.show');

# User
Route::get('user', 'UserController@index')->name('user.index');

# FixedCost
Route::get ('fixed-cost', 'FixedCostController@index')->name('fixedCost.index');
Route::get ('fixed-cost/trash', 'FixedCostController@trash')->name('fixedCost.trash');
