<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresoAdmins extends Model
{
     protected $table='compras';

    protected $primaryKey='idcompras';

    public $timestamps=false;


    protected $fillable =[
    	'idproveedor',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'estado'


    ];

    protected $guarded =[

    ];
}
