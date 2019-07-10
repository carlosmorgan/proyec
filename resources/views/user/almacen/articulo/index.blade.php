@extends ('user.home')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Productos </h3>
		@include('user.almacen.articulo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Código</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Marca</th>
					<th>Stock</th>
					<th>Imagen</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
				<td>{{ $art->codigo}}</td>
					<td>{{ $art->nombre}}</td>
					
					<td>{{ $art->categoria}}</td>
					<td>{{ $art->marca}}</td>
					<td>{{ $art->stock}}</td>
					<td>
						<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
					</td>
                    <td>{{ $art->estado}}</td>
					<td>
						Sin Permiso
					</td>
				</tr>
				@include('user.almacen.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>

@endsection