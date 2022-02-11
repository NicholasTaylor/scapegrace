<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class PostController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.create-post',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        if ( !is_null($request['category_id'])):
            $request['category_id'] = intval($request['category_id']);
        endif;
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'excerpt' => ['string', 'max:100', 'nullable'],
            'body' => ['string', 'nullable'],
            'category_id' => ['integer', 'nullable'],
            'published_at' => ['required', 'date'],
        ]);

        $request['user_id'] = auth()->user()->id;

        $post = Post::create($request->all());

        return redirect(RouteServiceProvider::ADMIN);

    }
}
