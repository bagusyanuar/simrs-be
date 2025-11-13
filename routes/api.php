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

            # master route hospital
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

            Route::group(['prefix' => 'room-class'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\RoomClassController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\RoomClassController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\RoomClassController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\RoomClassController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\RoomClassController::class, 'delete']);
            });

            Route::group(['prefix' => 'room'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\RoomController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\RoomController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\RoomController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\RoomController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\RoomController::class, 'delete']);
            });

            Route::group(['prefix' => 'room-bed'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\RoomBedController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\RoomBedController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\RoomBedController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\RoomBedController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\RoomBedController::class, 'delete']);
            });

            Route::group(['prefix' => 'clinic'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\ClinicController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\ClinicController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\ClinicController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\ClinicController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\ClinicController::class, 'delete']);
            });

            # master route staff
            Route::group(['prefix' => 'job-position'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\JobPositionController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\JobPositionController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\JobPositionController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\JobPositionController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\JobPositionController::class, 'delete']);
            });

            Route::group(['prefix' => 'job-department'], function () {
                Route::post('/', [App\Http\Controllers\Web\Master\JobDepartmentController::class, 'create']);
                Route::get('/', [App\Http\Controllers\Web\Master\JobDepartmentController::class, 'findAll']);
                Route::get('/{id}', [App\Http\Controllers\Web\Master\JobDepartmentController::class, 'findByID']);
                Route::put('/{id}', [App\Http\Controllers\Web\Master\JobDepartmentController::class, 'update']);
                Route::delete('/{id}', [App\Http\Controllers\Web\Master\JobDepartmentController::class, 'delete']);
            });


        });
    });
});
