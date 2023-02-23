<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Middleware\AccessMiddleware;


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
Route::prefix('v1')->group(function () {
Route::controller(AuthController::class)->prefix('auth')->group(function(){
    Route::post('register','register');
    Route::post('login','login');
});
});
Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('v1')->group(function () {
        Route::controller(ModuleController::class)->prefix('module')->group(function (){
            Route::post('create', 'create');
            Route::put('update/{id}', 'update');
            Route::delete('delete/{id}', 'delete');
            Route::get('view/{id}', 'view');
            Route::get('/', 'list');
        });
        Route::controller(PermissionController::class)->prefix('permission')->group(function (){
            Route::post('create', 'create');
            Route::put('update/{id}', 'update');
            Route::delete('delete/{id}', 'delete');
            Route::get('view/{id}', 'view');
            Route::get('/', 'list');
        });
        Route::controller(RoleController::class)->prefix('role')->group(function (){
            Route::post('create', 'create');
            Route::put('update/{id}', 'update');
            Route::delete('delete/{id}', 'delete');
            Route::get('view/{id}', 'view');
            Route::get('/', 'list');
        });
        Route::controller(UserController::class)->prefix('user')->group(function (){
            Route::post('create', 'create');
            Route::put('update/{id}', 'update');
            Route::delete('delete/{id}', 'delete');
            Route::get('view/{id}', 'view');
            Route::get('/', 'list')->middleware('checkaccess:1,view_access');
        });
    });
});

