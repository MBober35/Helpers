@foreach($structure as $menuItem)
    @if ($menuItem->template)
        template
    @elseif ($menuItem->url)
        @if ($gate = $menuItem->gate)
            @can($gate, $menuItem->gateParam)
                <li class="{{ active_state()->getKitListClass($menuItem, "sidebar-item") }}">
                    @include("helpers::includes.kit-link", ["link" => $menuItem, "begin" => "sidebar-link"])
                </li>
            @endcan
        @else
            <li class="{{ active_state()->getKitListClass($menuItem, "sidebar-item") }}">
                @include("helpers::includes.kit-link", ["link" => $menuItem, "begin" => "sidebar-link"])
            </li>
        @endif
    @endif
@endforeach