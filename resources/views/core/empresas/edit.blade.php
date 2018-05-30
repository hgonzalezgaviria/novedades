@extends('layouts.menu')

@section('page_heading', 'Actualizar Empresa')

@section('section')
{{ Form::model($empresa, ['action' => ['EmpresaController@update', $empresa->EMPR_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection