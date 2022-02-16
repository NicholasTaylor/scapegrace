<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');

Route::get('/admin/post/create', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('post.create');

Route::post('/admin/post/create', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('post.store');

Route::get('/admin/edit-post/{id}', [PostController::class, 'edit'])
    ->middleware('auth')
    ->name('post.edit');

Route::patch('/admin/edit-post/{id}', [PostController::class, 'update'])
    ->middleware('auth')
    ->name('post.update');

Route::get('/admin/delete-post/{id}', [PostController::class, 'delete'])
    ->middleware('auth')
    ->name('post.delete');

Route::delete('/admin/destroy-post/{id}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->name('post.destroy');

Route::get('/admin/category', [CategoryController::class, 'index'])
    ->middleware('auth')
    ->name('category.index');

Route::get('/admin/category/create', [CategoryController::class, 'create'])
    ->middleware('auth')
    ->name('category.create');

Route::post('/admin/category/create', [CategoryController::class, 'store'])
    ->middleware('auth')
    ->name('category.store');

Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit'])
    ->middleware('auth')
    ->name('category.edit');

Route::patch('/admin/edit-category/{id}', [CategoryController::class, 'update'])
    ->middleware('auth')
    ->name('category.update');

Route::get('/admin/delete-category/{id}', [CategoryController::class, 'delete'])
    ->middleware('auth')
    ->name('category.delete');

Route::delete('/admin/destroy-category/{id}', [CategoryController::class, 'destroy'])
    ->middleware('auth')
    ->name('category.destroy');