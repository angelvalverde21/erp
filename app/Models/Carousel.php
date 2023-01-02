<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Carousel extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'image'];


    public function getImageAttribute($value){
        return url('/') . Storage::url($value);
    }
}
