<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = "payment_methods";
    protected $guarded = ['id', 'created_at', 'updated_at'];
    use HasFactory;

    public function lists(){

        //De forma predeterminada, solo las claves del modelo estarán presentes en el objeto pivot. Si tu tabla pivote contiene atributos extras, debes especificarlos cuando definas la relación.
        //en este caso hemos agregado el campo quantity con "->withPivot('quantity')"
        //return $this->belongsToMany(PaymentList::class)->withPivot('quantity','id');
        return $this->belongsToMany(PaymentList::class, 'payment_list_method', 'payment_method_id', 'payment_list_id');
        //OJO order_id pertenece al modelo de Order.php y status_id es de la tabla foarenea
    }
    
}
