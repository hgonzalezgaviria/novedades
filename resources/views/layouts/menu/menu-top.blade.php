<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">

        <div class="col-xs-1">
            <a class="navbar-brand" href="{{ url ('') }}" >Vacantes</a>
            <!--menu toggle button -->
            <button id="menu-toggle" type="button" data-toggle="button" class="menu-toggler sidebar-toggler btn btn-link" style="margin-left: 0px;color: #333;">
                <i class="fa fa-toggle-off fa-fw"></i>
            </button>
        </div>

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Menú</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <ul class="nav navbar-top-links navbar-right">

                @if(isset($menusTop))

                @foreach ($menusTop as $key => $item)
                    {{-- @if(Entrust::can(['usuarios-*', 'roles-*', 'permisos-*'])) --}}
                        @if ($item['MENU_PARENT'] != 0)
                            @break
                        @endif

                        @include('layouts.menu.menu-top-list', ['item' => $item])
                    {{-- @endif --}}
                @endforeach
                @endif

                <!-- /.dropdown -->
                @if( null !== Auth::user() )
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url('app/parameters') }}"><i class="fa fa-user fa-fw"></i> Parametrizar {{ Auth::user()->username }}</a></li>
                        <li><a href="{{ url('password/reset') }}"><i class="fa fa-key fa-fw"></i> Cambiar contraseña</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                @endif
            </ul>
            
        </div>
    </nav> <!-- /.navbar-header -->
</header>