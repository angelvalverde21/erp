<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;

class Product extends Model
{
    use HasFactory;

    const PUBLICADO = 1;
    const BORRADOR = 2;
    const ELIMINADO = 3;

    protected $guarded = ['id', 'created_at', 'image'];

    //incluir accesores a la api
    protected $appends = ['image','has'];

    //Uno a muchos inverso (singlular)
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    //Uno a muchos
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    //Mucho a muchos
    public function colors()
    {
        return $this->hasMany(Color::class)->orderBy('id', 'DESC');
    }

    //Uno a muchos inverso
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }

    public function getImageAttribute()
    {
        $image = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

        if ($image) {
            return $image->name;
        } else {
            return false;
        }
    }

    // public function setImageMainAttribute($value){
    //     return $value;
    // }

    //Creando un Accesor

    public function getStockAttribute()
    {

        //Subcategoria tiene talla
        if ($this->category->has_size) {
            return ColorSize::whereHas('size.product', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        }
    }

    public function getHasAttribute()
    {

        $has_color = $this->category->has_color;
        $has_size = $this->category->has_size;

        if ($has_color && $has_size) { //AND

            return "has_color_size";
            //el producto tiene color y talla
        } else {
            if ($has_color || $has_size) { //OR
                if ($has_color) {
                    //el producto tiene solo color
                    return "has_color";
                }else{
                    if ($has_size) {
                        //el producto tiene solo talla
                        return "has_size";
                    }
                }
            } else {
                //el producto no tiene ni color ni talla
                return "has_none";
            }
        }

    }
}
