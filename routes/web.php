<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\WebsiteSettingController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('admin');
});



Route::get('admin',[AdminController::class,'login_form'])->name('login.form');
Route::post('login-functionality',[AdminController::class,'adminlogin'])->name('admin.login');
Route::group(['middleware'=>'admin'],function(){
    Route::get('logout',[AdminController::class,'logout'])->name('logout');
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('profile/edit',[AdminController::class,'adminedit'])->name('adminprofile.edit');
    Route::put('profile/update',[AdminController::class,'profileUpdate'])->name('adminprofile.update');
    //website setting route//
    Route::get('website/edit',[WebsiteSettingController::class,'edit'])->name('website.edit');
    Route::put('website/update{id}',[WebsiteSettingController::class,'update'])->name('website.update');
    //category route//
    Route::resource('categories',CategoryController::class);
    //subcategory route//
    Route::resource('subcategories',SubCategoryController::class);
    //employe route//
    Route::resource('employes',EmployeController::class);
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
