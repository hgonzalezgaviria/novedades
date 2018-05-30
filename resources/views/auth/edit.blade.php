@extends('layouts.menu')
@section('page_heading', 'Actualizar usuario')

@section('section')	
{{ Form::model($usuario, ['action' => ['Auth\AuthController@update', $usuario->id ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}
	<div class='col-md-8 col-md-offset-2'>

		<!-- Elementos del formulario -->
		@rinclude('form-inputs')

		<!-- Botones -->
		@include('widgets.forms.buttons', ['url' => 'auth/usuarios'])

	</div>
{{ Form::close() }}
@endsection
