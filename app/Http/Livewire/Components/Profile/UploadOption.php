<?php

namespace App\Http\Livewire\Components\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class UploadOption extends Component
{
    
    public $store, $text, $field, $fieldKebabCase, $fieldPascalCase, $user;

    protected $listeners = [
        'render'=>'render',
        'refreshOptionUpload' => 'render',

    ];

    public function mount(User $store, $field, $user = null, $text = 'Subir Imagen'){
        $this->user = $user;
        $this->text = $text;
        $this->store = $store;
        $this->field = $field;
        $this->fieldPascalCase = Str::studly($field);
        // $this->fieldKebabCase = Str::snake($field);
    }


    public function render()
    {
        $store = $this->store;
        $field = $this->field;
        $text = $this->text;

        $image = 'image no encontrada';

        foreach ($store->options as $option) {
            # code...
            if( $option->name == $field ){
                
                $image = $option->value;
                break;

            }

        }

        return view('livewire.components.profile.upload-option', compact('store','field','image','text'));
    }
}
