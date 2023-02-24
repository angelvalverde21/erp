<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = [
        'priceable_type',
        'priceable_id',
        'created_at',
        'updated_at',
    ];

    public function priceable(){
        return $this->morphTo();
    }

}
