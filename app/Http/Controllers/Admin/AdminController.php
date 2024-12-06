<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [
            'auth'
        ];
    }

    public function index(){

       Gate::authorize('dashbord.view');
       return view('admin.index');

    }

    public function ProfileView()
    {
        Gate::authorize('perofile.view');
        $id = Auth::user()->id;
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.profile', compact('user', 'roles'));
    }


}
