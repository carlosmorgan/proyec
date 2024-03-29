@extends ('user.home')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Articulo: {{ $articulo->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
        </div>
    </div>

			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idproducto],'files'=>'true'])!!}
            {{Form::token()}}

<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
	</div>	

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="descripcion">Estado</label>
            	<input type="text" name="estado" value="{{$articulo->estado}}" class="form-control">
            </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	<div class="form-group"> 
		<label> Categoria </label>
		<select name='idcategoria' class="form-control">
			@foreach ($categorias as $cat)
			@if ($cat->idcategoria==$articulo->idcategoria)
			<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}} </option>
			@else
			<option value="{{$cat->idcategoria}}">{{$cat->nombre}} </option>
			@endif
			@endforeach
		</select>
	</div>
</div>	

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group"> 
		<label> Marca </label>
		<select name='idmarca' class="form-control">
			@foreach ($marca as $mar)
			@if ($mar->idmarca==$articulo->idmarca)
			<option value="{{$mar->idmarca}}" selected>{{$mar->nombre}} </option>
			@else
			<option value="{{$mar->idmarca}}">{{$mar->nombre}} </option>
			@endif
			@endforeach
		</select>
	</div>
</div>	
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="codigo">Codigo</label>
            	<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
            </div>
</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="stock">Stock</label>
            	<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
            </div>
</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="descripcion">Descripcion</label>
            	<input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="descripcion del producto...">
            </div>
</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="imagen">Imagen</label>
            	<input type="file" name="imagen" class="form-control">
            	@if (($articulo->imagen)!="")
            	<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="200px" width="200px">
            	@endif
            </div>
</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
</div>







</div>


			{!!Form::close()!!}		
            
	
@endsection