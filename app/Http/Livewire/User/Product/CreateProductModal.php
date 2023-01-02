<?php

namespace App\Http\Livewire\User\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateProductModal extends Component
{

    public $product, $categories, $category_id="", $subcategories = [], $slug, $user;

    protected $rules = [
        'category_id'=>'required',
        'product.subcategory_id' => 'required',
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
        'product.price' => 'required',
        'product.optionsize' => 'required'
    ];

    public function mount(){

        $this->categories = Category::all();

        $sizes = new Size();

        $this->optionSizes = $sizes->option;

        //Seleccionando por defecto la categoria 1 (Ropa para mujeres)
        $this->category_id = 1;
        $this->subcategories = Subcategory::where('category_id', 1)->get();
        $this->subcategory_id = "";
        
        // $this->category_id = $product->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function updatedProductName($value){
        //Log::debug(Str::slug($value));
        $this->product['slug'] = Str::slug($value);
    }

    public function save(){

        $user = auth()->user();

        $rules = $this->rules;
        
        Log::debug($this->product);
        //$this->product->save();

        $this->validate($rules);
        
        $product = new Product();

        $product->name = $this->product['name'];
        $product->title = $this->product['name'];
        $product->slug = $this->product['slug'];
        $product->subcategory_id = $this->product['subcategory_id'];
        $product->price = $this->product['price'];
        $product->status = '1';
        $product->owner_id = $user->id;

        $product->save();

        $optionSizes = $this->product['optionsize'];
    
        $newSises = explode(',', $optionSizes);

        foreach ($newSises as $size) {
            Size::create(
                [ 
                    'name'=>$size,
                    'product_id'=> $product->id,
                    'quantity' => '0',
    
                ]
            );
        }
       
        $this->limpiarCampos();

        //Aqui le decimos a laravel que renderice todos los compoenntes que tengan el metodo "render"
        //$this->emit('render');
        //Pero si deseamos solo renderizar un componente entonces usamos emitTo y extraemos el argumento desde 
        //el componente de clase, en este caso hemos extraido 'user.product.show-products' y se lo hemos pasado como argumento a emitto
        //El argumento se extrajo de la linea de codigo de abajo
        //'Linea de codigo en function render' --> return view('livewire.user.product.show-products', compact('posts'))->layout('layouts.user');

        //Este emit no necesita un listener
        $this->emitTo('user.product.show-products','render');

        //este emit necesita un listener
        $this->emit('creado');

    }

    public function limpiarCampos(){
        $this->product['slug'] ="";
        $this->product['name'] ="";
        $this->product['price'] ="";
        $this->product['subcategory_id'] ="";
        $this->product['optionsize'] ="";
    }

    public function updatedCategoryId($value){
        
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        // Log::debug('hola: '.$value);
        // Log::debug('hola: '.$this->subcategories);
   
    }

    public function test(){
        $this->emit('creado');  //Ha este emit lo esta escuchando desde el javascript de sweetaler2 en el archivo layout user.php
        //$this->emit('render');   //Ha este emit lo esta escuchando todos los listener de todos los componentes con $listener = ['render']
        $this->emitTo('user.product.create-product-modal','render'); //Ha este emit lo escuchan solo desde el componente 'user.product.create-product-modal'
    }

    function getCategoryTree($parent_id = null, $spacing = '', $tree_array = array()) {
        $categories = Category::select('id', 'name', 'parent_id')->where('parent_id' ,'=', $parent_id)->orderBy('parent_id')->get();
        foreach ($categories as $item){
            $tree_array[] = ['categoryId' => $item->id, 'name' =>$spacing . $item->name] ;
            $tree_array = $this->getCategoryTree($item->id, $spacing . '--', $tree_array);
        }
        return $tree_array;
    }

    public function render()
    {

        //$categoriesRecursive = $this->getCategoryTree();
        //ojo si esta variable se define en los public, no funcinara en compact
        $categoriesRecursive = Category::whereNull('category_id')->with('childrenCategories')->orderBy('name','desc')->get();
        //$categoriesRecursive = Category::with('categories')->get();

        return view('livewire.user.product.create-product-modal',compact('categoriesRecursive'));
    }
}
