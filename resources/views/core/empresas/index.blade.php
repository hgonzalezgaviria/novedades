@extends('layouts.menu')
@section('title', '/ Empresas')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Empresas
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('core.empresas.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">ID Empresa</th>
				<th class="col-md-3">Descripción</th>
				<th class="col-md-2">Latitud</th>
				<th class="col-md-2">Longitud</th>
				<th class="col-md-2">Dirección</th>
				<th class="col-md-1">Estado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($empresas as $empresa)
			<tr>
				<td>{{ $empresa -> EMPR_ID }}</td>
				<td>{{ $empresa -> EMPR_DESCRIPCION }}</td>
				<td>{{ $empresa -> EMPR_LATITUD }}</td>
				<td>{{ $empresa -> EMPR_LOGITUD }}</td>
				<td>{{ $empresa -> EMPR_DIRECCION }}</td>
				<td>{{ $empresa -> EMPR_ESTADO ? 'ACTIVO' : 'INACTIVO' }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.empresas.edit', [ 'EMPR_ID' => $empresa->EMPR_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{-- Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $empresa->EMPR_ID,
						'data-modelo'=> str_upperspace(class_basename($empresa)),
						'data-descripcion'=> $empresa->EMPR_IDTAG,
						'data-action'=>'empresas/'. $empresa->EMPR_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])--}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection