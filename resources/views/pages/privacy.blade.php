@extends('layouts.app')

@section('content')

    <style>
        .box-data-produk{
            box-shadow: rgb(99 99 99 / 20%) 0px 2px 8px 0px;
            background: #fff;
            padding: 20px;
            margin-bottom:20px;
            min-height: 150px;
            border-radius: 10px;
        }
    </style>
    
    <div class="page-banner">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $privacy->name }}</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-data-produk">
                        {!! html_entity_decode($privacy->detail) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection