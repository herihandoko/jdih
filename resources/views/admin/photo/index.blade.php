@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Galeri Foto</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Galeri Foto</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.photo.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead>
                    <tr>
                        <th style="width: 2%;">No.</th>
                        <th>File Foto</th>
                        <th>Nama Foto</th>
                        @if($compcode == '')
                            <th>Dinas</th>
                        @endif
                        <th>Dibuat Oleh</th>
                        <th>Dibuat Tgl</th>
                        <th>Urut</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($photosList as $row)
                        <tr>
                            <td style="text-align: center; width: 2%;">{{ $loop->iteration }}</td>
                            <td style="text-align: center; width: 20%;">
                                <img src="{{ url('storage/places/galeri_foto/'.$row->photo_name) }}" alt="" class="w-50">
                            </td>
                            <td style="width: 20%;">{{ $row->photo_caption }}</td>
                            @if($compcode == '')
                                <td style="width: auto;">{{ $row->comp_name }}</td>
                            @endif
                            <td style="text-align: center; width: auto;">
                                {{ $row->name }}
                            </td>
                            <td style="text-align: center; width: auto;">
                                @if($row->created_at)
                                    {!! date('d M Y H:i:s', strtotime($row->created_at)) !!}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td style="width: auto;">{{ $row->photo_order }}</td>
                            <td style="text-align: center; width: auto;">
                                @php $fotoID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/photo-gallery/edit/'.$fotoID) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#confirm-delete" class="btn btn-danger btn-sm" data-href="{{ URL::to('admin/photo-gallery/delete/'.$row->id) }}">
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
    </div>
    
    <script type="text/javascript">
       $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection