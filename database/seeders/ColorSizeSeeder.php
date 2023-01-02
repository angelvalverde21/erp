<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
use App\Models\Size;

class ColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $colores = Color::all();

        foreach ($colores as $color) {
            # code...

            $sizes = Size::where('product_id',$color->product_id)->get();

            foreach ($sizes as $size) {
                $color->sizes()->attach([
                    $size->id => [
                        'quantity' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]
                ]);
            }

        }
    }
}
