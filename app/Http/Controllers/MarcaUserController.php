<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MarcasUserFormRequest;
use App\MarcasUser;
use DB;

class MarcaUserController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $marcas=DB::table('marca')->where('nombre','LIKE','%'.$query.'%')
           // ->where ('condicion','=','1')
            ->orderBy('idmarca','asc')
            ->paginate(4);
            return view('user.almacen.marca.index',["marcas"=>$marcas,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("user.almacen.marca.create");
    }
    public function store (MarcaUserFormRequest $request)
    {
        $marca=new MarcaUser;
      //  $marca->idmarca=$request->get('idmarca');
        $marca->nombre=$request->get('nombre');
       // $categoria->condicion='1';
        $marca->save();
        return Redirect::to('user/marca');

    }
    public function show($id)
    {
        return view("user.almacen.marca.show",["marca"=>MarcaUser::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("user.almacen.marca.edit",["marca"=>MarcaUser::findOrFail($id)]);
    }
    public function update(MarcaUserFormRequest $request,$id)
    {
        $marca=MarcaUser::findOrFail($id);
      //  $marca->idmarca=$request->get('idmarca');
        $marca->nombre=$request->get('nombre');
        $marca->update();
        return Redirect::to('user/marca');
    }
    public function destroy($id)
    {
        $marca=MarcaUser::findOrFail($id);
       
        $marca->delete();
        return Redirect::to('user/marca');
    }
}
