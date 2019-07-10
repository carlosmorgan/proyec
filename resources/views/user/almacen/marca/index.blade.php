@extends ('user.home')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Marcas </h3>
		@include('user.almacen.marca.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Código</th>
					<th>Nombre</th>
			
					<th>Opciones</th>
				</thead>
               @foreach ($marcas as $mar)
				<tr>
					<td>{{ $mar->idmarca}}</td>
					<td>{{ $mar->nombre}}</td>
				
					<td>
						
					</td>
				</tr>
			
				@endforeach
			</table>
		</div>
		{{$marcas->render()}}
	</div>
</div>

@endsection