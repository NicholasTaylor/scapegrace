<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Asset;

class AssetController extends Controller
{
    public function create($id)
    {
        return view('admin.createEditAsset',[
            'id' => $id
        ]);
    }

    public function store(Request $request)
    {
        dd($_FILES);
        $asset = Asset::create($this->validateAsset($request)->all());
        return redirect(RouteServiceProvider::ADMIN);
    }

    public function edit(){
        //
    }

    public function update(){
        //
    }

    protected function validateAsset($request){
        $request->validate([
            'article_id' => ['required', 'string', 'in:'.Article::all()->implode('id', ',')],
            'name' => ['required', 'string', 'max:200'],
            'media_type' => ['required', 'string', 'max:200', 'in:image']
        ]);
        return $request;
    }    
}
