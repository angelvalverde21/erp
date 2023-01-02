<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;

class Product extends Model
{
    use HasFactory;

    CONST BORRADOR = 0;
    CONST PUBLICADO = 1;

    protected $guarded = ['id', 'created_at', 'image'];

    //incluir accesores a la api
    protected $appends = ['image'];

    //Uno a muchos inverso (singlular)
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    //Uno a muchos
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    //Mucho a muchos
    public function colors(){
        return $this->hasMany(Color::class)->orderBy('id','DESC');
    }

    //Uno a muchos inverso
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->morphMany(Image::class,"imageable")->orderBy('id','DESC');
    }

    public function getImageAttribute(){
        $image = $this->morphMany(Image::class,"imageable")->orderBy('id','DESC')->first();

        if($image){
            return $image->name;
        }else{
            return false;
        }
    }

    // public function setImageMainAttribute($value){
    //     return $value;
    // }

    //Creando un Accesor

    public function getStockAttribute(){
        
        //Subcategoria tiene talla
        if($this->category->has_size){
            return ColorSize::whereHas('size.product', function(Builder $query){
                $query->where('id',$this->id);
            })->sum('quantity');
        }
    }
    
}
