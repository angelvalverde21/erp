<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Item;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class InsertOldOrdersDetailsCompleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $items = Item::all();

        $old_items = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_ventas_detalles.json", true);
        $old_part_numbers = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_part_number.json", true);

        foreach ($items as $item) {

            Log::info('empezando a procesar el item ' . $item->id . ' de la tabla items');

            # code...
            $results = array_filter($old_items, function ($old_item) use ($item) { //use ($user) se usa para poder usar la variable externa
                return $old_item['IDDETALLE'] == $item->id;
            });

            //extrayendo el primer registro
            foreach ($results as $result) {
                # code...
                $current_old_item = $result;  //Aqui tenemos toda la informacion de una fila de la tabla ayv_ventas_detalles
                break;
            }

            $results2 = array_filter($old_part_numbers, function ($old_part_number) use ($current_old_item) { //use ($user) se usa para poder usar la variable externa
                return $old_part_number['IDPARTNUMBER'] == $current_old_item['IDPARTNUMBER'];
            });

            //extrayendo el primer registro
            foreach ($results2 as $result2) {
                # code...
                $current_part_number = $result2;  //Aqui tenemos toda la informacion de la fila con la informacion del part_number
                // {"IDPARTNUMBER":"1750","IDPRODUCTO":"1","TALLA":"ESTANDAR","IDMULTIMEDIA":"89"},
                break;
            }

            //creando el json para actualizar el item de la tabla "items"

            /***************************************** EMPEZANDO A DAR FORMA AL JSON *********************************/

            //Primero calculamos el $color_size_id

            //Para ello necesitamos el color_id y el size_id

            try {

                $color = Color::where('id', $current_part_number['IDMULTIMEDIA'])->limit(1)->first();

                Log::info('imprimiendo el color');
                Log::info($color->id);

                //Ahora necesitamos la talla

                try {

                    $size = Size::where('product_id', $current_part_number['IDPRODUCTO'])->where('name', $current_part_number['TALLA'])->limit(1)->first();

                    Log::info('imprimiendo el size');
                    Log::info($size);

                    //con estos dos datos obtenemos el color_size

                    try {

                        if (isset($color->id) && isset($size->id)) {

                            $color_size = ColorSize::where('color_id', $color->id)->where('size_id', $size->id)->limit(1)->first();

                            $images = $color->images()->get();

                            foreach ($images as $image) {
                                # code...
                                if($image->name <> ""){
                                    $thumb = $image->name;
                                    break;
                                }else{
                                    $thumb = "xx";
                                }
                            }

                            $content = [
                                'color_size_id' => $color_size->id,
                                'talla' =>  $current_old_item['TALLA_VIRTUAL'], //Es la talla que se envia al cliente
                                'talla_original' =>  $current_part_number['TALLA'], //es la talla real despachada
                                'talla_impresa' =>  $current_old_item['TALLA_VIRTUAL'],
                                'color_id' =>  $current_part_number['IDMULTIMEDIA'],
                                'image' => $thumb,
                                'price' => $current_old_item['PRECIO_PROMO'],
                                'product_id'  => $current_part_number['IDPRODUCTO'],
                                'description' => $item->DESCRIPCION,
                            ];
                            
                            $item->content = $content;

                            $item->save();

                            Log::info($content);

                        }
                    } catch (\Exception $e) {

                        Log::info($e);
                    }
                } catch (\Exception $e) {

                    Log::info($e);
                }
            } catch (\Exception $e) {

                Log::info($e);
            }
        }
    }
}
