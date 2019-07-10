<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticuloUserFormRequest;
use App\ArticuloUser;
use DB;

class ArticuloUserController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $articulos=DB::table('producto as p')
            ->join('categoria as c', 'p.idcategoria','=','c.idcategoria')
            ->join('marca as m', 'p.idmarca','=','m.idmarca')
            ->select('p.idproducto','p.nombre','p.codigo','p.stock','c.nombre as categoria','m.nombre as marca','p.descripcion','p.imagen','p.estado')
            ->where('p.nombre','LIKE','%'.$query.'%')
             ->orwhere('p.codigo','LIKE','%'.$query.'%')
           // ->where ('condicion','=','1')
            ->orderBy('p.idproducto','asc')
            ->paginate(4);
            return view('user.almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $categorias=DB::table('categoria') ->get();
      $marca=DB::table('marca') ->get();

        return view("user.almacen.articulo.create",["categorias"=>$categorias, "marca"=>$marca]);

    
    }
    public function store (ProductosUsersFormRequest $request)
    {
      $articulo=new ProductosUsers;
      $articulo->idcategoria=$request->get('idcategoria');
       $articulo->idmarca=$request->get('idmarca');
       $articulo->codigo=$request->get('codigo');
       $articulo->nombre=$request->get('nombre');
       $articulo->stock=$request->get('stock');
       $articulo->descripcion=$request->get('descripcion');
       $articulo->estado='Activo';

       if (Input::hasFile('imagen')){

        $file=Input::file('imagen');
        $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());

       $articulo->imagen=$file->getClientOriginalName();
       }
      
        $articulo->save();
        return Redirect::to('user/articulo');

    }
    public function show($id)
    {
        return view("user.almacen.articulo.show",["articulo"=>ProductosUsers::findOrFail($id)]);
    }
    public function edit($id)
    {

        $articulo=ProductosUsers::findOrFail($id);

        $categorias=DB::table('categoria')->get();
        $marca=DB::table('marca')->get();

        return view("user.almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias, "marca"=>$marca]);


        
    }
    public function update(ProductosUsersFormRequest $request,$id)
    {
        $articulo=ProductosUsers::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
       $articulo->idmarca=$request->get('idmarca');
       $articulo->codigo=$request->get('codigo');
       $articulo->nombre=$request->get('nombre');
       $articulo->stock=$request->get('stock');
       $articulo->descripcion=$request->get('descripcion');
     

       if (Input::has_File('imagen')){

        $file=Input::file('imagen');
        $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());

       $articulo->imagen=$file->getClientOriginalName();
       }

        $articulo->update();
        return Redirect::to('user/articulo');
    }
    public function destroy($id){
    
        $articulo=ProductosUsers::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('user/articulo');
    }
}
