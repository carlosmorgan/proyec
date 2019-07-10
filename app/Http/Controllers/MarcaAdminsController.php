<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MarcaAdminsFormRequest;
use App\MarcaAdmins;
use DB;

class MarcaAdminsController extends Controller
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
            ->paginate(7);
            return view('admin.almacen.marca.index',["marcas"=>$marcas,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("admin.almacen.marca.create");
    }
    public function store (MarcaAdminsFormRequest $request)
    {
        $marca=new MarcaAdmins;
      //  $marca->idmarca=$request->get('idmarca');
        $marca->nombre=$request->get('nombre');
       // $categoria->condicion='1';
        $marca->save();
        return Redirect::to('admin/marca');

    }
    public function show($id)
    {
        return view("admin.almacen.marca.show",["marca"=>MarcaAdmins::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("admin.almacen.marca.edit",["marca"=>MarcaAdmins::findOrFail($id)]);
    }
    public function update(MarcaAdminsFormRequest $request,$id)
    {
        $marca=MarcaAdmins::findOrFail($id);
      //  $marca->idmarca=$request->get('idmarca');
        $marca->nombre=$request->get('nombre');
        $marca->update();
        return Redirect::to('admin/marca');
    }
    public function destroy($id)
    {
        $marca=MarcaAdmins::findOrFail($id);
       
        $marca->delete();
        return Redirect::to('admin/marca');
    }
}
