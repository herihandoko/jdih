@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="container">
            <h1>{{ translateText('Dasar Hukum') }}</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <font style="font-size: small; font-style: italic; color: #B1B1B1">Diposting tanggal {{ $updatedAt }}</font>
            <hr/>
            
            @if($dasarHukum->content)
                <div class="row">
                    <div class="col-md-12" style="padding-bottom: 10px;">
                        {!! html_entity_decode($dasarHukum->content) !!}
                    </div>
                </div>
            @endif

            @if($dasarHukum->file)
                <div class="row">
                    <div class="col-md-12" style="display: flex; justify-content: center;">
                        <embed type="application/pdf" src="{{ url('storage/places/dasar_hukum/'.$dasarHukum->file) }}#scrollbar=0" style="height: 500px; width: 100%;" class="hidden-xs">
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection