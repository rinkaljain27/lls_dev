<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\systemLogController;


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
    return view('auth/login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Administrator Routes
Route::post('roles/validateRecord',[RoleController::class,'validateRecord']);
Route::post('roles/updateStatus',[RoleController::class,'updateStatus']);
Route::resource('/roles',RoleController::class);

Route::post('product_type/validateRecord',[ProductTypeController::class,'validateRecord']);
Route::post('product_type/updateStatus',[ProductTypeController::class,'updateStatus']);
Route::resource('/product_type',ProductTypeController::class);

Route::post('product/validateRecord',[ProductController::class,'validateRecord']);
Route::post('product/updateStatus',[ProductController::class,'updateStatus']);
Route::resource('/product',ProductController::class);

Route::post('/validateProfileRecord',[UserController::class,'validateProfileRecord']);
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/updateProfile',[UserController::class,'updateProfile']);
Route::post('users/validateRecord',[UserController::class,'validateRecord']);
Route::post('users/updateStatus',[UserController::class,'updateStatus']);
Route::resource('/users',UserController::class);

Route::post('commands/validateRecord',[CommandController::class,'validateRecord']);
Route::post('commands/updateStatus',[CommandController::class,'updateStatus']);
Route::resource('/commands',CommandController::class);

Route::post('permissions/validateRecord',[PermissionController::class,'validateRecord']);
Route::post('permissions/updateStatus',[PermissionController::class,'updateStatus']);
Route::resource('/permissions',PermissionController::class);

Route::get('/system_logs/getSystemLogs',  [systemLogController::class,'getSystemLogs']);
Route::resource('/system_logs',systemLogController::class);

    
   