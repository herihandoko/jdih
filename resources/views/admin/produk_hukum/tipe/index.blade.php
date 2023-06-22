@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tipe Dokumen</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Tipe Dokumen</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.produk_hukum.tipe.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Tipe Dokumen</th>
                        <th style="width: 5%;">Aktif</th>
                        <th style="width: 5%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($produkHukumCategory as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td style="text-align: center;">@if($row->category_active == 1) <font class="btn-success btn-sm" style="font-size: small;">{{ 'Ya' }}</font> @else <font class="btn-danger btn-sm" style="font-size: small;">{{ 'Tidak' }}</font> @endif</td>
                            <td style="text-align: center;">
                                <a href="{{ URL::to('admin/produk-hukum/tipe-dokumen/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection