@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Majalah Hukum</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Majalah Hukum</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.media_hukum.majalahhukum.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Majalah</th>
                        <th>Penulis Majalah</th>
                        <th>Edisi Majalah</th>
                        <th>Penerbit Majalah</th>
                        <th>Tahun Majalah</th>
                        <th>Kategori Majalah</th>
                        @if($compcode == '')
                        <th>Dinas</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($majalahHukumList as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->judul_majalah }}</td>
                            <td>{{ $row->penulis_majalah }}</td>
                            <td>{{ $row->edisi_majalah }}</td>
                            <td>{{ $row->penerbit_majalah }}</td>
                            <td>{{ $row->tahun_majalah }}</td>
                            <td>{{ $row->kategori_majalah }}</td>
                            @if($compcode == '')
                            <td>{{ $row->comp_name }}</td>
                            @endif
                            <td>
                                <a href="{{ URL::to('admin/media-hukum/majalah-hukum/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection