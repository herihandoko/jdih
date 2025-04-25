@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Admin User</h1>

    <form action="{{ url('admin/role/user/update/'.$admin_user->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="current_photo" value="{{ $admin_user->photo }}">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Admin User</h6>
                        <div class="float-right d-inline">
                            <a href="{{ route('admin.role.user') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Lihat List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nama *</label>
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $admin_user->name }}" autofocus required>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Username *</label>
                                        <input type="text" name="username" class="form-control form-control-sm" value="{{ $admin_user->username }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Alamat Email *</label>
                                        <input type="email" name="email" class="form-control form-control-sm" value="{{ $admin_user->email }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label for="">Foto Saat Ini</label>
                            <div>
                                <img src="{{ asset('storage/places/'.$admin_user->photo) }}" alt="" class="w_200">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ubah Foto</label>
                            <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg, .gif || Maks.: 2 MB)</span>
                            <div>
                                <input type="file" name="photo" accept=".jpeg, .png, .jpg, .gif">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pilih Role *</label>
                                        <select name="role_id" class="form-control">
                                            @foreach($roles as $row)
                                                @if($row->role_name == 'Super Admin')
                                                    @continue
                                                @endif
                                                <option value="{{ $row->id }}" @if($row->id == $admin_user->role_id) selected @endif>{{ $row->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pilih Dinas *</label>
                                        <select name="comp_code" class="form-control">
                                            @foreach($company as $row)
                                                <option value="{{ $row->comp_code }}" @if($row->comp_code == $admin_user->comp_code) selected @endif>{{ $row->comp_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
