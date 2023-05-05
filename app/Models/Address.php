<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    CONST PUBLICADO = 1;
    CONST BORRADO = 2;
    
    public function addressable(){
        return $this->morphTo();
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function showAll($user_id){
        return Address::where('user_id', $user_id)->where('status', Address::PUBLICADO)->orderBy('updated_at', 'desc')->get();
    }

    // public static function showAllDelete($user_id){
    //     return Address::where('user_id', $user_id)->where('status', Address::BORRADO)->orderBy('updated_at', 'desc')->get();
    // }

    // public static function show($user_id){
    //     return Address::where('user_id', $user_id)->where('status', Address::BORRADO)->orderBy('updated_at', 'desc')->get();
    // }

}
