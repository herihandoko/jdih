@extends('layouts.app')
@php
$g_setting = DB::table('general_settings')->where('id', 1)->first();
@endphp
<style>
    #fixed-button {
        position: fixed;
        bottom: 0px;
        left: 0px;
        padding: 20px;
    }

    .outer {
        position: relative;

        &:before {
            display: block;
            content: "";
            width: 100%;
            padding-top: (9 / 16) * 100%;
        }

        >.inner {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100%;
        }
    }
</style>

@section('content')

<div class="page-banner">
    <div class="container">

        <h1>{{ translateText($hukumadatDetail->hukumadat_name) }}</h1>
    </div>
</div>


<div class="page-content">
    <div class="container">
        <div class="row">

            <div class="col-sm-8">
                <a href="{{ route('front.hukumadat') }}" style="color: #000;">
                    <i class="fa fa-chevron-circle-left"></i>&nbsp;Kembali
                </a>
            </div>
            <div class="col-sm-12">
                <div class="slider">
                    <div class="slide-carousel owl-carousel">

                        @foreach($hukumadatregulasiDetail->where('materi_type', 1) as $row)
                        <div class="slider-item" style="background-image:url({{ asset('storage/places/materi_hukumadat/'.$row->materi_file) }}); height: 50vh!important;">
                            <div class="slider-bg"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7 col-sm-12">
                                        <div class="slider-table">
                                            <div class="slider-text">
                                                <div class="text-animated">
                                                    <h1>&nbsp;</h1>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <br />
            </div>

            <div class="col-sm-12">
                @include('layouts.table_content_hukumadat')
            </div>

        </div>
    </div>
</div>

@endsection