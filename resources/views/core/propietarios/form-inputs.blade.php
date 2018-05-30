@include('chosen')
<div class='col-md-8 col-md-offset-2'>
	<div class="row">
		@include('widgets.forms.input', ['type'=>'number', 'name'=>'PROP_CEDULA', 'label'=>'Cédula', 'options'=>['size' => '999999999999999', 'required'] ])
	</div>
	<div class="row">
		@include('widgets.forms.input', ['type'=>'text', 'column'=>6, 'name'=>'PROP_NOMBRE', 'label'=>'Nombres', 'options'=>['maxlength' => '300', 'required'] ])
		@include('widgets.forms.input', ['type'=>'text', 'column'=>6, 'name'=>'PROP_APELLIDO', 'label'=>'Apellidos', 'options'=>['maxlength' => '300', 'required'] ])
	</div>

		<div class="row">
		
		@include('widgets.forms.input', ['type'=>'email', 'column'=>4, 'name'=>'PROP_CORREO', 'label'=>'Correo electrónico'])
		@include('widgets.forms.input', ['type'=>'password', 'column'=>4, 'name'=>'PROP_PASS', 'label'=>'Password'])
	</div>

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/propietarios'])

</div>