<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloUser extends Model
{
   protected $table='producto';

    protected $primaryKey='idproducto';

    public $timestamps=false;


    protected $fillable =[
    	'idcategoria',
    	'idmarca',
    	'codigo',
    	'nombre',
    	'stock',
    	'descripcion',
    	'imagen',
    	'estado'


    ];

    protected $guarded =[

    ];
}
