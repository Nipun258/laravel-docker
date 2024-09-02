<?php

use App\Http\Controllers\API\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user/list', [CommonController::class ,'getUserList'])->name('get.user.list');
Route::get('/category/list', [CommonController::class ,'getCategoryList'])->name('get.category.list');
