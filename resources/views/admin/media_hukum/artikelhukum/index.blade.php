@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Artikel Hukum</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Artikel Hukum</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.media_hukum.artikelhukum.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Artikel</th>
                        <th>Penulis Artikel</th>
                        <th>Tahun Artikel</th>
                        @if($compcode == '')
                        <th>Dinas</th>
                        @endif
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($artikelHukumList as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->judul_artikel }}</td>
                            <td>{{ $row->penulis_artikel }}</td>
                            <td>{{ $row->tahun_artikel }}</td>
                            @if($compcode == '')
                            <td>{{ $row->comp_name }}</td>
                            @endif
                            <td>
                                @if($row->publish == 1) <font class="btn-success btn-sm">{{ 'Publish' }}</font>
                                @else <font class="btn-danger btn-sm">{{ 'Draft' }}</font>@endif
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/media-hukum/artikel-hukum/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection