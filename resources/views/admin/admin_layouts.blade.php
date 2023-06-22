@php
$g_setting = DB::table('general_settings')->where('id', 1)->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JDIH Administrator</title>

    @include('admin.includes.styles')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('storage/places/'.$g_setting->favicon) }}" rel="shortcut icon" type="image/png">

    @include('admin.includes.scripts')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
            <div class="sidebar-brand-text mx-3">JDIH Administrator</div>
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
                <i class="fas fa-fw fa-file-text"></i>
                <span>Survey Kepuasan</span>

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
        <li class="nav-item @if($conName[1] == 'setting' && $conName[2] == 'general') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
                <i class="fas fa-cog"></i>
                <span>General Settings</span>
            </a>
            <div id="collapseSetting" class="collapse @if($conName[1] == 'setting' && $conName[2] == 'general') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($conName[3] == 'logo') active @endif" href="{{ route('admin.general_setting.logo') }}">Logo</a>
                    <a class="collapse-item @if($conName[3] == 'favicon') active @endif" href="{{ route('admin.general_setting.favicon') }}">Favicon</a>
                    <a class="collapse-item @if($conName[3] == 'loginbg') active @endif" href="{{ route('admin.general_setting.loginbg') }}">Login Background</a>
                    <a class="collapse-item @if($conName[3] == 'topbar') active @endif" href="{{ route('admin.general_setting.topbar') }}">Top Bar</a>
                    <a class="collapse-item @if($conName[3] == 'banner') active @endif" href="{{ route('admin.general_setting.banner') }}">Banner</a>
                    <a class="collapse-item @if($conName[3] == 'footer') active @endif" href="{{ route('admin.general_setting.footer') }}">Footer</a>
                    <a class="collapse-item @if($conName[3] == 'sidebar') active @endif" href="{{ route('admin.general_setting.sidebar') }}">Sidebar</a>
                    <a class="collapse-item @if($conName[3] == 'color') active @endif" href="{{ route('admin.general_setting.color') }}">Color</a>
                    <a class="collapse-item @if($conName[3] == 'preloader') active @endif" href="{{ route('admin.general_setting.preloader') }}">Preloader</a>
                    <a class="collapse-item @if($conName[3] == 'stickyheader') active @endif" href="{{ route('admin.general_setting.stickyheader') }}">Sticky Header</a>
                    <a class="collapse-item @if($conName[3] == 'googleanalytic') active @endif" href="{{ route('admin.general_setting.googleanalytic') }}">Google Analytic</a>
                    <a class="collapse-item @if($conName[3] == 'googlerecaptcha') active @endif" href="{{ route('admin.general_setting.googlerecaptcha') }}">Google Recaptcha</a>
                    <a class="collapse-item @if($conName[3] == 'tawklivechat') active @endif" href="{{ route('admin.general_setting.tawklivechat') }}">Tawk Live Chat</a>
                    <a class="collapse-item @if($conName[3] == 'cookieconsent') active @endif" href="{{ route('admin.general_setting.cookieconsent') }}">Cookie Consent</a>
                </div>
            </div>
        </li>
        @endif


        <!-- Page Settings -->
        @php if( in_array('Page Settings', $arr_one) || session('role_id')==1 ): @endphp
        <li class="nav-item @if($conName[1] == 'page' || $conName[1] == 'social-media' || $conName[1] == 'slider' || $conName[1] == 'menu' || $conName[1] == 'footer') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePageSettings" aria-expanded="true" aria-controls="collapsePageSettings">
                <i class="fas fa-paste"></i>
                <span>Page Settings</span>
            </a>
            <div id="collapsePageSettings" class="collapse @if($conName[1] == 'page' || $conName[1] == 'social-media' || $conName[1] == 'slider' || $conName[1] == 'menu' || $conName[1] == 'footer') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($conName[2] == 'home') active @endif" href="{{ route('admin.page_home.edit') }}">
                        Beranda
                    </a>
                    
                    @php if( in_array('Sliders', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'slider') active @endif" href="{{ route('admin.slider.index') }}">Sliders</a>
                    @endif

                    @php if( in_array('Menu Manage', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[1] == 'menu') active @endif" href="{{ route('admin.menu.index') }}">Menu Manage</a>
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


        <!-- Admin Users Section -->
        @php if( in_array('User Section', $arr_one) || session('role_id')==1 ): @endphp
        <li class="nav-item @if($conName[1] == 'role' || $conName[1] == 'admin-user' || $conName[1] == 'company') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminUser" aria-expanded="true" aria-controls="collapseAdminUser">
                <i class="fas fa-user-secret"></i>
                <span>User Section</span>
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

        <!-- Web Section -->
        @php if( in_array('Web Section', $arr_one) || session('role_id')==1 ): @endphp
        <li class="nav-item @if($conName[1] == 'page-visimisi' || $conName[1] == 'page-strukturorganisasi' || $conName[1] == 'page-tupoksi' || $conName[2] == 'berita' || $conName[2] == 'category-berita' || $conName[1] == 'photo-gallery') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWebSection" aria-expanded="true" aria-controls="collapseWebSection">
                <i class="fas fa-globe"></i>
                <span>Web Section</span>
            </a>
            <div id="collapseWebSection" class="collapse @if($conName[1] == 'page-visimisi' || $conName[1] == 'page-strukturorganisasi' || $conName[1] == 'page-tupoksi' || $conName[2] == 'berita' || $conName[2] == 'category-berita' || $conName[1] == 'photo-gallery') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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
                    
                </div>
            </div>
        </li>
        @endif

        <!-- Produk Hukum -->
        @php if( in_array('Produk Hukum', $arr_one) || session('role_id')==1 ): @endphp
        <li class="nav-item @if($conName[2] == 'tipe-dokumen' || $conName[2] == 'jenis-peraturan' || $conName[2] == 'list-data' || $conName[2] == 'urusan-pemerintahan' || $conName[2] == 'bidang-hukum') active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProdukHukum" aria-expanded="true" aria-controls="collapseProdukHukum">
                <i class="fas fa-book-journal-whills"></i>
                <span>Produk Hukum</span>
            </a>
            <div id="collapseProdukHukum" class="collapse @if($conName[2] == 'tipe-dokumen' || $conName[2] == 'jenis-peraturan' || $conName[2] == 'list-data' || $conName[2] == 'urusan-pemerintahan' || $conName[2] == 'bidang-hukum') show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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

                    @php if( in_array('Daftar Produk Hukum', $arr_one) || session('role_id')==1 ): @endphp
                        <a class="collapse-item @if($conName[2] == 'list-data') active @endif" href="{{ route('admin.produk_hukum.listdata.index') }}">Daftar Produk</a>
                    @endif

                </div>
            </div>
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
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="btn btn-info btn-sm mt-3" href="{{ url('/') }}" target="_blank">
                            Lihat Website JDIH
                        </a>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
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