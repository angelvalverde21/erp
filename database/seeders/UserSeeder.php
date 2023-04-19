<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\RoleStoreUser;
use Illuminate\Database\Seeder;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('categories')->delete();
        $json = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_usuarios.json");

        $old_users = json_decode($json);

        foreach ($old_users as $old_user) {

            Log::info("\n");

            if ($old_user->IDUSUARIO == 232) {

                User::create([
                    'id' => '232',
                    'name' => 'ANGEL VALVERDE A.',
                    'email' => 'angelvalverde21@gmail.com',
                    'phone' => '943402809',
                    'dni' => '42412498',
                    'password' => bcrypt('12345678'),

                ])->syncRoles(['admin', 'seller', 'buyer']);

            } else {

                if (($old_user->CELULAR == "" || $old_user->CELULAR == null ) && ($old_user->EMAIL <> "" && $old_user->DNI > 0)) {
                    # code...
                    $new_user = User::Where('email',$old_user->EMAIL)->orWhere('dni',$old_user->DNI);

                    Log::info(1);

                } elseif (($old_user->EMAIL == "" || $old_user->EMAIL == null ) && ($old_user->CELULAR > 0 && $old_user->DNI > 0)) {
                    # code...
                    $new_user = User::where('phone',$old_user->CELULAR)->orWhere('dni',$old_user->DNI);

                    Log::info(2);

                } elseif (($old_user->DNI == "" || $old_user->DNI == null ) && ($old_user->EMAIL <> "") && ($old_user->CELULAR > 0)) {
                    # code...
                    $new_user = User::where('phone',$old_user->CELULAR)->orWhere('email',$old_user->EMAIL);
                    Log::info(3);

                } elseif ((($old_user->CELULAR == "" || $old_user->CELULAR == null ) && ($old_user->EMAIL == "" || $old_user->EMAIL == null )) && ($old_user->DNI > 0)) {
                    # code...
                    $new_user = User::Where('dni',$old_user->DNI);

                    Log::info(4);
                } elseif ((($old_user->CELULAR == "" || $old_user->CELULAR == null ) && ($old_user->DNI == "" || $old_user->DNI == null )) && ($old_user->EMAIL <> "")) {

                    # code...
                    $new_user = User::Where('email',$old_user->EMAIL);

                    Log::info(5);

                } elseif ((($old_user->DNI == "" || $old_user->DNI == null ) && ($old_user->EMAIL == "" || $old_user->EMAIL == null )) && ($old_user->CELULAR > 0)) {

                    # code...
                    $new_user = User::where('phone',$old_user->CELULAR);

                    Log::info(6);
                }else{

                    $new_user = User::where('phone',$old_user->CELULAR)->orWhere('email',$old_user->EMAIL)->orWhere('dni',$old_user->DNI);

                    Log::info(7);
                }
                

                // $new_user = User::where('phone',$old_user->CELULAR)->orWhere('email',$old_user->EMAIL)->orWhere('dni',$old_user->DNI);

                if($new_user->count()>0){

                    //no se inserta el registro porque es repetitivo
                    Log::info('este user esta repetido');
                    Log::info('celular: '.$old_user->CELULAR);
                    Log::info('celular: '.$old_user->DNI);
                    Log::info('celular: '.$old_user->EMAIL);

                }else{
                    

                    Log::info('Empezando a insertar el IDUSUARIO: '.$old_user->IDUSUARIO);

                    User::create([

                        'id' => $old_user->IDUSUARIO,
                        'name' => $old_user->NOMBRE,
                        'email' => corregirEmail($old_user->EMAIL),
                        'phone' => corregirPhone($old_user->CELULAR),
                        'dni' => corregirDni($old_user->DNI),
                        'store_id' => '10',
                        'password' => bcrypt(substr(trim($old_user->NOMBRE), 0, 1) . $old_user->IDUSUARIO),
                        'owner_id' => '232'
    
                    ])->syncRoles(['name' => 'buyer']);

                    Log::info('Se ha insertado el registro IDUSUARIO '.$old_user->IDUSUARIO);

                    //Creando las direcciones de envio
                    //fin de crear direcciones de envio

                }

            }
        }


        $this->faker = Faker::create();

        // User::create([
        //     'id' => '3',
        //     'name' => 'Magaly Hinostroza',
        //     'email' => 'magaly_fake_123@gmail.com',
        //     'phone' => '945101774',
        //     'dni' => '45631639',
        //     'password' => bcrypt('12345678')

        // ])->syncRoles(['repartidor', 'fotografo', 'buyer']);

        User::create([
            'id' => '4',
            'name' => 'Annie Fernandez',
            'email' => 'annie_fake_123@gmail.com',
            'phone' => '969855663',
            'dni' => '32345678',
            'password' => bcrypt('12345678')

        ])->syncRoles(['modelo', 'buyer']);

        User::create([
            'id' => '5',
            'name' => 'Marina Roy',
            'email' => 'marina_fake_123@gmail.com',
            'phone' => '951753123',
            'dni' => '42345678',
            'password' => bcrypt('12345678')

        ])->syncRoles(['modelo', 'buyer']);

        User::create([
            'id' => '6',
            'name' => 'Victoria Hinostroza',
            'email' => 'victoria_fake_123@gmail.com',
            'phone' => '963852741',
            'dni' => '52345678',
            'password' => bcrypt('12345678')

        ])->syncRoles(['repartidor', 'modelo', 'buyer']);

        User::create([
            'id' => '7',
            'name' => 'Lina Valverde Ayamamani',
            'email' => 'lina_fake_123@gmail.com',
            'phone' => '991495052',
            'dni' => '40181896',
            'store_id' => '10',
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'buyer']);

        User::create([
            'id' => '8',
            'name' => 'OLVA COURIER SAC',
            'email' => 'olva@olvacontactcenter.com.pe',
            'phone' => '7140909',
            'ruc' => '20100686814',
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'carrier']);

        User::create([
            'id' => '9',
            'name' => 'Shalom Express SAC',
            'email' => 'atencionalcliente@shalom.com.pe',
            'phone' => '5007878',
            'ruc' => '20378157138',
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'carrier']);

        User::create([
            'id' => '10',
            'name' => 'Aquarella Ropa y Accesorios',
            'nickname' => 'ara',
            'email' => 'ventas@ara.pe',
            'phone' => '016763164',
            'ruc' => '00000000000',
            'logo' => 'stores/logos/' . $this->faker->image('public/storage/stores/logos', 300, 300, null, false),
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'store']);

        RoleStoreUser::create(
            [
                'user_id' => '1',
                'role_id' => '12',
                'store_id' => '10'
            ]
        );

        //

        User::create([
            'id' => '11',
            'name' => 'Vali',
            'nickname' => 'vali',
            'email' => 'ventas@vali.pe',
            'phone' => '014684380',
            'ruc' => '00000000200',
            'logo' => 'stores/logos/' . $this->faker->image('public/storage/stores/logos', 300, 300, null, false),
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'store']);

        RoleStoreUser::create(
            [
                'user_id' => '1',
                'role_id' => '13',
                'store_id' => '11'
            ]
        );

        User::create([
            'id' => '12',
            'name' => 'Internet',
            'nickname' => 'internet',
            'email' => 'internet@ara.pe',
            'phone' => '222222',
            'ruc' => '11111111111111',
            'logo' => 'stores/logos/' . $this->faker->image('public/storage/stores/logos', 300, 300, null, false),
            'password' => bcrypt('6yhjentrksmlfdavn9565156fsdfsd')

        ])->syncRoles(['name' => 'internet']);


        User::create([
            'id' => '13',
            'name' => 'Juan Perez',
            'email' => 'juanperez21@gmail.com',
            'phone' => '995829199',
            'dni' => '12345678',
            'password' => bcrypt('12345678'),

        ])->syncRoles(['buyer', 'repartidor']);

    }
}
