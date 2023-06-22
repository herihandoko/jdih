@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Majalah</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $majalahHukumItems->count() }} Majalah Hukum
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if( $majalahHukumItems->count() > 0 )
                        
                        @php
                            $i = 0;
                        @endphp
                        
                        @foreach ($majalahHukumItems as $row)
                            <div class="mb-3">
                                <div class="card-header text-white" style="background-color: #11D694;">
                                    <font style="font-size: 15px; font-weight: 700;">Majalah Hukum | Volume {{ $row->edisi_majalah}} | Tahun {{ $row->tahun_majalah }}</font>
                                </div>
                                <div class="feature-mono">
                                    <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                        <a href="{{ url('majalah-hukum/'.$row->slug) }}">{{ Str::of($row->judul_majalah)->upper() }}</a>
                                    </h4>
                                    <p>Penerbit: {{ $row->penerbit_majalah }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        Tidak terdapat data.
                    @endif
                    <div class="blog-item mb-3">
                        <div>
                            {{ $majalahHukumItems->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                   @include('layouts.sidebar_majalah')
                </div>
            </div>
        </div>
    </div>
@endsection