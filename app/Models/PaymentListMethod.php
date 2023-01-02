<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentListMethod extends Model
{
    use HasFactory;

    protected $table = "payment_list_method";
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function PaymentMethod(){

        return $this->belongsTo(PaymentMethod::class);

    }

    public function PaymentList(){

        return $this->belongsTo(PaymentList::class);

    }

}
