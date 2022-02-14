<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/', [PostController::class, 'index'])
    ->middleware('auth')
    ->name('post.index');

Route::get('/admin/create-post', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('post.create');

Route::post('/admin/create-post', [PostController::class, 'store'])
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