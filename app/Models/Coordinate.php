<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
 
    //El nombre  del metodo debe ser llamado con un morphOne desde el modelo correspondiente
    public function coordinateable()
    {
        //Tabla polimorfica uno a uno//
        //return $this->morphTo();

        //Tabla polimorfica uno a muchos
        return $this->morphTo();
    }
}
