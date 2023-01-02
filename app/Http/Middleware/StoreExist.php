<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class StoreExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Log::debug('inicio');
        // Log::info(Route::current()->parameter('nickname'));
        // Log::debug('final');

        $nickname = Route::current()->parameter('nickname');

        if($nickname != ""){
            $store = User::where('nickname',$nickname);

            if($store->exists()){
    
                $shopData = $store->first();
    
                //Agregando la variable 'store' a la variable $request que estara disponible en los clases de livewire
                $request->attributes->add(['store'=>$shopData]);
    
                if(Route::current()->parameter('product')){
                    $product = Product::find(Route::current()->parameter('product'));
                    log::info($product);
                    $request->attributes->add(['product'=>$product]);
                }
    
                
                return $next($request);
    
            }else{
                return redirect('pagina-no-econtrada');
                //abort(404);
            }
        }

    }
}
