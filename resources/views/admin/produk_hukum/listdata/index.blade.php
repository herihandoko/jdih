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
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: x-small;">
                    <thead style="font-size: small;">
                        <tr>
                            <th style="width: 2%;">No.</th>
                            <th>Jns Dokumen</th>
                            <th>Jns Peraturan</th>
                            <th>Judul</th>
                            @if($compcode == '')
                                <th>Dinas</th>
                            @endif
                            <th>Status</th>
                            <th>Publish</th>
                            <th>Dibuat Oleh</th>
                            <th>Tgl Dibuat</th>
                            <th>Tgl Diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Cari Jns Dokumen" class="form-control form-control-sm column-filter" data-column="1" /></th>
                            <th><input type="text" placeholder="Cari Jns Peraturan" class="form-control form-control-sm column-filter" data-column="2" /></th>
                            <th><input type="text" placeholder="Cari Judul" class="form-control form-control-sm column-filter" data-column="3" /></th>
                            <th></th>
                            <th>
                                <select class="form-control form-control-sm column-filter" data-column="5">
                                    <option value="">Semua</option>
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Tidak Berlaku">Tidak Berlaku</option>
                                </select>
                            </th>
                            <th>
                                <select class="form-control form-control-sm column-filter" data-column="6">
                                    <option value="">Semua</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($produkHukumList as $row)
                        <tr>
                            <td style="text-align: center; width: 2%;">{{ $loop->iteration }}</td>
                            <td style="width: 5%;">{{ $row->produk_hukum_categories->category_name }}</td>
                            @if($row->produk_hukum_types)
                                <td style="width: 5%;">{{ $row->produk_hukum_types->type_name }}</td>
                            @else
                                <td style="text-align: center; width: 5%;">{{ '-' }}</td>
                            @endif
                            <td style="width: 15%;">{{ $row->judul_peraturan }}</td>
                            @if($compcode == '')
                                @if($row->comp_name == '')
                                    <td style="text-align: center; width: auto;">{{ '-' }}</td>
                                @else
                                    <td style="width: auto;">{{ $row->comp_name }}</td>
                                @endif
                            @endif
                            @if(empty($row->status_akhir))
                                <td style="text-align: center; width: auto;">
                                    {{ '-' }}
                                </td>
                            @else
                                <td style="text-align: center; width: auto;">
                                    @if($row->status_akhir == 'Berlaku')
                                        <font class="btn-success btn-sm" style="font-size: xx-small;">{{ 'Berlaku' }}</font>
                                    @else
                                        <font class="btn-danger btn-sm" style="font-size: xx-small;">{{ 'Tidak Berlaku' }}</font>
                                    @endif
                                </td>
                            @endif
                            <td style="text-align: center; width: auto;">
                                @if($row->is_publish == 2)
                                    <font class="btn-danger btn-sm" style="font-size: xx-small;">{{ 'Tidak' }}</font>
                                @else
                                    <font class="btn-success btn-sm" style="font-size: xx-small;">{{ 'Ya' }}</font>
                                @endif
                            </td>
                            <td style="width: auto;">
                                {{ $row->name }}
                            </td>
                            <td style="text-align: center; width: auto;">
                                {!! date('d M Y H:i:s', strtotime($row->created_at)) !!}
                            </td>
                            <td style="text-align: center; width: auto;">
                                @if($row->updated_at == $row->created_at)
                                    {{ '-' }}
                                @else
                                    {!! date('d M Y H:i:s', strtotime($row->updated_at)) !!}
                                @endif
                            </td>
                            <td style="text-align: center; width: auto;">
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