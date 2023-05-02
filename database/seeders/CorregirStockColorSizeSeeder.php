<?php

namespace Database\Seeders;

use App\Models\ColorSize;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorregirStockColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $color_sizes = ColorSize::all();

        foreach ($color_sizes as $color_size) {
            # code...
            $stock_real = $color_size->stocks()->count();

            $color_size->quantity = $stock_real;

            $color_size->save();

        }

        $products = Product::all();
       
        foreach ($products as $product) {
            # code...
            $total_color = 0;

            foreach ($product->colors as $color) {
                # code...
                $total_size = 0;

                foreach ($color->sizes as $size) {
                    # code...
                    $color_size = ColorSize::where('color_id',$color->id)->where('size_id',$size->id)->first();
                    $size->quantity = $color_size->quantity;
                    $total_size = $total_size + $color_size->quantity;
                    $size->save();
                }

                $color->quantity = $total_size;
                $color->save();

                $total_color = $total_color + $total_size;
            }


            $product->quantity = $total_color;

            $product->save();
        }
 
    }
}
