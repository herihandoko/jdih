@extends('layouts.app')

@section('content')
<style>
    .card-header {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: start;
    }
    
    @media (min-width: 768px) {
        .card-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }
</style>

<div class="page-banner">
    <div class="container">
        <h1>
            @if($param == 'Bentuk')
                Pencarian: {{ $keywords->type_name }}
            @else
                Pencarian: {{ $param }}
            @endif
        </h1>
        <p class="subtitle">
            {{ translateText('Ditemukan') }} {{ $paginatedResults->total() }} {{ translateText('Data') }}
        </p>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if($paginatedResults->isEmpty())
                    @include('pages.no_data')
                @else
                    @foreach ($paginatedResults as $key => $row)
                        <div class="mb-3">
                            <div class="card-header text-white" style="background-color: #11D694;">
                                <p class="mt-0 mb-0" style="color: #222; font-weight: 700; text-transform: uppercase;">
                                    @if($row->api_name)
                                        {{ $row->api_name }}
                                    @else
                                        {{ 'Pemerintah Provinsi Banten' }}
                                    @endif
                                </p>
                            </div>
                            <div class="feature-mono">
                                <span style="font-size: x-small;">
                                    {{ translateText('No.') }} {{ $key + 1 }} {{ translateText('dari') }} {{ $paginatedResults->total() }}
                                </span>
                                @if($row->status_akhir == 'Berlaku' ?? $row->status == 'Berlaku')
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-success btn-sm" style="font-size: x-small;">{{ $row->status_akhir ?? $row->status }}</font>
                                    </span>
                                @elseif($row->status_akhir == 'Diubah' ?? $row->status == 'Diubah')
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-primary btn-sm" style="font-size: x-small;">{{ $row->status_akhir ?? $row->status }}</font>
                                    </span>
                                @elseif($row->status_akhir == 'Mengubah' ?? $row->status == 'Mengubah')
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-primary btn-sm" style="font-size: x-small;">{{ $row->status_akhir ?? $row->status }}</font>
                                    </span>
                                @elseif($row->status_akhir == 'Dicabut' ?? $row->status == 'Dicabut')
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-warning btn-sm" style="font-size: x-small;">{{ $row->status_akhir ?? $row->status }}</font>
                                    </span>
                                @elseif($row->status_akhir == 'Mencabut' ?? $row->status == 'Mencabut')
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-warning btn-sm" style="font-size: x-small;">{{ $row->status_akhir ?? $row->status }}</font>
                                    </span>
                                @elseif($row->status_akhir == 'Tidak Berlaku' ?? $row->status == 'Tidak Berlaku')
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-danger btn-sm" style="font-size: x-small;">{{ 'Tidak Berlaku' }}</font>
                                    </span>
                                @else
                                    <span style="float: right; margin-right: 20px;">
                                        <font class="btn-success btn-sm" style="font-size: x-small;">{{ 'Berlaku' }}</font>
                                    </span>
                                @endif
                                <p style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    @php
                                        $encryptedKeyword = encrypt(request('keyword', ''));
                                        $encryptedNomor = encrypt(request('nomor', ''));
                                        if($row->api_name) {
                                            $encryptedApiName = encrypt($row->api_name);
                                            $encryptedId = encrypt($row->idData);
                                        } else {
                                            $encryptedApiName = encrypt('Pemerintah Provinsi Banten');
                                            $encryptedId = encrypt($row->id);
                                        }
                                        $encryptedInstansi = encrypt(request('instansi', ''));
                                        $encryptedKategori = encrypt(request('kategori', ''));
                                        $encryptedBentuk = encrypt(request('bentuk', ''));
                                        $encryptedTahun = encrypt(request('tahun', 0));
                                        $encryptedPage = encrypt(request('page', 1));
                                        $encryptedRoutes = encrypt('front.detail.search');
                                    @endphp
                                    <form id="detailForm" action="{{ route('front.detail.search') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="keyword" value="{{ $encryptedKeyword }}">
                                        <input type="hidden" name="nomor" value="{{ $encryptedNomor }}">
                                        <input type="hidden" name="id" value="{{ $encryptedId }}">
                                        <input type="hidden" name="api_name" value="{{ $encryptedApiName }}">
                                        <input type="hidden" name="kategori" value="{{ $encryptedKategori }}">
                                        <input type="hidden" name="instansi" value="{{ $encryptedInstansi }}">
                                        <input type="hidden" name="bentuk" value="{{ $encryptedBentuk }}">
                                        <input type="hidden" name="tahun" value="{{ $encryptedTahun }}">
                                        <input type="hidden" name="page" value="{{ $encryptedPage }}">
                                        <input type="hidden" name="routes" value="{{ $encryptedRoutes }}">

                                        <button type="submit" class="btn btn-sm btn-links p-0 m-0 align-baseline" style="font-size: initial; font-weight: 600; text-align: left;">
                                            {{ ucwords(translateText($row->judul_peraturan ?? $row->judul)) }}
                                        </button>
                                    </form>
                                </p>
                                <p style="text-transform: uppercase;">
                                    @if($row->produk_hukum_types)
                                        {{ $row->produk_hukum_types->type_name }}
                                    @else
                                        {{ $row->jenis }}
                                    @endif
                                </p>
                                
                                @if($row->view != '')
                                <div class="mt-2 mb-md-0 view-pengundangan">
                                    <span class="mr-2">
                                        <i class="fa fa-eye"></i>&nbsp;<small>{{ number_format($row->view, 0) }}</small>
                                    </span>
                                </div>
                                @endif
                                
                                <div class="mt-2 mb-md-0 view-pengundangan">
                                    <span>
                                        @if($row->tgl_pengundangan ?? $row->tanggal_pengundangan)
                                            <small><i class="fa fa-calendar-alt"></i>&nbsp;{{ translateText('Tgl Pengundangan:') }} {{ Carbon\Carbon::parse($row->tgl_pengundangan ?? $row->tanggal_pengundangan)->isoFormat('D MMMM Y') }}</small>
                                        @elseif($row->tanggal_pengundangan == null)
                                            <small><i class="fa fa-calendar-alt"></i></small>
                                        @else
                                            <small><i class="fa fa-calendar-alt"></i>&nbsp;{{ Carbon\Carbon::parse($row->created_at)->isoFormat('D MMMM Y') }}</small>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="blog-item mb-3">
                    <div>
                        {{ $paginatedResults->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection