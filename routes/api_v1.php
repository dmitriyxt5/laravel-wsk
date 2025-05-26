<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return 'test';
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout'])->middleware(\App\Http\Middleware\checkAuth::class);
//    Route::post('/register', [LoginController::class, 'register']);

});


Route::prefix('place')->group(function() {
//    Route::get('/', function (Request $request) {
//        return 'qwe';
//    });
    Route::post('/', [PlaceController::class, 'create'])->middleware(\App\Http\Middleware\checkAuth::class);
    Route::get('/findPlace/{id}', [PlaceController::class, 'findPlace'])->middleware(\App\Http\Middleware\checkAuth::class);
    Route::get('/allPlaces', [PlaceController::class, 'allPlaces'])->middleware(\App\Http\Middleware\checkAuth::class);
    Route::post('/update/{id}', [PlaceController::class, 'update'])->middleware(\App\Http\Middleware\checkAuth::class);
    Route::delete('/{id}', [PlaceController::class, 'delete'])->middleware(\App\Http\Middleware\checkAuth::class);

});


Route::prefix('schedule')->group(function() {
    Route::post('/', [ScheduleController::class, 'create']);
    Route::post('/update/{id}', [ScheduleController::class, 'update']);
    Route::delete('/{id}', [ScheduleController::class, 'delete']);
    Route::get('/', [ScheduleController::class, 'all']);
});

