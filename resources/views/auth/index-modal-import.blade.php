{{ Form::button('<i class="fa fa-file-excel-o" aria-hidden="true"></i>',[
		'class'=>'btn btn-primary',
		'data-toggle'=>'modal',
		'data-target'=>'#pregModalImport',
		'data-tooltip'=>'tooltip',
		'title'=>'Importar desde Excel',
]) }}

@push('modals')
<div class="modal fade" id="pregModalImport" role="dialog" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content panel-info">
			<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
				<h4 class="modal-title">
					Importar XLS con usuarios
					<span class="pull-right">
						<a class='btn btn-info btn-xs' role='button' href="{{ asset('templates/TemplateImportUsers.xlsx') }}" download>
							<i class="fa fa-download" aria-hidden="true"></i> Descargar plantilla
						</a>
					</span>
				</h4>
			</div>
			<div class="modal-body">
				{{ Form::open( [ 'url'=>'usuarios/importXLS', 'class'=>'form-vertical', 'files'=>true ]) }}
					<div class="form-group">
						{{ Form::label('archivo', 'Archivo') }}
						{{ Form::file('archivo', [ 'class' => 'form-control', 'accept' => '.xls*', 'required']) }}
					</div>
			</div>
			<div class="modal-footer">
					{{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Cancelar', [ 'class'=>'btn btn-default', 'data-dismiss'=>'modal', 'type'=>'button' ]) }}
					{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endpush
