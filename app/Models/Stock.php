<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    const ALMACENADO = 1;
    const SEPARADO = 2;
    const VENDIDO = 3;
    const OBSERVADO = 4;

    protected $table = "stocks";

    protected $guarded = ['id','created_at','updated_at'];

    public function stockable(){
        return $this->morphTo();
    }


}
