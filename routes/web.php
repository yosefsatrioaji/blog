<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TinyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/posts/{post:slug}', [IndexController::class, 'show'])->name('show');
Route::get('/search/posts', [IndexController::class, 'search'])->name('search');
Route::get('/categories/', [IndexController::class, 'categoryIndex'])->name('category.index');
Route::get('/categories/{category:slug}', [IndexController::class, 'category'])->name('category.show');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::post('/contact/submit',[IndexController::class,'submitContact'])->name('contact.submit');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['role:super admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['role:super admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/contact', [DashboardController::class, 'contact'])->name('dashboard.contact');
    Route::delete('/dashboard/contact/{contact}/delete', [DashboardController::class, 'contactDelete'])->name('contact.delete');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::post('/upload_image', [TinyController::class, 'imageUpload'])->name('tiny.image-upload');
    Route::get('/post/create', [PostController::class, 'createView'])->name('post.create');
    Route::get('/post/{post}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/list', [PostController::class, 'list'])->name('post.list');
    Route::get('/post/trash', [PostController::class, 'trash'])->name('post.trash');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post}/store', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}/delete', [PostController::class, 'delete'])->name('post.delete');
    Route::post('/post/{post}/restore', [PostController::class, 'restore'])->name('post.restore');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/{category}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}/update', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
});
