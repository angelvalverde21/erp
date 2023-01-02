<?php

namespace Database\Seeders;

use App\Models\RoleStoreUser;
use Illuminate\Database\Seeder;

use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->faker = Faker::create();

        User::create([
            'id'=>'1',
            'name' => 'ANGEL VALVERDE A.',
            'email' => 'angelvalverde21@gmail.com',
            'phone' => '943402809',
            'dni'=> '42412498',
            'password' => bcrypt('12345678'),

        ])->syncRoles(['admin','seller','buyer']);

        User::create([
            'id'=>'2',
            'name' => 'Juan Perez',
            'email' => 'juanperez21@gmail.com',
            'phone' => '995829199',
            'dni'=> '12345678',
            'password' => bcrypt('12345678'),

        ])->syncRoles(['buyer','repartidor']);

        User::create([
            'id'=>'3',
            'name' => 'Magaly Hinostroza',
            'email' => 'magaly_fake_123@gmail.com',
            'phone' => '945101774',
            'dni'=> '45631639',
            'password' => bcrypt('12345678')

        ])->syncRoles(['repartidor', 'fotografo','buyer']);

        User::create([
            'id'=>'4',
            'name' => 'Annie Fernandez',
            'email' => 'annie_fake_123@gmail.com',
            'phone' => '969855663',
            'dni'=> '32345678',
            'password' => bcrypt('12345678')

        ])->syncRoles(['modelo','buyer']);

        User::create([
            'id'=>'5',
            'name' => 'Marina Roy',
            'email' => 'marina_fake_123@gmail.com',
            'phone' => '951753123',
            'dni'=> '42345678',
            'password' => bcrypt('12345678')

            ])->syncRoles(['modelo','buyer']);

        User::create([
            'id'=>'6',
            'name' => 'Victoria Hinostroza',
            'email' => 'victoria_fake_123@gmail.com',
            'phone' => '963852741',
            'dni'=> '52345678',
            'password' => bcrypt('12345678')

            ])->syncRoles(['repartidor','modelo','buyer']);

        User::create([
            'id'=>'7',
            'name' => 'Lina Valverde Ayamamani',
            'email' => 'lina_fake_123@gmail.com',
            'phone' => '991495052',
            'dni'=> '40181896',
            'store_id' => '10',
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'buyer']);

        User::create([
            'id'=>'8',
            'name' => 'OLVA COURIER SAC',
            'email' => 'olva@olvacontactcenter.com.pe',
            'phone' => '7140909',
            'ruc'=> '20100686814',
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'carrier']);

        User::create([
            'id'=>'9',
            'name' => 'Shalom Express SAC',
            'email' => 'atencionalcliente@shalom.com.pe',
            'phone' => '5007878',
            'ruc'=> '20378157138',
            'password' => bcrypt('12345678')

        ])->syncRoles(['name' => 'carrier']);

        User::create([
            'id'=>'10',
            'name' => 'Aquarella Ropa y Accesorios',
            'nickname' => 'ara',
            'email' => 'ventas@ara.pe',
            'phone' => '016763164',
            'ruc'=> '00000000000',
            'logo' => 'stores/logos/' . $this->faker->image('public/storage/stores/logos',300,300, null, false),
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
            'id'=>'11',
            'name' => 'Vali',
            'nickname' => 'vali',
            'email' => 'ventas@vali.pe',
            'phone' => '014684380',
            'ruc'=> '00000000200',
            'logo' => 'stores/logos/' . $this->faker->image('public/storage/stores/logos',300,300, null, false),
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
            'id'=>'12',
            'name' => 'Internet',
            'nickname' => 'internet',
            'email' => 'internet@ara.pe',
            'phone' => '222222',
            'ruc'=> '11111111111111',
            'logo' => 'stores/logos/' . $this->faker->image('public/storage/stores/logos',300,300, null, false),
            'password' => bcrypt('6yhjentrksmlfdavn9565156fsdfsd')

        ])->syncRoles(['name' => 'internet']);
    }
}
