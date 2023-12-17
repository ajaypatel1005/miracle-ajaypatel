<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
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



Route::group(['middleware' => ['auth','role']], function () {
    //Begin::User type
    Route::get('user-type',[UserTypeController::class,'index']);
    Route::get('user-type-create',[UserTypeController::class,'create']);
    Route::post('user-type-store',[UserTypeController::class,'store'])->name('user-type-store');
    Route::get('user-type-edit/{id}',[UserTypeController::class,'edit']);
    Route::get('user-type-delete/{id}',[UserTypeController::class,'destroy']);
    Route::post('user-type-update', [UserTypeController::class, 'update'])->name('user-type-update');
    //End::User type
    
    //Begin::Users
    Route::get('users',[UserController::class,'index']);
    Route::get('users-create',[UserController::class,'create']);
    Route::post('users-store',[UserController::class,'store'])->name('users-store');
    Route::get('users-edit/{id}',[UserController::class,'edit']);
    Route::get('users-delete/{id}',[UserController::class,'destroy']);
    Route::post('users-update', [UserController::class, 'update'])->name('users-update');
    //End::Users

    //Begin::Users profile
    Route::get('profile',[UserController::class,'profileEdit']);
    Route::post('profile-update', [UserController::class, 'updateProfile'])->name('profile-update');
    //End::Users profile
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
