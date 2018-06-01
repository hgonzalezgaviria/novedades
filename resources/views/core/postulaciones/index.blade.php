@extends('layouts.menu')
@section('title', '/ Accesos')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Postulaciones
		</div>

		<!--
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{-- route('core.postulaciones.create') --}}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
		-->
	</div>

@endsection


@section('section')

		
	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Id</th>
				<th class="col-md-1"> IdVacante</th>
				<th class="col-md-3"> Empresa</th>
				<th class="col-md-3"> IdUsuario</th>
				<th class="col-md-2">Nombre usuario</th>
				<th class="col-md-2">Fecha Postulación</th>	
			
			</tr>
		</thead>

		<tbody>
			@foreach($postulaciones as $postulacione)
			<tr>
				<td>{{ $postulacione -> POST_ID }}</td>
				<td>{{ $postulacione -> VACA_ID }}</td>
				<td>{{ $postulacione -> EMPR_DESCRIPCION }}</td>
				<td>{{ $postulacione -> PROP_CEDULA }}</td>
				<td>{{ $postulacione -> PROP_NOMBRE }}</td>
				<td>{{ $postulacione -> POST_FECHA }}</td>				
				
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection