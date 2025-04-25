@extends('layouts.app')

@section('content')
<style>
    .card {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s, opacity 0.5s;
        opacity: 0;
    }

    .card.show {
        opacity: 1;
    }

    .card:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }

    .card-footer .btn {
        margin-bottom: 5px;
    }
    
    .btn:disabled {
        opacity: 0.3;
    }

    @media (max-width: 768px) {
        .card-footer .row {
            flex-direction: column;
        }

        .card-footer .col-md-3 {
            width: 100%;
            margin-bottom: 10px;
        }

        .card-footer .col-md-3:last-child {
            margin-bottom: 0;
        }
    }

    /* Flexbox for equal height cards */
    .row-flex {
        display: flex;
        flex-wrap: wrap;
    }

    .row-flex > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }
    
    /* Modal Enhancements */
    .modal-content {
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        background: linear-gradient(1deg, #b5e5c0, #ffffff);
        background-size: cover;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .modal-content::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
        background-size: 10px 10px;
        z-index: 1;
    }

    .modal-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
        position: relative;
        z-index: 2;
    }

    .modal-header .close {
        font-size: 1.5rem;
        color: #F96B06;
    }

    .modal-body {
        padding: 0.5rem;
        font-size: 0.9rem;
        position: relative;
        z-index: 2;
    }

    /* Material List Enhancements */
    #material-list .list-group-item {
        margin-bottom: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-radius: 4px;
        transition: background-color 0.2s, color 0.2s;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.8);
        position: relative;
        z-index: 2;
    }

    #material-list .list-group-item a {
        text-decoration: none;
        color: #007bff;
        transition: color 0.2s;
        font-size: 0.9rem;
        margin-left: 10px;
    }

    #material-list .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.9);
    }

    #material-list .list-group-item a:hover {
        color: #0056b3;
    }
    
    .list-group-item:nth-child(odd) {
        background-color: rgba(248, 249, 250, 0.8);
    }

    .list-group-item:nth-child(even) {
        background-color: rgba(233, 236, 239, 0.8);
    }

    .fa-file-pdf {
        color: #e74c3c;
    }

    .fa-file-powerpoint {
        color: #d35400;
    }

    .fa-file-word {
        color: #2980b9;
    }
</style>

<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Bimtek Hybrid') }}</h1>
        <p class="subtitle">{{ translateText('Ditemukan') }} {{ $contentList->total() }} {{ translateText('Bimtek') }}</p>
    </div>
</div>

