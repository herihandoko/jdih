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
        <div class="slider-item" style="background-image:url({{ asset('storage/places/'.$row->slider_photo) }});">
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

<section style="background-color: #333 !important; padding-top: 3.13rem !important; padding-bottom: 3.13rem !important;">
    <form action="{{ url('/produkshukum/search-peraturan') }}" method="post">
        @csrf
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12" style="padding-bottom: 20px;">
                    <input type="text" name="keyword" class="form-control" placeholder="Masukkan Kata Kunci" style="color: black;">
                    <input name="slug" value="home" type="hidden">
                </div>
                
                <br>
                
                <div class="col-xl-3">
                    <div class="mb-1 mb-lg-3 mb-xl-0">
                        <h1 class="text-white text-uppercase mb-0" style="font-size: 18px;">
                            Silakan
                        </h1>
                        
                        <h2 class="text-white text-uppercase font-weight-bold mb-0" style="font-size: 22px;">
                            Cari <span class="text-primary" style="color: #F96B06 !important;">Peraturan</span>
                        </h2>
                    </div>
                </div>
                
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                
                                <div class="col-xl-3">
                                    <div class="select">
                                        <div class="form-group mb-lg-0">
                                            <div class="select-default select-search-box">
                                                <select class="form-control my-0 py-1 red-border selectpicker" data-live-search="true" id="dropdownjenis" name="bentuk">
                                                    <option value="" selected disabled>Jenis</option>
                                                    @foreach($produkHukumType as $val)
                                                        <option value="{{ $val->id }}">{{ $val->type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-3">
                                    <div class="select">
                                        <div class="form-group mb-lg-0">
                                            <div class="select-default select-search-box">
                                                <input name="nomor" id="nomor" class="form-control my-0 py-1 red-border" type="text" placeholder="Nomor" style="height: 2.9rem;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-2">
                                    <div class="select">
                                        <div class="form-group mb-lg-0">
                                            <div class="select-default select-search-box">
                                                <input name="tahun" id="tahun" class="form-control my-0 py-1 red-border" type="text" placeholder="Tahun" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" style="height: 2.9rem;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-2">
                                    <div class="select">
                                        <div class="form-group mb-lg-0">
                                            <div class="select-default select-search-box">
                                                <select class="form-control my-0 py-1 red-border selectpicker" data-live-search="true" name="status" id="dropdownstatus">
                                                    <option value="" selected disabled>Status</option>
                                                    @foreach ($produkHukumKategoriStatus as $id => $name)
                                                        <option>{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-2">
                                    <div class="select">
                                        <div class="form-group mb-lg-0">
                                            <div class="select-default select-search-box">
                                                <button id="btnSearch" class="btn btn-primary text-uppercase my-1" type="submit" style="background-color: #F96B06 !important; border-color: #F96B06 !important; font-size: 14px !important; font-weight: 700 !important;">
                                                    <i class="fa fa-search"></i>&nbsp;Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
</section>

@if($page_home->peraturan_status == 'Show')
<div class="blog-area">
    <div class="container wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>{{ $page_home->peraturan_title }}</h2>
                    <h3>{{ $page_home->peraturan_subtitle }}</h3>
                    <hr>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 sm-12 wow fadeInUp">
            <ul class="nav nav-tabs" role="tablist" style="padding-left: 0px;">
                <li class="nav-item" style="float: left;">
                    <a class="nav-link active" href="#one" role="tab" data-toggle="tab">
                        <strong>Peraturan Terbaru</strong>
                    </a>
                </li>
                <li class="nav-item ml-auto" style="border-bottom: 1px solid #ddd">
                  <a class="nav-link" href="#two" role="tab" data-toggle="tab">
                      <strong>Peraturan Terpopuler</strong>
                  </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="one">
                    @foreach ($peraturanTerbaru as $row)
                        <div class="mb-3">
                            <div class="card-header text-white" style="background-color: {{ '#'.$g_setting->theme_color }};">
                                <span>
                                    <small style="color:#e6bc67; font-weight: 600;">
                                        <i class="fa fa-calendar-alt"></i>&nbsp;{{ $row->updated_at->isoFormat('D MMMM Y') }} {{ $row->updated_at->format('H:i:s') }}
                                    </small>
                                </span>
                            </div>
                            <div class="feature-mono">
                                <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    <a href="{{ url('produkhukum/'.$row->menuSlug.'/'.$row->slug) }}">
                                        {{ $row->judul_peraturan }}
                                    </a>
                                </h4>
                                <p>{{ $row->produk_hukum_types->type_name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div role="tabpanel" class="tab-pane fade" id="two">
                    @foreach ($peraturanTerpopuler as $row)
                        <div class="mb-3">
                            <div class="card-header text-white" style="background-color: {{ '#'.$g_setting->theme_color }};">
                                <span>
                                    <small style="color:#e6bc67; font-weight: 600;">
                                        <i class="fa fa-eye"></i>&nbsp;dilihat {{ $row->view }} kali
                                    </small>
                                </span>
                            </div>
                            <div class="feature-mono">
                                <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    <a href="{{ url('produkhukum/'.$row->menuSlug.'/'.$row->slug) }}">
                                        {{ $row->judul_peraturan }}
                                    </a>
                                </h4>
                                <p>{{ $row->produk_hukum_types->type_name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endif

@if($page_home->artikel_status == 'Show')
<div class="blog-area bg-lightblue" style="background-image: url({{ asset('storage/places/'.$page_home->artikel_bg) }});">
    <div class="container wow fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="heading wow fadeInUp">
                    <h2>{{ $page_home->artikel_title }}</h2>
                    <h3>{{ $page_home->artikel_subtitle }}</h3>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="berita-carousel owl-carousel owl-theme owl-loaded owl-drag">

                    @foreach($berita as $row)
                    <div class="blog-item wow fadeInUp">
                        <a href="{{ url('berita/'.$row->slug) }}">
                            <div class="blog-image">
                                @if($row->photo_berita)
                                    <img src="{{ url('storage/places/berita/'.$row->photo_berita) }}" alt="Foto Berita">
                                @else
                                    <img src="{{ url('storage/places/berita/logo-berita.png') }}" alt="Foto Berita">
                                @endif
                                <div class="date">
                                    <h3>{{ \Carbon\Carbon::parse($row->created_at)->format('d') }}</h3>
                                    <h4>{{ \Carbon\Carbon::parse($row->created_at)->format('M') }}</h4>
                                    <h4>{{ \Carbon\Carbon::parse($row->created_at)->format('Y') }}</h4>
                                </div>
                            </div>
                        </a>
                        <div class="blog-text rounded card-hoverable rounded-top d-flex flex-column" style="background: #e9ecef;">
                            <div>
                                <h3>
                                    <a href="{{ url('berita/'.$row->slug) }}">{{ $row->judul_berita }}</a>
                                </h3>
                            </div>

                            <div class="bottom-content">
                                <p>
                                    {!! \Illuminate\Support\Str::limit(strip_tags($row->content_berita), 160, $end="...") !!}
                                </p>
                            </div>
                            
                            <div class="read-more" id="fixed-button">
                                <a style="background-color: #F96B06 !important; border-radius: 5px !important; font-size: 14px !important; font-weight: 700 !important;" href="{{ url('berita/'.$row->slug) }}">
                                    Selengkapnya
                                </a>
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

@if($page_home->majalah_status == 'Show')
<div class="team">
    <div class="container wow fadeIn">

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

<script type="text/javascript">
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            nav: true,
            margin: 25,
            items: 4,
            autoplay: true,
            lazyLoad:true,
            loop:false,
            dots: false,
            navText : [
                '<i class="fas fa-chevron-circle-left fa-2x" style="color:#0C9265;" aria-hidden="true"></i>',
                '<i class="fas fa-chevron-circle-right fa-2x" style="color:#0C9265;" aria-hidden="true"></i>'
            ]
        });
    });
</script>

@endsection