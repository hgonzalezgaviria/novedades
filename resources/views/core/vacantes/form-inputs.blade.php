@include('datepicker')
@include('chosen')
<div class='col-md-8 col-md-offset-2'>
	<div class="row">
		@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'EMPR_ID', 'label'=>'Empresa', 'data'=>$getArrEmpresas ])
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'VACA_PROGRAMA', 'label'=>'Seleccionar Programa', 'data'=>['Ingenieria'=>'Ingenieria','Mercadeo'=>'Mercadeo']])
	</div>
	<div class="row">		

		@include('widgets.forms.input', ['type'=>'textarea', 'column'=>4, 'name'=>'VACA_REQUISITOS', 'label'=>'Requisitos', 'options'=>['maxlength' => '500', 'required'] ])

		@if(current_route_action() == 'create')
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'VACA_ESTADO', 'label'=>'Estado', 'data'=>[1=>'ACTIVO',0=>'INACTIVO'] , 'value'=>1, 'class'=>'readonly'])
		@else
			@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'VACA_ESTADO', 'label'=>'Estado', 'data'=>[1=>'ACTIVO',0=>'INACTIVO']])
		@endif
	</div>

		<div class="row">
		
		@include('widgets.forms.input', ['type'=>'date', 'column'=>3, 'name'=>'	VACA_FECHAINICIO', 'label'=>'Fecha inicio' ])
		@include('widgets.forms.input', ['type'=>'date', 'column'=>3, 'name'=>'VACA_FECHAFIN', 'label'=>'Fecha fin' ])
	</div>

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/vacantes'])

</div>