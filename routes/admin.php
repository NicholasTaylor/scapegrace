<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/write-post', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('post.new');