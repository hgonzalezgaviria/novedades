function Fecha(){
	this.f = new Date();
	this.dia=function(f){
		return f.getDate() < 10 ? "0" + f.getDate() : f.getDate();
	}

	this.mes=function(f){
		return f.getMonth() < 9 ? "0" + (f.getMonth() + 1) : (f.getMonth() + 1); 
	}	

	this.hoy = function(){
		return "".concat(this.f.getFullYear()).concat("-"+this.mes(this.f)).concat("-"+this.dia(this.f));
	}

	this.varFecha=function(fechaP){
		return new Date(fechaP);
	}
	this.formatoFecha=function(f){
   		return "".concat(f.getFullYear()).concat("-"+this.mes(f)).concat("-"+this.dia(f));
	}
	this.validaFecha = function (fechaMenor,FechaMayor) {
		var f1=new Date($("#"+fechaMenor).val());
		var f2=new Date($("#"+FechaMayor).val());
		if (f1>f2) {			
			return true;
		}
		return false;
	}
	this.limpiaElemento=function(elemento){
		$('#'+ elemento).val("");
	}

	this.elementoFechaActual=function(elemento){
		$('#'+ elemento).val(this.hoy());
	}

	this.mensaje=function(msj){
		toastr.error(msj,'Error en la fecha',
			{"hideMethod": "fadeOut",
			"timeOut": "5000",
			"progressBar": true,
			"closeButton": true,
			"positionClass": "toast-top-left",
		});
	};
	
	this.cantDias=function(fechaIni,fechaFin){
		var fecha1 = moment(fechaIni);
		var fecha2 = moment(fechaFin);
		return fecha2.diff(fecha1, 'days')+1;
	}
	this.fechaElemento=function(elemento){
		return $('#'+ elemento).val();
	}
	this.sumaDias=function(fecha, dias){
		var f=new Date(fecha);
		f.setDate(f.getDate() + (parseInt(dias)+1));
	  	return this.formatoFecha(f);
	}
	
}
