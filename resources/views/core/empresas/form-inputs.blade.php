@include('chosen')
<div class='col-md-8 col-md-offset-2'>
	<div class="row">
		@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'EMPR_DESCRIPCION', 'label'=>'Descripción', 'options'=>['maxlength' => '300', 'required'] ])
		@if(current_route_action() == 'create')
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'EMPR_ESTADO', 'label'=>'Estado', 'data'=>[1=>'ACTIVO',0=>'INACTIVO'] , 'value'=>1, 'class'=>'readonly'])
		@else
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'EMPR_ESTADO', 'label'=>'Estado', 'data'=>[1=>'ACTIVO',0=>'INACTIVO']])
		@endif
	</div>

	<div class="row">
	

		@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'EMPR_LATITUD', 'label'=>'Latitud', 'options'=>['maxlength' => '300', 'required'] ])
		@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'EMPR_LOGITUD', 'label'=>'Longitud', 'options'=>['maxlength' => '300', 'required'] ])

		
			@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'EMPR_DIRECCION', 'label'=>'Dirección', 'options'=>['maxlength' => '300', 'required'] ])

		
	</div>

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/empresas'])

</div>