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

// Route Login
Route::get('login', 'auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'auth\LoginController@login');
//middleware login
Route::middleware('auth')->group(function (){
    Route::get('/', 'AdminController@index');
    // logout
    Route::post('logout', 'auth\LoginController@logout')->name('logout');

    // Route home after login
    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('admin'); // view index
        Route::post('/store', 'AdminController@store')->name('admin.store'); // proses create
        Route::get('/{id}/edit', 'AdminController@edit')->name('admin.edit'); // view update
        Route::post('/{id}/edit', 'AdminController@update')->name('admin.update'); // proses update
        Route::post('/{id}/drop', 'AdminController@drop')->name('admin.drop'); // delete
    });
    
    Route::prefix('crud')->group(function(){
        Route::get('/', 'CrudController@index')->name('crud'); // view index
        Route::post('/store', 'CrudController@store')->name('crud.store'); // proses create
        Route::get('/{file}/edit', 'CrudController@edit')->name('crud.edit'); // view update
        Route::post('/{file}/edit', 'CrudController@update')->name('crud.update'); // proses update
        Route::post('/{file}/drop', 'CrudController@drop')->name('crud.drop'); // delete
    });
});