<?php

namespace App\Http\Livewire\Components\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class UploadOption extends Component
{
    
    public $store, $text, $field, $fieldKebabCase, $fieldPascalCase, $user, $user_id;

    protected $listeners = [
        'render'=>'render',
        'refreshOptionUpload' => 'render',

    ];

    public function mount(User $store, $field, $user_id = null, $text = 'Subir Imagen'){

        if ($user_id>0) {
            $this->user_id = $user_id;
            $this->user = User::findOrFail($user_id);
        } else {
            $this->user_id = null;
        }

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

        if ($this->user) {

            foreach ($this->user->options as $option) {
                # code...
                if( $option->name == $field ){
                    
                    $image = $option->value;
                    break;
    
                }
    
            }
        } else {

            foreach ($store->options as $option) {
                # code...
                if( $option->name == $field ){
                    
                    $image = $option->value;
                    break;
    
                }
    
            }
        }
        

        return view('livewire.components.profile.upload-option', compact('store','field','image','text'));
    }
}
