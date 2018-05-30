<nav role="navigation" style="margin-bottom: 0; margin-top: -1px;">
	<div class="navbar-default sidebar" role="navigation">

		<div class="sidebar-nav navbar-collapse" id="sidebar-area">
			<ul class="nav" id="sidebar">

				@rinclude('menu-left-search')

				@if(isset($menusLeft))
                @foreach ($menusLeft as $key => $item)
					{{-- @if(Entrust::can(['usuarios-*', 'roles-*', 'permisos-*'])) --}}
	                    @if ($item['MENU_PARENT'] != 0)
	                        @break
	                    @endif
	                    @include('layouts.menu.menu-left-list', ['item' => $item])
	                {{-- @endif --}}
                @endforeach
				@endif
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
</nav>
<!-- /.navbar-static-side -->
