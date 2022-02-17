<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $currentTime = Carbon::now()->toDateTimeString();
        return view('admin.createEditArticle',[
            'categories' => $categories,
            'currentTime' => $currentTime
        ]);
    }

    public function store(Request $request)
    {
        $article = Article::create($this->validateArticle($request)->all());
        return redirect(RouteServiceProvider::ADMIN);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $currentTime = Carbon::now()->toDateTimeString();
        $article = Article::where('id',$id)->get();
        return view('admin.createEditArticle',[
            'categories' => $categories,
            'currentTime' => $currentTime,
            'article' => $article[0]
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::where('id',$id)->get()[0];
        $article->update($this->validateArticle($request)->all());
        return redirect(RouteServiceProvider::ADMIN);
    }

    public function index()
    {
        $articles = Article::where('user_id',auth()->user()->id)->take(5)->get();
        $categories = Category::get();
        return view('auth.dashboard',[
            'articles' => $articles
        ]);
    }

    public function delete($id)
    {
        $article = Article::where('id',$id)->get();
        return view('admin.deleteArticle',[
            'article' => $article[0]
        ]);
    }

    public function destroy($id)
    {
        Article::where('id',$id)->get()[0]->delete();
        return redirect(RouteServiceProvider::ADMIN);
    }

    protected function validateArticle($request){
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