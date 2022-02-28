<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Asset;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;

class AssetController extends Controller
{
    public function index()
    {
        $allAssets = Asset::all();
        return view('admin.assets',[
            'allAssets' => $allAssets
        ]);
    }

    public function create($id)
    {
        return view('admin.createEditAsset',[
            'id' => $id
        ]);
    }

    public function store(Request $request)
    {
        $file = $request->file('upload');
        $filenameExploded = explode('.', $file->getClientOriginalName());
        $filenameExt = array_pop($filenameExploded);
        $filenameBase = implode('.', $filenameExploded);
        $filename = $filenameBase.'-'.time().'.'.$filenameExt;
        $pathStem = 'assets';
        $path = $pathStem.'/'.$filename;
        $put = Storage::disk('local')->putFileAs(
            'public/assets',
            $file,
            $filename
        );
        $validatedRequest = $this->validateAsset($request)->all();
        $validatedRequest['path'] = $path;
        $asset = Asset::create($validatedRequest);
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
