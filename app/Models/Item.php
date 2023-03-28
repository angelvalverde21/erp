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

    public function separarStock()
    {

        $color_size = ColorSize::find($this->content->color_size_id);

        //se separa el stock segun la cantidad eligida
        for ($i = 0; $i < $this->quantity; $i++) {

            $stock = $color_size->stocks()->first();

            Log::info('Mostrando el primer stock disponible');
            Log::info($stock);

            $stock->status = Stock::SEPARADO;
            $stock->item_id = $this->id;

            $stock->save();

            Log::info('Cambiando su estatus a ' . Stock::SEPARADO);
            Log::info($stock);
        }

        //descontamos el stock en la base de datos
        // $color_size->quantity = $color_size->quantity - $this->quantity;

        //Guardamos el resultado en la tabla color_size
        $color_size->quantity = $color_size->stocks()->count();

        $color_size->save();
        //return //stock actualizado

    }

    public function asignarStock()
    {

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

        $color_size->quantity = $color_size->stocks()->count();

        $color_size->save();

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


    public function devolverItems()
    {

        $quantity = $this->quantity;
        $color_size_id = $this->content->color_size_id;
        $color_size = ColorSize::find($color_size_id);
        $color_size->quantity = $color_size->quantity + $quantity;
        $color_size->save();

        $stocks = Stock::where('item_id', $this->id)->get();

        foreach ($stocks as $stock) {

            $stock->status = Stock::ALMACENADO;
            $stock->item_id = null;

            $stock->save();

            // Log::info('Cambiando su estatus a ' . Stock::ALMACENADO);
            // Log::info($stock);

        }

        $color_size->quantity = $color_size->stocks()->count();

        $color_size->save();

        //return //stock actualizado
    }

    public function getTallaRealAttribute()
    {


        $colorSize = ColorSize::find($this->content->color_size_id);
        return $colorSize->size->name;
    }
    // public function getImageAttribute(){
    //     $array = json_decode($this->content);

    //     return $array->file_name;
    // }
}
