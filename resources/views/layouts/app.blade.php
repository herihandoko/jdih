@php
    use Carbon\Carbon;
    use App\Models\Tracker;
    
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
    
    $totVisit = DB::table('stat_visits')->count();
    
    $onlineUsers = Tracker::getOnlineUsers();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="JDIH Pemerintah Provinsi Banten">
    <meta name="keywords" content="jdih, jdih banten, jdih provinsi banten, jdih pemerintah provinsi banten, jdih biro hukum banten, jdih birhuk banten">
    <meta name="author" content="Khrisna Wardhana Monoyasa/TA Diskominfo Pemprov Banten">
    <meta name="robots" content="index, follow">

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
        <title>{{ translateText($item_row->seo_title) }}</title>
    @endif

    @if($conName[0] == 'visi-misi')
        @php
            $item_row = DB::table('page_visi_misi_items')->where('id', 1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ translateText($item_row->seo_title) }}</title>
    @endif
    
    @if($conName[0] == 'dasar-hukum')
        <title>{{ translateText('Dasar Hukum') }}</title>
    @endif

    @if($conName[0] == 'struktur-organisasi')
        @php
            $item_row = DB::table('page_struktur_organisasi_items')->where('id', 1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ translateText($item_row->seo_title) }}</title>
    @endif

    @if($conName[0] == 'tupoksi')
        @php
            $item_row = DB::table('page_tupoksi_items')->where('id', 1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ translateText($item_row->seo_title) }}</title>
    @endif
    
    @if($conName[0] == 'anggota-jdih')
        <title>{{ translateText('Anggota JDIH Provinsi Banten') }}</title>
    @endif
    
    @if($conName[0] == 'sop')
        <title>{{ translateText('SOP') }}</title>
    @endif

    @if($conName[0] == 'about')
        @php
            $item_row = DB::table('page_about_items')->where('id',1)->first();
        @endphp
        <meta name="description" content="{{ $item_row->seo_meta_description }}">
        <title>{{ $item_row->seo_title }}</title>
    @endif

    @if($conName[0] == 'skmikm')
        <title>{{ translateText('Survey Kepuasan Masyarakat') }}</title>
    @endif
    
    @if($conName[1] == 'search')
        <title>{{ translateText('Pencarian') }}</title>
    @endif
    
    @if($conName[0] == 'frontpage' || $conName[0] == 'produkhukum')
        @php
            $item_row = DB::table('menus')->where('slug', $conName[1])->first();
        @endphp
        
        @if($item_row)
            <title>{{ translateText($item_row->menu_name) }}</title>
        @else
            @php
                $item_row_second = DB::table('menus')->where('slug', $conName[2])->first();
            @endphp
            <title>{{ translateText($item_row_second->menu_name) }}</title>
        @endif
    @endif
    
    @if($conName[0] == 'berita')
        <title>{{ translateText('Berita') }}</title>
    @endif

    @if($conName[0] == 'privacy-policy')
        <title>{{ 'Privacy Policy' }}</title>
    @endif

    @include('layouts.styles')

    <!-- Favicon -->
    <link href="{{ asset('storage/places/'.$g_setting->favicon) }}" rel="shortcut icon" type="image/png">

    @include('layouts.scripts')
</head>
<body>

@if($g_setting->preloader_status == 'Show')
<div id="preloader">
    <div id="status" style="background-image: url({{ asset('storage/places/'.$g_setting->preloader_photo) }})"></div>
</div>
@endif

<div class="top">
    <div class="container-xl">
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
            
            <div class="col-md-3">
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
            
            <div class="col-md-3">
                <select class="form-control form-control-sm changeLanguage">
                    <option value="id" {{ session()->get('locale') == 'id' ? 'selected' : '' }}>Indonesian</option>
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                    <option value="zh" {{ session()->get('locale') == 'zh' ? 'selected' : '' }}>Chinese</option>
                    <option value="ja" {{ session()->get('locale') == 'ja' ? 'selected' : '' }}>Japanese</option>
                    <option value="ko" {{ session()->get('locale') == 'ko' ? 'selected' : '' }}>Korean</option>
                </select>
            </div>
        </div>
    </div>
