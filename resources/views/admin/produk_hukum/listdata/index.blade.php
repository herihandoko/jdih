@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Produk Hukum</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Produk Hukum</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.produk_hukum.listdata.jenisdokumen') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead style="text-align: center;">
                    <tr>
                        <th style="width: 2%;">No.</th>
                        <th>Jns Dokumen</th>
                        <th style="width: 10%;">Jns Peraturan</th>
                        <th style="width: 15%;">Judul</th>
                        @if($compcode == '')
                        <th>Dinas</th>
                        @endif
                        <th>Status</th>
                        <th style="width: 5%;">Dibuat Oleh</th>
                        <th style="width: 5%;">Tgl Dibuat</th>
                        <th style="width: 5%;">Tgl Diubah</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($produkHukumList as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $row->produk_hukum_categories->category_name }}</td>
                            @if($row->produk_hukum_types)
                                <td>{{ $row->produk_hukum_types->type_name }}</td>
                            @else
                                <td style="text-align: center">{{ '-' }}</td>
                            @endif
                            <td>{{ $row->judul_peraturan }}</td>
                            @if($compcode == '')
                                @if($row->comp_name == '')
                                    <td style="text-align: center">{{ '-' }}</td>
                                @else
                                    <td>{{ $row->comp_name }}</td>
                                @endif
                            @endif
                            @if(!empty($row->is_publish))
                                <td style="text-align: center;">
                                    @if($row->is_publish == 2) <font class="btn-danger btn-sm" style="font-size: small;">{{ 'Tidak Publish' }}</font>
                                    @else <font class="btn-success btn-sm" style="font-size: small;">{{ 'Publish' }}</font>@endif
                                </td>
                            @else
                                <td style="text-align: center;">
                                    @if($row->status_akhir == 'Berlaku') <font class="btn-success btn-sm" style="font-size: small;">{{ 'Berlaku' }}</font> @elseif($row->status_akhir == 'Diubah') <font class="btn-primary btn-sm" style="font-size: small;">{{ 'Diubah' }}</font>
                                    @elseif($row->status_akhir == 'Mengubah') <font class="btn-primary btn-sm" style="font-size: small;">{{ 'Mengubah' }}</font>
                                    @elseif($row->status_akhir == 'Dicabut') <font class="btn-warning btn-sm" style="font-size: small;">{{ 'Dicabut' }}</font>
                                    @elseif($row->status_akhir == 'Mencabut') <font class="btn-warning btn-sm" style="font-size: small;">{{ 'Mencabut' }}</font>@elseif($row->status_akhir == 'Tidak Berlaku') <font class="btn-danger btn-sm" style="font-size: small;">{{ 'Tidak Berlaku' }}</font>@else <font class="btn-success btn-sm" style="font-size: small;">{{ 'Berlaku' }}</font>@endif
                                </td>
                            @endif
                            <td>
                                {{ $row->name }}
                            </td>
                            <td style="text-align: center">
                                {!! date('d-m-Y H:i:s', strtotime($row->created_at)) !!}
                            </td>
                            <td style="text-align: center">
                                @if($row->updated_at == $row->created_at)
                                    {{ '-' }}
                                @else
                                    {!! date('d-m-Y H:i:s', strtotime($row->updated_at)) !!}
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @php $produkID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/produk-hukum/list-data/edit/'.$produkID) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#confirm-delete" class="btn btn-danger btn-sm" data-href="{{ URL::to('admin/produk-hukum/list-data/delete/'.$row->id) }}">
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