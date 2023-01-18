<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    
    public function status()
    {
        return $this->belongsTo(PaymentStatus::class,'payments_status_id');  //en la tabla payments busca el atributo 'payments_status_id' y le hace un where a la tabla payments_status
    }


    public function paymentable(){
        return $this->morphTo();
    }

    public function getContentAttribute($value){
        return json_decode($value);
    }

    public function setContentAttribute($value){
        $this->attributes['content'] = json_encode($value);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
