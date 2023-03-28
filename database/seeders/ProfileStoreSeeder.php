<?php

namespace Database\Seeders;

use App\Models\ProfileStore;
use Illuminate\Database\Seeder;

class ProfileStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProfileStore::create(
            [
                'title'=>'Aquarella Ropa y Accesorios',
                'ship_min'=>'200',
                'domain'=>'ara.pe',
                'instagram'=>'aquarellaropa',
                'tiktok'=>'aquarellaropa',
                'facebook'=>'aquarellaropa',
                'whatsapp'=>'945101774',
                'logo'=>'',
                'store_id'=>10,

            ]
        );
    }
}
