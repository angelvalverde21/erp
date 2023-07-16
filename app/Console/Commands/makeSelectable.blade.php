<?php

//ojo esto es una plantilla

namespace App\Http\Livewire;

use Livewire\Component;

class {{ $nameComponent }} extends Component
{

    public $listeners = [
        'render' => 'render'
    ];

    public $product, $store, $user;

    protected $rules = [
        'product.category_id'=>'required',
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
    ];

    public function mount(){

        $this->store = Request::get('store');

        $this->user = Auth::user();

    }

    public function save(){

        $product = new Product();
        Log::info('se ha creando la instancia para crear un producto');

        $product->name = $this->product['name'];
        $product->title = $this->product['name'];
        $product->slug = $this->product['slug'];

        //Guardo el producto
        $product->save();


        return redirect($this->store->nickname.'/manage/products/'. $product->id .'/edit');

    }

    public function render()
    {
        return view('{{ $pathNameView }}')->layout('layouts.manage');
    }
}
