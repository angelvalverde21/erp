<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumLocation extends Model
{
    use HasFactory;

    protected $table = "album_location";

    protected $guarded = ['id', 'created_at', 'updated_at'];
    

    public function images() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }

    public function photos() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphMany(Photo::class, "photoable")->orderBy('id', 'DESC');
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
}
