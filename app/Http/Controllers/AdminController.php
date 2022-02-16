<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id',auth()->user()->id)->take(5)->get();
        $categories = Category::get();
        return view('auth.dashboard',[
            'posts' => $posts
        ]);
    }
}
