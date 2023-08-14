<?php

namespace App\Http\Livewire\Manage\Products\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateCategory extends Component
{

    public $category;

    public $listeners = [
        'save' => 'save'
    ];

    protected $rules = [
        'category.name' => 'required',
        'category.category_id' => 'required',
        'category.has_color' => 'required',
        'category.has_size' => 'required'
    ];


    public function  mount(){
        $this->category['category_id'] = 1;
    }

    public function save()
    {

        $this->validate($this->rules);

        $category = new Category();

        $category->name = $this->category['name'];
        $category->slug = Str::slug($this->category['name']);
        if ($this->category['category_id'] == 1) {
            $category->category_id = null;
        } else {
            $category->category_id = $this->category['category_id'];
        }
        $category->has_color = $this->category['has_color'];
        $category->has_size = $this->category['has_size'];

        $category->save();

        //Este emit no necesita un listener
        $this->emitTo('manage.products.create-product', 'render');
        //este emit necesita un listener
        $this->emit('creado');

        //Log::debug($this->category);
        //$this->product->save();

    }


    public function render()
    {
        $user = Auth::user();
        $categoriesRecursive = Category::where('owner_id',$user->id)->whereNull('category_id')->with('childrenCategories')->orderBy('name', 'desc')->get();

        return view('livewire.manage.products.categories.create-category', compact('categoriesRecursive'));

    }
}
