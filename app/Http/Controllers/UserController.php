<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::where('id',$id)->get()->firstOrFail();
        $articles = Article::where('user_id',$id)->get()->all();
        $allRoles = Role::whereNotIn('name', ['Super-Admin'])->get()->all();
        return view('admin.editUser',[
            'user' => $user,
            'allRoles' => $allRoles,
            'articles' => $articles
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $this->validateUserUpdate($request, $id)->all();
        $user = User::where('id',$id)->get()->firstOrFail();
        $user->update(array(
            'name' => $validated['name'],
            'email' => $validated['email']
        ));
        if (isset($validated['roles'])):
            $user->syncRoles($validated['roles']);
        endif;
        return redirect(RouteServiceProvider::ADMIN_USER);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users',[
            'users' => $users
        ]);
    }

    public function delete($id)
    {
        $user = User::where('id',$id)->get()->firstOrFail();
        $articles = Article::where('user_id',$id)->get()->all();
        return view('admin.deleteUser',[
            'user' => $user,
            'articles' => $articles
        ]);
    }

    public function destroy($id)
    {
        User::where('id',$id)->get()->firstOrFail()->delete();
        return redirect(RouteServiceProvider::ADMIN_USER);
    }

    protected function validateUser($request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'roles' => ['array', 'nullable'],
            'roles[*]' => ['string', 'nullable|in:'.Role::all()->implode('name', ',')]
        ]);
        return $request;
    }

    protected function validateUserUpdate($request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'roles' => ['array', 'nullable'],
            'roles[*]' => ['string', 'nullable|in:'.Role::all()->implode('name', ',')]
        ]);
        return $request;
    }
}
