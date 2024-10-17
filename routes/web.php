<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\TwoFactoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/products',[ProductsController::class,'index'])->name('allproducts');
Route::get('/product/{product:slug}',[ProductsController::class,'show'])->name('singelproduct');
Route::resource('/cart', CartController::class);
Route::get('checkout',[OrderController::class,'create'])->name('checkout');
Route::post('checkout',[OrderController::class,'store']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/auth/twofactory',[TwoFactoryController::class,'index']);

Route::post('currency',[CurrencyConverterController::class,'store'])->name('currency.store');
// require __DIR__.'/auth.php';

Route::resource('roles',RoleController::class);
Route::group(['middleware' => ['auth:admin']], function() {
Route::resource('users','UserController');
});

Route::post('checkout',[CheckoutController::class,'index'])->name('checkoutt');
Route::get('checkout/response',function(Request $request){
   return $request->all();
});