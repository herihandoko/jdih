@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Bidang Hukum</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Bidang Hukum</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.produk_hukum.bh.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead>
                        <tr>
                            <th style="width: 2%;">No.</th>
                            <th>Kode</th>
                            <th>Bidang Hukum</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th></th>
                            <th><input type="text" placeholder="Cari Kode" class="form-control form-control-sm column-filter" data-column="1" /></th>
                            <th><input type="text" placeholder="Cari Bidang Hukum" class="form-control form-control-sm column-filter" data-column="2" /></th>
                            <th>
                                <select class="form-control form-control-sm column-filter" data-column="3">
                                    <option value="">Semua</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($produkHukumBidangHukum as $row)
                        <tr>
                            <td style="text-align: center; width: 2%;">{{ $loop->iteration }}</td>
                            <td style="width: auto;">{{ $row->bh_code }}</td>
                            <td style="width: auto;">{{ $row->bh_name }}</td>
                            <td style="text-align: center; width: auto;">@if($row->bh_active == 1) <font class="btn-success btn-sm" style="font-size: small;">{{ 'Ya' }}</font> @else <font class="btn-danger btn-sm" style="font-size: small;">{{ 'Tidak' }}</font> @endif</td>
                            <td style="text-align: center; width: auto;">
                                @php $bhID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/produk-hukum/bidang-hukum/edit/'.$bhID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection