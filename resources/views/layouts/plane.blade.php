<!DOCTYPE html>
<!--[if IE 8]> <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es" class="no-js">
<!--<![endif]-->
	<head>
		<title>Vacantes @yield('title')</title>
		{!! Html::meta( null, 'IE=edge', [ 'http-equiv'=>'X-UA-Compatible' ] ) !!}
		{!! Html::meta( null, 'text/html; charset=utf-8', [ 'http-equiv'=>'Content-Type' ] ) !!}
		{!! Html::favicon('favicon.ico') !!}
		{!! Html::meta( 'viewport', 'width=device-width, initial-scale=1') !!}
		<meta content="" name="description"/>
		<meta content="" name="author"/>

		{!! Html::style('assets/stylesheets/bootstrap/bootstrap.min.css') !!}
		{!! Html::style('assets/stylesheets/bootstrap/bootstrap-theme.min.css') !!}
		{!! Html::style('assets/stylesheets/font-awesome.min.css') !!}
		{!! Html::style('assets/stylesheets/metisMenu.min.css') !!}
		{!! Html::style('assets/stylesheets/pace-theme-flash.css') !!}
		{!! Html::script('assets/scripts/pace.min.js') !!}
		{!! Html::style('assets/stylesheets/sb-admin-2.css') !!}
		{!! Html::style('assets/stylesheets/dropdown-menu.css') !!}

		@stack('head')
	</head>

	<body class="sidebar-closed">
		@yield('body')

		{!! Html::script('assets/scripts/jquery/jquery.min.js') !!}
		{!! Html::script('assets/scripts/bootstrap/bootstrap.min.js') !!}
		{!! Html::script('assets/scripts/metisMenu.min.js') !!}
		{!! Html::script('assets/scripts/sb-admin-2.js') !!}
		<script type="text/javascript">
			$(function () {
				//Si el formulario presenta error, realizará focus al primer elemento con error.
				//$('#{{--current($errors->keys())--}}').focus();

				//Activa los tooltip de Boostrap
				tooltips = $('[data-tooltip="tooltip"]');
				if(tooltips.length > 0)
					tooltips.tooltip();
			});
		</script>
		@stack('scripts')

		@stack('modals')
		@include('widgets.modal-loading')

		<footer class="footer navbar-default navbar-fixed-bottom" style="margin-right: 10px">
			<div class="text-right text-muted">
				<small>Vacantes&copy; powered by <i>diheke</i></small>
			</div>
		</footer>
	</body>
</html>