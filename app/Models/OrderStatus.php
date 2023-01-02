<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{

    use HasFactory;

    protected $table = "order_status";

    protected $guarded = ['id', 'created_at', 'updated_at'];



    //Relacion uno a muchos polimorfica
    public function coordinates(){
        //Tabla polimorfica uno a uno
        //return $this->morphOne(Coordinate::class,'coordinateable');
        
        //Tabla polimorfica uno a muchos
        return $this->morphMany(Coordinate::class,'coordinateable');
        //ojo "coordinateable" es el nombre del metodo que se encuentra en el modelo Coordinate

 
    } 

    
}
