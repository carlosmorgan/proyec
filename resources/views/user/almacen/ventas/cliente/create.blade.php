@extends ('user.home')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
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
			{!!Form::open(array('url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
<div class="row">


	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
	</div>	

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="nombre">Direccion</label>
            	<input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Direccion...">
            </div>
	</div>	

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	
	<div class="form-group"> 
		<label> Documento </label>
		<select name='tipo_documento' class="form-control">
			

	<option value="RFC">RFC</option>
	<option value="CURP">RFC</option>
	<option value="PAS">RFC</option>
		
		</select>

	</div>
</div>	


	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="codigo">Numero Documento</label>
            	<input type="text" name="num_documento" value="{{old('num_documento')}}" class="form-control" placeholder="num_documento...">
            </div>

</div>



	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="stock">telefono</label>
            	<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="telefono...">
            </div>

</div>



	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		 <div class="form-group">
            	<label for="descripcion">email</label>
            	<input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="email...">
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