<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, ProductController, SellingInfoController};
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==== resource controller route start ====

Route::resource('product', ProductController::class);
Route::resource('selling_info', SellingInfoController::class);

// ==== resource controller route end ====

Route::get('product/delete/product/{id}', [ProductController::class, 'deleteproduct'])->name('delete.product');
Route::get('product/trash/product', [ProductController::class, 'trashproduct'])->name('trash.product');
Route::get('product/trash/resotre/{id}', [ProductController::class, 'trashrestore'])->name('trash.restore');
Route::post('product/trash/forcedelete', [ProductController::class, 'trashforcedelete'])->name('trash.forcedelete');
Route::get('selling/info/adminindex', [SellingInfoController::class, 'adminindex'])->name('sellinginfo.adminindex');
// Route::post('selling_info/product_info', [SellingInfoController::class, 'selling_info_product_info'])->name('selling_info.product_info');

