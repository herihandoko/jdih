@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('storage/places/'.$strukturOrganisasi->banner) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $strukturOrganisasi->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $strukturOrganisasi->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <font style="font-size: small; font-style: italic; color: #B1B1B1">Diposting tanggal {{ $registeredAt }}</font>
            <hr/>

            <div class="row">
                <div class="col-md-12" style="padding-bottom: 10px;">
                    {!! $strukturOrganisasi->content !!}
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