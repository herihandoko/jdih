@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('storage/places/'.$g_setting->banner_search) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Pencarian kata: {{ $keywords }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $produkHukumCount }} {{ $menu->menu_name}}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
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
                                        <i class="fa fa-eye"></i> dilihat {{ $row->view }} kali
                                    </div>
                                    <div class="feature-mono">
                                        <span style="font-size: small;">No. {{ $produkHukumItems->firstItem() + $key }} dari {{ $produkHukumCount }}</span>
                                        <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                            <a href="{{ url('/frontpage/'.$menu->slug.'/'.$row->slug) }}">{{ ucwords($row->judul_peraturan) }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    <div class="blog-item mb-3">
                        <div>
                            {{ $produkHukumItems->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection