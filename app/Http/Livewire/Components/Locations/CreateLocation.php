<?php

namespace App\Http\Livewire\Components\Locations;

use App\Models\Album;
use App\Models\District;
use App\Models\Location;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateLocation extends Component
{
    protected $rules = [
        'location.name'         => 'required',
        'location.primary'      => 'required',
        'location.district_id'  => 'required',
        'location.secondary'    => '',
        'location.references'   => '',
        'location.coordenadas'  => '',
        'location.maps'         => '',
    ];

    public $namedistrict;
    public $address;
    public $location;
    public $album;

    public function mount(Album $album){
        $this->album = $album;
    }

    public function districtAdd($value){

        $district = District::with(['province.department'])->find($value);

        $this->namedistrict = $district->name.' - '.$district->province->name.' - '.$district->province->department->name;

        $this->location['district_id'] = $value;
    }

    public function save(){
        
        Log::debug('Empezamos la validacion de location');
        
        $this->validate($this->rules);

        Log::debug('Se paso la validacion de location');
        
        $location = new Location();

        $location->name = $this->location['name'];
        $location->primary = $this->location['primary'];
        $location->secondary = $this->location['secondary'] ?? '';
        $location->references = $this->location['references'] ?? '';
        $location->maps = $this->location['maps'] ?? '';
        $location->coordenadas = $this->location['coordenadas'] ?? '';
        $location->district_id = $this->location['district_id'];

        $location->save();

        $this->album->locations()->attach($location->id);

        //Log::info('se paso la validacion: '. $this->validate($this->rules));
        
    }

    public function render()
    {

        if ($this->namedistrict <> "") {
            
            $districts = District::with(['province.department'])->where('name', 'like', '%' . $this->namedistrict . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);
        
        }else{
            //$districts = District::all();
            $districts = [];
        }


        return view('livewire.components.locations.create-location', compact('districts'));
    }
}
