<li class="nav nav-first-level">
    <a href="{{ isset($item['MENU_URL']) ? url($item['MENU_URL']) : '#' }}" target="{{ starts_with($item['MENU_URL'], 'http') ? '_blank' : '' }}" class="dropdown-collapse">
        <i class="fa {{ $item['MENU_ICON'] }} fa-fw"></i> 
        <span class="side-menu-title">{{ $item['MENU_LABEL'] }}</span><span class="fa arrow"></span>
    </a>
    @if ($item['submenu'] != [])
        <ul class="nav nav-second-level">
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                    <li>
                        <a href="{{ isset($submenu['MENU_URL']) ? url($submenu['MENU_URL']) : '#' }}" target="{{ starts_with($submenu['MENU_URL'], 'http') ? '_blank' : '' }}">
                            <i class="fa {{ $submenu['MENU_ICON'] }} fa-fw"></i> 
                            {{ $submenu['MENU_LABEL'] }}
                        </a>
                    </li>
                @else
                    @include('layouts.menu.menu-left-list', [ 'item' => $submenu ])
                @endif
            @endforeach
        </ul>
    @endif
</li>
