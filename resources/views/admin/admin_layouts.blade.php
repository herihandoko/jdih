@php
$g_setting = DB::table('general_settings')->where('id', 1)->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Administrator JDIH</title>

    @include('admin.includes.styles')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset('storage/places/'.$g_setting->favicon) }}" rel="shortcut icon" type="image/png">

    @include('admin.includes.scripts')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar">

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
            @endphp

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-text mx-3">Administrator JDIH</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item @if($conName[1] == 'dashboard') active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Survey Kepuasan -->
            <li class="nav-item @if($conName[1] == 'survey') active @endif">
                <a class="nav-link" href="{{ route('admin.survey') }}">
                    <i class="fas fa-fw fa-square-poll-vertical"></i>
                    <span>Survey Kepuasan</span>
                </a>
            </li>

            <!-- Integrasi API -->
            <li class="nav-item @if($conName[1] == 'api-link') active @endif">
                <a class="nav-link" href="{{ route('admin.apilink.index') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Integrasi API</span>
                </a>
            </li>

            @php $arr_one = array(); @endphp
            @if(session('role_id')!=1)
            @php
            $row = array();
            $access_data = DB::table('role_permissions')
            ->join('role_pages', 'role_permissions.role_page_id', 'role_pages.id')
            ->where('role_id', session('role_id'))
            ->get();
            @endphp
            @foreach($access_data as $row)
            @php
            if($row->access_status == 1):
            $arr_one[] = $row->page_title;
            endif;
            @endphp
            @endforeach
            @endif

            <!-- General Settings -->
            @php if( in_array('General Settings', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[1] == 'setting' && $conName[2] == 'general' || $conName[1] == 'page-manage' || $conName[1] == 'menu') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
                    <i class="fas fa-fw fa-gears"></i>
                    <span>General Settings</span>
                </a>
                <div id="collapseSetting" class="collapse @if($conName[1] == 'setting' && $conName[2] == 'general' || $conName[1] == 'page-manage' || $conName[1] == 'menu') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @if($conName[3] == 'logo') active @endif" href="{{ route('admin.general_setting.logo') }}">Logo</a>
                        <a class="collapse-item @if($conName[3] == 'bannerandroid') active @endif" href="{{ route('admin.general_setting.bannerandroid') }}">Banner Android</a>
                        <a class="collapse-item @if($conName[3] == 'favicon') active @endif" href="{{ route('admin.general_setting.favicon') }}">Favicon</a>
                        <a class="collapse-item @if($conName[3] == 'loginbg') active @endif" href="{{ route('admin.general_setting.loginbg') }}">Login Background</a>
                        <a class="collapse-item @if($conName[3] == 'topbar') active @endif" href="{{ route('admin.general_setting.topbar') }}">Top Bar</a>
                        <a class="collapse-item @if($conName[3] == 'banner') active @endif" href="{{ route('admin.general_setting.banner') }}">Banner</a>
                        <a class="collapse-item @if($conName[3] == 'footer') active @endif" href="{{ route('admin.general_setting.footer') }}">Footer</a>
                        <a class="collapse-item @if($conName[3] == 'sidebar') active @endif" href="{{ route('admin.general_setting.sidebar') }}">Sidebar</a>
                        <a class="collapse-item @if($conName[3] == 'color') active @endif" href="{{ route('admin.general_setting.color') }}">Color</a>
                        <a class="collapse-item @if($conName[3] == 'preloader') active @endif" href="{{ route('admin.general_setting.preloader') }}">Preloader</a>
                        <a class="collapse-item @if($conName[3] == 'stickyheader') active @endif" href="{{ route('admin.general_setting.stickyheader') }}">Sticky Header</a>
                        <!--                    <a class="collapse-item @if($conName[3] == 'googleanalytic') active @endif" href="{{ route('admin.general_setting.googleanalytic') }}">Google Analytic</a>
                    <a class="collapse-item @if($conName[3] == 'googlerecaptcha') active @endif" href="{{ route('admin.general_setting.googlerecaptcha') }}">Google Recaptcha</a>
                    <a class="collapse-item @if($conName[3] == 'tawklivechat') active @endif" href="{{ route('admin.general_setting.tawklivechat') }}">Tawk Live Chat</a>
                    <a class="collapse-item @if($conName[3] == 'cookieconsent') active @endif" href="{{ route('admin.general_setting.cookieconsent') }}">Cookie Consent</a>-->
                        @php if( in_array('Page Manage', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'page-manage') active @endif" href="{{ route('admin.page.index') }}">Page Manage</a>
                        @endif

                        @php if( in_array('Menu Manage', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'menu') active @endif" href="{{ route('admin.menu.index') }}">Menu Manage</a>
                        @endif
                    </div>
                </div>
            </li>
            @endif

            <!-- Admin Users Section -->
            @php if( in_array('User Section', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[1] == 'role' || $conName[1] == 'admin-user' || $conName[1] == 'company') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminUser" aria-expanded="true" aria-controls="collapseAdminUser">
                    <i class="fas fa-fw fa-people-group"></i>
                    <span>User Management</span>
                </a>
                <div id="collapseAdminUser" class="collapse @if($conName[1] == 'role' || $conName[1] == 'admin-user' || $conName[1] == 'company') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @if($conName[1] == 'company') active @endif" href="{{ route('admin.company.index') }}">
                            Dinas
                        </a>

                        <a class="collapse-item @if($conName[2] == 'index') active @endif" href="{{ route('admin.role.index') }}">
                            Roles
                        </a>

                        <a class="collapse-item @if($conName[2] == 'user') active @endif" href="{{ route('admin.role.user') }}">
                            Users
                        </a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Page Settings -->
            @php if( in_array('Page Settings', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[1] == 'page' || $conName[1] == 'social-media' || $conName[1] == 'slider' || $conName[1] == 'footer') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePageSettings" aria-expanded="true" aria-controls="collapsePageSettings">
                    <i class="fas fa-fw fa-paste"></i>
                    <span>Page Settings</span>
                </a>
                <div id="collapsePageSettings" class="collapse @if($conName[1] == 'page' || $conName[1] == 'social-media' || $conName[1] == 'slider' || $conName[1] == 'footer') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @if($conName[2] == 'home') active @endif" href="{{ route('admin.page_home.edit') }}">
                            Beranda
                        </a>

                        @php if( in_array('Sliders', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'slider') active @endif" href="{{ route('admin.slider.index') }}">Sliders</a>
                        @endif

                        @php if( in_array('Social Media', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'social-media') active @endif" href="{{ route('admin.social_media.index') }}">Social Media</a>
                        @endif

                        @php if( in_array('Footer Columns', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'footer') active @endif" href="{{ route('admin.footer.index') }}">Footer Columns</a>
                        @endif

                        <a class="collapse-item @if($conName[2] == 'contact') active @endif" href="{{ route('admin.page_contact.edit') }}">
                            Kontak
                        </a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Informasi -->
            @php if( in_array('Informasi', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[1] == 'page-visimisi' || $conName[1] == 'page-strukturorganisasi' || $conName[1] == 'page-tupoksi' || $conName[2] == 'berita' || $conName[2] == 'category-berita' || $conName[1] == 'photo-gallery' || $conName[1] == 'video-gallery' || $conName[1] == 'privacy' || $conName[1] == 'daftar-lbh' || $conName[1] == 'page-dasarhukum' || $conName[1] == 'page-sop') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWebSection" aria-expanded="true" aria-controls="collapseWebSection">
                    <i class="fas fa-fw fa-globe"></i>
                    <span>Informasi</span>
                </a>
                <div id="collapseWebSection" class="collapse @if($conName[1] == 'page-visimisi' || $conName[1] == 'page-strukturorganisasi' || $conName[1] == 'page-tupoksi' || $conName[2] == 'berita' || $conName[2] == 'category-berita' || $conName[1] == 'photo-gallery' || $conName[1] == 'video-gallery' || $conName[1] == 'privacy' || $conName[1] == 'daftar-lbh' || $conName[1] == 'page-dasarhukum' || $conName[1] == 'page-sop') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @php if( in_array('Visi dan Misi', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'page-visimisi') active @endif" href="{{ route('admin.web_setting.page_visimisi') }}">
                            Visi dan Misi
                        </a>
                        @endif

                        @php if( in_array('Struktur Organisasi', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'page-strukturorganisasi') active @endif" href="{{ route('admin.web_setting.page_strukturorganisasi') }}">
                            Struktur Organisasi
                        </a>
                        @endif

                        @php if( in_array('Tupoksi', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'page-tupoksi') active @endif" href="{{ route('admin.web_setting.page_tupoksi') }}">
                            Tupoksi
                        </a>
                        @endif

                        @php if( in_array('Dasar Hukum', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'page-dasarhukum') active @endif" href="{{ route('admin.web_setting.page_dasarhukum') }}">
                            Dasar Hukum
                        </a>
                        @endif

                        @php if( in_array('SOP', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'page-sop') active @endif" href="{{ route('admin.web_setting.page_sop') }}">
                            SOP
                        </a>
                        @endif

                        @php if( in_array('Berita', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="sub-nav-link collapsed sub-collapse-item" style="font-weight: 900;" href="#" data-toggle="collapse" data-target="#collapseSubWebSection" aria-expanded="true" aria-controls="collapseSubWebSection">
                            Berita
                        </a>
                        <div id="collapseSubWebSection" class="collapse" aria-labelledby="headingPages" data-parent="#collapseSubWebSection">
                            @php if( session('role_id')==1 ): @endphp
                            <a class="collapse-item @if($conName[2] == 'category-berita') active @endif" href="{{ route('admin.media_hukum.berita.category') }}">
                                Kategori Berita
                            </a>
                            @endif

                            <a class="collapse-item @if($conName[2] == 'berita') active @endif" href="{{ route('admin.media_hukum.berita.index') }}">
                                Daftar Berita
                            </a>
                        </div>
                        @endif

                        @php if( in_array('Galeri Foto', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'photo-gallery') active @endif" href="{{ route('admin.photo.index') }}">
                            Galeri Foto
                        </a>
                        @endif

                        @php if( in_array('Video', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'video-gallery') active @endif" href="{{ route('admin.video.index') }}">
                            Video
                        </a>
                        @endif

                        @php if( in_array('Daftar LBH', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'daftar-lbh') active @endif" href="{{ route('admin.daftar_lbh.index') }}">
                            Daftar LBH
                        </a>
                        @endif

                        <a class="collapse-item @if($conName[1] == 'privacy') active @endif" href="{{ route('admin.web_setting.page_privacy.edit') }}">
                            Privacy Policy
                        </a>

                    </div>
                </div>
            </li>
            @endif

            <!-- Produk Hukum -->
            @php if( in_array('Produk Hukum', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[2] == 'tipe-dokumen' || $conName[2] == 'jenis-peraturan' || $conName[2] == 'list-data' || $conName[2] == 'urusan-pemerintahan' || $conName[2] == 'bidang-hukum' || $conName[2] == 'bahasa') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProdukHukum" aria-expanded="true" aria-controls="collapseProdukHukum">
                    <i class="fas fa-fw fa-scale-balanced"></i>
                    <span>Produk Hukum</span>
                </a>
                <div id="collapseProdukHukum" class="collapse @if($conName[2] == 'tipe-dokumen' || $conName[2] == 'jenis-peraturan' || $conName[2] == 'list-data' || $conName[2] == 'urusan-pemerintahan' || $conName[2] == 'bidang-hukum' || $conName[2] == 'bahasa') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @php if( in_array('Jenis Dokumen', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'tipe-dokumen') active @endif" href="{{ route('admin.produk_hukum.tipe.index') }}">Jenis Dokumen</a>
                        @endif

                        @php if( in_array('Jenis Peraturan', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'jenis-peraturan') active @endif" href="{{ route('admin.produk_hukum.jenis.index') }}">Jenis Peraturan</a>
                        @endif

                        @php if( in_array('Urusan Pemerintahan', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'urusan-pemerintahan') active @endif" href="{{ route('admin.produk_hukum.up.index') }}">Urusan Pemerintahan</a>
                        @endif

                        @php if( in_array('Bidang Hukum', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'bidang-hukum') active @endif" href="{{ route('admin.produk_hukum.bh.index') }}">Bidang Hukum</a>
                        @endif
                        
                        @php if( in_array('Bahasa', $arr_one) || session('role_id')==1 ): @endphp
                            <a class="collapse-item @if($conName[2] == 'bahasa') active @endif" href="{{ route('admin.produk_hukum.bahasa.index') }}">Bahasa</a>
                        @endif

                        @php if( in_array('Daftar Produk Hukum', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'list-data') active @endif" href="{{ route('admin.produk_hukum.listdata.index') }}">Daftar Produk</a>
                        @endif

                    </div>
                </div>
            </li>
            @endif

            <!-- Layanan Hukum -->
            @php if( in_array('Layanan Hukum', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[2] == 'bimtek-hibrid') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayananHukum" aria-expanded="true" aria-controls="collapseLayananHukum">
                    <i class="fas fa-fw fa-building-flag"></i>
                    <span>Layanan Hukum</span>
                </a>
                <div id="collapseLayananHukum" class="collapse @if($conName[2] == 'bimtek-hibrid') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @php if( in_array('Bimtek Hybrid', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'bimtek-hibrid') active @endif" href="{{ route('admin.layanan_hukum.bimtekhibrid.index') }}">
                            Bimtek Hybrid
                        </a>
                        @endif

                    </div>
                </div>
            </li>
            @endif

            <!-- Indeks Hukum -->
            @php if( in_array('Indeks Hukum', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[2] == 'irh' || $conName[2] == 'ikk' || $conName[2] == 'ikd') active @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIndeksHukum" aria-expanded="true" aria-controls="collapseIndeksHukum">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Indeks Hukum</span>
                </a>
                <div id="collapseIndeksHukum" class="collapse @if($conName[2] == 'irh' || $conName[2] == 'ikk' || $conName[2] == 'ikd') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @php if( in_array('Indeks IRH', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'indeks-irh') active @endif" href="{{ route('admin.index_hukum.irh.index') }}">
                            IRH
                        </a>
                        @endif

                        @php if( in_array('Indeks IKK', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'indeks-ikk') active @endif" href="{{ route('admin.index_hukum.ikk.index') }}">
                            IKK
                        </a>
                        @endif

                        @php if( in_array('Indeks IKD', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'indeks-ikd') active @endif" href="{{ route('admin.index_hukum.ikd.index') }}">
                            IKD
                        </a>
                        @endif

                    </div>
                </div>
            </li>
            @endif
            @php if( in_array('Hukum Adat', $arr_one) || session('role_id')==1 ): @endphp
            <li class="nav-item @if($conName[1] == 'hukum-adat') active @endif">
                <a class="nav-link" href="{{ route('admin.hukumadat.index') }}">
                    <i class="fas fa-fw fa-scale-balanced"></i>
                    <span>Hukum Adat</span>
                </a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/admin/dashboard') }}" class="nav-link dropdown-toggle">
                                <img class="img-topbar" src="{{ asset('storage/places/'.$g_setting->logo) }}">
                            </a>
                        </li>
                    </ul>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a href="{{ url('/') }}" target="_blank">
                                <span class="fa fa-globe-asia mt-lg-4 text-gray-100"></span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-200 small">
                                    {{ session('name') }}
                                </span>
                                @php
                                if(session('photo') == "") {
                                @endphp
                                <img class="img-profile rounded-circle" src="{{ asset('storage/places/avatar_profile.png') }}" alt="">
                                @php
                                } else {
                                @endphp
                                <img class="img-profile rounded-circle" src="{{ asset('storage/places/'.session('photo')) }}">
                                @php
                                }
                                @endphp
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                @if(session('id') == 1)
                                <a class="dropdown-item" href="{{ route('admin.profile_change') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Ubah Profil
                                </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('admin.password_change') }}">
                                    <i class="fas fa-unlock-alt fa-sm fa-fw mr-2 text-gray-400"></i> Ubah Password
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.photo_change') }}">
                                    <i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i> Ubah Foto
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('admin_content')

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('admin.includes.scripts-footer')

</body>

</html>