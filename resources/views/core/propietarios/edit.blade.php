@extends('layouts.menu')

@section('page_heading', 'Actualizar Propietario')

@section('section')
{{ Form::model($propietario, ['action' => ['PropietarioController@update', $propietario->PROP_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection