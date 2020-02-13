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

Route::get('projects/{project}/delete', 'ProjectController@destroyConfirm');
Route::resource('projects', 'ProjectController');

Route::get('projects/{project}/notes/{note}/delete', 'ProjectNoteController@destroyConfirm');
Route::resource('projects.notes', 'ProjectNoteController')->only([
    'create', 'store', 'edit', 'update', 'destroy',
]);

Route::get('tasks/{task}/delete', 'TaskController@destroyConfirm');
Route::resource('tasks', 'TaskController');

Route::get('tasks/{task}/notes/{note}/delete', 'TaskNoteController@destroyConfirm');
Route::resource('tasks.notes', 'TaskNoteController')->only([
    'create', 'store', 'edit', 'update', 'destroy',
]);