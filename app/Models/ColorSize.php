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

    public function updateAlmacen($quantity)
    {

        $stockReal = $this->stocks()->count();

        $this->update(
            [
                'quantity' => $quantity
            ]
        );

        Log::info('Stock real');

        Log::info($stockReal);

        if ($quantity - $stockReal > 0) {
            for ($j = 0; $j < $quantity - $stockReal; $j++) {
                $this->stocks()->create(
                    [
                        'barcode' => 1000000000
                    ]
                );
            };
        }



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
