@push('head')
	{!! Html::style('assets/stylesheets/bootstrap/bootstrap-datetimepicker.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/momentjs/moment-with-locales.min.js') !!}
	{!! Html::script('assets/scripts/bootstrap/bootstrap-datetimepicker.min.js') !!}
	{!! Html::script('assets/scripts/bootstrap/bootstrap-datetimepicker-init.js') !!}
@endpush