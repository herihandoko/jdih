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
      border-color: #ddd;
      color: #969696;
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
    }

    h3, .h3 {
      font-size: 1.25125rem !important;
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

    p {
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
</style>


    <div class="page-banner" style="background-image: url({{ asset('storage/places/'.$g_setting->banner_blog_detail) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $beritaDetail->judul_berita }}</h1>
        </div>
    </div>

    <div class="page-content">
    	<div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="single-section">
                        <div class="featured-photo">
                            @if($beritaDetail->photo_berita)
                                <img class="card-img-top rounded" src="{{ url('storage/places/berita/'.$beritaDetail->photo_berita) }}" alt="Foto Berita">
                            @else
                                <img class="card-img-top rounded" src="{{ url('storage/places/berita/logo-berita.png') }}" alt="Foto Berita">
                            @endif
                        </div>
                        <div class="text">
                            <h2>{{ $beritaDetail->judul_berita }}</h2>
                            
                             <div class="meta-post-sm mb-4">
                                <ul class="list-unstyled d-flex flex-wrap mb-0">
                                    <li class="meta-tag mr-4 mb-1">
                                        <i class="fa fa-user text-gray-color"></i>
                                        <span class="ml-1 text-capitalize text-gray-color">{{ $beritaDetail->name }}</span>
                                    </li>

                                    <li class="meta-tag text-gray-color mr-4 mb-1">
                                        <i class="fa fa-calendar"></i>
                                        <span class="ml-1 text-capitalize">{!! date('d-m-Y H:i:s', strtotime($beritaDetail->publish_at)) !!}</span>
                                    </li>
                                </ul>
                            </div>
                            
                            {!!  $beritaDetail->content_berita !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 order-2">
                    @include('layouts.sidebar_berita')
                </div>
            </div>
    	</div>
    </div>

@endsection