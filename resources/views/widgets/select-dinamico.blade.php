@push('head')
	{!! Html::style('assets/stylesheets/toastr.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/toastr.min.js') !!}
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('change','#{{$selectPadre}}',function(){
				 $('#{{$selectHijo}}').empty();
				var cat_id=$(this).val();
				var op=" ";
				$.ajax({
					type:'get',
					url:'{!!URL::to($url)!!}',
					data:{'{{$selectPadre}}':cat_id},
					success:function(data){;
						if (data.length==0) {
							toastr.error('El item seleccionado no tiene datos asociados','Datos No Encontrados',{"hideMethod": "fadeOut","timeOut": "2000","progressBar": true,"closeButton": true,"positionClass": "toast-top-left",});
							op='<option value="0" selected disabled>No se encontro ningun resultado</option>';
							$('#{{$selectHijo}}').append(op);
						} else {
							op+='<option value="0" selected disabled>{{isset($prepend)?$prepend:''}}</option>';
							for(var i=0;i<data.length;i++){
							op+='<option value="'+data[i].{{$idBusqueda}}+'">'+data[i].{{$nombreBusqueda}}+'</option>';
						   }
						   $('#{{$selectHijo}}').html(" ");
						   $('#{{$selectHijo}}').append(op);
						}
					},
					error:function(){
						toastr.error('No hay datos disponibles para las listas dependientes','No Hay Datos',{"hideMethod": "fadeOut","timeOut": "2000","progressBar": true,"closeButton": true,"positionClass": "toast-top-left",});
					}
				});			
			});	
		});
	</script>
@endpush