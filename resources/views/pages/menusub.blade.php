@foreach($childs as $child)
    @php
        $hasActiveChild = false;
        foreach($child->children as $subchild) {
            if(Request::is('frontpage/'.$subchild->slug) || Request::is('produkhukum/'.$subchild->slug)) {
                $hasActiveChild = true;
            }
        }
    @endphp
    @if($menu_arr[$child->menu_name] == 'Show' && $is_active[$child->menu_name] == 1)
        <li class="nav-item">
            @if(($child->type_doc > 0 && $child->type_ruledoc == 0) || $child->type_ruledoc == 0)
                @if(empty($child->free_link))
                    <a class="nav-link {{ count($child->children) ? 'dropdown-toggle' :'' }} @if(Request::is('frontpage/'.$child->slug) || $hasActiveChild) active @endif" href="{{ count($child->children) ? 'javascript:void(0);' : route('front.frontpage', ['slug' => $child->slug]) }}">
                @else
                    <a target="_blank" class="nav-link {{ count($child->children) ? 'dropdown-toggle' :'' }} @if(Request::is('frontpage/'.$child->slug) || $hasActiveChild) active @endif" href="{{ count($child->children) ? 'javascript:void(0);' : $child->free_link }}">
                @endif
            @else
                @if(empty($child->free_link))
                    <a class="nav-link {{ count($child->children) ? 'dropdown-toggle' :'' }} @if(Request::is('produkhukum/'.$child->slug) || $hasActiveChild) active @endif" href="{{ count($child->children) ? 'javascript:void(0);' : route('front.peraturanhukum', ['slug' => $child->slug]) }}">
                @else
                    <a target="_blank" class="nav-link {{ count($child->children) ? 'dropdown-toggle' :'' }} @if(Request::is('produkhukum/'.$child->slug) || $hasActiveChild) active @endif" href="{{ count($child->children) ? 'javascript:void(0);' : $child->free_link }}">
                @endif
            @endif
                {{ translateText($child->menu_name) }}
                @if(count($child->children))
                    <i class="fas fa-fw fa-caret-right"></i>
                @endif
            </a>
            @if(count($child->children))
            <ul class="dropdown-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.peraturanhukum', ['slug' => $child->slug]) }}">
                        @include('pages.menusub',['childs' => $child->children])
                    </a>
                </li>
            </ul>
            @endif
        </li>
    @endif
@endforeach
