<?php

use GuzzleHttp\Promise\Create;
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

Route::get('/api', 'ApiController@index')->name('api.index');

# Collection
Route::get('collection',           'CollectionController@index' )->name('collection.index' );
Route::get('collection/create',    'CollectionController@create')->name('collection.create');
Route::get('collection/search',    'CollectionController@search')->name('collection.search');
Route::get('collection/{id}',      'CollectionController@show'  )->name('collection.show'  );
Route::get('collection/{id}/edit', 'CollectionController@eidt'  )->name('collection.eidt'  );
Route::post('collection',          'CollectionController@store' )->name('collection.store');
Route::put('collection/{id}',      'CollectionController@update')->name('collection.update');

Route::delete('collection', 'CollectionController@delete')->name('collection.destroy');

# CollectionItem
Route::get ('collection-item/{id}/create',  'CollectionItemController@create')->name('collectionItem.create');
Route::get ('collection-item/{id}/edit',    'CollectionItemController@edit'  )->name('collectionItem.edit');
Route::post('collection-item',              'CollectionItemController@store' )->name('collectionItem.store');
Route::put ('collection-item/{id}',         'CollectionItemController@update')->name('collectionItem.update');

Route::delete('collection-item/{id}/destroy', 'CollectionItemController@delete')->name('collectionItem.destroy');

# DashBoard
Route::get('dashboard',             'DashbaordController@index'  )->name('dashboard.index');
Route::get('dashboard/finance',     'DashbaordController@finance')->name('dashboard.finance');
Route::get('dashboard/cart',        'DashbaordController@cart'   )->name('dashboard.cart');
Route::get('dashboard/fiance/year', 'DashbaordController@byYear' )->name('dashboard.finance.year');
Route::get('dashboard/fiance/group', 'DashbaordController@byGroup' )->name('dashboard.finance.group');

# Diagram
Route::get ('diagram',        'DiagramController@index' )->name('diagram.index');
Route::get ('diagram/create', 'DiagramController@create')->name('diagram.create');
Route::get ('diagram/{id}',   'DiagramController@show'  )->name('diagram.show');
Route::post('diagram/store',  'DiagramController@store' )->name('diagram.store');
Route::put ('diagram/update', 'DiagramController@update')->name('diagram.update');

Route::get ('diagram/{id}/class/list',   'DiagramController@classList')->name('diagram.class.list');

# Images
Route::get ('images/novo/{id}', 'CollectionItemImageController@create')->name('collItemImages.create');
Route::post('images/store',           'CollectionItemImageController@store' )->name('collItemImages.store');

Route::delete('images/destroy/{id}', 'CollectionItemImageController@destroy')->name('collItemImages.destroy');

# Diagram / Class
               
Route::delete('diagram/{id}', 'DiagramController@delete')->name('diagram.destroy');

# ledgerEntries
Route::get ('ledger-entry',           'LedgerEntryController@index' )->name('ledgerEntry.index');
Route::get ('ledger-entry/create',    'LedgerEntryController@create')->name('ledgerEntry.create');
Route::get ('ledger-entry/flow',      'LedgerEntryController@flow'  )->name('ledgerEntry.flow');
Route::get ('ledger-entry/{id}/edit', 'LedgerEntryController@edit'  )->name('ledgerEntry.edit');
Route::get ('leder-entry/{id}/clone', 'LedgerEntryController@clone' )->name('ledgerEntry.clone');
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
Route::get('user/profile', 'UserController@profile')->name('user.profile');
Route::get('user/create', 'UserController@create')->name('user.create');
Route::post('user/sotore', 'UserController@store')->name('user.store');

# FixedCost
Route::get ('fixed-cost',             'FixedCostController@index'    )->name('fixedCost.index');
Route::get ('fixed-cost/trash',       'FixedCostController@trash'    )->name('fixedCost.trash');
Route::get ('fixed-cost/{id}/ledger', 'FixedCostController@send'     )->name('fixedCost.send');
Route::put ('fixed-cost/{id}/trash',  'FixedCostController@sendTrash')->name('fixedCost.send.trash');
Route::put ('fixed-cost/{id}/restore','FixedCostController@restore'  )->name('fixedCost.send.restore');

# Task
Route::get('task', 'TaskController@index')->name('task.index');

# Event
Route::get('event',         'EventController@index' )->name('event.index');
Route::get('event/show',    'EventController@show'  )->name('event.show');
Route::post('event/store',  'EventController@store' )->name('event.store');
Route::post('event/update', 'EventController@update')->name('event.update');
Route::post('event/delete', 'EventController@delete')->name('event.delete');

# Client
Route::get('client',         'ClientController@index' )->name('client.index');
Route::get('client/edit',    'ClientController@edit'  )->name('client.edit');
Route::get('client/create',  'ClientController@create')->name('client.create');
Route::post('client/store',  'ClientController@store' )->name('client.store');
Route::put('client/update', 'ClientController@update')->name('client.update');
Route::post('client/delete', 'ClientController@delete')->name('client.delete');

# Message
Route::get('message',         'MessageController@index' )->name('message.index');

Route::delete('client/{id}/destroy', 'ClientController@delete')->name('client.destroy');

# CronJob
Route::get ('cron-job',        'CronJobController@index' )->name('cronJob.index');
Route::get ('cron-job/edit',   'CronJobController@edit'  )->name('cronJob.edit');
Route::get ('cron-job/create', 'CronJobController@create')->name('cronJob.create');
Route::post('cron-job/store',  'CronJobController@store' )->name('cronJob.store');
Route::put ('cron-job/update', 'CronJobController@update')->name('cronJob.update');

Route::delete('cron-job/{id}/destroy', 'CronJobController@delete')->name('cronJob.destroy');

# O limit está fixo. Deixar dinâmico!
Route::get('mania/sorteios', 'ManiaSorteioController@index')->name('mania.sorteios');
Route::delete('mania/sorteios/{id}/destroy', 'ManiaSorteioController@delete')->name('mania.destroy');
