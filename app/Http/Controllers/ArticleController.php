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
            'article' => $article->firstOrFail(),
            'allUsers' => User::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::where('id',$id)->get()->firstOrFail();
        $article->update($this->validateArticleUpdate($request)->all());
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

    public function uploadImg(Request $request)
    {
        if($request->hasFile('upload')) {
            $file = $request->file('upload');
            $uploadDir = 'public/images';
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $filenameTime = $filename.'_'.time().'.'.$ext;
            $file->move($uploadDir,$filenameTime);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset($uploadDir.'/'.$filenameTime);
            $msg = 'File uploaded.';
            $output = '<script>window.parent.CKEDITOR.tools.callFunction('.$CKEditorFuncNum.', \''.$url.'\', \''.$msg.'\')</script>';
            @header('Content-type: text/html; charset=utf-8');
            echo $output;
        }
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
            'published_at' => ['required', 'date']
        ]);
        $request['user_id'] = auth()->user()->id;
        return $request;
    }

    protected function validateArticleUpdate($request){
        $validateArr = [
            'title' => ['required', 'string', 'max:200'],
            'excerpt' => ['string', 'max:100', 'nullable'],
            'body' => ['string', 'nullable'],
            'category_id' => ['nullable', 'string', 'in:'.Category::all()->implode('id', ',')],
            'published_at' => ['required', 'date']
        ];
        if (isset($request['new_user_id'])):
            $validateArr['new_user_id'] = ['nullable', 'string', 'in:'.User::all()->implode('id', ',')];
            $request->validate($validateArr);
            $request['user_id'] = $request['new_user_id'];
            unset($request['new_user_id']);
        else:
            $request->validate($validateArr);
            $request['user_id'] = auth()->user()->id;
        endif;
        return $request;
    }
}