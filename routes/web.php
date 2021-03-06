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

Route::get('/', 'DashboardController');


Route::get('clients/{client}/delete', 'ClientController@destroyConfirm');
Route::resource('clients', 'ClientController');

Route::get('clients/{client}/notes/{note}/delete', 'ClientNoteController@destroyConfirm');
Route::resource('clients.notes', 'ClientNoteController')->only([
    'create', 'store', 'edit', 'update', 'destroy',
]);

Route::post('projects/{project}/upload', 'ProjectController@upload');
Route::get('projects/{project}/file/{file}/delete', 'ProjectController@deleteFile');
Route::post('projects/{project}/archive', 'ProjectController@archive');
Route::get('projects/{project}/delete', 'ProjectController@destroyConfirm');
Route::resource('projects', 'ProjectController');

Route::get('projects/{project}/notes/{note}/delete', 'ProjectNoteController@destroyConfirm');
Route::resource('projects.notes', 'ProjectNoteController')->only([
    'create', 'store', 'edit', 'update', 'destroy',
]);

Route::post('tasks/{task}/upload', 'TaskController@upload');
Route::get('tasks/{task}/file/{file}/delete', 'TaskController@deleteFile');
Route::post('tasks/{task}/mark-complete', 'TaskController@markComplete');
Route::get('tasks/{task}/delete', 'TaskController@destroyConfirm');
Route::resource('tasks', 'TaskController');

Route::get('tasks/{task}/notes/{note}/delete', 'TaskNoteController@destroyConfirm');
Route::resource('tasks.notes', 'TaskNoteController')->only([
    'create', 'store', 'edit', 'update', 'destroy',
]);

Route::get('servers/{server}/delete', 'ServerController@destroyConfirm');
Route::resource('servers', 'ServerController');

Route::get('servers/{server}/notes/{note}/delete', 'ServerNoteController@destroyConfirm');
Route::resource('servers.notes', 'ServerNoteController')->only([
    'create', 'store', 'edit', 'update', 'destroy',
]);

Route::get('servers/attach/{project}', 'ServerController@attach')->name('attach_server');
Route::post('servers/attach/{project}', 'ServerController@attach')->name('attach_server');