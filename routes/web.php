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

Route::get('/login',  'LoginController@index' )->name('login');
Route::get('/logout', 'LoginController@logout')->name('login.logout');
Route::post('/login', 'LoginController@auth'  )->name('login.auth');

# Collection
Route::get('collection',           'CollectionController@index' )->name('collection.index' );
Route::get('collection/search',    'CollectionController@search')->name('collection.search');
Route::get('collection/{id}',      'CollectionController@show'  )->name('collection.show'  );
Route::get('collection/{id}/edit', 'CollectionController@eidt'  )->name('collection.eidt'  );
Route::put('collection/{id}',      'CollectionController@update')->name('collection.update');

# CollectionItem
Route::get ('collection-item/{id}/create',  'CollectionItemController@create')->name('collectionItem.create');
Route::get ('collection-item/{id}/edit',    'CollectionItemController@edit'  )->name('collectionItem.edit');
Route::post('collection-item',              'CollectionItemController@store' )->name('collectionItem.store');
Route::put ('collection-item/{id}',         'CollectionItemController@update')->name('collectionItem.update');

Route::delete('collection-item/{id}/destroy', 'CollectionItemController@delete')->name('collectionItem.destroy');

# DashBoard
Route::get('dashboard',         'DashbaordController@index'  )->name('dashboard.index');
Route::get('dashboard/finance', 'DashbaordController@finance')->name('dashboard.finance');

# ledgerEntries
Route::get ('ledger-entry',           'LedgerEntryController@index' )->name('ledgerEntry.index');
Route::get ('ledger-entry/create',    'LedgerEntryController@create')->name('ledgerEntry.create');
Route::get ('ledger-entry/flow',      'LedgerEntryController@flow'  )->name('ledgerEntry.flow');
Route::get ('ledger-entry/{id}/edit', 'LedgerEntryController@edit'  )->name('ledgerEntry.edit');
Route::get ('ledger-entry/{id}',      'LedgerEntryController@show'  )->name('ledgerEntry.show');
Route::post('ledger-entry',           'LedgerEntryController@store' )->name('ledgerEntry.store');
Route::put ('ledger-entry',           'LedgerEntryController@update')->name('ledgerEntry.update');

Route::delete('ledger-entry/{id}/destroy', 'LedgerEntryController@delete')->name('ledgerEntry.destroy');

# LedgerItem
Route::get('ledger-item',         'LedgerItemController@index'  )->name('ledgerItem.index');
Route::post('ledger-item',        'LedgerItemController@store'  )->name('ledgerItem.store');
Route::delete('ledger-item/{id}', 'LedgerItemController@destroy')->name('ledgerItem.destroy');

# Passwords
Route::get('password',           'PasswordController@index' )->name('password.index');
Route::get('password/create',    'PasswordController@create')->name('password.create');
Route::get('passowrd/{id}',      'PasswordController@show'  )->name('password.show');
Route::get('password/{id}/edit', 'PasswordController@edit'  )->name('password.edit');
Route::post('password',          'PasswordController@store' )->name('password.store');
Route::put('password/update',    'PasswordController@update')->name('password.update');

Route::delete('password/{id}/destroy', 'PasswordController@delete')->name('password.destroy');

# User
Route::get('user', 'UserController@index')->name('user.index');

# FixedCost
Route::get ('fixed-cost',             'FixedCostController@index'    )->name('fixedCost.index');
Route::get ('fixed-cost/trash',       'FixedCostController@trash'    )->name('fixedCost.trash');
Route::get ('fixed-cost/{id}/ledger', 'FixedCostController@send'     )->name('fixedCost.send');
Route::put ('fixed-cost/{id}/trash',  'FixedCostController@sendTrash')->name('fixedCost.send.trash');
Route::put ('fixed-cost/{id}/restore','FixedCostController@restore'  )->name('fixedCost.send.restore');
