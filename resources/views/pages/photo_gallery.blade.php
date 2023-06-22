@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Galeri Foto</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $contentCount }} Foto
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content mt_30">
        <div class="container">
            <div class="row">
                @if( $contentList->count() > 0 )

                    @foreach ($contentList as $row)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="gallery-photo">
                            <div class="gallery-photo-bg"></div>
                            <a href="{{ url('storage/places/galeri_foto/'.$row->photo_name) }}" class="magnific" title="{{ url('storage/places/galeri_foto/'.$row->photo_caption) }}">
                                <img src="{{ url('storage/places/galeri_foto/'.$row->photo_name) }}">
                                <div class="plus-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="shadowbox text-danger">
                        Tidak terdapat foto.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
