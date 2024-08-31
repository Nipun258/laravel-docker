<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Setup\CategoryController;
use App\Http\Controllers\Setup\CategoryTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'prevent-back-history'], function () {

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified','role:Super-Admin|Admin|User'])->name('dashboard');

Route::middleware('auth', 'role:Super-Admin|Admin|User')->prefix('profile')->group(function () {

    Route::get('/view', [AdminController::class, 'ProfileView'])->name('profile.view');

}); //user profile controller route list

Route::middleware('auth', 'role:Super-Admin|Admin')->prefix('user')->group(function () {

    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add/view', [UserController::class, 'UserAddView'])->name('user.add.view');
    Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');
    Route::get('/inactive/{id}', [UserController::class, 'UserInactive'])->name('user.inactive');
    Route::get('/active/{id}', [UserController::class, 'UserActive'])->name('user.active');
    Route::get('/show/{id}', [UserController::class, 'UserShow'])->name('user.show');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::get('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::get('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
}); //user manage controller route list


Route::middleware('auth', 'role:Super-Admin')->prefix('role')->group(function () {

    Route::get('/index', [RoleController::class, 'roleIndex'])->name('role.index');
    Route::get('/add', [RoleController::class, 'roleAdd'])->name('role.add');
    Route::post('/store', [RoleController::class, 'roleStore'])->name('role.store');
    Route::get('/edit/{id}', [RoleController::class, 'roleEdit'])->name('role.edit');
    Route::post('/update/{id}', [RoleController::class, 'roleUpdate'])->name('role.update');
    Route::get('/delete/{id}', [RoleController::class, 'roleDelete'])->name('role.delete');
    Route::get('/permissions/list/{id}', [RoleController::class, 'rolePermissionList'])->name('role.permission.list');
    Route::post('permission/role/update/{role}', [RoleController::class, 'permissionRoleUpdate'])->name('role.permission.update');
    Route::get('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
}); //system role management route list

Route::middleware('auth', 'role:Super-Admin')->prefix('permission')->group(function () {

    Route::get('/index', [PermissionController::class, 'permissionIndex'])->name('permission.index');
    Route::get('/add', [PermissionController::class, 'permissionAdd'])->name('permission.add');
    Route::post('/store', [PermissionController::class, 'permissionStore'])->name('permission.store');
    Route::get('/edit/{id}', [PermissionController::class, 'permissionEdit'])->name('permission.edit');
    Route::post('/update/{id}', [PermissionController::class, 'permissionUpdate'])->name('permission.update');
    Route::get('/delete/{id}', [PermissionController::class, 'permissionDelete'])->name('permission.delete');
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::get('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
}); //system permission route list


Route::middleware('auth', 'role:Super-Admin|Admin')->prefix('setup')->group(function () {

    Route::get('/catagory/type/view', [CategoryTypeController::class, 'CategoryTypeIndex'])->name('category.type.index');
    Route::get('/catagory/type/add', [CategoryTypeController::class, 'CategoryTypeAdd'])->name('category.type.add');
    Route::post('/category/type/store', [CategoryTypeController::class, 'CategoryTypeStore'])->name('category.type.store');
    Route::get('/category/type/edit/{id}', [CategoryTypeController::class, 'CategoryTypeEdit'])->name('category.type.edit');
    Route::post('/category/type/update/{id}', [CategoryTypeController::class, 'CategoryTypeUpdate'])->name('category.type.update');
    Route::get('/category/type/delete/{id}', [CategoryTypeController::class, 'CategoryTypeDelete'])->name('category.type.delete');
    Route::get('/category/list/{id}', [CategoryTypeController::class, 'CategoryList'])->name('category.list');

    Route::get('/category/view', [CategoryController::class, 'CategoryIndex'])->name('category.index');
    Route::get('/category/add', [CategoryController::class, 'CategoryAdd'])->name('category.add');
    Route::post('/category/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

});


}); //prevent back history
require __DIR__.'/auth.php';
