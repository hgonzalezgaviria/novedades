@extends('layouts.menu')

@section('page_heading', 'Actualizar Vacante')

@section('section')
{{ Form::model($vacante, ['action' => ['VacanteController@update', $vacante->VACA_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection