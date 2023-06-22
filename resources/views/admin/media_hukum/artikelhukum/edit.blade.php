@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Artikel Hukum</h1>

    <form action="{{ url('admin/media-hukum/artikel-hukum/update/'.$artikelHukumList->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Artikel Hukum</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.media_hukum.artikelhukum.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Artikel *</label>
                    <input type="text" name="judul_artikel" class="form-control" value="{{ $artikelHukumList->judul_artikel }}" autofocus>
                </div>

                <div class="form-group">
                    <label for="">Content Artikel</label>
                    <textarea name="content_artikel" class="form-control editor" cols="30" rows="10">{{ $artikelHukumList->content_artikel }}</textarea>
                </div>

                @if($artikelHukumList->publish == 0)
                    <button type="submit" class="btn btn-warning" name="save" value="0">Simpan</button>
                    <button type="submit" class="btn btn-success" name="publish" value="1">Publish</button>
                @else
                    <button type="submit" class="btn btn-success" name="edit" value="1">Ubah</button>
                @endif
            </div>
        </div>
    </form>
@endsection