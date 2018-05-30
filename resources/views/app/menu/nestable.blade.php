@push('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{!! Html::style('assets/stylesheets/nestable.css') !!}
	{!! Html::style('assets/stylesheets/toastr.min.css') !!}
@endpush

@push('scripts')
	{!! Html::script('assets/scripts/jquery/jquery.nestable.js') !!}
	{!! Html::script('assets/scripts/toastr.min.js') !!}
	<script type="text/javascript">
	$(function() {
		var csrfToken = $('meta[name="csrf-token"]').attr('content');
		toastr.options.closeMethod = 'fadeOut';
		toastr.options.closeDuration = 2000;
		toastr.options.closeEasing = 'swing';
		toastr.options.progressBar = true;
		toastr.options.positionClass = 'toast-top-left';

		$('.dd').nestable({
			maxDepth: 2,
			dropCallback: function(details) {
				
				var order = new Array();
				$("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
					order[index] = $(elem).attr('data-id');
				});


				if (order.length === 0){
					var rootOrder = new Array();
					details.destRoot.find('ol > li').each(function(index,elem) {
						rootOrder[index] = $(elem).attr('data-id');
					});
				}
				
				$.ajax({
					url: '{{url("app/menu/reorder")}}',
					data: {
						source:      details.sourceId, 
						destination: details.destId, 
						order:       JSON.stringify(order),
						rootOrder:   JSON.stringify(rootOrder),
						position:    details.destRoot.attr('data-position')
					},
					dataType: 'json',
					type:     'POST',
					headers: {'X-CSRF-TOKEN': csrfToken}
				})
				.done(function( data, textStatus, jqXHR ) {
					//$( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();
					toastr['success']('Orden del menú guardado.', 'OK');
				})
				.fail(function( jqXHR, textStatus, errorThrown ) {
					//console.log('Err: '+JSON.stringify(jqXHR));
					//$('#response').html(event.responseText);
				})
				.always(function( data, textStatus, jqXHR ) {
					if (jqXHR === 'Forbidden')
						toastr['error']('Error en la conexión con el servidor. Presione F5.', 'Error');
					
					if (typeof jqXHR.responseJSON === 'undefined')
						toastr['error']('NetworkError: 500 Internal Server Error.', 'Error');
				});
			}

		}).nestable('collapseAll');

		$('.delete_toggle').each(function(index,elem) {
			$(elem).click(function(e){
				e.preventDefault();
				$('#postvalue').attr('value',$(elem).attr('rel'));
				$('#deleteModal').modal('toggle');
			});
		});

	});
	</script>
@endpush
