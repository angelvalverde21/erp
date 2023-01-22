<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = "stocks";

    protected $guarded = ['id','created_at','updated_at'];

    public function stockable(){
        return $this->morphTo();
    }


}
