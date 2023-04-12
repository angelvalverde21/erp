<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    const ALMACENADO = 1;
    const SEPARADO = 2;
    const VENDIDO = 3;
    const OBSERVADO = 4;

    protected $table = "stocks";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function stockable()
    {
        return $this->morphTo();
    }

    
    public function eliminarColorSize()
    {

        Log::info('id stock');

        $stock = Stock::findOrFail($this->id);

        $colorSize = ColorSize::findOrFail($stock->stockable_id);

        Log::info($stock->id);

        //$stockActual = Stock::where('stockable_id',$stock->stockable_id)->count();
        $stockActual = $colorSize->stocks()->count();

        if (($stockActual - 1) > 0) {

            //Actualizando el campo "quantity" de la tabla "color_size"
            $colorSize->quantity = $stockActual - 1;

            //Actualizando el campo "quantity" de la tabla "sizes"
            $colorSize->size->quantity = $stockActual - 1;

        } else {

            $colorSize->quantity = 0;
            $colorSize->size->quantity = 0;
            
        }

        $colorSize->size->save();

        $colorSize->save();

        Log::info('stock actual');

        Log::info($stockActual);

        $this->delete();

        $colorSize->color->updateFieldQuantity();
        $colorSize->color->product->updateFieldQuantity();
    }

}
