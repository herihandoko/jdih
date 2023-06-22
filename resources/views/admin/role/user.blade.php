@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Admin Users</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">List Admin Users</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.role.user-create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead style="text-align: center;">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Alamat Email</th>
                        <th>Dinas</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admin_users as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: center;">
                                @if($row->photo)
                                    <img src="{{ asset('storage/places/'.$row->photo) }}" alt="" class="w_30">
                                @else
                                    <img src="{{ asset('storage/places/avatar_profile.png') }}" alt="" class="w_30">
                                @endif
                            </td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>
                                @if($row->id != 1)
                                    {{ $row->comp_name }}
                                @else
                                    {{ 'Super Admin' }}
                                @endif
                            </td>
                            <td>{{ $row->role_name }}</td>
                            <td style="text-align: center; font-size: x-small;">
                                @if($row->id != 1)
                                    <a href="{{ URL::to('admin/role/user/edit/password/'.$row->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-key"></i>
                                    </a>
                                    
                                    <a href="{{ URL::to('admin/role/user/edit/'.$row->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#confirm-delete" class="btn btn-danger btn-sm" data-href="{{ URL::to('admin/role/user/delete/'.$row->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                @endif
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
