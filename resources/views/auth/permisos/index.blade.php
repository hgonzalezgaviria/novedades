@extends('layouts.menu')
@section('title', '/ Permisos')
@include('widgets.datatable.datatable-export')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Permisos
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('auth/permisos/create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-xs-1">Nombre</th>
				<th class="col-xs-2">Display</th>
				<th class="hidden-xs col-sm-1">Roles</th>
				<th class="hidden-xs col-sm-2">Creado</th>
				<th class="hidden-xs col-sm-2">Modificado</th>
				<th class="col-xs-1 all"></th>
			</tr>
		</thead>

		<tbody>

			@foreach($permisos as $permiso)
			<tr>
				<td>{{ $permiso -> name }}</td>
				<td>{{ $permiso -> display_name }}</td>
				<td>{{ $permiso -> roles -> count() }}</td>
				<td>{{ datetime($permiso->created_at, true) }}</td>
				<td>{{ datetime($permiso->updated_at, true) }}</td>
				<td>

					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('auth/permisos/'.$permiso->id.'/edit') }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $permiso->id,
						'data-modelo'=> 'Permiso',
						'data-descripcion'=> $permiso->display_name,
						'data-action'=> 'permisos/'.$permiso->id,
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
@endsection