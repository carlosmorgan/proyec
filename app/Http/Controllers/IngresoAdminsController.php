<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoAdminsFormRequest;
use App\IngresoAdmins;
use App\DetalleIngresoAdmins;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoAdminsController extends Controller
{
    
 public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $ingresos=DB::table('compras as i')

            ->join('persona as p','i.idproveedor','=','p.idpersona')
            ->join('detalle_compras as di','i.idcompras','=','di.idcompras')
            ->select('i.idcompras','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra)as total'))

            ->where('i.num_comprobante','LIKE','%'.$query.'%')
              ->orderBy('i.idcompras','asc')
              ->groupBy('i.idcompras','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')


            ->paginate(7);
            return view('admin.compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }


    }

public function create()
{
	$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
	$articulos=DB::table('producto as art')
	->select(DB::raw('CONCAT(art.codigo," ", art.nombre) AS producto'),'art.idproducto')
	->where('art.estado','=','Activo')
	->get();
return view("admin.compras.ingreso.create",["personas"=>$personas, "articulos"=>$articulos]);
}


 public function store (IngresoAdminsFormRequest $request)
    {

      try {
      
            	DB::beginTransaction();

       $ingreso=new IngresoAdmins;
       $ingreso->idproveedor=$request->get('idproveedor');
       $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
       $ingreso->serie_comprobante=$request->get('serie_comprobante');
       $ingreso->num_comprobante=$request->get('num_comprobante');
       $mytime= Carbon::now('America/lima');
       $ingreso->fecha_hora=$mytime->toDateTimeString();
       $ingreso->impuesto='18';
          $ingreso->estado='A';
             $ingreso->save();

      $idarticulo = $request->get('idarticulo');
      $cantidad=$request->get('cantidad');
        $precio_compra=$request->get('precio_compra');
          $precio_venta=$request->get('precio_venta');

          $cont = 0;
           while($cont < count($idarticulo)){
             $detalle = new DetalleIngresoAdmins();
             $detalle->idcompras= $ingreso->idcompras; 
             $detalle->idarticulo= $idarticulo[$cont];
             $detalle->cantidad= $cantidad[$cont];
             $detalle->precio_compra= $precio_compra[$cont];
             $detalle->precio_venta= $precio_venta[$cont];
             $detalle->save();
           	$cont=$cont+1;
           }


            	DB::commit();
      	
      } catch (Exception $e) {

      	DB::rollback();
      	
      }

        return Redirect::to('admin/compras');

    }

     public function show($id)
    {
     $ingreso=DB::table('compras as i')

            ->join('persona as p','i.idproveedor','=','p.idpersona')
            ->join('detalle_compras as di','i.idcompras','=','di.idcompras')
            ->select('i.idcompras','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra)as total'))
            ->where('i.idcompras','=',$id)
            ->first();

        $detalles=DB::table('detalle_compras as d')
             ->join('producto as a','d.idarticulo','=','a.idproducto')
             ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
             ->where('d.idcompras','=',$id)
             ->get();
        return view("admin.compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }


public function destroy($id)
    {
     $ingreso=IngresoAdmins::findOrFail($id);
        $ingreso->Estado='C';
        $ingreso->update();
        return Redirect::to('admin/compras');
    }


}
