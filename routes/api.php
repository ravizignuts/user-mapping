<?php

use App\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::controller(ModuleController::class)->prefix('module')->group(function(){
    Route::post('create','CreateModule');
    Route::put('update','UpdateModule');
    Route::delete('delete/{id}','DeleteModule');
    Route::get('view','ViewModule');

});
