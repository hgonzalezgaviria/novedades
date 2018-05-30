@extends('layouts.menu')
@section('page_heading', 'Nuevo Rol')

@section('section')
{{ Form::open(['route' => 'auth.roles.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'auth/roles'])

{{ Form::close() }}
@endsection
