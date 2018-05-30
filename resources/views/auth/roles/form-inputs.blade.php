{{--@include('datepicker')--}}
@include('chosen')

<div class="col-xs-12 col-sm-6"> 
	@include('widgets.forms.input', ['type'=>'text', 'name'=>'name', 'label'=>'Nombre interno', 'options'=>['maxlength' => '15'] ])
	@include('widgets.forms.input', ['type'=>'text', 'name'=>'display_name', 'label'=>'Nombre para mostrar', 'options'=>['maxlength' => '50'] ])
	@include('widgets.forms.input', [ 'type'=>'textarea', 'name'=>'description', 'label'=>'Descripción', 'options'=>['maxlength' => '100'] ])
</div>
<div class="col-xs-12 col-sm-6"> 
	@include('widgets.forms.input', ['type'=>'select', 'name'=>'permisos_ids', 'label'=>'Permisos', 'data'=>$arrPermGroups, 'multiple'=>true])
</div>
