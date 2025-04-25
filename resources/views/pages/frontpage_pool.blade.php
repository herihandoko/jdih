@extends('layouts.app')

@section('content')

<div class="page-banner">
    <div class="container">
        <h1>{{ translateText($menu->menu_name) }}</h1>
        <p class="subtitle">{{ translateText('Ditemukan') }} {{ $contentList->total() }} {{ translateText($menu->menu_name) }}</p>
    </div>
</div>

<div class="page-content">
    <div class="container-jdihcontent">
        <div class="row">
            <div class="col-md-3 order-1 order-md-2 sidebar">
                @include('layouts.sidebar_frontpage_pool')
            </div>
            <div class="col-sm-9 order-2 order-md-1">
                @if( $contentList->count() > 0 )
                    @php
                        $i = 0;
                    @endphp

                    @foreach ($contentList as $key => $row)
                        <div class="mb-3">
                            <div class="card-header text-white" style="background-color: #11D694;">
                                <p class="mt-0 mb-0" style="color: #222; font-weight: 700; text-transform: uppercase;">
                                    {{ 'Pemerintah Provinsi Banten' }}
                                </p>
                            </div>
                            <div class="feature-mono">
                                <span style="font-size: x-small;">{{ translateText('No.') }} {{ $contentList->firstItem() + $key }} {{ translateText('dari') }} {{ $contentList->total() }}</span>
                                @if($row->status_akhir)
                                    @if($row->status_akhir == 'Berlaku')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-success btn-sm" style="font-size: x-small;">{{ $row->status_akhir }}</font>
                                        </span>
                                    @else
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-danger btn-sm" style="font-size: x-small;">{{ 'Tidak Berlaku' }}</font>
                                        </span>
                                    @endif
                                @endif

                                <p style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    @php
                                        $encryptedId = encrypt($row->id);
                                        $encryptedKeyword = encrypt(request('keyword', ''));
                                        $encryptedTahun = encrypt(request('tahun', 0));
                                        $encryptedPage = encrypt(request('page', 1));
                                        $encryptedRoutes = encrypt('front.pool.detail');
                                    @endphp
                                    <form id="detailForm" action="{{ route('front.pool.detail', ['menuslug' => $menu->slug, 'slug' => $row->slug]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input style="display: none;" name="menuslug" value="{{ $menu->slug }}">
                                        <input style="display: none;" name="slug" value="{{ $row->slug }}">
                                        <input style="display: none;" name="id" value="{{ $encryptedId }}">
                                        <input style="display: none;" name="keyword" value="{{ $encryptedKeyword }}">
                                        <input style="display: none;" name="tahun" value="{{ $encryptedTahun }}">
                                        <input style="display: none;" name="page" value="{{ $encryptedPage}}">
                                        <input style="display: none;" name="pagefrom" value="{{ 'inside' }}">
                                        <input style="display: none;" name="routes" value="{{ $encryptedRoutes }}">

                                        <button type="submit" class="btn btn-sm btn-links p-0 m-0 align-baseline" style="font-size: medium; font-weight: 600; text-align: left;">
                                            {{ ucwords(translateText($row->judul_peraturan)) }}
                                        </button>
                                    </form>
                                </p>
                                <p>
                                    @if($row->produk_hukum_types)
                                        {{ translateText($row->produk_hukum_types->type_name) }}
                                    @endif
                                </p>

                                <div class="mt-2 mb-md-0 view-pengundangan">
                                    <span class="mr-2">
                                        <i class="fa fa-eye"></i>&nbsp;<small>{{ number_format($row->view, 0) }}</small>
                                    </span>
                                </div>

                                <div class="mt-2 mb-md-0 view-pengundangan">
                                    <span>
                                        @if($row->tgl_pengundangan)
                                            <small><i class="fa fa-calendar-alt"></i>&nbsp;{{ translateText('Tgl Pengundangan:') }} {{ Carbon\Carbon::parse($row->tgl_pengundangan ?? $row->tanggal_pengundangan)->isoFormat('D MMMM Y') }}</small>
                                        @else
                                            <small><i class="fa fa-calendar-alt"></i>&nbsp;{{ Carbon\Carbon::parse($row->created_at)->isoFormat('D MMMM Y') }}</small>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @include('pages.no_data')
                @endif
                <div class="blog-item mb-3">
                    <div>
                        {!! $contentList->appends(['keyword' => request('keyword'), 'tahun' => request('tahun')])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection