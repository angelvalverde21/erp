<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    const PUBLICADO = 1;
    const BORRADOR = 2;
    const ELIMINADO = 3;
    const ARCHIVADO = 4;

    protected $guarded = ['id', 'created_at'];
    // protected $guarded = ['id', 'created_at', 'image'];
    // protected $fillable = ['title'];

    //incluir accesores a la api
    protected $appends = ['has','thumb'];

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

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    //Mucho a muchos
    public function colors()
    {
        return $this->hasMany(Color::class)->orderBy('quantity', 'DESC');
    }

    public function prices(){
        return $this->morphMany(Price::class, "priceable")->orderBy('quantity', 'ASC');
    }
    
    //Uno a muchos inverso
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function medidas(){
        return $this->morphMany(Image::class,"imageable")->where('usage','medidas_producto')->limit(5)->orderBy('id','DESC');
    }

    public function images() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }

    public function getImageAttribute()
    {

        $image = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

        if ($image) {
            return $image->name;
        } else {
            // $colors = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

            //SE COLOCA ASI PORQUE "$this->colors" genera un bucle infinito
            $product = Product::find($this->id);

            foreach ($product->colors as $color) {
                # code...
                foreach ($color->images as $image) {
                    # code...
                    return asset(Storage::url($image->name));
                }
            }

            return false;
        }

    }

    public function getThumbAttribute()
    {

        $image = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

        if ($image) {
            return $image->name;
        } else {
            // $colors = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

            //SE COLOCA ASI PORQUE "$this->colors" genera un bucle infinito
            $product = Product::find($this->id);

            foreach ($product->colors as $color) {
                # code...
                foreach ($color->images as $image) {
                    # code...
                    return asset(Storage::url($image->name));
                }
            }

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

    public function getHowSellAttribute()
    {

        $over_sale = $this->over_sale;
        $force_size_unique = $this->force_size_unique;

        if ($over_sale && $force_size_unique) { //AND
            return "OVERSALE_FORCE_SIZE_UNIQUE";
        }

        if ($over_sale && !$force_size_unique) { //AND
            return "OVERSALE";
        }

        if (!$over_sale && $force_size_unique) { //AND
            return "FORCE_SIZE_UNIQUE";
        }

        if (!$over_sale && !$force_size_unique) { //AND
            return "NORMAL";
        }
    }

    public function updateFieldQuantity()
    {

        $total_color = 0;

        foreach ($this->colors as $color) {

            # code...
            $total_color = $total_color + $color->quantity;

        }

        $this->quantity = $total_color;

        $this->save();

    }

    public function image()
    {

        if($this->images->count() > 0){

            return $this->images->first()->name;
            
        }else{
            
            $firstColor =  $this->colors->first();

            return $firstColor->image->name;

        }

    }

    public function thumb()
    {

        // return $this->with('colors')->count(); 


        if($this->images->count() > 0){

            return $this->images->first()->name;
            
        }else{
            
            $firstColor =  $this->colors->first();

            return $firstColor->image->name;

        }

    }

}
