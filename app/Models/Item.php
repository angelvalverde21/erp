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



    //Luego que sale de la base de datos le aplica un json_decode
    public function getOriginalAttribute($value)
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
    public function setOriginalAttribute($value)
    {

        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }
        $this->attributes['original'] = json_encode($value);
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

        $stocks = $color_size->stocks()->get();

        $i = 0;

        foreach ($stocks as $stock) {
            # code...
            $i++;

            //solo procesaremos la cantidad que ha pedido el cliente
            if ($i <= $quantity) {
                # code...

                Log::info('Mostrando el primer stock disponible');
                Log::info($stock);
    
                $stock->status = Stock::SEPARADO;
                $stock->item_id = $this->id;
    
                $stock->save();
    
                Log::info('Cambiando su estatus a ' . Stock::SEPARADO);
                Log::info($stock);
            }else{
                break;
            }

        }


        // for ($i = 0; $i < $quantity; $i++) {

        //     $stock = $color_size->stocks()->first();

        //     if ($stock) {   

        //         Log::info('Mostrando el primer stock disponible');
        //         Log::info($stock);

        //         $stock->status = Stock::SEPARADO;
        //         $stock->item_id = $this->id;

        //         $stock->save();

        //         Log::info('Cambiando su estatus a ' . Stock::SEPARADO);
        //         Log::info($stock);

        //     } else {
        //         Log::info('No hay suficiente stock');
        //     }
        // }

        //descontamos el stock en la base de datos
        // $color_size->quantity = $color_size->quantity - $this->quantity;

        //Guardamos el resultado en la tabla color_size
        // $stock_real = $color_size->stocks()->count();
        // $color_size->quantity = $stock_real;
        // $color_size->save();
        // //return //stock actualizado


        // //actualiza los campos "quantity" de las tablas colors y products respectivamente
        // $color_size->color->updateFieldQuantity();
        // $color_size->color->product->updateFieldQuantity();
        // $color_size->size->quantity = $stock_real;
        // $color_size->size->save();

        $color_size->recalcularStock();
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

            Log::info('stock: '. $i);

            //primero se busca el stock reservado
            $stock = Stock::where('item_id', $this->id)->where('status',Stock::SEPARADO)->first();

            //sino se encuentra el stock que se le separo originalemente
            if (!$stock) {
                # code...
                //Buscara entre un ALMACENADO o un SEPARADO asi perteneesca a otra orden, porque si se asigna es porque e
                //pedido ya esta pagado o entregado asi que se le da prioridad al item de la orden respectiva
                $stock = $color_size->stocks()->first(); 
            }

            $stock->status = Stock::VENDIDO;
            $stock->item_id = $this->id;

            $stock->save();
        }


        $color_size->recalcularStock();

        // $stock_real = $color_size->stocks()->count();
        // $color_size->quantity = $stock_real;

        // $color_size->save();

        // //actualiza los campos "quantity" de las tablas colors y products respectivamente
        // $color_size->color->updateFieldQuantity();
        // $color_size->color->product->updateFieldQuantity();


        // //Este caso la tabla size y la tabla color_size tiene el mismo quantity
        // $color_size->size->quantity = $stock_real;

        // $color_size->size->save();



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

        // $quantity = $this->quantity;

        $color_size_id = $this->content->color_size_id;
        $color_size = ColorSize::find($color_size_id);
        // $color_size->quantity = $color_size->quantity + $quantity;
        // $color_size->save();

        //Busca en la tabla stock cuantos item_id hay, ese numero es la cantidad pedida por el usuario y hay que retornarlo
        $stocks = Stock::where('item_id', $this->id)->get();

        foreach ($stocks as $stock) {

            $stock->status = Stock::ALMACENADO;
            $stock->item_id = null;

            $stock->save();

            // Log::info('Cambiando su estatus a ' . Stock::ALMACENADO);
            // Log::info($stock);

        }

        $color_size->recalcularStock();
        // $stock_real = $color_size->stocks()->count();
        // $color_size->quantity = $stock_real;

        // $color_size->save();

        // //actualiza los campos "quantity" de las tablas colors y products respectivamente
        // $color_size->color->updateFieldQuantity();
        // $color_size->color->product->updateFieldQuantity();

        // $color_size->size->quantity =  $stock_real;
        // $color_size->size->save();

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

    public function stocks()
    {
        
        // return $this->belongsToMany(Stock::class, 'item_stock', 'item_id', 'stock_id')
        //             ->withPivot('cantidad');

        return $this->hasMany(Stock::class);

    }
}
