@extends('layouts.menu')
@section('title', '/ Roles')
@include('widgets.datatable.datatable-export')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Roles
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ URL::to('auth/roles/create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
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
				<th class="col-xs-3">Display</th>
				{{--<th class="col-xs-3">Permisos</th>--}}
				<th class="hidden-xs col-sm-1">Creado</th>
				<th class="hidden-xs col-sm-1">Modificado</th>
				<th class="col-xs-1 all"></th>
			</tr>
		</thead>

		<tbody>

			@foreach($roles as $rol)
			<tr>
				<td>{{ $rol -> name }}</td>
				<td>
					{{ $rol -> display_name }}
					@if($rol->description)
					<i class="fa fa-question-circle" aria-hidden="true" data-tooltip="tooltip" data-container="body" title="{{ $rol -> description }}"></i>
					@endif
				</td>
				{{--<td>
					<i class="fa fa-address-card-o" aria-hidden="true" data-tooltip="tooltip" data-placement="bottom" data-container="body" title="{{ $rol -> permissions ->implode('display_name', ', ') }}"></i>
				</td>--}}
				<td>{{ datetime($rol->created_at, true) }}</td>
				<td>{{ datetime($rol->updated_at, true) }}</td>
				<td>

					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('auth/roles/'.$rol->id.'/edit') }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $rol->id,
						'data-modelo'=> 'Rol',
						'data-descripcion'=> $rol->display_name,
						'data-action'=> 'roles/'.$rol->id,
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