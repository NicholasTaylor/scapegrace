<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class PostController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $currentTime = Carbon::now()->toDateTimeString();
        return view('admin.post',[
            'categories' => $categories,
            'currentTime' => $currentTime
        ]);
    }

    public function store(Request $request)
    {
        $post = Post::create($this->validatePost($request)->all());
        return redirect(RouteServiceProvider::ADMIN);

    }

    public function edit($id)
    {
        $categories = Category::all();
        $currentTime = Carbon::now()->toDateTimeString();
        $post = Post::where('id',$id)->get();
        return view('admin.post',[
            'categories' => $categories,
            'currentTime' => $currentTime,
            'post' => $post[0]
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::where('id',$id)->get()[0];
        $post->update($this->validatePost($request)->all());
        return redirect(RouteServiceProvider::ADMIN);
    }

    public function index()
    {
        $posts = Post::where('user_id',auth()->user()->id)->take(10)->get();
        return view('auth.dashboard',[
            'posts' => $posts
        ]);
    }

    public function delete($id)
    {
        $post = Post::where('id',$id)->get();
        return view('admin.delete',[
            'post' => $post[0]
        ]);
    }

    public function destroy($id)
    {
        Post::where('id',$id)->get()[0]->delete();
        return redirect(RouteServiceProvider::ADMIN);
    }

    protected function validatePost($request){
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
        return $request;
    }

}
