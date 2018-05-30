@push('head')
	{!! Html::style('assets/stylesheets/toastr.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/toastr.min.js') !!}
	{!! Html::script('assets/scripts/metodosVarios.js') !!}
	<script>		
		var fecha = new Fecha();
		fecha.elementoFechaActual('{{$fecha1}}');
		fecha.elementoFechaActual('{{$fecha2}}');
		llenaDias('{{$fecha2}}');
		//Variable para validad Fecha Accidente
		var fechaAccidente="{{isset($fecha3) ? $Fecha3=$fecha3 : $Fecha3='NO_APLICA'}}";
		//Variable necesaria para prorroga ausentismo
		var FechaFinAuse="{{isset($fechaFin) ? $FechaFinAuse=$fechaFin : $FechaFinAuse='NO_APLICA'}}";

		$(document).on('blur','#{{$fecha1}}',function(){			
			if (fecha.validaFecha("{{$fecha1}}","{{$fecha2}}")) {
				fecha.mensaje("La fecha inicial no puede ser mayor a la fecha final");
				fecha.limpiaElemento('{{$fecha1}}');
				limpiaDias();
			}else{
				llenaDias('{{$fecha2}}');
			}
			if (FechaFinAuse=='FECHA_ADICIONAL') {				
				if (!fecha.validaFecha("{{$fecha1}}","<?php echo $FechaFinAuse; ?>")) {	
					fecha.mensaje("La fecha inicial no puede ser menor a la fecha final del ausentismo o prorroga");
					fecha.limpiaElemento('{{$fecha1}}');
					limpiaDias();		
				}else{
					llenaDias('{{$fecha2}}');
				}				
			}
		});	
		/*
		$(document).on('blur','#AUSE_DIAS',function(){
			$('#{{$fecha2}}').val(fecha.sumaDias($('#{{$fecha1}}').val(),$('#AUSE_DIAS').val()));
		});	*/

		//fecha.sumaDias($('#{{$fecha1}}').val(),$('#AUSE_DIAS').val())
		$(document).on('blur','#{{$fecha2}}',function(){
			if (fecha.validaFecha("{{$fecha1}}","{{$fecha2}}")) {
				fecha.mensaje("La fecha inicial no puede ser mayor a la fecha final");
				fecha.limpiaElemento('{{$fecha2}}');
				limpiaDias();
			}else{
				llenaDias('{{$fecha2}}');
			} 
		});	
		//La fecha del accidente no puede ser mayor la de la fecha inicial del ausentismo
		$(document).on('blur',"#<?php echo $Fecha3; ?>",function(){	
			if (fecha.validaFecha('<?php echo $Fecha3; ?>',"{{$fecha1}}")) {
				fecha.mensaje("La fecha del Accidente no puede ser mayor a la fecha final");
				fecha.limpiaElemento('<?php echo $Fecha3; ?>');
			}
		});	

		function llenaDias(fechaFinal){
				$('#AUSE_DIAS').val(fecha.cantDias(fecha.fechaElemento('{{$fecha1}}'),fecha.fechaElemento(fechaFinal)));
				$('#PROR_DIAS').val(fecha.cantDias(fecha.fechaElemento('{{$fecha1}}'),fecha.fechaElemento(fechaFinal)));
		}
		function limpiaDias(){
			$('#AUSE_DIAS').val("");
			$('#PROR_DIAS').val("");
		}
		
		
	</script>
@endpush