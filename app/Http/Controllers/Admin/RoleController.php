<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth'
        ];
    }

    public function roleIndex()
    {
        Gate::authorize('role.index');
        $roles =  Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function roleAdd()
    {
        Gate::authorize('role.create');
        return view('admin.role.add');
    }

    public function roleStore(RoleStoreRequest $request)
    {
        Gate::authorize('role.create');
        Role::create($request->prepareData());

        $notification = array(
            'message' => 'New Role Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('role.index')->with($notification);
    }

    public function roleEdit($id)
    {
        Gate::authorize('role.updation');
        $role = Role::find($id);
        $premissions = Permission::all();
        return view('admin.role.edit', compact('role', 'premissions'));
    }

    public function roleUpdate(RoleStoreRequest $request, $id)
    {
        Gate::authorize('role.updation');
        $request->persist($id);

        $notification = array(
            'message' => 'Role data Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('role.index')->with($notification);
    }

    public function roleDelete($id)
    {
        Gate::authorize('role.delete');
        $role = Role::find($id);
        $role->delete();

        $notification = array(
            'message' => 'Role Permenetly Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->route('role.index')->with($notification);
    }

    public function rolePermissionList($id)
    {

        Gate::authorize('role.permission.list');
        $role = Role::find($id);
        $permissions = Permission::join('categories', 'categories.id', '=', 'permissions.permission_group_category_id')
            ->select('permissions.*', 'categories.category_name as category_name')->get();
        return view('admin.role.permission_assign', compact('role', 'permissions'));
    }


    public function permissionRoleUpdate(Request $request, Role $role)
    {
        Gate::authorize('role.permission.update');

        $validatedData = $request->validate([
            'permission' => 'required',
        ], [
            'permission.required' => 'select valid permission',
        ]);

        if ($role->hasPermissionTo($request->permission)) {

            $notification = array(
                'message' => 'New Role Permission already Exist',
                'alert-type' => 'info'
            );
            return redirect()->route('role.edit', ['id' => $role])->with($notification);
        }

        $role->givePermissionTo($request->permission);


        $notification = array(
            'message' => 'New Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('role.edit', ['id' => $role])->with($notification);
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        Gate::authorize('role.permissions.revoke', $permission);

        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);

            $notification = array(
                'message' => 'Role Permission revoked',
                'alert-type' => 'error'
            );

            return redirect()->route('role.edit', ['id' => $role])->with($notification);
        }
        $notification = array(
            'message' => 'Role Permission not exists',
            'alert-type' => 'info'
        );

        return redirect()->route('role.edit', ['id' => $role])->with($notification);
    }

    public function syncPermissions(Request $request, Role $role)
    {
        Gate::authorize('role.permissions.sync', $role);

        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        $notification = array(
            'message' => 'Permissions synced successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('role.index')->with($notification);
    }
}
