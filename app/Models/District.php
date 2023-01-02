<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function province(){
        return $this->belongsTo(Province::class);
    }
}
