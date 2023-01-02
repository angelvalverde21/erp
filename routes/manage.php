<?php

use App\Http\Controllers\Manage\Print\Order\PdfController;
use App\Http\Controllers\Manage\ProductController;
use App\Http\Controllers\Manage\Upload\OrderController;
use App\Http\Controllers\Manage\Upload\UserImageController;
use App\Http\Livewire\Manage\Customers\CreateCustomer;
use App\Http\Livewire\Manage\Customers\EditCustomer;
use App\Http\Livewire\Manage\Customers\ShowCustomers;
use App\Http\Livewire\Manage\Dashboard;
use App\Http\Livewire\Manage\Orders\EditOrder;
use App\Http\Livewire\Manage\Orders\ShowOrders;
use App\Http\Livewire\Manage\Products\CreateProduct;
use App\Http\Livewire\Manage\Products\EditProduct;
use App\Http\Livewire\Manage\Products\ShowProducts;
use App\Http\Livewire\Manage\Profile\ShoProfileWeb;
use App\Http\Livewire\Manage\Profile\ShowProfileStore;
use App\Http\Livewire\Manage\Profile\ShowProfileWeb;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::name('manage.')->middleware('StoreExist')->group(function () {

   Route::get('/', Dashboard::class)->name('dashboard');

   //PRODUCTS
   Route::get('/products', ShowProducts::class)->name('products');
   Route::get('/products/{product}/edit', EditProduct::class)->name('products.edit');
   Route::get('/products/create', CreateProduct::class)->name('products.create');

   //ORDERS
   Route::get('/orders', ShowOrders::class)->name('orders');
   Route::get('/orders/{order}/edit', EditOrder::class)->name('orders.edit');

   //PROFILE
   // Route::get('/user', ShowProfileUser::class)->name('user');
   // Route::get('/stores', ShowProfileStore::class)->name('stores');
   // Route::get('/stores/create', CreateStore::class)->name('stores.create');
   Route::get('/profile', ShowProfileStore::class)->name('profile');
   Route::get('/profile/web', ShowProfileWeb::class)->name('web');

   //POST Products
   Route::post('/products/{product}/colors', [ProductController::class, 'colors'])->name('products.colors');
   Route::post('/products/{product}/images', [ProductController::class, 'images'])->name('products.images');
   // http://erp.test/ara/manage/products/6/colors
   // http://erp.test/user/profile/10/upload_logo_general
   // Route::post('/products/{product}/images', function(){
   //    Log::info("llego al route.php");
   // })->name('products.images');
   Route::post('/products/editimage/{image}', [ProductController::class, 'editimage'])->name('products.editimage');
   //OJO NO PASAMOS LA VARIABLE PRODUCT_ID PORQUE LOS COLORES SON UNICOS
   Route::post('/products/editcolor/{color}', [ProductController::class, 'editColor'])->name('products.editcolor');

   //GET customers
   Route::get('/customers', ShowCustomers::class)->name('customers');
   Route::get('/customers/create', CreateCustomer::class)->name('customers.create');
   Route::get('/customers/{customer}/edit', EditCustomer::class)->name('customers.edit');

   //GET Imprimir PDF
   Route::get('/orders/{order}/print/voucher', [PdfController::class, 'generateVaucher'])->name('orders.print.voucher');
   Route::get('/orders/{order}/print/packing-label/{current}', [PdfController::class, 'generatePackingLabel'])->name('orders.print.packing-label');

   //POST orders (comprobantes)
   // Route::post('/orders/{order}/photo-payment', [OrderController::class, 'photoPayment'])->name('orders.photo-payment');
   // Route::post('/orders/{order}/photo-package', [OrderController::class, 'photoPackage'])->name('orders.photo-package');
   // Route::post('/orders/{order}/photo-delivery', [OrderController::class, 'photoDelivery'])->name('orders.photo-delivery');
   Route::post('/orders/{order}/{field}', [OrderController::class, 'uploadFileOrder'])->name('orders.upload');

   //Post upload home carousel

   Route::post('/post/profile/carousel', [UserImageController::class, 'uploadCarousel'])->name('post.profile.carousel');

});

// Route::bind('',function(User $nickname){
//     Route::get('/products', ShowProducts::class)->name('products');
// });

// Route::name('manage.')->group(function(){
//     Route::get('/products', ShowProducts::class)->name('products');
// });

//Este tambien funciona
//Route::middleware('StoreExist')->get('/products', ShowProducts::class)->name('manage.products');

//Este funciona
// Route::get('/products', function(User $nickname){
//    return App::call(ShowProducts::class);
// })->middleware('StoreExist')->name('manage.products');
//fin

//Route::get('/products', ShowProducts::class)->name('manage.products');


// Shop things content
// Route::group(['domain' => '{slug}.' . env('PLAIN_URL'), 'middleware'=>'ShopExist'], function () {
//    Route::get('/','Shop\HomeController@page');
// });


Route::get('/link', function () {
   Artisan::call('storage:link');
});
