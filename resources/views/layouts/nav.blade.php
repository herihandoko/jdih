@php
$menus = DB::table('menus')->get();
$menu_arr = array();
$is_active = array();
@endphp

@foreach($menus as $row)
    @php
        $menu_arr[$row->menu_name] = $row->menu_status;
        $is_active[$row->menu_name] = $row->is_active;
    @endphp
@endforeach

<!-- Start Navbar Area -->
<div class="navbar-area" id="stickymenu">

    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="" class="logo">
            <img src="{{ asset('storage/places/'.$g_setting->logo) }}" alt="">
        </a>
    </div>

    @php
        $url = Request::path();
        $conName = explode('/',$url);
        if(!isset($conName[3]))
        {
            $conName[3] = '';
        }
        if(!isset($conName[2]))
        {
            $conName[2] = '';
        }
        if(!isset($conName[1]))
        {
            $conName[1] = '';
        }
    @endphp

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('storage/places/'.$g_setting->logo) }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                        @if($menu_arr['Beranda'] == 'Show')
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link @if($conName[0] == '') active @endif">Beranda</a>
                            </li>
                        @endif

                        @if(
                            ($menu_arr['Visi dan Misi'] == 'Hide') &&
                            ($menu_arr['Struktur Organisasi'] == 'Hide') &&
                            ($menu_arr['Tupoksi'] == 'Hide')
                        )
                        @else
                            <li class="nav-item @if($conName[0] == 'visi-misi') active @endif">
                                <a href="javascript:void(0);" class="nav-link @if($conName[0] == 'visi-misi' || $conName[0] == 'struktur-organisasi' || $conName[0] == 'tupoksi') active @endif dropdown-toggle">Profil</a>
                                <ul class="dropdown-menu">

                                    @if($menu_arr['Visi dan Misi'] == 'Show' && $is_active['Visi dan Misi'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.visimisi') }}" class="nav-link @if($conName[0] == 'visi-misi') active @endif">
                                            Visi dan Misi
                                        </a>
                                    </li>
                                    @endif

                                    @if($menu_arr['Struktur Organisasi'] == 'Show' && $is_active['Struktur Organisasi'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.strukturorganisasi') }}" class="nav-link @if($conName[0] == 'struktur-organisasi') active @endif">
                                            Struktur Organisasi
                                        </a>
                                    </li>
                                    @endif

                                    @if($menu_arr['Tupoksi'] == 'Show' && $is_active['Tupoksi'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.tupoksi') }}" class="nav-link @if($conName[0] == 'tupoksi') active @endif">
                                            Tupoksi
                                        </a>
                                    </li>
                                    @endif

                                </ul>
                            </li>
                        @endif
                        
                        @php
                            $menu = new App\Models\Admin\Menu;
                            $parentIdIn = $menu::where('parent_id', '=', 0)->where('editabled', '=', 1)->orderBy('order', 'asc')->get();
                        @endphp

                        @foreach($parentIdIn as $user)
                            @php
                                $numberId[] = $user->parent_id;

                                $menuList = $menu::where('parent_id', '=', 0)->whereIn('id', $numberId)->get();
                            @endphp
                        @endforeach
                        
                        @foreach($parentIdIn as $item)
                            @if($menu_arr[$item->menu_name] == 'Show' && $is_active[$item->menu_name] == 1)
                            <li class="nav-item">
                                <a class="nav-link {{ count($item->children) ? 'dropdown-toggle' :'' }}" href="{{ count($item->children) ? 'javascript:void(0);' : '/frontpage/'.$item->slug }}" id="navbarDropdownMenuLink" data-toggle="{{ count($item->children) ? 'dropdown' : '' }}" aria-haspopup="true" aria-expanded="false">
                                    {{ $item->menu_name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @if(count($item->children))
                                        @include('pages.menusub',['childs' => $item->children])
                                    @endif
                                </ul>
                            </li>
                            @endif
                        @endforeach

                        @if(
                            ($menu_arr['SPM/IPM'] == 'Hide')
                        )
                        @else
                            <li class="nav-item">
                                <a href="{{ route('front.spmipm') }}" class="nav-link @if($conName[0] == 'spmipm') active @endif">SPM/IPM</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
