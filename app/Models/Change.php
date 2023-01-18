<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function changeable(){
        return $this->morphTo();
    }

    //Luego que sale de la base de datos le aplica un json_decode
    public function getContentAttribute($value){
        return json_decode($value);
    }

    //antes que ingrese a la base de datos le aplica un json_enconde
    public function setContentAttribute($value){
        if ($value) {
            $this->attributes['content'] = json_encode($value);
        } else {
            $this->attributes['content'] = null;
        }
    }
}
