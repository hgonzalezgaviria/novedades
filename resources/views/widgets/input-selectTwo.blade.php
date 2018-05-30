@push('head')
  {!! Html::style('assets/stylesheets/select2/select2.min.css') !!}
  {!! Html::style('assets/stylesheets/select2/select2-bootstrap.min.css') !!}
@endpush

@push('scripts')
  {!! Html::script('assets/scripts/select2/select2.min.js') !!}
  {!! Html::script('assets/scripts/select2/es.js') !!}

  <script>
    $("#{{$name}}").select2({
      allowClear: {{isset($allowClear)?'true':'false'}},
      placeholder: "{{isset($placeholder)?$placeholder:''}}",
      theme: "bootstrap",      
    });
</script> 
@endpush
{{-- ejemplo de llamado
  @include('widgets.forms.input-selectTwo',['name'=>'EMPL_ID','placeholder'=>'Seleccione un Vehiculo','allowClear'=>true])
  --}}
