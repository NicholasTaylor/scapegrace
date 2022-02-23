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
            'article' => $article->firstOrFail()
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::where('id',$id)->get()->firstOrFail();
        $article->update($this->validateArticle($request)->all());
        return redirect(RouteServiceProvider::ADMIN);
    }

    public function index()
    {
        $articles = Article::all();
        $categories = Category::all();
        return view('admin.articles',[
            'articles' => $articles
        ]);
    }

    public function delete($id)
    {
        $article = Article::where('id',$id)->get();
        return view('admin.deleteArticle',[
            'article' => $article->firstOrFail()
        ]);
    }

    public function destroy($id)
    {
        Article::where('id',$id)->get()->firstOrFail()->delete();
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