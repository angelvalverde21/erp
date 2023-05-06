<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'names3','usage','label', 'imageable_id', 'imageable_type'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $hidden = [
        'imageable_type',
        'imageable_id',
        'created_at',
        'updated_at',
    ];

    public function imageable(){
        return $this->morphTo();
    }

    // public function getNameAttribute($value){

    //     $data = explode('/',$value);

    //     return url('/') . Storage::url($value);
    // }

    public function getNameS3Attribute(){

        // {{ Storage::disk('s3')->url($value) }}

        return Storage::disk('s3')->url($this->name);
    }  

    public function getNameS3ThumbAttribute(){

        // {{ Storage::disk('s3')->url($value) }}

        $name = explode('/',$this->name);

        if ($name[0] && isset($name[1])) {
            # code...
            return Storage::disk('s3')->url($name[0].'/thumb-'.$name[1]);
        } else {
            # code...
            return 'error';
        }
        
    }   

    // public function SetNameAttribute($value){
    //     return url('/') . Storage::url($value);
    // }

}
