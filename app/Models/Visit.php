<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // public function getRequestAttribute($value)
    // {
    //     return json_decode($value);
    // }

    // public function setRequestAttribute($value)
    // {
    //     $this->attributes['request'] = json_encode($value);
    // }

}
