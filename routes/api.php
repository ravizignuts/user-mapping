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
    Route::get('logout',[AuthController::class,'logout']);
    Route::prefix('v1')->group(function () {
        Route::controller(ModuleController::class)->prefix('module')->group(function (){
            Route::post('create', 'create')->middleware('checkaccess:1,add_access');
            Route::put('update/{id}', 'update')->middleware('checkaccess:1,edit_access');
            Route::delete('delete/{id}', 'delete')->middleware('checkaccess:1,delete_access');
            Route::get('view/{id}', 'view')->middleware('checkaccess:1,view_access');
            Route::get('/', 'list')->middleware('checkaccess:1,view_access');
        });
        Route::controller(PermissionController::class)->prefix('permission')->group(function (){
            Route::post('create', 'create')->middleware('checkaccess:1,add_access');
            Route::put('update/{id}', 'update')->middleware('checkaccess:1,edit_access');
            Route::delete('delete/{id}', 'delete')->middleware('checkaccess:1,delete_access');
            Route::get('view/{id}', 'view')->middleware('checkaccess:1,view_access');
            Route::get('/', 'list')->middleware('checkaccess:1,view_access');
        });
        Route::controller(RoleController::class)->prefix('role')->group(function (){
            Route::post('create', 'create')->middleware('checkaccess:1,add_access');
            Route::put('update/{id}', 'update')->middleware('checkaccess:1,edit_access');
            Route::delete('delete/{id}', 'delete')->middleware('checkaccess:1,delete_access');
            Route::get('view/{id}', 'view')->middleware('checkaccess:1,view_access');
            Route::get('/', 'list')->middleware('checkaccess:1,view_access');
        });
        });
        Route::controller(UserController::class)->prefix('user')->group(function (){
            Route::post('create', 'create')->middleware('checkaccess:1,add_access');
            Route::put('update/{id}', 'update')->middleware('checkaccess:1,edit_access');
            Route::delete('delete/{id}', 'delete')->middleware('checkaccess:1,delete_access');
            Route::get('view/{id}', 'view')->middleware('checkaccess:1,view_access');
            Route::get('/', 'list')->middleware('checkaccess:1,view_access');
        });
    });
});

