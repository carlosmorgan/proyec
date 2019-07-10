<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaAdminsFormRequest;
use App\CategoriaAdmins;
use DB;

class CategoriaAdminsController extends Controller
{
    public function __construct()
    {

    }


public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
           // ->where ('condicion','=','1')
            ->orderBy('idcategoria','asc')
            ->paginate(4);
            return view('admin.almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }

public function create()
    {
        return view("admin.almacen.categoria.create");
    }
    public function store (CategoriaAdminsFormRequest $request)
    {
        $categoria=new CategoriaAdmins;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
       // $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('admin/categoria');

    }

public function show($id)
    {
        return view("admin.almacen.categoria.show",["categoria"=>CategoriaAdmins::findOrFail($id)]);
    }
public function edit($id)
    {
        return view("admin.almacen.categoria.edit",["categoria"=>CategoriaAdmins::findOrFail($id)]);
    }
public function update(CategoriaAdminsFormRequest $request,$id)
    {
        $categoria=CategoriaAdmins::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('admin/categoria');
    }
public function destroy($id)
    {
        $categoria=CategoriaAdmins::findOrFail($id);
       
        $categoria->delete();
        return Redirect::to('admin/categoria');
    }
}
