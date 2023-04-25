<?php

namespace App\Http\Livewire\Manage\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

class CreateProduct extends Component
{

    public $listeners = [
        'render' => 'render'
    ];

    public $product, $store, $user;

    protected $rules = [
        'product.category_id'=>'required',
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
        'product.price' => 'required',
        'product.costo' => 'required'
    ];

    public function mount(){

        $this->store = Request::get('store');

        $this->user = Auth::user();

        Log::info($this->user);
        
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
        $product->store_id = $this->store->id;

        $product->short_link = substr(base64_encode(bcrypt(Str::slug($this->product['name']))),0,5);

        Log::info($product);

        //Guardo el producto
        $product->save();

        $product->prices()->create([
            'quantity' => 1,
            'value' => $this->product['price']
        ]);

        if($product->category->has_size){

            $optionSizes = $this->product['optionsize']; //este valor viene de la vista livewire (select)

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
        }

        return redirect($this->store->nickname.'/manage/products/'. $product->id .'/edit');

    }

    public function updatedCategoryId($value){
        
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        // Log::debug('hola: '.$value);
        // Log::debug('hola: '.$this->subcategories);
   
    }

    public function saveCategory(){
        $this->emitTo('manage.products.categories.create-category','save');
    }

    public function render()
    {

        $user = Auth::user();

        $categoriesRecursive = Category::where('owner_id',$this->user->id)->whereNull('category_id')->with('childrenCategories')->orderBy('name','desc')->get();

        Log::info($categoriesRecursive);

        return view('livewire.manage.products.create-product', compact('categoriesRecursive'))->layout('layouts.manage');

    }
}
