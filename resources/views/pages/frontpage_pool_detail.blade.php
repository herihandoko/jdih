@extends('layouts.app')

@section('content')
<div class="page-banner">
    <div class="container">
        <h2>{{ translateText($produkHukumDetail->judul_peraturan) }}</h2>
    </div>
</div>

<div class="page-content">
    <div class="container-jdihcontent">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <form id="detailForm" action="{{ route('front.frontpage', ['slug' => $menu->slug]) }}" method="POST" style="display: inline;">
                            @csrf
                            <input style="display: none;" name="slugs" value="{{ $menu->slug }}">
                            <input style="display: none;" name="keyword" value="{{ $keyword }}">
                            <input style="display: none;" name="tahun" value="{{ $tahun }} ">
                            <input style="display: none;" name="pagefrom" value="{{ $pageFrom }} ">
                            <input style="display: none;" name="page" value="{{ $page }}">

                            <button type="submit" class="btn btn-sm btn-links">
                                <i class="fa fa-chevron-circle-left"></i>&nbsp;{{ translateText('Kembali') }}
                            </button>
                        </form>
                    </div>
                    <div class="col-md-5 col-sm-5 d-flex justify-content-end align-items-center">
                        @include('partials.share')
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <br/>
            </div>

            <div class="col-sm-8">
                @include('layouts.table_content_pool')
            </div>

            <div class="col-md-4 sidebar">
                <div class="theiaStickySidebar">
                    <div class="container-iframe shadow">
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
                            <a href="{{ url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan) }}" class="btn btn-sm btn-block" download>
                                <i class="fa fa-file-audio"></i>&nbsp;{{ translateText('Dengarkan Peraturan') }}
                            </a>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto mt-2">
                            <a href="{{ url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan) }}" class="btn btn-sm btn-block btn-download-doc" download>
                                <i class="fa fa-download"></i>&nbsp;{{ translateText('Download') }}
                            </a>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto mt-2 text-center">
                            {!! QrCode::size(150)->generate(asset('storage/places/peraturan/'.$produkHukumDetail->file_peraturan)) !!}
                        </div>
                    @else
                        <div class="d-grid gap-2 col-12 mx-auto mt-2">
                            <button class="btn btn-sm btn-secondary btn-block" disabled="true" style="cursor: default; font-weight: 800;">
                                <i class="fa fa-download"></i>&nbsp;{{ translateText('Download') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
<style>
    /* #footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 20px;
        position: fixed;
        width: 100%;
        bottom: 0;
    } */

    #calendar {
        font-size: 16px;
        margin-top: 10px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan elemen untuk menampilkan kalender
            const calendarElement = document.getElementById("calendar");

            // Membuat objek Date untuk mendapatkan tanggal saat ini
            const today = new Date();

            // Mendapatkan nama hari dan bulan
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            const dayOfWeek = daysOfWeek[today.getDay()];
            const day = today.getDate();
            const month = monthsOfYear[today.getMonth()];
            const year = today.getFullYear();

            // Format tanggal
            const formattedDate = `${dayOfWeek}, ${day} ${month} ${year}`;

            // Menampilkan tanggal di elemen kalender
            calendarElement.textContent = `Today's Date: ${formattedDate}`;
        });
    $(document).ready(function() {

    });
</script>
@endsection