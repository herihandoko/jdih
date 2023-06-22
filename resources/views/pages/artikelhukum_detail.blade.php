@extends('layouts.app')

@section('content')

	<div class="page-banner" style="background-image: url({{ asset('storage/places/'.$g_setting->banner_blog_detail) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Artikel</h1>
        </div>
    </div>

    <div class="page-content">
    	<div class="container">
    		<div class="row">
                <!-- <div class="col-sm-8">
                    <a href="{{ route('front.artikelhukum') }}" style="color: #000;">
                        <i class="fa fa-chevron-circle-left"></i>&nbsp;Kembali
                    </a>
                </div>

                <div class="col-sm-8">
                    <br/>
                </div> -->

    			<div class="col-md-12">
                    <div class="single-section">
                        <div class="text">
                            <h2>{{ $artikelHukumDetail->judul_artikel }}</h2>
                            {!!  $artikelHukumDetail->content_artikel !!}
                        </div>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>

@endsection