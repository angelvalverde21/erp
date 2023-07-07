<?php

namespace App\Http\Livewire\Manage\Products;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class EditProduct extends Component
{

    use AuthorizesRequests;

    protected $rules = [
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
        'product.price' => 'required',
        'product.costo' => 'required',
        'product.description' => '',
        'product.tags' => '',
        'product.price_seller' => 'required',
        'product.over_sale' => 'required',
        'product.force_size_unique' => 'required',
    ];

    public $listeners = [
        'refreshProductEdit' => 'refreshProductEdit'
    ];

    public $product, $slug, $store;

    public function mount(Product $product)
    {

        // Inicializar CKEditor con los datos iniciales
        // \Livewire\Scripts::push('ckeditor');

        //Log::debug($product);
        $this->store = Request::get('store');

        Log::info($this->store);


        // $store = User::findOrFail($this->store->id);

        if ($this->store->id == $product->store_id) {
            $this->product = $product;
        } else {
            abort(403);
        }

        //$this->authorize();
        // $this->authorize('owner');

        //$this->authorize()

    }

    public function refreshProductEdit()
    {
        $this->product = $this->product->fresh();
    }

    public function save()
    {

        $rules = $this->rules;
        $rules['product.slug'] = 'required|unique:products,slug,' . $this->product->id;

        $this->validate($rules);

        //$this->product->slug = $this->slug;

        Log::info('log desde el editProduct.php');

        Log::info($this->product);

        Log::info('fin de log desde el editProduct.php');

        // $this->product->prices()->create([
        //     'quantity' => 1,
        //     'price' => $this->product->price,
        // ]);

        Log::debug($this->product);
        $this->product->save();
        $this->emit('actualizado');
    }

    public function updatedProductName($value)
    {
        //Log::debug($value);
        $this->product->slug = Str::slug($value);
    }

    public function render()
    {
        $product = $this->product;
        $title = $product->name;

        return view('livewire.manage.products.edit-product', compact('product'))->layout('layouts.manage', ['title' => $title]);
    }

    // public function layout()
    // {
    //     $pageTitle = 'Página de inicio';

    //     return view('layouts.manage', [
    //         'pageTitle' => $pageTitle,
    //     ]);
    // }

}
