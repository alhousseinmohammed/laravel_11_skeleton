<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JwtAuthController;
use App\Http\Controllers\Store\BookController;
use App\Http\Controllers\User\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->controller(RegisterUserController::class)->group(
    function () {
        Route::post('/register', 'store')->name('register');
    }
);

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(
    function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/get-token', 'getToken')->name('get-token');
    }
);

Route::middleware('auth:api')->prefix('/')->group(
    function () {
        Route::prefix('/book')->name('books.')->controller(BookController::class)->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware(['can:book.view', 'check.access']);
                Route::post('/', 'create')->name('create')->middleware(['can:book.create']);
                Route::get('/{book}', 'show')->name('show')->middleware(['can:book.view']);
                Route::put('/{book}', 'update')->name('update')->middleware(['can:book.edit']);
                Route::delete('/{book}', 'delete')->name('delete')->middleware(['can:book.delete']);
            }
        );
    }
);

Route::prefix('/jwt-auth')->name('jwt-auth.')->controller(JwtAuthController::class)->group(
    function () {
        Route::post('/get-jwt-token', 'getJwtToken')->name('get-token');
    }
);

Route::middleware('auth:jwt-api')->prefix('/')->group(
    function () {
        Route::prefix('/jwt-book')->name('jwt-books.')->controller(BookController::class)->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware(['can:book.view']);
            }
        );
    }
);
