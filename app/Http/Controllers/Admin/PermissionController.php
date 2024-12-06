<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth'
        ];
    }

    public function permissionIndex()
    {
        Gate::authorize('permission.index');
        $permissions = Permission::join('categories', 'categories.id', '=', 'permissions.permission_group_category_id')
                      ->select('permissions.*', 'categories.category_name as category_name')->get();
        return view('admin.permission.index', compact('permissions'));

    }

    public function permissionAdd()
    {
        Gate::authorize('permission.create');
        $categories = $this->getCategories([1]);
        $premissionGroups = $categories->where('category_type_id', '1');
        return view('admin.permission.add',compact('premissionGroups'));

    }

    public function permissionStore(PermissionStoreRequest $request)
    {

        Gate::authorize('permission.create');

        Permission::create($request->prepareData());

        $notification = array(
            'message' => 'New Permission Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('permission.index')->with($notification);
    }

    public function permissionEdit($id)
    {
        Gate::authorize('permission.updation');
        $permission = Permission::find($id);
        $categories = $this->getCategories([1]);
        $premissionGroups = $categories->where('category_type_id', '1');
        $roles = Role::all();
        return view('admin.permission.edit', compact('permission','roles','premissionGroups'));

    }

    public function permissionUpdate(PermissionStoreRequest $request, $id)
    {
        Gate::authorize('permission.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Permission data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('permission.index')->with($notification);
    }


    public function permissionDelete($id)
    {
        Gate::authorize('permission.delete');
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
        Gate::authorize('permission.roles.assign');

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
        Gate::authorize('permission.roles.remove');

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
