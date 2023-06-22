@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Berita</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Berita</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.media_hukum.berita.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead style="text-align: center;">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 5%;">Foto</th>
                        <th style="width: 10%;">Kategori</th>
                        <th style="width: 15%;">Judul Berita</th>
                        @if($compcode == '')
                        <th style="width: 6%;">Dinas</th>
                        @endif
                        <th style="width: 12%;">Dibuat Oleh</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 12%;">Publish Tgl</th>
                        <th style="width: 8%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($beritaList as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>
                                @if($row->photo_berita)
                                    <img src="{{ url('storage/places/berita/'.$row->photo_berita) }}" alt="Foto Berita" class="w_30">
                                @else
                                    <img src="{{ url('storage/places/berita/logo-berita.png') }}" alt="Foto Berita" class="w_30">
                                @endif
                            </td>
                            <td>
                                @if($row->berita_categories)
                                    {{ $row->berita_categories->category_name }}
                                @endif
                            </td>
                            <td>{{ $row->judul_berita }}</td>
                            @if($compcode == '')
                                <td>{{ $row->comp_name }}</td>
                            @endif
                            <td style="text-align: center;">
                                {{ $row->name }}
                            </td>
                            <td style="text-align: center;">
                                @if($row->publish == 0) <font class="btn-danger btn-sm" style="font-size: small;">{{ 'Belum Publish' }}</font>
                                @else <font class="btn-success btn-sm" style="font-size: small;">{{ 'Publish' }}</font>@endif
                            </td>
                            <td style="text-align: center;">
                                @if($row->publish_at)
                                    {!! date('d-m-Y H:i:s', strtotime($row->publish_at)) !!}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @php $beritaID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/media-hukum/berita/edit/'.$beritaID) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#confirm-delete" class="btn btn-danger btn-sm" data-href="{{ URL::to('admin/media-hukum/berita/delete/'.$row->id) }}">
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