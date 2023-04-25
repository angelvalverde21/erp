<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //Funcion para cargar las imagenes de los productis (ojo NO los colores)
    public function uploadImages($nickname, Product $product, Request $request)
    {


        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        // $url = Storage::put('products', $request->file('file'));
        $url = uploadImage($request,"products");
        Log::info('inicio de imagen');
        
        Log::info($url);
        
        Log::info('fin de imagen');
        

        $product->images()->create([
            'name' => $url
        ]);

        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    public function editImage($nickname, Image $image, Request $request){
        
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        // $image->name = Storage::put('products', $request->file('file'));
        $image->name = uploadImage($request,"products");

        $image->save();

        Log::debug($image);
        Log::debug($request);
    }

    public function editColor($nickname, Color $color, Request $request){
        
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $color->image = uploadImage($request,"products/colors");

        $color->save();
        
        Log::debug($color);
        Log::debug($request);
    }

    public function uploadColors($nickname, Product $product, Request $request)
    {

        Log::info('el producto recibido es: ');
        
        Log::info($product);
        

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = uploadImage($request,"products/colors");

        
        Log::info('creando los colores e imagenes');

        //Crea el color
        $color = $product->colors()->create(
            [
                'image' => $url,
                'name' => $nickname,
                'quantity' => '0'
            ]);


        //Crea la primera imagen para el color
        $color->images()->create(
            [
                'name' => $url,
                'usage' => 'color'
            ]
            );

        
        //Crea las tallas para el color creado

        $sizes = Size::where('product_id', $color->product_id)->get();

        foreach ($sizes as $size) {

            //Agregado datos a la tabla pivote
            ColorSize::create(
                [
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                    'quantity' => '0'
                ]
            );
        }

        Log::info('se creo la sizes para el color->product_id: '. $color->product_id);
    }

    //Variantes del color
    public function uploadVariantsColor($nickname, Color $color, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        // $url = Storage::put('colors', $request->file('file'));
        $url = uploadImage($request,"products/colors");
        //Crea el stock en caso no haya tallas
        $color->images()->create(
            [
                'name' => $url,
                'usage' => 'color',
            ]
        );

        // $sizes = Size::where('product_id',$color->product_id)->get();

        // foreach ($sizes as $size) {

        //     //Agregado datos a la tabla pivote
        //     ColorSize::create(
        //         [
        //             'color_id' => $color->id,
        //             'size_id' => $size->id,
        //             'quantity' => '0'
        //         ]
        //     );
        // }
    }

}