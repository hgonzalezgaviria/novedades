@extends('layouts.menu')

@section('page_heading', 'Nuevo Empresa')

@section('section')
{{ Form::open(['route' => 'core.empresas.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
