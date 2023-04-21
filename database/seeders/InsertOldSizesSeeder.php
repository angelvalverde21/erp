<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsertOldSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = Product::all();

        foreach ($products as $product) {

            Size::create(

                [
                    'name' => 'S',
                    'quantity' => 1,
                    'product_id' => $product->id
                ]

            );

            Size::create(

                [
                    'name' => 'M',
                    'quantity' => 1,
                    'product_id' => $product->id
                ]

            );

            Size::create(

                [
                    'name' => 'L',
                    'quantity' => 1,
                    'product_id' => $product->id
                ]

            );

            Size::create(

                [
                    'name' => 'XL',
                    'quantity' => 1,
                    'product_id' => $product->id
                ]

            );
        }

    }
}
