@extends('layouts.app')

@section('content')
<div class="page-banner">
    <div class="bg-page"></div>
    <div class="text">
        <h1>Hukum Adat</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item" style="color: white;">
                    Ditemukan {{ $hukumadatList->count() }} Hukum Adat
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @if( $hukumadatList->count() > 0 )

                @php
                $i = 0;
                @endphp

                @foreach ($hukumadatList as $row)
                <div class="mb-3">
                    <div class="card-header text-white" style="background-color: #11D694;">
                        <font style="font-size: 15px; font-weight: 700;">
                            <a href="{{ url('hukum-adat/'.$row->id) }}">{{ Str::of($row->hukumadat_name)->upper() }}</a>
                        </font>
                    </div>

                </div>
                @endforeach
                @else
                Tidak terdapat data.
                @endif
                <div class="blog-item mb-3">
                    <div>
                        {{ $hukumadatList->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('layouts.sidebar_hukumadat')
            </div>
        </div>
    </div>
</div>
@endsection