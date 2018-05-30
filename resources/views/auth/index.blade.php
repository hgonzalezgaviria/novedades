@extends('layouts.menu')
@section('title', '/ Usuarios Locales')
@include('widgets.datatable.datatable-export')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Usuarios Locales
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">

			<!-- botón de importar usuarios -->
			@include('auth/index-modal-import')

			<a class='btn btn-primary' role='button' href="{{ URL::to('/register') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-user-plus" aria-hidden="true"></i>
			</a>

		</div>
	</div>
@endsection

@section('section')
	
	<table class="table table-striped" id="tabla">
		<thead>
			<tr class="active">
				<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">ID</th>
				<th class="col-xs-4 col-sm-4 col-md-4 col-lg-2">Nombre</th>
				<th class="col-xs-2 col-sm-1 col-md-1 col-lg-1">Usuario</th>
				<th class="col-xs-2 col-sm-1 col-md-1 col-lg-1">Cedula</th>
				<th class="col-xs-2 col-sm-1 col-md-1 col-lg-1">Email</th>
				<th class="col-xs-2 col-sm-1 col-md-1 col-lg-1">Roles</th>
				<th class="hidden-xs col-sm-1 col-md-1 col-lg-1">Creado</th>
				<th class="hidden-xs col-sm-1 col-md-1 col-lg-1">Modificado</th>
				<th class="col-xs-1 all"></th>
			</tr>
		</thead>
		<tbody>

			@foreach($usuarios as $usuario)
			<tr>
				<td>{{ $usuario -> USER_ID }}</td>
				<td>{{ $usuario -> name }}</td>
				<td>{{ $usuario -> username }}</td>
				<td>{{ $usuario -> cedula }}</td>
				<td>{{ $usuario -> email }}</td>
				<td>{{ $usuario -> roles ->implode('display_name', ',') }}</td>
				<td class="hidden-xs">{{ $usuario -> USER_CREADOPOR }}</td>
				<td class="hidden-xs">{{ $usuario -> USER_MODIFICADOPOR }}</td>
				<td>

					{{-- <!-- Botón Ver (show) -->
					<a class="btn btn-success btn-xs" href="{{ URL::to('usuarios/'.$usuario->id) }}">
						<span class="glyphicon glyphicon-eye-open"></span> <span class="hidden-xs">Ver</span>
					</a><!-- Fin Botón Ver (show) --> --}}

					{{-- <!-- Botón Contraseña (sendResetLinkEmail) -->
					<a class="btn btn-warning btn-xs" href="{{ URL::to('password/email/'.$usuario->id) }}">
						<i class="fa fa-envelope" aria-hidden="true"></i> <span class="hidden-xs">Contraseña</span>
					</a><!-- Fin Botón Contraseña (sendResetLinkEmail) --> --}}

					<!-- Botón Contraseña (showResetForm) -->
					<a class="btn btn-warning btn-xs" href="{{ URL::to('password/reset?USER_ID='.$usuario->id) }}" data-tooltip="tooltip" title="Cambiar Contraseña">
						<i class="fa fa-key" aria-hidden="true"></i>
					</a>

					<!-- Botón Editar (edit) -->
					<a class="btn btn-info btn-xs" href="{{ URL::to('auth/usuarios/'.$usuario->id.'/edit') }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

	                <!-- carga botón de borrar -->
	                {{ Form::button('<i class="fa fa-user-times" aria-hidden="true"></i>',[
	                    'class'=>'btn btn-xs btn-danger btn-delete',
	                    'data-toggle'=>'modal',
						'name'=>'delete',
						'data-id'=>$usuario->id,
	                    'data-modelo'=> 'Usuario',
	                    'data-descripcion'=> $usuario->username,
	                    'data-action'=>'usuarios/'.$usuario->id,
	                    'data-target'=>'#pregModalDelete',
	                    'data-tooltip'=>'tooltip',
	                    'title'=>'Borrar',
	                ])}}

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets.modal-delete')
@endsection