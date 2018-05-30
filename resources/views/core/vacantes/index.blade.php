@extends('layouts.menu')
@section('title', '/ Vacantes')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Vacantes
		</div>

		
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{route('core.vacantes.create')}}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
			</div>

@endsection


@section('section')

		
	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Id</th>
				<th class="col-md-1"> Empresa</th>
				<th class="col-md-3"> Programa</th>
				<th class="col-md-1">Requisitos</th>
				<th class="col-md-3">Fecha Inicio</th>
				<th class="col-md-3">Fecha Fin</th>
				<!--th class="col-md-1">Tipo Acceso</th-->
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($vacantes as $vacante)
			<tr>
				<td>{{ $vacante -> VACA_ID }}</td>
				<td>{{ $vacante -> EMPR_DESCRIPCION }}</td>
				<td>{{ $vacante -> VACA_PROGRAMA }}</td>
				<td>{{ $vacante -> VACA_REQUISITOS }}</td>
				<td>{{ $vacante -> VACA_FECHAINICIO }}</td>
				<td>{{ $vacante -> VACA_FECHAFIN }}</td>								
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.vacantes.edit', [ 'VACA_ID' => $vacante->VACA_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $vacante->VACA_ID,
						'data-modelo'=> str_upperspace(class_basename($vacante)),
						'data-descripcion'=> $vacante->VACA_ID,
						'data-action'=>'vacantes/'. $vacante->VACA_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection