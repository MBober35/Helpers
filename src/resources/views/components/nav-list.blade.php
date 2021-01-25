@foreach($structure as $menuItem)
    @if ($menuItem->template)
        template
    @elseif ($menuItem->url)
        @if ($gate = $menuItem->gate)
            @can($gate)
                <li class="{{ active_state()->getListClass($menuItem, "nav-item") }}">
                    @include("helpers::includes.nav-link", ["link" => $menuItem, "begin" => "nav-link", "active" => active_state()->getActive($menuItem)])
                </li>
            @endcan
        @else
            <li class="{{ active_state()->getListClass($menuItem, "nav-item") }}">
                @include("helpers::includes.nav-link", ["link" => $menuItem, "begin" => "nav-link", "active" => active_state()->getActive($menuItem)])
            </li>
        @endif
    @endif
@endforeach