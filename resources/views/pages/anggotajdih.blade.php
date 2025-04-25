@extends('layouts.app')

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Anggota JDIH Provinsi Banten') }}</h1>
    </div>
</div>

<div class="page-content">
    <div class="container-jdihmember">
        @foreach ($anggotaJdih as $key => $row)
            <div class="item-jdihmember">
                <a href="{{ $row->column_item_url }}" target="_blank">
                    @if($row->logo)
                        <img src="{{ url('storage/places/logo_institusi/'.$row->logo) }}" alt="{{ $row->column_item_text }}">
                    @else
                        <img src="{{ url('storage/places/logo_institusi/no-logo.png') }}" alt="">
                    @endif
                    <p>{{ $row->column_item_text }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection