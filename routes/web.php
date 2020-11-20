<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Main\PostController;

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

//Route::get('/', function () {
////    return view('welcome');
//    return view('start');
//})->name('start');

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/categories', [MainController::class, 'categories'])->name('main.categories');
Route::get('/category/{category}', [PostController::class, 'posts'])->name('category.posts');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group( ['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::group(['prefix' =>  'posts' ], function () {
        Route::get('/create/', [PostController::class, 'create'])->name('post.create');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::post('/destroy/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});


Route::group(['middleware' => ['auth', 'admin']], function(){

    Route::group(['prefix' =>  'admin' ], function () {
        Route::get('/', [AdminController::class,'index'])->name('admin');
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [AdminPostController::class, 'index'])->name('posts.list');
            Route::get('/create', [AdminPostController::class, 'create'])->name('admin.post.create');
            Route::get('/edit/{id}', [AdminPostController::class, 'edit'])->name('admin.post.edit');
            Route::post('/store', [AdminPostController::class, 'store'])->name('admin.post.store');
            Route::post('/update/{post}', [AdminPostController::class, 'update'])->name('admin.post.update');
            Route::post('/destroy/{post}', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');
            Route::post('/on', [AdminPostController::class, 'postOn']);
            Route::post('/off', [AdminPostController::class, 'postOff']);
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::post('/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class,'index'])->name('users');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/update/{user}', [UserController::class,'update'])->name('user.update');
            Route::post('/destroy/{user}', [UserController::class,'destroy'])->name('user.destroy');
        });
    });
});
