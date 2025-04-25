@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Bimtek Hybrid</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Bimtek Hybrid</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.layanan_hukum.bimtekhibrid.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: xx-small;">
                    <thead>
                    <tr>
                        <th style="width: 2%;">Kode</th>
                        <th>Judul Bimtek</th>
                        <th>Link Zoom</th>
                        <th>Link Pendaftaran</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Akhir</th>
                        <th>Link Dokumentasi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($layananHukumBimtek as $row)
                        <tr>
                            <td style="width: 5%;">
                                {{ $row->bimtek_number }}
                            </td>
                            <td style="width: 10%;">
                                {{ $row->bimtek_name }}
                            </td>
                            <td style="width: auto;">
                                {{ $row->bimtek_link_zoom }}
                            </td>
                            <td style="width: auto;">
                                {{ $row->bimtek_link_register }}
                            </td>
                            <td style="width: 9%;">
                                {!! date('d M Y', strtotime($row->bimtek_start_date)) !!}
                            </td>
                            <td style="width: 9%;">
                                {!! date('d M Y', strtotime($row->bimtek_end_date)) !!}
                            </td>
                            <td style="width: auto;">
                                {{ $row->bimtek_link_doc }}
                            </td>
                            <td style="text-align: center; width: auto;">
                                @php $bimtekID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/layanan-hukum/bimtek-hibrid/edit/'.$bimtekID) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection