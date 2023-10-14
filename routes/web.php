<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Batterycontroller;
use App\Http\Controllers\ProductController;


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
    return view('index');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/shop', function (){
  return view('shop');
});
Route::get('/product-single', function (){
    return view('product-single');
  });
  Route::get('/checkout', function (){
    return view('checkout');
  });
  Route::get('/shopad', function (){
    return view('shopadmin');
  });
  Route::get('/superad',function(){
    return view('superadmin');
  });
   Route::get('/login',function(){
    return view('login');
   });
  Route::get('/add',function(){
    return view('addproduct');
  });
  

  // Route::get('/Product_Upload', [ProductController::class, '/Product_Upload_']);
  // Route::get('product-list/{id}/edit', [ProductController::class, 'edit']);
  Route::post('/Product_Upload', [ProductController::class, 'Product_upload']);
  // Route::get('product-list/delete/{id}', [ProductController::class, 'destroy']);