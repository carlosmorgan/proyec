@extends ('user.home')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $persona->nombre}}</h3>
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

			{!!Form::model($persona,['method'=>'PATCH','route'=>['ventas.cliente.update',$persona->idpersona]])!!}
            {{Form::token()}}


<div class="row">


	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre...">
            </div>
	</div>	

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="nombre">Direccion</label>
            	<input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="Direccion...">
            </div>
	</div>	

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	
	<div class="form-group"> 
		<label> Documento </label>
		<select name='tipo_documento' class="form-control">
		@if($persona->tipo_documento=='RFC')	
    <option value="RFC" selected>RFC</option>
	<option value="CURP">CURP</option>
	<option value="PAS">PAS</option>

	@elseif($persona->tipo_documento=='CURP')	
	 <option value="RFC">RFC</option>
	<option value="CURP" selected>CURP</option>
	<option value="PAS">PAS</option>

	@else
	 <option value="RFC">RFC</option>
	<option value="CURP">CURP</option>
	<option value="PAS" selected>PAS</option>
		
		</select>
		@endif

	</div>
</div>	


	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="codigo">Numero Documento</label>
            	<input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="num_documento...">
            </div>

</div>



	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="stock">telefono</label>
            	<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="telefono...">
            </div>

</div>



	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="descripcion">email</label>
            	<input type="text" name="email" value="{{$persona->email}}" class="form-control" placeholder="email...">
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