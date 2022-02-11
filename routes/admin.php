<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/create-post', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('post.new');

Route::post('/admin/create-post', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('post.firstSave');