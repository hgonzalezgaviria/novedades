@push('head')
	{!! Html::style('assets/stylesheets/datatable/datatable/dataTables.bootstrap.min.css') !!}

	{!! Html::style('assets/stylesheets/datatable/buttons/buttons.dataTables.min.css') !!}
	{!! Html::style('assets/stylesheets/datatable/buttons/buttons.bootstrap4.min.css') !!}

	{!! Html::style('assets/stylesheets/datatable/responsive/responsive.bootstrap.min.css') !!}
	{!! Html::style('assets/stylesheets/datatable/responsive/responsive.dataTables.min.css') !!}

	{!! Html::style('assets/stylesheets/datatable/scroller/scroller.dataTables.min.css') !!}
	{!! Html::style('assets/stylesheets/datatable/scroller/scroller.bootstrap.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/datatable/libs_export/jszip.min.js') !!}
	{!! Html::script('assets/scripts/datatable/libs_export/pdfmake.min.js') !!}
	{!! Html::script('assets/scripts/datatable/libs_export/vfs_fonts.js') !!}

	{!! Html::script('assets/scripts/datatable/datatable/jquery.dataTables.min.js') !!}
	{!! Html::script('assets/scripts/datatable/datatable/dataTables.bootstrap.min.js') !!}

	{!! Html::script('assets/scripts/datatable/buttons/dataTables.buttons.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.html5.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.colVis.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.print.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.flash.min.js') !!}
	{!! Html::script('assets/scripts/datatable/buttons/buttons.bootstrap4.min.js') !!}

	{!! Html::script('assets/scripts/datatable/responsive/dataTables.responsive.min.js') !!}
	{!! Html::script('assets/scripts/datatable/responsive/responsive.bootstrap.min.js') !!}

	{!! Html::script('assets/scripts/datatable/scroller/dataTables.scroller.min.js') !!}

<script type="text/javascript">
	$.extend( true, $.fn.dataTable.defaults, {
		lengthMenu: [[5,10,25,50,-1], [5,10,25,50,'Todos']],
		//retrieve: true,
		pagingType: 'simple_numbers',
		//bScrollCollapse: true,
		//sScrollY: '300px',
		responsive: true,
		stateSave:  false,
		language: { 
			sProcessing:     'Procesando...', 
			sLengthMenu:     'Mostrar _MENU_ registros', 
			sZeroRecords:    'No se encontraron resultados', 
			sEmptyTable:     'Ningún dato disponible en esta tabla', 
			sInfo:           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros', 
			sInfoEmpty:      'Mostrando registros del 0 al 0 de un total de 0 registros', 
			sInfoFiltered:   '(filtrado de un total de _MAX_ registros)', 
			sSearch:         'Buscar:', 
			sInfoThousands:  ',', 
			sLoadingRecords: 'Cargando...', 
			oPaginate: {
				sFirst:    '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
				sLast:     '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
				sNext:     '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
				sPrevious: '<i class="fa fa-chevron-left" aria-hidden="true"></i>'
			}
		},
		dom: "<'row' <'col-xs-12 col-sm-4'<'pull-left' f>> <'col-xs-12 col-sm-8'<'pull-right' B>>>"
			 +"<rt>"
			 +"<'row'<'form-inline'"
			 +" <'col-sm-6 col-md-6 col-lg-6'l>"
			 +"<'col-sm-6 col-md-6 col-lg-6'p>>>",
		buttons: [{
				extend: 'csvHtml5',
				text:  '<i class="fa fa-file-text-o"></i>',
                //exportOptions: { columns: ':visible' },
				titleAttr: 'CSV',
			},{
				extend: 'excelHtml5',
				text:   '<i class="fa fa-file-excel-o"></i>',
                //exportOptions: { columns: ':visible' },
				titleAttr: 'Excel',
			},{
				extend: 'pdfHtml5',
				text:    '<i class="fa fa-file-pdf-o"></i>',
                //exportOptions: { columns: ':visible' },
				titleAttr: 'PDF',
			},{
				extend: 'print',
				text:    '<i class="fa fa-print"></i>',
                //exportOptions: { columns: ':visible' },
				titleAttr: 'Imprimir',
			},{
				extend: 'colvis',
				text:  '<i class="fa fa-columns"></i>',
				titleAttr: 'Ver Columnas'
			}
		]
	});
</script>
@endpush
