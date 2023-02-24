<?php

namespace App\Http\Livewire\Components\Prices;

use App\Models\Price;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowPrices extends Component
{
    public $product, $prices, $price, $price_total, $quantity;

    protected $listeners = [
        'render' => 'render',
    ];

    protected $rules = [
        'price' => 'required',
        'quantity' => 'required',
    ];

    public function mount($product){
        // Log::info('imprimiendo prices...');
        $this->product = $product;
        // Log::info($prices);
        $this->prices = $product->prices;
    }

    public function createPrice(){

        Log::info($this->price);
        Log::info($this->quantity);

        $this->product->prices()->create([
            'value' => $this->price,
            'quantity' => $this->quantity,
        ]);

        $this->product = $this->product->fresh();
        $this->prices = $this->product->prices;

        $this->price = 0.00;
        $this->quantity = 0;
        $this->price_total = 0.00;
        
    }

    public function updatedQuantity(){
        if($this->price > 0){
            $this->price_total = ((float) $this->price) * $this->quantity;
        }
    }

    public function updatedPrice(){
        if($this->quantity > 0){
            $this->price_total = ((float) $this->price) * $this->quantity;
        }
    }

    public function updatedPriceTotal(){
        if($this->quantity > 0){
            $this->price = ((float) $this->price_total) / $this->quantity;
        }
    }

    public function deletePrice($priceId){
        $price = Price::find($priceId);
        $price->delete();
        $this->product = $this->product->fresh();
        $this->prices = $this->product->prices;
        $this->emit('eliminado');
    }

    public function render()
    {
        return view('livewire.components.prices.show-prices');
    }
}
