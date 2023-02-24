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
    protected $appends = ['image', 'stock_total'];
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

    public function getImageAttribute($value)
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC')->first();
        //return url('/') . Storage::url($value);
    }

    public function images()
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }


    // public function getInfoStockAttribute(){
    //     return $this->pivot->foo;
    // }
    //Atributo personalizado (Accesor)

    // public function getimageAttribute(){
    //     return "image";
    // }

}
