<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;

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

    public function editProfile()
    {
        $user = auth()->user();
        $articles = Article::where('user_id',$user->id)->get()->all();
        return view('admin.editProfile',[
            'user' => $user,
            'articles' => $articles
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateUserUpdate($request, $id)->all();
        $user = User::where('id',$id)->get()->firstOrFail();
        if (Gate::check('edit users')):
            $user->update(array(
                'name' => $validated['name'],
                'email' => $validated['email']
            ));
        endif;
        if (!(isset($validated['roles']))):
            $validated['roles'] = [];
        endif;
        if (Gate::check('change roles')):
            $user->syncRoles($validated['roles']);
        endif;
        return redirect(RouteServiceProvider::ADMIN_USER);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validated = $this->validateProfileUpdate($request, $user->id)->all();
        $user->update(array(
            'name' => $validated['name'],
            'email' => $validated['email']
        ));
        return redirect(RouteServiceProvider::ADMIN);
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

    public function destroyProfile()
    {
        auth()->user()->delete();
        return redirect(url(''));
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

    protected function validateProfileUpdate($request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);
        return $request;
    }
}
