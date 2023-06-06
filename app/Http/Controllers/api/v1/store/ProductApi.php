<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Storage;

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
        $store = User::where('nickname', $nickname)->first();
        // $store = User::where('nickname', $nickname)->first;
        return $store->products()->where('status', '1')->where('quantity', '>', 0)->get();
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
    public function showStockColorSizeId($nickname, $id)
    {
        //

        if (is_numeric($id)) {

            $colorSize = ColorSize::findOrFail($id);
            return response()->json(['status' => '200', 'stock' => $colorSize->quantity]);

        } else {

            //si el usuario manda el formato "color-id" entonces eso no es numerico y lo analizamos aqui

            //primero hacemos un explode y buscamos el id del color
            $colorSize = explode("-", $id);

            //escogemos el id y lo asociamos a una nueva variable $new_id
            $new_id = $colorSize[1];

            //buscamos el codigo del color en la base de datos
            $color = Color::findOrFail($new_id);

            $stock = 0;

            //finalmente recorremos las tallas reales y lo sumamos para brindar un solo stock
            foreach ($color->sizes as $size) {
                $stock = $stock + $size->pivot->quantity;
            }

            return response()->json(['status' => '200', 'stock' => $stock]);
        }

        // Log::info($colorSize);
    }

    public function store(Request $request)
    {
        //
    }


    // public function show($nickname, $id)
    // {
    //     // Log::info($id);

    //     //si la url es numerica ------(CASO: 1)
    //     if (is_numeric($id)) {

    //         $product = Product::where('id', $id)->with('images')->with('prices')->with('colors.sizes')->first();

    //         if ($product) {
    //             return $product;
    //         } else {
    //             return response()->json(['error' => '404', 'message' => 'Pagina no encontradara']);
    //         }

    //     } else {

    //         $product = Product::where('short_link', $id)->with('images')->with('prices')->with('colors.sizes')->first();

    //         //si la url es un short_link ------(CASO: 2)
    //         if ($product) {
    //             return $product;
    //         } else {

    //             $product = Product::where('slug', $id)->with('images')->with('prices')->with('colors.sizes')->first();

    //             //si la url es un slug ------(CASO: 3)
    //             if ($product) {
    //                 return $product;
    //             } else {
    //                 // return response()->json(['error' => '404', 'message' => 'Pagina no encontradara'],404);
    //                 return response()->json(['error' => '404', 'message' => 'Pagina no encontradara']);
    //             }
    //             //
    //         }
    //     }
    // }

    public function show($nickname, $id)
    {

        //OJO SI EL NUMERO TIENE LA FORMA xxxeyyyy php podria pensar que es un numero xxx elevado a la yyyy
        if (is_numeric($id)) {

            $product = Product::where('id', $id)->with('images')->with('prices')->with('colors.sizes')->first();
            Log::info('es id');
        } else {

            //si la url es un short_link ------(CASO: 2)
            $product = Product::where('short_link', $id)->with('images')->with('prices')->with('colors.sizes')->first();

            Log::info('es short link');
            Log::info($product);

            //comprobamos si el producto existe
            if ($product) {

                // $colorsArray = $product->colors->toArray();
                // $colorsArray = array_map(function ($colorArray) {
                //     $colorArray['image'] =  asset(Storage::url($colorArray[]));
                //     return $productArray;
                // }, $colorsArray);

                // return $product;

            } else {

                // return $store;
                //si la url es un slug ------(CASO: 3)
                //Importante cuando se usa select se tiene que colocar los id o llaves de la tabla sino no funciona
                // $user = Auth::user();

                //si esta autenticado

                Log::info('es slug');

                if (Auth::guard('api')->check()) { //se usa esto para comprobar si el usuario esta siempre logeado, ya que hemos programado a angular con un interceptor 
                // para que cada ves que user HttpCliente se envie el AuthToken bearer

                    $product = Product::where('slug', $id)
                        ->select(
                            [
                                'id',
                                'name',
                                'owner_id',
                                'store_id',
                                'category_id',
                                'name',
                                'title',
                                'description',
                                'price',
                                'price_seller'
                            ]
                        )
                        
                        ->with('images')
                        ->with('colors.sizes')
                        ->first();


                        $product->price = $product->price_seller;
                        $product->price_seller = 0.00;

                } else {

                    $product = Product::where('slug', $id)
                        ->select(
                            [
                                'id',
                                'name',
                                'owner_id',
                                'store_id',
                                'category_id',
                                'name',
                                'title',
                                'description',
                                'quantity',
                                'price'
                            ]
                        )
                        ->with('images')->with('prices')
                        ->with('colors.sizes')
                        ->first();
                }
            }
        }

        // $product = $product->toArray();

        //vamos a modificar las tallas originales y cambiarlas por un "ESTANDAR"

        //VENDER UNA SOLA TALLA Y SOBREVENDER EL STOCK
        if ($product['force_size_unique'] && $product['over_sale']) {
            # code...
            $colors = array_map(function ($color) {

                $color["sizes"] = [
                    [
                        "id" => $color['id'],
                        "name" => "ESTANDAR",
                        "product_id" => 7,
                        "quantity" => 100,
                        "pivot" => [
                            "id" => "color-" . $color['id'],
                            "color_id" => $color['id'],
                            "quantity" => 100
                        ],
                    ]

                ];

                return $color;
            }, $product->colors->toArray());
        }

        //VENDER UNA SOLA TALLA PERO CON EL STOCK REAL

        if ($product['force_size_unique'] && !$product['over_sale']) {

            $colors = array_map(function ($color) {

                $color["sizes"] = [
                    [
                        "id" => $color['id'],
                        "name" => "ESTANDAR",
                        "product_id" => 7,
                        "quantity" => 1,
                        "pivot" => [
                            "id" => "color-" . $color['id'],
                            "color_id" => $color['id'],
                            "quantity" => 1
                        ],
                    ]

                ];

                return $color;
            }, $product->colors->toArray());
        }


        //SOBRE VENDER PERO CON LAS TALLAS ORIGINALES

        if ($product['over_sale'] && !$product['force_size_unique']) {

            //SOBREVENDER Y EN UNA SOLA TALLA
            $colors = array_map(function ($color) {

                $sizes = array_map(function ($size) {

                    $size["quantity"] = 50;

                    return $size;
                }, $color["sizes"]);

                Log::info($sizes);

                $color["sizes"] = $sizes;

                return $color;
            }, $product->colors->toArray());
        }

        if ($product['over_sale'] || $product['force_size_unique']) {
            $product = $product->toArray();
            $product["colors"] = $colors;
        }



        if ($product) {
            return $product;
        } else {
            return response()->json(['error' => '404', 'message' => 'Pagina no encontradara']);
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
