<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    use HasFactory;

    const CONTRAENTREGA = 1;
    const PREVIODEPOSITO = 2;

    const RECOJO = 1;
    const DELIVERY = 2;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relacino uno a uno polimorfica

    public function cordenada()
    {
        return $this->morphOne(Coordinate::class, 'coordinateable');
        //ojo coordinateable es el nombre del metodo que se encuentra en el modelo Coordinate
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }


    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class); //en la tabla orders busca el atributo 'buyer_id' y le hace un where a la tabla Users
    }

    public function seller()
    {
        return $this->belongsTo(User::class); //en la tabla orders busca el atributo 'seller_id' y le hace un where a la tabla Users
    }

    public function store()
    {
        return $this->belongsTo(User::class);
    }

    public function delivery_man()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function carrier_address()
    {
        return $this->belongsTo(Address::class);    //en la tabla orders busca el atributo 'carrier_address_id' y le hace un where a la tabla Addresses
    }

    public function status()
    {
        return $this->belongsToMany(Status::class, 'order_status', 'order_id', 'status_id')->withPivot('created_at', 'updated_at', 'id')->orderByPivot('created_at', 'desc');
        //OJO order_id pertenece al modelo de Order.php y status_id es de la tabla foarenea
    }

    public function getTotalProductsAttribute()
    {
        $items = Item::where('order_id', $this->id)->sum('quantity');

        return $items;
        //Subcategoria tiene talla

        // return Order::whereHas('items', function(Builder $query){

        //     $query->whereHas('items', function($q){
        //         $q->where('order_id', $this->id);
        //     });

        //     $query->where('order_id',$this->id);
        // })->sum('quantity');

    }

    public function getMessagenCalendarAttribute()
    {

        $deliveryDate = strtotime($this->delivery_date);
        $currentDate = strtotime(date('Y-m-d'));

        Log::info("Delivery_date: " . $deliveryDate);
        Log::info("CurrentDate: " . $currentDate);

        Log::info("Delivery_date: " . $this->delivery_date);
        Log::info("CurrentDate: " . date('Y-m-d'));

        $unDia = 86400;

        if ($deliveryDate == $currentDate) {
            return "Hoy";
        } elseif (($currentDate + $unDia) == $deliveryDate) {
            return "Mañana";
        } else {
            return "";
        }
    }

    //Plural
    public function getPaymentMethodsAttribute()
    {

        return PaymentMethod::all();
    }

    //Singular
    public function getPaymentMethodAttribute()
    {

        $paymentListMethod = PaymentListMethod::find($this->payment_list_method_id);

        return PaymentMethod::find($paymentListMethod->payment_method_id);
    }

    //Plural
    public function getPaymentListsAttribute()
    {

        return PaymentList::all();
    }

    //Singular
    public function getPaymentListAttribute()
    {

        $paymentListMethod = PaymentListMethod::find($this->payment_list_method_id);

        return PaymentList::find($paymentListMethod->payment_list_id);
    }



    public function getSubTotalAttribute()
    {

        $precio_lista = Item::where('order_id', $this->id)->sum(DB::raw('price * quantity'));

        if ($precio_lista > $this->total_final) {
            return number_format($precio_lista, 2, '.', '');
        } else {
            return number_format($this->total_final, 2, '.', '');
        }
    }

    public function getTotalFinalAttribute()
    {

        // $colorSize = ColorSize::find($this->content->size_id);
        // return $colorSize->size->name; 

        $items = Item::where('order_id', $this->id)->get();
        $precioFinal = 0;

        foreach ($items as $item) {
            if (isset($item->content->price)) {
                $precioFinal += ($item->content->price * $item->quantity);
            }
        }

        //$precioFinal = $precioFinal + $this->shipping_cost;

        return number_format($precioFinal, 2, '.', '');
    }

    //Este es el costo total que pagara el cliente incluido los costos de envio
    public function getTotalMountAttribute()
    {
        return number_format($this->total_final + $this->shipping_cost_buyer, 2, '.', '');
    }

    // public function getRepartidoresAttribute(){
    //     return User::repartidores();
    // }

    public function getDescuentosAttribute()
    {

        $descuento =  $this->sub_total - $this->total_final;

        if ($descuento > 0) {
            return number_format($descuento, 2, '.', '');
        } else {
            return 0;
        }
    }

    public function Addstatus(string $statusValue, $current)
    {

        Log::info('OrderController: ' . $statusValue);

        if ($statusValue) {

            Log::info('query: name ' . $statusValue);
            $status = Status::where('name', $statusValue)->first();
            Log::info('Status: ' . $status);
            Log::info('Status ingresado: ' . $statusValue);
            Log::info('Status id: ' . $status->id);
            $orderStatus = new OrderStatus();
            $orderStatus->order_id = $this->id;
            $orderStatus->status_id = $status->id;
            $orderStatus->save();

            $data = json_decode($current);

            //$orderStatus->cordenada()->create([json_decode($request->current)]);
            $orderStatus->coordinates()->create([
                'latitud' => $data->latitud,
                'longitud' => $data->longitud,
                'gps_radio' => $data->gps_radio,
                'url_current' => $data->url_current,
                'screen' => $data->screen,
                'message' => $data->message,
                'tipo_red' => $data->tipo_red,
                'user_agent' => $data->user_agent,
                'vendor' => $data->vendor
            ]);
        }
    }

    //Las funciones que no tienen get y attribute son usadas de la forma $order->nombrefuncion()
    //Pero las que si tienen son usadas sin los parentesis

    public function consultarStatus($value)
    {

        $status = Status::where('name', $value)->first();

        if ($status) {
            Log::info($status);
            $orderStatus = OrderStatus::where('order_id', $this->id)->where('status_id', $status->id)->count();

            if ($orderStatus > 0) {
                return true;
                //return "se encontro: " . $value;
            } else {
                return false;
                //return "No se encontro: " . $value;
            }
        } else {
            //return "No se encontro 2: " . $value;
            return false;
        }
    }


    //Relacion uno a muchos polimorfica
    public function coordinates()
    {
        //Tabla polimorfica uno a uno
        //return $this->morphOne(Coordinate::class,'coordinateable');

        //Tabla polimorfica uno a muchos
        return $this->morphMany(Coordinate::class, 'coordinateable');
        //ojo "coordinateable" es el nombre del metodo que se encuentra en el modelo Coordinate


    }
}
