<div class='input-group datepicker' id='dttmpicker_{{$name}}'>
	{{ Form::text( $name, old($name), ['class' => 'form-control'] + (isset($options)?$options:[]) )}}
	<span class="input-group-addon">
		<span class="fa fa-calendar"></span>
	</span>
</div>