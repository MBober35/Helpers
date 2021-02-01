<a class="{{ active_state()->getKitLinkClass($link, $begin) }}"
   @if ($link->children)
   data-bs-toggle="collapse"
   href="#item-drop-{{ $link->id }}"
   @else
   href="{{ $link->route ? route($link->route) : ($link->url ?? "#") }}"
   @endif
   @if ($link->target) target="{{ $link->target }}" @endif>
    @if ($link->ico) <i class="align-middle {{ $link->ico }}"></i> @endif
    @if ($link->feather) <i class="align-middle" data-feather="{{ $link->feather }}"></i> @endif
    <span class="align-middle">{{ $link->title }}</span>
</a>
@if ($link->children)
    <ul class="sidebar-dropdown list-unstyled collapse"
        data-parent="#sidebar"
        id="item-drop-{{ $link->id }}" aria-labelledby="item-drop-{{ $link->id }}">
        @foreach($link->children as $child)
            <li class="sidebar-item">
                @include('helpers::includes.nav-link', ['link' => $child, 'begin' => "sidebar-link", 'active' => false])
            </li>
        @endforeach
    </ul>
@endif