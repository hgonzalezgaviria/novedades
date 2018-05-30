@push('head')
	{!! Html::style('assets/stylesheets/fontawesome-iconpicker.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/fontawesome-iconpicker.min.js') !!}
	<script type="text/javascript">
		$('.icp').iconpicker();
	</script>
@endpush
