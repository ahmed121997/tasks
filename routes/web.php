<?php

use App\Http\Controllers\UserController;
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

Route::get('user/profile',[UserController::class,'index'])->name('user.profile');
Route::get('user/edit',[UserController::class,'edit'])->name('user.edit');
Route::post('user/update/{id}',[UserController::class,'update'])->name('user.update');
Route::get('user/change_pass',[UserController::class,'change_password'])->name('user.change.password');
Route::post('user/change_pass/{id}',[UserController::class,'store_change_password'])->name('user.store.change.password');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('task/list', [HomeController::class, 'getTasks'])->name('tasks.list');
Route::get('task/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::get('task/done/{id}', [TaskController::class, 'done'])->name('tasks.done');

Route::resource('tasks', TaskController::class)->except(['show']);

