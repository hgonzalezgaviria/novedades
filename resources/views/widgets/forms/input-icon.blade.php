@push('head')
	{!! Html::style('assets/stylesheets/fontawesome-iconpicker.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/fontawesome-iconpicker.min.js') !!}
	<script type="text/javascript">
		var inputIcon = $('.icp');
		if(inputIcon.val()==''){
			inputIcon.val('fa-commenting-o');
		}
		inputIcon.iconpicker();
		
	</script>
@endpush

<div class="input-group">
	{{ Form::text( $name, old($name), ['class'=>'form-control icp'] + (isset($options)?$options:[]) ) }}
    <span class="input-group-addon"></span>
</div>
