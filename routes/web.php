<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
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

Route::get('/app/home', [UserController::class, 'login'])->name('user.login');

// Route::resource('/movies', '\App\Http\Controllers\MovieController');
Route::resource('/user', '\App\Http\Controllers\UserController');
