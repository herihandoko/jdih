@php
    use Carbon\Carbon;
    
    $g_setting = DB::table('general_settings')->where('id', 1)->first();
    $s_media = DB::table('social_media_items')->orderBy('social_order', 'asc')->get();
    $footer_col_1 = DB::table('footer_columns')->orderBy('column_item_order', 'asc')->where('column_name', 'Column 1')->get();
    $footer_col_2 = DB::table('footer_columns')->orderBy('column_item_order', 'asc')->where('column_name', 'Column 2')->get();

    $countToday = DB::table('stat_visits')->where('visit_date', Carbon::today())->count();

    $previous_week = strtotime("-1 week +1 day");
    $start_week = strtotime("last sunday midnight",$previous_week);
    $end_week = strtotime("next saturday",$start_week);
    $start_week = date("Y-m-d",$start_week);
    $end_week = date("Y-m-d",$end_week);
    $countLastWeek = DB::table('stat_visits')->whereBetween('visit_date', [$start_week, $end_week])->count();
    
    $countLastMonth = DB::table('stat_visits')->whereMonth('visit_date', '=', Carbon::now()->subMonth()->month)->count();

    $totCount = $countToday + $countLastWeek + $countLastMonth;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @php
    $url = Request::path();
    $conName = explode('/',$url);
    if(!isset($conName[1]))
    {
        $conName[1] = '';
    }
    if(!isset($conName[2]))
    {
        $conName[2] = '';
    }
    if(!isset($conName[3]))
    {
        $conName[3] = '';
    }
    @endphp

    @if($conName[0] == '')
        @php
            $item_row = DB::table('page_home_items')->where('id',1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ $item_row->seo_title }}</title>
    @endif

    @if($conName[0] == 'visi-misi')
        @php
            $item_row = DB::table('page_visi_misi_items')->where('id', 1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ $item_row->seo_title }}</title>
    @endif

    @if($conName[0] == 'struktur-organisasi')
        @php
            $item_row = DB::table('page_struktur_organisasi_items')->where('id', 1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ $item_row->seo_title }}</title>
    @endif

    @if($conName[0] == 'tupoksi')
        @php
            $item_row = DB::table('page_tupoksi_items')->where('id', 1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ $item_row->seo_title }}</title>
    @endif

    @if($conName[0] == 'about')
        @php
            $item_row = DB::table('page_about_items')->where('id',1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ $item_row->seo_title }}</title>
    @endif

    @if($conName[0] == 'spmipm')
        <title>Survey Kepuasan Pengunjung</title>
    @endif
    
    @if($conName[1] == 'search-peraturan')
        <title>{{ 'Pencarian' }}</title>
    @endif
    
    @if($conName[0] == 'frontpage' || $conName[0] == 'produkhukum')
        @php
            $item_row = DB::table('menus')->where('slug', $conName[1])->first();
        @endphp
        
        @if($item_row)
            <title>{{ $item_row->menu_name }}</title>
        @else
            @php
                $item_row_second = DB::table('menus')->where('slug', $conName[2])->first();
            @endphp
            <title>{{ $item_row_second->menu_name }}</title>
        @endif
    @endif
    
    @if($conName[0] == 'berita')
        <title>{{ 'Berita' }}</title>
    @endif

    @include('layouts.styles')

    <!-- Favicon -->
    <link href="{{ asset('storage/places/'.$g_setting->favicon) }}" rel="shortcut icon" type="image/png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">

    @include('layouts.scripts')

    <style>
        .top,
        .main-nav nav .navbar-nav .nav-item .dropdown-menu,
        .video-button:before,
        .video-button:after,
        .special .read-more a,
        .service .read-more a,
        .testimonial-bg,
        .project .read-more a,
        .team-text,
        .cta .overlay,
        .blog-area .blog-image .date,
        .blog-area .read-more a,
        .newsletter-area .overlay,
        .footer-social-link ul li a,
        .scroll-top,
        .single-section .read-more a,
        .sidebar .widget .search button,
        .comment button,
        .contact-item:hover .contact-icon,
        .product-item .text button,
        .btn-arf,
        .project-photo-carousel .owl-nav .owl-prev,
        .project-photo-carousel .owl-nav .owl-next,
        .faq h4.panel-title a,
        .team-social li a:hover,
        .doc_detail_social li i,
        .nav-doctor .nav-link.active,
        .product-detail button,
        .product-detail .nav-pills .nav-link.active,
        .contact-form .btn,
        .career-sidebar .widget button {
            background: {{ '#'.$g_setting->theme_color }}!important;
        }
        .main-nav nav .navbar-nav .nav-item a:hover,
        .main-nav nav .navbar-nav .nav-item:hover a,
        .service .service-item .text h3 a:hover,
        .project .project-item .text h3 a:hover,
        .blog-area .blog-item h3 a:hover,
        .footer-item ul li a:hover,
        .sidebar .widget .type-2 ul li a:hover,
        .sidebar .widget .type-1 ul li:before,
        .sidebar .widget .type-1 ul li a:hover,
        .single-section h3,
        .contact-icon,
        .product-item .text h3 a:hover,
        .career-main-item h3,
        .reg-login-form .new-user a,
        .product-detail .nav-pills .nav-link {
            color: {{ '#'.$g_setting->theme_color }}!important;
        }
        .text-animated li a:hover,
        .feature .feature-item {
            background-color: {{ '#'.$g_setting->theme_color }}!important;
        }
        .text-animated li a:hover,
        .special .read-more a,
        .footer-social-link ul li a,
        .contact-item:hover .contact-icon,
        .faq h4.panel-title,
        .team-social li a:hover,
        .contact-form .btn {
            border-color: {{ '#'.$g_setting->theme_color }}!important;
        }

        .main-nav nav .navbar-nav .nav-item .dropdown-menu li a,
        .contact-item:hover .contact-icon,
        .product-detail .nav-pills .nav-link.active {
            color: #fff!important;
        }
        .feature .feature-item:hover,
        .service .read-more a:hover,
        .project .read-more a:hover,
        .blog-area .read-more a:hover,
        .single-section .read-more a:hover,
        .comment button:hover,
        .doc_detail_social li:hover i,
        .product-detail button:hover,
        .contact-form .btn:hover {
            background: #333!important;
        }
        .footer-social-link ul li a:hover {
            background: transparent!important;
        }
        .special .read-more a:hover {
            background: transparent!important;
            border-color: #fff!important;
        }

        .container-iframe {
          position: relative;
          width: 100%;
          height: auto;
          overflow: hidden;
        }

        .responsive-iframe {
          position: absolute;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          width: 100%;
          height: 100%;
          border: none;
        }

        .feature-mono {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 0;
            padding-bottom: 5px;
            border: 1px solid #ddd;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 1px 1px 3px 4px rgba(226, 228, 229, 0.3);
            position: relative;
            margin-bottom: 10px;
        }

        .feature-mono span {
            font-size: 15px;
            font-weight: 700;
            margin: 5px 0 10px;
            padding: 0;
        }

        .feature-mono h4 a {
            font-size: 18px !important;
            font-weight: 600 !important;
            margin: 5px 0 5px !important;
            padding: 0 !important;
            color:#000 !important;
        }

        .feature-mono p {
            padding-bottom: 0;
            margin-bottom: 5px;
            font-size: 14px;
            line-height: 1.2;
        }

        .feature-seo {
            height: 225px;
            padding: 10px;
            border:1px solid #ddd;
            overflow: hidden;
            background-color: #ffffff;
            -webkit-box-shadow: 10px 5px 5px 5px rgba(226, 228, 229, 0.5);
            -moz-box-shadow: 5px 5px 5px 5px rgba(226, 228, 229, 0.5);
            box-shadow: 5px 5px 5px 5px rgba(226, 228, 229, 0.5);
            position: relative;
        }

        .feature-seo small {
            padding-bottom: 0;
            margin-bottom: 5px;
            font-size: 14px;
            line-height: 1.5;
        }

        .feature-seo h4 {
            font-weight: 600;
            margin: 5px 0 10px;
            padding: 0;
        }

        .feature-seo.footer {
            height: 40px;
            padding: 7px;
            margin-bottom: 10px;
            overflow: hidden;
            background: #e6bc67;
            /* Old browsers */
            color:#000;
            -webkit-box-shadow: 10px 10px 5px 10px rgba(226, 228, 229, 1);
            -moz-box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
            box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
            position: relative;
        }

        .ebook-details {
            padding: 10px 0 10px 0;
        }

        .ebook-details img {
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }

        .copybox img {
            -webkit-box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
            -moz-box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
            box-shadow: 10px 10px 5px 0px rgba(226, 228, 229, 1);
        }
        
        .shadowbox {
            width: 15em;
            margin: auto;
            text-align: center;
            border: 1px solid #333;
            box-shadow: 8px 8px 5px #444;
            padding: 8px 12px;
            font-size: larger;
            background-image: linear-gradient(180deg, #fff, #ddd 40%, #ccc);
          }
    </style>
</head>
<body>

@if($g_setting->preloader_status == 'Show')
<div id="preloader">
    <div id="status" style="background-image: url({{ asset('storage/places/'.$g_setting->preloader_photo) }})"></div>
</div>
@endif

<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="top-contact">
                    <ul>
                        <li>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <span>{{ $g_setting->top_bar_email }}</span>
                        </li>
                        <li>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>{{ $g_setting->top_bar_phone }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="top-right">

                    @if($g_setting->top_bar_social_status == 'Show')
                    <div class="top-social">
                        <ul>
                            @foreach($s_media as $row)
                                <li>
                                    <a href="{{ $row->social_url }}" target="_blank">
                                        <i class="{{ $row->social_icon }}" style="color: #{{ $row->social_color }}"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @php
                        $menus = DB::table('menus')->get();
                        $menu_arr = array();
                    @endphp

                    @foreach($menus as $row)
                        @php
                            $menu_arr[$row->menu_name] = $row->menu_status;
                        @endphp
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.nav')

@yield('content')

<div class="footer-area">
    <div style="padding-left: 50px; padding-right: 50px;">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-service">
                    <img src="{{ url('storage/places/logo.png') }}" class="img-responsive img-thumbnail">
                    <font>
                        JDIH Provinsi Banten adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan, serta merupakan sarana pemberian pelayanan informasi hukum secara lengkap, akurat, mudah dan cepat. Keberadaan sebuah wadah yang dapat menyajikan informasi hukum dan data produk hukum yang berlaku yang selalu diperbarui menjadi sesuatu yang sangat dibutuhkan.
                    </font>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-service">
                    <h2>{{ $g_setting->footer_column2_heading }}</h2>
                    <ul class="fmain">
                        @foreach($footer_col_2 as $row)
                        <li>
                            <a href="{{ $row->column_item_url }}">
                                {{ $row->column_item_text }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-contact">
                    <h2>{{ $g_setting->footer_column3_heading }}</h2>
                    <ul>
                        <li>{{ $g_setting->footer_address }}</li>
                        <li>{{ $g_setting->footer_email }}</li>
                        <li>{{ $g_setting->footer_phone }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="footer-item">
                    <h2>Statistik Pengunjung</h2>
                    <ul>
                        <li>
                            Hari ini
                            <label class="badge badge-light badge-pill float-right">{{ number_format($countToday) }}</label>
                        </li>
                        <li>
                            Minggu lalu
                            <label class="badge badge-light badge-pill float-right">{{ number_format($countLastWeek) }}</label>
                        </li>
                        <li>
                            Bulan lalu
                            <label class="badge badge-light badge-pill float-right">{{ number_format($countLastMonth) }}</label>
                        </li>
                        <li>
                            Total
                            <label class="badge badge-light badge-pill float-right">{{ number_format($totCount) }}</label>
                        </li>
                        <!-- <li>
                            Online
                            <label class="badge badge-light badge-pill float-right">ww</label>
                        </li> -->
                    </ul>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item footer-service">
                    <h2>{{ $g_setting->footer_column4_heading }}</h2>
                    <div class="footer-social-link">
                        <ul>
                            @foreach($s_media as $row)
                                <li><a href="{{ $row->social_url }}" target="_blank"><i class="{{ $row->social_icon }}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row footer-end">
            <div class="col-md-6">
                <div class="copyright">
                    <p>{{ $g_setting->footer_copyright }}</p>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="footer-pages">
                    <ul>
                        <li><a href="{{ route('front.term') }}">Terms and Conditions</a></li>
                        <li><a href="{{ route('front.privacy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</div>

<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>

@include('layouts.scripts_footer')

</body>
</html>
