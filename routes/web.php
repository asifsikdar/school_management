<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MainAdminController;

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
    return view('auth.login');
});

Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
   Route::get('/login',[AdminController::class,'loginform']);
   Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('Admin.index');
})->name('dashboard');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('User.index');
})->name('dashboard');


// User route
Route::get('/user/logout',[MainUserController::class,'logout'])->name('user.logout');
Route::get('/user/profile',[MainUserController::class,'userprofile'])->name('user.profile');
Route::get('/user/profile/edit',[MainUserController::class,'UserProfileEdit'])->name('user.edit.profile');
Route::post('/user/profile/update',[MainUserController::class,'UserProfileUpdate'])->name('profile.store');
Route::get('/user/password/view',[MainUserController::class,'Userpasswordview'])->name('password.view.page');
Route::post('/user/password/update',[MainUserController::class,'Userpasswordupdate'])->name('password.update');

// Admin route
Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('/admin/profile',[MainAdminController::class,'adminprofile'])->name('admin.profile');
Route::get('/Admin/profile/edit',[MainAdminController::class,'AdminProfileEdit'])->name('admin.edit.profile');
Route::post('/admin/profile/update',[MainAdminController::class,'AdminProfileUpdate'])->name('admin.profile.store');
Route::get('/admin/password/view',[MainAdminController::class,'adminpasswordview'])->name('admin.password.view');
Route::post('/admin/password/update',[MainAdminController::class,'adminpasswordupdate'])->name('admin.password.update');