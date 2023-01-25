<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\ColorSize;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nickname)
    {
        //
        //pones firt porque primero devuelve la informacion del usuario, que por el momento no lo necesitamos
        $store = User::where('nickname', $nickname)->with('products')->first();
        return $store->products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showStockColorSizeId($nickname, ColorSize $colorSize)
    {
        //
        Log::info($colorSize);
       
        return response()->json(['status' => '200', 'stock' => $colorSize->quantity]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nickname, $id)
    {
        Log::info($id);
        if(is_numeric($id)){
            $product = Product::where('id', $id)->with('images')->with('colors.sizes')->first();

            if ($product) {
                return $product;
            } else {
                return response()->json(['error' => '404', 'message' => 'Pagina no encontradara']);
            }
            
        }else{
            $product = Product::where('short_link', $id)->with('images')->with('colors.sizes')->first();

            if ($product) {
                return $product;
            } else {
                
                $product = Product::where('slug', $id)->with('images')->with('colors.sizes')->first();

                if($product){
                    return $product;
                }else{
                    // return response()->json(['error' => '404', 'message' => 'Pagina no encontradara'],404);
                    return response()->json(['error' => '404', 'message' => 'Pagina no encontradara']);
                }
                //
            }
            
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
