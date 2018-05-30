$(function () {

	$.fn.datetimepicker.defaults.locale = 'es';
	$.fn.datetimepicker.defaults.icons  = {
		date: "fa fa-calendar",
		up: "fa fa-arrow-up",
		down: "fa fa-arrow-down",
		previous: 'fa fa-chevron-left',
		next: 'fa fa-chevron-right',
		today: 'glyphicon glyphicon-screenshot',
		clear: 'fa fa-trash',
		close: 'fa fa-times'
	};
	$.fn.datetimepicker.defaults.tooltips= {
		selectMonth: 'Seleccione Mes',
		prevMonth: 'Mes Anterior',
		nextMonth: 'Mes Siguiente',
		selectYear: 'Seleccione Año',
		prevYear: 'Año Anterior',
		nextYear: 'Año Siguiente',
		selectDecade: 'Seleccione Década',
		prevDecade: 'Década Anterior',
		nextDecade: 'Década Siguiente',
		prevCentury: 'Siglo Anterior',
		nextCentury: 'Siglo Siguiente'
	}

	window.initDateTimePicker = function () {
		$('.datepicker').datetimepicker({format: 'YYYY-MM-DD'});
		$('.timepicker').datetimepicker({format: 'HH:mm:ss'});
	};
	window.initDateTimePicker();

});