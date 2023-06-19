<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'image'];

    //Relacion muchos a muchos con locations
    
    public function locations()
    {
        return $this->belongsToMany(Location::class)->withPivot('id')->orderBy('album_location.id', 'DESC');
    }

    public function images() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }

    public function photos() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphMany(Photo::class, "photoable")->orderBy('id', 'DESC');
    }

    public function albumable(){
        return $this->morphTo();
    }

    public function modelo(){
        return $this->belongsTo(User::class);
    }

    public function address() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphOne(Address::class, "addressable")->orderBy('id', 'DESC');
    }


}
