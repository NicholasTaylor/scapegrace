<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;


Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');

Route::get('/admin/article', [ArticleController::class, 'index'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles|delete articles|publish articles|unpublish articles')
    ->name('article.index');

Route::get('/admin/article/{id}', [ArticleController::class, 'articleJson'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles|delete articles|publish articles|unpublish articles')
    ->name('article.articleJson');

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

Route::post('/admin/upload', [ArticleController::class, 'uploadImg'])
    ->middleware('auth')    
    ->middleware('permission:create articles|edit articles')
    ->name('article.uploadImg');

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
    ->middleware('permission:create categories|edit categories|delete categories')
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
    ->middleware('permission:create roles|edit roles|delete roles')
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

Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware('auth')
    ->middleware('permission:edit users|delete users|change roles')
    ->name('user.index');

Route::get('/admin/edit-user/{id}', [UserController::class, 'edit'])
    ->middleware('auth')
    ->middleware('permission:edit users|change roles')
    ->name('user.edit');

Route::patch('/admin/edit-user/{id}', [UserController::class, 'update'])
    ->middleware('auth')
    ->middleware('permission:edit users|change roles')
    ->name('user.update');

Route::get('/admin/profile', [UserController::class, 'editProfile'])
    ->middleware('auth')
    ->name('user.editProfile');

Route::patch('/admin/profile', [UserController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('user.updateProfile');

Route::delete('/admin/destroyProfile', [UserController::class, 'destroyProfile'])
    ->middleware('auth')
    ->name('user.destroyProfile');

Route::get('/admin/delete-user/{id}', [UserController::class, 'delete'])
    ->middleware('auth')
    ->middleware('permission:delete users')
    ->name('user.delete');

Route::delete('/admin/destroy-user/{id}', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->middleware('permission:delete users')
    ->name('user.destroy');

Route::get('/admin/assets', [AssetController::class, 'index'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles')
    ->name('asset.index');

Route::get('/admin/upload-asset/', [AssetController::class, 'create'])
    ->middleware('auth')
    ->name('asset.create');

Route::get('/admin/upload-asset/{id}', [AssetController::class, 'create'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles')
    ->name('asset.createFromArticle');

Route::post('/admin/upload-asset/', [AssetController::class, 'store'])
    ->middleware('auth')
    ->name('asset.store');

Route::post('/admin/upload-asset/{id}', [AssetController::class, 'store'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles')
    ->name('asset.storeFromArticle');

Route::get('/admin/edit-asset/{id}', [AssetController::class, 'edit'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles')
    ->name('asset.edit');

Route::patch('/admin/edit-asset/{id}', [AssetController::class, 'update'])
    ->middleware('auth')
    ->middleware('permission:create articles|edit articles')
    ->name('asset.update');