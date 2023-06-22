@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Jenis Peraturan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Jenis Peraturan</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.produk_hukum.jenis.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead style="text-align: center;">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Jenis Peraturan</th>
                        <th style="width: 5%;">Aktif</th>
                        <th style="width: 5%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($produkHukumType as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $row->type_name }}</td>
                            <td style="text-align: center;">@if($row->type_active == 1) <font class="btn-success btn-sm" style="font-size: small;">{{ 'Ya' }}</font> @else <font class="btn-danger btn-sm" style="font-size: small;">{{ 'Tidak' }}</font> @endif</td>
                            <td style="text-align: center;">
                                <a href="{{ URL::to('admin/produk-hukum/jenis-peraturan/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection