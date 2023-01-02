<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //Creamos los roles
        $roleAdmin      = Role::create(['name'=>'admin']);
        $roleSeller     = Role::create(['name'=>'seller']);
        $roleReseller   = Role::create(['name'=>'reseller']);
        $roleBuyer      = Role::create(['name'=>'internet']); //este rol es para asigarlo al usuario que vamos a crear que servira para identificar los pedidos de afuerta
        $roleBuyer      = Role::create(['name'=>'client']);
        $roleBuyer      = Role::create(['name'=>'buyer']);
        $roleModelo     = Role::create(['name'=>'modelo']);
        $roleFotografo  = Role::create(['name'=>'fotografo']);
        $roleRepartidor = Role::create(['name'=>'repartidor']);
        $roleEmpacador  = Role::create(['name'=>'empacador']);
        $roleCarrier    = Role::create(['name'=>'carrier']);
        $roleWholesaler = Role::create(['name'=>'wholesaler']);
        $roleStore      = Role::create(['name'=>'store']);
        $roleStoreAdmin = Role::create(['name'=>'admin_store']);
        $roleStoreAdmin = Role::create(['name'=>'seller_store']);
        $roleStoreAdmin = Role::create(['name'=>'reseller_store']);

        //Creamos los permisos que podran acceder a la url "store"

        Permission::create(['name'=>'store'])->syncRoles([$roleSeller]);
        
    }
}
