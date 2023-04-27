<?php


use App\Http\Livewire\Account\HomeAccount;
use App\Http\Livewire\HomePublic;
use App\Http\Livewire\Web\Home;
use Illuminate\Support\Facades\Route;
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

//Route::get('/', HomeAccount::class)->middleware('auth')->name('home');
// Route::get('/', function(){
//     //Seenvia a la seccion account por defecto
//     // return redirect('/account');
//     // Route::get('/', HomeAccount::class);
//     return "hola";

// })->middleware('auth')->name('home');


Route::get('/', HomePublic::class)->middleware('auth')->name('home');

// Route::get('/', function(){
//     //Seenvia a la seccion account por defecto
//     // return redirect('/account');
    
//     return "hola";

// })->middleware('auth')->name('home');

//URL HOME

Route::get('/info', function(){
    phpinfo();
});

Route::group(['prefix' => '{nickname}'], function ($nickname) {

    Route::get('/', Home::class);
    Route::get('/wp', Home::class);
    Route::get('/contacto', Home::class);
    Route::get('/faq', Home::class);
    Route::get('/about', Home::class);
    Route::get('/item/{product_id}', Home::class);
    
});

// Route::prefix('/{nickname}')
// ->group(function($nickname) {
//     Route::get('user', function($nickname) {
//         return $nickname;
//     });
// });

// Route::group(['middleware' => 'auth', 'prefix' => '{nickname}/erp'], function () {
//     Route::get('products', function ($nickname) {
//         return $nickname;
//     });
// });

//URL 

// Route::get('/register/store', RegisterStore::class)->name('register.store');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
});

Route::get('/link', function () {
    Artisan::call('storage:link');
});