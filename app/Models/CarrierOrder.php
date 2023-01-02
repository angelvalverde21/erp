<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrierOrder extends Model
{
    protected $table = "carrier_order";
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory;
}
