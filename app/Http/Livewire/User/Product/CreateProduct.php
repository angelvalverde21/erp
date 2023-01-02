<?php

namespace App\Http\Livewire\User\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CreateProduct extends Component
{

    public $listeners = [
        'render' => 'render'
    ];

    public $product;

    protected $rules = [
        'product.category_id'=>'required',
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
        'product.price' => 'required'
    ];

    public function mount(){

        $this->user = Auth::user();
        
        $this->product['category_id'] = 1;

        $sizes = new Size();

        $this->optionSizes = $sizes->option;
        
        // $this->category_id = $product->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function selectCategory(Category $category){
        $this->category = $category;
        $this->category_id = $category->id;
    }

    public function updatedProductName($value){
        //Log::debug(Str::slug($value));
        $this->product['slug'] = Str::slug($value);
    }

    public function save(){

        //$rules = $this->rules;

        Log::info($this->product);
       
        //
        $this->validate($this->rules);
        
        $product = new Product();

        $product->name = $this->product['name'];
        $product->title = $this->product['name'];
        $product->slug = $this->product['slug'];
        $product->category_id = $this->product['category_id'];
        $product->price = $this->product['price'];
        $product->status = '1';
        $product->owner_id = $this->user->id;

        Log::info($product);

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

        return redirect('user/products/'. $product->id .'/edit');

    }

    public function updatedCategoryId($value){
        
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        // Log::debug('hola: '.$value);
        // Log::debug('hola: '.$this->subcategories);
   
    }

    public function render()
    {
        $user = Auth::user();
        $categoriesRecursive = Category::where('owner_id',$this->user->id)->whereNull('category_id')->with('childrenCategories')->orderBy('name','desc')->get();

        return view('livewire.user.product.create-product', compact('categoriesRecursive'))->layout('layouts.user');
    }
}
