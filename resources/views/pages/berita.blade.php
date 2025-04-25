@extends('layouts.app')

@section('content')
<style type="text/css">
    .berita-text {
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  
    .border-bottom {
      border-bottom: 1px solid #dee2e6 !important;
    }
  
    .card-transparent {
      background-color: transparent !important;
    }
    
    .card-transparent .card-footer {
        padding: 0 !important;
        background-color: transparent !important;
    }
    
    .card-footer {
        padding: 0.75rem 1.5rem;
        background-color: rgba(0, 0, 0, 0.06);
        border-top: 0 solid transparent;
      }

    .card-footer:last-child {
      border-radius: 0 0 0.25rem 0.25rem;
    }

    .btn-sm, .btn-group-sm > .btn {
      padding: 0.4rem 1.45rem;
      font-size: 0.875rem;
      line-height: 1.5rem;
      border-radius: 0.25rem;
    }

    .btn-hover.btn-outline-secondary,
    .btn-xs.btn-outline-secondary,
    .btn-sm.btn-outline-secondary,
    .btn-group-sm > .btn-outline-secondary.btn {
      border-color: #f89c0d;
      color: #f89c0d;
    }

    .btn-hover.btn-outline-secondary:hover,
    .btn-xs.btn-outline-secondary:hover,
    .btn-sm.btn-outline-secondary:hover,
    .btn-group-sm > .btn-outline-secondary.btn:hover {
      border-color: #ff891e;
      background-color: #ff891e;
      color: #fff;
    }

    .card {
      transition: all .3s !important;
    }

    .card img {
      transition: all .3s !important;
      box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.3);
    }

    .card:hover img {
      transform: scale(1.05);
    }

    h3, .h3 {
      font-size: 1.25125rem !important;
      transition: color .3s;
    }

    h3 a, .h3 a {
      color: #222;
      transition: color .3s;
    }

    h3 a:hover, .h3 a:hover {
      color: #ff891e;
    }

    h2, h3, h4, h5, h6,
    .h2, .h3, .h4, .h5, .h6 {
      margin-bottom: 0.5rem !important;
      font-weight: 400 !important;
      line-height: 1.2 !important;
    }

    .text-dark {
      color: #222 !important;
    }
    
    .text-gray-color {
        color: #969696 !important;
    }

    .mb-0,
    .my-0 {
      margin-bottom: 0 !important;
    }

    .berita-content {
      font-size: 0.875rem !important;
      color: #969696 !important;
      font-family: "Montserrat", sans-serif !important;
      line-height: 21px !important;
      font-weight: 400 !important;
    }

    .pb-7,
    .py-7 {
      padding-bottom: 3.13rem !important;
    }

    .mb-7,
    .my-7 {
      margin-bottom: 3.13rem !important;
    }
    
    .mb-4,
    .my-4 {
      margin-bottom: 1.25rem !important;
    }
    
    .meta-post-sm .meta-tag {
        font-size: 12px;
    }

    .ml-1,
    .mx-1 {
      margin-left: 0.31rem !important;
    }
    
    .page-content ul li {
	background-image: url(../images/tick.png);
	padding-left: 0px !important;
	margin-bottom: 10px;
    }

    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid transparent;
      border-radius: 0.25rem;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: fill;
        object-position: center;
    }
</style>

<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Berita') }}</h1>
        <p class="subtitle">{{ translateText('Ditemukan') }} {{ $contentList->total() }} {{ translateText('Berita') }}</p>
    </div>
</div>

<div class="page-content">
    <div class="container-jdihcontent">
        <div class="row">
            <div class="col-md-12 order-1 order-lg-0">
                @if( $contentList->count() > 0 )

                    @php
                        $i = 0;
                    @endphp

                    @foreach ($contentList as $row)
                        <div class="card rounded-0 card-transparent border-bottom mb-7 pb-7">
                            <div class="row align-items-xl-center">
                                <div class="col-md-5">
                                    <a href="{{ url('berita/'.$row->slug) }}" style="position: relative !important;">
                                        @if($row->photo_berita)
                                            <img class="card-img-top mx-auto d-block rounded" style="height: 320px;" src="{{ url('storage/places/berita/'.$row->photo_berita) }}" alt="Foto Berita">
                                        @else
                                            <img class="card-img-top mx-auto d-block rounded" style="height: 320px;" src="{{ url('storage/places/berita/logo-berita.png') }}" alt="Foto Berita">
                                        @endif

                                        <div class="card-img-overlay card-hover-overlay rounded"></div>
                                    </a>

                                </div>

                                <div class="col-md-7">
                                    <div class="card-body px-md-0 py-6 pt-md-0">
                                        <h3 class="mb-4">
                                            <a class="text-capitalize hover-text-primary" href="{{ url('berita/'.$row->slug) }}">
                                                {{ translateText($row->judul_berita) }}
                                            </a>
                                        </h3>

                                        <div class="meta-post-sm mb-4">
                                            <ul class="list-unstyled d-flex flex-wrap mb-0">
                                                <li class="meta-tag mr-4 mb-1">
                                                    <i class="fa fa-user text-gray-color"></i>
                                                    <span class="ml-1 text-capitalize text-gray-color">{{ $row->name }}</span>
                                                </li>

                                                <li class="meta-tag text-gray-color mr-4 mb-1">
                                                    <i class="fa fa-calendar"></i>
                                                    <span class="ml-1 text-capitalize">
                                                        {{ Carbon\Carbon::parse($row->publish_at)->isoFormat('DD MMMM Y HH:m:s') }}
                                                        <!--{!! date('d-m-Y H:i:s', strtotime($row->publish_at)) !!}-->
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="berita-text">
                                            <span class="mb-0 berita-content">
                                                {!! html_entity_decode(\Illuminate\Support\Str::limit(strip_tags(translateText($row->content_berita)), 350, $end="...")) !!}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="card-footer px-5 px-lg-0">
                                        <a class="btn btn-sm btn-outline-secondary text-uppercase float-right" href="{{ url('berita/'.$row->slug) }}">
                                            {{ translateText('Selengkapnya') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="shadowbox text-danger">
                        {{ translateText('Tidak terdapat berita.') }}
                    </div>
                @endif
                <div class="blog-item mb-3">
                    <div>
                        {{ $contentList->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection