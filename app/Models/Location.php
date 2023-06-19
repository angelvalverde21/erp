<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function images() //ojo images se llama en las consultas directamente con el metodo ->with('images), no se llama desde appends
    {
        return $this->morphMany(Image::class, "imageable")->orderBy('id', 'DESC');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }


}
