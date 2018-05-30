@extends('layouts.menu')

@section('page_heading', 'Nueva Vacante')

@section('section')
{{ Form::open(['route' => 'core.vacantes.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