<div class="page-content mt_30">
    <div class="container-jdihcontent">
        @if( $realData->count() > 0 )
        <div class="row mb-3">
            <div class="col">
                <form class="form-inline d-flex justify-content-between align-items-center" method="post" action="{{ route('front.bimtekhibrid') }}">
                    @csrf
                    <div></div>
                    <div>
                        <div class="input-group">
                            <input class="form-control form-control-sm" type="text" name="search" placeholder="Silakan cari..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-0 fa-search"></i>&nbsp;Cari
                                </button>
                           </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        
        <div class="row row-flex">
            @if( $contentList->count() > 0 )
                @foreach ($contentList as $row)
                    <div class="col-sm-12 col-md-6 mb-3 d-flex">
                        <div class="card w-100 shadow">
                            <div class="card-header">
                                <span style="font-weight: bold;">{{ $row->bimtek_number }}</span>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ $row->bimtek_name }}
                                </p>
                                <hr>
                                <small class="text-muted">
                                    {{ $row->bimtek_desc }}
                                </small>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    <p>
                                        <span style="font-weight: bold;">{{ 'Tanggal Bimtek:' }}</span>
                                        @if($currentDateFormat > $row->bimtek_end_date)
                                            {{ \Carbon\Carbon::parse($row->bimtek_start_date)->translatedFormat('d F Y') }} {{ 's/d' }} {{ \Carbon\Carbon::parse($row->bimtek_end_date)->translatedFormat('d F Y') }} <span style="color: red; font-style: italic; font-size: smaller;">{{ '(Sudah berakhir)' }}</span>
                                        @else
                                            @php
                                                $startDate = \Carbon\Carbon::parse($row->bimtek_start_date);
                                                $endDate = \Carbon\Carbon::parse($row->bimtek_end_date);
                                                $differenceInDays = $endDate->diffInDays($startDate) + 1;
                                            @endphp
                                            {{ \Carbon\Carbon::parse($row->bimtek_start_date)->translatedFormat('d F Y') }} {{ 's/d' }} {{ \Carbon\Carbon::parse($row->bimtek_end_date)->translatedFormat('d F Y') }} <span style="font-style: italic; font-weight: 600; font-size: smaller;">{{ '('.$differenceInDays . ' hari)' }}</span>
                                        @endif
                                    </p>
                                </small>
                                <div class="row">
                                    <div class="col-md-3 mb-2 mb-md-0">
                                        @if(($currentDateFormat > $row->bimtek_end_date) || ($currentDateFormat >= $row->bimtek_start_date))
                                            <button class="btn btn-success btn-sm btn-block" disabled>
                                                <i class="fas fa-file-text"></i>
                                            </button>
                                        @else
                                            <a href="{{ $row->bimtek_link_register }}" target="_blank" class="btn btn-success btn-sm btn-block">
                                                <i class="fas fa-file-text"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-3 mb-2 mb-md-0">
                                        @if(($currentDateFormat > $row->bimtek_end_date) || ($currentDateFormat < $row->bimtek_start_date))
                                            <button class="btn btn-primary btn-sm btn-block" disabled>
                                                {{ 'Zoom' }}
                                            </button>
                                        @else
                                            <a href="{{ $row->bimtek_link_zoom }}" target="_blank" class="btn btn-primary btn-sm btn-block">
                                                {{ 'Zoom' }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-3 mb-2 mb-md-0">
                                        @if($row->bimtek_link_doc)
                                            <button id="{{ $row->bimtek_link_doc }}" class="btn btn-danger btn-sm btn-block doc-yt" data-toggle="modal" data-target="#modalYt" data-backdrop="static" data-keyboard="false">
                                                <i class="fab fa-youtube"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-danger btn-sm btn-block" disabled>
                                                <i class="fab fa-youtube"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($row->material->count() > 0)
                                            <button type="button" class="btn btn-info btn-sm btn-block doc-material" data-toggle="modal" data-target="#modalMaterial" data-backdrop="static" data-keyboard="false" data-materials="{{ $row->material }}">
                                                <i class="fas fa-file-pdf"></i> {{ '/' }} <i class="fas fa-file-powerpoint"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-info btn-sm btn-block" disabled>
                                                <i class="fas fa-file-pdf"></i> {{ '/' }} <i class="fas fa-file-powerpoint"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                @endforeach
            @else
                @include('pages.no_data')
            @endif
        </div>
        <div class="blog-item mb-3">
            <div>
                {!! $contentList->appends(['search' => request('search')])->links() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalYt" tabindex="-1" role="dialog" aria-labelledby="ytModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0); border: none;">
            <div class="modal-header" style="border-bottom: 0px; background-color: #000000;">
                <button type="button" class="close" style="padding: 0rem 1rem; outline: none;" data-dismiss="modal" title="Tutup">
                    <span aria-hidden="true" style="color: #F96B06;">×</span>
                </button>
            </div>
            
            <iframe id="video-yt" style="width: 100%; height: 450px;" class="embed-responsive-item" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-labelledby="materialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materialModalLabel">Daftar Materi</h5>
                <button type="button" class="close" style="outline: none;" data-dismiss="modal" title="Tutup">
                    <span aria-hidden="true" style="color: #F96B06;">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="material-list" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        setEqualHeight('.card');

        $(window).resize(function() {
            setEqualHeight('.card');
        });

        function setEqualHeight(selector) {
            var maxHeight = 0;
            $(selector).css('height', 'auto');
            $(selector).each(function() {
                if ($(this).height() > maxHeight) {
                    maxHeight = $(this).height();
                }
            });
            $(selector).height(maxHeight);
        }

        $('.card').each(function(i) {
            setTimeout(function() {
                $('.card').eq(i).addClass('show');
            }, 400 * i);
        });

        // Video Youtube
        $("button.doc-yt").click(function(e) {
            e.preventDefault();
            var id_yt = $(this).attr('id');
            var src_yt = "https://www.youtube.com/embed/"+id_yt+"?autoplay=1&mute=1&controls=1";
            $("#video-yt").attr("src", src_yt);
        });
        
        $("#modalYt").on("hide.bs.modal", function(e) {
            $("#video-yt").attr("src", "");
        });
        
        // Material
        $('#modalMaterial').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var materials = button.data('materials');
            var materialList = $('#material-list');

            materialList.empty();
            
            materials.forEach(function(material) {
                if(material.is_deleted == 0) {
                    var fileType = material.materi_file.split('.').pop().toLowerCase();
                    var listItemClass = '';
                    var iconClass = '';

                    switch (fileType) {
                        case 'pdf':
                            listItemClass = 'pdf';
                            iconClass = 'fa-file-pdf';
                            break;
                        case 'ppt':
                        case 'pptx':
                            listItemClass = 'ppt';
                            iconClass = 'fa-file-powerpoint';
                            break;
                        case 'doc':
                        case 'docx':
                            listItemClass = 'doc';
                            iconClass = 'fa-file-word';
                            break;
                        default:
                            listItemClass = '';
                            iconClass = '';
                    }
                    
                    var listItem = '<li class="list-group-item ' + listItemClass + '"><i class="fas ' + iconClass + '"></i><a href="' + '{{ asset('storage/places/materi_bimtek') }}/' + material.materi_file + '" target="_blank">' + material.materi_file + '</a></li>';
                    materialList.append(listItem);
                }
            });
        });
        
        $("#modalMaterial").on("hide.bs.modal", function(e) {
            $("#material-list").attr("src", "");
        });
    });
</script>
@endsection