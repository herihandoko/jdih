@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Berita</h1>

    <form action="{{ url('admin/media-hukum/berita/update/'.$beritaList->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Berita</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.media_hukum.berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Berita *</label>
                    <input type="text" name="judul_berita" class="form-control" value="{{ $beritaList->judul_berita }}" autofocus>
                </div>
                
                <div class="form-group">
                    <label for="">Kategori Berita *</label>
                    <select name="berita_categories_id" class="form-control" required>
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($beritaCategory as $row)
                            <option value="{{ $row->id }}" @if($row->id == $beritaList->berita_categories_id) selected @endif>
                                {{ $row->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Content Berita</label>
                    <textarea name="content_berita" class="form-control editor" cols="30" rows="10">{{ $beritaList->content_berita }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="">Foto Saat Ini</label>
                    <div>
                        <img src="{{ url('storage/places/berita/'.$beritaList->photo_berita) }}" alt="" class="w_200">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ubah Foto Berita</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg, .gif || Maks.: 1.5 MB)</span>
                    <div>
                        <input type="file" name="photo_berita" accept=".jpeg, .png, .jpg, .gif">
                    </div>
                </div>

                @if($beritaList->publish == 0)
                    <button type="submit" class="btn btn-warning" name="save" value="0">Ubah</button>
                    <button type="submit" class="btn btn-success" name="publish" value="1">Publish</button>
                @else
                    <button type="submit" class="btn btn-success" name="edit" value="1">Ubah</button>
                @endif
            </div>
        </div>
    </form>
@endsection