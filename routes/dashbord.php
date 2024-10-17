<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfieController;

use Illuminate\Support\Facades\Route;

// Route::group([
//     'middleware' => ['auth:admin,web'],
//     'as' => 'dashboard.',
//     'prefix' => 'admin/dashboard'
// ],function(){
    Route::get('/dashboard',[DashbordController::class,'index'])->name('dashboard')->middleware('auth:admin');
    Route::resource('/dashboard/categories',CategoriesController::class)->middleware('auth:admin');
    Route::get('/category/delted',[CategoriesController::class,'showdeleted'])->name('trash')->middleware('auth:admin');
    Route::get('/category/restore/{id}',[CategoriesController::class,'restore'])->name('restore');
    Route::delete('/category/forcedeleted/{id}',[CategoriesController::class,'forceDelete'])->name('forceDelete');
    Route::resource('/dashboard/products',ProductController::class)->middleware('auth:admin');
    Route::get('/dashbord/profile',[ProfieController::class,'edit'])->name('profileeedit')->middleware('auth:admin');
    Route::patch('/userprofile',[ProfieController::class,'update'])->name('profileeupdate')->middleware('auth:admin');
// });





