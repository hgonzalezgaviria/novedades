@push('head')
	{!! Html::style('assets/stylesheets/toastr.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/toastr.min.js') !!}
	<script>
		$(document).ready(function(){
			$(document).on('blur','#{{$FieldClave}}',function(){
				var cat_id=$(this).val();
				if (cat_id!="") {
					$.ajax({
					type:'get',
					url:'{!!URL::to($ruta)!!}',		
					data:{'{{$FieldClave}}':cat_id},
					success:function(data){
						if (data.length==1) {
							$('#{{$FieldDescripcion}}').val(data[0].{{$colDescripcion}});
							@if (isset($FieldId))
								$('#{{$FieldId}}').val(data[0].{{$colId}});
							@endif
						} else {
							$('#{{$FieldDescripcion}}').val('');
							toastr.warning('No se Encontro ningun Resultado','No Hay Datos',{"hideMethod": "fadeOut","timeOut": "2000","progressBar": true,"closeButton": true,"positionClass": "toast-top-left",});
						}						
					},			
					error:function(){
						alert('ha ocurrido un error');
					}
				});	
				}
			});	
			});
	</script>
@endpush

{{-- @include('widgets.buscarV',['FieldClave'=>'CIE10','FieldDescripcion'=>'DX_DESCRIPCION','ruta'=>'buscaDx','colDescripcion'=>'DIAG_DESCRIPCION','FieldId'=>'DIAG_ID','colId'=>'DIAG_ID']) 

public function buscaDx(Request $request)
{
	$data=Diagnostico::select('DIAG_ID','DIAG_DESCRIPCION')->where('DIAG_CODIGO',$request->CIE10)->get();
	return response()->json($data);
}
http://codeseven.github.io/toastr/demo.html
--}}