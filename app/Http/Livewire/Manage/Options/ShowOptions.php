<?php

namespace App\Http\Livewire\Manage\Options;

use App\Models\Option;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOptions extends Component
{

    public $store, $getOptions, $options, $result;

    public $title, $domain, $whatsapp;

    

    protected $rules = [
        'options' => '',
    ];

    public function mount()
    {
        $this->store = Request::get('store');

        $this->getOptions = $this->store->options;

        if ($this->getOptions->count() > 0) {
            foreach ($this->getOptions as $option) {
                # code...
                $this->options[$option->name] = $option->value;
            }
        } else {

            // $this->store->options()->create(
            //     [
            //         'name' => 'title',
            //         'value' => ''
            //     ],
            // );

            // $this->store->options()->create(
            //     [
            //         'name' => 'domain',
            //         'value' => ''
            //     ],
            // );

            // $this->store->options()->create(
            //     [
            //         'name' => 'whatsapp',
            //         'value' => ''
            //     ],
            // );
        }

        // $this->title = $this->options['title'];
        // $this->domain = $this->options['domain'];
        // $this->whatsapp = $this->options['whatsapp'];
    }

    public function save()
    {

        Log::info($this->options);

        foreach ($this->options as $name => $value) { //Este option es de la plantilla blade
            # code...

            //sino existe el campo en la base de datos entonces creamos uno nuevo
            if(!existeFieldOption($this->store, $name)){
                //sino existe el campo entonces creamos
                $this->store->options()->create(
                    [
                        'name' => $name,
                        'value' => $value
                    ],
                );
            }else{
                //ojo inicialmente usamos $this->getOptions, pero este es un array que se carga al inicio y no se actualiza por eso mejor usamos $this->store->options
                //que en la practica es una nueva consulta a la base de datos
                foreach ($this->store->options as $getOption) { //getOptions de de la base de datos, hemos colocado 'get' a las variables para identificar que son las que vienen de la base de datos
                    # code...
                    if($name == $getOption->name){ //esto quiere decir que $name (de la plantilla) es igual a $getName (de la base de datos)
                        $getOption->value = $value; //el value es el valor de la plantilla
                        $getOption->save();
                        break;
                    }
                }
                
            }

        }

        $this->emit('actualizado');
    }

    public function render()
    {

        return view('livewire.manage.options.show-options')->layout('layouts.manage');
    }
}
