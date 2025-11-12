<?php

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

    Route::group(['middleware' => 'jwt.verify'], function () {

        Route::group(['prefix' => 'master'], function () {

            Route::group(['prefix' => 'hospital-installation'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\HospitalInstallationController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\HospitalInstallationController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\HospitalInstallationController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\HospitalInstallationController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\HospitalInstallationController::class, 'delete']);
            });

            Route::group(['prefix' => 'hospital-unit'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\HospitalUnitController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\HospitalUnitController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\HospitalUnitController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\HospitalUnitController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\HospitalUnitController::class, 'delete']);
            });
        });
    });
});
