<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaAdmins extends Model
{
    protected $table='marca';

    protected $primaryKey='idmarca';

    public $timestamps=false;


    protected $fillable =[
    	//'idmarca',
    	'nombre',
    	
    ];

    protected $guarded =[

    ];
}
