@push('head')
	{!! Html::style('assets/stylesheets/spectrum.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/spectrum.js') !!}
	<script type="text/javascript">
		$(".input-color").spectrum({
		    color: 'red',
		    showPalette: true,
		    palette: [
		        ['red','yellow','green'],
		        ['blue','magenta','cyan'],
		        ['orange','grey','deepskyblue'],
		        ['pink','saddlebrown']
		    ]
		});
	</script>
@endpush