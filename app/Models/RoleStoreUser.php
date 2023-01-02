<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleStoreUser extends Model
{
    use HasFactory;

    protected $table = "role_store_user";

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
