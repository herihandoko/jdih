@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tambah Berita</h1>

    <form action="{{ route('admin.media_hukum.berita.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Berita</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.media_hukum.berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Berita *</label>
                    <input type="text" name="judul_berita" class="form-control" value="{{ old('judul_berita') }}" autofocus>
                </div>
                
                <div class="form-group">
                    <label for="">Kategori Berita *</label>
                    <select name="berita_categories_id" class="form-control" required="true">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($categoryBerita as $row)
                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Content Berita</label>
                    <textarea name="content_berita" class="form-control editor" cols="30" rows="10"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="">Foto Berita</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg, .gif || Maks.: 1.5 MB)</span>
                    <div>
                        <input type="file" name="photo_berita" accept=".jpeg, .png, .jpg, .gif">
                    </div>
                </div>

                <button type="submit" class="btn btn-warning" name="save" value="0">Simpan</button>
                <button type="submit" class="btn btn-success" name="publish" value="1">Publish</button>
            </div>
        </div>
    </form>
@endsection