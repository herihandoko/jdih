@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="container">
            <h1>{{ translateText($strukturOrganisasi->name) }}</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <font style="font-size: small; font-style: italic; color: #B1B1B1">Diposting tanggal {{ $updatedAt }}</font>
            <hr/>

            <div class="row">
                <div class="col-md-12" style="padding-bottom: 10px;">
                    {!! html_entity_decode($strukturOrganisasi->content) !!}
                </div>
            </div>

            @if($strukturOrganisasi->picture)
            <div class="row">
                <div class="col-md-12" style="display: flex; justify-content: center;">
                    <img src="{{ asset('storage/places/'.$strukturOrganisasi->picture) }}">
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection