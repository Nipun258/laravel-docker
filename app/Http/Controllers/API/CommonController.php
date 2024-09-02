<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getUserList(){
        $data = User::all();
        return response()->json($data, 200);
    }

    public function getCategoryList(){
        $data = Category::all();
        return response()->json($data, 200);
    }
}
