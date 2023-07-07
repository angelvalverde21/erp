<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Color extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $appends = ['image', 'thumb', 'large'];
    //Relacion muchos a muchos

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //Relacion muchos a muchos

    public function sizes()
    {

        //De forma predeterminada, solo las claves del modelo estarán presentes en el objeto pivot. Si tu tabla pivote contiene atributos extras, debes especificarlos cuando definas la relación.
        //en este caso hemos agregado el campo quantity con "->withPivot('quantity')"
        return $this->belongsToMany(Size::class)->withPivot('quantity', 'id');
    }

    public function getStockAttribute()
    {

        // //Subcategoria tiene talla
        // Log::info('Este log es del model Color');

        // Log::info($this->product->has);

        switch ($this->product->has) {
            case 'has_color_size':
                    return ColorSize::whereHas('color', function (Builder $query) {
                        $query->where('id', $this->id);
                    })->sum('quantity');
                break;

            case 'has_color':
                # code...
                break;

            case 'has_size':
                # code...
                break;

                //has_none
            default:
                # code...
                break;
        }
    }

    public function getStockTotalAttribute()
    {

        // //Subcategoria tiene talla
        // Log::info('Este log es del model Color');

        // Log::info($this->product->has);

        switch ($this->product->has) {
            case 'has_color_size':
                    return ColorSize::whereHas('color', function (Builder $query) {
                        $query->where('id', $this->id);
                    })->sum('quantity');
                break;

            case 'has_color':
                # code...
                break;

            case 'has_size':
                # code...
                break;

                //has_none
            default:
                # code...
                break;
        }
    }

    public function getImageAttribute()
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();
        //return url('/') . Storage::url($value);
    }

    
    public function getLargeAttribute()
    {

        $image = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

        if ($image) {
            return asset(Storage::url($image->large));
        } else {
            // $colors = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

            //SE COLOCA ASI PORQUE "$this->colors" genera un bucle infinito
            $color = Color::find($this->id);
            
            if($color){
                foreach ($color->images as $image) {
                    # code...
                    return asset(Storage::url($image->large));
                }
            }

            return false;
        }
        //return url('/') . Storage::url($value);
    }


    public function getThumbAttribute2()
    {
        return asset(Storage::url($this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first()->name));
        //return url('/') . Storage::url($value);
    }

    public function getThumbAttribute()
    {

        $image = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

        if ($image) {
            return asset(Storage::url($image->thumbnail));
        } else {
            // $colors = $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();

            //SE COLOCA ASI PORQUE "$this->colors" genera un bucle infinito
            $color = Color::find($this->id);
            
            if($color){
                foreach ($color->images as $image) {
                    # code...
                    return asset(Storage::url($image->thumbnail));
                }
            }

            return false;
        }

    }

    public function images()
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }

    public function updateFieldQuantity(){ //Actualiza el campo quantity de la tabla "colors" sumando el stock de todas las tallas del color

        $total_size = 0;

        foreach ($this->sizes as $size) {
            # code...
            $color_size = ColorSize::where('color_id',$this->id)->where('size_id',$size->id)->first();
            $total_size = $total_size + $color_size->stocks()->count();
        }

        $this->quantity = $total_size;
        $this->save();

    }

    public function Albums(){
        return $this->hasMany(Album::class);
    }

    // public function getInfoStockAttribute(){
    //     return $this->pivot->foo;
    // }
    //Atributo personalizado (Accesor)

    // public function getimageAttribute(){
    //     return "image";
    // }

}
