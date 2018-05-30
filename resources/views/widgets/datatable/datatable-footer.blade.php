var tfoot = $("#tabla thead tr").clone();
tfoot
	.find('th:not(.notFilter)').removeClass(function (index, className) {
		return (className.match (/\bcol-\S+/g) || []).join(' ');
	})
	.html( function (index, oldhtml) {
		var text = 'Buscar '+oldhtml;
		return '<input type="text" class="form-control input-sm" style="width:98%" title="'+text+'" placeholder="'+text+'"  />';
	})
	.css('padding','8px 0px');

$('#tabla').append(
	$('<tfoot/>').append( tfoot )
)
