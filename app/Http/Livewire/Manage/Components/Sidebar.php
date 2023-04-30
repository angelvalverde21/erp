<?php

namespace App\Http\Livewire\Manage\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;


class Sidebar extends Component
{
    public $user ,$store, $product, $menus;

    public function mount(){
        //Este requeste viene desde el middleware StoreExist.php

        
        $this->user = Auth::user();
        $this->product = Request::get('product');
        
        $this->store = Request::get('store');

        if($this->store){

            $this->menus = [

                [
                    "name"=>$this->store->nickname,
                    "slug"=>"profile",
                    "icon"=>"fa-solid fa-store",
                    "sub_menu"=>[
                        [
                            "name"=>"Entregas Hoy",
                            "slug"=> route('manage.orders.today',[$this->store->nickname]),
                            "active"=>"orders.today",
                            "icon"=>"fa-solid fa-align-justify",
                        ],
                        [
                            "name"=>"Entregas pendientes",
                            "slug"=> route('manage.orders.pending',[$this->store->nickname]),
                            "active"=>"orders.pending",
                            "icon"=>"fa-solid fa-align-justify",
                        ],
                        [
                            "name"=>"Mis ventas",
                            "slug"=> route('manage.orders',[$this->store->nickname]),
                            "active"=>"orders",
                            "icon"=>"fa-solid fa-align-justify",
                        ],
                        [
                            "name"=>"Mis productos",
                            "active"=>"products",
                            "slug"=>route('manage.products',[$this->store->nickname]),
                            "icon"=>"fa-solid fa-box",
                        ],
                        [
                            "name"=>"Mis clientes",
                            "active"=>"customers",
                            "slug"=>route('manage.customers',[$this->store->nickname]),
                            "icon"=>"fa-solid fa-users",
                        ]
                    ]
                ],
    
                [
                    "name"=>"Herramientas",
                    "slug"=>"#",
                    "icon"=>"fa-solid fa-screwdriver-wrench",
                ],
    
                [
                    "name"=>"Mis Producciones",
                    "slug"=>route('manage.productions', [$this->store->nickname]),
                    "icon"=>"fa-solid fa-business-time",
                ],
    
                [
                    "name"=>"Web",
                    "slug"=>route('manage.web', [$this->store->nickname]),
                    "icon"=>"fa-solid fa-globe",
                ],
                // [
                //     "name"=>"Importacion SQL",
                //     "slug"=>route('manage.import', [$this->store->nickname]),
                //     "icon"=>"fa-solid fa-globe",
                // ],
                
    
            ];
        }

    }
    
    public function render()
    {
        $store = $this->store;
        return view('livewire.manage.components.sidebar',compact('store'));
    }


}
