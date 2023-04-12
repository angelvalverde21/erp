<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    //Luego que sale de la base de datos le aplica un json_decode
    public function getContentAttribute($value)
    {

        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }

        return json_decode($value);
    }

    //antes que ingrese a la base de datos le aplica un json_enconde
    public function setContentAttribute($value)
    {

        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }
        $this->attributes['content'] = json_encode($value);
    }
    // public function getTallaRealAttribute(){

    // }

    public function getTallaImpresaAttribute()
    {
        return $this->content->talla;
    }

    public function getTallaVirtualAttribute()
    {
        return $this->content->talla;
    }

    public function getPrecioFinalAttribute()
    {

        if (isset($this->content->price)) {
            return $this->content->price;
        } else {
            return $this->price;
        }
    }

    public function separarStock($color_size_id = 0) //Separa el stock Stock::SEPARADO
    {

        //cuando se quiere vender una talla con otra talla del almacen
        if ($color_size_id > 0) {
            $color_size = ColorSize::find($color_size_id);
        } else {
            $color_size = ColorSize::find($this->content->color_size_id);
        }

        //se separa el stock segun la cantidad eligida


        if ($this->quantity_oversale  > 0) {
            $quantity = $this->quantity_oversale;
        } else {
            $quantity = $this->quantity;
        }

        for ($i = 0; $i < $quantity; $i++) {

            $stock = $color_size->stocks()->first();

            if ($stock) {

                Log::info('Mostrando el primer stock disponible');
                Log::info($stock);

                $stock->status = Stock::SEPARADO;
                $stock->item_id = $this->id;

                $stock->save();

                Log::info('Cambiando su estatus a ' . Stock::SEPARADO);
                Log::info($stock);

            } else {
                Log::info('No hay suficiente stock');
            }
        }

        //descontamos el stock en la base de datos
        // $color_size->quantity = $color_size->quantity - $this->quantity;

        //Guardamos el resultado en la tabla color_size
        $stock_real = $color_size->stocks()->count();
        $color_size->quantity = $stock_real;
        $color_size->save();
        //return //stock actualizado


        //actualiza los campos "quantity" de las tablas colors y products respectivamente
        $color_size->color->updateFieldQuantity();
        $color_size->color->product->updateFieldQuantity();
        $color_size->size->quantity = $stock_real;
        $color_size->size->save();
    }

    //si la orden esta pagada entonces asignamos el stock permanentemente
    public function asignarStock($color_size_id = 0) //Vende permanentemente el stock Stock::VENDIDO
    {

        if ($color_size_id > 0) {
            $color_size = ColorSize::find($color_size_id);
        } else {
            $color_size = ColorSize::find($this->content->color_size_id);
        }

        $color_size = ColorSize::find($this->content->color_size_id);

        for ($i = 0; $i < $this->quantity; $i++) {

            $stock = Stock::where('item_id', $this->id)->first();

            if (!$stock) {
                # code...
                $stock = $color_size->stocks()->first();
            }

            $stock->status = Stock::VENDIDO;
            $stock->item_id = $this->id;

            $stock->save();
        }

        $stock_real = $color_size->stocks()->count();
        $color_size->quantity = $stock_real;

        $color_size->save();

        //actualiza los campos "quantity" de las tablas colors y products respectivamente
        $color_size->color->updateFieldQuantity();
        $color_size->color->product->updateFieldQuantity();

        $color_size->size->quantity = $stock_real;

        $color_size->size->save();
        // $color_size = ColorSize::find($this->content->color_size_id);

        // //descontamos el stock en la base de datos
        // $color_size->quantity = $color_size->quantity - $this->quantity;


        // $stock = $color_size->stocks()->first();

        // Log::info('Mostrando el primer stock disponible');
        // Log::info($stock);

        // $stock->status = Stock::SEPARADO;

        // $stock->save();

        // Log::info('Cambiando su estatus a ' . Stock::SEPARADO);
        // Log::info($stock);

        // $color_size->save();
        // //return //stock actualizado
    }


    public function devolverItems() //Restituye el stock que ha salido de almacen Stock::ALMACENADO
    {

        $quantity = $this->quantity;
        $color_size_id = $this->content->color_size_id;
        $color_size = ColorSize::find($color_size_id);
        // $color_size->quantity = $color_size->quantity + $quantity;
        // $color_size->save();

        $stocks = Stock::where('item_id', $this->id)->get();

        foreach ($stocks as $stock) {

            $stock->status = Stock::ALMACENADO;
            $stock->item_id = null;

            $stock->save();

            // Log::info('Cambiando su estatus a ' . Stock::ALMACENADO);
            // Log::info($stock);

        }

        $stock_real = $color_size->stocks()->count();
        $color_size->quantity = $stock_real;

        $color_size->save();

        //actualiza los campos "quantity" de las tablas colors y products respectivamente
        $color_size->color->updateFieldQuantity();
        $color_size->color->product->updateFieldQuantity();

        $color_size->size->quantity =  $stock_real;
        $color_size->size->save();

        //return //stock actualizado
    }

    public function getTallaRealAttribute()
    {
        $colorSize = ColorSize::find($this->content->color_size_id);
        return $colorSize->size->name;
    }

    public function showStocks()
    {

        return Stock::where('item_id', $this->id)->get();

        if ($this->content->color_size_id > 0) {

            //si esta definido el color_size_id
            $color_size = ColorSize::find($this->content->color_size_id);
            return $color_size->stockAsignado($this->id)->get();
        } else {
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // public function getImageAttribute(){
    //     $array = json_decode($this->content);

    //     return $array->file_name;
    // }
}
