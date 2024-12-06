<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Setup\CategoryController;
use App\Http\Controllers\Setup\CategoryTypeController;
use App\Http\Controllers\Setup\CourseController;
use App\Http\Controllers\Setup\CourseFeeController;
use App\Http\Controllers\Setup\IncomeTypeController;
use App\Http\Controllers\Setup\StudyBoardChairPersonController;
use App\Http\Controllers\Setup\StudyBoardContoller;
use App\Http\Controllers\Setup\StudyBoardSubjectContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'permission:dashbord.view'])->name('dashboard');

    Route::middleware('auth', 'permission:dashbord.view')->prefix('profile')->group(function () {

        Route::get('/view', [AdminController::class, 'ProfileView'])->name('profile.view');
    }); //user profile controller route list

    Route::middleware('auth')->prefix('user')->group(function () {

        Route::get('/view', [UserController::class, 'UserView'])->name('user.view')->middleware('permission:user.view');

        Route::group(['middleware' => ['permission:user.create']], function () {
            Route::get('/add/view', [UserController::class, 'UserAddView'])->name('user.add.view');
            Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
        });

        Route::group(['middleware' => ['permission:user.updation']], function () {
            Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
            Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');
        });

        Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete')->middleware('permission:user.delete');

        Route::get('/inactive/{id}', [UserController::class, 'UserInactive'])->name('user.inactive')->middleware('permission:user.inactivate');

        Route::get('/active/{id}', [UserController::class, 'UserActive'])->name('user.active')->middleware('permission:user.activate');

        Route::get('/show/{id}', [UserController::class, 'UserShow'])->name('user.show')->middleware('permission:user.show');

        Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles')->middleware('permission:user.roles.assign');
        Route::get('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove')->middleware('permission:user.roles.remove');
        Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions')->middleware('permission:user.permissions.assign');
        Route::get('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke')->middleware('permission:user.permissions.revoke');
    }); //user manage controller route list


    Route::middleware('auth')->prefix('role')->group(function () {

        Route::get('/index', [RoleController::class, 'roleIndex'])->name('role.index')->middleware('permission:role.index');

        Route::group(['middleware' => ['permission:role.create']], function () {
           Route::get('/add', [RoleController::class, 'roleAdd'])->name('role.add');
           Route::post('/store', [RoleController::class, 'roleStore'])->name('role.store');
        });

        Route::group(['middleware' => ['permission:role.updation']], function () {
           Route::get('/edit/{id}', [RoleController::class, 'roleEdit'])->name('role.edit');
           Route::post('/update/{id}', [RoleController::class, 'roleUpdate'])->name('role.update');
        });

        Route::get('/delete/{id}', [RoleController::class, 'roleDelete'])->name('role.delete')->middleware('permission:role.delete');
        Route::get('/permissions/list/{id}', [RoleController::class, 'rolePermissionList'])->name('role.permission.list')->middleware('permission:role.permission.list');
        Route::post('permission/role/update/{role}', [RoleController::class, 'permissionRoleUpdate'])->name('role.permission.update')->middleware('permission:role.permission.update');
        Route::get('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke')->middleware('permission:role.permissions.revoke');
        Route::post('/role/{role}/sync-permissions', [RoleController::class, 'syncPermissions'])->name('role.syncPermissions')->middleware('permission:role.permissions.sync');
    }); //system role management route list

    Route::middleware('auth')->prefix('permission')->group(function () {

        Route::get('/index', [PermissionController::class, 'permissionIndex'])->name('permission.index')->middleware('permission:permission.index');

        Route::group(['middleware' => ['permission:permission.create']], function () {
           Route::get('/add', [PermissionController::class, 'permissionAdd'])->name('permission.add');
           Route::post('/store', [PermissionController::class, 'permissionStore'])->name('permission.store');
        });

        Route::group(['middleware' => ['permission:permission.updation']], function () {
           Route::get('/edit/{id}', [PermissionController::class, 'permissionEdit'])->name('permission.edit');
           Route::post('/update/{id}', [PermissionController::class, 'permissionUpdate'])->name('permission.update');
        });

        Route::get('/delete/{id}', [PermissionController::class, 'permissionDelete'])->name('permission.delete')->middleware('permission:permission.delete');
        Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles')->middleware('permission:permission.roles.assign');
        Route::get('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove')->middleware('permission:permission.roles.remove');
    }); //system permission route list


    Route::middleware('auth')->prefix('setup')->group(function () {

        Route::get('/catagory/type/view', [CategoryTypeController::class, 'CategoryTypeIndex'])->name('category.type.index')->middleware('permission:category.type.list');

        Route::group(['middleware' => ['permission:category.type.create']], function () {
           Route::get('/catagory/type/add', [CategoryTypeController::class, 'CategoryTypeAdd'])->name('category.type.add');
           Route::post('/category/type/store', [CategoryTypeController::class, 'CategoryTypeStore'])->name('category.type.store');
        });

        Route::group(['middleware' => ['permission:category.type.updation']], function () {
           Route::get('/category/type/edit/{id}', [CategoryTypeController::class, 'CategoryTypeEdit'])->name('category.type.edit');
           Route::post('/category/type/update/{id}', [CategoryTypeController::class, 'CategoryTypeUpdate'])->name('category.type.update');
        });

        Route::get('/category/type/delete/{id}', [CategoryTypeController::class, 'CategoryTypeDelete'])->name('category.type.delete')->middleware('permission:category.type.delete');

        Route::get('/category/list/{id}', [CategoryTypeController::class, 'CategoryList'])->name('category.list')->middleware('permission:category.list.check');

        /***************************************************************************************************** */

        Route::get('/category/view', [CategoryController::class, 'CategoryIndex'])->name('category.index')->middleware('permission:category.list');

        Route::group(['middleware' => ['permission:category.create']], function () {
           Route::get('/category/add', [CategoryController::class, 'CategoryAdd'])->name('category.add');
           Route::post('/category/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
        });

        Route::group(['middleware' => ['permission:category.updation']], function () {
          Route::get('/category/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
          Route::post('/category/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
        });

        Route::get('/category/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete')->middleware('permission:category.delete');

        /***************************************************************************************************** */

        Route::get('/stady/board/view', [StudyBoardContoller::class, 'StudyBoardIndex'])->name('study.board.index')->middleware('permission:study.board.list');

        Route::group(['middleware' => ['permission:study.board.create']], function () {
            Route::get('/stady/board/add', [StudyBoardContoller::class, 'StudyBoardAdd'])->name('study.board.add');
            Route::post('/stady/board/store', [StudyBoardContoller::class, 'StudyBoardStore'])->name('study.board.store');
         });

         Route::group(['middleware' => ['permission:study.board.updation']], function () {
            Route::get('/stady/board/edit/{id}', [StudyBoardContoller::class, 'StudyBoardEdit'])->name('study.board.edit');
            Route::post('/stady/board/update/{id}', [StudyBoardContoller::class, 'StudyBoardUpdate'])->name('study.board.update');
          });

          Route::get('/stady/board/show/{id}', [StudyBoardContoller::class, 'StudyBoardShow'])->name('study.board.show')->middleware('permission:study.board.show');

          Route::get('/stady/board/delete/{id}', [StudyBoardContoller::class, 'StudyBoardDelete'])->name('study.board.delete')->middleware('permission:study.board.delete');

         /*************************************************************************************************** */

        Route::get('/stady/board/subject/view', [StudyBoardSubjectContoller::class, 'StudyBoardSubjectIndex'])->name('study.board.subject.index')->middleware('permission:study.board.subject.list');

        Route::group(['middleware' => ['permission:study.board.subject.create']], function () {
            Route::get('/stady/board/subject/add', [StudyBoardSubjectContoller::class, 'StudyBoardSubjectAdd'])->name('study.board.subject.add');
            Route::post('/stady/board/subject/store', [StudyBoardSubjectContoller::class, 'StudyBoardSubjectStore'])->name('study.board.subject.store');
         });

         Route::group(['middleware' => ['permission:study.board.subject.updation']], function () {
            Route::get('/stady/board/subject/edit/{id}', [StudyBoardSubjectContoller::class, 'StudyBoardSubjectEdit'])->name('study.board.subject.edit');
            Route::post('/stady/board/subject/update/{id}', [StudyBoardSubjectContoller::class, 'StudyBoardSubjectUpdate'])->name('study.board.subject.update');
          });

          Route::get('/stady/board/subject/delete/{id}', [StudyBoardSubjectContoller::class, 'StudyBoardChairPersonDelete'])->name('study.board.subject.delete')->middleware('permission:study.board.subject.delete');

          /*************************************************************************************************** */

        Route::get('/stady/board/chair/person/view', [StudyBoardChairPersonController::class, 'StudyBoardChairPersonIndex'])->name('study.board.chair.person.index')->middleware('permission:study.board.chair.person.list');

        Route::group(['middleware' => ['permission:study.board.chair.person.create']], function () {
            Route::get('/stady/board/chair/person/add', [StudyBoardChairPersonController::class, 'StudyBoardChairPersonAdd'])->name('study.board.chair.person.add');
            Route::post('/stady/board/chair/person/store', [StudyBoardChairPersonController::class, 'StudyBoardChairPersonStore'])->name('study.board.chair.person.store');
         });

         Route::group(['middleware' => ['permission:study.board.chair.person.updation']], function () {
            Route::get('/stady/board/chair/person/edit/{id}', [StudyBoardChairPersonController::class, 'StudyBoardChairPersonEdit'])->name('study.board.chair.person.edit');
            Route::post('/stady/board/chair/person/update/{id}', [StudyBoardChairPersonController::class, 'StudyBoardChairPersonUpdate'])->name('study.board.chair.person.update');
          });

          Route::get('/stady/board/chair/person/delete/{id}', [StudyBoardChairPersonController::class, 'StudyBoardChairPersonDelete'])->name('study.board.chair.person.delete')->middleware('permission:study.board.chair.person.delete');

          /***************************************************************************************************** */

        Route::get('/course/view', [CourseController::class, 'CourseIndex'])->name('course.index')->middleware('permission:course.list');

        Route::group(['middleware' => ['permission:course.create']], function () {
            Route::get('/course/add', [CourseController::class, 'CourseAdd'])->name('course.add');
            Route::post('/course/store', [CourseController::class, 'CourseStore'])->name('course.store');
         });

         Route::group(['middleware' => ['permission:course.updation']], function () {
            Route::get('/course/edit/{id}', [CourseController::class, 'CourseEdit'])->name('course.edit');
            Route::post('/course/update/{id}', [CourseController::class, 'CourseUpdate'])->name('course.update');
          });

          Route::get('/course/show/{id}', [CourseController::class, 'CourseShow'])->name('course.show')->middleware('permission:course.show');

          Route::get('/course/delete/{id}', [CourseController::class, 'CourseDelete'])->name('course.delete')->middleware('permission:course.delete');

          /***************************************************************************************************** */

        Route::get('/income/type/view', [IncomeTypeController::class, 'IncomeTypeIndex'])->name('income.type.index')->middleware('permission:income.type.list');

        Route::group(['middleware' => ['permission:income.type.create']], function () {
            Route::get('/income/type/add', [IncomeTypeController::class, 'IncomeTypeAdd'])->name('income.type.add');
            Route::post('/income/type/store', [IncomeTypeController::class, 'IncomeTypeStore'])->name('income.type.store');
         });

         Route::group(['middleware' => ['permission:income.type.updation']], function () {
            Route::get('/income/type/edit/{id}', [IncomeTypeController::class, 'IncomeTypeEdit'])->name('income.type.edit');
            Route::post('/income/type/update/{id}', [IncomeTypeController::class, 'IncomeTypeUpdate'])->name('income.type.update');
          });

        Route::get('/income/type/delete/{id}', [IncomeTypeController::class, 'IncomeTypeDelete'])->name('income.type.delete')->middleware('permission:income.type.delete');

        /***************************************************************************************************** */

        Route::get('/course/fee/view', [CourseFeeController::class, 'CourseFeeIndex'])->name('course.fee.index')->middleware('permission:course.fee.list');

        Route::group(['middleware' => ['permission:course.fee.create']], function () {
            Route::get('/course/fee/add', [CourseFeeController::class, 'CourseFeeAdd'])->name('course.fee.add');
            Route::post('/course/fee/store', [CourseFeeController::class, 'CourseFeeStore'])->name('course.fee.store');
         });

         Route::group(['middleware' => ['permission:course.fee.updation']], function () {
            Route::get('/course/fee/edit/{id}', [CourseFeeController::class, 'CourseFeeEdit'])->name('course.fee.edit');
            Route::post('/course/fee/update/{id}', [CourseFeeController::class, 'CourseFeeUpdate'])->name('course.fee.update');
          });

          Route::get('/course/fee/show/{id}', [CourseFeeController::class, 'CourseFeeShow'])->name('course.fee.show')->middleware('permission:course.fee.show');

          Route::get('/course/fee/delete/{id}', [CourseFeeController::class, 'CourseFeeDelete'])->name('course.fee.delete')->middleware('permission:course.fee.delete');
    });

    Route::middleware('auth')->prefix('setting')->group(function () {

        Route::get('/view', [SiteSettingController::class, 'index'])->name('site.setting.index')->middleware('permission:site.setting.index');
        Route::post('/update', [SiteSettingController::class, 'update'])->name('site.settings.update')->middleware('permission:site.settings.update');
        Route::get('/restore/default', [SiteSettingController::class, 'restoreDefault'])->name('site.settings.restore.default')->middleware('permission:site.settings.restore.default');
    }); //user profile controller route list

}); //prevent back history
require __DIR__ . '/auth.php';
