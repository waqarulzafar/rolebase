<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('newuseremail',[\App\Http\Controllers\Admin\UserController::class,'checkEmail']);

Route::group(['prefix'=>'admin'],function(){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'dashboard']);
    Route::group(['prefix'=>'user'],function(){
        Route::get('/',[\App\Http\Controllers\Admin\UserController::class,'index']);
        Route::get('/create',[\App\Http\Controllers\Admin\UserController::class,'create']);
        Route::post('/post-user',[\App\Http\Controllers\Admin\UserController::class,'postUser']);
        Route::get('/fetch-users',[\App\Http\Controllers\Admin\UserController::class,'fetchUser']);
        Route::get('/edituser/{id}',[\App\Http\Controllers\Admin\UserController::class,'editUser']);
        Route::post('/postedituser/{id}',[\App\Http\Controllers\Admin\UserController::class,'postEditUser']);
        Route::get('/deleteuser/{id}',[\App\Http\Controllers\Admin\UserController::class,'deleteUser']);


        Route::get('/role',[\App\Http\Controllers\Admin\UserController::class,'role']);
        Route::get('/fetch-role',[\App\Http\Controllers\Admin\UserController::class,'fetchRoles']);
        Route::post('/store-role',[\App\Http\Controllers\Admin\UserController::class,'storeRole']);

    });

    Route::group(['prefix'=>'department'],function(){
        Route::get('/',[\App\Http\Controllers\Admin\DepartmentController::class,'index']);
        Route::get('/fetch-department',[\App\Http\Controllers\Admin\DepartmentController::class,'fetchDepartment']);
        Route::post('/store-department',[\App\Http\Controllers\Admin\DepartmentController::class,'storeDepartment']);
    });
    Route::group(['prefix'=>'file'],function(){
        Route::get('/',[\App\Http\Controllers\Admin\FileController::class,'index']);
        Route::get('/fetch-files',[\App\Http\Controllers\Admin\FileController::class,'fetchFiles']);
        Route::post('/store-file',[\App\Http\Controllers\Admin\FileController::class,'storeFile']);
    });
    });
