<?php

namespace App\Http\Livewire\User\Product;

use Livewire\Component;
use App\Models\Product;

class ShowProducts extends Component
{
    public $title;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $user;

    protected $listeners = ['render' => 'render'];



    public function order($sort)
    {

        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }

        //$this->sort = "id";
    }

    public function render()
    {

        $user = auth()->user();

        if ($this->search <> "") {
            $products = Product::where('title', 'like', '%' . $this->search . '%')->where('owner_id', $user->id)
                ->orderBy($this->sort, $this->direction)
                ->paginate(10);
        } else {
            //Muestra todos los post
            //$products = Photography::all();
            //Tambien Muestra todos los post pero filtrado
            $products = Product::where('status','1')->orderBy($this->sort, $this->direction)->where('owner_id', $user->id)
                ->paginate(10);
        }

        return view('livewire.user.product.show-products', compact('products'))->layout('layouts.user');
    }
}
