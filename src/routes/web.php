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

Route::get('/todo', 'TodoController@index')->name('todo.index');//一覧表示

Route::get('/todo/create', 'TodoController@create')->name('todo.create');//ToDoを追加画面

Route::post('/todo', 'TodoController@store')->name('todo.store');//ToDoを追加する処理

Route::get('/todo/{id}', 'TodoController@show')->name('todo.show');//詳細

Route::get('/todo/{id}/edit', 'TodoController@edit')->name('todo.edit');//編集画面