</div>


@include('layouts.nav')

@yield('content')
<span id="loadmodaldisabilitas"></span>

<div class="footer-area">
    <div style="padding-left: 50px; padding-right: 50px; background-image: url('{{ asset('storage/places/indonesia-map.png')}}'); background-repeat: no-repeat; background-position: center;">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-service" style="text-align: justify; text-justify: inter-word;">
                    <img src="{{ asset('storage/places/logo.png') }}" class="img-responsive img-thumbnail" style="background-color: transparent; border: none;">
                    <font>
                        {{ translateText('JDIH Provinsi Banten adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan, serta merupakan sarana pemberian pelayanan informasi hukum secara lengkap, akurat, mudah dan cepat. Keberadaan sebuah wadah yang dapat menyajikan informasi hukum dan data produk hukum yang berlaku yang selalu diperbarui menjadi sesuatu yang sangat dibutuhkan.') }}
                    </font>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-service">
                    <h2>{{ translateText($g_setting->footer_column2_heading) }}</h2>
                    <ul class="fmain">
                        @foreach($footer_col_2 as $row)
                        <li>
                            <a href="{{ $row->column_item_url }}" target="_blank">
                                {{ $row->column_item_text }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-contact">
                    <h2>{{ translateText($g_setting->footer_column3_heading) }}</h2>
                    <ul>
                        @if($g_setting->footer_address)
                            <li>
                                {{ $g_setting->footer_address }}
                            </li>
                        @endif
                        
                        @if($g_setting->footer_email)
                            <li>
                                {{ $g_setting->footer_email }}
                            </li>
                        @endif
                        
                        @if($g_setting->footer_phone)
                            <li>
                                {{ $g_setting->footer_phone }}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="footer-item footer-statistik">
                    <h2>{{ translateText('Statistik Pengunjung') }}</h2>
                    <ul class="stats-list">
                        <li>
                            {{ translateText('Online') }}
                            <label class="badge badge-success badge-pill float-right">{{ number_format($onlineUsers) }}</label>
                        </li>
                        <li>
                            {{ translateText('Hari ini') }}
                            <label class="badge badge-light badge-pill float-right">{{ number_format($countToday) }}</label>
                        </li>
                        <li>
                            {{ translateText('Minggu lalu') }}
                            <label class="badge badge-light badge-pill float-right">{{ number_format($countLastWeek) }}</label>
                        </li>
                        <li>
                            {{ translateText('Bulan lalu') }}
                            <label class="badge badge-light badge-pill float-right">{{ number_format($countLastMonth) }}</label>
                        </li>
                        <li>
                            {{ translateText('Total s/d bulan ini') }}
                            <label class="badge badge-light badge-pill float-right">{{ number_format($totCount) }}</label>
                        </li>
                        <li>
                            {{ translateText('Total Pengunjung') }}
                            <label class="badge badge-light badge-pill float-right">{{ number_format($totVisit) }}</label>
                        </li>
                        <!-- <li>
                            Online
                            <label class="badge badge-light badge-pill float-right">ww</label>
                        </li> -->
                    </ul>
                </div>
                <div class="footer-item footer-statistik">
                    <div id="calendar" style="max-width: 800px; margin: 50px auto;"></div>
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
            <div class="col-md-6">
                <div class="footer-pages">
                    <ul>
<!--                        <li><a href="{{ route('front.term') }}">Terms and Conditions</a></li>-->
                        <li><a href="{{ route('front.privacy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>

<a href="https://api.whatsapp.com/send?phone=6282298899098" target="_blank">
    <div class="scroll-wa">
        <i class="fab fa-whatsapp text-white"></i>
    </div>
</a>

@include('layouts.scripts_footer')

</body>
</html>
