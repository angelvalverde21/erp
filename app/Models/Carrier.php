<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Carrier  extends User
{
    use HasFactory;
    use HasRoles;
    
    public static function boot()
    {
        parent::boot();
 

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */

        // return User::whereHas(
        //     'roles', function($q){
        //         $q->where('name', 'carrier');
        //     }
        // )->get();

       static::addGlobalScope(function (Builder $builder){
            $builder->whereHas('roles', function($q){
                $q->where('name', 'carrier');
            });
       });

        // static::addGlobalScope(function (Builder $builder) {
        //     return $builder->whereHas('roles', function ($q) {
        //         $q->where('name', 'carrier');
        //     });
        // });

        // static::addGlobalScope(function ($query) {
        //      return $builder->whereHas('roles', function ($q) {
        //         $q->where('name', 'carrier');
        //     });
        // });
    }

}
