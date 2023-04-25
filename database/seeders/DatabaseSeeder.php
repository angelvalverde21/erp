<?php

namespace Database\Seeders;

use App\Models\CollectMethod;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    function run()
    {
        //App::setLocale("en");

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory(10)->create();
        Storage::deleteDirectory('users');
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('subcategories');
        Storage::deleteDirectory('products');
        Storage::deleteDirectory('photografies');
        Storage::deleteDirectory('colors');
        Storage::deleteDirectory('orders');
        Storage::deleteDirectory('stores');

        Storage::makeDirectory('users');
        Storage::makeDirectory('categories');
        Storage::makeDirectory('subcategories');

        Storage::makeDirectory('products');
        Storage::makeDirectory('products/images');
        Storage::makeDirectory('products/colors');
        Storage::makeDirectory('products/medidas');

        Storage::makeDirectory('orders');
        Storage::makeDirectory('orders/comprobantes');
        Storage::makeDirectory('orders/comprobantes/envio');
        Storage::makeDirectory('orders/comprobantes/pago');
        Storage::makeDirectory('orders/comprobantes/empaque');

        Storage::makeDirectory('photografies');
        Storage::makeDirectory('colors');
        Storage::makeDirectory('orders');
        Storage::makeDirectory('stores/carousel');
        Storage::makeDirectory('stores/logos');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);

        $this->call(SubcategorySeeder::class);

        // $this->call(ProductSeeder::class);
        // $this->call(InsertOldProductsSeeder::class);

        // $this->call(ColorSeeder::class);
        // $this->call(InsertOldColorsSeeder::class);

        // $this->call(SizeSeeder::class);
        // $this->call(InsertOldSizesSeeder::class);

        // $this->call(ColorSizeSeeder::class);

        $this->call(DepartmentSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictSeeder::class);

        $this->call(AddressSeeder::class); //se debe sembrar las nuevas direcciones de prueba
        // php artisan db:seed --class=InsertOldAddresesSeeder
        // php artisan db:seed --class=AddressSeeder

        $this->call(PaymentMethodSeeder::class);
        $this->call(DeliveryMethodSeeder::class);
        $this->call(PaymentListSeeder::class);
        $this->call(PaymentListMethodSeeder::class);
        $this->call(CollectMethodSeeder::class);
        // $this->call(OrderSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(PaymentStatusSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ProfileStoreSeeder::class);

        // // php artisan db:seed --class=InsertOldUsersSeeder
        // $this->call(InsertOldUsersSeeder::class);

        // // php artisan db:seed --class=InsertOldAddresesSeeder
        // $this->call(InsertOldAddresesSeeder::class);

        // // php artisan db:seed --class=InsertOldProductsSeeder
        // $this->call(InsertOldProductsSeeder::class);

        // // php artisan db:seed --class=InsertOldColorsSeeder
        // $this->call(InsertOldColorsSeeder::class);

        // php artisan db:seed --class=InsertOldProductsSeeder

        // php artisan db:seed --class=InsertOldSizesSeeder
        // $this->call(InsertOldSizesSeeder::class);

        // Seeder Old

        //ayv_usuarios => users

        // php artisan db:seed --class=InsertOldUsersSeeder
        $this->call(InsertOldUsersSeeder::class);

        //ayv_direcciones_envio => addresses

        // php artisan db:seed --class=InsertOldAddresesSeeder
        $this->call(InsertOldAddresesSeeder::class);

        //ayv_productos => products

        // php artisan db:seed --class=InsertOldProductsSeeder
        $this->call(InsertOldProductsSeeder::class);

        //ayv_multimedia => colors

        // php artisan db:seed --class=InsertOldColorsSeeder
        $this->call(InsertOldColorsSeeder::class);

        //Size ejecuta unos create internos no los hace desde un json como los demas

        // php artisan db:seed --class=InsertOldSizesSeeder
        $this->call(InsertOldSizesSeeder::class);

        //Ahora ejecutamos el comando ColorSizeSeeder del seeder usual
        // php artisan db:seed --class=ColorSizeSeeder
        $this->call(ColorSizeSeeder::class);

        //Creando las ordenes
        // php artisan db:seed --class=InsertOldOrdersSeeder
        $this->call(InsertOldOrdersSeeder::class);

        //Creando los items
        // php artisan db:seed --class=InsertOldOrdersDetailsSeeder
        $this->call(InsertOldOrdersDetailsSeeder::class);

        //Creando el content de cada item
        // php artisan db:seed --class=InsertOldOrdersDetailsCompleteSeeder
        $this->call(InsertOldOrdersDetailsCompleteSeeder::class);

        // php artisan db:seed --class=MoveOldOrderImagesSeeder
        $this->call(MoveOldOrderImagesSeeder::class);
        // php artisan db:seed --class=MoveOldProductImagesSeeder
        $this->call(MoveOldProductImagesSeeder::class);
        
    }
}
