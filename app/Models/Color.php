<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Color extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacion muchos a muchos

    public function product(){
        return $this->belongsTo(Product::class);
    }

   //Relacion muchos a muchos

   public function sizes(){

        //De forma predeterminada, solo las claves del modelo estarán presentes en el objeto pivot. Si tu tabla pivote contiene atributos extras, debes especificarlos cuando definas la relación.
        //en este caso hemos agregado el campo quantity con "->withPivot('quantity')"
        return $this->belongsToMany(Size::class)->withPivot('quantity','id');
    }

    public function getStockAttribute(){
        
        //Subcategoria tiene talla
        
            return ColorSize::whereHas('color', function(Builder $query){
                $query->where('id',$this->id);
            })->sum('quantity');
        
    }

    public function getImageAttribute($value){
        return $this->morphMany(Image::class,"imageable")->orderBy('id','DESC')->first();
        //return url('/') . Storage::url($value);
    }

    public function images(){
        return $this->morphMany(Image::class,"imageable")->orderBy('id','DESC');
    }

}
