<?php

namespace App\Http\Livewire\Manage\Customers;

use Livewire\Component;

use App\Models\Address;
use App\Models\District;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class CreateCustomer extends Component
{

    public $namedistrict, $name, $dni, $phone, $primary, $secondary, $references, $district_id, $delivery_date;
    public $observations_public, $observations_private;


    public $sales = [];

    protected $listeners = ['districtAdded' => 'districtAdded'];

    protected $rules = [

        'delivery_date' => '',
        'observations_public' => '',
        'observations_private' => '',
        'delivery_date' => '',
        'phone' => 'required',
        'dni' => '',
        'name' => 'required',
        'primary' => 'required',
        'secondary' => '',
        'references' => '',
        'district_id' => 'required',
    ];

    public function mount()
    {
        $this->namedistrict = '';

        $this->store = Request::get('store');
    }


    function districtAdded($value)
    {
        //Log::debug($value);

        $district = District::with(['province.department'])->find($value);
        //$district = District::find($value)->province;
        //$district = District::find($value)->province->department;
        //$province = Province::find($district->province_id);
        // $district = new District();
        // $district = District::whereHas('province', function($q) use ($value) {
        //     $q->where('id', $value);
        // })->get();

        $this->namedistrict = $district->name . ' - ' . $district->province->name . ' - ' . $district->province->department->name;

        //Log::debug($district);
        //Log::debug($province);

        $this->district_id = $value;
    }


    public function save()
    {

        $seller = Auth::user();

        //Primero buscamos si existe el cliente por el numero de celular o por dni o por nombre

        $rules = $this->rules;
        $this->validate($rules);

        //crear usuario

        $buyer = new User();
        $buyer->name = trim($this->name); //Elimina los espacios en blanco al incio y final
        if ($this->dni) {
            $buyer->dni = str_replace(' ', '', $this->dni); //Elimina los espacios en blanco de toda la cadena
        }
        $buyer->phone = str_replace(' ', '', $this->phone); //Elimina los espacios en blanco de toda la cadena
        $buyer->password = bcrypt(substr(trim($this->name), 0, 1) . $this->phone); //genera un password con la primera letra de su nombre + un telefono
        
        $buyer->store_id = $this->store->id; //genera un password con la primera letra de su nombre + un telefono
        $buyer->seller_id = $seller->id; //genera un password con la primera letra de su nombre + un telefono

        $buyer->save();

        //una vez creado se asigna el rol de cliente
        $buyer->assignRole('buyer');

        Log::debug('Usuario creado :' . $buyer);

        //crear direccion de envio

        $address = new Address();

        $address->name = trim($this->name);
        if ($this->dni) {
            $address->dni = str_replace(' ', '', $this->dni);
        }
        $address->phone = str_replace(' ', '', $this->phone);
        $address->primary = trim($this->primary);
        $address->secondary = trim($this->secondary);
        if ($this->references) {
            $address->references = trim($this->references);
        }

        $address->user_id = $buyer->id; //el usuario al cual le pertenece la direccion
        $address->district_id  = $this->district_id; //el usuario al cual le pertenece la direccion

        $address->save();
        Log::debug('Direccion de envio creado :' . $address);

        //crear id de venta

        $order = new Order();

        $order->owner_id = $this->store->id;
        $order->seller_id = $seller->id;
        $order->buyer_id = $buyer->id;
        $order->address_id = $address->id; //el id de la direccion recien creada

        $order->save();

        Log::debug('Orden creada :' . $order);

        $this->emitTo('manage.orders.show-orders', 'render');

        //este emit necesita un listener
        $this->emit('creado');
    }

    public function updatedPhone($value)
    {

        if (strlen($value) >= 6 && strlen($value) <= 9) {
            $user = User::where('phone', $value)->get();

            Log::debug($user);

            if (count($user) == 1) {

                $this->name = $user[0]->name;
                $this->dni = $user[0]->dni;
            }
        }
    }

    public function updatedDni($value)
    {
        if (strlen($value) == 8) {
            $user = User::where('dni', $value)->get();

            if (count($user) == 1) {
                $this->name = $user[0]->name;
                $this->phone = $user[0]->phone;
            }
        }
    }

    // public function updatedName($value)
    // {
    //     $user = User::where('name', 'like', '%' . $value . '%')->get();

    //     if(count($user) == 1 ){
    //         $this->dni = $user[0]->dni;
    //         $this->phone = $user[0]->phone;
    //     }
    // }

    public function render()
    {

        //Log::debug($this->namedistrict);

        if ($this->namedistrict <> "") {

            $districts = District::with(['province.department'])->where('name', 'like', '%' . $this->namedistrict . '%')
                ->orderBy('name', 'asc')
                ->paginate(10);
        } else {
            //$districts = District::all();
            $districts = [];
        }


        return view('livewire.manage.customers.create-customer', compact('districts'))->layout('layouts.manage');
    }
}

