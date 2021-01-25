<a class="{{ active_state()->getLinkClass($link, $active, $begin) }}"
   @if ($link->children)
   id="item-drop-{{ $link->id }}"
   role="button"
   data-bs-toggle="dropdown"
   aria-haspopup="true"
   aria-expanded="false"
   @endif
   href="{{ $link->route ? route($link->route) : ($link->url ?? "#") }}"
   @if ($link->target) target="{{ $link->target }}" @endif>
    @if ($link->ico) <i class="{{ $link->ico }}"></i> @endif
    {{ $link->title }}
</a>
@if ($link->children)
    <div class="dropdown-menu" aria-labelledby="item-drop-{{ $link->id }}">
        @foreach($link->children as $child)
            @include('helpers::includes.nav-link', ['link' => $child, 'begin' => "dropdown-item", 'active' => false])
        @endforeach
    </div>
@endif