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
    public function images($nickname, Product $product, Request $request)
    {


        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = Storage::put('products', $request->file('file'));

        Log::info('inicio de imagen');
        
        Log::info($url);
        
        Log::info('fin de imagen');
        

        $product->images()->create([
            'name' => $url
        ]);

        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    public function editimage($nickname, Image $image, Request $request){
        
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $image->name = Storage::put('products', $request->file('file'));

        $image->save();

        Log::debug($image);
        Log::debug($request);
    }

    public function editColor($nickname, Color $color, Request $request){
        
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $color->image = Storage::put('colors', $request->file('file'));

        $color->save();
        
        Log::debug($color);
        Log::debug($request);
    }

    public function colors($nickname, Product $product, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = Storage::put('colors', $request->file('file'));

        //Crea el stock en caso no haya tallas
        $color = $product->colors()->create(
            [
                'image' => $url,
                'name' => $nickname,
                'quantity' => '1'
            ]
        );

        $sizes = Size::where('product_id',$color->product_id)->get();

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
    }

}