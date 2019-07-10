<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaAdmins extends Model
{
       protected $table='categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'descripcion',
    	'condicion'
    ];

    protected $guarded =[

    ];
}
