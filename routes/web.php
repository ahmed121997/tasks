<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
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


Auth::routes();

Route::resource('tasks', TaskController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('task/list', [HomeController::class, 'getTasks'])->name('tasks.list');
Route::get('task/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::get('task/done/{id}', [TaskController::class, 'done'])->name('tasks.done');

