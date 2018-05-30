<div class="row">
	@include('widgets.forms.input', [ 'type'=>'select', 'column'=>8, 'name'=>'PROP_ID', 'label'=>'Propietario', 'ajax'=>['url'=>'getArrPropietarios'],'options'=>['required'] ] )
</div>