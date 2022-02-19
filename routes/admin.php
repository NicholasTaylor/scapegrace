<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');

Route::get('/admin/article/create', [ArticleController::class, 'create'])
    ->middleware('auth')
    ->name('article.create');

Route::post('/admin/article/create', [ArticleController::class, 'store'])
    ->middleware('auth')
    ->name('article.store');

Route::get('/admin/edit-article/{id}', [ArticleController::class, 'edit'])
    ->middleware('auth')
    ->name('article.edit');

Route::patch('/admin/edit-article/{id}', [ArticleController::class, 'update'])
    ->middleware('auth')
    ->name('article.update');

Route::get('/admin/delete-article/{id}', [ArticleController::class, 'delete'])
    ->middleware('auth')
    ->name('article.delete');

Route::delete('/admin/destroy-article/{id}', [ArticleController::class, 'destroy'])
    ->middleware('auth')
    ->name('article.destroy');

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