@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $menu->menu_name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $contentCount }} {{ $menu->menu_name }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if( $contentList->count() > 0 )
                        
                        @php
                            $i = 0;
                        @endphp
                        
                        @foreach ($contentList as $key => $row)
                            <div class="mb-3">
                                <div class="card-header text-white" style="background-color: #11D694;">
                                    <span style="display: inline-block; border-radius: 2px; border: 1px solid cadetblue; padding: 0 14px; font-size: 13px; background-color: cadetblue;">
                                        <small>
                                            <i class="fa fa-eye"></i>&nbsp;dilihat {{ $row->view }} kali
                                        </small>
                                    </span>
                                    <span style="float: right; margin-top: 2px; display: inline-block; border-radius: 2px; border: 1px solid cadetblue; padding: 0 14px; font-size: 13px; background-color: cadetblue;">
                                        <small>
                                            <i class="fa fa-calendar-alt"></i>&nbsp;{{ $row->created_at->isoFormat('D MMMM Y') }} {{ $row->updated_at->format('H:i:s') }}
                                        </small>
                                    </span>
                                </div>
                                <div class="feature-mono">
                                    <span style="font-size: small;">No. {{ $contentList->firstItem() + $key }} dari {{ $contentCount }}</span>
                                    
                                    <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                        <a href="{{ url('/frontpage/'.$menu->slug.'/'.$row->slug) }}">
                                            {{ ucwords($row->judul_peraturan) }}
                                        </a>
                                    </h4>
                                    <p>{{ $row->teu_badan }}</p>
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
                            {!! $contentList->links() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('layouts.sidebar_frontpage')
                </div>
            </div>
        </div>
    </div>

    
@endsection