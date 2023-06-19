<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class InsertOldUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $json_old = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_usuarios.json");

        // $array_json_old = json_decode($json_old); //true convierte la matriz en una matriz asociativa

        $array_json_old = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_usuarios.json");

        # code...
        foreach ($array_json_old as $old_user) {

            Log::info("\n");

            if ($old_user->IDUSUARIO == 232 || $old_user->IDUSUARIO == 1707) {
            } else {

                try {

                    Log::info('Empezando a insertar el IDUSUARIO: ' . $old_user->IDUSUARIO);

                    User::create([

                        'id' => $old_user->IDUSUARIO,
                        'name' => $old_user->NOMBRE,
                        'email' => corregirEmail($old_user->EMAIL),
                        'phone' => corregirPhone($old_user->CELULAR),
                        'dni' => corregirDni($old_user->DNI),
                        'store_id' => '10',
                        'password' => bcrypt(substr(trim($old_user->NOMBRE), 0, 1) . $old_user->IDUSUARIO),
                        'owner_id' => User::MAIN_ID,
                        'created_at' => $old_user->FECHA,
                        'updated_at' => $old_user->ACTUALIZAR,

                    ])->syncRoles(['name' => 'buyer']);

                    Log::info('Se ha insertado el registro IDUSUARIO ' . $old_user->IDUSUARIO);

                    //Creando las direcciones de envio
                    //fin de crear direcciones de envio
                    // all good

                    // $i++;
                } catch (\Exception $e) {

                    // $f++;
                    Log::info('Ha fallado la insersion de ' . $old_user->IDUSUARIO);
                    // something went wrong
                }
            }
        }
    }
}
