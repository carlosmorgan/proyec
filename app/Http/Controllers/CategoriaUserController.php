<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\CategoriaUser;
use App\Http\Requests\CategoriaUserFormRequest;
use DB;

class CategoriaUserController extends Controller
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
            return view('user.almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }

public function create()
    {
        return view("user.almacen.categoria.create");
    }
    public function store (CategoriaUserFormRequest $request)
    {
        $categoria=new CategoriaUser;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
       // $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('users/categoria');

    }

public function show($id)
    {
        return view("user.almacen.categoria.show",["categoria"=>CategoriaUser::findOrFail($id)]);
    }
public function edit($id)
    {
        return view("user.almacen.categoria.edit",["categoria"=>CategoriaUser::findOrFail($id)]);
    }
public function update(CategoriaUserFormRequest $request,$id)
    {
        $categoria=CategoriaUser::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('users/categoria');
    }
public function destroy($id)
    {
        $categoria=CategoriaUser::findOrFail($id);
        $categoria->condicion='0';
        $categoria->delete();
        return Redirect::to('users/categoria');
    }
}
