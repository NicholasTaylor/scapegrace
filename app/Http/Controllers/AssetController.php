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

    public function create()
    {
        return view('admin.createEditAsset');
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
        $validatedRequest = $this->validateAsset($request)->all();
        $validatedRequest['path'] = $path;
        $put = Storage::disk('local')->putFileAs(
            'public/assets',
            $file,
            $filename
        );
        $asset = Asset::create($validatedRequest);
        #return redirect(RouteServiceProvider::ADMIN);
        return response($asset)
            ->header('Content-Type', 'application/json; charset=UTF-8');
    }

    public function edit(){
        //
    }

    public function update(){
        //
    }

    protected function validateAsset($request){
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'media_type' => ['required', 'string', 'max:200', 'in:image']
        ]);
        return $request;
    }    
}
