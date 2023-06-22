@extends('layouts.app')

@section('content')

	<div class="page-banner" style="background-image: url({{ asset('storage/places/'.$g_setting->banner_blog_detail) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Majalah</h1>
        </div>
    </div>

    <div class="page-content">
    	<div class="container">
    		<div class="row">
                <div class="col-sm-8">
                    <a href="{{ route('front.majalahhukum') }}" style="color: #000;">
                        <i class="fa fa-chevron-circle-left"></i>&nbsp;Kembali
                    </a>
                </div>

                <div class="col-sm-8">
                    <br/>
                </div>

    			<div class="col-sm-8">
    				@include('layouts.table_content_majalah')
    			</div>

    			<div class="col-md-4">
    				<div class="container-iframe">
                        @if($majalahHukumDetail->file_majalah)
    	                    <iframe class="responsive-iframe" src="{{ url('storage/places/majalah/'.$majalahHukumDetail->file_majalah) }}" frameborder="0">
    	                    </iframe>
                        @else
                            <iframe style="height: auto;" class="responsive-iframe" src="{{ url('storage/places/majalah/404.jpg') }}" frameborder="0">
                            </iframe>
                        @endif
	                </div>
                    @if($majalahHukumDetail->file_majalah)
    	                <div class="d-grid gap-2 col-12 mx-auto mt-2">
    	                    <a href="{{ url('storage/places/majalah/'.$majalahHukumDetail->file_majalah) }}" class="btn btn-primary btn-block" download style=" color: #fff; background-color: #11D694; border-color: #11D694;">
    	                    	<i class="fa fa-download"></i>&nbsp;Download
    	                    </a>
    	                </div>
                    @else
                        <div class="d-grid gap-2 col-12 mx-auto mt-2">
                            <button class="btn btn-secondary btn-block" disabled="true"><i class="fa fa-download"></i>&nbsp;Download</button>
                        </div>
                    @endif
    			</div>
    		</div>
    	</div>
    </div>

@endsection