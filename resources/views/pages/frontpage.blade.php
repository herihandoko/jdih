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
                @include('layouts.sidebar_frontpage')
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
                                <span style="font-size: x-small;">
                                    {{ translateText('No.') }} {{ $contentList->firstItem() + $key }} {{ translateText('dari') }} {{ $contentList->total() }}
                                </span>

                                <p style="margin-top: 10px !important; margin-bottom: 15px !important;">
<!--                                        <a style="font-size: medium; font-weight: 600; color: black;" href="{{ route('front.detail', ['menuslug' => $menu->slug, 'slug' => $row->slug, 'keyword' => request('keyword'), 'tahun' => request('tahun'), 'page' => request('page', 1)]) }}">
                                        {{ ucwords(translateText($row->judul_peraturan)) }}
                                    </a>-->

                                    <form id="detailForm" action="{{ route('front.detail', ['menuslug' => $menu->slug, 'slug' => $row->slug]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input style="display: none;" name="menuslug" value="{{ $menu->slug }}">
                                        <input style="display: none;" name="slug" value="{{ $row->slug }}">
                                        <input style="display: none;" name="id" value="{{ $row->id }}">
                                        <input style="display: none;" name="keyword" value="{{ request('keyword', '') }}">
                                        <input style="display: none;" name="tahun" value="{{ request('tahun', 0) }}">
                                        <input style="display: none;" name="page" value="{{ request('page', 1) }}">

                                        <button type="submit" class="btn btn-sm btn-links p-0 m-0 align-baseline" style="font-size: medium; font-weight: 600; text-align: left;">
                                            {{ ucwords(translateText($row->judul_peraturan)) }}
                                        </button>
                                    </form>
                                </p>

                                <p>
                                    {{ translateText($row->teu_badan) }}
                                </p>
                                
                                <div class="mt-2 mb-md-0 view-pengundangan">
                                    <span class="mr-2">
                                        <i class="fa fa-eye"></i>&nbsp;<small>{{ number_format($row->view, 0) }}</small>
                                    </span>
                                </div>

                                <div class="mt-2 mb-md-0 view-pengundangan">
                                    <small>
                                        <i class="fa fa-calendar-alt"></i>&nbsp;{{ $row->created_at->isoFormat('D MMMM Y') }} {{ $row->created_at->format('H:i:s') }}
                                    </small>
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