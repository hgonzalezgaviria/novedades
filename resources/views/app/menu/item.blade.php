<div class="dd-handle dd3-handle">Drag</div>
<div class="dd3-content">
	<i class="fa {{ $item['MENU_ICON'] }} fa-fw"></i> 
	{{ $item['MENU_LABEL'] }} @if(!$item['MENU_ENABLED'])(DESHABILITADO)@endif
	<div class="pull-right">
		<!-- Botón Editar (edit) -->
		<a class="btn btn-small btn-info btn-xs" href="{{ URL::to('app/menu/'.$item['MENU_ID'].'/edit') }}" data-tooltip="tooltip" title="Editar">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		</a>
		<!-- carga botón de borrar -->
		{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
			'class'=>'btn btn-xs btn-danger btn-delete',
			'data-toggle'=>'modal',
			'data-id'=> $item['MENU_ID'],
			'data-modelo'=> 'Menú',
			'data-descripcion'=> $item['MENU_LABEL'],
			'data-action'=> 'menu/'.$item['MENU_ID'],
			'data-target'=>'#pregModalDelete',
			'data-tooltip'=>'tooltip',
			'title'=>'Borrar',
		])}}
	</div>
</div>