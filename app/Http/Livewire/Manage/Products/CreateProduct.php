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

        Log::info('se pulso el boton crear producto');
        Log::info($this->product);
       
        //
        $this->validate($this->rules);
        Log::info('se ha validado correctamente los datos');

        $product = new Product();
        Log::info('se ha creando la instancia para crear un producto');

        $product->name = $this->product['name'];
        $product->title = $this->product['name'];
        $product->slug = $this->product['slug'];
        $product->category_id = $this->product['category_id'];
        $product->price = $this->product['price'];
        $product->costo = $this->product['costo'];
        
        $product->status = '1';
        $product->owner_id = $this->user->id;
        $product->store_id = $this->store->id;
        Log::info('se han asignado correctamente los datos para guardarlos');

        $product->short_link = substr(md5(bcrypt(Str::slug($this->product['name']))),0,5);
        Log::info('short_link');
        Log::info($this->product['name']);
        Log::info(substr(md5(bcrypt(Str::slug($this->product['name']))),0,6));
        Log::info('se han asignado el shortLink');

        Log::info('se imprime los datos del producto');
        Log::info($product);

        //Guardo el producto
        $product->save();
        Log::info('se ha guardo el producto');

        $product->prices()->create([
            'quantity' => 1,
            'value' => $this->product['price']
        ]);

        Log::info('se ha insertado un precio');

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

        Log::info('se ha terminado de crear las tallas');

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
