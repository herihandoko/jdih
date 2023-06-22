@foreach($childs as $child)
    @if($menu_arr[$child->menu_name] == 'Show' && $is_active[$child->menu_name] == 1)
        @if(!empty($conName[1]))
            <li class="nav-item">
                @if($child->type_doc > 0 && $child->type_ruledoc == 0)
                    @if(empty($child->free_link))
                        <a class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : '/frontpage/'.$child->slug }}">
                    @else
                        <a target="_blank" class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : $child->free_link }}">
                    @endif
                @else
                    @if(empty($child->free_link))
                        <a class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : '/produkhukum/'.$child->slug }}">
                    @else
                        <a target="_blank" class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : $child->free_link }}">
                    @endif
                @endif
                    {{ $child->menu_name }}
                    @if(count($child->children) && $is_active[$child->menu_name] == 1)
                        <i class="fas fa-fw fa-caret-right"></i>
                    @endif
                </a>
                @if(count($child->children))
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ '/produkhukum/'.$child->slug }}" style="position: absolute;">
                            @include('pages.menusub',['childs' => $child->children])
                        </a>
                    </li>
                </ul>
                @endif
            </li>
        @else
            <li class="nav-item">
                @if($child->type_doc > 0 && $child->type_ruledoc == 0)
                    @if(empty($child->free_link))
                        <a class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : '/frontpage/'.$child->slug }}">
                    @else
                        <a target="_blank" class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : $child->free_link }}">
                    @endif
                @else
                    @if(empty($child->free_link))
                        <a class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : '/produkhukum/'.$child->slug }}">
                    @else
                        <a target="_blank" class="nav-link {{ count($child->children) ? '' :'' }}" href="{{ count($child->children) ? 'javascript:void(0);' : $child->free_link }}">
                    @endif
                @endif
                    {{ $child->menu_name }}
                    @if(count($child->children))
                        <i class="fas fa-fw fa-caret-right"></i>
                    @endif
                </a>
                @if(count($child->children))
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ '/produkhukum/'.$child->slug }}" style="position: absolute;">
                            @include('pages.menusub',['childs' => $child->children])
                        </a>
                    </li>
                </ul>
                @endif
            </li>
        @endif
    @endif
@endforeach