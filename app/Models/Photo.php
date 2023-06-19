<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'names3','usage','label', 'photoable_id', 'photoable_type'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $hidden = [
        'photoable_type',
        'photoable_id',
        'created_at',
        'updated_at',
    ];

    public function photoable(){
        return $this->morphTo();
    }

    
    //Luego que sale de la base de datos le aplica un json_decode
    public function getExifAttribute($value)
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
    public function setExifAttribute($value)
    {

        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }
        $this->attributes['exif'] = json_encode($value);
    }

    // public function getNameAttribute($value){

    //     $data = explode('/',$value);

    //     return url('/') . Storage::url($value);
    // }

    // public function SetNameAttribute($value){
    //     return url('/') . Storage::url($value);
}
