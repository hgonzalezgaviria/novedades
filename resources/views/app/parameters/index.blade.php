@extends('layouts.menu')
@section('title', '/ Parametrizaciones')
@include('widgets.datatable.datatable-export')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Parametrizaciones
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			
		</div>
	</div>
@endsection

@section('section')
	<div class="media">
		<div class="media-body media-middle">
			@include('widgets.forms.input', ['type'=>'file', 'name'=>'image_logo', 'label'=>'Logo', 'options'=>['accept'=>'image/*']])
		</div>
		<div class="media-left">
			{{ Html::image( getLogo(), 'Fondo', [
				'class'=>'media-object',
				'width'=>'250px',
			]) }}
		</div>
	</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$(function () {


            $.ajax(url, {
                type: 'post',
                data: data,
                processData: false,
                contentType: false,

                beforeSend: function () {
                    _this.submitStart();
                },

                success: function (data) {
                    _this.submitDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    this.showNotice('error', XMLHttpRequest.responseJSON);
                    _this.submitFail(XMLHttpRequest.responseJSON, textStatus || errorThrown);
                },

                complete: function () {
                    _this.submitEnd();
                }
            });


			function changeParameter($parameter, $value){
                data = new FormData(this.$avatarForm[0]),
                _this = this;

				$.ajax({
					//async: false, 
					url: 'admin/changeParameter',
					dataType: "json",
					type: "GET",
					headers: {
						"X-CSRF-TOKEN": $('input[name="_token"]').val()
					},
					success: function($result) {
						var labels = [], data=[], colors=[];
						$result.forEach(function(packet) {
							labels.push(packet[$nameX]);
							data.push(parseInt(packet[$nameY]));
							if(typeof packet['COLOR'] == 'string'){ colors.push(packet['COLOR']); }
						});
						buildChart($title, labels, data, colors, $idCanvas, $type);
					},
					error: function($e){
						console.log('Error ajax: '+$e);
					}
				});
			}
		});
	</script>
@endpush
