<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngresoAdmins extends Model
{
     protected $table='detalle_compras';

    protected $primaryKey='iddetalle_compras';

    public $timestamps=false;


    protected $fillable =[
    	'idcompras',
    	'idarticulo',
    	'cantidad',
    	'precio_compra',
    	'precio_venta'


    ];

    protected $guarded =[

    ];
}
