<?php

use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\LaporanStockController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StockController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'postLogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

Route::get('customer', [DataCustomerController::class, 'index'])->name('customer');
Route::post('/customerpost', [DataCustomerController::class, 'post'])->name('customerpost');
Route::get('/customer/{customer}/edit', [DataCustomerController::class, 'getedit'])->name('customeredit');
Route::post('/customer/{customer}', [DataCustomerController::class, 'update'])->name('customerupdate');
Route::post('/customer/delete/{customer}', [DataCustomerController::class, 'delete'])->name('customerdelete');
Route::post('/getcustomer', [DataCustomerController::class, 'getcustomer'])->name('getcustomer');

Route::get('produk', [ProdukController::class, 'index'])->name('produk');
Route::post('/produkpost', [ProdukController::class, 'post'])->name('produkpost');
Route::get('/produk/{produk}/edit', [ProdukController::class, 'getedit'])->name('produkedit');
Route::post('/produk/{produk}', [ProdukController::class, 'update'])->name('produkupdate');
Route::post('/produk/delete/{produk}', [ProdukController::class, 'delete'])->name('produkdelete');
Route::post('/getproduk', [ProdukController::class, 'getproduk'])->name('getproduk');

Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan');
Route::post('penjualanpost', [PenjualanController::class, 'post'])->name('penjualanpost');
Route::get('penjualanlist', [PenjualanController::class, 'list'])->name('penjualanlist');
Route::get('/penjualan/{penjualan}/edit', [PenjualanController::class, 'getedit'])->name('penjualanedit');
Route::post('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('penjualanupdate');
Route::get('/penjualan/{penjualan}/print', [PenjualanController::class, 'printpdfpenjualan'])->name('penjualanprintmatrix');

Route::get('stock', [StockController::class, 'index'])->name('stock');
Route::post('stockpost', [StockController::class, 'post'])->name('stockpost');
Route::get('stocklist', [StockController::class, 'list'])->name('stocklist');
Route::get('/stock/{stock}/edit', [StockController::class, 'getedit'])->name('stockedit');
Route::post('/stock/{stock}', [StockController::class, 'update'])->name('stockupdate');

Route::get('lapstock', [LaporanStockController::class, 'index'])->name('lapstock');
Route::get('rlaperoutletsearch', [ControllerReportPerOutlet::class, 'post'])->name('rlaperoutletpost');
});