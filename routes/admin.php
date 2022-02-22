<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');

Route::get('/admin/article/create', [ArticleController::class, 'create'])
    ->middleware('auth')
    ->middleware('permission:create articles')
    ->name('article.create');

Route::post('/admin/article/create', [ArticleController::class, 'store'])
    ->middleware('auth')
    ->middleware('permission:create articles')
    ->name('article.store');

Route::get('/admin/edit-article/{id}', [ArticleController::class, 'edit'])
    ->middleware('auth')
    ->middleware('permission:edit articles')
    ->name('article.edit');

Route::patch('/admin/edit-article/{id}', [ArticleController::class, 'update'])
    ->middleware('auth')
    ->middleware('permission:edit articles')
    ->name('article.update');

Route::get('/admin/delete-article/{id}', [ArticleController::class, 'delete'])
    ->middleware('auth')
    ->middleware('permission:delete articles')
    ->name('article.delete');

Route::delete('/admin/destroy-article/{id}', [ArticleController::class, 'destroy'])
    ->middleware('auth')
    ->middleware('permission:delete articles')
    ->name('article.destroy');

Route::get('/admin/category', [CategoryController::class, 'index'])
    ->middleware('auth')
    ->name('category.index');

Route::get('/admin/category/create', [CategoryController::class, 'create'])
    ->middleware('auth')
    ->middleware('permission:create categories')
    ->name('category.create');

Route::post('/admin/category/create', [CategoryController::class, 'store'])
    ->middleware('auth')
    ->middleware('permission:create categories')
    ->name('category.store');

Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit'])
    ->middleware('auth')
    ->middleware('permission:edit categories')
    ->name('category.edit');

Route::patch('/admin/edit-category/{id}', [CategoryController::class, 'update'])
    ->middleware('auth')
    ->middleware('permission:edit categories')
    ->name('category.update');

Route::get('/admin/delete-category/{id}', [CategoryController::class, 'delete'])
    ->middleware('auth')
    ->middleware('permission:delete categories')
    ->name('category.delete');

Route::delete('/admin/destroy-category/{id}', [CategoryController::class, 'destroy'])
    ->middleware('auth')
    ->middleware('permission:delete categories')
    ->name('category.destroy');

Route::get('/admin/roles', [RoleController::class, 'index'])
    ->middleware('auth')
    ->name('role.index');

    Route::get('/admin/role/create', [RoleController::class, 'create'])
    ->middleware('auth')
    ->middleware('permission:create roles')
    ->name('role.create');

Route::post('/admin/role/create', [RoleController::class, 'store'])
    ->middleware('auth')
    ->middleware('permission:create roles')
    ->name('role.store');

Route::get('/admin/edit-role/{id}', [RoleController::class, 'edit'])
    ->middleware('auth')
    ->middleware('permission:edit roles')
    ->name('role.edit');

Route::patch('/admin/edit-role/{id}', [RoleController::class, 'update'])
    ->middleware('auth')
    ->middleware('permission:edit roles')
    ->name('role.update');

Route::get('/admin/delete-role/{id}', [RoleController::class, 'delete'])
    ->middleware('auth')
    ->middleware('permission:delete roles')
    ->name('role.delete');

Route::delete('/admin/destroy-role/{id}', [RoleController::class, 'destroy'])
    ->middleware('auth')
    ->middleware('permission:delete roles')
    ->name('role.destroy');