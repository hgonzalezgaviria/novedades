@rinclude('datatable')

@push('scripts')
<script type="text/javascript">
	$(function () {
		@rinclude('datatable-footer')

		var tbIndex = $('#tabla').DataTable();

		@rinclude('datatable-filters')
	});
</script>
@endpush
