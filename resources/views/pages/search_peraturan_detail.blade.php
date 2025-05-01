@extends('layouts.app')

@section('content')
<div class="page-banner">
    <div class="container">
        <p class="subtitle">{{ $api_name }}</p>
        <h2>{{ translateText($produkHukumDetail->judul_peraturan) }}</h2>
    </div>
</div>

<div class="page-content">
    <div class="container-jdihcontent">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <form id="detailForm" action="{{ route('front.search') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="keyword" value="{{ $keyword }}">
                            <input type="hidden" name="nomor" value="{{ $nomor }}">
                            <input type="hidden" name="kategori" value="{{ $kategori }}">
                            <input type="hidden" name="instansi" value="{{ $instansi }}">
                            <input type="hidden" name="bentuk" value="{{ $bentuk }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="page" value="{{ $page }}">
        
                            <button type="submit" class="btn btn-sm btn-links">
                                <i class="fa fa-chevron-circle-left"></i>&nbsp;{{ translateText('Kembali') }}
                            </button>
                        </form>
                    </div>
                    <div class="col-md-5 col-sm-5 d-flex justify-content-end align-items-center">
                        @include('partials.share')
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-8 mt-3">
                @isset($produkHukumDetail->page_view)
                    @include('layouts.' . $produkHukumDetail->page_view)
                @else
                    @include('layouts.table_content_api')
                @endisset
            </div>
            

            <div class="col-12 col-md-4 sidebar">
                <div class="theiaStickySidebar">
                    <div class="container-iframe shadow">
                        @isset($produkHukumDetail->page_view)
                            @if($produkHukumDetail->file_peraturan)
                                @php
                                    $extension = pathinfo(storage_path('/places/peraturan/' . $produkHukumDetail->file_peraturan), PATHINFO_EXTENSION);
                                @endphp
                                @if($extension == "zip")
                                    <embed src="{{ url('storage/places/peraturan/404-zip.jpg') }}#scrollbar=0" style="height: 400px; width: 100%;" class="d-none d-sm-block">
                                @else
                                    <embed type="application/pdf" src="{{ url('storage/places/peraturan/' . $produkHukumDetail->file_peraturan) }}#scrollbar=0" style="height: 400px; width: 100%;" class="d-none d-sm-block">
                                @endif
                            @else
                                <embed src="{{ url('storage/places/peraturan/404.jpg') }}#scrollbar=0" style="height: 400px; width: 100%;" class="d-none d-sm-block">
                            @endif
                        @else
                            @if($produkHukumDetail->file_download)
                                <embed type="application/pdf" src="{{ url($produkHukumDetail->url_download) }}#scrollbar=0" style="height: 400px; width: 100%;" class="d-none d-sm-block">
                            @else
                                <embed src="{{ url('storage/places/peraturan/404.jpg') }}#scrollbar=0" style="height: 400px; width: 100%;" class="d-none d-sm-block">
                            @endif
                        @endisset
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto mt-2">
                        @isset($produkHukumDetail->page_view)
                            @if($produkHukumDetail->file_peraturan)
                                <a href="{{ url('storage/places/peraturan/' . $produkHukumDetail->file_peraturan) }}" class="btn btn-sm btn-primary btn-block btn-download-doc" download>
                                    <i class="fa fa-download"></i>&nbsp;{{ translateText('Download') }}
                                </a>
                                <div class="d-grid gap-2 col-12 mx-auto mt-2 text-center">
                                    {!! QrCode::size(150)->generate(asset('storage/places/peraturan/'.$produkHukumDetail->file_peraturan)) !!}
                                </div>
                            @else
                                <button class="btn btn-sm btn-secondary btn-block" disabled style="cursor: default; font-weight: 800;">
                                    <i class="fa fa-download"></i>&nbsp;{{ translateText('Download') }}
                                </button>
                            @endif
                        @else
                            @if($produkHukumDetail->file_download)
                                <a href="{{ url($produkHukumDetail->url_download) }}" target="_blank" class="btn btn-sm btn-primary btn-block btn-download-doc" download>
                                    <i class="fa fa-download"></i>&nbsp;{{ translateText('Download') }}
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary btn-block" disabled style="cursor: default; font-weight: 800;">
                                    <i class="fa fa-download"></i>&nbsp;{{ translateText('Download') }}
                                </button>
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection