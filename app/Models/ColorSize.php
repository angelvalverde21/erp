<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = "color_size";
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // protected $appends = ['info'];

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function stocks(){
        return $this->morphMany(Stock::class,"stockable")->orderBy('id','DESC');
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
