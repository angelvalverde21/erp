<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    //relacion uno a muchos inversa

    public function product(){
        return $this->belongsTo(Product::class);
    }

    //Relacion muchos a muchos

    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }

    //Atributo personalizado (Accesor)
    
    public function getOptionAttribute(){
        
        $options = [
		
            [
                'array_name' => 'ESTANDAR',
                'description' => ''
            ],
            [
                'array_name' =>'ESTANDAR,L',
                'description' => ''
            ],
            [
                'array_name' =>'S,M,L',
                'description' => ''
            ],
            [
                'array_name' =>'S,M',
                'description' => ''
            ],
            [
                'array_name' =>'M,L',
                'description' => ''
            ],
            [
                'array_name' =>'XS,S,M,L,XL',
                'description' => ''
            ],
            [
                'array_name' =>'26,28,30,32,34,36,38',
                'description' => 'Ideal para pantalones'
            ],
        
        ];

        //Subcategoria tiene talla
        
            return $options;
        
    }

}
