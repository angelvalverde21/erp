<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Manage\Print\Order\PdfController;
use App\Http\Controllers\Manage\ProductController;
use App\Http\Controllers\Manage\Upload\OrderController;
use App\Http\Controllers\Manage\Upload\UploadAlbumController;
use App\Http\Controllers\Manage\Upload\UserImageController;
use App\Http\Controllers\PdfProductController;
use App\Http\Livewire\Components\Users\EditUser;
use App\Http\Livewire\Manage\Couriers\ShowCouriers;
use App\Http\Livewire\Manage\Customers\CreateCustomer;
use App\Http\Livewire\Manage\Customers\EditCustomer;
use App\Http\Livewire\Manage\Customers\ShowCustomers;
use App\Http\Livewire\Manage\Customers\ShowOrdersCustomers;
use App\Http\Livewire\Manage\Dashboard;
use App\Http\Livewire\Manage\ImportData;
use App\Http\Livewire\Manage\Options\ShowOptions;
use App\Http\Livewire\Manage\Orders\EditOrder;
use App\Http\Livewire\Manage\Orders\ShowOrders;
use App\Http\Livewire\Manage\Orders\ShowOrdersDate;
use App\Http\Livewire\Manage\Orders\ShowOrdersPending;
use App\Http\Livewire\Manage\Orders\ShowOrdersToday;
use App\Http\Livewire\Manage\Productions\CreateProduction;
use App\Http\Livewire\Manage\Productions\EditProduction;
use App\Http\Livewire\Manage\Productions\ShowProductions;
use App\Http\Livewire\Manage\Products\CreateProduct;
use App\Http\Livewire\Manage\Products\EditProduct;
use App\Http\Livewire\Manage\Products\EditProduct\Albums\EditAlbum;
use App\Http\Livewire\Manage\Products\EditProduct\Colors\Albums\CreateAlbumColor;
use App\Http\Livewire\Manage\Products\EditProduct\Colors\Albums\EditAlbumColor;
use App\Http\Livewire\Manage\Products\EditProduct\Colors\Albums\ShowAllAlbumColor;
use App\Http\Livewire\Manage\Products\EditProduct\CreateAlbum;
use App\Http\Livewire\Manage\Products\ShowProducts;
use App\Http\Livewire\Manage\Profile\ShoProfileWeb;
use App\Http\Livewire\Manage\Profile\ShowProfileStore;
use App\Http\Livewire\Manage\Profile\ShowProfileWeb;
use App\Http\Livewire\Manage\Staff\ShowStaff;
use App\Http\Livewire\ShowAlbumsColor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::name('manage.')->middleware('StoreExist')->group(function () {
 
   // Route::get('/', Dashboard::class)->name('dashboard');
   Route::get('/', ShowOrdersToday::class)->name('dashboard');

   //Redireccion desde el Dashboard
   // Route::get('/', function () {
   //    return redirect()->route('manage.orders.today');
   // });

   //IMPORT DATA
   Route::get('/import', ImportData::class)->name('import');
   //PRODUCTS
   Route::get('/products', ShowProducts::class)->name('products');
   Route::get('/products/{product}/edit', EditProduct::class)->name('products.edit');
   Route::get('/products/create', CreateProduct::class)->name('products.create');

   //Albums
   Route::get('/products/{product}/albums/create', CreateAlbum::class)->name('albums.create');
   Route::get('products/{product}/albums/{album}/edit', EditAlbum::class)->name('products.albums.edit');
   Route::post('/albums/upload/{album}/{location}', [UploadAlbumController::class, 'uploadAlbum'])->name('albums.upload');

   //Albums (GET)
   Route::get('/products/{product}/color/{color}/albums', ShowAllAlbumColor::class)->name('products.color.albums');
   Route::get('/products/{product}/color/{color}/albums/create', CreateAlbumColor::class)->name('products.color.albums.create');
   Route::get('/products/{product}/color/{color}/albums/{album}', EditAlbumColor::class)->name('products.color.albums.edit');

   //ORDERS
   Route::get('/orders', ShowOrders::class)->name('orders');
   Route::get('/orders/today', ShowOrdersToday::class)->name('orders.today');
   Route::get('/orders/pending', ShowOrdersPending::class)->name('orders.pending');
   Route::get('/orders/date/{date}', ShowOrdersDate::class)->name('orders.date');
   Route::get('/orders/{order}/edit', EditOrder::class)->name('orders.edit');

   //PROFILE
   // Route::get('/user', ShowProfileUser::class)->name('user');
   // Route::get('/stores', ShowProfileStore::class)->name('stores');
   // Route::get('/stores/create', CreateStore::class)->name('stores.create');
   Route::get('/profile', ShowProfileStore::class)->name('profile');
   Route::get('/profile/web', ShowProfileWeb::class)->name('web');

   //POST Products
   Route::post('/products/colors/upload/{color}/variantes', [ProductController::class, 'uploadVariantsColor'])->name('products.upload.colors.variants');
   Route::post('/products/{product}/upload/colors', [ProductController::class, 'uploadColors'])->name('products.upload.colors');
   Route::post('/products/{product}/upload/images', [ProductController::class, 'uploadImages'])->name('products.upload.images');
   //GET Products
   Route::get('/products/{product}/download/stock', [ProductController::class, 'downLoadStock'])->name('products.download.stock');
   Route::get('/products/{product}/download/zip', [ProductController::class, 'downLoadZipProduct'])->name('products.download.zip');
   Route::get('/products/print/deals', [DownloadController::class, 'printDeals'])->name('products.print.deals');

   //photos

   Route::get('/download/photo/{photo_id}', [ProductController::class, 'descargarImagen'])->name('download.photo');

   // http://erp.test/ara/manage/products/6/colors
   // http://erp.test/user/profile/10/upload_logo_general
   // Route::post('/products/{product}/images', function(){
   //    Log::info("llego al route.php");
   // })->name('products.images');

   Route::post('/products/edit/image/{image}', [ProductController::class, 'editImage'])->name('products.editimage');
   //OJO NO PASAMOS LA VARIABLE PRODUCT_ID PORQUE LOS COLORES SON UNICOS
   Route::post('/products/edit/color/{color}', [ProductController::class, 'editColor'])->name('products.editcolor');


   //GET customers
   Route::get('/customers', ShowCustomers::class)->name('customers');
   Route::get('/customers/create', CreateCustomer::class)->name('customers.create');
   Route::get('/customers/{customer}/edit', EditCustomer::class)->name('customers.edit');
   Route::get('/customers/{customer}/orders', ShowOrdersCustomers::class)->name('customers.orders');
   
   
   //GET staff

   Route::get('/users/{user}/edit', EditUser::class)->name('users.edit');


   Route::get('/staff', ShowStaff::class)->name('staff');
   Route::get('/couriers', ShowCouriers::class)->name('couriers');



   //GET Producciones

   Route::get('/productions', ShowProductions::class)->name('productions');
   Route::get('/productions/create', CreateProduction::class)->name('productions.create');
   Route::get('/productions/{production}', EditProduction::class)->name('productions.edit');
   
   //GET Options
   Route::get('/options', ShowOptions::class)->name('options');
   Route::post('/options/upload', [UserImageController::class, 'uploadImageOption'])->name('option.upload');

   //GET Imprimir PDF
   Route::get('/orders/{order}/print/voucher', [PdfController::class, 'generateVaucher'])->name('orders.print.voucher');
   Route::get('/orders/{order}/print/packing-label', [PdfController::class, 'generatePackingLabel'])->name('orders.print.packing-label');
   Route::get('/orders/{order}/print/invoice', [PdfController::class, 'generateInvoice'])->name('orders.print.invoice');

   //POST orders (comprobantes)
   // Route::post('/orders/{order}/photo-payment', [OrderController::class, 'photoPayment'])->name('orders.photo-payment');
   // Route::post('/orders/{order}/photo-package', [OrderController::class, 'photoPackage'])->name('orders.photo-package');
   // Route::post('/orders/{order}/photo-delivery', [OrderController::class, 'photoDelivery'])->name('orders.photo-delivery');
   Route::post('/orders/{order}/{field}', [OrderController::class, 'uploadFileOrder'])->name('orders.upload');
   Route::post('/orders/{order}/upload/invoice', [OrderController::class, 'uploadFileOrderInvoice'])->name('orders.upload.invoice');
   Route::post('/orders/{order}/upload/comprobantes/empaque', [OrderController::class, 'comprobantesEmpaque'])->name('orders.upload.comprobantes.empaque');
   Route::post('/orders/{order}/upload/comprobantes/envio', [OrderController::class, 'comprobantesEnvio'])->name('orders.upload.comprobantes.envio');

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
