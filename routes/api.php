<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){

    Route::controller(ModuleController::class)->prefix('module')->group(function(){
        Route::post('create','CreateModule');
        Route::put('update/{id}','UpdateModule');
        Route::delete('delete/{id}','DeleteModule');
        Route::get('view','ViewModule');
    });

});
Route::prefix('v1')->group(function(){

    Route::controller(PermissionController::class)->prefix('permission')->group(function(){
        Route::post('create','CreatePermission');
        Route::put('update/{id}','UpdatePermission');
        Route::delete('delete/{id}','DeletePermission');
        Route::get('view','ViewPermission');
    });

});
