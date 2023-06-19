<?php

namespace App\Http\Livewire\Components\Locations;

use App\Models\Location;
use Livewire\Component;

class ShowLocations extends Component
{
    // public $locations;

    public function render()
    {
        $locations = Location::all();

        return view('livewire.components.locations.show-locations', compact('locations'));
    }
}
