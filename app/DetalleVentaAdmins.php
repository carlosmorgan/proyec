<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaAdmins extends Model
{

	   protected $table='detalle_venta';

    protected $primaryKey='iddetalle_venta';

    public $timestamps=false;


    protected $fillable =[
    	'idventa',
    	'idarticulo',
    	'cantidad',
    	'precio_venta',
    	'descuento'


    ];

    protected $guarded =[

    ];    
}
