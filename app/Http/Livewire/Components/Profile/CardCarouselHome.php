<?php

namespace App\Http\Livewire\Components\Profile;

use App\Models\Carousel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CardCarouselHome extends Component
{

    //Si los nombres no estan correctamente definidos no se enviara por wire:model

    protected $listeners = [
        'refreshCarousel' => 'refreshCarousel',
    ];

    public $carousel = [];

    protected $rules = [
        'carousel.title' => 'required',
        'carousel.sub_title' => '', 
        'carousel.slug' => 'required|unique',
    ];

    public function mount($store)
    {
        $this->store = $store;
        
        //$this->carousel = Carousel::where('store_id',$this->store->id)->get();

        foreach ($this->store->carousel as $carousel) {
            # code...
            //$this->carousel es una variable a parte que ira al template
            $this->carousel[$carousel->id]['title'] = $carousel->title;
            $this->carousel[$carousel->id]['sub_title'] = $carousel->sub_title;
            $this->carousel[$carousel->id]['slug'] = $carousel->slug;
        }

        Log::info("Este es un log desde el carousel: " . $store);
        //Log::info("las imagenes son: " . $this->carousel);
    }

    public function saveAll(){
        //guardando todos los datos de una sola ves
        //ojo recorremos todo el carousel existente en la base de datos y luego guardamos uno por uno
        foreach ($this->store->carousel as $carousel) {
            $this->saveItem($carousel);
        }

        $this->emit('actualizado');
    }

    function saveItem(Carousel $carousel){
        //Sabiendo que existe elementos en la base de datos del carousel usamos estos datos para obtener el id y con ese id
        //sacar los datos del template
        $carousel->title = $this->carousel[$carousel->id]['title'];
        $carousel->sub_title = $this->carousel[$carousel->id]['sub_title'];
        $carousel->slug = $this->carousel[$carousel->id]['slug'];
        $carousel->save();
    }

    public function deleteItem(Carousel $carousel){
        $carousel->delete();
        $this->store = $this->store->fresh();
        $this->emit('eliminado');
    }
    // public function guardarItemCarousel(Carousel $carousel)
    // {
    // }

    public function refreshCarousel(){
        
        Log::info("se termino de subir");
        $this->store = $this->store->fresh();
        
    }

    public function render()
    {
        $store = $this->store;
        return view('livewire.components.profile.card-carousel-home', compact('store'));
    }
}
