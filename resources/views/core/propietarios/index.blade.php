@extends('layouts.menu')
@section('title', '/ Propietarios')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Propietarios
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('core.propietarios.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">CEDULA</th>
				<th class="col-md-3">NOMBRES</th>
				<th class="col-md-3">APELLIDOS</th>

				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($propietarios as $propietario)
			<tr>
				<td>{{ $propietario -> PROP_CEDULA }}</td>
				<td>{{ $propietario -> PROP_NOMBRE }}</td>
				<td>{{ $propietario -> PROP_APELLIDO }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.propietarios.edit', [ 'PROP_ID' => $propietario->PROP_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $propietario->PROP_ID,
						'data-modelo'=> str_upperspace(class_basename($propietario)),
						'data-descripcion'=> $propietario->PROP_CEDULA,
						'data-action'=>'propietarios/'. $propietario->PROP_ID,
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