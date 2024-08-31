<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('role:Super-Admin'),
        ];
    }

    public function permissionIndex()
    {

        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));

    }

    public function permissionAdd()
    {

        return view('admin.permission.add');

    }

    public function permissionStore(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:permissions,name|min:3',
        ], [
            'name.required' => 'Enter Valid Permission Name',
            'name.min' => 'Name Should be minimum 3 character'
        ]);

        $data = new Permission();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'New Permission Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission.index')->with($notification);
    }

    public function permissionEdit($id)
    {

        $permission = Permission::find($id);
        $roles = Role::all();
        return view('admin.permission.edit', compact('permission','roles'));

    }

    public function permissionUpdate(Request $request, $id)
    {

        Log::info('PermissionController -> permission update started');
        $validatedData = $request->validate([
            'name' => 'required|min:3',
        ], [
            'name.required' => 'Enter Valid Permission Name',
            'name.min' => 'Name Should be minimum 3 character'
        ]);


        $data = Permission::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Permission data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('permission.index')->with($notification);
    }


    public function permissionDelete($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        $notification = array(
            'message' => 'Permission Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('permission.index')->with($notification);

    }

    public function assignRole(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ], [
            'role.required' => 'select valid role',
        ]);

        if ($permission->hasRole($request->role)) {

            $notification = array(
                'message' => 'Permission already Exist for Role',
                'alert-type' => 'info'
            );
            return redirect()->route('permission.edit', ['id' => $permission])->with($notification);
        }

        $permission->assignRole($request->role);

        $notification = array(
            'message' => 'New Role to the Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission.edit', ['id' => $permission])->with($notification);
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);

            $notification = array(
                'message' => 'Role Removed for permission',
                'alert-type' => 'error'
            );

            return redirect()->route('permission.edit', ['id' => $permission])->with($notification);
        }

        $notification = array(
            'message' => 'Role not exists',
            'alert-type' => 'info'
        );

        return redirect()->route('permission.edit', ['id' => $permission])->with($notification);
    }


}
