@extends('layouts.menu')
@section('page_heading', 'Actualizar Permiso')

@section('section')
{{ Form::model($permiso, ['action' => ['Auth\PermissionController@update', $permiso->id ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'auth/roles'])

{{ Form::close() }}
@endsection