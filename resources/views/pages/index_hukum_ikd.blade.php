@extends('layouts.app')

@section('content')
<style>
    table tr th{
        background:#11D694;
        color:black;
        text-align:center;
        vertical-align:center;
    }
    
    .btn-custom {
        color: #F96B06;
    }
    
    .btn-custom:focus, .btn-custom:active {
        outline: none;
        box-shadow: none;
    }
    
    .btn-custom:hover i {
        color: #c82333;
    }
    
    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            display: none;
        }

        tbody tr {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        td {
            display: block;
            text-align: left;
            padding-left: 50%;
            position: relative;
            white-space: wrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            width: calc(50% - 30px);
            text-align: left;
            font-weight: bold;
            white-space: wrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
</style>

<div class="page-banner">
    <div class="container">
        <h1>{{ translateText('Indeks Hukum IKD') }}</h1>
    </div>
</div>

<div class="page-content mt_30">
    <div class="container-jdihcontent">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="tableFrontIkd" class="table table-fixed table-striped table-hover" style="width:100%" cellspacing="0" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th style="width: 5%;">Tahun</th>
                            <th style="width: 5%;">Nilai</th>
                            <th style="width: 2%;">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contentList as $row)
                            <tr>
                                <td style="vertical-align: middle;">{{ $row->ikd_name }}</td>
                                <td data-label="Tahun" style="text-align: center; vertical-align: middle;">{{ $row->ikd_year }}</td>
                                <td data-label="Nilai" style="text-align: center; vertical-align: middle;">{{ $row->ikd_score }}</td>
                                <td data-label="File" style="text-align: center; vertical-align: middle;">
                                    @if($row->ikd_file && $row->ikd_file_view == 0)
                                        <a href="#" data-href="{{ URL::to('storage/places/index_hukum/'.$row->ikd_file) }}" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#viewFile" class="btn btn-sm btn-custom vFile">
                                            <span>
                                                <i class="fas fa-file-pdf fa-lg"></i>
                                            </span>
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-custom">
                                            <span style="color: grey;">
                                                <i class="fas fa-ban"></i>
                                            </span>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="viewFile" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: rgba(0, 0, 0, 0); border: none;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" style="padding: 0rem 1rem; outline: none;" data-dismiss="modal" title="Tutup">
                        <span aria-hidden="true" style="color: #F96B06;">×</span>
                    </button>
                </div>

                <iframe id="fileDoc" style="width: 100%; height: 550px;" class="embed-responsive-item" src="" frameborder="0" scrolling="auto" align="top" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tableFrontIkd').DataTable();
    });
    
    $(".vFile").click(function(e) {
        e.preventDefault();

        var src_file = $(this).attr('data-href');
        $("#fileDoc").attr("src", src_file);
    });

    $("#viewFile").on("hide.bs.modal", function(e) {
        $("#fileDoc").attr("src", "");
    });
</script>
@endsection