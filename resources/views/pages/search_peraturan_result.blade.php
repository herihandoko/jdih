@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('storage/places/'.$g_setting->banner_search) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>
                @if($param == 'bentuk')
                    Pencarian: {{ $keywords->type_name  }}
                @else
                    Pencarian: {{ $keywords  }}
                @endif
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $produkHukumCount }} Peraturan
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                @if($menu)
                    <div class="col-sm-8">
                @else
                    <div class="col-sm-12">
                @endif
                        @if(count($produkHukumItems) == 0)
                            <div class="shadowbox text-danger">
                                Tidak terdapat data yang dicari
                            </div>
                        @else
                            @php
                                $i = 0;
                            @endphp

                            @foreach ($produkHukumItems as $key => $row)
                                <div class="mb-3">
                                    <div class="card-header text-white" style="background-color: #11D694;">
                                        <span style="display: inline-block; border-radius: 2px; border: 1px solid cadetblue; padding: 0 14px; font-size: 13px; background-color: cadetblue;"">
                                            <i class="fa fa-eye"></i> dilihat {{ $row->view }} kali
                                        </span>
                                    </div>
                                    <div class="feature-mono">
                                        <span style="font-size: small;">No. {{ $produkHukumItems->firstItem() + $key }} dari {{ $produkHukumCount }}</span>
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
                                            @php
                                                $menuSlug = DB::table('menus')->where('type_ruledoc', '=', $row->produk_hukum_types_id)->first();
                                            @endphp
                                            <a href="{{ url('/produkhukum/'.$menuSlug->slug.'/'.$row->slug) }}">{{ ucwords($row->judul_peraturan) }}</a>
                                        </h4>
                                        <p>{{ $row->produk_hukum_types->type_name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    <div class="blog-item mb-3">
                        <div>
                            @if($param == 'bentuk')
                                {!! $produkHukumItems->appends([$param => $keywords->id])->links() !!}
                            @else
                                {!! $produkHukumItems->appends([$param => $keywords])->links() !!}
                            @endif
                        </div>
                    </div>
                </div>
                @if($menu)
                    <div class="col-md-4">
                        @include('layouts.sidebar_peraturan')
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection