@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tambah Dinas</h1>

    <form action="{{ route('admin.company.store') }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Dinas</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.company.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Kode Dinas</label>
                                <input type="text" name="comp_code" class="form-control" value="{{ $nextPrimaryKeyIds }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">Nama Dinas *</label>
                                <input type="text" name="comp_name" class="form-control" value="{{ old('comp_name') }}" autofocus>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>

@endsection