<?php

namespace App\Http\Livewire\Components\Items;


use App\Models\ColorSize;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class AddItem extends Component
{
    public $search, $quantity_oversale = [], $qty, $product, $size;
    public $size_pivot, $sizepivot, $quantity = [];
    public $stock, $size_color, $showSelect;
    public $order;
    public $store;

    public function mount(Order $order){

        $this->order = $order;
        $this->showSelect = false;
        $this->store = Request::get('store');

    }

    public function addItem($color_size_id){


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

        $item = new Item();

        // $item->content =  [
        //     'color_size_id'     =>  $color_size_id,
        //     'color_id'          =>  $colorSize->color->id,
        //     'size_name'         =>  $colorSize->size->name,
        //     'image'             =>  $colorSize->color->image,
        //     'price'             =>  $colorSize->color->product->price,
        //     'product_id'        =>  $colorSize->color->product->id,
        // ];

        // $item->content =  [

        //     'color_size_id'     =>  $colorSize->id,
        //     'talla'             =>  $colorSize->size->name,
        //     'talla_impresa'     =>  $colorSize->size->name,
        //     'color_id'          =>  $colorSize->color->id,
        //     'image'             =>  $colorSize->color->image->name,
        //     'price'             =>  $colorSize->color->product->price,
        //     'product_id'        =>  $colorSize->color->product->id,
        //     'description'       =>  $colorSize->color->product->name,

        // ];

        $content = [
            'color_size_id'     => $colorSize->id,
            'size_name'         => $colorSize->size->name,
            'color_id'          =>  $colorSize->color->id,
            'size_name_real'    => $colorSize->size->name,
            'size_name_virtual' => $colorSize->size->name,
            'talla'             => $colorSize->size->name, //Es la talla que se envia al cliente
            'talla_original'    => $colorSize->size->name, //es la talla real despachada
            'talla_impresa'     => $colorSize->size->name,
            'image'             => $colorSize->color->image->name,
            'price'             =>  $colorSize->color->product->price,
            'product_id'        =>  $colorSize->color->product->id,
            'description'       =>  $colorSize->color->product->name,
        ];


        //si la casilla quantity_oversale esta marcada entonces seteamos el quantity real en 0
        // if(isset($this->quantity_oversale[$color_size_id])){
        //     $item->quantity = 0;
        //     $item->quantity_oversale = $this->quantity_oversale[$color_size_id];
        // }else{
        //     $item->quantity = $this->quantity[$color_size_id];
        //     $item->quantity_oversale = 0;
        // }
    
        $item->quantity     = $this->quantity[$color_size_id]; //estos datos vienen de la plantilla blade
        $item->order_id     = $this->order->id; //este tambien
        $item->price        = $colorSize->color->product->price;
        $item->description  = $colorSize->color->product->name;

        $item->save();

        $item->separarStock();

        //Comprobamos si la orden ha sido pagada 

        // actualizarStock($item->id,"separar");

        //quantity
        //price
        //description
        //content
        //order_id

        //Actualizamos el producto por completo para que en el select desplegable se muestre el stock real

        $this->product = $this->product->fresh();

        // if($this->order->is_pay()){
            //como esta pagado asignamos Stock::VENDIDO
            // $this->order->confirmarStock();
        // }else{
            //como no esta pagado cambiamos en la base de datos a Stock::SEPARADO
            // $this->order->reservar();
        // }

        $this->quantity[$color_size_id] = 0;
      
        $this->emitTo('components.items.show-item-all','render');
        $this->emitTo('manage.orders.edit-order.card-show-summary','render');
        $this->emitTo('manage.orders.edit-order.card-show-invoice','render');

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

        if ( $product->category->has_color ) {

            $this->product = Product::with(['colors'])->where('store_id',$this->store->id)->find($value);

            if( $product->category->has_size ){
                $this->product = Product::with(['colors.sizes'])->where('store_id',$this->store->id)->find($value);
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

            $items = Product::where('title', 'like', '%' . $this->search . '%')->where('store_id', $this->store->id)
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

        return view('livewire.components.items.add-item', compact('items'));
    }
}

