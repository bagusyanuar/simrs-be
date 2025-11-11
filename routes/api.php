<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# public route

Route::get('/', function () {
    return response()->json([
        'app_name' => env('APP_NAME'),
        'app_version' => env('APP_VERSION')
    ], 200);
});

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [App\Http\Controllers\Web\AuthController::class, 'login']);
    });
});
