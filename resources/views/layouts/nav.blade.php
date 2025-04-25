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
        <a href="{{ url('/') }}" class="logo">
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
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light pl-5">
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
                            ($menu_arr['Tupoksi'] == 'Hide') &&
                            ($menu_arr['Dasar Hukum'] == 'Hide') &&
                            ($menu_arr['Anggota JDIH Provinsi Banten'] == 'Hide') &&
                            ($menu_arr['SOP'] == 'Hide')
                        )
                        @else
                            <li class="nav-item @if($conName[0] == 'visi-misi') active @endif">
                                <a href="javascript:void(0);" class="nav-link @if($conName[0] == 'visi-misi' || $conName[0] == 'struktur-organisasi' || $conName[0] == 'tupoksi' || $conName[0] == 'dasar-hukum' || $conName[0] == 'sop' || $conName[0] == 'anggota-jdih') active @endif dropdown-toggle">
                                    {{ translateText('Profil Kami') }}
                                </a>
                                <ul class="dropdown-menu">

                                    @if($menu_arr['Visi dan Misi'] == 'Show' && $is_active['Visi dan Misi'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.visimisi') }}" class="nav-link @if($conName[0] == 'visi-misi') active @endif">
                                            {{ translateText('Visi dan Misi') }}
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @if($menu_arr['Dasar Hukum'] == 'Show' && $is_active['Dasar Hukum'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.dasarhukum') }}" class="nav-link @if($conName[0] == 'dasar-hukum') active @endif">
                                            {{ translateText('Dasar Hukum') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if($menu_arr['Struktur Organisasi'] == 'Show' && $is_active['Struktur Organisasi'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.strukturorganisasi') }}" class="nav-link @if($conName[0] == 'struktur-organisasi') active @endif">
                                            {{ translateText('Struktur Organisasi') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if($menu_arr['Tupoksi'] == 'Show' && $is_active['Tupoksi'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.tupoksi') }}" class="nav-link @if($conName[0] == 'tupoksi') active @endif">
                                            {{ translateText('Tupoksi Biro Hukum') }}
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @if($menu_arr['Anggota JDIH Provinsi Banten'] == 'Show' && $is_active['Anggota JDIH Provinsi Banten'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.anggotajdih') }}" class="nav-link @if($conName[0] == 'anggota-jdih') active @endif">
                                            {{ translateText('Anggota JDIH Provinsi Banten') }}
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @if($menu_arr['SOP'] == 'Show' && $is_active['SOP'] == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('front.sop') }}" class="nav-link @if($conName[0] == 'sop') active @endif">
                                            {{ translateText('SOP') }}
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
                            @php
                                $hasActiveChild = false;
                                foreach($item->children as $child) {
                                    if(Request::is('frontpage/'.$child->slug)) {
                                        $hasActiveChild = true;
                                    }
                                    
                                    if(Request::is('produkhukum/'.$child->slug)) {
                                        $hasActiveChild = true;
                                    }
                                }
                            @endphp
                            @if($menu_arr[$item->menu_name] == 'Show' && $is_active[$item->menu_name] == 1)
                            <li class="nav-item">
                                <a class="nav-link {{ count($item->children) ? 'dropdown-toggle' :'' }} @if(Request::is('frontpage/'.$item->slug) || $hasActiveChild) active @endif" href="{{ count($item->children) ? 'javascript:void(0);' : route('front.frontpage', ['slug' => $item->slug]) }}" id="navbarDropdownMenuLink" data-toggle="{{ count($item->children) ? 'dropdown' : '' }}" aria-haspopup="true" aria-expanded="false">
                                    {{ translateText($item->menu_name) }}
                                </a>
                                @if(count($item->children))
                                    <ul class="dropdown-menu">
                                        @include('pages.menusub',['childs' => $item->children])
                                    </ul>
                                @endif
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
