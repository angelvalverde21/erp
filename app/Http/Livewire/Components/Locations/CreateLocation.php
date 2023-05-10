<?php

namespace App\Http\Livewire\Components\Locations;

use App\Models\Album;
use App\Models\AlbumLocation;
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
    public $namelocation;
    public $address;
    public $location;
    public $album;
    public $reloadUrl;
    public $location_existe = false;
    public $newLocation = false;

    public function mount(Album $album, $reloadUrl = false){
        $this->album = $album;
        $this->reloadUrl = $reloadUrl;
        Log::info('renderizando2...');
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

        $this->emit('creado');

        if($this->reloadUrl){
            // $this->emitTo($this->render,'render');
            // $this->emit('creado');
            $this->emit('reloadUrl');

            // manage.products.edit-product.albums.edit-album
        }

        //Log::info('se paso la validacion: '. $this->validate($this->rules));
        
    }

    public function new(){
        $this->newLocation = true;
    }

    public function locationAdd($location_id){

        $album_location = AlbumLocation::where('album_id',$this->album->id)->where('location_id',$location_id)->get();

        if($album_location->count()>0){
            $this->location_existe = true;
        }else{

            $this->album->locations()->attach($location_id);
            $this->emit('creado');

            if($this->reloadUrl){
                // $this->emitTo($this->render,'render');
                // $this->emit('creado');
                $this->emit('reloadUrl');
    
                // manage.products.edit-product.albums.edit-album
            }
        }


    }

    public function deleteSearch(){
        $this->namelocation = "";
        $this->location_existe = false;
    }

    public function render()
    {

        Log::info('renderizando1...');

        if ($this->namedistrict <> "") {
            
            $districts = District::with(['province.department'])->where('name', 'like', '%' . $this->namedistrict . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);
        
        }else{

            //$districts = District::all();
            $districts = [];
            
        }

        if ($this->namelocation <> "") {

            $this->newLocation = false;
            
            $locations = Location::with(['district.province.department'])->where('name', 'like', '%' . $this->namelocation . '%')
            ->orWhereHas('district', function($query){
                $query->where('name','like', '%' . $this->namelocation . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);
        
        }else{

            //$districts = District::all();
            $locations = [];
            
        }


        return view('livewire.components.locations.create-location', compact('districts', 'locations'));
    }
}
