<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Providers\RouteServiceProvider;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles',[
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('admin.createEditRole',[
            'allPermissions' => Permission::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRole($request)->all();
        $role = Role::create(['name' => $validated['name']]);
        foreach ($validated['permissions'] as $permission){
            $role->givePermissionTo($permission);
        }
        return redirect(RouteServiceProvider::ADMIN_ROLE);
    }

    public function edit($id)
    {
        $role = Role::where('id',$id)->get();
        return view('admin.createEditRole',[
            'role' => $role->firstOrFail(),
            'allPermissions' => Permission::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRole($request)->all();
        $role = Role::where('id',$id)->get()->firstOrFail();
        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions']);
        #foreach ($validated['permissions'] as $permission){
        #    $role->givePermissionTo($permission);
        #}
        return redirect(RouteServiceProvider::ADMIN_ROLE);
    }

    public function delete($id)
    {
        $role = Role::where('id',$id)->get();
        return view('admin.deleteRole',[
            'role' => $role->firstOrFail()
        ]);
    }

    public function destroy($id)
    {
        Role::where('id',$id)->get()->firstOrFail()->delete();
        return redirect(RouteServiceProvider::ADMIN_ROLE);
    }

    protected function validateRole($request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['array', 'nullable'],
            'permissions[*]' => ['string', 'nullable|in:'.Permission::all()->implode('name', ',')]
        ]);
        return $request;
    }
}
