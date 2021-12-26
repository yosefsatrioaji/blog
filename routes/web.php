<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TinyController;
use App\Http\Controllers\IndexController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/posts/{post:slug}',[IndexController::class,'show'])->name('show');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/signin',[AuthController::class,'signin'])->name('signin');
    Route::get('/register',[AuthController::class,'registerView'])->name('register');
    Route::post('/signup',[AuthController::class,'signup'])->name('signup');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::group(['middleware' => ['role:super admin']], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/post/store',[PostController::class,'store'])->name('post.store');
    Route::post('/upload_image', [TinyController::class,'imageUpload'])->name('tiny.image-upload');
    Route::get('/post/create',[PostController::class,'createView'])->name('post.create');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
