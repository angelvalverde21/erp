<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\Dashboard;
use App\Http\Livewire\User\Product\ShowProducts;
use App\Http\Livewire\User\Product\EditProduct;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Livewire\User\EditProfile;
use App\Http\Livewire\User\Product\CreateProduct;
use App\Http\Livewire\User\Profile;
use App\Http\Livewire\User\Profile\ShowProfile;
use App\Http\Livewire\User\Purchases\ShowPurchases;
use App\Http\Livewire\User\Sales\EditSale;
use App\Http\Livewire\User\Sales\ShowSales;
use Illuminate\Support\Facades\Artisan;

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

//GET
Route::get('/', Dashboard::class)->name('user');
Route::get('/products', ShowProducts::class)->name('user.products');
Route::get('/products/{product}/edit', EditProduct::class)->name('user.products.edit');
Route::get('/products/create', CreateProduct::class)->name('user.products.create');

//USER
Route::get('/profile', ShowProfile::class)->name('user.profile');
//USER POST  (files)
// Route::post('/profile/{user}/upload-logo-general', [UserController::class,'uploadLogoGeneral'])->name('user.profile.upload-logo-general');
// Route::post('/profile/{user}/upload-logo-invoice', [UserController::class,'uploadLogoInvoice'])->name('user.profile.upload-logo-invoice');
// Route::post('/profile/{user}/profile-photo-path', [UserController::class,'profilePhotoPath'])->name('user.profile.profile-photo-path');
//USER POST: Upload profile general
Route::post('/profile/{user}/{field}', [UserController::class,'uploadFile'])->name('user.profile.upload');
  // http://erp.test/user/profile/10/upload_logo_general
//SALES
Route::get('/sales', ShowSales::class)->name('user.sales');
Route::get('/sales/{sale}/edit', EditSale::class)->name('user.sales.edit');

//PURCHASES
Route::get('/purchases', ShowPurchases::class)->name('user.purchases');

//POST Products
Route::post('/products/{product}/files', [ProductController::class,'files'])->name('user.products.files');
Route::post('/products/{product}/colors', [ProductController::class,'colors'])->name('user.products.colors');
Route::post('/products/{image}/editimage', [ProductController::class,'editimage'])->name('user.products.editimage');
Route::post('/products/{color}/edit-color', [ProductController::class,'editColor'])->name('user.products.edit-color');

//POST Sales (comprobantes)
Route::post('/sales/{order}/photo-payment', [OrderController::class,'photoPayment'])->name('user.sales.photo-payment');
Route::post('/sales/{order}/photo-package', [OrderController::class,'photoPackage'])->name('user.sales.photo-package');
Route::post('/sales/{order}/photo-delivery', [OrderController::class,'photoDelivery'])->name('user.sales.photo-delivery');
Route::post('/sales/{order}/{field}', [OrderController::class,'uploadFileOrder'])->name('user.sales.upload');

//GET Imprimir PDF
Route::get('/sales/{order}/print/voucher', [PdfController::class,'generateVaucher'])->name('user.sales.print.voucher');
Route::get('/sales/{order}/print/packing-label', [PdfController::class,'generatePackingLabel'])->name('user.sales.print.packing-label');

Route::get('/link', function () {
    Artisan::call('storage:link');
});