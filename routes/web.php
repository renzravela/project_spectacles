<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PageController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home/all', [HomeController::class, 'getAllMovies'])->name('home.all');
Route::get('/home/about', [HomeController::class, 'showAbout'])->name('home.about');
Route::post('/home/{userId}/add/{movieId}', [HomeController::class, 'add_movie_review'])->name('home.add_review');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/ajax/search', [HomeController::class, 'searchMovies'])->name('searchMovies');
Route::resource('/home', '\App\Http\Controllers\HomeController');

Route::middleware(['auth', 'userAuth:admin'])->group(function () {
    // Admin routes here.;/'
    Route::get('/admin', [HomeController::class, 'adminAuth'])->name('admin.index');
    Route::resource('/admin/movies', '\App\Http\Controllers\MovieController');
    Route::get('/admin/users', [MovieController::class, 'getUsers'])->name('admin.users');
});

Route::middleware(['auth', 'userAuth:client'])->group(function () {
    // Regular user routes here
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
});

// // Authentication Routes...
// Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
// Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

// // Confirm Password (added in v6.2)
// Route::get('password/confirm', 'App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('password/confirm', 'App\Http\Controllers\Auth\ConfirmPasswordController@confirm');
