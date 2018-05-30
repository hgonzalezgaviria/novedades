@extends('layouts.menu')
@section('page_heading', 'Nuevo Permiso')

@section('section')
{{ Form::open(['route' => 'auth.permisos.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'auth/roles'])

{{ Form::close() }}
@endsection
