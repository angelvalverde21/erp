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
        return $this->morphMany(Stock::class, "stockable")->where('status',Stock::ALMACENADO)->orderBy('id', 'DESC');
    }

    public function updateAlmacen($quantity) //quantity es quantityAdd
    {


        $this->update(
            [
                'quantity' => $quantity
            ]
        );

        //quantity es la variable que viene del input, que ha ingresado el usuario, trayendo el stock adicional que se va a ingresar en la base de datos

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

        $this->update(
            [
                'quantity' => $this->stocks()->count()
            ]
        );

        //$this->quantity = $this->stocks()->count(); //el stockReal es el stock fisico
        //$stockReal = $this->stocks()->count(); //Este es el stock fisico actual antes de actualizar
        Log::info('Stock real');

        //Log::info($stockReal);

        //Codigo para agregar registros de stock
        // for ($k = 0; $k < $this->inputs[$keys[$i]]['quantity']; $k++) {
        //     # code...
        //     $colorSize->stocks()->create([
        //         'barcode' => '124524'
        //     ]);
        // }

    }

    // public function getInfotAttribute(){

    //     if ($this->quantity>0) {
    //         # code...
    //         return "DISPONIBLE";
    //     } else {
    //         return "AGOTADO";
    //     }

    // }

}
