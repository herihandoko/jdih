@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $catMenuPeraturan->type_name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $peraturanCount }} Peraturan
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if( $peraturanList->count() > 0 )
                        
                        @php
                            $i = 0;
                        @endphp
                        
                        @foreach ($peraturanList as $key => $row)
                            <div class="mb-3">
                                <div class="card-header text-white" style="background-color: #11D694;">
                                    <span style="display: inline-block; border-radius: 2px; border: 1px solid cadetblue; padding: 0 14px; font-size: 13px; background-color: cadetblue;">
                                        <small>
                                            <i class="fa fa-eye"></i>&nbsp;dilihat {{ $row->view }} kali
                                        </small>
                                    </span>
                                    <span style="float: right; margin-top: 2px; display: inline-block; border-radius: 2px; border: 1px solid cadetblue; padding: 0 14px; font-size: 13px; background-color: cadetblue;">
                                        <small>
                                            <i class="fa fa-calendar-alt"></i>&nbsp;{{ $row->updated_at->isoFormat('D MMMM Y') }} {{ $row->updated_at->format('H:i:s') }}
                                        </small>
                                    </span>
                                </div>
                                <div class="feature-mono">
                                    <span style="font-size: small;">No. {{ $peraturanList->firstItem() + $key }} dari {{ $peraturanCount }}</span>
                                    @if($row->status_akhir == 'Berlaku')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-success btn-sm" style="font-size: x-small;">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Diubah')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-primary btn-sm" style="font-size: x-small;">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Mengubah')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-primary btn-sm" style="font-size: x-small;">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Dicabut')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-warning btn-sm" style="font-size: x-small;">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Mencabut')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-warning btn-sm" style="font-size: x-small;">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Tidak Berlaku')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-danger btn-sm" style="font-size: x-small;">{{ 'Tidak Berlaku' }}</font>
                                        </span>
                                    @else
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-success btn-sm" style="font-size: x-small;">{{ 'Berlaku' }}</font>
                                        </span>
                                    @endif
                                    <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                        <a href="{{ url('produkhukum/'.$menu->slug.'/'.$row->slug) }}">{{ $row->judul_peraturan }}</a>
                                    </h4>
                                    <p>{{ $row->produk_hukum_types->type_name }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="shadowbox text-danger">
                            Tidak ada data yang tersedia
                        </div>
                    @endif
                    <div class="blog-item mb-3">
                        <div>
                            {!! $peraturanList->links() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('layouts.sidebar_peraturan')
                </div>
            </div>
        </div>
    </div>
@endsection