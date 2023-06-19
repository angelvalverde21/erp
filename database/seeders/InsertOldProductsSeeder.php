<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InsertOldProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // $json_data = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_productos.json");

        // $products_json = json_decode($json_data); //true convierte al json en una matriz asociativa, esto quiere decir que los keys son string y estan asociados a su valor

        $products_json = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_productos.json");
        // Log::info(count($products_json));

        $i=0;
        $f=0;


        foreach ($products_json as $product_old) {

            Log::info('Se esta empezando la insersion de IDPRODUCTO: '.$product_old->IDPRODUCTO);

            try {

                Product::create(

                    [
                        'id' => $product_old->IDPRODUCTO,
                        'title' => $product_old->TITULO,
                        'name' => $product_old->TITULO,
                        'quantity' => 27,
                        'short_link' => substr(md5(bcrypt(Str::slug($product_old->TITULO))),0,5),
                        'slug' => Str::slug($product_old->TITULO),
                        'description' => $product_old->DESCRIPCION,
                        'price' => corregirPrecio($product_old->PRECIO_NORMAL),
                        'status' => Product::PUBLICADO,
                        'store_id' => 10,
                        'owner_id' => User::MAIN_ID,
                        'category_id' => '2',
                        'excerpt' => $product_old->EXCERPT,
                        'created_at' => $product_old->FECHA,
                        'updated_at' => $product_old->ACTUALIZAR
                    ]

                );

                Log::info('Se ha insertado correctamente IDPRODUCTO: '.$product_old->IDPRODUCTO);

                //Creando las direcciones de envio
                //fin de crear direcciones de envio
                // all good

                $i++;

            } catch (\Exception $e) {

                $f++;
                Log::info('Ha fallado la insersion del producto:  '.$product_old->IDPRODUCTO);
                // something went wrong
                //Log::info($e);
            }

        }

        Log::info('Se insertaron correctamente (product) ' .$i. ' registros');
        Log::info('fallaron en la insercion (product) ' .$f. ' registros');
    }
}
