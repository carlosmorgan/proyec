@extends ('admin.home')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Compras <a href="compras/create"><button class="btn btn-success">Nuevo</button></a></h3>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>total</th>
					<th>estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ingresos as $ing)
				<tr>
				
					<td>{{ $ing->fecha_hora}}</td>
					<td>{{ $ing->nombre}}</td>
					<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->num_comprobante}}</td>
					<td>{{ $ing->impuesto}}</td>
					<td>{{ $ing->total}}</td>
					<td>{{ $ing->estado}}</td>
					
                  
					<td>
						<a href="{{URL::action('IngresoAdminsController@show',$ing->idcompras)}}"><button class="btn btn-info">Detalles</button></a>
                         <a href="" data-target="#modal-delete-{{$ing->idcompras}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>
</div>

@endsection