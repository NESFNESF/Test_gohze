<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/test1', function () {
    return view('test1');
});

Route::get('/test2', [HomeController::class, 'load_web'])->name('test2');
Route::post('/tasks/new', [HomeController::class, 'create_task_web']);
Route::post('/tasks/update', [HomeController::class, 'update_task_web']);
Route::post('/day/new', [HomeController::class, 'create_day_web']);
Route::post('/day/update', [HomeController::class, 'update_day_web']);
Route::post('/day/change', [HomeController::class, 'change_day']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

