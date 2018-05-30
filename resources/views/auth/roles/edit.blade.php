@extends('layouts.menu')
@section('page_heading', 'Actualizar Rol')

@section('section')
{{ Form::model($rol, ['action' => ['Auth\RoleController@update', $rol->id ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'auth/roles'])

{{ Form::close() }}
@endsection