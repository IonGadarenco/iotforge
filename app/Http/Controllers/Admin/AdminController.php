<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('id', '>', 0);
        if (!$request->status) {
            $query->where('active', 1);
        } else {
            if ($request->status == 1) {
                $query->where('active', 1);
            } elseif ($request->status == 2) {
                $query->where('active', 0);
            } else {
                $query->where(function ($query) {
                    $query->where('active', 0)
                        ->orWhere('active', 1);
                    return $query;
                });
            }
        }
        if ($request->name) {
            $name = $request->name;
            $query->where('name', 'LIKE', "%$name%");
        }
        if ($request->email) {
            $email = $request->email;
            $query->where('email', 'LIKE', "%$email%");
        }

        $admins = $query->get();
        return view(
            'admin.admins.list',
            compact('admins')
        );
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.insert', compact('roles'));
    }


    public function edit(User $admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.edit', compact('roles', 'admin'));
    }


    public function delete(User $admin)
    {
        $admin = User::find($admin->id);
        if ($admin) {
            $admin->delete();
        } else {
            return back()->withErrors(['msg', 'Something goes wrong!']);
        }

        Session::flash('success', 'You have successfully deleted item.');

        return redirect()->route('admin.config.admins');
    }

    /**
     * Functia de actualizare/adaugare a administratorului.
     * @param Request $request
     * @return mixed
     */
    public function updateOrCreate(Request $request, User $admin)
    {
        $inputs = request()->validate([
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($admin->id) {
            $admin->update($inputs);
            if ($request->password) {
                $passwordInput = $request->validate([
                    'password' => 'required|string',
                ]);
                $admin->password = $passwordInput['password'];
                $admin->save();
            }
        } else {
            $inputs['active'] = 1;
            $passwordInput = $request->validate([
                'password' => 'required|string',
            ]);
            $inputs['password'] = Hash::make( $passwordInput['password']);
            $admin = User::create($inputs);
        }
        $admin->roles()->sync($request->roles);

        return redirect()->route('admin.config.admins');
    }

    public function roles()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.roles', compact('roles'));
    }

    public function roleEdit(Role $role)
    {
        $permissions = Permission::where('guard_name', 'admin')->get();

        return view('admin.admins.role_edit', compact('role', 'permissions'));
    }

    public function roleUpdate(Request $request, Role $role)
    {
        $inputs = request()->validate([
            'name' => 'required'
        ]);
        $inputs['guard_name'] = 'admin';
        if ($role->id) {
            $role->update($inputs);
        } else {
            $role = Role::create($inputs);
        }
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.config.roles');
    }

    public function profileView(Request $request)
    {
        $edit = Auth::user();

        return view('admin.profile.edit', compact('edit'));
    }

    public function profileUpdate(Request $request)
    {
        $admin = Auth::user();
        if ($request->password) {
            $request->validate([
                'password' => [
                    'required',
                    'min:8',
                    'confirmed'
                ],
            ]);
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        Session::flash('success', 'You have successfully updated password.');

        return redirect('admin.profile.edit');
    }

    public function status($status, User $admin)
    {
        if ($status == 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }
        $admin->save();

        return redirect()->route('admin.config.admins');
    }
}
