<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = "color_size";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // protected $appends = ['info'];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function stocks()
    {
        // return $this->morphMany(Stock::class, "stockable")->where('status', Stock::ALMACENADO)->orderBy('id', 'DESC');
        // return $this->morphMany(Stock::class, "stockable")->where('status', Stock::ALMACENADO)->orWhere('status', Stock::SEPARADO)->orderBy('id', 'DESC');
        return $this->morphMany(Stock::class, "stockable")->whereIn('status', [Stock::ALMACENADO, Stock::SEPARADO])->orderBy('id', 'DESC');

    }

    public function stocksBruto()
    {
        // return $this->morphMany(Stock::class, "stockable")->where('status', Stock::ALMACENADO)->orderBy('id', 'DESC');
        // return $this->morphMany(Stock::class, "stockable")->where('status', Stock::ALMACENADO)->orWhere('status', Stock::SEPARADO)->orderBy('id', 'DESC');
        return $this->morphMany(Stock::class, "stockable")->orderBy('id', 'DESC');
    }
    
    public function stockAsignado($itemId){
        return $this->morphMany(Stock::class, "stockable")->where('status', Stock::SEPARADO)->where('item_id',$itemId)->orderBy('id', 'DESC');
    }

    public function agregarStock($quantity) //quantity es quantityAdd
    {

        //quantity es la variable que viene del input, que ha ingresado el usuario, trayendo el stock adicional que se va a ingresar en la base de datos

        //crea una lista en la tabla "stocks"

        if ($quantity > 0) {
            for ($j = 0; $j < $quantity; $j++) {
                $this->stocks()->create(
                    [
                        'barcode' => 1000000000
                    ]
                );
            };
        }

        //grabando el stock real en la base de datos
        //modifica el campo "quantity" de la tabla "color_size"

        /****************** SETEANDO EL STOCK DE LA TALLA ESPECIFICA ******************/

        $total_real = $this->stocks()->count();
        $this->quantity = $total_real;
        $this->save();

        // $this->update([
        //         'quantity' => $this->stocks()->count()
        //     ]
        // );

        /****************** SETEANDO EL STOCK DEL COLOR ******************/
        $this->color->updateFieldQuantity();

        /****************** SETEANDO EL STOCK DE TODO EL PRODUCTO ******************/

        //OJOS: Esta funcion tomas los valores del campo quantity de la tabla colors
        //por lo que siempre tiene que ser ejecutada despues de $this->color->updateFieldQuantity()
        $this->color->product->updateFieldQuantity();

        /****************** SETEANDO EL STOCK EN LA TABLA "SIZES" ******************/
        $this->size->quantity = $total_real;
        $this->size->save();

        // Log::info('Stock real');
    }

    // public function getInfotAttribute(){

    //     if ($this->quantity>0) {
    //         # code...
    //         return "DISPONIBLE";
    //     } else {
    //         return "AGOTADO";
    //     }

    // }

    public function recalcularStock(){

        $stock_real = $this->stocks()->count();

        $this->quantity = $stock_real;
        $this->save();
        //return //stock actualizado


        //actualiza los campos "quantity" de las tablas colors y products respectivamente
        $this->color->updateFieldQuantity();
        $this->color->product->updateFieldQuantity();

        //Este caso la tabla size y la tabla color_size tiene el mismo quantity
        $this->size->quantity = $stock_real;
        $this->size->save();

    }

}
