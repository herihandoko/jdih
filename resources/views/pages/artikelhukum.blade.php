@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Artikel</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $artikelHukumList->count() }} Artikel Hukum
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if( $artikelHukumList->count() > 0 )
                        
                        @php
                            $i = 0;
                        @endphp
                        
                        @foreach ($artikelHukumList as $row)
                            <div class="mb-3">
                                <div class="card-header text-white" style="background-color: #11D694;">
                                    <font style="font-size: 15px; font-weight: 700;">Artikel Hukum | Tahun {{ $row->tahun_artikel }}</font>
                                </div>
                                <div class="feature-mono">
                                    <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                        <a href="{{ url('artikel-hukum/'.$row->slug) }}">{{ Str::of($row->judul_artikel)->upper() }}</a>
                                    </h4>
                                    <p>Penulis: {{ $row->penulis_artikel }}</p>
                                    <hr/>
                                    <p>{!! Str::limit($row->content_artikel, 150) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        Tidak terdapat data.
                    @endif
                    <div class="blog-item mb-3">
                        <div>
                            {{ $artikelHukumList->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                   @include('layouts.sidebar_artikel')
                </div>
            </div>
        </div>
    </div>
@endsection