@extends('layouts.app')

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Galeri Foto') }}</h1>
        <p class="subtitle">{{ translateText('Ditemukan') }} {{ $contentList->total() }} {{ translateText('Foto') }}</p>
    </div>
</div>

<div class="page-content mt_30">
    <div class="container-jdihcontent">
        <div class="row">
            @if( $contentList->count() > 0 )

                @foreach ($contentList as $row)
                <div class="col-lg-4 col-md-6 col-sm-12 order-1 order-lg-0">
                    <div class="gallery-photo">
                        <a href="{{ url('storage/places/galeri_foto/'.$row->photo_name) }}" class="magnific" title="{{ $row->photo_caption }}">
                            <img src="{{ url('storage/places/galeri_foto/'.$row->photo_name) }}">
                            <div class="plus-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </a>
                        <p>
                            <h6 class="text-secondary mt-2 small">{{ $row->photo_caption }}</h6>
                        </p>
                    </div>
                </div>
                @endforeach
                
            @else
                <div class="shadowbox text-danger">
                    Tidak terdapat foto.
                </div>
            @endif
        </div>
        <div class="blog-item mb-3">
            <div>
                {{ $contentList->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
