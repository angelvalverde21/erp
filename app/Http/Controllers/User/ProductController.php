<?php

namespace App\Http\Controllers\User;

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

    public function files(Product $product, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = Storage::put('public/products', $request->file('file'));

        $product->images()->create([
            'name' => $url
        ]);

        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    public function editimage(Image $image, Request $request){
        
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $image->name = Storage::put('public/products', $request->file('file'));

        $image->save();

        Log::debug($image);
        Log::debug($request);
    }

    public function editColor(Color $color, Request $request){
        
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $color->file_name = Storage::put('public/colors', $request->file('file'));

        $color->save();
        
        Log::debug($color);
        Log::debug($request);
    }

    public function colors(Product $product, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = Storage::put('public/colors', $request->file('file'));

        //Crea el stock en caso no haya tallas
        $color = $product->colors()->create(
            [
                'file_name' => $url,
                'name' => 'test',
                'quantity' => '1'
            ]
        );

        //color_sizes no existe

        // $this->product->colors->sizes()->attach([
        //     $color->id => [
        //         'quantity' => 25
        //     ]
        // ]);


        // $tallas = [
        //     [
        //         'name' => 'S',
        //         'quantity' => '12'
        //     ],
        //     [
        //         'name' => 'M',
        //         'quantity' => '21'
        //     ],

        //     [
        //         'name' => 'L',
        //         'quantity' => '34'
        //     ],
        // ];

        

        $sizes = Size::where('product_id',$color->product_id)->get();


        foreach ($sizes as $size) {

            //$size = $product->sizes()->create($talla);

            // $sizes = Size::where('product_id',$color->product_id)->get();

            // $color->sizes()

            //Agregado datos a la tabla pivote
            ColorSize::create(
                [
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                    'quantity' => '0'
                ]
            );

            // $color->sizes()->attach([
            //     $size->id => [
            //         'quantity' => 25,
            //         'created_at' => date('Y-m-d H:i:s'),
            //         'updated_at' => date('Y-m-d H:i:s')
            //     ]
            // ]);
            // $color->sizes()->attach([
            //     $color->size->id => [
            //         'quantity' => 25
            //     ] 
            // ]);

        }



        // $color->sizes()->attach([
        //     $size->id => [
        //         'quantity' => 3,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]
        // ]);


    }
}
