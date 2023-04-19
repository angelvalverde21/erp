<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AddressSeeder extends Seeder
{

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //DB::table('categories')->delete();
        // $json = File::get("database/data/addresses.json");

        $users = User::all();

        $address_json_data = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_direcciones_envio.json");

        $addresses_array = json_decode($address_json_data, true); //true convierte al json en una matriz asociativa, esto quiere decir que los keys son string y estan asociados a su valor

        Log::info(count($addresses_array));

        // $key = array_search('John Doe', array_column($addresses_array, 'IDUSUARIO'));
        // $result = $addresses_array[$key];


        foreach ($users as $user) {
            # code...

            $result = array_filter($addresses_array, function ($item) use ($user) { //use ($user) se usa para poder usar la variable externa
                return $item['IDUSUARIO'] == $user->id;
            });

            # code...
            Log::info(count($result));

            foreach ($result as $address_old) {

                Address::create(
    
                    [
                        'id' => $address_old['IDENVIO'],
                        'name' => $address_old['CONSIGNATARIO'],
                        'dni' => corregirDni($address_old['DNI']),
                        'phone' => corregirPhone($address_old['CELULAR']),
                        'primary' => $address_old['DIRECCION'],
                        'secondary' => $address_old['DIRECCION_SECUNDARIA'],
                        'references' => $address_old['REFERENCIA'],
                        'user_id' => $address_old['IDUSUARIO'],
                        'district_id' => corregirDistrict($address_old['IDDISTRITO'])
                    ]

                );
            }


        }
    }
}
