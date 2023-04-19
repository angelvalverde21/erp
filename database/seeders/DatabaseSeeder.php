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
                Storage::makeDirectory('products/colors');
                Storage::makeDirectory('photografies');
                Storage::makeDirectory('colors');
                Storage::makeDirectory('orders');
                Storage::makeDirectory('stores/carousel');
                Storage::makeDirectory('stores/logos');

                $this->call(RoleSeeder::class);
                $this->call(UserSeeder::class);
                
                $this->call(CategorySeeder::class);

                $this->call(SubcategorySeeder::class);
                $this->call(ProductSeeder::class);
                // $this->call(ColorSeeder::class);
                // $this->call(SizeSeeder::class);
                // $this->call(ColorSizeSeeder::class);
                $this->call(DepartmentSeeder::class);
                $this->call(ProvinceSeeder::class);
                $this->call(DistrictSeeder::class);
                $this->call(AddressSeeder::class);
                $this->call(PaymentMethodSeeder::class);
                $this->call(DeliveryMethodSeeder::class);
                $this->call(PaymentListSeeder::class);
                $this->call(PaymentListMethodSeeder::class);
                $this->call(CollectMethodSeeder::class);
                $this->call(OrderSeeder::class);
                $this->call(StatusSeeder::class);
                $this->call(CarouselSeeder::class);
                $this->call(PaymentStatusSeeder::class);
                $this->call(PaymentSeeder::class);
                $this->call(ProfileStoreSeeder::class);
    }
}
