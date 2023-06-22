@extends('layouts.app')

@section('content')

	<div class="page-banner" style="background-image: url({{ asset('storage/places/'.$g_setting->banner_blog_detail) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $produkHukumDetail->judul_peraturan }}</h1>
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.peraturanhukum', $menu->slug) }}">Peraturan Pusat</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $produkHukumDetail->judul_peraturan }}</li>
                </ol>
            </nav> -->
        </div>
    </div>

    <div class="page-content">
    	<div class="container">
    		<div class="row">
                <div class="col-sm-8">
                    <a href="{{ route('front.peraturanhukum', $menu->slug) }}" style="color: #000;">
                        <i class="fa fa-chevron-circle-left"></i>&nbsp;Kembali
                    </a>
                </div>

                <div class="col-sm-8">
                    <br/>
                </div>

                <div class="col-sm-8">
                    @include('layouts.table_content_peraturan')
                </div>
                    
                <div class="col-md-4">
                    <div class="container-iframe">
                        @if($produkHukumDetail->file_peraturan)
                            @php
                                $extension = pathinfo(storage_path('/places/peraturan/'.$produkHukumDetail->file_peraturan), PATHINFO_EXTENSION);
                            @endphp
                            @if($extension == "zip")
                                <embed src="{{ url('storage/places/peraturan/404-zip.jpg') }}#scrollbar=0" style="height: 400px; width: 100%;" class="hidden-xs">
                            @else
                                <embed type="application/pdf" src="{{ url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan) }}#scrollbar=0" style="height: 400px; width: 100%;" class="hidden-xs">
                            @endif
                        @else
                            <embed src="{{ url('storage/places/peraturan/404.jpg') }}#scrollbar=0" style="height: 400px; width: 100%;" class="hidden-xs">
                        @endif
	            </div>
                    @if($produkHukumDetail->file_peraturan)
    	                <div class="d-grid gap-2 col-12 mx-auto mt-2">
    	                    <a href="{{ url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan) }}" class="btn btn-primary btn-block" download style=" color: #fff; background-color: #11D694; border-color: #11D694; font-weight: 800;">
                                <i class="fa fa-download"></i>&nbsp;Download
    	                    </a>
    	                </div>
                    @else
                        <div class="d-grid gap-2 col-12 mx-auto mt-2">
                            <button class="btn btn-secondary btn-block" disabled="true" style="cursor: default; font-weight: 800;">
                                <i class="fa fa-download"></i>&nbsp;Download
                            </button>
                        </div>
                    @endif
    		</div>
                    
    		</div>
    	</div>
    </div>

@endsection