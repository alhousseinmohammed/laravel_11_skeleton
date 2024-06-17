<?php

use Illuminate\Support\Facades\Route;

Route::get(
    '/', function () {
        return view('welcome');
    }
);
//<?php
//
//use App\Http\Controllers\Store\BookController;
//use Illuminate\Support\Facades\Route;
//
////Route::middleware('auth:store_users')->prefix('/api')->group(function () {
//Route::prefix('/api')->group(function () {
//
//    Route::prefix('/book')->name('book.')->controller(BookController::class)->group(function () {
//        Route::get('/', 'index')->name('index');
//        Route::post('/', 'create')->name('create');
//        Route::get('/{foodicsUser}', 'show')->name('show');
//        Route::put('/{foodicsUser}', 'update')->name('update');
//        Route::delete('/{foodicsUser}', 'delete')->name('delete');
//    });
//
//});
