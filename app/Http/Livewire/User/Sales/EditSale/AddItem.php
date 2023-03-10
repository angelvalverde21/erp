<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\ColorSize;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class AddItem extends Component
{
    public $search, $quantity_oversale = [], $qty, $product, $size;
    public $size_pivot, $sizepivot, $quantity = [];
    public $stock, $size_color, $showSelect;

    public function mount(Order $order){

        $this->order = $order;
        $this->showSelect = false;

    }

    public function addItem($value){

        $color_size_id = $value;


        // Log::debug($this->order->id);
        // Log::debug($this->quantity[$value]);

        // $arrayValue = explode('-',$this->quantity[$value]);
        // $color_size_id = $arrayValue[0];
        // $qty = $arrayValue[1];

        // Log::debug($this->order->id);
        // Log::debug($this->quantity[$value]);

        //Obteniendo nombre de talla, archivo de imagen,  nombre de imagen
        //y el titulo del producto

        $colorSize = ColorSize::find($color_size_id);
        $size_name = $colorSize->size->name;
        $color_name = $colorSize->color->name;
        $color_file_name = $colorSize->color->file_name;
        $description = $colorSize->color->product->name;
        $price = $colorSize->color->product->price;

        $content =             [
            'color_size_id'=>$color_size_id,
            'talla'=>$size_name,
            'file_name'=>$color_file_name,
            'price'=>$price
        ];

        $item = new Item();

        if(isset($this->quantity_oversale[$value])){
            $item->quantity = 0;
            $item->quantity_oversale = $this->quantity_oversale[$value];
        }else{
            $item->quantity = $this->quantity[$value];
            $item->quantity_oversale = 0;
        }
    
        $item->price = $price;
        $item->description = $description;
        $item->content = $content;
        $item->order_id = $this->order->id;

        $item->save();

        actualizarStock($item->id,"separar");

        //quantity
        //price
        //description
        //content
        //order_id

        //Actualizamos el producto por completo para que en el select desplegable se muestre el stock real
        $this->product = $this->product->fresh();

        $this->quantity[$value] = 0; //seteando nuevamente a 0
        if(isset($this->quantity_oversale[$value])){
            $this->quantity_oversale[$value] = 0;
        }

        //$this->quantity_oversale[$value] = 0;
      
        $this->emitTo('user.sales.edit-sale.items.card-show-all-items','render');
        $this->emitTo('user.sales.edit-sale.show-summary','render');

        //este emit necesita un listener
        $this->emit('creado');

    }


    // public function updatedItem($value){

    //     Log::info($this->item);
    //     Log::info($this->quantity['color_size_id']);

        // $arrayValue = explode('-',$value);
        // $itemId = $arrayValue[0];
    //     // $this->qty[$itemId] = $arrayValue[1];
    // }

    public function consultarStock($colorSizeId){
        Log::info($colorSizeId);
        Log::debug($this->quantity[$colorSizeId]);
        //Este valor se lo inyectamos para que active el boton verde (+) para agregar items 

    }

    public function deleteSearchText(){
        $this->search = "";
    }

    public function selectItem($value)
    {
        Log::debug($value);

        $user = new User();
        $user = auth()->user();

        $product = Product::find($value);

        //$district = District::find($value)->province;
        //$district = District::find($value)->province->department;
        //$province = Province::find($district->province_id);
        // $district = new District();
        // $district = District::whereHas('province', function($q) use ($value) {
        //     $q->where('id', $value);
        // })->get();

        $this->search = $product->name;

        if ( $product->subcategory->has_color ) {

            $this->product = Product::with(['colors'])->where('owner_id',$user->id)->find($value);

            if( $product->subcategory->has_size ){
                $this->product = Product::with(['colors.sizes'])->where('owner_id',$user->id)->find($value);

                $this->showSelect = true;
            }

        } else {
            # code...
            $this->product = $product;
        }


        
        $this->items = [];

        //Log::debug($district);
        //Log::debug($province);

        //$this->district_id = $value;
    }

    public function updatedSize($value){

        Log::debug('El valor del select es :'.$value);

        $valores = explode('-',$value);
        // OJO BLADE ENVIA LOS DATOS EN EL SIGUIENTE FORMATO
        
        /*

        array (
            '23' => 
            array (
              'color' => '57',
            ),
            '18' => 
            array (
              'color' => '52',
            ),
            '16' => 
            array (
              'color' => '50',
            ),
          )

          y se lo asigna a $this->size

          */

        //$arrayKeys = array_keys($this->size);
        // Log::debug(serialize($this->size));
        //Log::debug($arrayKeys);
        //Log::info(print_r($this->size,true));
        // $countElements = count($arrayKeys);

        //Log::debug('Total de elementos: '.$countElements);
        //Obteniendo el ultimo select seleccionado por el cliente
        
        //$nuevoArray = $this->size;

        // //Log::debug('Valor del id: '.$id);
        // Log::debug('Valor del select: '.$value);
        // Log::debug('Valor de $this->size: '.serialize($this->size));
        // foreach ($this->size as $key => $value) {
        //     Log::debug('Valor de color->id es: '.$key);
        // }

        // $arrayKeys = array_keys($this->size);
        //$colorId = $arrayKeys[count($arrayKeys)-1];

        $colorId = $valores[0];
        $pivot_id = $valores[1];
        Log::debug('El color id es: '.$colorId);
        Log::debug('Valor id de la talla en la tabla pivot es: '.$pivot_id);
        
        $this->quantity[$colorId] = ColorSize::find($pivot_id);

        //Log::debug('el stock para el color id '. $colorId .' seleccionado es : '.$this->quantity[$colorId]['quantity']);
        //Log::debug('------------------------------');
        //Log::info(print_r($this->quantity[$colorId], true));
        //Log::debug('------------------------------');

        //$this->sizepivot[$id] = ColorSize::find($value);
        //Log::debug($this->sizepivot);
    }

    public function render()
    {
        $user = auth()->user();

        if ($this->search <> "") {

            $items = Product::where('title', 'like', '%' . $this->search . '%')->where('owner_id', $user->id)
                ->orderBy('id', 'desc')
                ->paginate(10);

            $this->showSelect = true;

        } else {
            //Muestra todos los post
            //$posts = Photography::all();
            //Tambien Muestra todos los post pero filtrado
            $items = [];

            $this->showSelect = false;
        }

        return view('livewire.user.sales.edit-sale.add-item', compact('items'));
    }
}
