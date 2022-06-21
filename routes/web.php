<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;

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


Route::group(["middleware"=>"auth"], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class,'store'])->name('post.store');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');


    // COMMENT
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

    // PROFILE
    Route::get('/profile/{id}/show',[ProfileController::class,'show'])->name('profile.show');
    Route::get('/profile/{id}/edit',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile/{id}/update',[ProfileController::class,'update'])->name('profile.update');
    Route::get('/profile/{id}/followers',[ProfileController::class,'followers'])->name('profile.followers');

    // LIKES
    Route::post('/like/{post_id}/store',[LikeController::class,'store'])->name('like.store');
    Route::delete('/like/{post_id}/destroy',[LikeController::class,'destroy'])->name('like.destroy');

    //FOLLOWERS
    Route::post('/follow/{id}/store',[FollowController::class,'store'])->name('follow.store');
    Route::delete('/follow/{id}/destroy',[FollowController::class,'destroy'])->name('follow.destroy');

    Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware'=>'can:admin'], function(){
        #users
        Route::get('/users',[UserController::class,'index'])->name('users');
        Route::delete('/users/{id}/deactivate',[UserController::class,'deactivate'])->name('users.deactivate');
        Route::patch('/users/{id}/activate',[UserController::class,'activate'])->name('users.activate');

        #posts
        Route::get('/posts',[App\Http\Controllers\Admin\PostController::class,'index'])->name('posts');
        Route::delete('/posts/{id}/hide',[App\Http\Controllers\Admin\PostController::class,'hide'])->name('users.hide');
        Route::patch('/posts/{id}/visible',[App\Http\Controllers\Admin\PostController::class,'visible'])->name('users.visible');

        #categories
        Route::get('/categories',[App\Http\Controllers\Admin\CategoriesController::class,'index'])->name('categories');
        Route::post('/categories/store',[App\Http\Controllers\Admin\CategoriesController::class,'store'])->name('categories/store');
        Route::get('/categories/{id}/edit',[App\Http\Controllers\Admin\CategoriesController::class,'edit'])->name('categories/edit');
        Route::patch('/categories/{id}/store',[App\Http\Controllers\Admin\CategoriesController::class,'update'])->name('categories/update');
        Route::delete('/categories/{id}/destroy',[App\Http\Controllers\Admin\CategoriesController::class,'destroy'])->name('categories/destroy');
    });
});
