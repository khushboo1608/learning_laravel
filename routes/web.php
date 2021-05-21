<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('articles', App\Http\Controllers\ArticleController::class);

Route::resource('posts', App\Http\Controllers\PostController::class);

Route::resource('news', App\Http\Controllers\NewsController::class);

Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('banners', App\Http\Controllers\BannerController::class);

Route::resource('addersses', App\Http\Controllers\AdderssController::class);