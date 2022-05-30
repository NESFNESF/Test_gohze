<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tasks', [HomeController::class, 'load']);
Route::post('/tasks/new', [HomeController::class, 'create_task']);
Route::get('/tasks/{id}/update', [HomeController::class, 'update_task']);
Route::post('/day/new', [HomeController::class, 'create_day']);
Route::get('/day/{id}/update', [HomeController::class, 'update_day']);
