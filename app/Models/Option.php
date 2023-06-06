<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $hidden = [
        'imageable_type',
        'imageable_id',
        'created_at',
        'updated_at',
    ];

    public function optionable(){
        return $this->morphTo();
    }

    // ruc
    // logo
    // logo_invoice
    // upload_qr_yape
    // upload_qr_plin
    // profile_photo_path
    // wallet
    // contact

    // title
    // ship_min
    // maps
    // domain
    // instagram
    // tiktok
    // facebook
    // whatsapp

}