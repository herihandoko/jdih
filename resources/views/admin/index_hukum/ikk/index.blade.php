@extends('admin.admin_layouts')
@section('admin_content')
<style>
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
</style>

    <h1 class="h3 mb-3 text-gray-800">Indeks IKK</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Indeks IKK</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.index_hukum.ikk.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead>
                    <tr>
                        <th style="width: 2%;">No.</th>
                        <th>Judul</th>
                        <th>Tahun</th>
                        <th>Nilai</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($indexIkk as $row)
                        <tr>
                            <td style="text-align: center; width: 2%; vertical-align: middle;">
                                {{ $loop->iteration }}
                            </td>
                            <td style="width: 50%; vertical-align: middle;">{{ $row->ikk_name }}</td>
                            <td style="width: 15%; text-align: center; vertical-align: middle;">{{ $row->ikk_year }}</td>
                            <td style="width: 15%; text-align: center; vertical-align: middle;">{{ $row->ikk_score }}</td>
                            <td style="width: 2%; text-align: center;">
                                @if($row->ikk_file)
                                    <a href="#" data-href="{{ URL::to('storage/places/index_hukum/'.$row->ikk_file) }}" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#viewFile" class="btn btn-sm btn-custom vFile">
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
                            <td style="text-align: center; width: auto;">
                                @php $ikkID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/index-hukum/ikk/edit/'.$ikkID) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#confirm-delete" class="btn btn-danger btn-sm" data-href="{{ URL::to('admin/index-hukum/ikk/delete/'.$row->id) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold">
                            <i class="fas fa-exclamation-triangle"></i>
                            Konfirmasi
                        </h4>
                    </div>
                    <div class="modal-body">
                        Anda yakin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-ok" data-dismiss="modal">
                            Batal
                        </button>

                        <a class="btn btn-danger btn-ok">
                            Hapus
                        </a>
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
    
    <script type="text/javascript">
       $('#confirm-delete').on('show.bs.modal', function(e) {
           $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
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