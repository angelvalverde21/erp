<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'imageable_id', 'imageable_type'];

    public function imageable(){
        return $this->morphTo();
    }

    public function getNameAttribute($value){
        return url('/') . Storage::url($value);
    }

    // public function SetNameAttribute($value){
    //     return url('/') . Storage::url($value);
    // }

}
