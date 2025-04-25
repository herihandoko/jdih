@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tambah Kategori Berita</h1>

    <form action="{{ route('admin.media_hukum.berita.categorystore') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Kategori Berita</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.media_hukum.berita.category') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i> Lihat List
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Kategori *</label>
                    <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" autofocus required>
                </div>
                
                <div class="form-group">
                    <label for="">Status *</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category_active" id="rr1" value="1" checked>
                            <label class="form-check-label font-weight-normal" for="rr1">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category_active" id="rr2" value="0">
                            <label class="form-check-label font-weight-normal" for="rr2">Tidak Aktif</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-sm btn-success">
                    Simpan
                </button>
            </div>
        </div>
    </form>
@endsection