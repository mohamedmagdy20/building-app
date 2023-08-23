<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function index($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('dashboard.roles.permission',compact('role','permissions'));
    }

    public function update(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        if($request->permissions != null)
        {
            $role->syncPermissions($request->permissions);
        }else{
            $role->syncPermissions([]);
        }
        return redirect()->back()->with('success','Permission Updated');
    }
}
