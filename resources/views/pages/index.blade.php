@extends('layouts.app')

@section('content')

@php
    $g_setting = DB::table('general_settings')->where('id', 1)->first();
@endphp
<style>
    #fixed-button {
        position: fixed;
        bottom: 0px;
        left: 0px;
        padding: 20px;
    }
</style>

<div class="slider">
    <div class="slide-carousel owl-carousel">

        @foreach($sliders as $row)
        <div class="slider-item" style="background-image:url({{ asset('storage/places/'.$row->slider_photo) }}); height: 100%;">
            <div class="slider-bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <div class="slider-table">
                            <div class="slider-text">
                                <div class="text-animated">
                                    <h1>{{ $row->slider_heading }}</h1>
                                </div>
                                <div class="text-animated">
                                    <p>
                                        {!! nl2br(e($row->slider_text)) !!}
                                    </p>
                                </div>
                                <div class="text-animated">
                                    <ul>
                                        <li><a href="{{ $row->slider_button_url }}">{{ $row->slider_button_text }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<section style="background-color: #333 !important; padding-top: 2rem !important; padding-bottom: 2rem !important;">
    <form action="{{ route('front.search') }}" method="post">
        @csrf
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-3">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="{{ translateText('Masukkan Judul') }}" style="color: black; padding-left: 5px;">
                </div>
                
                <div class="col-12">
                    <div class="form-row align-items-center">
                        <div class="col-12 col-md-2 mb-3">
                            <h1 class="text-white text-uppercase mb-1" style="font-size: 14px;">
                                {{ translateText('Silakan') }}
                            </h1>
                            <h2 class="text-white text-uppercase font-weight-bold mb-1" style="font-size: 18px;">
                                {{ translateText('Cari') }}
                                <span class="text-primary" style="color: #F96B06 !important;">
                                    {{ translateText('Peraturan') }}
                                </span>
                            </h2>
                        </div>

                        <div class="col-12 col-md-2 mb-3">
                            <select class="form-control form-control-sm selectpicker" data-live-search="true" id="dropdownkategori" name="kategori">
                                <option value="" selected disabled>{{ translateText('Tipe Dokumen') }}</option>
                                @foreach($produkHukumKategori as $val)
                                    <option value="{{ $val->id }}">{{ translateText($val->category_name) }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="hiddenKategori" name="kategori" value="">
                        </div>

                        <div class="col-12 col-md-2 mb-3">
                            <select class="form-control form-control-sm selectpicker" data-live-search="true" id="dropdownjenis" name="bentuk" disabled data-toggle="tooltip" data-placement="top" title="Pilih kategori terlebih dahulu">
                                <option value="" selected disabled>{{ translateText('Jenis') }}</option>
                            </select>
                        </div>
                        
                        <div class="col-12 col-md-2 mb-3">
                            <select class="form-control form-control-sm selectpicker" data-live-search="true" id="dropdowninstansi" name="instansi">
                                <option value="" selected disabled>{{ translateText('Instansi') }}</option>
                                <option value="100">{{ 'Pemerintah Provinsi Banten' }}</option>
                                @foreach($instansi as $val)
                                    <option value="{{ $val->id }}">{{ $val->api_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-1 mb-3">
                            <input name="nomor" id="nomor" class="form-control form-control-sm" type="text" placeholder="{{ translateText('Nomor') }}">
                        </div>

                        <div class="col-12 col-md-1 mb-3">
                            <input name="tahun" id="tahun" class="form-control form-control-sm" type="text" placeholder="{{ translateText('Thn Pengundangan') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4">
                        </div>

                        <div class="col-12 col-md-1 mb-3">
                            <select class="form-control form-control-sm selectpicker" data-live-search="true" name="status" id="dropdownstatus">
                                <option value="" selected disabled>{{ translateText('Status') }}</option>
                                @foreach ($produkHukumKategoriStatus as $id => $name)
                                    <option>{{ translateText($name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-1 mb-3">
                            <button id="btnSearch" class="btn btn-sm btn-searchs text-uppercase w-100" type="submit">
                                <i class="fa fa-search"></i>&nbsp;{{ translateText('Cari') }}
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
</section>

@if($page_home->video_status == 'Show')
<div class="blog-area bg-lightblue" style="background-image: url({{ asset('storage/places/'.$page_home->video_bg) }}); background-size: cover; background-position: center;">
    <div class="container-fluid wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>
                        {{ translateText($page_home->video_title) }}
                    </h2>
                    <h3>{{ translateText($page_home->video_subtitle) }}</h3>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel owl-theme owl-loaded owl-drag">

                    @foreach($video as $row)
                    <div class="wow fadeInUp">
                        <div>
                            <img class="img-yt" id="{{ $row->video_youtube }}" src="https://img.youtube.com/vi/{{ $row->video_youtube }}/hqdefault.jpg" width="100%" height="450px" alt="youtube" data-toggle="modal" data-target="#modalYt" data-backdrop="static" data-keyboard="false"/>
                            <!--<iframe style="width: 100%; height: 400px;" class="embed-responsive-item" src="https://img.youtube.com/vi/{{ $row->video_youtube }}/mqdefault.jpg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        </div>
                        <div class="caption-yt">
                            <h4>{{ translateText($row->video_caption) }}</h4>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        
    </div>
</div>
@endif

<div class="modal fade" id="modalYt" tabindex="-1" role="dialog" aria-labelledby="ytModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0); border: none;">
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" class="close" style="padding: 0rem 1rem; outline: none;" data-dismiss="modal" title="Tutup">
                    <span aria-hidden="true" style="color: #F96B06;">×</span>
                </button>
            </div>
            
            <iframe id="video-yt" style="width: 100%; height: 450px;" class="embed-responsive-item" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
</div>

@if($page_home->artikel_status == 'Show')
<div class="blog-area" style="background-image: url({{ asset('storage/places/'.$page_home->artikel_bg) }});">
    <div class="container-fluid wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>{{ translateText($page_home->artikel_title) }}</h2>
                    <h3>{{ translateText($page_home->artikel_subtitle) }}</h3>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel owl-theme owl-loaded">

                    @foreach($berita as $row)
                        <div class="post-slide">
                            <div class="post-img">
                                @if($row->photo_berita)
                                    <img src="{{ asset('storage/places/berita/'.$row->photo_berita) }}" alt="">
                                    <a href="{{ url('berita/'.$row->slug) }}" class="over-layer">
                                        <i class="fa fa-link"></i>
                                @else
                                    <img src="{{ asset('storage/places/berita/logo-berita.png') }}" alt="">
                                    <a href="{{ url('berita/'.$row->slug) }}" class="over-layer">
                                        <i class="fa fa-link"></i>
                                @endif
                                <div class="meta-date text-center p-2">
                                    <span class="day">{{ \Carbon\Carbon::parse($row->created_at)->format('d') }}</span>
                                    <span class="mos">{{ \Carbon\Carbon::parse($row->created_at)->format('M') }}</span>
                                    <span class="yr">{{ \Carbon\Carbon::parse($row->created_at)->format('Y') }}</span>
                                </div>
                                </a>
                            </div>
                            <div class="post-content">
                                <p class="post-description">
                                    <a href="{{ url('berita/'.$row->slug) }}">
                                        {{ translateText($row->judul_berita) }}
                                    </a>
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="post-date">
                                            <i class="fa fa-user"></i>{{ $row->name }}<br>
                                            <i class="fa fa-clock"></i>{!! date('H:i:s', strtotime($row->created_at)) !!}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ url('berita/'.$row->slug) }}" class="read-more">
                                            {{ translateText('Selengkapnya') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($page_home->grafis_status == 'Show')
<div class="blog-area bg-lightblue" style="background-image: url({{ asset('storage/places/'.$page_home->grafis_bg) }});">
    <div class="container-fluid wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>{{ translateText($page_home->grafis_title) }} {{ translateText('Tahun') }} {{ now()->year }}</h2>
                    <h3>{{ translateText($page_home->grafis_subtitle) }}</h3>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div style="height: 450%" id="bar_basic"></div>
            </div>
        </div>
    </div>
</div>
@endif

@if($page_home->peraturan_status == 'Show')
<div class="blog-area" style="background-image: url({{ asset('storage/places/'.$page_home->peraturan_bg) }});">
    <div class="container-fluid wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>{{ translateText($page_home->peraturan_title) }}</h2>
                    <h3>{{ translateText($page_home->peraturan_subtitle) }}</h3>
                    <hr>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 sm-12 wow fadeInUp">
            <ul class="nav nav-tabs" role="tablist" style="padding-left: 0px;">
                <li class="nav-item" style="float: left;">
                    <a class="nav-link active" href="#one" role="tab" data-toggle="tab">
                        <strong>
                            {{ translateText('Peraturan Terbaru') }}
                        </strong>
                    </a>
                </li>
                <li class="nav-item ml-auto" style="border-bottom: 1px solid #ddd">
                  <a class="nav-link" href="#two" role="tab" data-toggle="tab">
                      <strong>
                          {{ translateText('Peraturan Terpopuler') }}
                      </strong>
                  </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="shadow tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="one">
                    @foreach ($peraturanTerbaru as $row)
                        <div class="shadow mb-3">
                            <div class="card-header text-white" style="background-color: {{ '#'.$g_setting->theme_color }};">
                                <span>
                                    <small style="color:#e6bc67; font-weight: 400;">
                                        <!--<i class="fa fa-calendar-alt"></i>&nbsp;{{ $row->updated_at->isoFormat('D MMMM Y') }} {{ $row->updated_at->format('H:i:s') }}-->
                                        <i class="fa fa-calendar-alt"></i>&nbsp;{{ translateText('Tgl Pengundangan:') }} {{ Carbon\Carbon::parse($row->tgl_pengundangan)->isoFormat('DD MMMM Y') }}
                                    </small>
                                </span>
                            </div>
                            <div class="feature-mono">
                                <p style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    @php
                                        $encryptedId = encrypt($row->id);
                                        $encryptedKeyword = encrypt(request('keyword', ''));
                                        $encryptedNomor = encrypt(request('nomor', ''));
                                        $encryptedTahun = encrypt(request('tahun', 0));
                                        $encryptedPage = encrypt(request('page', 1));
                                        $encryptedRoutes = encrypt('front.detail.peraturanhukum');
                                    @endphp
                                    <form id="detailForm" action="{{ route('front.detail.peraturanhukum', ['menuslug' => $row->menuSlug, 'slug' => $row->slug]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input style="display: none;" name="menuslug" value="{{ $row->menuSlug }}">
                                        <input style="display: none;" name="slug" value="{{ $row->slug }}">
                                        <input style="display: none;" name="id" value="{{ $encryptedId }}">
                                        <input style="display: none;" name="keyword" value="{{ $encryptedKeyword }}">
                                        <input style="display: none;" name="nomor" value="{{ $encryptedNomor }}">
                                        <input style="display: none;" name="tahun" value="{{ $encryptedTahun }}">
                                        <input style="display: none;" name="page" value="{{ $encryptedPage }}">
                                        <input style="display: none;" name="pagefrom" value="{{ 'home' }}">
                                        <input style="display: none;" name="routes" value="{{ $encryptedRoutes }}">

                                        <button type="submit" class="btn btn-sm btn-links p-0 m-0 align-baseline" style="font-size: medium; font-weight: 600; text-align: left;">
                                            {{ ucwords(translateText($row->judul_peraturan)) }}
                                        </button>
                                    </form>
                                </p>
                                <p>
                                    @if($row->produk_hukum_types)
                                        {{ translateText($row->produk_hukum_types->type_name) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div role="tabpanel" class="tab-pane fade" id="two">
                    @foreach ($peraturanTerpopuler as $row)
                        <div class="shadow mb-3">
                            <div class="card-header text-white" style="background-color: {{ '#'.$g_setting->theme_color }};">
                                <span>
                                    <small style="color:#e6bc67; font-weight: 400;">
                                        <i class="fa fa-eye"></i>&nbsp;{{ number_format($row->view, 0) }}
                                    </small>
                                </span>
                            </div>
                            <div class="feature-mono">
                                <p style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    @php
                                        $encryptedId = encrypt($row->id);
                                        $encryptedKeyword = encrypt(request('keyword', ''));
                                        $encryptedNomor = encrypt(request('nomor', ''));
                                        $encryptedTahun = encrypt(request('tahun', 0));
                                        $encryptedPage = encrypt(request('page', 1));
                                        $encryptedRoutes = encrypt('front.detail.peraturanhukum');
                                    @endphp
                                    <form id="detailForm" action="{{ route('front.detail.peraturanhukum', ['menuslug' => $row->menuSlug, 'slug' => $row->slug]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input style="display: none;" name="menuslug" value="{{ $row->menuSlug }}">
                                        <input style="display: none;" name="slug" value="{{ $row->slug }}">
                                        <input style="display: none;" name="id" value="{{ $encryptedId }}">
                                        <input style="display: none;" name="keyword" value="{{ $encryptedKeyword }}">
                                        <input style="display: none;" name="nomor" value="{{ $encryptedNomor }}">
                                        <input style="display: none;" name="tahun" value="{{ $encryptedTahun }}">
                                        <input style="display: none;" name="page" value="{{ $encryptedPage }}">
                                        <input style="display: none;" name="pagefrom" value="{{ 'home' }}">
                                        <input style="display: none;" name="routes" value="{{ $encryptedRoutes }}">

                                        <button type="submit" class="btn btn-sm btn-links p-0 m-0 align-baseline" style="font-size: medium; font-weight: 600; text-align: left;">
                                            {{ ucwords(translateText($row->judul_peraturan)) }}
                                        </button>
                                    </form>
                                </p>
                                <p>
                                    @if($row->produk_hukum_types)
                                        {{ translateText($row->produk_hukum_types->type_name) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endif

@if($page_home->majalah_status == 'Show')
<div class="team">
    <div class="container-fluid wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>{{ $page_home->majalah_title }}</h2>
                    <h3>{{ $page_home->majalah_subtitle }}</h3>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-sm-6 col-xs-12">
                <img src="{{ asset('storage/places/perpushukum.jpg') }}" style="margin-top:10px; height:300px;" class="img-responsive img-thumbnail">
            </div>

            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="service-carousel owl-carousel owl-theme lightcasestudies withhover owl-loaded owl-drag" style="margin-top: 15px;">

                    @foreach($majalah as $row)
                        <div class="ebook-details copybox row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="blog-item wow fadeInUp">
                                    @if($row->file_peraturan)
                                        <a href="{{ url('/frontpage/'.$majalahMenu->slug.'/'.$row->slug) }}">
                                            <img src="{{ url('storage/places/peraturan/'.$row->file_peraturan) }}" alt="cover" class="img-responsive img-thumbnail" style="height: 250px;">
                                        </a>
                                    @else
                                        <a href="{{ url('/frontpage/'.$majalahMenu->slug.'/'.$row->slug) }}">
                                            <img src="{{ url('storage/places/majalah/cover/book.png') }}" alt="cover" class="img-responsive img-thumbnail" style="height: 250px;">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($page_home->skm_popup_status == 'Show')
<div class="modal fade" tabindex="-1" role="dialog" id="firstModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Survey Kepuasan Web JDIH</h4>
                <button type="button" class="btn btn-sm btn-danger" aria-label="Close" style="border-radius: 2px; box-shadow: 0px 10px 20px -10px #dc3545; padding: 1px 5px;" id="btnClose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row align-items-center">
<!--                        <div class="pl-3">
                            <h5 class="text-primary">
                                Apakah Anda berkenan menilai kami?
                            </h5>
                            <p class="mt-3 text-secondary">
                                Silakan berikan penilaian Anda terhadap website kami
                            </p>

                            <input type="hidden" value="{{ url('/frontpage/'.$page_home->skm_popup_link) }}" id="skmLink">
                            <input type="hidden" value="{{ $page_home->skm_popup_show }}" id="skmShow">

                            <button class="btn btn-sm btn-primary" style="border-radius: 25px; box-shadow: 0px 10px 20px -10px #1376c5; padding: 7px 20px;" id="btnSkm">
                                Ya, saya akan menilai
                            </button>
                            <button class="btn btn-sm btn-danger" style="border-radius: 25px; box-shadow: 0px 10px 20px -10px #dc3545; padding: 7px 20px;" id="btnClose">
                                Tidak, terima kasih
                            </button>
                        </div>-->
                        <div class="pl-2 pr-0">
                            <input type="hidden" value="{{ url('/frontpage/'.$page_home->skm_popup_link) }}" id="skmLink">
                            <input type="hidden" value="{{ $page_home->skm_popup_show }}" id="skmShow">
                            <img style="cursor: pointer;" src="{{ url('storage/places/banner-survey.png') }}" alt="Survey Kepuasan Masyarakat" class="img-fluid" id="btnSkm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        
        // Dropdown Kategori
        $('[data-toggle="tooltip"]').tooltip();

        $('#dropdownkategori').change(function() {
            var kategoriId = $(this).val();
            if (kategoriId) {
                $('#hiddenKategori').val(kategoriId);
                $.ajax({
                    url: 'getJenisByKategori/' + kategoriId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#dropdownjenis').empty().append('<option value="" selected disabled>{{ translateText('Jenis') }}</option>');
                        $.each(data, function(key, value) {
                            $('#dropdownjenis').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('#dropdownjenis').prop('disabled', false);
                        $('#dropdownjenis').tooltip('disable');
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            } else {
                $('#dropdownjenis').empty().append('<option value="" selected disabled>{{ translateText('Jenis') }}</option>').prop('disabled', true);
                $('#dropdownjenis').tooltip('enable');
                $('.selectpicker').selectpicker('refresh');
                $('#hiddenKategori').val("");
            }
        });
        
        var skmShow = $("#skmShow").val();
        if(skmShow == 'Once') {
            var is_modal_show = sessionStorage.getItem('alreadyShow');
            if(is_modal_show != 'already shown'){
              $('#firstModal').modal({backdrop: 'static', keyboard: false});
              sessionStorage.setItem('alreadyShow','already shown');
            }
        } else {
            sessionStorage.removeItem('alreadyShow')
            $('#firstModal').modal({backdrop: 'static', keyboard: false});
        }
        
        $("#btnClose").click(function(){
            $("#firstModal").modal('toggle');
        });
        $("#btnSkm").click(function(){
            var skmLink = $("#skmLink").val();
            window.location.href = skmLink;
        });
        
        // Video Youtube
        $("img.img-yt").click(function(e) {
            e.preventDefault();
            var id_yt = $(this).attr('id');
            var src_yt = "https://www.youtube.com/embed/"+id_yt+"?autoplay=1&mute=1&controls=1";
            $("#video-yt").attr("src", src_yt);
        });
        
        $("#modalYt").on("hide.bs.modal", function(e) {
            $("#video-yt").attr("src", "");
        });
        
        // Grafik
        var dom = document.getElementById('bar_basic');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        
        var dataVal = [
                @foreach ($totalPeraturan as $row)
                    {{ $row->total }},
                @endforeach
                ];
        
        var app = {};
    
        var option;

        option = {
            tooltip: {
                trigger: 'axis'
            },
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 10
            },
            xAxis: {
                type: 'category',
                axisTick: { show: false },
                data: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                animation: true
            },
            
            yAxis: {
                 type: 'value'
            },
            
            series: [
                {
                  data: dataVal,
                  type: 'bar',
                  itemStyle: {
                      color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                      { offset: 0, color: '#83bff6' },
                      { offset: 0.5, color: '#188df0' },
                      { offset: 1, color: '#188df0' }
                    ])
                  },
                  emphasis: {
                    itemStyle: {
                      color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        { offset: 0, color: '#2378f7' },
                        { offset: 0.7, color: '#2378f7' },
                        { offset: 1, color: '#83bff6' }
                      ])
                    }
                  },
                }
            ]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }
        
        window.addEventListener('resize', myChart.resize);
    });
</script>

@endsection