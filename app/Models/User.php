<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    CONST MAIN_ID = 232;
    CONST VANE_ID = 1707;
    CONST STORE_ID = 10;

    CONST DIR_VOUCHER_PACKING = "orders/comprobantes/packing/";
    CONST DIR_VOUCHER_PAYMENTS = "orders/comprobantes/payments/";
    CONST DIR_VOUCHER_SHIPPING = "orders/comprobantes/shipping/";
    
    // CONST DIR_PRODUCTS = "products/";
    // CONST DIR_PRODUCTS_MEDIUM = "products/medium";
    // CONST DIR_PRODUCTS_THUMB = "products/thumb";

    // CONST DIR_COLORS = "products/colors";
    // CONST DIR_COLORS_THUMB = "products/colors/thumb";
    // CONST DIR_COLORS_MEDIUM = "products/colors/medium";



    // use HasApiTokens;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    protected $appends = [
        'profile_photo_url',
    ];

    //Relacion uno a muchos
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function offices()
    {
        return $this->hasMany(Address::class);
    }

    //Relacion uno a muchos
    // public function sales()
    // {
    //     return $this->hasMany(Sale::class);
    // }

    //Relacion uno a muchos

    public function stores()
    {
        return $this->belongsToMany(User::class, 'role_store_user', 'user_id', 'store_id');

        //Normalmente laravel trataria de buscar la tabla intermedia store_user
        //Pero como la que hemos definido es "role_store_user" le indicamos a laravel esa tabla en el segundo argumento de belongsToMany.
        //Finalmente tambien le decimos a laravel que el id de este modelo (user) es user_id y que el id de los stores (que tambien es la misma tabla user)
        //sera store_id que a su ves es user_id (llave foranea)

    }

    public function images(){
        return $this->morphMany(Image::class,"imageable")->orderBy('id','DESC');
    }


    public static function carriers()
    {
        return User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'carrier');
            }
        )->orderBy('id', 'desc')->get();
    }

    public static function repartidores()
    {
        return User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'repartidor');
            }
        )->get();
    }

    //Cuando sale de la base de datos
    public function getContactAttribute($value)
    {

        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }

        return json_decode($value);
    }

    //antes que ingrese a la base de datos le aplica un json_enconde
    public function setContactAttribute($value)
    {

        //Subcategoria tiene talla
        // if($this->subcategory->has_size){
        //     return ColorSize::whereHas('size.product', function(Builder $query){
        //         $query->where('id',$this->id);
        //     })->sum('quantity');
        // }
        $this->attributes['contact'] = json_encode($value);
    }


    public function getWalletAttribute($value)
    {
        return json_decode($value);
    }

    //antes que ingrese a la base de datos le aplica un json_enconde
    public function setWalletAttribute($value)
    {
        $this->attributes['wallet'] = json_encode($value);
    }

    function totalOrders(){
        return Order::where('buyer_id',$this->id)->get()->count();
    }

    
    function totalOrderMount(){
        
        $orders = Order::where('buyer_id',$this->id)->get();

        $total = 0;

        foreach ($orders as $order) {
            $total += $order->TotalMount;
        }

        return $total;
    }
    // public function getRouteKeyName()
    // {
    //     return 'nickname';
    // }

    // public function getLogoAttribute($value){
    //     if($value){
    //         return url('/') . Storage::url($value);
    //     }else{
    //         return '';
    //     }
    // }
    //Productos de los stors ///

    public function products(){
        //return Product::where('status','1')->where('store_id',$this->store->id)->get();
        // return $this->HasMany(Product::class,'store_id')->where('status','1')->with('colors', function($q){
        //     $q->has('sizes');
        // });
        //en la tabla products busca el atributo store_id (Por defecto seria user_id, pero le estamos indicando expreamente que busque store_id)
    
        return $this->HasMany(Product::class,'store_id')->where('status','1')->limit(15)->orderBy('id','desc')->with('category')->with('images')->with('colors.sizes');

        //ojo para que el json sea aninado se pone con punto '.' si no se desea anidado entonces se agrega un with mas

        /* Ejemplo 
        Anidado:     ->with('colors.sizes');
        No aninado:  ->with('colors')->with('sizes');;
        */
    
    }
    // , function($q){
    //     $q->has('sizes');
    // }
    // public function sales(){
    //     $orders = Order::where('store_id',$this->store->id)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();

    // }

    public function carousel(){

        return $this->hasMany(Carousel::class,'store_id')->where('type','web');
    }

    public function carouselMobile(){

        return $this->hasMany(Carousel::class,'store_id')->where('type','mobile');
    }

    // public function getQrYapeAttribute($value){
    //     if($value){
    //         return url('/') . Storage::url($value);
    //     }else{
    //         return '';
    //     }

    // }

    // public function getQrPlinAttribute($value){
    //     if($value){
    //         return url('/') . Storage::url($value);
    //     }else{
    //         return '';
    //     }
    // }

    public function profile(){
        return $this->hasOne(ProfileStore::class,'store_id');
    }

    public function orders(){
        //apunto a la tabla orders pero en ves de ir con user_id por defecto le indico a la funcion que lo haga con store_id
        return $this->hasMany(Order::class,'store_id');
    }

    public function myOrders(){
        return $this->hasMany(Order::class,'buyer_id');
    }
}
