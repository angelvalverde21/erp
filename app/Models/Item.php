<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    //Luego que sale de la base de datos le aplica un json_decode
    public function getContentAttribute($value){
        
        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }

        return json_decode($value);
    }

    //antes que ingrese a la base de datos le aplica un json_enconde
    public function setContentAttribute($value){
        
        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }
        $this->attributes['content'] = json_encode($value);

    }
    // public function getTallaRealAttribute(){

    // }

    public function getTallaImpresaAttribute(){
        return $this->content->talla;
    }

    public function getTallaVirtualAttribute(){
        return $this->content->talla;
    }

    public function getPrecioFinalAttribute(){

        if(isset($this->content->price)){
            return $this->content->price;
        }else{
            return $this->price;
        }
        
    }

    public function getTallaRealAttribute(){


        $colorSize = ColorSize::find($this->content->color_size_id);
        return $colorSize->size->name;
    }
    // public function getImageAttribute(){
    //     $array = json_decode($this->content);

    //     return $array->file_name;
    // }
}
