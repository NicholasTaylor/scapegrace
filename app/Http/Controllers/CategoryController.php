<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.createEditCategory');
    }

    public function store(Request $request)
    {
        $category = Category::create($this->validateCategory($request)->all());
        return redirect(RouteServiceProvider::ADMIN_CATEGORY);
    }

    public function edit($id)
    {
        $category = Category::where('id',$id)->get();
        return view('admin.createEditCategory',[
            'category' => $category[0]
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id',$id)->get()[0];
        $category->update($this->validateCategory($request)->all());
        return redirect(RouteServiceProvider::ADMIN_CATEGORY);
    }

    public function delete($id)
    {
        $category = Category::where('id',$id)->get();
        return view('admin.deleteCategory',[
            'category' => $category[0]
        ]);
    }

    public function destroy($id)
    {
        Category::where('id',$id)->get()[0]->delete();
        return redirect(RouteServiceProvider::ADMIN_CATEGORY);
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories',[
            'categories'=>$categories
        ]);
    }
    protected function validateCategory($request){
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['string', 'nullable']
        ]);
        return $request;
    }
}
