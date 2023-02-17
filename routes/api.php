<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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




    Route::controller(PermissionController::class)->prefix('permission')->group(function(){
        Route::post('create','CreatePermission');
        Route::put('update/{id}','UpdatePermission');
        Route::delete('delete/{id}','DeletePermission');
        Route::get('view','ViewPermission');
    });




    Route::controller(UserController::class)->prefix('user')->group(function(){
        Route::post('create','CreateUser');
        Route::put('update/{id}','UpdateUser');
        Route::delete('delete/{id}','DeleteUser');
        Route::get('view','ListUser');
    });





    Route::controller(RoleController::class)->prefix('role')->group(function(){
        Route::post('create','CreateRole');
        Route::put('update/{id}','UpdateRole');
        Route::delete('delete/{id}','DeleteRole');
        Route::get('view','ListRole');
    });

});


