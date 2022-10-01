<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'loginPost']);

Route::get('/register',[\App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::post('/register',[\App\Http\Controllers\UserController::class, 'registerPost']);

Route::middleware('auth')->group(function (){
    Route::middleware('role:user,admin')->group(function (){
        Route::middleware('role:admin')->group(function (){
            Route::group(['prefix'=>'/admin', 'as'=>'admin.'], function (){
                Route::resource('/product', \App\Http\Controllers\ProductController::class);
            });
        });

        Route::group(['prefix'=>'/order','as'=>'order.'], function (){
            Route::get('/basket', [\App\Http\Controllers\OrderController::class, 'basket'])->name('basket');
        });
    });

    Route::get('/cabinet',[\App\Http\Controllers\UserController::class, 'cabinet'])->name('cabinet');
    Route::get('/cabinet/edit',[\App\Http\Controllers\UserController::class, 'cabinetEdit'])->name('cabinetEdit');
    Route::post('/cabinet/edit',[\App\Http\Controllers\UserController::class, 'cabinetEditPost']);
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
});
