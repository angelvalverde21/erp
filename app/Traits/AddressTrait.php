<?php

namespace App\Traits;

use App\Models\Address;
use App\Models\District;


trait AddressTrait{

    public $address, $namedistrict, $modal;

    protected $rules = [
        'address.name' => 'required',
        'address.phone' => 'required',
        'address.primary' => 'required',
        'address.district_id' => 'required',
        'address.title' => '',
        'address.user_id' => '',
        'address.dni' => '',
        'address.secondary' => '',
        'address.references' => '',
        'address.maps' => '',
    ];

    public function SendToInput($value){

        if(isset($value->user_id)){
            $this->address['user_id'] = $value->user_id;  
        }else{
            $this->address['user_id'] = $value->id;
        }
        //$this->address['user_id'] = $value->user_id; //se monta en la plantilla de blade por seguridad
        $this->address['name'] = $value->name;
        $this->address['phone'] = $value->phone;
        $this->address['dni'] = $value->dni;
        $this->address['primary'] = $value->primary;
        $this->address['secondary'] = $value->secondary;
        $this->address['references'] = $value->references;
        $this->address['district_id'] = $value->district_id;
        $this->address['title'] = $value->title;
        $this->address['maps'] = $value->maps;

        if(isset($value->district->name)){
            $this->namedistrict = $value->district->name.' - '.$value->district->province->name.' - Dpto. '.$value->district->province->department->name;
        }
    }

    public function districtAdd($value){

        $district = District::with(['province.department'])->find($value);

        $this->namedistrict = $district->name.' - '.$district->province->name.' - '.$district->province->department->name;

        $this->address['district_id'] = $value;
    }

    
    public function showDistricts($value){

        if ($value <> "") {
            
            $districts = District::with(['province.department'])->where('name', 'like', '%' . $value . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);
        
        }else{
            //$districts = District::all();
            $districts = [];
        }

        return $districts;
    }

    public function loadValuesTemplateForAddress(Address $address){

        $address->name = $this->address['name'];
        $address->phone = $this->address['phone'];
        $address->references = $this->address['references'];
        $address->primary = $this->address['primary'];
        $address->secondary = $this->address['secondary'];
        $address->title = $this->address['title'];
        $address->maps = $this->address['maps'];

        if ($this->address['dni']>0){
            $address->dni = $this->address['dni'];
        }else{
            $address->dni = null;
        }

        $address->district_id = $this->address['district_id'];
        $address->user_id = $this->address['user_id'];

        return $address;
    }

}
