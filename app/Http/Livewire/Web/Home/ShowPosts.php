<?php

namespace App\Http\Livewire\Web\Home;

use Livewire\Component;

class ShowPosts extends Component
{

    public $post;
    public $show = false;

    public function loadPosts(){

        //Emitir un evento, como estamos emitiendo un enveto, alguien tiene que escucharlo
        $this->emit('glider',$this->post->id);
        $this->show = true;
        

    }

    public function render()
    {   
        return view('livewire.web.home.show-posts');
    }
}
