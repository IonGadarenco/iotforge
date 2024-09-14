<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roles()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.config.roles', compact('roles'));
    }
    public function roleEdit(Role $role)
    {
        $permissions = Permission::where('guard_name', 'admin')->get();

        return view('admin.config.role_edit', compact('role', 'permissions'));
    }

    public function roleUpdate(Request $request, Role $role)
    {
        $inputs = request()->validate([
            'name' => 'required'
        ]);
        if ($role->id) {
            $role->update($inputs);
        } else {
            $inputs['guard_name'] = 'admin';
            $role = Role::create($inputs);
        }
        $role->permissions()->sync($request->permissions);
        return redirect()->route('user.config.roles');
    }
}
