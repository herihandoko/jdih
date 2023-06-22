@extends('layouts.app')

<style type="text/css">
    .feature-mono {
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 0;
        padding-bottom: 5px;
        border: 1px solid #ddd;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 1px 1px 3px 4px rgba(226, 228, 229, 0.3);
        position: relative;
        margin-bottom: 10px;
    }

    .feature-mono span {
        font-size: 15px;
        font-weight: 700;
        margin: 5px 0 10px;
        padding: 0;
    }

    .feature-mono h4 a {
        font-size: 18px !important;
        font-weight: 600 !important;
        margin: 5px 0 5px !important;
        padding: 0 !important;
        color:#000 !important;
    }

    .feature-mono p {
        padding-bottom: 0;
        margin-bottom: 5px;
        font-size: 14px;
        line-height: 1.2;
    }
</style>

@section('content')
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $catMenuPeraturan->category_name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item" style="color: white;">
                        Ditemukan {{ $peraturanList->count() }} Peraturan
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
                        
                        @foreach ($peraturanList as $row)
                            <div class="mb-3">
                                <div class="card-header text-white" style="background-color: #11D694;">
                                    <i class="fa fa-eye"></i> dilihat {{ $row->view }} kali
                                </div>
                                <div class="feature-mono">
                                    <span>No {{ $loop->iteration }} dari {{ $peraturanList->count() }}</span>
                                    @if($row->status_akhir == 'Berlaku')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-success btn-sm">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Diubah')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-primary btn-sm">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Mengubah')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-primary btn-sm">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Dicabut')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-warning btn-sm">{{ $row->status_akhir }}</font>
                                        </span>
                                    @elseif($row->status_akhir == 'Mencabut')
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-warning btn-sm">{{ $row->status_akhir }}</font>
                                        </span>
                                    @else
                                        <span style="float: right; margin-right: 20px;">
                                            <font class="btn-danger btn-sm">{{ $row->status_akhir }}</font>
                                        </span>
                                    @endif
                                    <h4 style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                        <a href="{{ url('peraturan-pusat/'.$row->slug) }}">{{ $row->judul_peraturan }}</a>
                                    </h4>
                                    <p>{{ $row->produk_hukum_types->type_name }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        Tidak terdapat data.
                    @endif
                    <div class="blog-item mb-3">
                        <div>
                            {{ $peraturanList->links() }}
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