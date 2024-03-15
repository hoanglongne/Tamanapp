<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::resource('users', UserController::class)->only(['index', 'show']);
Route::get('tasks/kanban', [TaskController::class, 'kanban']);

Route::resource('tasks', TaskController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');
Route::resource('tasks', TaskController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);


Route::get('login', [AuthController::class, 'create'])
  ->name('login');
Route::post('login', [AuthController::class, 'store'])
  ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
  ->name('logout');