@extends ('admin.home')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Marca: {{ $marca->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($marca,['method'=>'PATCH','route'=>['marca.update',$marca->idmarca]])!!}
            {{Form::token()}}
        <!--  <div class="form-group">
           	<label for="idmarca">Codigo</label>
            	<input type="text" name="idmarca" class="form-control" value="{{$marca->idmarca}}" placeholder="codigo...">
            </div> -->
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$marca->nombre}}" placeholder="nombre...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection