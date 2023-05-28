<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\store\OrderController;
use App\Http\Controllers\api\v1\store\PayController;
use App\Http\Controllers\api\v1\store\ProductApi;
use App\Http\Controllers\api\v1\store\ProductColorApi;
use App\Http\Controllers\api\v1\store\RegisterController;
use App\Http\Controllers\api\v1\store\StoreApi;
use App\Http\Controllers\api\v1\store\StoreOfficeApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/', function(){
//     return 'prueba';
// });
//Route::middleware('StoreExist')->get('/products', [ProductsApi::class, 'index']);

//url de la pagina de inicial 

Route::get('/', [StoreApi::class, 'show'])->middleware('RegisterVisit');
Route::post('/buscar/distritos', [StoreApi::class, 'buscarDistritos']);

// info del producto o catalogo

Route::get('/products', [ProductApi::class, 'index'])->middleware('RegisterVisit');
Route::get('/products/{id}', [ProductApi::class, 'show'])->middleware('RegisterVisit');
Route::get('/products/{id}/colors', [ProductColorApi::class, 'index']);
Route::get('/products/color/size/stock/{colorSize}', [ProductApi::class, 'showStockColorSizeId']);

//info store

Route::get('/carousel', [StoreApi::class, 'carousel']);
Route::get('/offices', [StoreOfficeApi::class, 'index']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/orders/create-one-step', [OrderController::class, 'createOneStep']);
Route::post('/orders/create-with-login', [OrderController::class, 'createOrderWithLogin']);
Route::post('/orders/create-order', [OrderController::class, 'createOrder']);
Route::get('/orders', [OrderController::class, 'showAll']);
Route::get('/orders/{order}', [OrderController::class, 'show']);

Route::post('/register/verify-phone', [RegisterController::class, 'verifyPhone']);
Route::post('/register/verify-dni', [RegisterController::class, 'verifyDni']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user']);

//Obtener token de pasarelas de pago

Route::post('/izipay/token', [PayController::class, 'tokenIzipay']);
Route::post('/izipay/registrarpago', [PayController::class, 'registrarPagoIzipay']);