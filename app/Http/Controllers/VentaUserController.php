<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\VentaUserFormRequest;
use App\VentaUser;
use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaUserController extends Controller
{
      public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')

            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')

            ->where('v.num_comprobante','LIKE','%'.$query.'%')
              ->orderBy('v.idventa','asc')
              ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')


            ->paginate(7);
            return view("user.almacen.ventas.venta.index",["ventas"=>$ventas,"searchText"=>$query]);
        }


    }

public function create()
{
	$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();
	$articulos=DB::table('producto as art')
	->join('detalle_compras as di', 'art.idproducto','=','di.idarticulo')
	->select(DB::raw('CONCAT(art.codigo," ", art.nombre) AS producto'),
		'art.idproducto','art.stock',DB::raw('avg(di.precio_venta) as precio_promedio'))
	->where('art.estado','=','Activo')
  ->where('art.stock','>','0')
	->groupBy('producto','art.idproducto','art.stock')
	->get();
return view("user.almacen.ventas.venta.create",["personas"=>$personas, "articulos"=>$articulos]);
} 

public function store (VentaUserFormRequest $request)
    {

      try {
      
            	DB::beginTransaction();

       $venta=new VentaUser;
       $venta->idcliente=$request->get('idcliente');
       $venta->tipo_comprobante=$request->get('tipo_comprobante');
       $venta->serie_comprobante=$request->get('serie_comprobante');
       $venta->num_comprobante=$request->get('num_comprobante');
       $venta->total_venta=$request->get('total_venta');
       $mytime= Carbon::now('America/lima');
       $venta->fecha_hora=$mytime->toDateTimeString();
       $venta->impuesto='18';
       $venta->estado='A';
       $venta->save();

      $idarticulo = $request->get('idarticulo');
      $cantidad=$request->get('cantidad');
      $descuento=$request->get('descuento');
      $precio_venta=$request->get('precio_venta');

          $cont = 0;
           while($cont < count($idarticulo)){
             $detalle = new DetalleVenta();
             $detalle->idventa= $venta->idventa; 
             $detalle->idarticulo= $idarticulo[$cont];
             $detalle->cantidad= $cantidad[$cont];
             $detalle->descuento= $descuento[$cont];
             $detalle->precio_venta= $precio_venta[$cont];
             $detalle->save();
           	$cont=$cont+1;
           }


            	DB::commit();
      	
      } catch (Exception $e) {

      	DB::rollback();
      	
      }

        return Redirect::to('user/venta');

    }

     public function show($id)
    {
     $venta=DB::table('venta as v')

            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('producto as a','d.idarticulo','=','a.idproducto')
             ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();
        return view("user.almacen.ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }


public function destroy($id)
    {
     $venta=VentaUser::findOrFail($id);
        $ventaUser->Estado='C';
        $ventaUser->update();
        return Redirect::to('user/venta');
    }

}

